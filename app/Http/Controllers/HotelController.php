<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
    	$hotel = DB::table('hotel')->get();

    	// mengirim data hotel ke view index
    	return view('admin/data_hotel',['hotel' => $hotel]);

    }

    public function tambah()
    {
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
		//jenis hotel
		$hotel = Hotel::get();
    	// mengirim data pegawai ke view index
    	return view('admin/tambah');

    }

    public function store(Request $request)
	{
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
		// validasi upload gambar
		$this->validate($request, [
			'gambar_hotel' => 'required|file|max:7000'
		]);
		$path = Storage::putfile('public/images', $request->file('gambar_hotel'));

		// insert data ke table pegawai
		$lastid = DB::table('hotel')->latest('id_hotel')->get();
		$idstring = intval($lastid[0]->id_hotel);
		DB::table('hotel')->insert([
			'id_hotel' => $idstring+1,
			'nama_hotel' => $request->nama_hotel,
			'jenis_hotel' => $request->jenis_hotel,
			'alamat' => $request->alamat,
			'kota' => $request->kota,
			'gambar_hotel' => $path,
			'deskripsi' => $request->deskripsi,
			'kontak' => $request->kontak
		]);
		// alihkan halaman ke halaman pegawai
		return redirect('/datahotel')->with('alert-success', 'Hotel berhasil ditambahkan!');
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

		$path = '';

		if($request->gambar_hotel){
			$this->validate($request, [
				'gambar_hotel' => 'required|file|max:7000'
			]);
			$path = Storage::putfile('public/images', $request->file('gambar_hotel'));
		}else {
			$hotel = Hotel::find($request->id_hotel);
			$path = $hotel->gambar_hotel;
		}
		// update data hotel
		DB::table('hotel')->where('id_hotel',$request->id_hotel)->update([
			'nama_hotel' => $request->nama_hotel,
			'jenis_hotel' => $request->jenis_hotel,
			'alamat' => $request->alamat,
			'kota' => $request->kota,
			'gambar_hotel' => $path,
			'deskripsi' => $request->deskripsi,
			'kontak' => $request->kontak
		]);
		// alihkan halaman ke halaman data hotel
		return redirect('/datahotel')->with('alert-success', 'Hotel berhasil diubah!');;
	}

	public function hapus($id_hotel)
	{
		if(!Session::get('loginAdmin')){
            return redirect('/admin/login');
        }
		// update data pegawai
		DB::table('hotel')->where('id_hotel',$id_hotel)->delete();
		// alihkan halaman ke halaman pegawai
		return redirect('/datahotel')->with('alert-success', 'Hotel berhasil dihapus!');;
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
