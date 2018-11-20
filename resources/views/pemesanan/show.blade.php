@extends('layout.app')

@section('content')
    <p>ID Pemesanan: {{ $pemesanan->id }}</p>
	<p>Nama: {{ $pemesanan->nama }}</p>
    <p>Alamat: {{ $pemesanan->alamat }}</p>
    <p>No. HP: {{ $pemesanan->no_hp }}</p>
    <p>ID Pakaian: {{ $pemesanan->id_pakaian }}</p>
    <p>Status Pembayaran: {{ $pemesanan->status_pembayaran }}</p>
@endsection