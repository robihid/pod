@extends('layout.app')

@section('content')
	{!! Form::model($pemesanan, ['method' => 'PATCH','route' => ['pemesanan.update', $pemesanan->id]]) !!}
	    <div class="form-group">
        {{Form::label('norek', 'Nomor Rekening')}}
        {{Form::text('norek', '', ['class' => 'form-control', 'placeholder' => 'Nomor Rekening'])}}
    </div>
        <input type="submit">
    {!! Form::close() !!}
@endsection