@extends('layouts.app')
@section('content')
    @if($errors->any())
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    <form action="{{route('entrada.store')}}" method="post">
    @csrf
        <div class="row justify-content-center">
            <div class="col-sm-7">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" name="titulo" id="" class="form-control" value="{{old('titulo')}}" placeholder="Titulo">
                </div>
                <div class="form-group">
                    <label for="titulo">Contenido</label>
                    <textarea name="contenido" id="contenido" cols="30" rows="10" class="form-control">{{old('contenido')}}</textarea>                    
                </div>
            </div>
            <div class="col-sm-7 text-center">
                <button type="submit" class="btn btn-primary btn-block">@lang('main.send')</button>
                <a href="javascript:history.back()" class="btn btn-secondary btn-block">@lang('main.go-back')</a>
            </div>
        </div>
    </form>
@endsection