<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public function index()
    {
    	$hotel = DB::table('hotel')->get();

    	// mengirim data pegawai ke view index
    	return view('admin/data_hotel',['hotel' => $hotel]);

    }
    public function tambah()
    {
    	$hotel = DB::table('hotel')->get();

    	// mengirim data pegawai ke view index
    	return view('admin/tambah');

    }
    public function store(Request $request)
{
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
	// mengambil data pegawai berdasarkan id yang dipilih
	$hotel = DB::table('hotel')->where('id_hotel',$id_hotel)->get();
	// passing data pegawai yang didapat ke view edit.blade.php
	return view('admin/edit',['hotel' => $hotel]);
 
}
public function update(Request $request)
{
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
	// update data pegawai
	DB::table('hotel')->where('id_hotel',$id_hotel)->delete();
	// alihkan halaman ke halaman pegawai
	return redirect('/datahotel');
}
}
