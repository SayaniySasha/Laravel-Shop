@extends('layouts.profile')

@section('content')
<div id="wrapper">
        @include('profiles.partials.sidebar')
        <div id="page-content-wrapper">
            <div class="container-fluid">
              <div class="card-header">Dashboard</div>
                <div class="card-body">
                  <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
                <div class="table-responsive">

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
                  
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Posted On</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ date('d F Y', strtotime($post->created_at)) }}</td>
                            <td>
                                @can('show-post', $post)
                                    <a title="Read article" href="{{ route('user.posts.show', ['id'=> $post->id]) }}" class="btn btn-primary"><span class="fa fa-newspaper-o"></span></a>
                                @else
                                <!-- The Current User Can't Show The Post -->
                                @endcan

                                <a title="Edit article" href="{{ route('user.posts.edit', ['id'=> $post->id]) }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                                
                                @can('destroy', $post)
                                    <!-- Текущий Пользователь Может Удалялять Статью -->
                                <button title="Delete post" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_post_{{ $post->id  }}"><span class="fa fa-trash-o"></span></button>
                                @endcan
                            </td>
                        </tr>
    
                        <div class="modal fade" id="delete_post_{{ $post->id  }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <form class="" action="{{ route('user.posts.destroy', ['id' => $post->id]) }}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
                                <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header bg-red">
                                    <h4 class="modal-title" id="mySmallModalLabel">Delete post</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
    
                                    <div class="modal-body">
                                    Are you sure to delete post: <b>{{ $post->title }} </b>?
                                    </div>
                                    <div class="modal-footer">
                                    <a href="{{ url('/postlist') }}">
                                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                    </a>
                                    <button type="submit" class="btn btn-outline" title="Delete" value="delete">Delete</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                            </div>
                      
                      
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- Pagination -->
                <div class="pagination justify-content-center mb-4">
                    {{-- $posts->links() --}}
                </div>
    
                </div>
            </div>
        </div>
</div>
@endsection
