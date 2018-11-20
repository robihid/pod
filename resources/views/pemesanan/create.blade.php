@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col">
            <img src="/storage/gambar/{{ $pakaian['gambar'] }}" class="img-fluid">
        </div>
        <div class="col">
            {!! Form::open(['action' => 'PemesananController@store', 'method' => 'POST']) !!}
                <input type="hidden" id="id_pakaian" name="id_pakaian" value="{{ $pakaian['id'] }}">
                <div class="form-group">
                    {{Form::label('nama', 'Nama')}}
                    {{Form::text('nama', '', ['class' => 'form-control', 'placeholder' => 'Nama'])}}
                </div>
                <div class="form-group">
                    {{Form::label('alamat', 'alamat')}}
                    {{Form::textarea('alamat', '', ['class' => 'form-control', 'placeholder' => 'alamat', 'rows' => 3])}}
                </div>
                <div class="form-group">
                    {{Form::label('no_hp', 'no_hp')}}
                    {{Form::text('no_hp', '', ['class' => 'form-control', 'placeholder' => 'no_hp'])}}
                </div>
                <div class="form-group">
                    {{Form::label('jumlah', 'jumlah')}}
                    {{Form::number('jumlah', '', ['class' => 'form-control', 'placeholder' => 'jumlah'])}}
                </div>
                {{Form::submit('Bayar Sekarang', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection