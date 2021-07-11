<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HotelController extends Controller
{
    public function index()
    {
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
    	$hotel = DB::table('hotel')->get();

    	// mengirim data pegawai ke view index
    	return view('admin/data_hotel',['hotel' => $hotel]);

    }

    public function tambah()
    {
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
    	$hotel = DB::table('hotel')->get();

    	// mengirim data pegawai ke view index
    	return view('admin/tambah');

    }

    public function store(Request $request)
	{
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
		// insert data ke table pegawai
		$lastid = DB::table('hotel')->latest('id_hotel')->get();
		$idstring = intval($lastid[0]->id_hotel);
		DB::table('hotel')->insert([
			'id_hotel' => $idstring+1,
			'nama_hotel' => $request->nama_hotel,
			'jenis_hotel' => $request->jenis_hotel,
			'kota' => $request->kota
		]);
		// alihkan halaman ke halaman pegawai
		return redirect('/datahotel');
	}

	public function edit($id_hotel)
	{
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
		// mengambil data pegawai berdasarkan id yang dipilih
		$hotel = DB::table('hotel')->where('id_hotel',$id_hotel)->get();
		// passing data pegawai yang didapat ke view edit.blade.php
		return view('admin/edit',['hotel' => $hotel]);
	
	}

	public function update(Request $request)
	{
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
		// update data pegawai
		DB::table('hotel')->where('id_hotel',$request->id_hotel)->update([
			'nama_hotel' => $request->nama_hotel,
			'jenis_hotel' => $request->jenis_hotel,
			'kota' => $request->kota
		]);
		// alihkan halaman ke halaman pegawai
		return redirect('/datahotel');
	}

	public function hapus($id_hotel)
	{
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
		// update data pegawai
		DB::table('hotel')->where('id_hotel',$id_hotel)->delete();
		// alihkan halaman ke halaman pegawai
		return redirect('/datahotel');
	}

	public function search(Request $request)
	{
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
		// menangkap data pencarian
		$cari = $request->cari;
 
    		// mengambil data dari table pegawai sesuai pencarian data
		$hotel = DB::table('hotel')
		->where('nama_hotel','like',"%".$cari."%")
		->paginate();
 
    		// mengirim data pegawai ke view index
		return view('admin/data_hotel',['hotel' => $hotel]);
 
	}
}
