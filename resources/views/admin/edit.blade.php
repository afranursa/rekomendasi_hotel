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
                <form action="/datahotel/update" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_hotel" value="{{ $p->id_hotel }}"> <br/>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama Hotel</label>
                        <input type="text" class="form-control" name="nama_hotel" value="{{ $p->nama_hotel }}" placeholder="Nama Hotel">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Hotel</label>
                        <input type="text" class="form-control" name="jenis_hotel" value="{{ $p->jenis_hotel }}" placeholder="Jenis Hotel">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kota</label>
                        <input type="text" class="form-control" name="kota" value="{{ $p->kota }}" placeholder="Kota">
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
                <script>
                    
                </script>    
            @endpush
@endsection