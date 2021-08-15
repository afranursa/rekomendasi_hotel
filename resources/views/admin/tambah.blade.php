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

                <form action="/datahotel/store" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama Hotel</label>
                        <input type="text" class="form-control" name="nama_hotel" placeholder="Nama Hotel">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Hotel</label>
                        <select class="custom-select" name="jenis_hotel">
                          <option selected>Jenis Hotel</option>
                          <option value="Melati I">Melati I</option>
                          <option value="Melati II">Melati II</option>
                          <option value="Melati III">Melati III</option>
                          <option value="Bintang 1">Bintang 1</option>
                          <option value="Bintang 2">Bintang 2</option>
                          <option value="Bintang 3">Bintang 3</option>
                          <option value="Bintang 4">Bintang 4</option>
                          <option value="Bintang 5">Bintang 5</option>
                        </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Alamat</label>
                          <input type="text" class="form-control" name="alamat" placeholder="Alamat">
                        </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kota</label>
                        <input type="text" class="form-control" name="kota" placeholder="Kota">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Gambar Hotel</label>
                        <input type="file" class="form-control" name="gambar_hotel" placeholder="Gambar Hotel">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Deskripsi Hotel</label>
                        <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi Hotel">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kontak</label>
                        <input type="text" class="form-control" name="kontak" placeholder="Kontak">
                      </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
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