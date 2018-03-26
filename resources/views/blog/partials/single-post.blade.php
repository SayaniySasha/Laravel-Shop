<!-- Preview Image -->
<img class="img-fluid rounded" src="/images/pictures/{{ $post->pictures[0]->file_name }}" alt="">

<hr>

<!-- Date/Time -->
<p>Posted on {{ date('d F Y', strtotime($post->created_at)) }}</p>

<hr>
Category: <button type="button" class="btn btn-outline-success">{{ $post->category->name }}</button>
<!-- Post Content -->
<p class="lead">{{ $post->content }}</p>
