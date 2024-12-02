@extends('masterpage.admin')

@section('title', 'Danh Sách Thể Loại')

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            <h1>Danh sách thể loại</h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Tên thể loại</th>
                        <th>Số lượng phim</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($genres as $genre)
                    <tr>
                        <td>{{ $genre->name }}</td>
                        <td>{{ $genre->movies_count }}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Sửa</a>
                        </td>
                        <td>
                            <a href="{{route('genre.delete', $genre->genre_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xoá {{ $genre->name }}?');" class="btn btn-danger btn-sm">Xoá</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Phân trang -->
            <div class="pagination-wrapper">
                    {{ $genres->links() }}
                </div>
            </div>
    </div>
</div>
@endsection
