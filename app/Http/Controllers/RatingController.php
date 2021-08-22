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
use App\Models\Users;

class RatingController extends Controller{
//menampilkan semua data yg sudah dirating

    // public function recArroundHotel(Request $request) {
    //     $city = $request->city;
    //     $username = $request->username;
    //     $ratedUser = Rating::where('username', $username)->get();

    //     if($ratedUser->count() < 2) {
    //         return response()->json([
    //             "count" => $ratedUser->count(),
    //             "username" => $username,
    //             "message"=>"User must submit at least 2 rate"
    //         ], 400);
    //     }

    //     $ratedCurrentUser = [];
    //     $ratedOtherUser = [];
    //     $i = 0;

    //     foreach ($ratedUser as $rtuser){
    //         $idHotel = $rtuser->id_hotel;
    //         $username = $rtuser->username;
    //         $ratedOtherUser[$i] = Rating::where('id_hotel', $idHotel)->get();
    //         $ratedCurrentUser[$i] = Rating::where('id_hotel', $idHotel)->where('username', $username)->get();
    //         $i++;
    //     }

    //     $sum = [];
    //     $sumCurrentUser = [];
    //     $currentRate = [];
    //     $currentRateUser = [];

    //     for ($a=0; $a<count($ratedOtherUser); $a++) {
    //         $rate = $ratedOtherUser[$a];
    //         $rateCurrentUser = $ratedCurrentUser[$a];
    //         $rating = [];
    //         $ratingCurrentUser = [];
    //         for ($b = 0; $b<count($rate); $b++){
    //             $rating[$b] = $rate[$b]->angka_rating;
    //             $sum[$b] = 0;
    //         }

    //         for ($d=0; $d<count($rateCurrentUser); $d++) {
    //             $ratingCurrentUser[$d] = $rateCurrentUser[$d]->angka_rating;
    //             $sumCurrentUser[$d] = 0;
    //         }

    //         $currentRate[$a] = $rating;
    //         $currentRateUser[$a] = $ratingCurrentUser;
    //     }

    //     for ($x=0; $x<count($currentRate); $x++) {
    //         $sum = array_map(function (...$arrays) {
    //             return array_sum($arrays);
    //         }, $sum, $currentRate[$x]);

    //         $sumCurrentUser = array_map(function (...$arrays) {
    //             return array_sum($arrays);
    //         }, $sumCurrentUser, $currentRateUser[$x]);
    //     }
    //     //mencari rata-rata
    //     $average = [];
    //     $averageCurrentUser = [];
    //     for ($y=0; $y<count($sum); $y++) {
    //         $average[$y] = $sum[$y] / count($currentRate);
    //     }

    //     for ($z=0; $z<count($sumCurrentUser); $z++) {
    //         $averageCurrentUser[$z] = $sumCurrentUser[$z] / count($currentRateUser);
    //     }

    //     //Revisi
    //     $users = Users::get();
    //     $averageUsersRating = [];
    //     foreach($users as $key1 => $user){
    //         $ratHotelsUser = Rating::where('username', $user->username)->get();
    //         $sumUserRating = 0;
    //         $lengthUserRating = 1;

    //         foreach($ratHotelsUser as $key2 => $rhs){
    //             $sumUserRating = $sumUserRating + $rhs->angka_rating;
    //             $lengthUserRating++;
    //         }

    //         $averageUserRating = $sumUserRating / $lengthUserRating;
    //         $averageUsersRating[$key1] = $averageUserRating;
    //     }

    //     $usersCurrent = Users::where('username', $username)->get();
    //     $averageUsersCurrentRating = [];
    //     foreach($usersCurrent as $key3 => $user){
    //         $ratHotelsUserCurrent = Rating::where('username', $user->username)->get();
    //         $sumUserCurrentRating = 0;
    //         $lengthUserCurrentRating = 1;

    //         foreach($ratHotelsUserCurrent as $key4 => $rhs){
    //             $sumUserCurrentRating = $sumUserCurrentRating + $rhs->angka_rating;
    //             $lengthUserCurrentRating++;
    //         }

    //         $averageUserCurrentRating = $sumUserCurrentRating / $lengthUserCurrentRating;
    //         $averageUsersCurrentRating[$key1] = $averageUserCurrentRating;
    //     }

    //     //menampilkan hasil penyebut
    //     $currentRateAfterDiff = [];
    //     $currentRateUserAfterDiff = [];
    //     for ($c=0; $c<count($currentRate); $c++){
    //         $currentRateAfterDiff[$c] = array_map(function ($array1, $array2) { return $array1-$array2; } , $currentRate[$c], $average);
    //     }

    //     for ($f=0; $f<count($currentRateUser); $f++){
    //         $currentRateUserAfterDiff[$f] = array_map(function ($array1, $array2) { return $array1-$array2; } , $currentRateUser[$f], $averageCurrentUser);
    //     }

    //     //PEMBILANG
    //     $pembilang = [];
    //     for($g=0; $g<count($currentRateAfterDiff); $g++){
    //         $ll = $currentRateAfterDiff[$g];
    //         $lluser = $currentRateUserAfterDiff[$g];
    //         $llusers = 0;
    //         $items = [];

    //         for($k=0; $k<count($lluser); $k++) {
    //             $llusers = $lluser[$k];
    //         }

    //         for($h=0; $h<count($ll); $h++) {
    //             $lll = $ll[$h] * $llusers;
    //             $items[$h] = $lll;
    //         }

    //         $pembilang[$g] = $items;
    //     }

    //     $sumPembilang = [];
    //     for($l=0; $l<count($pembilang); $l++) {
    //         $sumPembilang = array_map(function (...$arrays) {
    //             return array_sum($arrays);
    //         }, $sumPembilang, $pembilang[$l]);
    //     }

    //     $pembilangAkhir = $sumPembilang;

    //     //PENYEBUT
    //     $penyebut = [];
    //     $penyebutUser = [];

    //     for($m=0; $m<count($currentRateAfterDiff); $m++) {
    //         $kk = $currentRateAfterDiff[$m];
    //         $items = [];
    //         for($n=0; $n<count($kk); $n++) {
    //             $kkk = $kk[$n];
    //             $items[$n] = $kkk * $kkk;
    //         }

    //         $penyebut[$m] = $items;
    //     }

    //     for($m=0; $m<count($currentRateUserAfterDiff); $m++) {
    //         $kk = $currentRateUserAfterDiff[$m];
    //         $items = [];
    //         for($n=0; $n<count($kk); $n++) {
    //             $kkk = $kk[$n];
    //             $items[$n] = $kkk * $kkk;
    //         }

    //         $penyebutUser[$m] = $items;
    //     }

    //     $sumPenyebut = [];
    //     for($o=0; $o<count($penyebut); $o++) {
    //         $sumPenyebut = array_map(function (...$arrays) {
    //             return array_sum($arrays);
    //         }, $sumPenyebut, $penyebut[$o]);
    //     }

    //     $sumPenyebutUser = [];
    //     for($o=0; $o<count($penyebutUser); $o++) {
    //         $sumPenyebutUser = array_map(function (...$arrays) {
    //             return array_sum($arrays);
    //         }, $sumPenyebutUser, $penyebutUser[$o]);
    //     }

    //     $sumPenyebutSQRT = [];
    //     for($p=0; $p<count($sumPenyebut); $p++) {
    //         $sumPenyebutSQRT[$p] = sqrt($sumPenyebut[$p]);
    //     }

    //     $sumPenyebutUserSQRT = [];
    //     for($p=0; $p<count($sumPenyebutUser); $p++) {
    //         $sumPenyebutUserSQRT[$p] = sqrt($sumPenyebutUser[$p]);
    //     }

    //     $penyebutAkhir = [];
    //     for($q=0; $q<count($sumPenyebutSQRT); $q++) {
    //         $mm = $sumPenyebutSQRT[$q];
    //         $nn = $sumPenyebutUserSQRT[0];
    //         $penyebutAkhir[$q] = $mm * $nn;
    //     }

    //     //HASIL
    //     $lengthPembilang = count($pembilangAkhir);
    //     $lengthPenyebut = count($penyebutAkhir);
    //     $result = [];

    //     if($lengthPembilang == $lengthPenyebut){
    //         for($r=0; $r<$lengthPembilang; $r++){
    //             $result[$r] = $pembilangAkhir[$r] / $penyebutAkhir[$r];
    //         }
    //     }

    //     $maxValue = max($result);
    //     $maxIndex = array_keys($result, max($result));

    //     $result_diff = [];
    //     $u = 0;
    //     for($t=0; $t<count($result); $t++) {
    //         if($t != $maxIndex[0]){
    //             $result_diff[$u] = $result[$t];
    //             $u++;
    //         }
    //     }

    //     $maxIndexResult = array_keys($result_diff, max($result_diff));

    //     $suggestHotel = [];
    //     for($s=0; $s<count($ratedOtherUser); $s++) {
    //         $rr = $ratedOtherUser[$s];
    //         $res = $rr[$maxIndex[0]];
    //         $suggestHotel[$s] = $res;
    //     }

    //     //Mencari Similaritas User
    //     $usernameSimilar = $suggestHotel[0]->username;
    //     $userData = Users::where('username', $usernameSimilar)->first();

    //     // $hotelSimilar = Rating::where('username', $usernameSimilar)->get();

    //     // $hotels = [];
    //     // for($v=0; $v<count($ratedUser); $v++) {
    //     //     $hotel = [];
    //     //     for($w=0; $w<count($hotelSimilar); $w++) {
    //     //         if($hotelSimilar[$w]->id_hotel != $ratedUser[$v]->id_hotel){
    //     //             $hotel[$w] = $hotelSimilar[$w]->id_hotel;
    //     //         }
    //     //     }
    //     //     $hotels[$v] = $hotel;
    //     // }

    //     $ratSimiliar = Rating::where('username', $usernameSimilar)->get();
    //     $ratUser = Rating::where('username', $username)->get();

    //     //Sorting berdasarkan rating tertinggi
    //     $unsortedData = collect($ratSimiliar);
    //     $ar = $unsortedData->sortByDesc('angka_rating');
    //     $ar = $ar->values()->toArray();

    //     $unsortedData2 = collect($ratUser);
    //     $ar2 = $unsortedData2->sortByDesc('angka_rating');
    //     $ar2 = $ar2->values()->toArray();

    //     $ratSimiliar = $ar;
    //     $ratUser = $ar2;

    //     $hotelSimilar = [];
    //     $hotelUser = [];

    //     foreach($ratUser as $key1 => $rtu) {
    //         $hotelUser[$key1] = $rtu['id_hotel'];
    //     }

    //     foreach($ratSimiliar as $key2 => $rts) {
    //         $hotelSimilar[$key2] = $rts['id_hotel'];
    //     }

    //     $hotel = array_values(array_diff($hotelSimilar, $hotelUser));
    //     $hotelDetails =[];

    //     for($zz=0; $zz<count($hotel); $zz++){
    //         $hotelDetails[$zz] = Hotel::where('id_hotel', $hotel[$zz])->first();
    //     }

    //     $hotelInCity = [];
    //     $cc = 0;
    //     foreach($hotelDetails as $key => $detail) {
    //         if($detail->kota == $city) {
    //             $hotelInCity[$cc] = $detail;
    //             $cc++;
    //         }
    //     }

    //     if(count($hotelInCity) < 1) {
    //         $hotelRatOwn = Rating::where('username', $username)->get();
    //         $hotelRatOwn = collect($hotelRatOwn);
    //         $hotelRatOwn = $hotelRatOwn->sortBy('angka_rating');
    //         $hotelRatOwn = $hotelRatOwn->values()->toArray();

    //         $hotelList = [];

    //         foreach($hotelRatOwn as $key => $htrt) {
    //             $hotelList[$key] = Hotel::where('id_hotel', $htrt['id_hotel'])->first();
    //         }

    //         $hotelInCity = $hotelList;
    //     }

    //     return response()->json([
    //         "hotel_rec" => $hotelInCity,
    //         "user_similar" => $userData,
    //         "result_diff" => $result,
    //         "max_index" => $maxIndex
    //     ], 200);
    // }

    public function showOther(Request $request){
        $idHotel = $request->id_hotel;
        $gambarHotel = $request->gambar_hotel;
        $rating = Rating::where('id_hotel', $idHotel)->get();
        $ratAverage = 0;

        if($rating->count() > 0){
            $ratSum = 0;

            foreach($rating as $rat){
                $ratSum = $ratSum + $rat->angka_rating;
            }

            $ratAverage = $ratSum/$rating->count();
        }

        $gambarHotel = Storage::url($gambarHotel);

        return response()->json([
            "rating" => $ratAverage,
            "gambar" => $gambarHotel
        ], 200);
    }

    public function newAlgorithm(Request $request) {
        $username = $request->username;
        $city = $request->city;
        $hotelRatingUser = Rating::where('username', $username)->get();

        //Rating hotel yang sudah dirating oleh user
        $hotelRatingAllUserByCurrentUser = [];
        $hotelRatingCurrentUserByCurrentUser = [];

        $usernamesByHotel = [];
        $usernamesByHotelCurrentUser = [];

        foreach($hotelRatingUser as $key => $hru){
            $idHotel = $hru->id_hotel;

            $rating = Rating::where('id_hotel', $idHotel)->get();
            $ratingCurrentUser = Rating::where('id_hotel', $idHotel)->where('username', $username)->get();

            $ratingHotel = [];
            $ratingHotelCurrentUser = [];

            $usernames = [];
            $usernamesCurrentUser = [];

            foreach($rating as $key2 => $rat){
                $ratingHotel[$key2] = $rat->angka_rating;
                $usernames[$key2] = $rat->username;
            }

            foreach($ratingCurrentUser as $key3 => $rat){
                $ratingHotelCurrentUser[$key3] = $rat->angka_rating;
                $usernamesCurrentUser[$key3] = $rat->username;
            }

            $hotelRatingAllUserByCurrentUser[$key] = $ratingHotel;
            $usernamesByHotel[$key] = $usernames;

            $hotelRatingCurrentUserByCurrentUser[$key] = $ratingHotelCurrentUser;
            $usernamesByHotelCurrentUser[$key] = $usernamesCurrentUser;
        }

        //Filter berdasakan user yang sama
        $arrayIntersect = $usernamesByHotel[0];
        for($i=1; $i<count($usernamesByHotel); $i++) {
            $usernamePerHotel = $usernamesByHotel[$i];
            $arrayIntersect = array_values(array_intersect($arrayIntersect, $usernamePerHotel));
        }

        $usernamesByHotelTemp = [];
        foreach($usernamesByHotel as $key6 => $ubh){
            $usernamesByHotelTemp[$key6] = array_values(array_intersect($arrayIntersect, $ubh));
        }

        $usernamesByHotel = $usernamesByHotelTemp;

        $hotelRatingAllUserByCurrentUserTemp = [];
        //Filter Rating berdasarkan user yang sama
        foreach($usernamesByHotel as $key7 =>$ubh){
            $usernames = $ubh;
            $ratings = [];
            for($i=0; $i<count($usernames); $i++){
                $ratings[$i] = Rating::where('username', $usernames[$i])->where('id_hotel', $hotelRatingUser[$key7]->id_hotel)->value('angka_rating');
            }
            $hotelRatingAllUserByCurrentUserTemp[$key7] = $ratings;
        }

        $hotelRatingAllUserByCurrentUser = $hotelRatingAllUserByCurrentUserTemp;

        //Rata-rata rating hotel yang sudah dirating oleh user
        $averageUsersRatingByHotel = [];
        for($i=0; $i<count($usernamesByHotel); $i++) {
            $userPerHotel = $usernamesByHotel[$i];
            $averageUsersRating = [];
            foreach($userPerHotel as $key => $username) {
                $userRating = Rating::where('username', $username)->get();
                $sumUserRating = 0;
                $lengthUserRating = 1;
                foreach($userRating as $key2 => $userRat) {
                    $sumUserRating += $userRat->angka_rating;
                    $lengthUserRating++;
                }

                $averageUsersRating[$key] = $sumUserRating / $lengthUserRating;
            }

            $averageUsersRatingByHotel[$i] = $averageUsersRating;
        }

        //Rata-rata rating semua hotel yang user ditanyakan
        $averageCurrentUserRatingByHotel = [];
        for($i=0; $i<count($usernamesByHotelCurrentUser); $i++) {
            $userPerHotel = $usernamesByHotelCurrentUser[$i];
            $averageCurrentUserRating = [];
            foreach($userPerHotel as $key => $username) {
                $userRating = Rating::where('username', $username)->get();
                $sumUserRating = 0;
                $lengthUserRating = 1;
                foreach($userRating as $key2 => $userRat) {
                    $sumUserRating += $userRat->angka_rating;
                    $lengthUserRating++;
                }

                $averageCurrentUserRating[$key] = $sumUserRating / $lengthUserRating;
            }

            $averageCurrentUserRatingByHotel[$i] = $averageCurrentUserRating;
        }

        $hotelLength = count($hotelRatingAllUserByCurrentUser);

        //Pengurangan rating dengan rata-rata
        $diffRatingUsersByHotel = [];
        for($i=0; $i<$hotelLength; $i++){
            $rating = $hotelRatingAllUserByCurrentUser[$i];
            $average = $averageUsersRatingByHotel[$i];
            $diffRatingUsersByHotel[$i] = array_map(function ($array1, $array2) { return $array1-$array2; } , $rating, $average);
        }

        //Pengurangan current user rating dengan rata-rata
        $diffRatingCurrentUserByHotel = [];
        for($i=0; $i<$hotelLength; $i++){
            $rating = $hotelRatingCurrentUserByCurrentUser[$i];
            $average = $averageCurrentUserRatingByHotel[$i];
            $diffRatingCurrentUserByHotel[$i] = array_map(function ($array1, $array2) { return $array1-$array2; } , $rating, $average);
        }

        //Perkalian dengan current user
        $multipleDiffRatingUsersByHotel = [];
        for($i=0; $i<$hotelLength; $i++){
            $users = $diffRatingUsersByHotel[$i];
            $currentUser = $diffRatingCurrentUserByHotel[$i];

            $multipleDiffRatingUserByHotel = [];
            foreach($users as $key4 => $user) {
                $multipleDiffRatingUserByHotel[$key4] = $user * $currentUser[0];
            }

            $multipleDiffRatingUsersByHotel[$i] = $multipleDiffRatingUserByHotel;
        }

        $sumMultipleDiffRatingUsersByHotel = $multipleDiffRatingUsersByHotel[0];
        foreach($multipleDiffRatingUsersByHotel as $mdrubh){
            $sumMultipleDiffRatingUsersByHotel = array_map(function (...$arrays) {
                return array_sum($arrays);
            }, $sumMultipleDiffRatingUsersByHotel, $mdrubh);
        }

        //Pembilang
        $pembilang = $sumMultipleDiffRatingUsersByHotel;

        //Dikuadratkan hasil pengurangan
        $expDiffRatingUsersByHotel = [];
        foreach($diffRatingUsersByHotel as $key9 => $drubh) {
            $ratings = $drubh;
            $expDiffRatingUserByHotel = [];
            foreach($ratings as $key10 => $rating){
                $expDiffRatingUserByHotel[$key10] = $rating * $rating;
            }

            $expDiffRatingUsersByHotel[$key9] = $expDiffRatingUserByHotel;
        }

        $expDiffRatingCurrentUsersByHotel = [];
        foreach($diffRatingCurrentUserByHotel as $key11 => $drcubh){
            $ratings = $drcubh;
            $expDiffRatingCurrentUserByHotel = [];
            foreach($ratings as $key12 => $rating){
                $expDiffRatingCurrentUserByHotel[$key12] = $rating * $rating;
            }

            $expDiffRatingCurrentUsersByHotel[$key11] = $expDiffRatingCurrentUserByHotel;
        }

        //Jumlah hasil kuadrat
        $sumExpDiffRatingUsersByHotel = $expDiffRatingUsersByHotel[0];
        foreach($expDiffRatingUsersByHotel as $edrubh){
            $sumExpDiffRatingUsersByHotel = array_map(function (...$arrays) {
                return array_sum($arrays);
            }, $sumExpDiffRatingUsersByHotel, $edrubh);
        }

        $sumExpDiffRatingCurrentUserByHotel = $expDiffRatingCurrentUsersByHotel[0];
        foreach($expDiffRatingCurrentUsersByHotel as $edrcubh){
            $sumExpDiffRatingCurrentUserByHotel = array_map(function (...$arrays) {
                return array_sum($arrays);
            }, $sumExpDiffRatingCurrentUserByHotel, $edrcubh);
        }

        //Akarkan jumlah hasil kuadrat
        $sqrtSumExpDiffRatingUsersByHotel = [];
        foreach($sumExpDiffRatingUsersByHotel as $key13 => $sudrubh){
            $sqrtSumExpDiffRatingUsersByHotel[$key13] = \sqrt($sudrubh);
        }

        $sqrtSumExpDiffRatingCurrentUserByHotel = \sqrt($sumExpDiffRatingCurrentUserByHotel[0]);

        //Penyebut
        $penyebut = [];
        foreach($sqrtSumExpDiffRatingUsersByHotel as $key14 => $ssedrubh){
            $penyebut[$key14] = $ssedrubh * $sqrtSumExpDiffRatingCurrentUserByHotel;
        }

        //Hasil
        $result = array_map(function ($array1, $array2) { return $array1/$array2; } , $pembilang, $penyebut);

        //Cari max result
        $maxValue = max($result);
        $maxIndex = array_keys($result, max($result));

        $result_diff = [];
        $b= 0;
        for($a=0; $a<count($result); $a++) {
            if($a != $maxIndex[0]){
                $result_diff[$b] = $result[$a];
                $b++;
            }
        }

        $hotelInCity = [];
        $usernameSimilar = "";

        if(count($result_diff) > 0){
            $maxIndexResult = array_keys($result_diff, max($result_diff));

            //Cari user similar
            $usernameSimilar = $usernamesByHotel[0][$maxIndexResult[0]];

            //Rating dari user similar
            $ratingSimilar = Rating::where('username', $usernameSimilar)->get();

            //Sorting berdasarkan rating tertinggi
            $ratingSimilar = collect($ratingSimilar);
            $ratingSimilar = $ratingSimilar->sortByDesc('angka_rating');
            $ratingSimilar = $ratingSimilar->values()->toArray();

            $idHotelSimilar = [];
            foreach($ratingSimilar as $key15 => $rs){
                $idHotelSimilar[$key15] = $rs['id_hotel'];
            }

            $idHotelUser = [];
            foreach($hotelRatingUser as $key16 => $hru){
                $idHotelUser[$key16] = $hru->id_hotel;
            }

            $idSuggestHotel = array_values(array_diff($idHotelSimilar, $idHotelUser));

            $hotelSimilar = [];
            foreach($idSuggestHotel as $key17 => $ish) {
                $hotelSimilar[$key17] = Hotel::where('id_hotel', $ish)->first();
            }

            $hotelInCity = [];
            $c = 0;
            foreach($hotelSimilar as $hotel) {
                if($hotel->kota == $city) {
                    $hotelInCity[$c] = $hotel;
                    $c++;
                }
            }

            if(count($hotelInCity) == 0) {
                $hotelRatOwn = Rating::where('username', $username)->get();
                $hotelRatOwn = collect($hotelRatOwn);
                $hotelRatOwn = $hotelRatOwn->sortByDesc('angka_rating');
                $hotelRatOwn = $hotelRatOwn->values()->toArray();

                $hotelList = [];

                foreach($hotelRatOwn as $key => $htrt) {
                    $hotelList[$key] = Hotel::where('id_hotel', $htrt['id_hotel'])->first();
                }

                $hotelInCity = $hotelList;
            }
        }else {
            $hotelRatOwn = Rating::where('username', $username)->get();
            $hotelRatOwn = collect($hotelRatOwn);
            $hotelRatOwn = $hotelRatOwn->sortByDesc('angka_rating');
            $hotelRatOwn = $hotelRatOwn->values()->toArray();

            $hotelList = [];

            foreach($hotelRatOwn as $key => $htrt) {
                $hotelList[$key] = Hotel::where('id_hotel', $htrt['id_hotel'])->first();
            }

            $hotelInCity = $hotelList;
        }

        return response()->json([
            "hotel_rec" => $hotelInCity,
            "username_similar" => $usernameSimilar,
            "city" => $city
        ], 200);
    }

    public function ownRatedHotel(Request $request) {
        $username = $request->username;

        $ratedHotel = Rating::where('username', $username)->get();
        $ratedHotel = collect($ratedHotel);
        $ratedHotel = $ratedHotel->sortByDesc('angka_rating');
        $ratedHotel = $ratedHotel->values()->toArray();

        $hotels = [];
        $a = 0;
        foreach($ratedHotel as $rat){
            $hotels[$a] = Hotel::where('id_hotel', $rat['id_hotel'])->first();
            $a++;
        }

        return response()->json($hotels, 200);
    }

    public function hotelInCity(Request $request){
        $city = $request->city;
        $hotels = Hotel::where('kota', $city)->get();
        return response()->json($hotels, 200);
    }

    public function searchHotel(Request $request){
        $search = $request->search;
        $hotels = [];
        $hotelsInCity = Hotel::where('kota', 'like', '%' . $search . '%')->get();
        $hotelsByName = Hotel::where('nama_hotel', 'like', '%' . $search . '%')->get();

        if($hotelsInCity->count() > 0){
            $hotels = $hotelsInCity;
        }

        if($hotelsByName->count() > 0){
            $hotels = $hotelsByName;
        }

        return response()->json($hotels, 200);
    }
}
