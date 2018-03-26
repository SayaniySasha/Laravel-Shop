@extends('layouts.admin')
@section('content')
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading">Edit Role</div>
        <div class="panel-body">
          <a href="{{ url('/roles') }}" class="btn btn-success btn-sm" title="Go to Role">
              <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back
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
    
    {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id]]) !!}

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                
                <div class="col-md-12 form-group">
                    {!! Form::label('permission_list', 'Permissions:') !!}
                    {!! Form::select('permission_list[]', $permissions, $role->permissions, ['id' => 'permission_list', 'class' => 'form-control', 'multiple']) !!}
                           
                </div>
            </div>
            
        </div>
    
    {!! Form::submit('Update', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

        </div>
            </div>
          </div>
        </div>    
      </div>
    </div>

@stop

@section('scripts')
    <script>

        $('').select2({
            placeholder: 'Choose A Permissions',
            permissions: true 
        });
        $('#permission_list').select2().val({!! json_encode($role->permissions()->allRelatedIds()->toArray()) !!}).trigger('change');

    </script>
   
@stop
