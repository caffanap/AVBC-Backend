@extends('layouts.admin')
@section('title', 'Master Pendaftaran')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Master Pendaftaran</h1>
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
                                    <label for="angkatan_id" class="col-sm-12 control-label">Angkatan</label>
                                    <div class="col-sm-12">
                                        <select name="angkatan_id" id="angkatan_id" class="form-control">
                                            <option selected disabled>-- Pilih Angkatan --</option>
                                            @foreach ($angkatan as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="judul" class="col-sm-12 control-label">Judul Pendaftaran</label>
                                    <div class="col-sm-12">
                                        <input type="text" autofocus class="form-control" id="judul" name="judul" value=""
                                            required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi" class="col-sm-12 control-label">Deskripsi</label>
                                    <div class="col-sm-12">
                                        <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_buka" class="col-sm-12 control-label">Tanggal Buka</label>
                                    <div class="col-sm-12">
                                        <input type="date" autofocus class="form-control" id="tanggal_buka"
                                            name="tanggal_buka" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_tutup" class="col-sm-12 control-label">Tanggal Tutup</label>
                                    <div class="col-sm-12">
                                        <input type="date" autofocus class="form-control" id="tanggal_tutup"
                                            name="tanggal_tutup" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="link_wa" class="col-sm-12 control-label">Link WA</label>
                                    <div class="col-sm-12">
                                        <input type="text" autofocus class="form-control" id="link_wa" name="link_wa"
                                            value="" required>
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
                            <h3 class="card-title">Data Master Pendaftaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <a href="javascript:void(0)" class="btn btn-primary" id="tombol-tambah">
                                <i class="fa fa-plus mr-1"></i> Tambah
                            </a>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Angkatan</th>
                                        <th>Judul Pendaftaran</th>
                                        <th>Tanggal Buka</th>
                                        <th>Tanggal Tutup</th>
                                        <th>Link WA</th>
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
    <script src="{{ url('assets/adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <!-- iziToast -->
    <script src="{{ url('assets/js/iziToast.js') }}"></script>


    <script>
        // csrf token
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        // button tambah
        $('#tombol-tambah').click(function() {
            $('#button-simpan').val("create-post");
            $('#id').val('');
            $('#form-tambah-edit').trigger("reset");
            $('#modal-judul').html("Tambah Pendaftaran");
            $('#tambah-edit-modal').modal('show');
        })

        $('#tambah-edit-modal').on('shown.bs.modal', function() {
            $("#judul").focus();
        })

        // form tambah
        if ($("#form-tambah-edit").length > 0) {
            $("#form-tambah-edit").validate({
                submitHandler: function(form) {
                    var actionType = $('#tombol-simpan').val();
                    $('#tombol-simpan').html('Sending..');
                    $.ajax({
                        data: $('#form-tambah-edit').serialize(),
                        url: "{{ route('admin.pendaftaran.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $('#form-tambah-edit').trigger("reset");
                            $('#tambah-edit-modal').modal('hide');
                            $('#tombol-simpan').html('Simpan');
                            var oTable = $('#example1').dataTable();
                            oTable.fnDraw(false);
                            iziToast.success({
                                title: 'Data Berhasil Disimpan',
                                position: 'bottomRight'
                            });
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('#tombol-simpan').html('Simpan');
                        }
                    });
                }
            })
        }

        // data edit
        $(document).on('click', '.edit-post', function() {
            var data_id = $(this).data('id');
            $.get('pendaftaran/' + data_id + '/edit', function(data) {
                $('#modal-judul').html("Edit Pendaftaran");
                $('#tombol-simpan').val("edit-post");
                $('#tambah-edit-modal').modal('show');
                //set value                
                $('#id').val(data.id);
                $('#judul').val(data.judul);
                $('#tanggal_buka').val(data.tanggal_buka);
                $('#tanggal_tutup').val(data.tanggal_tutup);
                $('#link_wa').val(data.link_wa);
                $('#angkatan_id').val(data.angkatan_id);
                $('#deskripsi').val(data.deskripsi);
            })
        });

        //delete
        $(document).on('click', '.delete', function() {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });

        $('#tombol-hapus').click(function() {
            $.ajax({
                url: "pendaftaran/" + dataId,
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
                "columnDefs": [
                    // {
                    //     "width": "30%",
                    //     "targets": 2
                    // }
                ],

                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.pendaftaran.index') }}",
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
                        data: "angkatan.nama",
                        name: "angkatan.nama",

                    },
                    {
                        data: "judul",
                        name: "judul",

                    },
                    {
                        data: "tanggal_buka",
                        name: "tanggal_buka",
                        render: function(data) {
                            let today = new Date(data);
                            const yyyy = today.getFullYear();
                            let mm = today.getMonth() + 1; // Months start at 0!
                            let dd = today.getDate();

                            if (dd < 10) dd = '0' + dd;
                            if (mm < 10) mm = '0' + mm;

                            today = dd + '/' + mm + '/' + yyyy;
                            return today
                        }

                    },
                    {
                        data: "tanggal_tutup",
                        name: "tanggal_tutup",
                        render: function(data) {
                            let today = new Date(data);
                            const yyyy = today.getFullYear();
                            let mm = today.getMonth() + 1; // Months start at 0!
                            let dd = today.getDate();

                            if (dd < 10) dd = '0' + dd;
                            if (mm < 10) mm = '0' + mm;

                            today = dd + '/' + mm + '/' + yyyy;
                            return today
                        }
                    },
                    {
                        data: "link_wa",
                        name: "link_wa",
                        render: function(data) {
                            return "<a target='_blank' class='btn btn-success' href='" + data +
                                "'> <i class='fab fa-whatsapp'> </i> </a>"
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
