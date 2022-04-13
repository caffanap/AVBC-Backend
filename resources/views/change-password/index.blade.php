@extends('layouts.admin')
@section('title', 'Ubah Password')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Password</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (isset($success))
                            <div class="alert alert-success">
                                {{ $success }}
                            </div>
                        @endif
                        <form action="{{ route('admin.process-change-password') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="password-lama">Password Lama</label>
                                <input type="password" id="password-lama" name="password_lama" class="form-control"
                                    placeholder="Masukan password lama anda">
                            </div>
                            <div class="form-group">
                                <label for="password-baru">Password Baru</label>
                                <input type="password" id="password-baru" name="password_baru" class="form-control"
                                    placeholder="Masukan password baru anda">
                            </div>
                            <div class="form-group">
                                <label for="konfirmasi-password-baru">Konfirmasi Password Baru</label>
                                <input type="password" id="konfirmasi-password-baru" name="konfirmasi_password_baru"
                                    class="form-control" placeholder="Konfirmasi password baru anda">
                            </div>
                            <button class="btn btn-success" type="submit">
                                Perbarui Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Password di ubah</h4>
                        <p class="text-primary">
                            {{ $user->updated_at->diffForHumans() ?? '' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
