@extends('masterpage.admin')

@section('title', 'Danh Sách Phim')

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            <h1>Danh sách các phần phim của {{$movie_name}}</h1>
            <a id="create-btn" href="{{route('submovie.create', ['movie_id' => $submoi->movie_id, 'id' => '' ])}}" type="submit" class="btn btn-primary">Thêm phần phim</a>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Tiêu Đề</th>
                        <th>Ảnh</th>
                        <th>Năm phát hành</th>
                        <th>Trailer</th>
                        <th>Số tập</th>
                        <th>Dạng phim</th>
                        <th>Mô tả</th>
                        <th>Lượt xem</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submovies as $submovie)
                    <tr>
                        <td><a href="{{route('submovie.detail', $submovie->submovie_id)}}">{{ $submovie->submovie_title }}</a></td>                        
                        <td><img src="{{asset('storage/img/'. $submovie->image)}}" alt="" width="60px" height="80px"></td>                        
                        <td style="text-align: center">{{ $submovie->release_year }}</td>
                        <td>{{ $submovie->trailer_url }}</td>
                        <td style="text-align: center"><a href="{{route('episodes.index', [ 'id' => $submovie->submovie_id, 'name' => $submovie->submovie_title ])}}">{{ $submovie->episodes_count }}</a></td>
                        <td>{{ $submovie->type }}</td>
                        <td>{{ Str::limit($submovie->submovie_description, 30) }}</td>
                        <td>{{ $submovie->views }}</td>
                        <td>
                            <a href="{{route('submovie.create', [ 'movie_id' => $submovie->movie_id, 'id' => $submovie->submovie_id ])}}" class="btn btn-primary btn-sm">Sửa</a>
                        </td>
                        <td>
                            <a href="{{route('submovie.delete', $submovie->submovie_id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xoá {{ $submovie->submovie_title }}?');">Xoá</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper">
                {{ $submovies->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
