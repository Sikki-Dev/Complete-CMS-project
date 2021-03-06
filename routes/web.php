<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/', function () {
    return view('welcome');
});

//Route::auth();
Route::get('/home', 'HomeController@index');
Route::group(['middleware'=>'admin'], function (){
    Route::get('/admin',['as'=>'admin', function () {
        return view('admin.index');
    }]);
    Route::resource('admin/users','AdminUsersController',['names'=>[
    'index'=>'admin.users.index',
    'create'=>'admin.users.create',
    'store'=>'admin.users.store',
    'edit'=>'admin.users.edit',
    ]]);
    Route::resource('admin/posts','AdminPostsController',['names'=>[
        'index'=>'admin.posts.index',
        'create'=>'admin.posts.create',
        'store'=>'admin.posts.store',
        'edit'=>'admin.posts.edit',
    ]]);
    Route::resource('admin/categories','AdminCategoryController',['names'=>[
        'index'=>'admin.categories.index',
        'create'=>'admin.categories.create',
        'store'=>'admin.categories.store',
        'edit'=>'admin.categories.edit',
    ]]);
    Route::resource('admin/media','AdminMediasController',['names'=>[
        'index'=>'admin.media.index',
        'create'=>'admin.media.create',
        'store'=>'admin.media.store',
        'edit'=>'admin.media.edit',
    ]]);
    Route::resource('admin/comments','PostCommentController',['names'=>[
        'index'=>'admin.comments.index',
        'create'=>'admin.comments.create',
        'store'=>'admin.comments.store',
        'edit'=>'admin.comments.edit',
        'show'=>'admin.comments.show',
    ]]);
    Route::resource('admin/comment/replies','CommentRepliesController',['names'=>[
        'index'=>'admin.comment.replies.index',
        'create'=>'admin.comment.replies.create',
        'store'=>'admin.comment.replies.store',
        'edit'=>'admin.comment.replies.edit',
        'show'=>'admin.comment.replies.show',
    ]]);

});
Route::get('/post/{id}',['as'=>'home.post','uses'=>'AdminPostsController@post']);

Route::group(['middleware'=>'auth'], function () {
    Route::post('comment/reply','CommentRepliesController@createReply');
});

//Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//    \UniSharp\LaravelFilemanager\Lfm::routes();
//});

Route::delete('delete/media','AdminMediasController@deleteMedia');
Route::get('admin/dashboard',['as'=>'admin.dashboard', function (){
    echo "<h1 style='margin: 250px 500px;'>Dashboard under Process</h1>";

}]);