@extends('layout.app')

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

<h1>Daftar Pemesanan Anda</h1>
<div class="row">
	@foreach($pemesanans as $pemesanan)
		@php
			$id_pakaian = $pemesanan->id_pakaian;
			foreach ($pakaians as $p) {
				if ($p->id == $id_pakaian) {
					$pakaian = $p;
				}
			}
		@endphp
		<div class="col-4">
		  <div class="card">
		    <img class="card-img-top" src="/storage/gambar/{{ $pakaian->gambar }}" alt="Card image cap">
		    <div class="card-body">
		      <h5 class="card-title">ID Pemesanan: {{ $pemesanan->id }}</h5>
		      @if ($pemesanan->status_pembayaran == "Belum Dibayar")
		      	<a href="{{ route('pemesanan.edit',$pemesanan->id) }}" class="btn btn-warning">Konfirmasi Pembayaran</a>
		      @elseif ($pemesanan->status_pembayaran == "Menunggu Pengecekan")
						<div class="alert alert-primary" role="alert">
					    Pembayaran <strong>{{ $pemesanan->status_pembayaran }}</strong>
						</div>
					@elseif ($pemesanan->status_pembayaran == "Pembayaran Diterima")
						@if ($pemesanan->status_pengiriman == "Belum Dikirim")
							<div class="alert alert-success" role="alert">
						    <strong>Pemesanan anda dalam proses produksi, tunggu sampai {{ date('Y-m-d H:i:s', strtotime($pemesanan->updated_at. ' + 3 days')) }}</strong>
							</div>
						@else
							<div class="alert alert-success" role="alert">
						    <strong>{{ $pemesanan->status_pengiriman }}</strong>
							</div>
						@endif
		      @endif
		    </div>
		  </div>
	  </div>
  @endforeach
</div>

@endsection