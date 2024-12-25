@extends('masterpage.admin')

@section('title', 'Danh Sách Người Dùng')

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            <h1>Danh sách người dùng</h1>
            <form class="search-form" action="{{ route('user.index') }}" method="GET">
                <input class="search-input" type="text" name="search" placeholder="Tìm kiếm người dùng" value="{{ request('search') }}">
                <button class="search-button" type="submit">Tìm kiếm</button>
            </form> 
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Mã người dùng</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Tên tài khoản</th>
                        <th>Ảnh</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td><img src="{{asset('img/'. $user->profile_picture)}}" alt="" width="60px" height="80px"></td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">Hoạt động <span class="count">5</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
