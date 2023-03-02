@extends('themes::theme8anime.layout')
@section('content')
<main>
    <div class="Wdgt">
    <div class="Title">
        <h1><span style="color: #fdb813;">{{$title}}</span></h1>
    </div>
    {!!$content!!}
    @isset($thumb_url)
        <div class="Image">
            @include('themes::theme8anime.inc.html.img',  [
                        'src' => $thumb_url,
                        'alt' => $title,
                        'title' => $title,
                    ])
        </div>
    @endisset
</main>
@endsection