@extends('layouts.blog')

@section('title', '| View Page')

@section('content')

  <div class="container" id="app">
      <div class="blog-header">
        <h1 class="blog-title"><a href="{{url('posts')}}">Welcome to my blog</a></h1>
        <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
      </div>

    @foreach ($articles as $article )
      <div><a href="{{url('post')}}/{{$article->id}}">
        <h2 class="blog-post-title">{{$article->title}}</h2></a>
        <p>{{ $article->summary }}</p>
        <hr>
        <p class="blog-post-meta">{{ date('M j, Y h:ia', strtotime($article->updated_at)) }} by <a href="#">Janus</a></p>
        
      </div>
    @endforeach
  </div>

@endsection
