@extends('layouts.admin.admin')

@section('title')
    Data Jadwal Mata Pelajaran
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 text-gray-800">Jadwal Mata Pelajaran</h1>

        <a href="/jadwalmapel/exportexcel" class="btn btn-success btn-sm mb-3 px-3 py-2">Laporan Excel</a>
        <a href="/jadwalmapel/exportpdf" class="btn btn-danger btn-sm mb-3 px-3 py-2">Laporan PDF</a>
        <button type="button" class="btn btn-primary btn-sm mb-3 px-3 py-2" data-toggle="modal" data-target="#exampleModal">
          Import Data
        </button>
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-body">
            <a href="/jadwalmapel/create" class="btn btn-primary btn-sm mb-3 px-3 py-2">
              <i class="fas fa-plus mr-2"></i>
              Tambah Jadwal
            </a>
            <div class="table-responsive">
              <table class="table table-striped table-sm table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Guru</th>
                    <th>Kelas</th>
                    <th>Unit</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->guru->nama}}</td>
                      <td>{{$item->kelas}}</td>
                      <td>{{$item->unit}}</td>
                      <td>
                          <a href="/jadwalmapel/{{$item->id}}/edit" class="btn btn-circle btn-sm btn-warning">
                              <i class="fa fa-edit"></i>
                          </a>
                          <a href="#" class="btn btn-sm btn-circle btn-danger delete" jmapel-id="{{$item->id}}">
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Data Jadwal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('importexceljadwalmapel')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <input type="file" class="form-control-file" name="file">
              </div>
              <button type="submit" class="btn btn-primary float-right">Save changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('prepend-style')
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endpush

@push('addon-script')
      <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>
        $(document).ready(function() {
          $('#dataTable').DataTable();
        } );
      </script>
      <script>
        $('.delete').click(function(){
          // var $jmapelnama = $(this).attr('jmapel-nama');
          var $jmapelid = $(this).attr('jmapel-id');
          swal({
            title: "Apakah Kamu Yakin",
            text: "Data Jadwal  Mapel Akan Terhapus",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
              console.log(willDelete);
            if (willDelete) {
              window.location = "jadwalmapel/"+$jmapelid+"/destroy";
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