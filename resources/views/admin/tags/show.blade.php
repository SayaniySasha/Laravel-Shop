@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Show tag</h2></div>
          <div class="panel-body">

            <a href="{{ route('tags.index') }}" class="btn btn-success btn-sm" title="All tags">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back
            </a>
            <br/>
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
            <div class="table-responsive">
              <div class="card">
                <div class="card-header">
                  <b>{{$tag->name}}</b>
                </div>
                <div class="card-footer text-muted">
                  <div class="pull-right">
                    <a title="Edit tag" href="{{ url('/tags/'.$tag->id.'/edit/') }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                    <button title="Delete tag" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_tag_{{ $tag->id  }}"><span class="fa fa-trash-o"></span></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>

<div class="modal fade" id="delete_tag_{{ $tag->id  }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <form class="" action="{{ route('tags.destroy', ['id' => $tag->id]) }}" method="post">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-red">
          <h4 class="modal-title" id="mySmallModalLabel">Delete tag</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          Are you sure to delete tag: <b>{{ $tag->name }} </b>?
        </div>
        <div class="modal-footer">
          <a href="{{ url('/tags') }}">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          </a>
          <button type="submit" class="btn btn-outline" title="Delete" value="delete">Delete</button>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection
