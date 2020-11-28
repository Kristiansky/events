@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                @include('includes.alerts')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <legend>Filter {{$past ? __('Past') : __('Future')}} Events</legend>
                {!! Form::open(['method'=>'GET', 'route' => ['list_events', $past]]) !!}
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('title', 'Search by Title'); !!}
                            {!! Form::text('title', isset($get_params['title']) ? $get_params['title'] : null, array('class'=>'form-control', 'placeholder' => 'Enter title')); !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('status', 'Search by status'); !!}
                            {!! Form::select('status', [''=>'Choose option', 'hidden' => 'Hidden', 'active' => 'Active'], isset($get_params['status']) ? $get_params['status'] : null, array('class'=>'form-control')); !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('language', 'Language filter'); !!}
                            {!! Form::select('language', [''=>'Choose', 'bg' => 'Bulgarian', 'en' => 'English'], isset($get_params['language']) ? $get_params['language'] : null, array('class'=>'form-control')); !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('category_id', 'Search by category'); !!}
                            {!! Form::select('category_id', [''=>'Choose option'] + $categories, isset($get_params['category_id']) ? $get_params['category_id'] : null, array('class'=>'form-control')); !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('from', 'From date'); !!}
                            {!! Form::date('from', isset($get_params['from']) ? $get_params['from'] : null, array('class'=>'form-control', 'placeholder' => 'From date')); !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('to', 'To date'); !!}
                            {!! Form::date('to', isset($get_params['to']) ? $get_params['to'] : null, array('class'=>'form-control', 'placeholder' => 'To date')); !!}
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="form-group">
                            {!! Form::submit('Filter', array('class'=>'btn btn-primary')); !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <hr/>
                @if($events->count() > 0)
                    <legend>{{$past ? __('Past') : __('Future')}} Events</legend>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Language</th>
                            <th>Category</th>
                            <th>Start date</th>
                            <th>End date</th>
                            @guest
                            @else
                                <th colspan="2" class="text-center">Actions</th>
                            @endguest
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td><a href="{{route('event', $event->id)}}" target="_blank">{{$event->title}} <i class="fa fa-external-link-square"></i> </a></td>
                                <td>{{$event->status}}</td>
                                <td>{{$event->language}}</td>
                                <td>{{$event->category->name}}</td>
                                <td>{{$event->start_on ? Carbon\Carbon::createFromDate($event->start_on)->format('d.m.Y') : ''}}</td>
                                <td>{{$event->end_on ? Carbon\Carbon::createFromDate($event->end_on)->format('d.m.Y') : ''}}</td>
                                @guest
                                @else
                                    <td class="text-right">
                                        <a href="{{route('events.edit', $event->id)}}" class="btn btn-sm btn-primary">{{__('Edit')}}</a>
                                    </td>
                                    <td class="text-right">
                                        {!! Form::open(['method'=>'DELETE', 'route' => ['events.destroy', $event->id]]) !!}
                                        {!! Form::submit('Delete', array('class'=>'btn btn-danger btn-sm')); !!}
                                        {!! Form::close() !!}
                                    </td>
                                @endguest
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            {{$events->appends(request()->input())->links()}}
                        </div>
                    </div>
                @else
                    <p class="text-danger">No items to show.</p>
                @endif
            </div>
        </div>

    </div>
@endsection
