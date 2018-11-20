<?php

namespace App\Http\Controllers;

use App\Pakaian;
use App\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller {
	public function index() {
		$pakaians = Pakaian::where('id_user', Auth::id())->get();
		foreach ($pakaians as $pakaian) {
			$id_pakaians[] = $pakaian->id;
		}
		$pemesanans = Pemesanan::whereIn('id_pakaian', $id_pakaians)->get();
		return view('pemesanan.index', compact('pemesanans', 'pakaians'));
	}

	public function create(Request $request) {
		$pakaian['id'] = $request->query('id');
		$pakaian['gambar'] = $request->query('gambar');
		return view('pemesanan.create', compact('pakaian'));
	}

	public function store(Request $request) {
		$this->validate($request, [
			'nama' => 'required',
			'alamat' => 'required',
			'no_hp' => 'required',
			'jumlah' => 'numeric|min:1|max:100',
			'id_pakaian' => 'required',
		]);

		$pemesanan = new Pemesanan([
			'nama' => $request->nama,
			'alamat' => $request->alamat,
			'no_hp' => $request->no_hp,
			'jumlah' => $request->jumlah,
			'status_pembayaran' => "Belum Dibayar",
			'status_pengiriman' => "Belum Dikirim",
			'tgl_pemesanan' => date('Y-m-d H:i:s'),
			'total' => ((int) $request->jumlah) * 100000 + (int) substr($request->no_hp, -3),
			'id_pakaian' => $request->id_pakaian,
		]);

		$pemesanan->save();

		return view('pemesanan.pembayaran', compact('pemesanan'))->with('success', 'Pemesanan berhasil dibuat');
	}

	public function show(Pemesanan $pemesanan) {
		return view('pemesanan.show', compact('pemesanan'));
	}

	public function edit(Pemesanan $pemesanan) {
		return view('pemesanan.edit', compact('pemesanan'));
	}

	public function update(Request $request, Pemesanan $pemesanan) {
		$this->validate($request, [
			'norek' => 'required',
		]);
		$pemesanan->norek = $request->norek;
		$pemesanan->status_pembayaran = "Menunggu Pengecekan";
		$pemesanan->save();

		return redirect()->route('pemesanan.index')->with('success', 'Pembayaran Anda Berhasil Dikonfirmasi dan Menunggu Pengecekan');
	}

	public function destroy($id) {
		//
	}

	// KHUSUS ADMIN
	// menampilkan semua pesanan
	public function daftarPemesanan(Request $request) {
		$pakaians = Pakaian::all();
		$pemesanans = Pemesanan::all();
		$filter = $request->query('filter');
		if ($filter) {
			if ($filter == '1') {
				// Pemesanan yang belum dibayar
				$pemesanans = Pemesanan::where('status_pembayaran', 'Belum Dibayar')->get();
			} else if ($filter == '2') {
				$pemesanans = Pemesanan::where('status_pembayaran', 'Menunggu Pengecekan')->get();
			} else if ($filter == '3') {
				$pemesanans = Pemesanan::where('status_pembayaran', 'Pembayaran Diterima')->where('status_pengiriman', 'Belum Dikirim')->get();
			} else if ($filter == '4') {
				$pemesanans = Pemesanan::where('status_pembayaran', 'Pembayaran Diterima')->where('status_pengiriman', '!=', 'Belum Dikirim')->get();
			}
		}
		return view('pemesanan.daftarPemesanan', compact('pemesanans', 'pakaians'));
	}

	// KHUSUS ADMIN
	// Mengubah status pembayaran menjadi diterima
	public function terimaPembayaran(Pemesanan $pemesanan) {
		$pemesanan->status_pembayaran = "Pembayaran Diterima";
		$pemesanan->id_admin = Auth::guard('admin')->id();
		$pemesanan->save();

		return redirect()->route('pemesanan.daftarPemesanan')->with('success', 'Pembayaran Berhasil Diterima');
	}

	// KHUSUS ADMIN
	// mengubah status pengiriman barang dengan no resi pengiriman
	public function kirimBarang(Request $request, Pemesanan $pemesanan) {
		$this->validate($request, [
			'no_resi' => 'required',
		]);
		$pemesanan->status_pengiriman = $request->no_resi;
		$pemesanan->id_admin = Auth::guard('admin')->id();
		$pemesanan->save();

		return redirect()->route('pemesanan.daftarPemesanan')->with('success', 'Barang Berhasil Dikirim');
	}
}
