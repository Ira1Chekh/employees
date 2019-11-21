@extends('layout')

@section('content')

    <div class="row">
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <form action="{{url('/upload')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="files" class="btn btn-outline-primary">Выберите XML-файл</label>
            <input id="files" style="visibility:hidden;" type="file" name="upload-file" class="form-control">
        </div>
        <input class="btn btn-success" type="submit" value="Загрузить" name="submit">
    </form>

@endsection
