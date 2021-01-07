<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use Alert;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $user = User::where('id', Auth::user()->id)->first();
      return view('profile.index', compact('user'));
    }

    public function simpanProfile(Request $request)
    {
      $request->validate([
        'nama' => 'required|max:255',
        'email' => 'required|max:255',
        'no_hp' => 'required|min:12',
        'alamat' => 'required|max:255'
      ],
        [
          'nama.required' => 'Nama Wajib Di isi.',
          'email.required' => 'Email Wajib Di isi.',
          'no_hp.required' => 'No.Hp Wajib Di isi.',
          'alamat.required' => 'Alamat Wajib Di isi.',
        ]
      );

      $user = User::where('id', Auth::user()->id)->first();
      $user->name = $request->nama;
      $user->email = $request->email;
      if(!empty($request->password)) {
         $user->password = Hash::make($request->password);
      }
      $user->alamat = $request->alamat;
      $user->no_telp = $request->no_hp;
      $user->update();

      alert()->success('Berhasil','Profile Berhasil Di Perbarui.');
      return redirect('/profile');
    }
}
