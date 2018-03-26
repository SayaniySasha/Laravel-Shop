<template>
  <div class="container">
      <div class="well well-sm">
          <div class="form-group">
              <div class="input-group input-group-md">
                  <div class="icon-addon addon-md">
                      <input type="text" placeholder="What are you looking for?" name="query"  class="form-control" v-model="query">
                  </div>
                  <span class="input-group-btn">
                      <button class="btn btn-default" type="button" v-on:click="search()" v-if="!loading">Search!</button>
                      <button class="btn btn-default" type="button" disabled="disabled" v-if="loading">Searching...</button>
                  </span>
              </div>
          </div>

      </div>

      <div class="alert alert-danger" role="alert" v-if="error">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          {{ error }}
      </div>

      <div id="posts" class="row list-group" v-if="posts[0]">

      <div class="item col-xs-4 col-lg-4" v-for="post in posts">
          <div class="thumbnail">
                  <img class="group list-group-image" :src="post.post_thumbnail" :alt="post.title" />
                  <div class="caption">
                      <h4 class="group inner list-group-item-heading">{{ post.title }}</h4>
                      <p class="group inner list-group-item-text">{{ post.content | truncate }}</p>
                      <div class="row">
                          <div class="col-xs-12 col-md-6">
                              <p class="lead">{{ post.updated_at }}</p>
                          </div>
                          <div class="col-xs-12 col-md-6">
                              <a class="btn btn-success" href="#">Read more</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>

  export default {
    data: () => ({
	    posts: [],
	    loading: false,
	    error: false,
    	query: ''
	}),

  filters: {
    truncate: function truncate(value) {
      var length = 20;
      if(value.length <= length) {
          return value;
      }
      else {
          return value.substring(0, length) + '...';
      }
  }
},


mounted: function(){
    this.search();
  },

	methods: {
	    search: function() {
	        // Clear the error message.
	        this.error = '';
	        // Empty the posts array so we can fill it with the new posts.
	        this.posts = [];
	        // Set the loading property to true, this will display the "Searching..." button.
	        this.loading = true;

	        // Making a get request to our API and passing the query to it.

          // this.query = 'cumque';
	        this.$http.get('/api/search?q=' + this.query).then((response) => {
	            // If there was an error set the error message, if not fill the posts array.
	            //response.error ? this.error = response.error : this.posts = response;
              this.posts = response.body;
	            // The request is finished, change the loading to false again.
	            this.loading = false;
	            // Clear the query.
	            this.query = '';
	        });
	    }
	}

}
</script>
