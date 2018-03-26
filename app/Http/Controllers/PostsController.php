<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Gate;
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
        
        $posts = Post::paginate(3);

        $response = [
            'pagination' => [
                'total' => $posts->total(),
                'per_page' => $posts->perPage(),
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'from' => $posts->firstItem(),
                'to' => $posts->lastItem()
            ],
            'data' => $posts
        ];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  \App\Post::findOrFail($id);
        return view('blog.show', ['post' => $post, 'hescomment' => true]);
    }

    // PostsController, метод showBySlug:
    public function showBySlug($slug) 
    {
        if (is_numeric($slug)) {
            // Get post for slug.
            $post = Post::findOrFail($slug);
            
            return Redirect::to(route('blog.show', $post->slug), 301); 
            // 301 редирект со старой страницы, на новую.    
        }
        // Get post for slug.

        $post = Post::whereSlug($slug)->firstOrFail();
   
        $this->breadcrumbs
            ->addCrumb('Blog', 'blog')
            ->addCrumb($post->title, "");
   
        return view('blog.show', [
            'post' => $post,
            'hescomment' => true,
            'breadcrumbs' => $this->breadcrumbs 
            ]
        );
    }

    public function getById($id)
    {
        return \App\Post::findOrFail($id);
    }

    public function getPosts()
    {
        $posts = \App\Post::where('user_id', '=', Auth::id())->get();

        return view('blog.postlist', [
            'posts' => $posts,
            ]
        );

    }

    public function showPost($id)
    {
        
        
        // return \App\Post::findOrFail($id);
    }

    public function destroyPost($id)
    {   
        $user = Auth::user();
        $post = \App\Post::findOrFail($id);
        if (Gate::forUser($user)->allows('destroy-post', $post)) {
            // Пользователь может удалять статью...
            dd('Пользователь '.$user->name.' может удалять статью...');
        }
          
        if (Gate::forUser($user)->denies('destroy-post', $post)) {
            // Пользователь не может удалять статью...
            dd('Пользователь '.$user->name.' не может удалять статью...');
        }

        if ($user->can('destroy', $post)) {
            //
        }
          
        if ($user->cannot('destroy', $post)) {
            //
        }
          
          
    }

    public function editPost($id)
    {
        $post = \App\Post::findOrFail($id);

        if (Gate::allows('update-post', $post)) {
            // Текущий пользователь может редактировать статью...
            return view('blog.edit', [
                'post' => $post,
                ]
            );  
        }
        

        if (Gate::denies('update', $post)) {
            abort(403);
        }

        if (policy($post)->update($user, $post)) {
            //
        }
          

        if (Gate::denies('update-post', $post)) {
            // Текущий пользователь не может редактировать статью...
        }
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($request->user()->cannot('update-post', $post)) {
            abort(403);
        }

        if ($request->user()->can('update-post', $post)) {
            // Обновление статьи...
        }

        $this->authorize('update', $post);
  
        // Обновление статьи...
        // $this->authorizeForUser($user, 'update', $post);  
        
        // $this->authorize($post);
    }
    
    public function getFirstActive()
    {
        return \App\Post::where('active', 1)->first();
        
    }

    public function getByIds($ids)
    {
        // Также вы можете вызвать метод find с массивом первичных ключей,
        // который вернёт коллекцию подходящих записей:

        return \App\Post::find([1, 2, 3]);

    }

}
