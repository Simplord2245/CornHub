@extends('layouts.admin')

@section('title', 'Danh Sách Phim')

@section('content')
<div class="container">
    <h1>Danh Sách Phim</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tiêu Đề</th>
                <th>Thể Loại</th>
                <th>Ngày Phát Hành</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
            <tr>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->category }}</td>
                <td>{{ $movie->release_date }}</td>
                <td>
                    <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info">Chi tiết</a>
                    <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
