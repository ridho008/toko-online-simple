<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pesanan;
use App\User;
use App\PesananDetail;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
Use Alert;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
      $barang = Barang::where('id', $id)->first();
      return view('pesan.index', compact('barang'));
    }

    public function pesan(Request $request, $id)
    {
      $barang = Barang::where('id', $id)->first();
      $tanggal = Carbon::now();

      // jika stok yang diinputkan lebih besar dari DB
      if($request->jumlah_pesan > $barang->stok) {
        alert()->warning('Pemberitahuan','Anda Tidak Bisa Memesan Melebihi Stok Yang Ada!');
         return redirect('/pesan/' . $id);
      }

      // jika user memasukan angka 0
      if($request->jumlah_pesan < 1) {
        alert()->warning('Pemberitahuan','Anda Belum Memesan Apapun.');
        return redirect('/pesan/' . $id);
      }

      // cek validation
      $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
      if(empty($cek_pesanan)) {
         // simpan ke DB pesanan
         $pesanan = new Pesanan;
         $pesanan->user_id = Auth::user()->id;
         $pesanan->tanggal = $tanggal;
         $pesanan->status = 0;
         $pesanan->kode = date('Ymd') . mt_rand(1000, 9999);
         $pesanan->jml_harga = 0;
         $pesanan->save();
      }


      // simpan ke DB pesanan_detail
      $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

      // cek pesanan_detail
      $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
      if(empty($cek_pesanan_detail)) {
         $pesanan_detail = new PesananDetail;
         $pesanan_detail->barang_id = $barang->id;
         $pesanan_detail->pesanan_id = $pesanan_baru->id;
         $pesanan_detail->jumlah = $request->jumlah_pesan;
         $pesanan_detail->jml_harga = $barang->harga * $request->jumlah_pesan;
         $pesanan_detail->save();
      } else {
         $pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
         $pesanan_detail->jumlah = $pesanan_detail->jumlah + $request->jumlah_pesan;

         // harga sekarang
         $harga_pesanan_detail_baru = $barang->harga * $request->jumlah_pesan;
         $pesanan_detail->jml_harga = $pesanan_detail->jml_harga + $harga_pesanan_detail_baru;
         $pesanan_detail->update();
      }

      // jumlah total
      $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
      $pesanan->jml_harga = $pesanan->jml_harga + $barang->harga * $request->jumlah_pesan;
      $pesanan->update();

      alert()->success('Berhasil','Pesanan Berhasil Di Masukan Keranjang');
      return redirect('/checkout');
    }

    public function checkout()
    {
      $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
      if(!empty($pesanan)) {
        $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
      } else {
        alert()->error('Peringatan', 'Pesan Beberapa Barang Terlebih Dahulu.');
        return redirect('/home');
      }


      return view('pesan.checkout', compact('pesanan', 'pesanan_detail'));
    }

    public function delete($id)
    {
      $pesanan_detail = PesananDetail::where('id', $id)->first();
      $pesanan = pesanan::where('id', $pesanan_detail->pesanan_id)->first();
      $pesanan->jml_harga = $pesanan->jml_harga - $pesanan_detail->jml_harga;
      $pesanan->update();
      PesananDetail::where('id', $id)->delete();
      alert()->success('Berhasil','Pesanan Berhasil Di Hapus Pesanan');
      return redirect('/checkout');
    }

    public function prosesCheckout()
    {
      $user = User::where('id', Auth::user()->id)->first();
      if(empty($user->alamat) || empty($user->no_telp)) {
        alert()->warning('Gagal','Identitas Diri Anda Lengkap');
        return redirect('/profile');
      }
      $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
      $pesanan_id = $pesanan->id;
      // update status menjadi 1
      $pesanan->status = 1;
      $pesanan->update();

      // mengurangi stok barang setelah melakukan checkout barang
      $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
      foreach ($pesanan_details as $pds) {
        $barang = Barang::where('id', $pds->barang_id)->first();
        $barang->stok = $barang->stok - $pds->jumlah;
        $barang->update();
      }

      alert()->success('Berhasil','Pesanan Berhasil Di Proses.');
      return redirect('/history/' . $pesanan_id);
    }

    public function history()
    {
      $pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status', '!=', 0)->get();
      return view('pesan.riwayat_belaja', compact('pesanans'));
    }

    public function store($id)
    {
      $pesanan = Pesanan::where('id', $id)->first();
      $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();

      return view('pesan.detail_riwayat_belaja', compact('pesanan', 'pesanan_details'));
    }

    public function updateJumlah(Request $request)
    {
      $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
      $pesanan_id = $pesanan->id;
      $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
      foreach ($pesanan_details as $pds) {
        $pds->id;
        $pesanan->id;
        $pds->jumlah = $request->jumlah;
        $pesanan->jml_harga = $request->jumlah * $pds->jml_harga;
        $pds->jml_harga = $request->jumlah * $pds->jml_harga;
        $pds->update();
        $pesanan->update();
      }
      alert()->success('Berhasil','Jumlah Barang Berhasil Di Perbarui.');
      return redirect('/checkout');
    }
}
