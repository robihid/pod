<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pakaian extends Model {
	protected $fillable = ['gambar', 'ukuran', 'id_user'];
}
