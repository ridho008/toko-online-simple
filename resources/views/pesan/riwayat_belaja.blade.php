@extends('layouts.app')

@section('title', 'Riwayat Belanja')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Riwayat Belanja</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Jumlah Harga</th>
                            <th>Aksi</th>
                        </tr>
                        <?php $no = 1; ?>
                        @foreach($pesanans as $p)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $p->tanggal }}</td>
                            <td>{{ $p->status == 1 ? 'Sudah Pesan & Belum Bayar' : 'Sudah Bayar' }}</td>
                            <td>{{ number_format($p->jml_harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ url('history') }}/{{ $p->id }}" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
