@extends('masterpage.admin')

@section('title', 'Chi Tiết Phim')

@section('content')
<div class="box">
    <div class="box-body">
        <div class="container">
            <div class="movie-detail" style="display: flex; gap: 20px;">
                <div class="movie-image">
                    <img src="{{ asset('storage/img/' . $submovie_detail->image) }}" alt="" height="400px" width="300px">
                </div>

                <div class="movie-info">
                    <h1>{{ $submovie_detail->submovie_title }}</h1>
                    <p><b>Năm phát hành:</b> {{ $submovie_detail->release_year }}</p>
                    <p><b>Quốc gia:</b> {{ $submovie_detail->Movie->nation }}</p>
                    <p><b>Số tập:</b> {{ $submovie_detail->episodes_count }}</p>
                    <p>{{ $submovie_detail->submovie_description }}</p>

                    <div style="margin-top: 20px;">
                        <button class="btn-trailer" onclick="showTrailer()">Trailer</button>
                        <button class="btn-watch"><a href="{{route('submovie.watch', $submovie_detail->submovie_id)}}">Xem phim</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="trailerModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeTrailer()">&times;</span>
        <iframe 
            id="trailerIframe" 
            src="" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen 
            style="width: 100%; height: 600px; border-radius: 10px;">
        </iframe>
    </div>
</div>

@endsection
<script>
    function showTrailer() {
        const trailerUrl = "{{ $submovie_detail->trailer_url }}";
        const iframe = document.getElementById('trailerIframe');
        iframe.src = trailerUrl;
        document.getElementById('trailerModal').style.display = 'flex';
    }
    function closeTrailer() {
        const iframe = document.getElementById('trailerIframe');
        iframe.src = "";
        document.getElementById('trailerModal').style.display = 'none';
    }
</script>

