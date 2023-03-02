@extends('themes::theme8anime.layout')
@php
    use Ophim\Core\Models\Movie;
    $data = Cache::remember('site.showtimes', setting('site_cache_ttl', 5 * 60), function () use ($content) {
        $lists = preg_split('/[\n\r]+/', $content);
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $limit, $link, $template] = array_merge($list, ['Phim mới cập nhật', '', 'type', 'series', 8, '/', 'section_thumb']);
                try {
                    $data[] = [
                        'label' => $label,
                        'template' => $template,
                        'data' => Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where(array_combine(explode(",", $field), explode(",", $val)));
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where(array_combine(explode(",", $field), explode(",", $val)));
                            })
                            ->orderBy('updated_at', 'desc')
                            ->limit($limit)
                            ->get(),
                        'link' => $link ?: '#',
                    ];
                } catch (\Exception $e) {}
            }
        }
        return $data;
    });
@endphp
@section('content')
<main>
    <div class="Wdgt">
        <div class="Title">
        <h1><span style="color: #fdb813;">{{ $title }} </span></h1>
        </div>
            @foreach ($data as $item)
                @include('themes::theme8anime.inc.section.' . $item['template'])
            @endforeach
    </div>
</main>
@endsection
@push('scripts')
    <script type="text/javascript" src="/themes/8anime/js/schedule.js"></script>
@endpush
@push('header')
<style>
.Homeschedule .Top h1 {
    width: 100%;
    color: #fff;
    font-size: 20px;
    padding: 10px 0;
    text-align: center;
    font-family: alata,sans-serif;
    text-transform: none;
}
span.mli-timeschedule {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    display: block;
    white-space: nowrap;
    background-color: #d43939;
    color: #fff;
    font-size: 13px;
    text-align: center;
    padding: inherit;
}
.item-badge-timeschedule {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    display: block;
    white-space: nowrap;
    font-size: 13px;
    text-align: center;
    padding: 4px 0;
    border-radius: 3px 0 0 3px;
    background: linear-gradient(to right,#06b6d4,#3b82f6);
    background: -moz-linear-gradient(to right,#06b6d4,#3b82f6);
    background: -webkit-linear-gradient(to right,#06b6d4,#3b82f6);
    margin: auto;
    overflow: hidden;
    display: inline-block;
    text-transform: uppercase;
    color: #fff;
}
</style>
@endpush

