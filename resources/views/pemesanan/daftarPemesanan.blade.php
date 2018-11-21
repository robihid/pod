@extends('layout.app')

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif
<h1>Daftar Pemesanan</h1>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Filter
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <a class="dropdown-item" href="?filter=1">Belum Dibayar</a>
    <a class="dropdown-item" href="?filter=2">Pembayaran Menunggu Verifikasi</a>
    <a class="dropdown-item" href="?filter=3">Proses Produksi</a>
    <a class="dropdown-item" href="?filter=4">Sudah Dikirim</a>
  </div>
</div>
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
                @if ($pemesanan->status_pembayaran == "Dibatalkan")
                    <div class="alert alert-danger" role="alert">
                        Dibatalkan
                    </div>
                @elseif ($pemesanan->status_pembayaran == "Belum Dibayar")
                    <div class="alert alert-secondary" role="alert">
                        Belum Dibayar
                    </div>
                    <a href="{{ route('pemesanan.batalkan',$pemesanan->id) }}" class="btn btn-danger">Batalkan Pemesanan</a>

                @elseif ($pemesanan->status_pembayaran == "Menunggu Pengecekan")
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#terimaModal{{ $pemesanan->id }}">
                      Terima Pembayaran
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="terimaModal{{ $pemesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Nomor Rekening Pengirim: {{ $pemesanan->norek }}</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="{{ route('pemesanan.terimaPembayaran',$pemesanan->id) }}" class="btn btn-warning">Terima Pembayaran</a>
                          </div>
                        </div>
                      </div>
                    </div>

                @elseif ($pemesanan->status_pengiriman == "Belum Dikirim")
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kirimModal{{ $pemesanan->id }}">
                      Kirim Barang
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="kirimModal{{ $pemesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>ID Pemesanan         : {{ $pemesanan->id }}</p>
                            <p>Nama                 : {{ $pemesanan->nama }}</p>
                            <p>Alamat               : {{ $pemesanan->alamat }}</p>
                            <p>Nomor HP             : {{ $pemesanan->no_hp }}</p>
                            <p>Jumlah               : {{ $pemesanan->jumlah }}</p>
                            <br>
                            {!! Form::model($pemesanan, ['method' => 'PATCH','route' => ['pemesanan.kirimBarang', $pemesanan->id]]) !!}
                                <div class="form-group">
                                    {{Form::label('no_resi', 'Nomor Resi')}}
                                    {{Form::text('no_resi', '', ['class' => 'form-control', 'placeholder' => 'Nomor Resi'])}}
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            {!! Form::close() !!}
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                @else
                    <div class="alert alert-success" role="alert">
                        Nomor Resi: <strong>{{ $pemesanan->status_pengiriman }}</strong>
                    </div>
                @endif

                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal{{ $pemesanan->id }}">
                  Detail
                </button>
                <!-- Modal -->
                <div class="modal fade" id="detailModal{{ $pemesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>ID Pemesanan         : {{ $pemesanan->id }}</p>
                        <p>Nama                 : {{ $pemesanan->nama }}</p>
                        <p>Alamat               : {{ $pemesanan->alamat }}</p>
                        <p>Nomor HP             : {{ $pemesanan->no_hp }}</p>
                        <p>Jumlah               : {{ $pemesanan->jumlah }}</p>
                        <p>Status Pembayaran    : {{ $pemesanan->status_pembayaran }}</p>
                        <p>Status Pengiriman    : {{ $pemesanan->status_pengiriman }}</p>
                        <p>Tanggal Pemesanan    : {{ $pemesanan->tgl_pemesanan }}</p>
                        <p>Total                : {{ $pemesanan->total }}</p>
                        <p>Nomor Rekening       : {{ $pemesanan->norek }}</p>
                        <a href="/storage/raw/{{ $pakaian->raw }}" target="_blank" class="btn btn-info" role="button" aria-pressed="true">Gambar RAW</a>
                        <a href="/storage/gambar/{{ $pakaian->gambar }}" target="_blank" class="btn btn-info" role="button" aria-pressed="true">Gambar Pakaian</a>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
      </div>
  @endforeach
</div>

@endsection