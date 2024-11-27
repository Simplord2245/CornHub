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
                        <th>Ảnh</th>
                        <th>Năm phát hành</th>
                        <th>Trailer</th>
                        <th>Số tập</th>
                        <th>Mô tả</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submovies as $submovie)
                    <tr>
                        <td>{{ $submovie->submovie_title }}</td>                        
                        <td><img src="{{asset('img/'. $submovie->image)}}" alt="" width="50px" height="80px"></td>                        
                        <td>{{ $submovie->release_year }}</td>
                        <td>{{ $submovie->trailer_url }}</td>
                        <td>{{ $submovie->episodes_count }}</td>
                        <td>{{ Str::limit($submovie->submovie_description, 30) }}</td>
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
