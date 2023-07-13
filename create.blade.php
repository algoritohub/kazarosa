@extends('layouts.admin_app')

@section('content')
    <div class="row">
        <div class="col">
            {!! Form::open([
    'action' => 'Admin\AdminEventosController@store',
    'method' => 'POST',
    'enctype' => 'multipart/form-data',
]) !!}

            @include('admin.pages.eventos._form')

            <div class="form-group">
                {{ Form::submit('Salvar', ['class' => 'btn btn-success']) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
