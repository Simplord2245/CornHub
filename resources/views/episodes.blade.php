@extends('masterpage.admin')

@section('title', 'Danh Sách Tập Phim')

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            <h1>Danh sách tập phim của {{$submovie_name}} </h1>
            <a id="create-btn" href="{{route('episodes.create', ['submovie_id' => $episo->submovie_id, 'id' => ''])}}" type="submit" class="btn btn-primary">Thêm tập mới</a>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Tập</th>
                        <th>Thời lượng</th>
                        <th>Url</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($episodes as $episode)
                    <tr>
                        <td>{{ $episode->episode_number }}</td>                                          
                        <td>{{ $episode->duration }}</td>
                        <td>{{ $episode->url }}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Sửa</a>
                        </td>
                        <td>
                            <a href="{{route('episodes.delete', $episode->episode_id)}}" onclick="return confirm('Bạn có chắc chắc muốn xoá tập {{$episode->episode_number}}?');" class="btn btn-danger btn-sm">Xoá</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper">
                {{ $episodes->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
