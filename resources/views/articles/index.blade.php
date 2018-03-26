@extends('layouts.blog')


@section('breadcrumb')

<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="{{ url('/') }}">Home</a>
</li>
<li class="breadcrumb-item active">Blog Home</li>
</ol>
@endsection

@section('header')
<!-- Page Heading/Breadcrumbs -->
<h2 class="mt-4 mb-3">Articles <small>({{ $articles->count() }})</small>
</h2>
@endsection

@section('content')
<!-- Blog Entries Column -->
<div class="col-md-8">
    <div class="panel-body">
      @forelse ($articles as $article)
        <article>
          <h2>{{ $article->title }}</h2>
          <p>{{ $article->content }}</body>

        </article>
      @empty
        <p>No articles found</p>
      @endforelse
    </div>
</div>

@endsection

@section('sidebar')
  @include('blog.partials.sidebar')
@endsection
<!-- /.row -->
