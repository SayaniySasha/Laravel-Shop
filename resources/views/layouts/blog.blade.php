@extends('layouts.master')

    {{--Styles--}}
    @section('styles')
        <!-- Bootstrap core CSS -->
        <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
        <link href="/css/styles.css" rel="stylesheet">

    @endsection

    {{--Head--}}
    @section('head')
    @endsection
    
    @section('navigation')
       @include('shared.navigation')
    @endsection
    
    {{--Page--}}
    
    @section('page')
       <div class="row" id="app">
          @yield('content')
          @yield('sidebar')
       </div>
    @endsection

    @section('footer')
        @include('shared.footer')
    @endsection
    
    {{--Scripts--}}

    @section('scripts')
        <!-- Bootstrap core JavaScript -->
        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        
    @endsection
