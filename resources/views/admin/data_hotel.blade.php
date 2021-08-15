@extends('admin.master')
@section('title_bar', 'DataHotel')
@section('title', 'Data Hotel') 
@section('title_breadcrumb', 'Data Hotel')
@section('active3', 'active')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form action="/datahotel/search" method="GET" role="search">
                    {{ csrf_field() }}

                  <table id="example2" class="table table-bordered table-hover">
                    <div class="row">
                    <div class="col-6">
                    <input type="search" class="form-control form-control-md" name="cari" placeholder="Ketik nama hotel yang ingin dicari..." >
                    </div>
                    <div class="col-6">
                    <button type="submit" class="btn btn-md btn-default">
                      <i class="fa fa-search"></i>
                  </button>
                </div>
                  </div><br>  </form>          
                    <a href="/datahotel/tambah"><button type="button"  style="width: 10%" class="btn btn-block btn-success">Tambah</button></a>
                    <br>
                    <thead>
                    <tr>
                      <th style="width: 5px">No</th>
                      <th>Gambar</th>
                      <th style="width: 200px">Nama Hotel</th>
                      <th style="width: 100px">Jenis Hotel</th>
                      <th style="width: 200px">Alamat</th>
                      <th style="width: 500px">Deskripsi</th>
                      <th style="width: 100px">Kontak</th>
                      <th style="width: 100px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($hotel as $key => $h)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td><img width="100px" src="{{Storage::url($h->gambar_hotel)}}"></td>
                      <td>{{ $h->nama_hotel }}</td>
                      <td>{{ $h->jenis_hotel }}</td>
                      <td>{{ $h->alamat }}</td>
                      <td>{{ $h->deskripsi }}</td>
                      <td>{{ $h->kontak }}</td>
                      <td>
                        <a href="/datahotel/edit/{{ $h->id_hotel }}"><button type="button" class="btn btn-block btn-success">Edit</button></a>
                        <a href="/datahotel/hapus/{{ $h->id_hotel }}"><button style="margin-top: 5%" type="button"  class="btn btn-block btn-danger">Hapus</button></a>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
            @push('style')
    
            @endpush
            
            @push('script') 
                <script>
                    
                </script>    
            @endpush
@endsection