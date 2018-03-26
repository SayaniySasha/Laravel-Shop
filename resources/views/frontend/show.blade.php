@extends('layouts.blog')

@section('content')

    <div class="container" id="app">
      <h1> <a href="{{url('posts')}}">Blog HomePage</a></h1>
      <div class="blog-post">
        <h2 class="blog-post-title">{{ $article->title }}</h2>
        <p class="blog-post-meta">{{ date('M j, Y h:ia', strtotime($article->updated_at)) }} by <a href="#">{{ $article->user->name }}</a></p>
        <hr>
        <p>{!! $article->content !!}</p>
        <hr>

        
        @if (Auth::check())
          <h4>Hello {!! Auth::user()->name !!}!</h4>
          <comments :current-id='{!! $article->id !!}' :current-user='{!! Auth::user()->id !!}'></comments>
        @else
          <comments :current-id='{!! $article->id !!}'></comments>
        @endif  
        
      </div>
    </div>
@endsection
