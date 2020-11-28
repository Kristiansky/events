@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @include('includes.form-errors')
                @include('includes.alerts')
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                {!! Form::open(['method'=>'PATCH', 'route' => ['events.update', $event->id]]) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Title'); !!} <i class="fa fa-asterisk text-danger"></i>
                    {!! Form::text('title', $event->title, array('class'=>'form-control', 'autocomplete' => 'off')); !!}
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'Event status'); !!} <i class="fa fa-asterisk text-danger"></i>
                    {!! Form::select('status', ['' => 'Choose option', 'hidden' => 'Hidden', 'active' => 'Active'], $event->status, array('class'=>'form-control')); !!}
                </div>
                <div class="form-group">
                    {!! Form::label('language', 'Language'); !!} <i class="fa fa-asterisk text-danger"></i>
                    {!! Form::select('language', ['' => 'Choose option', 'bg' => 'Bulgarian', 'en' => 'English'], $event->language, array('class'=>'form-control')); !!}
                </div>
                <div class="form-group">
                    {!! Form::label('category_id', 'Event category'); !!} <i class="fa fa-asterisk text-danger"></i>
                    {!! Form::select('category_id', $categories, $event->category_id, array('class'=>'form-control')); !!}
                </div>
                <div class="form-group">
                    {!! Form::label('body', 'Event text'); !!}
                    {!! Form::textarea('body', $event->body, array('class'=>'form-control', 'rows'=>'15')); !!}
                </div>
                <div class="form-group">
                    {!! Form::label('start_on', 'Starting date'); !!} <i class="fa fa-asterisk text-danger"></i>
                    {!! Form::date('start_on',  $event->start_on, array('class'=>'form-control', 'autocomplete' => 'off')); !!}
                </div>
                <div class="form-group">
                    {!! Form::label('end_on', 'End date'); !!} <i class="fa fa-asterisk text-danger"></i>
                    {!! Form::date('end_on',  $event->end_on, array('class'=>'form-control', 'autocomplete' => 'off')); !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Update', array('class'=>'btn btn-primary')); !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
