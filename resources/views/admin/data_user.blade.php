@extends('admin.master')
@section('title_bar', 'DataUser')
@section('title', 'Data User') 
@section('title_breadcrumb', 'Data User')
@section('active3', 'active')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <a href="/datahotel/tambah"><button type="button"  style="width: 10%" class="btn btn-block btn-success">Tambah</button></a>
                    <br>
                    <thead>
                    <tr>
                      <th style="width: 5px">No</th>
                      <th style="width: 250px">Nama Hotel</th>
                      <th style="width: 150px">Jenis Hotel</th>
                      <th style="width: 400px">Alamat</th>
                      <th style="width: 100px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($hotel as $h)
                    <tr>
                      <td>{{ $h->id_hotel }}</td>
                      <td>{{ $h->nama_hotel }}</td>
                      <td>{{ $h->jenis_hotel }}</td>
                      <td>{{ $h->kota }}</td>
                      <td>
                        <a href="/datahotel/edit/{{ $h->id_hotel }}"><button type="button" class="btn btn-block btn-success">Edit</button></a>
                        <a href="/datahotel/hapus/{{ $h->id_hotel }}"><button style="margin-top: 5%" type="button"  class="btn btn-block btn-danger">Hapus</button></a>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Hotel</th>
                      <th>Jenis Hotel</th>
                      <th>Alamat</th>
                      <th>Aksi</th>
                    </tr>
                    </tfoot>
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