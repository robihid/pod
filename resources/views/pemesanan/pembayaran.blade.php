@extends('layout.app')

@section('content')
{{--     @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif --}}
    <div class="alert alert-success">
        Pesanan Berhasil Dibuat
    </div>
	<p>Lakukan Pembayarn Ke: BRI 999999999 a/n Tes</p>
    <p>Sejumlah: Rp. {{ number_format($pemesanan->total,2,",",".") }}</p>
    <a class="btn btn-link" href="{{ route('pemesanan.edit',$pemesanan->id) }}">Verifikasi Pembayaran</a></p>
@endsection