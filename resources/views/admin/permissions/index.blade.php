@extends('layouts.admin')

@section('content')
<!-- Main content -->
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading">Permissions</div>
        <div class="panel-body">
          <a href="{{ url('/permissions/create') }}" class="btn btn-success btn-sm" title="Add New Permission">
              <i class="fa fa-plus" aria-hidden="true"></i> Add New
          </a>
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

  <!-- Main content -->
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              @if (count($permissions) > 0)
                <table class="table table-bordered table-striped {{ count($permissions) > 0 ? 'datatable' : '' }} dt-select">
                  <thead>
                    <tr>
                      <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                      <th>Title</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($permissions as $permission)
                    <tr data-entry-id="{{ $permission->id }}">
                      <td></td>
                      <td>{{ $permission->name }}</td>
                      <td><a href="{{ route('permissions.show',[$permission->id]) }}" class="btn btn-xs btn-primary">View</a><a href="{{ route('permissions.edit',[$permission->id]) }}" class="btn btn-xs btn-info">Edit</a>{!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('Are you sure?');",
                            'route' => ['permissions.destroy', $permission->id])) !!}
                            {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
                            {!! Form::close() !!}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              @else
                <div class="well text-center">No entries in table.</div>
              @endif
            </div>
            <!-- /.box-body -->


                <!-- Pagination -->
                <div class="pagination justify-content-center mb-4">
                    {{-- $permissions->links() --}}
                </div>
              </div>
            </div>
          </div>
        </div>    
      </div>
    </div>

@endsection

@section('script')
    <script>
        
    </script>
@endsection