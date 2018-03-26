@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
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

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong>Edit</strong> User
              <a href="{{ route('users.index') }}" class="btn btn-success btn-sm" title="All Posts">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back
              </a>
          </div>

          <div class="card-block">

          {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update', $user->id]]) !!}

            <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
              {!! Form::label('name', 'User Name', array('class' => 'col-md-3 control-label')); !!}
              <div class="col-md-9">
                <div class="input-group">
                  {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control')) !!}
                  <label class="input-group-addon" for="name"><i class="fa fa-fw-user" aria-hidden="true"></i></label>
                </div>
                @if ($errors->has('name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>



               
                            

            <div class="form-group has-feedback row {{ $errors->has('roles') ? ' has-error ' : '' }}">
              
              {!! Form::label('role_list', 'User Roles*', array('class' => 'col-md-3 control-label')) !!}

              <div class="col-md-9">
                <div class="input-group">
                {!! Form::select('role_list[]', $roles, $user->roles, ['id' => 'role_list', 'class' => 'form-control select2', 'multiple']) !!}
                  <label class="input-group-addon" for="roles"><i class="fa fa-fw-user" aria-hidden="true"></i></label>
                </div>
                @if($errors->has('roles'))
                  <span class="help-block">
                      <strong>{{ $errors->first('roles') }}</strong>
                  </span>
                @endif
              </div>
            </div>


            

            <div class="form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
              {!! Form::label('first_name', 'First Name', array('class' => 'col-md-3 control-label')); !!}
              <div class="col-md-9">
                <div class="input-group">
                  {!! Form::text('first_name', old('first_name'), array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'First Name')) !!}
                  <label class="input-group-addon" for="name"><i class="fa fa-fw" aria-hidden="true"></i></label>
                </div>
                @if ($errors->has('first_name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('first_name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group has-feedback row {{ $errors->has('last_name') ? ' has-error ' : '' }}">
              {!! Form::label('last_name', 'Last Name', array('class' => 'col-md-3 control-label')); !!}
              <div class="col-md-9">
                <div class="input-group">
                  {!! Form::text('last_name', old('last_name'), array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Last Name')) !!}
                  <label class="input-group-addon" for="name"><i class="fa fa-fw" aria-hidden="true"></i></label>
                </div>
                @if ($errors->has('last_name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('last_name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            
            
            {!! Form::button('<i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;' . 'Update User', array('class' => 'btn btn-success btn-flat margin-bottom-1 pull-right','type' => 'submit', )) !!}
          {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
    <script>
        $('').select2({
            placeholder: 'Choose A Role',
            roles: true 
        });
        $('#role_list').select2().val({!! json_encode($user->roles()->allRelatedIds()->toArray()) !!}).trigger('change');


    </script>
   
@stop