<?php

namespace App\Http\Controllers;

use App\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
		return view('pemesanan.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'nama' => 'required',
			'alamat' => 'required',
			'no_hp' => 'required',
			'jumlah' => 'required',
		]);

		$pemesanan = new Pemesanan([
			'nama' => $request->nama,
			'alamat' => $request->alamat,
			'no_hp' => $request->no_hp,
			'jumlah' => $request->jumlah,
			'status_pembayaran' => "Belum Lunas",
			'status_pengiriman' => "Belum Dikirim",
			'tgl_pemesanan' => date('Y-m-d H:i:s'),
			'total' => ((int) $request->jumlah) * 100000,
			'id_pakaian' => 1,
		]);

		$pemesanan->save();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Pemesanan  $pemesanan
	 * @return \Illuminate\Http\Response
	 */
	public function show(Pemesanan $pemesanan) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Pemesanan  $pemesanan
	 * @return \Illuminate\Http\Response
	 */
	public function verifikasi($id) {
		return view('pemesanan.verifikasi')->with('id', $id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Pemesanan  $pemesanan
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Pemesanan $pemesanan) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Pemesanan  $pemesanan
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Pemesanan $pemesanan) {
		//
	}

	public function updatePembayaran($id_pemesanan) {
		$pemesanan = Pemesanan::find($id_pemesanan);
		$pemesanan->status_pembayaran = "Menunggu Pengecekan";
		$pemesanan->save();
	}
}
