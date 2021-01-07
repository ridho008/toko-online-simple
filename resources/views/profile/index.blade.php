@extends('layouts.app')

@section('title', 'Profile Saya')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light mb-3">
              <div class="card-header">Profile Saya</div>
              <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <th>:</th>
                        <th>{{ $user->name }}</th>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <th>:</th>
                        <th>{{ $user->email }}</th>
                    </tr>
                    <tr>
                        <th>No.Hp</th>
                        <th>:</th>
                        <th>
                            @if(empty($user->no_telp))
                            <span class="badge badge-warning">No Telepon Belum Diisi</span>
                            @else
                            {{ $user->no_telp }}
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <th>
                            @if(empty($user->alamat))
                            <span class="badge badge-warning">Alamat Belum Diisi</span>
                            @else
                            {{ $user->alamat }}
                            @endif
                        </th>
                    </tr>
                </table>
              </div>
            </div>
            <div class="card">
                <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form method="POST" action="{{ url('simpanProfile') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">{{ __('Nama') }}</label>
                                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ (old('nama')) ? old('nama') : $user->name }}" autofocus>

                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ (old('email')) ? old('email') : $user->email }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                    <span class="muted text-danger" role="alert">jika password dikosongkan, password tetap yang lama.</span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <label for="no_hp" class="col-form-label">{{ __('No.Hp') }}</label>
                                    <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ (old('no_hp')) ? old('no_hp') : $user->no_telp }}">

                                    @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="col-form-label">{{ __('Alamat') }}</label>
                                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ (old('alamat')) ? old('alamat') : $user->alamat }}">

                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
