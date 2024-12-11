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
                    <input type="text" class="form-control" name="title" id="" placeholder="Nhập tên phim">
                    @if($errors->has('title'))
            <span>{{$errors->first('title')}}</span>
            @endif
                </div>
                <div class="form-group">
                    <label for="">Quốc gia</label>
                    <input type="text" class="form-control" name="nation" id="" placeholder="Nhập quốc gia">
                    @if($errors->has('nation'))
            <span>{{$errors->first('nation')}}</span>
            @endif
                </div>
                {{-- <div class="form-group">
                    <label for="">Quốc gia</label>
                    <input type="text" class="form-control" name="nation" id="" placeholder="Nhập quốc gia">
                    @if($errors->has('nation'))
            <span>{{$errors->first('nation')}}</span>
            @endif
                </div> --}}
                <label for="genres">Thể loại:</label>
    <select name="genres[]" id="genres" class="form-select" multiple="multiple" >
        @foreach ($genre as $gen)
        <option value="{{$gen->name}}">{{$gen->name}}</option>
        @endforeach
        <!-- Thêm nhiều thể loại nếu cần -->
    </select>
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
<script>
    $(document).ready(function() {
        $('#genres').select2({
            placeholder: "Chọn thể loại phim",
            allowClear: true
        });
    });
</script>