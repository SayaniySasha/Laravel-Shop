@extends('cms.layouts.dashboard')

@section('content')
    <h3 class="page-title">Permissions</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            View
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><th>Title</th>
                        <td>{{ $permission->title }}</td></tr>
                        <tr><th>Description</th>
                        <td>{{ $permission->description }}</td></tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('permissions.index') }}" class="btn btn-default">Back to list</a>
        </div>
    </div>
@stop