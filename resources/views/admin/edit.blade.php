@extends('admin.master')
@section('title_bar', 'DataHotel')
@section('title', 'DataHotel') 
@section('title_breadcrumb', 'DataHotel')
@section('active3', 'active')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                @foreach($hotel as $p)
                <form action="/datahotel/update" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_hotel" value="{{ $p->id_hotel }}"> <br/>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama Hotel</label>
                        <input type="text" class="form-control" name="nama_hotel" value="{{ $p->nama_hotel }}" placeholder="Nama Hotel">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Hotel</label>
                        <select class="custom-select" name="jenis_hotel">
                          @if ($p->jenis_hotel == 'Melati I')
                          <option value="Melati I" selected>Melati I</option>
                          <option value="Melati II">Melati II</option>
                          <option value="Melati III">Melati III</option>
                          <option value="Bintang 1">Bintang 1</option>
                          <option value="Bintang 2">Bintang 2</option>
                          <option value="Bintang 3">Bintang 3</option>
                          <option value="Bintang 4">Bintang 4</option>
                          <option value="Bintang 5">Bintang 5</option>
                          @elseif($p->jenis_hotel == 'Melati II')
                          <option value="Melati II" selected>Melati II</option>
                          <option value="Melati I">Melati I</option>
                          <option value="Melati III">Melati III</option>
                          <option value="Bintang 1">Bintang 1</option>
                          <option value="Bintang 2">Bintang 2</option>
                          <option value="Bintang 3">Bintang 3</option>
                          <option value="Bintang 4">Bintang 4</option>
                          <option value="Bintang 5">Bintang 5</option>
                          @elseif($p->jenis_hotel == 'Melati III')
                          <option value="Melati III" selected>Melati III</option>
                          <option value="Melati I">Melati I</option>
                          <option value="Melati II">Melati II</option>
                          <option value="Bintang 1">Bintang 1</option>
                          <option value="Bintang 2">Bintang 2</option>
                          <option value="Bintang 3">Bintang 3</option>
                          <option value="Bintang 4">Bintang 4</option>
                          <option value="Bintang 5">Bintang 5</option>
                          @elseif($p->jenis_hotel == 'Bintang 1')
                          <option value="Bintang 1" selected>Bintang 1</option>
                          <option value="Melati I">Melati I</option>
                          <option value="Melati II">Melati II</option>
                          <option value="Melati II">Melati III</option>
                          <option value="Bintang 2">Bintang 2</option>
                          <option value="Bintang 3">Bintang 3</option>
                          <option value="Bintang 4">Bintang 4</option>
                          <option value="Bintang 5">Bintang 5</option>
                          @elseif($p->jenis_hotel == 'Bintang 2')
                          <option value="Bintang 2" selected>Bintang 2</option>
                          <option value="Melati I">Melati I</option>
                          <option value="Melati II">Melati II</option>
                          <option value="Melati II">Melati III</option>
                          <option value="Bintang 3">Bintang 1</option>
                          <option value="Bintang 3">Bintang 3</option>
                          <option value="Bintang 4">Bintang 4</option>
                          <option value="Bintang 5">Bintang 5</option>
                          @elseif($p->jenis_hotel == 'Bintang 3')
                          <option value="Bintang 3" selected>Bintang 3</option>
                          <option value="Melati I">Melati I</option>
                          <option value="Melati II">Melati II</option>
                          <option value="Melati III">Melati III</option>
                          <option value="Bintang 1">Bintang 1</option>
                          <option value="Bintang 2">Bintang 2</option>
                          <option value="Bintang 4">Bintang 4</option>
                          <option value="Bintang 5">Bintang 5</option>
                          @elseif($p->jenis_hotel == 'Bintang 4')
                          <option value="Bintang 4" selected>Bintang 4</option>
                          <option value="Melati I">Melati I</option>
                          <option value="Melati II">Melati II</option>
                          <option value="Melati III">Melati III</option>
                          <option value="Bintang 1">Bintang 1</option>
                          <option value="Bintang 2">Bintang 2</option>
                          <option value="Bintang 3">Bintang 3</option>
                          <option value="Bintang 5">Bintang 5</option>
                          @elseif($p->jenis_hotel == 'Bintang 5')
                          <option value="Bintang 5" selected>Bintang 5</option>
                          <option value="Melati I">Melati I</option>
                          <option value="Melati II">Melati II</option>
                          <option value="Melati III">Melati III</option>
                          <option value="Bintang 1">Bintang 1</option>
                          <option value="Bintang 2">Bintang 2</option>
                          <option value="Bintang 3">Bintang 3</option>
                          <option value="Bintang 4">Bintang 4</option>
                          @else
                          <option value="Melati I">Melati I</option>
                          <option value="Melati II">Melati II</option>
                          <option value="Melati III">Melati III</option>
                          <option value="Bintang 1">Bintang 1</option>
                          <option value="Bintang 2">Bintang 2</option>
                          <option value="Bintang 3">Bintang 3</option>
                          <option value="Bintang 4">Bintang 4</option>
                          <option value="Bintang 5">Bintang 5</option>
                          @endif

                        </select>
                        </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="{{ $p->alamat }}" placeholder="Alamat">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kota</label>
                        <input type="text" class="form-control" name="kota" value="{{ $p->kota }}" placeholder="Kota">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Gambar Hotel</label>
                        <input type="file" class="form-control" name="gambar_hotel" placeholder="Gambar Hotel">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Deskripsi Hotel</label>
                        <input type="text" class="form-control" name="deskripsi" value="{{ $p->deskripsi }}" placeholder="Deskripsi Hotel">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kontak</label>
                        <input type="text" class="form-control" name="kontak" value="{{ $p->kontak }}" placeholder="Kontak">
                      </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                  @endforeach

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

           
            @endpush
@endsection