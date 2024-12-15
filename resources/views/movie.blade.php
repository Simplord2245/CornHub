@extends('masterpage.admin')

@section('title', 'Danh Sách Phim')

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            <h1>Danh sách phim</h1>
            <a id="create-btn" href="{{route('movie.create')}}" type="submit" class="btn btn-primary">Thêm phim</a>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Tiêu Đề</th>
                        <th>Thể Loại</th>
                        <th>Quốc Gia</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movies as $movie)
                    <tr>
                        <td><a href="{{route('submovie.index', ['id' => $movie->movie_id, 'name' => $movie->title])}}">{{ $movie->title }}</a></td>
                        <td>
                            {{ implode(', ', $movie->Genres->pluck('name')->toArray()) }}
                        </td>
                        
                        <td>{{ $movie->nation }}</td>
                        <td>
                            <a href="{{route('movie.create', $movie->movie_id)}}" class="btn btn-primary btn-sm">Sửa</a>
                        </td>
                        <td>
                            <a href="{{route('movie.delete', $movie->movie_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá {{ $movie->title }}?');" class="btn btn-danger btn-sm">Xoá</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper">
                {{ $movies->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
