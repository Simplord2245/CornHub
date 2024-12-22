@extends('masterpage.admin')
@if ($episode->episode_id == null)
@section('title', 'Thêm Mới Tập Phim')
@else
@section('title', 'Chỉnh Sửa Tập Phim')
@endif

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            @if ($episode->episode_id == null)
            <h1>Thêm mới tập phim cho phim {{$submovie->submovie_title}}</h1>    
            @else
            <h1>Chỉnh sửa tập phim {{$episode->episode_number}}</h1>    
            @endif
            <form action="{{route('episodes.store', $submovie->submovie_id)}}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Tập phim</label>
                    <input type="text" class="form-control" name="episode_number" id="" placeholder="Nhập tập phim" value="{{ old('episode_number', $episode->episode_number) }}">
                    @if($errors->has('episode_number'))
                    <span class="text-danger">{{$errors->first('episode_number')}}</span>
            @endif
                </div>
                <div class="form-group">
                    <label for="">Thời lượng</label>
                    <input type="text" class="form-control" name="duration" id="" placeholder="Nhập thời lượng" value="{{ old('duration', $episode->duration) }}">
                    @if($errors->has('duration'))
                    <span class="text-danger">{{$errors->first('duration')}}</span>
            @endif
                </div>
                <div class="form-group">
                    <label for="">URL</label>
                    <input type="text" class="form-control" name="url" id="" placeholder="Nhập link tập phim" value="{{ old('url', $episode->url) }}">
                    @if($errors->has('url'))
                    <span class="text-danger">{{$errors->first('url')}}</span>
            @endif
                </div>
                @if ($episode->episode_id == null)
                <button type="submit" class="btn btn-primary">Thêm mới</button>
                @else
                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                @endif
            </form>
        </div>
    </div>

</div>
@endsection