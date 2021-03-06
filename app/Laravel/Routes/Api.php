<?php

/*,'domain' => env("FRONTEND_URL", "api.highlysucceed.com")*/
Route::group(['as' => "api.",
		 'namespace' => "Api"
		],function() {

	// ** api/blog
	Route::group(['prefix' => "blog",'as' => "blog."],function(){
		Route::post('/',['as' => "index",'uses' => "BlogController@index"]);
		Route::post('create',['as' => "store",'uses' => "BlogController@store"]);
		Route::post('edit/{id?}',['as' => "update",'uses' => "BlogController@update",'middleware' => ["api.exist:blog"] ]);
		Route::post('delete/{id?}',['as' => "destroy",'uses' => "BlogController@destroy",'middleware' => ["api.exist:blog"]]);
		Route::post('{id?}',['as' => "show",'uses' => "BlogController@show",'middleware' => ["api.exist:blog"]]);

	});

	// ** api/blog2
	Route::group(['prefix' => "blog2",'as' => "blog2."],function(){
		Route::post('/',['as' => "index",'uses' => "AnotherBlogController@index"]);
		Route::post('create',['as' => "store",'uses' => "AnotherBlogController@store"]);
		Route::post('edit/{id?}',['as' => "update",'uses' => "AnotherBlogController@update"]);
		Route::post('delete/{id?}',['as' => "destroy",'uses' => "AnotherBlogController@destroy"]);
		Route::post('{id?}',['as' => "show",'uses' => "AnotherBlogController@show"]);

	});

});