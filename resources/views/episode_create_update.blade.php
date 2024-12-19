@extends('masterpage.admin')
@if ($movie->movie_id == null)
@section('title', 'Thêm Mới Phim')
@else
@section('title', 'Chỉnh sửa phim')
@endif

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            @if ($movie->movie_id == null)
            <h1>Thêm mới phim</h1>    
            @else
            <h1>Chỉnh sửa phim {{$movie->title}}</h1>    
            @endif
            <form action="{{route('movie.store')}}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Tên phim</label>
                    <input type="text" class="form-control" name="title" id="" placeholder="Nhập tên phim" value="{{ old('title', $movie->title) }}">
                    @if($errors->has('title'))
                    <span class="text-danger">{{$errors->first('title')}}</span>
            @endif
                </div>
                <div class="form-group">
                    <label for="">Quốc gia</label>
                    <input type="text" class="form-control" name="nation" id="" placeholder="Nhập quốc gia" value="{{ old('nation', $movie->nation) }}">
                    @if($errors->has('nation'))
                    <span class="text-danger">{{$errors->first('nation')}}</span>
            @endif
                </div>
                <div class="form-group genres-group">
                    <label for="">Thể loại</label>
                    @foreach ($genre as $gen)
                    <div class="genre-item">
                        <input type="checkbox" id="genre_{{$gen->genre_id}}" name="genre_id[]" value="{{$gen->genre_id}}" 
                        {{ in_array($gen->genre_id, $movie->Genres->pluck('genre_id')->toArray() ?? []) ? 'checked' : '' }}>
                        <label for="genre_{{$gen->genre_id}}">{{$gen->name}}</label>
                    </div>
                    @endforeach
                </div>
                <p>@if($errors->has('genre_id'))
                    <span class="text-danger">{{$errors->first('genre_id')}}</span>
            @endif</p>
                
                @if ($movie->movie_id == null)
                <button type="submit" class="btn btn-primary">Thêm mới</button>
                @else
                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                @endif
            </form>
        </div>
    </div>

</div>
@endsection