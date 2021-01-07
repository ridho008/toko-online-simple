@extends('layouts.app')

@section('title', 'Checkout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Checkout</h4>
                    <a href="{{ url('home') }}" class="btn btn-primary btn-sm float-right">Kembali</a>
                </div>
                <div class="card-body">
                    @if(!empty($pesanan))
                    <span class="float-right">Tanggal Pesan : {{ date('d-m-Y', strtotime($pesanan->tanggal)) }}</span>
                    <table class="table">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                        <?php $no = 1; ?>
                        @foreach($pesanan_detail as $pd)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <img src="{{ asset('uploads') }}/{{ $pd->barang->gambar }}" alt="{{ $pd->barang->nama_barang }}" width="100">
                            </td>
                            <td>{{ $pd->barang->nama_barang }}</td>
                            <td>{{ $pd->jumlah }}</td>
                            <td>{{ number_format($pd->barang->harga, 0, ',', '.') }}</td>
                            <td>{{ number_format($pd->jml_harga, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ url('checkout') }}/{{ $pd->id }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tfoot>
                            <tr>
                                <td colspan="5">Total Harga</td>
                                <td>Rp.{{ number_format($pesanan->jml_harga, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ url('proses-checkout') }}" class="btn btn-primary btn-sm">Checkout</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
