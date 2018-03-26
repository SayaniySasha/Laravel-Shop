<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::name('welcome')->get('/', function () {
    return view('welcome');
});


Route::get('blog', function () {
    return view('blog.index');
})->name('blog');

Route::get('blogposts', 'PostsController@index')->name('blogposts');

// Route::get('blog/{id}', ['uses' => 'PostsController@show', 'as' => 'blog.show']);

Route::get('blog/{slug}', 'PostsController@showBySlug')->name('blog.show');


// Admin
Route::get('admin', 'Admin\DashboardController@index')->name('admin');
Route::resource('posts', 'Admin\PostsController'); 
Route::resource('categories', 'Admin\CategoriesController'); 
Route::resource('tags', 'Admin\TagsController');
Route::resource('users', 'Admin\UsersManagementController');
Route::resource('roles', 'Admin\RolesController');
Route::resource('permissions', 'Admin\PermissionsController');
Route::get('/trashed', 'Admin\UsersManagementController@indexTrashed')->name('users.trashed');

Route::post('/restore/{id}', 'Admin\UsersManagementController@restore')->name('users.restore');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Route::get('profile/{username}', [
//     'as'   => '{username}',
//     'uses' => 'ProfileController@show',
//     ]
// );

Route::get('/post', 'PostsController@getPosts')->name('user.posts');

Route::get('/post/{post}', 'PostsController@showPost')->name('user.posts.show');

Route::get('/post/{post}/edit', 'PostsController@editPost')->name('user.posts.edit');

Route::delete('/post/{post}', 'PostsController@destroyPost')->name('user.posts.destroy');


Route::group(
    [
        'middleware' => ['auth', 'currentUser']], function () {
            Route::get(
                'profile/{username}', [
                    'as'   => '{username}',
                    'uses' => 'ProfileController@show',
                    ]
            );
        }
);


Route::get('/email', function () {
    return new App\Mail\ContactEmail();
});

Route::get('contact', 'ContactController@create')->name('contact.create');
Route::post('contact', 'ContactController@store')->name('contact.store');

Route::get('/verify/token/{token}', 'Auth\VerificationController@verify')->name('auth.verify'); 
Route::get('/verify/resend', 'Auth\VerificationController@resend')->name('auth.verify.resend');

// Socialite Register Routes
Route::get('social/{provider}', 'Auth\SocialController@redirect')->name('social.redirect');
Route::get('social/{provider}/callback', 'Auth\SocialController@handle')->name('social.handle');

Route::get('/pictures', 'Admin\PicturesController@index');
Route::post('/image/store', 'Admin\PicturesController@store');

Route::get('/articles', function () {
    return view('articles.index', [
        'articles' => App\Entities\Article::all(),
    ]);
});

// Route::get('/{slug}', 'PagesController@index');

use \App\Repositories\ArticlesRepository;

Route::get('/search', function (ArticlesRepository $repository) {
    $articles = $repository->search((string) request('q'));
    return view('articles.index', [
    	'articles' => $articles,
    ]);
});