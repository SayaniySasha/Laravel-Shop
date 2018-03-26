<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;

use App\Post;
use App\Category;
use App\Tag;
use Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create')
        ->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->is_active = $request->is_active;
        $post->user_id = Auth::id();

        $post->save();
        
        if ($request->hasFile('image') ) {
            $post_thumbnail = $request->file('image');
         
            $filename = time() . '.' . $post_thumbnail->getClientOriginalExtension();
                           
            \Image::make($post_thumbnail)->resize(300, 300)->save( public_path('images/pictures/' . $filename ) );
    
        }
        

        $image = new \App\Picture();
        $image->file_name = $filename;
        $image->save();

        $picid = \App\Picture::all()->last()->id;

        $post->pictures()->sync($picid, false);

        $post->tags()->sync($request->tags, false);
        return redirect(route('posts.index'))->with('message', 'The blog post was successfully save!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.posts.show')->withPost($post);;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $post = Post::find($id);
       $categories = Category::pluck('name', 'id');
       $tags = Tag::pluck('name', 'id');
       return view('admin.posts.edit')->withPost($post)->withCategories($categories)->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->is_active = $request->is_active;
        
        $post->save();
        
        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }

        return redirect(route('posts.index'))->with('message', 'An article has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post->delete();

        return redirect(route('posts.index'))->with('message', 'An article has been deleted');
    }
}
