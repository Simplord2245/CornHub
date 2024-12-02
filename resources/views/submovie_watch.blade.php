@extends('masterpage.admin')

@section('title')
{{ $watch->submovie_title }}
@endsection
@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            <div>
                <iframe id="videoIframe" src="{{ $watch->episodes->first()->url }}" frameborder="0" width="100%" height="500px"></iframe>
            </div>

            <!-- Danh sách các tập phim -->
            <ul id="episodeList">
                @foreach($watch->episodes as $index => $episode)
                    <li onclick="loadEpisode('{{ $episode->url }}', this)" class="{{ $index == 0 ? 'active' : '' }}">
                        Tập {{ $episode->episode_number }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

<script>
    // Hàm load video tập phim
    function loadEpisode(url, element) {
        // Thay đổi nguồn của iframe video
        document.getElementById('videoIframe').src = url;

        // Thêm lớp 'active' vào tập phim đang được chọn
        let episodeList = document.getElementById('episodeList').getElementsByTagName('li');
        
        // Xoá lớp 'active' của tất cả các tập
        for (let episode of episodeList) {
            episode.classList.remove('active');
        }

        // Thêm lớp 'active' vào tập phim đã được chọn
        element.classList.add('active');
    }
</script>
