<?php

namespace App\Http\Controllers;

use App\Pakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PakaianController extends Controller {
	public function index() {
		$pakaians = Pakaian::where('id_user', Auth::id())->get();
		return view('pakaian.index', compact('pakaians'));
	}

	public function create() {
		return view('pakaian.create');
	}

	public function store(Request $request) {
		$this->validate($request, [
			'gambar' => 'image|required|max:1999',
			'ukuran' => 'required',
		]);

		// Get filename with the extension
		$filenameWithExt = $request->file('gambar')->getClientOriginalName();
		// Get just filename
		$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
		// Get just ext
		$extension = $request->file('gambar')->getClientOriginalExtension();
		// Filename to store
		$fileNameToStore = $filename . '_' . time() . '.' . $extension;
		// Upload Image
		$path = $request->file('gambar')->storeAs('public/gambar', $fileNameToStore);

		$pakaian = new Pakaian([
			'gambar' => $fileNameToStore,
			'ukuran' => $request->ukuran,
			'id_user' => Auth::id(),
		]);

		$pakaian->save();

		return redirect()->route('pakaian.index');
	}

	public function show($id) {
		//
	}
}
