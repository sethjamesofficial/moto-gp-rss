@extends('components.layout')

@section('content')
<div class="container">
    <div class="main-container">
        @foreach ($channel->items as $item)
        <div class="card" onclick="showButton({{$item->id}})">
            <div class="row no-gutters">
                <div class="col-2">
                    <img src="{{$item->image_link}}" class="img-fluid" alt="Preview image for {{$item->title}}">
                </div>
                <div class="col">
                    <div class="card-block p-2">
                        <h4 class="card-title">{{$item->title}}</h4>
                        <p class="card-text">{{$item->description}}</p>
                        <a href="{{$item->link}}" id="button{{$item->id}}" style="display:none" class="btn btn-primary">View article</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showButton(itemId) {
        var button = document.getElementById("button"+itemId);
        if (window.event.altKey) {
            if (button.style.display === "none") {
                button.style.display = "inline-block";
            } else {
                button.style.display = "none";
            }
        }
    }
</script>
@endsection
