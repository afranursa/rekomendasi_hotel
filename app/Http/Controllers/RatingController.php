<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Models\Hotel;
use App\Models\Rating;

class RatingController extends Controller
{
    public function recArroundHotel(Request $request) {
        $city = $request->city;
        $username = $request->username;

        $ratedUser = Rating::where('username', $username)->get();
        $ratedOtherUser = [];
        $ratedOtherUserCount = [];

        for ($i = 0; i<$ratedUser->count(); $i++){
            $idHotel = $ratedUser[$i]->id_hotel;
            $ratedOtherUser[$i] = Rating::where('id_hotel', $idHotel)->get();
            $ratedOtherUserCount[$i] = Rating::where('id_hotel', $idHotel)->get()->count();
        }

        $currentRate = [];
        for ($i = 0; i<count($ratedOtherUser); $i++) {
            $rate = $ratedOtherUser[$i];
            $rating = [];
            for ($j = 0; $j<count($rate); $j++){
                $rating[$j] = $rate[$j]->angka_rating;
            }
            $currentRate[$i] = $rating;
        }

        for($i=0; $i<count($currentRate); $i++) {
            $rt = $currentRate[$i];
            for($j=0; $j<count($rt); $j++) {
                $currentRate[i][j];
            }
        }

        return \json_encode($currentRate);
    }
}
