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
<h2 class="mt-4 mb-3">Blog Home One
    <small>Subheading</small>
</h2>
@endsection

@section('content')
<!-- Blog Entries Column -->
<div class="col-md-8" id="blog">
  
  <div class="card mb-4">
    <div v-for="post in posts">
          <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
          
          <div class="card-body">
              <h2 class="card-title">@{{ post.title }}</h2>  
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
              
              <a :href="'/blog/' + post.slug" class="btn btn-primary">Read More &rarr;</a>
          </div>

          <div class="card-footer text-muted">
              Posted on  by&nbsp;
              <a href=""> Janus Nic</a>
          </div>

    <!-- Pagination -->
    </div>
    <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="3" @paginate="fetchPosts()"></pagination>
  </div>
</div>
@endsection

@section('sidebar')
  @include('blog.partials.sidebar')
@endsection
<!-- /.row -->
