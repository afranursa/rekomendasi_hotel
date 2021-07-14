<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Model\Users;
use Exception;
use Illuminate\Support\Facades\Mail;
use DB;
class UsersController extends Controller
{
    public function loginIndex() {
        return view('admin.login');
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
