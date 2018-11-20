<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesanansTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('pemesanans', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nama');
			$table->text('alamat');
			$table->string('no_hp');
			$table->integer('jumlah');
			$table->string('norek')->nullable();
			$table->string('status_pembayaran');
			$table->string('status_pengiriman');
			$table->timestamp('tgl_pemesanan');
			$table->integer('total');
			$table->integer('id_pakaian');
			$table->integer('id_admin')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('pemesanans');
	}
}
