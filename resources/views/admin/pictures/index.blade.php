@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Pictures</h2></div>
          <div class="panel-body">
            
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
            <div class="d-inline-block">
              @foreach($pictures as $picture)
                    <img src="/images/pictures/{{$picture->file_name}}" class="img-responsive" height="70" width="90">
              @endforeach
              </div>
            </div>
            <hr>
            <image-component></image-component>    
          </div>
        </div>
      </div>
    </div>    
    
  </div>
</div>
<script>
    window.Laravel = <?php echo json_encode(
        [
        'csrfToken' => csrf_token(),
        ]
    ); ?>
</script>

@endsection
