@extends('layouts.app')

@section('title', 'Detail Barang')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $barang->nama_barang }}</h4>
                    <a href="{{ url('home') }}" class="btn btn-primary btn-sm float-right">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('uploads') }}/{{ $barang->gambar }}" alt="{{ $barang->nama_barang }}" class="img-thumbnail">
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>:</th>
                                    <th>{{ $barang->nama_barang }}</th>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <th>:</th>
                                    <th>{{ number_format($barang->harga,0,',','.') }}</th>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <th>:</th>
                                    <th>{{ $barang->stok }}</th>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>:</th>
                                    <th>{{ $barang->keterangan }}</th>
                                </tr>
                                <form action="{{ url('pesan') }}/{{ $barang->id }}" method="post">
                                    @csrf
                                <tr>
                                    <th>Jumlah Pesan</th>
                                    <th>:</th>
                                    <td>
                                        <input type="text" name="jumlah_pesan" size="4" min="0" class="form-control">
                                        <button type="submit" class="btn-sm btn btn-primary">Masukan Keranjang</button>
                                    </td>
                                </tr>
                                </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
