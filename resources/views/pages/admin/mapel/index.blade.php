@extends('layouts.admin.admin')

@section('title')
    Data Mata Pelajaran
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Mata Pelajaran</h1>
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-body">
            <a href="{{route('mapel.create')}}" class="btn btn-primary btn-sm mb-3 px-3 py-2">
              <i class="fas fa-plus mr-2"></i>
              Tambah Data
            </a>
            <div class="table-responsive">
              <table class="table table-striped table-sm table-bordered text-center" id="tableMapel" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Makul</th>
                    <th>Nama Makul</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->kode_mapel}}</td>
                    <td>{{$item->nama_mapel}}</td>
                    <td>
                        <a href="{{route('mapel.edit', $item->id)}}" class="btn btn-circle btn-sm btn-warning">
                            <i class="fa fa-edit"></i>
                        </a>
                        {{-- <form action="{{route('mapel.destroy', $item->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-circle btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form> --}}
                        <a href="#" class="btn btn-sm btn-circle btn-danger delete" mapel-nama="{{$item->nama}}" mapel-id="{{$item->id}}">
                          <i class="fa fa-trash"></i>
                        </a>
                    </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

    </div>
      <!-- /.container-fluid -->
@endsection

@push('prepend-style')
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endpush

@push('addon-script')
      <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
      <script>
        $(document).ready(function() {
          $('#tableMapel').DataTable();
        } );
      </script>
      <script>
        $('.delete').click(function(){
          var $mapelid = $(this).attr('mapel-id');
          swal({
            title: "Apakah Kamu Yakin",
            text: "Data Mapel Akan Terhapus",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
              console.log(willDelete);
            if (willDelete) {
              window.location = "mapel/"+$mapelid+"/hapus";
            } else {
              swal("Data Tidak Terhapus");
            }
          });
        })
      </script>
      <script>
        @if (Session::has('status'))
          toastr.success("{{Session::get('status')}}", "Trimakasih")
        @endif
      </script>
@endpush