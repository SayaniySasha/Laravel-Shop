@extends('layouts.admin')

@section('content')

<!-- Main content -->
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading">Roles</div>
        <div class="panel-body">
          <a href="{{ url('/roles/create') }}" class="btn btn-success btn-sm" title="Add New Role">
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
            <div class="table-responsive">
            @if (count($roles) > 0)      
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Posted On</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ date('d F Y', strtotime($role->created_at)) }}</td>
                            <td>
                                <a title="Read role" href="{{ route('roles.show', ['id'=> $role->id]) }}" class="btn btn-primary"><span class="fa fa-newspaper-o"></span></a>
                                <a title="Edit role" href="{{ route('roles.edit', ['id'=> $role->id]) }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                                <button title="Delete role" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_role_{{ $role->id  }}"><span class="fa fa-trash-o"></span></button>
                            </td>
                        </tr>
    
                        <div class="modal fade" id="delete_role_{{ $role->id  }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <form class="" action="{{ route('roles.destroy', ['id' => $role->id]) }}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
                                <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header bg-red">
                                    <h4 class="modal-title" id="mySmallModalLabel">Delete role</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
    
                                    <div class="modal-body">
                                    Are you sure to delete role: <b>{{ $role->name }} </b>?
                                    </div>
                                    <div class="modal-footer">
                                    <a href="{{ url('/roles') }}">
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
                  @else
                    <div class="well text-center">No entries in table.</div>
                  @endif
                </div>
                <!-- Pagination -->
                <div class="pagination justify-content-center mb-4">
                    {{-- $roles->links() --}}
                </div>
              </div>
            </div>
          </div>
        </div>    
      </div>
    </div>
    @endsection
    
