@extends('layouts.app')

@section('title', 'Toko Batik Indonesia')
@section('content')
<div class="container">
    <h3 class="text-primary">Selamat Datang Di Aplikasi Toko Belanja Laravel 6</h3>
    <div class="row justify-content-center">
        @foreach($barangs as $b)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
              <img src="{{ asset('uploads') }}/{{ $b->gambar }}" class="card-img-top" alt="{{ $b->nama_barang }}">
              <div class="card-body">
                <h5 class="card-title">{{ $b->nama_barang }}</h5>
                <p class="card-text"><strong>Harga</strong> Rp.{{ number_format($b->harga,0,',','.') }}
                    <hr>
                    <strong>{{ $b->keterangan }}</strong>
                </p>
                <a href="{{ url('pesan') }}/{{ $b->id }}" class="btn btn-primary">Pesan</a>
              </div>
            </div>
        </div>
        @endforeach;
    </div>
</div>
@endsection
