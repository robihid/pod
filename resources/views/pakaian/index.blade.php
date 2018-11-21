@extends('layout.app')

@section('content')
	<div class="row">
		@foreach($pakaians as $pakaian)
			<div class="col-4">
			  <div class="card">
			    <img class="card-img-top" src="/storage/gambar/{{ $pakaian->gambar }}" alt="Card image cap">
			    <div class="card-body">
			      <h5 class="card-title">ID Pakaian: {{ $pakaian->id }}</h5>
			      <p><strong>Ukuran: {{ $pakaian->ukuran }}</strong></p>
			      <a href="/pemesanan/create?id={{ $pakaian->id }}&gambar={{ $pakaian->gambar }}" class="btn btn-primary" role="button" aria-pressed="true">PESAN SEKARANG</a>
			    </div>
			  </div>
		  </div>
		@endforeach
	</div>
@endsection