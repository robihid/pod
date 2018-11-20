<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model {
	protected $fillable = ['nama', 'alamat', 'no_hp', 'jumlah', 'status_pembayaran', 'status_pengiriman', 'tgl_pemesanan', 'total', 'id_pakaian', 'norek'];
}
