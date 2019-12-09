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

Route::get('/', function () {
    return view('welcome');
});

// 基礎方式,路由中輸出視圖
Route::get('/test', function () {
    return view('test');
});
//多請求路由
Route::match(['post','get'],'test1',function (){
    return view('test');
});

Route::any('test2',function (){
    return view('test');
});

// 路由參數(必填)
Route::get('test3/{id}',function ($id){
    return 'id:'. $id;
});
// 路由參數(非必填)
Route::get('test4/{id?}',function ($id = null){
    return 'id:'. $id;
});

// 正則方式
Route::get('test5/{id?}',function ($id = null){
    return 'id:'. $id;
})->where('id','[0-9]+');

// 多參數正則方式
Route::get('test6/{id}/{name?}',function ($id = 1,$name='dave'){
    return 'id:'. $id.' name:'.$name;
})->where(['id' => '[0-9]+','name' => '[a-z]+']);

// 路由別名
Route::get('test7',['as' => 'aaa',function (){
    return Route('aaa');
}]);

// 路由群組
Route::group(['prefix' => 'member'],function() {
    Route::match(['post','get'],'test1',function (){
        return view('test');
    });

    Route::any('test2',function (){
        return view('test');
    });
});


// 路由別名
Route::get('test7',['as' => 'aaa',function (){
    return Route('aaa');
}]);
