@extends('layout.app')

@section('content')
	@if($errors->any())
		@foreach($errors->all() as $error)
			<div class="alert alert-danger" role="alert">
			  {{ $error }}
			</div>
		@endforeach
	@endif
	<h1>Unggah Desain Pakaian Anda</h1>
	<div class="d-flex justify-content-center">
			<a class="btn btn-primary btn-lg" href="#">Unduh Template Pakaian</a>
			<a class="btn btn-info btn-lg" href="#">Unduh Size Chart Pakaian</a>
	</div>
	{!! Form::open(['action' => 'PakaianController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
		{{-- <div class="form-group">
        {{Form::file('raw')}}
    </div>
		<div class="form-group">
        {{Form::file('gambar')}}
    </div> --}}
    <div class="form-group">
	    <label for="raw">Gambar Asli</label>
	    <input type="file" class="form-control-file" id="raw" name="raw">
	  </div>
	  <div class="form-group">
	    <label for="raw">Gambar Pakaian</label>
	    <input type="file" class="form-control-file" id="gambar" name="gambar">
	  </div>
    <div class="form-group">
	    <label for="ukuran">Pilih Ukuran</label>
	    <select class="form-control" id="ukuran" name="ukuran">
	      <option>S</option>
	      <option>M</option>
	      <option>L</option>
	      <option>XL</option>
	      <option>XXL</option>
	    </select>
	  </div>
    {{Form::submit('Pesan Pakaian', ['class'=>'btn btn-primary'])}}
	{!! Form::close() !!}
@endsection