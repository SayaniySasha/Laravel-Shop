@extends('layouts.blog')


@section('breadcrumb')

<ol class="breadcrumb">
<li class="breadcrumb-item">
  <a href="{{ url('/') }}">Home</a>
</li>
<li class="breadcrumb-item active">Search Page</li>
</ol>
@endsection

@section('header')
<!-- Page Heading/Breadcrumbs -->
<h2 class="mt-4 mb-3">Blog Home One
    <small>Subheading</small>
</h2>
@endsection

@section('content')
<!-- Blog Entries Column -->
<div class="col-md-8" id="blog">
  
  <div class="card mb-4">
    <search></search>
  </div>
</div>
@endsection

@section('sidebar')
  @include('blog.partials.sidebar')
@endsection
<!-- /.row -->