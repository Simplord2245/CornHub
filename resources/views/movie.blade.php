@extends('masterpage.admin')

@section('title', 'Danh Sách Phim')

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            <h1>Danh Sách Phim</h1>
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
                        <td>{{ $movie->title }}</td>
                        <td>
                            {{ implode(', ', $movie->Genres->pluck('name')->toArray()) }}
                        </td>
                        
                        <td>{{ $movie->nation }}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Sửa</a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm">Xoá</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
