@extends('layouts.app')

@section('title', 'Informasi Pemasanan')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Pemasanan</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert">Pesanan anda berhasil di <strong>Checkout</strong>, selanjutnya lakukan pembayaran kepada rekening Bank BRI 876-287-123-879 dengan nominal <strong>Rp.{{ number_format(substr($pesanan->kode, 9) + $pesanan->jml_harga, 0, ',', '.') }}</strong></div>
                    <table class="table">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                        </tr>
                        <?php $no = 1; ?>
                        @foreach($pesanan_details as $pd)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $pd->barang->nama_barang }}</td>
                            <td>{{ $pd->jumlah }}</td>
                            <td>{{ number_format($pd->barang->harga, 0, ',', '.') }}</td>
                            <td>{{ number_format($pd->jml_harga, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        <tfoot>
                            <tr>
                                <td colspan="4">Total Harga</td>
                                <td>{{ number_format($pesanan->jml_harga, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="4">Kode</td>
                                <td>{{ substr($pesanan->kode,8) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4">Transfer</td>
                                <td>Rp.{{ number_format(substr($pesanan->kode, 9) + $pesanan->jml_harga, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
