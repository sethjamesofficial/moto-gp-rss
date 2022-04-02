@extends('components.layout')

@section('content')
<div class="container">
    <div class="main-container">
        @foreach($channels as $channel)
        <div class="row">
            <div class="col">
                <a href="{{route('channels.show', $channel)}}">{{$channel->title}}</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
