<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\Hotel;
use App\Models\Rating;

class RatingController extends Controller{
//menampilkan semua data yg sudah dirating
    public function ownRatedHotel(Request $request) {
        $city = $request->city; //mengambil data kota, kenapa inisialisasinya city bukan kota?
        $username = $request->username; //mengambil data username

        $ratedHotel = Rating::where('username', $username)->get(); //produce: SELECT*FROM table

        $unsortedData = collect($ratedHotel);
        $ar = $unsortedData->sortBy('angka_rating'); //angka_rating mengambil dari database
        $ar = $ar->values()->toArray(); //menampilkan semua data yg sudah dirating

        $ratedHotel = $ar; //rata-rata hotel yang sudah dirating
        $hotel = []; //inisialisasi hotel
        $a = 0; //inisialisasi user pembanding utama

        foreach($ratedHotel as $rat){ //menampilkan data hotel dengan memanggil id hotel
            $hotel[$a] = Hotel::where('id_hotel', $rat['id_hotel'])->first();
            $a++;
        }

        $hotelInCity = []; //rata-rata hotel terhadap user pembanding umum berdasarkan kota
        $b = 0;
        foreach($hotel as $key => $htl) {
            if($htl->kota == $city) {
                $hotelInCity[$b] = $htl;
                $b++;
            }
        }

        return response()->json($hotelInCity, 200);
    }

    public function recArroundHotel(Request $request) {
        $city = 'Cirebon';
        $username = $request->username;
        $ratedUser = Rating::where('username', $username)->get();

        if($ratedUser->count() < 2) {
            return response()->json([
                "count" => $ratedUser->count(),
                "username" => $username,
                "message"=>"User must submit at least 2 rate"
            ], 400);
        }

        $ratedCurrentUser = [];
        $ratedOtherUser = [];
        $i = 0;

        foreach ($ratedUser as $rtuser){
            $idHotel = $rtuser->id_hotel;
            $username = $rtuser->username;
            $ratedOtherUser[$i] = Rating::where('id_hotel', $idHotel)->get();
            $ratedCurrentUser[$i] = Rating::where('id_hotel', $idHotel)->where('username', $username)->get();
            $i++;
        }

        $sum = [];
        $sumCurrentUser = [];
        $currentRate = [];
        $currentRateUser = [];

        for ($a=0; $a<count($ratedOtherUser); $a++) {
            $rate = $ratedOtherUser[$a];
            $rateCurrentUser = $ratedCurrentUser[$a];
            $rating = [];
            $ratingCurrentUser = [];
            for ($b = 0; $b<count($rate); $b++){
                $rating[$b] = $rate[$b]->angka_rating;
                $sum[$b] = 0;
            }

            for ($d=0; $d<count($rateCurrentUser); $d++) {
                $ratingCurrentUser[$d] = $rateCurrentUser[$d]->angka_rating;
                $sumCurrentUser[$d] = 0;
            }

            $currentRate[$a] = $rating;
            $currentRateUser[$a] = $ratingCurrentUser;
        }

        for ($x=0; $x<count($currentRate); $x++) {
            $sum = array_map(function (...$arrays) {
                return array_sum($arrays);
            }, $sum, $currentRate[$x]);

            $sumCurrentUser = array_map(function (...$arrays) {
                return array_sum($arrays);
            }, $sumCurrentUser, $currentRateUser[$x]);
        }
        //mencari rata-rata
        $average = [];
        $averageCurrentUser = [];
        for ($y=0; $y<count($sum); $y++) {
            $average[$y] = $sum[$y] / count($currentRate);
        }

        for ($z=0; $z<count($sumCurrentUser); $z++) {
            $averageCurrentUser[$z] = $sumCurrentUser[$z] / count($currentRateUser);
        }

        //menampilkan hasil penyebut
        $currentRateAfterDiff = [];
        $currentRateUserAfterDiff = [];
        for ($c=0; $c<count($currentRate); $c++){
            $currentRateAfterDiff[$c] = array_map(function ($array1, $array2) { return $array1-$array2; } , $currentRate[$c], $average);
        }

        for ($f=0; $f<count($currentRateUser); $f++){
            $currentRateUserAfterDiff[$f] = array_map(function ($array1, $array2) { return $array1-$array2; } , $currentRateUser[$f], $averageCurrentUser);
        }

        //PEMBILANG
        $pembilang = [];
        for($g=0; $g<count($currentRateAfterDiff); $g++){
            $ll = $currentRateAfterDiff[$g];
            $lluser = $currentRateUserAfterDiff[$g];
            $llusers = 0;
            $items = [];

            for($k=0; $k<count($lluser); $k++) {
                $llusers = $lluser[$k];
            }

            for($h=0; $h<count($ll); $h++) {
                $lll = $ll[$h] * $llusers;
                $items[$h] = $lll;
            }

            $pembilang[$g] = $items;
        }

        $sumPembilang = [];
        for($l=0; $l<count($pembilang); $l++) {
            $sumPembilang = array_map(function (...$arrays) {
                return array_sum($arrays);
            }, $sumPembilang, $pembilang[$l]);
        }

        $pembilangAkhir = $sumPembilang;

        //PENYEBUT
        $penyebut = [];
        $penyebutUser = [];

        for($m=0; $m<count($currentRateAfterDiff); $m++) {
            $kk = $currentRateAfterDiff[$m];
            $items = [];
            for($n=0; $n<count($kk); $n++) {
                $kkk = $kk[$n];
                $items[$n] = $kkk * $kkk;
            }

            $penyebut[$m] = $items;
        }

        for($m=0; $m<count($currentRateUserAfterDiff); $m++) {
            $kk = $currentRateUserAfterDiff[$m];
            $items = [];
            for($n=0; $n<count($kk); $n++) {
                $kkk = $kk[$n];
                $items[$n] = $kkk * $kkk;
            }

            $penyebutUser[$m] = $items;
        }

        $sumPenyebut = [];
        for($o=0; $o<count($penyebut); $o++) {
            $sumPenyebut = array_map(function (...$arrays) {
                return array_sum($arrays);
            }, $sumPenyebut, $penyebut[$o]);
        }

        $sumPenyebutUser = [];
        for($o=0; $o<count($penyebutUser); $o++) {
            $sumPenyebutUser = array_map(function (...$arrays) {
                return array_sum($arrays);
            }, $sumPenyebutUser, $penyebutUser[$o]);
        }

        $sumPenyebutSQRT = [];
        for($p=0; $p<count($sumPenyebut); $p++) {
            $sumPenyebutSQRT[$p] = sqrt($sumPenyebut[$p]);
        }

        $sumPenyebutUserSQRT = [];
        for($p=0; $p<count($sumPenyebutUser); $p++) {
            $sumPenyebutUserSQRT[$p] = sqrt($sumPenyebutUser[$p]);
        }

        $penyebutAkhir = [];
        for($q=0; $q<count($sumPenyebutSQRT); $q++) {
            $mm = $sumPenyebutSQRT[$q];
            $nn = $sumPenyebutUserSQRT[0];
            $penyebutAkhir[$q] = $mm * $nn;
        }

        //HASIL
        $lengthPembilang = count($pembilangAkhir);
        $lengthPenyebut = count($penyebutAkhir);
        $result = [];

        if($lengthPembilang == $lengthPenyebut){
            for($r=0; $r<$lengthPembilang; $r++){
                $result[$r] = $pembilangAkhir[$r] / $penyebutAkhir[$r];
            }
        }

        $maxValue = max($result);
        $maxIndex = array_keys($result, max($result));

        $result_diff = [];
        $u = 0;
        for($t=0; $t<count($result); $t++) {
            if($t != $maxIndex[0]){
                $result_diff[$u] = $result[$t];
                $u++;
            }
        }

        $maxIndexResult = array_keys($result_diff, max($result_diff));

        $suggestHotel = [];
        for($s=0; $s<count($ratedOtherUser); $s++) {
            $rr = $ratedOtherUser[$s];
            $res = $rr[$maxIndexResult[0]];
            $suggestHotel[$s] = $res;
        }

        $usernameSimilar = $suggestHotel[0]->username;

        // $hotelSimilar = Rating::where('username', $usernameSimilar)->get();

        // $hotels = [];
        // for($v=0; $v<count($ratedUser); $v++) {
        //     $hotel = [];
        //     for($w=0; $w<count($hotelSimilar); $w++) {
        //         if($hotelSimilar[$w]->id_hotel != $ratedUser[$v]->id_hotel){
        //             $hotel[$w] = $hotelSimilar[$w]->id_hotel;
        //         }
        //     }
        //     $hotels[$v] = $hotel;
        // }

        $ratSimiliar = Rating::where('username', $usernameSimilar)->get();
        $ratUser = Rating::where('username', $username)->get();

        $unsortedData = collect($ratSimiliar);
        $ar = $unsortedData->sortBy('angka_rating');
        $ar = $ar->values()->toArray();

        $unsortedData2 = collect($ratUser);
        $ar2 = $unsortedData2->sortBy('angka_rating');
        $ar2 = $ar2->values()->toArray();

        $ratSimiliar = $ar;
        $ratUser = $ar2;

        $hotelSimilar = [];
        $hotelUser = [];

        foreach($ratUser as $key1 => $rtu) {
            $hotelUser[$key1] = $rtu['id_hotel'];
        }

        foreach($ratSimiliar as $key2 => $rts) {
            $hotelSimilar[$key2] = $rts['id_hotel'];
        }

        $hotel = array_values(array_diff($hotelSimilar, $hotelUser));
        $hotelDetails =[];

        for($zz=0; $zz<count($hotel); $zz++){
            $hotelDetails[$zz] = Hotel::where('id_hotel', $hotel[$zz])->first();
        }

        $hotelInCity = [];
        $cc = 0;
        foreach($hotelDetails as $key => $detail) {
            if($detail->kota == $city) {
                $hotelInCity[$cc] = $detail;
                $cc++;
            }
        }

        return response()->json($hotelInCity, 200);
    }

    public function showOther(Request $request){
        $idHotel = $request->id_hotel;
        $gambarHotel = $request->gambar_hotel;
        $rating = Rating::where('id_hotel', $idHotel)->get();
        $ratSum = 0;

        foreach($rating as $rat){
            $ratSum = $ratSum + $rat->angka_rating;
        }

        $ratAverage = $ratSum/$rating->count();
        $gambarHotel = Storage::url($gambarHotel);

        return response()->json([
            "rating" => $ratAverage,
            "gambar" => $gambarHotel
        ], 200);
    }
}
