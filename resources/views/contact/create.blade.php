@extends('layouts.app')

@section('jumbotron')
    <br>
    <div class="jumbotron">
        <div class="container">
            <h1>Contact Us</h1>
            <h2>Your message will be delivered to our clandestine team</h2>
            
        </div>
    </div>
@endsection

@section('content')

    <div class="row" style="margin-top: 25px;">

        <div class="col-md-4 col-sm-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title map">
                        <gmap-map map-type-id="roadmap"
                                style="width: 100%; height: 300px;"
                        >
                        </gmap-map>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" style="border: none;">
                                <span class="fa fa-calendar" style="color: #FFC200; padding-right: 5px;" aria-hidden></span>
                                @include('flash::message')
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-8 col-sm-12">

            <p>
                Send us your questions, comments, and suggestions and someone will be in touch within
                24 hours.
            </p>

            {!! Form::open(['route' => 'contact.store']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Your Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'E-mail Address') !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('msg', 'Message') !!}
                {!! Form::textarea('msg', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
            </div>

            {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

            {!! Form::close() !!}
            <br />
        </div>

    </div>

@endsection

