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
                  
                     <h3>{{ $post->title }}</h3>
                     <p>
                     {{ date('d F Y', strtotime($post->created_at)) }}

                     Posted By {{ $post->user->name }}
                     </p>
                </div>
    
                </div>
            </div>
        </div>
</div>
@endsection
