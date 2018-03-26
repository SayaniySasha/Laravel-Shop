@extends('layouts.blog')

<!-- Page Heading/Breadcrumbs -->
@section('breadcrumb')
  {!! $breadcrumbs->render() !!} 
@endsection

@section('header')
<h2 class="mt-4 mb-3">{{ $post->title }}
  <small>by
    <a href="#">Janus Nic</a>
  </small>
</h2>

@endsection

@section('content')
<!-- Post Content Column -->
<div class="col-lg-8">
    @includeIf('blog.partials.single-post', ['post' => $post])
    <hr>
    @includeIf('blog.partials.quote', ['some' => 'data'])
    @includeWhen($hescomment, 'blog.partials.comments', ['some' => 'data'])
</div>
@endsection

@section('sidebar')
  @include('blog.partials.sidebar')
@endsection
