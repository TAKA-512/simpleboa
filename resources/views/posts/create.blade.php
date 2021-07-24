@extends('layouts.layouts')

@section('title', 'Simple Board')

@section('content')

<form enctype="multipart/form-data" method="POST" action="/simpleboard/posts">
    {{ csrf_field() }}
    <div class="form-group">
        <label>タイトル</label>
        <input type="text" class="form-control" name="title" value="{{old('title')}}">
    </div>
    <div class="form-group">
        <label>コンテンツ</label>
        <textarea class="form-control" name="content">{{old('content')}}</textarea>
    </div>
    <div class="form-group">
        <label>画像</label>
        <input type="file" class="form-control" name="image" value="{{old('image')}}">
    </div>
    <button type="submit" class="btn btn-outline-primary">登録</button>
    

</form>
@endsection