@extends('layouts.cms.admin')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Detaile Role</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
    
    <div class="panel panel-default">
        
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><th>Title</th>
                    <td>{{ $role->title }}</td></tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('roles.index') }}" class="btn btn-default">Back to list</a>
        </div>
    </div>
            </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
@stop