@extends('layouts.admin')


@section('content')
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading">New Permission</div>
        <div class="panel-body">
          <a href="{{ url('/permissions') }}" class="btn btn-success btn-sm" title="Add New Permission">
              <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back
          </a>
            <br/>
            @if (Session::get('message') != Null)
              <div class="row">
                  <div class="col-md-9">
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          {{ Session::get('message') }}
                      </div>
                  </div>
              </div>
            @endif

            <br/>

        
          {!! Form::open(['method' => 'POST', 'route' => ['permissions.store']]) !!}
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
              </div>
            </div>
          </div>

            {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
        
              </div>
            </div>
          </div>
        </div>    
      </div>
    </div>

@stop
