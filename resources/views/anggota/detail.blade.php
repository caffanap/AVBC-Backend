@extends('layouts.admin')
@section('title', 'Daftar Anggota')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Anggota</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table">
                                <tr>
                                    <td>NIM</td>
                                    <td>{{ $user->pengguna_detail->nim }}</td>
                                </tr>
                                <tr>
                                    <td>Angkatan</td>
                                    <td>{{ $user->pengguna_detail->angkatan ? $user->pengguna_detail->angkatan->nama : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Jurusan</td>
                                    <td>{{ $user->pengguna_detail->jurusan ? $user->pengguna_detail->jurusan->nama : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>No Telpon</td>
                                    <td>{{ $user->no_telp }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>{{ $user->pengguna_detail->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>{{ $user->pengguna_detail->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Posisi</td>
                                    <td>{{ $user->pengguna_detail->posisi ? $user->pengguna_detail->posisi->posisi : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Prestasi</td>
                                    <td>{{ $user->pengguna_detail->prestasi }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>
                                        <form action="{{ url('admin/anggota/update-jabatan') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <select name="role" class="form-control" id="role">
                                                <option {{ $user->pengguna_detail->role == 'ketua' ? 'selected' : '' }} value="ketua">Ketua</option>
                                                <option {{ $user->pengguna_detail->role == 'wakil' ? 'selected' : '' }} value="wakil">Wakil</option>
                                                <option {{ $user->pengguna_detail->role == 'sekretaris' ? 'selected' : '' }} value="sekretaris">Sekretaris</option>
                                                <option {{ $user->pengguna_detail->role == 'bendahara' ? 'selected' : '' }} value="bendahara">Bendahara</option>
                                                <option {{ $user->pengguna_detail->role == 'member' ? 'selected' : '' }} value="member">Member</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary mt-2">
                                                Update Jabatan
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </section>


@endsection
