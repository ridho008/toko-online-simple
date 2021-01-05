<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    public function barang()
    {
      return $this->belongsTo('App\PesananDetail', 'barang_id', 'id');
    }
}
