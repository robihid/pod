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
			'raw' => 'image|required|max:1999',
			'gambar' => 'image|required|max:1999',
			'ukuran' => 'required',
		]);

		// Get filename with the extension
		$filenameWithExt1 = $request->file('raw')->getClientOriginalName();
		// Get just filename
		$filename1 = pathinfo($filenameWithExt1, PATHINFO_FILENAME);
		// Get just ext
		$extension1 = $request->file('raw')->getClientOriginalExtension();
		// Filename to store
		$fileNameToStore1 = $filename1 . '_' . time() . '.' . $extension1;
		// Upload Image
		$path1 = $request->file('raw')->storeAs('public/raw', $fileNameToStore1);

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
			'raw' => $fileNameToStore1,
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
