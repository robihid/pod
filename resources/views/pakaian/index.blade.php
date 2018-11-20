@extends('layout.app')

@section('content')
	@foreach($pakaians as $pakaian)
		<div>
			<img src="/storage/gambar/{{ $pakaian->gambar }}" class="img-fluid">
			<a href="/pemesanan/create?id={{ $pakaian->id }}&gambar={{ $pakaian->gambar }}" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">PESAN SEKARANG</a>
			<br>
		</div>
	@endforeach
@endsection