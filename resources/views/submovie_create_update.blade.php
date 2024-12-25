@extends('masterpage.admin')
@if ($submovie->submovie_id == null)
@section('title', 'Thêm Mới Phần Phim')
@else
@section('title', 'Chỉnh sửa phần phim')
@endif

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            @if ($submovie->submovie_id == null)
            <h1>Thêm mới phần phim của {{$movie->title}}</h1>    
            @else
            <h1>Chỉnh sửa phim {{$submovie->submovie_title}}</h1>    
            @endif
            <form action="{{route('submovie.store', $movie->movie_id)}}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" class="form-control" name="submovie_title" id="" placeholder="Nhập tiêu đề" value="{{ old('submovie_title', $submovie->submovie_title) }}">
                    @if($errors->has('submovie_title'))
                    <span class="text-danger">{{$errors->first('submovie_title')}}</span>
            @endif
                </div>
                <div class="form-group">
                    <label for="">Năm phát hành</label>
                    <input type="text" class="form-control" name="release_year" id="" placeholder="Nhập năm phát hành" value="{{ old('release_year', $submovie->release_year) }}">
                    @if($errors->has('release_year'))
                    <span class="text-danger">{{$errors->first('release_year')}}</span>
            @endif
                </div>
                <div class="form-group">
                    <label for="">Trailer</label>
                    <input type="text" class="form-control" name="trailer_url" id="" placeholder="Nhập link trailer" value="{{ old('trailer_url', $submovie->trailer_url) }}">
                    @if($errors->has('trailer_url'))
                    <span class="text-danger">{{$errors->first('trailer_url')}}</span>
            @endif
                </div>
                <div class="form-group">
                    <label for="">Dạng phim</label>
                   <select name="type" id="">Chọn dạng phim
                    <option value="TV Series">TV Series</option>
                    <option value="Movie">Movie</option>
                   </select>
                    @if($errors->has('type'))
                    <span class="text-danger">{{$errors->first('type')}}</span>
            @endif
                </div>
                @if ($submovie->submovie_id == null)
                <div class="form-group">
                    <label for="">Ảnh</label>
                    <input type="file" class="form-control" name="image" id="" placeholder="Thêm ảnh" value="{{ old('image', $submovie->image) }}">
                    @if($errors->has('image'))
                    <span class="text-danger">{{$errors->first('image')}}</span>
            @endif
                @else
                <div class="form-group">
                    <label for="">Ảnh</label>
                    <div class="movie-image">
                        <img src="{{ asset('img/' . $submovie->image) }}" alt="" height="180px" width="130px">
                    </div>
                    <input type="file" class="form-control" name="image" id="" placeholder="Thêm ảnh" value="{{ old('image', $submovie->image) }}">
                    @if($errors->has('image'))
                    <span class="text-danger">{{$errors->first('image')}}</span>
            @endif
                @endif
                
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea name="submovie_description" id="" cols="30" rows="10" placeholder="Nhập mô tả" style="width: 1134px; height: 119px;">{{ old('submovie_description', $submovie->submovie_description) }}</textarea>
                    @if($errors->has('submovie_description'))
                    <span class="text-danger">{{$errors->first('submovie_description')}}</span>
            @endif
                </div>
                @if ($submovie->submovie_id == null)
                <button type="submit" class="btn btn-primary">Thêm mới</button>
                @else
                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                @endif
            </form>
        </div>
    </div>

</div>
@endsection