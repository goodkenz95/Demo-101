<?php

Route::group(['as' => "frontend.",
		 'namespace' => "Frontend",
		 'middleware' => ["web"],
		],function() {

	Route::get('/',['as' => "index",'uses' => "MainController@index"]);

	Route::group(['as' => "blog.",'prefix' => "blog"],function(){
		Route::get('/',['as' => "index" , 'uses' => "BlogController@index"]);
		Route::get('create',['as' => "create" , 'uses' => "BlogController@create"]);
		Route::post('create',[ 'uses' => "BlogController@store"]);
		Route::get('edit/{id?}',['as' => "edit" , 'uses' => "BlogController@edit"]);
		Route::post('edit/{id?}',[ 'uses' => "BlogController@update"]);
		Route::any('delete/{id?}',['as' => "destroy" , 'uses' => "BlogController@destroy"]);


	});
});