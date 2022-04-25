@extends('home')

@section('center')
    <div class="mvims" style="height:265px;">
        @foreach ($mvims as $mv)
            <div class="mv text-center">
                <img src="{{ asset('storage/' . $mv->img) }}">
            </div>
        @endforeach
    </div>
    <div class="news" style="height:265px;">
        <div class="text-center py-2 border-bottom my-1">最新消息區
            @isset($more)
                <a href="{{ $more }}" class="float-right">More......</a>
            @endisset
        </div>
        <ul class="list-group" style="position:relative;">
            @foreach ($news as $key => $new)
                <li class="list-group-item list-group-item-action p-1 new" style="position: unset;">
                    {{ $key + 1 }}. {{ mb_substr($new->text, 0, 20, 'UTF-8') }}...
                    <div style="border:1px solid orange; box-shadow:1px 5px 5px #ccc;background:yellow;display:none;width:75%;position:absolute;top:0;right:0;white-space:pre-wrap;font-size:87%;padding:10px">{{$new->text}}</div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
