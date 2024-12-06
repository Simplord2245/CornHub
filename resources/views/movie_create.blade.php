@extends('masterpage.admin')

@section('title', 'Thêm Mới Phim')

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            <h1>Thêm mới phim</h1>
            <form action="{{route('movie.create')}}" method="POST" role="form" enctype="multipart/form-data">
            
                <div class="form-group">
                    <label for="">Tên phim</label>
                    <input type="text" class="form-control" name="title" id="" placeholder="Nhập tên phim">
                </div>
                <div class="form-group">
                    <label for="">Quốc gia</label>
                    <input type="text" class="form-control" name="nation" id="" placeholder="Nhập quốc gia">
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>

</div>
@endsection
