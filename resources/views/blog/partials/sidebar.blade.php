<!-- Sidebar Widgets Column -->
<div class="col-md-4">

  <!-- Search Widget -->
  <div class="card mb-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
      <form action="{{ url('search') }}" method="get">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." name="q" value="{{ request('q') }}">
        <span class="input-group-btn">
          <button class="btn btn-secondary" type="submit">Go!</button>
        </span>
      </div>
      </form>
    </div>
  </div>

  <!-- Categories Widget -->
  @widget('categories')

  <!-- Side Widget -->
  <div class="card my-4">
    <h5 class="card-header">Side Widget</h5>
    <div class="card-body">
      You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
    </div>
  </div>

</div>