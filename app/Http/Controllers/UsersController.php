<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Models\Users;
use App\Models\Hotel;
use App\Models\Rating;
use Exception;
use Illuminate\Support\Facades\Mail;
use DB;
class UsersController extends Controller
{
	public function regisIndex(){
	    return view('user.registrasi');
	}

    public function regisSave(Request $request){
        // dd($request->all());
        $user = new Users();
        $user->nama_user = $request->nama_user;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->jk = $request->jk;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->save();
    }

	public function loginIndex() {
        if(Session::get('loginUser')){
            return redirect('/user/home');
        }

        return view('user.login');
    }

	public function loginProcess(Request $request){
        $username = $request->username;
        $password = $request->password;

        $user = Users::where('username', $username)->first();

        if($user){
            if(Hash::check($password, $user->password)){
                Session::put('loginUser', Hash::make($user->username));
                Session::put('usernameuser', $user->username);
				Session::put('nameUser', $user->nama_user);
                return redirect('/user/home')->with('alert-success', 'Login berhasil!');
            }else{
                return redirect('/user/login')->with('alert-danger', 'Password salah!');
            }
        }else{
            return redirect('/user/login')->with('alert-danger', 'Username salah!');
        }
    }

	public function logout(){
        if(!Session::get('loginUser')){
            return redirect('/user/login');
        }

        Session::forget('loginUser');
        Session::forget('usernameuser');
        Session::forget('namaUser');

		return redirect('/user/login')->with('alert-success', 'Logout berhasil!');
    }

    public function landing(){
        if(Session::get('loginUser')){
            return redirect('/user/home');
        }

        return view('user.landing_page');
    }

	public function home(){
        if(!Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }

		$nama = Session::get('nameUser');
        $username = Session::get('usernameuser');
        return view('user.home', compact('nama', 'username'));
    }

    public function detailHotel($idHotel){
        if(!Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }

        $hotel = Hotel::where('id_hotel', $idHotel)->first();
        return \view('user.detail_hotel', \compact('hotel'));
    }

    public function riwayatRating(){
        if(!Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }

        $username = Session::get('usernameuser');
        return view('user.riwayat', compact('username'));
    }

    public function rating(){
        if(!Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }

        $username = Session::get('usernameuser');
        $nama = Session::get('nameUser');
        $hotel = Hotel::get();
        return view('user.rating', compact('username', 'hotel', 'nama'));
    }

    public function addRating(Request $request) {
        if(!Session::get('loginUser')){
            return redirect('/user/login');
        }

        $this->validate($request, [
            'hotel' => '|required'
        ]);

        $username = $request->username;
        $idHotel = $request->hotel;
        $letak = intval($request->letak);
        $harga = intval($request->harga);
        $kenyamanan = intval($request->kenyamanan);
        $fasilitas = intval($request->fasilitas);

        $angkaRating = ($letak + $harga + $kenyamanan + $fasilitas) / 4;

        $rated = Rating::where('username', $username)->where('id_hotel', $idHotel)->get();
        if($rated->count() > 0){
            return \redirect()->back()->with('alert-danger', 'Anda sudah pernah merating hotel!');
        }

        $rating = new Rating();
        $rating->id_rating = uniqid();
        $rating->username = $username;
        $rating->id_hotel = $idHotel;
        $rating->letak = $letak;
        $rating->harga = $harga;
        $rating->fasilitas = $fasilitas;
        $rating->kenyamanan = $kenyamanan;
        $rating->angka_rating = $angkaRating;
        $rating->save();
        return \redirect()->back()->with('alert-success', 'Berhasil menambah rating!');
    }

    public function index()
    {
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
        $user = DB::table('users')->get();

    	// mengirim data pegawai ke view index
    	return view('admin/data_user',['users' => $user]);
    }

    public function search(Request $request)
	{
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
		// menangkap data pencarian
		$cari = $request->cari;

    		// mengambil data dari table pegawai sesuai pencarian data
		$user = DB::table('users')
		->where('nama_user','like',"%".$cari."%")
		->paginate();

    		// mengirim data pegawai ke view index
		return view('admin/data_user',['users' => $user]);

	}
}
