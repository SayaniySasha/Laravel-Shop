@extends('layouts.blog')

<!-- Page Heading/Breadcrumbs -->
@section('breadcrumb')
  {!! $breadcrumbs->render() !!} 
@endsection


@section('content')

          <div class="blog-post">

            <h2 class="blog-post-title">{{ $content->title }}</h2>
            <p class="blog-post-meta">{{ date('M j, Y h:ia', strtotime($content->updated_at)) }} by <a href="#">Janus</a></p>

      			<p>{!! $content->content !!}</p>
      
            <hr>
      
          </div><!-- /.blog-post -->

@endsection
