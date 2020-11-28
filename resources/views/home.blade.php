@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Go to <a href="{{route('list_events', 0)}}">Future events</a> </h1>
            <h1>Go to <a href="{{route('list_events', 1)}}">Past events</a> </h1>
        </div>
    </div>
</div>
@endsection
