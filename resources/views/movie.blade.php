@extends('masterpage.admin')

@section('title', 'Danh Sách Phim')

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            <h1>Danh Sách Phim</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tiêu Đề</th>
                        <th>Thể Loại</th>
                        <th>Năm Phát Hành</th>
                        <th>Thời Lượng</th>
                        <th>Quốc Gia</th>
                        <th>Ảnh</th>
                        <th>Trailer</th>
                        <th>Mô tả</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movies as $movie)
                    <tr>
                        <td>{{ $movie->title }}</td>
                        <td>
                            @foreach($movie->Genres as $genre)
                                {{ $genre->name }}
                            @endforeach
                        </td>
        
                        <td>{{ $movie->release_year }}</td>
                        <td>{{ $movie->duration }}</td>
                        <td>{{ $movie->nation }}</td>
                        <td><img src="{{ asset('img/'.$movie->image_url) }}" alt="" width="100"></td>
                        <td>{{ $movie->trailer_url }}</td>
                        <td>{{ $movie->description }}</td>
                        <td>Sửa</td>
                        <td>Xoá</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
