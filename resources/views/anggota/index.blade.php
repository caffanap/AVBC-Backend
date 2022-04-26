@extends('layouts.admin')
@section('title', 'Daftar Anggota')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Anggota</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- modal add update -->
    <div class="modal fade" id="tambah-edit-modal" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-judul"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12">

                                <input type="hidden" name="id" id="id">

                                <div class="form-group">
                                    <label for="nama" class="col-sm-12 control-label">Nama</label>
                                    <div class="col-sm-12">
                                        <input type="text" autofocus class="form-control" id="nama" name="nama" value=""
                                            required>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-offset-2 col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan"
                                    value="create">Simpan
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin menghapus data tersebut?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Daftar Anggota</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Angkatan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@section('script')
    <!-- jquery validated -->
    <script src="{{url('assets/adminlte/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

    <!-- iziToast -->
    <script src="{{url('assets/js/iziToast.js')}}"></script>


    <script>
        // csrf token
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        //delete
        $(document).on('click', '.delete', function() {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });

        $('#tombol-hapus').click(function() {
            $.ajax({
                url: "anggota/" + dataId,
                type: 'delete',
                beforeSend: function() {
                    $('#tombol-hapus').text('Hapus Data');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#konfirmasi-modal').modal('hide');
                        var oTable = $('#example1').dataTable();
                        oTable.fnDraw(false);
                    });
                    iziToast.warning({
                        title: 'Data Berhasil Dihapus',
                        position: 'bottomRight'
                    });
                }
            })
        });


        // datatables
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "language": {
                    "processing": "<span class='fa-2x'><i class='fas fa-spinner fa-spin'></i></span>"
                },
                // buttons: ["copy", "excel", "pdf"],
                "columnDefs": [{
                    "width": "40%",
                    "targets": 2
                }],

                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.anggota.index') }}",
                    type: 'GET',
                },

                columns: [{
                        data: "id",
                        name: "id",
                        "render": function(data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: "pengguna_detail",
                        name: "pengguna_detail.nim",
                        "render": function (data) {
                            if (data) {
                                return data.nim
                            }else{
                                return null
                            }
                        }
                    },
                    {
                        data: "name",
                        name: "name",

                    },
                    {
                        data: "pengguna_detail",
                        name: "pengguna_detail.angkatan.nama",
                        "render": function (data) {
                            if (data) {
                                return data.angkatan.nama
                            }else{
                                return null
                            }
                        }
                    },
                    {
                        data: "action",
                        name: "action"
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

@endsection
