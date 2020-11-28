@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$event->title}}</h1>
                <p class="lead">{{$event->start_on ? Carbon\Carbon::createFromDate($event->start_on)->format('d.m.Y') : ''}} {{$event->start_on ? ' - ' . Carbon\Carbon::createFromDate($event->start_on)->format('d.m.Y') : ''}}</p>
                <p>{{$event->body}}</p>
                <small>Created: {{$event->created_at->diffForHumans()}}, updated: {{$event->updated_at->diffForHumans()}}</small>
            </div>
        </div>
    </div>
@endsection
