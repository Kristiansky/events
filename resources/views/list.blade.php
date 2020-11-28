@extends('layouts.app')

@section('content')
    <div class="container">
        {{--<div class="row">
            <div class="col-md-10">
                @include('includes.alerts')
            </div>
        </div>--}}
        <div class="row">
            <div class="col-md-12">
                @if($events->count() > 0)
                    <legend>Filter</legend>
                    {!! Form::open(['method'=>'GET', 'route' => ['list_events', 0]]) !!}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('title', 'Search by Title'); !!}
                                {!! Form::text('title', isset($get_params['title']) ? $get_params['title'] : null, array('class'=>'form-control', 'placeholder' => 'Enter title')); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('category_id', 'Search by category'); !!}
                                {!! Form::select('category_id', [''=>'Choose option'] + $categories, isset($get_params['category_id']) ? $get_params['category_id'] : null, array('class'=>'form-control')); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('from', 'From date'); !!}
                                {!! Form::date('from', isset($get_params['from']) ? $get_params['from'] : null, array('class'=>'form-control', 'placeholder' => 'From date')); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
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
                    <legend>People</legend>
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Start date</th>
                            <th>End date</th>
                            {{--@guest
                            @else
                                <th colspan="2" class="text-center">Actions</th>
                            @endguest--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{$event->title}}</td>
                                <td>{{$event->start_on ? Carbon\Carbon::createFromDate($event->start_on)->format('d.m.Y') : ''}}</td>
                                <td>{{$event->end_on ? Carbon\Carbon::createFromDate($event->end_on)->format('d.m.Y') : ''}}</td>
                                {{--@guest
                                @else
                                    <td class="text-right">
                                        <a href="{{route('people.edit', $person->id)}}" class="btn btn-sm btn-primary">{{__('Edit')}}</a>
                                    </td>
                                    <td class="text-right">
                                        {!! Form::open(['method'=>'DELETE', 'route' => ['people.destroy', $person->id]]) !!}
                                        {!! Form::submit('Delete', array('class'=>'btn btn-danger btn-sm')); !!}
                                        {!! Form::close() !!}
                                    </td>
                                @endguest--}}
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
