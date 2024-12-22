@extends('masterpage.admin')
@if ($genre->genre_id == null)
@section('title', 'Thêm Mới Thể Loại')
@else
@section('title', 'Chỉnh Thể Loại')
@endif

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            @if ($genre->genre_id == null)
            <h1>Thêm mới thể loại</h1>    
            @else
            <h1>Chỉnh sửa thể loại {{$genre->name}}</h1> 
            @endif
            <form action="{{route('genre.store')}}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Tên phim</label>
                    <input type="text" class="form-control" name="name" id="" placeholder="Nhập tên phim" value="{{ old('name', $genre->name) }}">
                    @if($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
            @endif
                </div>
                @if ($genre->genre_id == null)
                <button type="submit" class="btn btn-primary">Thêm mới</button>
                @else
                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                @endif
            </form>
        </div>
    </div>

</div>
@endsection