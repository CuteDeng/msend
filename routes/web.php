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

// 關連控制器
Route::get('member/info','MemberController@info');
Route::get('member/list',['uses' => 'MemberController@list']);
// 起別名
Route::get('member/edit',[
'uses' => 'MemberController@edit',
'as' => 'memberedit'
]);
// 參數綁定
Route::get('member/{id}/update',[
    'uses' => 'MemberController@update',
])->where('id','[0-9]+');

Route::get('student/info',[
    'uses' => 'StudentController@info',
]);

Route::get('student/add',[
    'uses' => 'StudentController@add',
]);

Route::get('student/update',[
    'uses' => 'StudentController@update',
]);
Route::get('student/delete',[
    'uses' => 'StudentController@delete',
]);

Route::get('student/new',[
    'uses' => 'StudentController@new',
]);

Route::get('student/getNewId',[
    'uses' => 'StudentController@getNewId',
]);

Route::get('student/newStudents',[
    'uses' => 'StudentController@newStudents',
]);

Route::get('student/edit',[
    'uses' => 'StudentController@edit',
]);

Route::get('student/increAge',[
    'uses' => 'StudentController@increAge',
]);

Route::get('student/decreAge',[
    'uses' => 'StudentController@decreAge',
]);

Route::get('student/increAgeAndUpdate',[
    'uses' => 'StudentController@increAgeAndUpdate',
]);

Route::get('student/remove',[
    'uses' => 'StudentController@remove',
]);

Route::get('student/truncateStudent',[
    'uses' => 'StudentController@truncateStudent',
]);

Route::get('student/getStudents',[
    'uses' => 'StudentController@getStudents',
]);

Route::get('student/findStudents',[
    'uses' => 'StudentController@findStudents',
]);

Route::get('student/firstStudent',[
    'uses' => 'StudentController@firstStudent',
]);

Route::get('student/fieldsStudents',[
    'uses' => 'StudentController@fieldsStudents',
]);

Route::get('student/chunkStudents',[
    'uses' => 'StudentController@chunkStudents',
]);

Route::get('student/calStudents',[
    'uses' => 'StudentController@calStudents',
]);

Route::get('student/allStudents',[
    'uses' => 'StudentController@allStudents',
]);

Route::get('student/oneStudent',[
    'uses' => 'StudentController@oneStudent',
]);

Route::get('student/getAllStudents',[
    'uses' => 'StudentController@getAllStudents',
]);

Route::get('student/getOneStudent',[
    'uses' => 'StudentController@getOneStudent',
]);

Route::get('student/getChunkStudents',[
    'uses' => 'StudentController@getChunkStudents',
]);

Route::get('student/countStudent',[
    'uses' => 'StudentController@countStudent',
]);

Route::get('student/newStudent',[
    'uses' => 'StudentController@newStudent',
]);

Route::get('student/createStudent',[
    'uses' => 'StudentController@createStudent',
]);

Route::get('student/firstOrCreateStudent',[
    'uses' => 'StudentController@firstOrCreateStudent',
]);

Route::get('student/firstOrNewStudent',[
    'uses' => 'StudentController@firstOrNewStudent',
]);

Route::get('student/updateOneStudent',[
    'uses' => 'StudentController@updateOneStudent',
]);

Route::get('student/updateStudents',[
    'uses' => 'StudentController@updateStudents',
]);

Route::get('student/deleteOneStudent',[
    'uses' => 'StudentController@deleteOneStudent',
]);

Route::get('student/destroyStudent',[
    'uses' => 'StudentController@destroyStudent',
]);

Route::get('student/deleteStudent',[
    'uses' => 'StudentController@deleteStudent',
]);

Route::get('student/studentInfo',[
    'uses' => 'StudentController@studentInfo',
]);

Route::any('student/urlTest',[
    'as' => 'testurl',
    'uses' => 'StudentController@urlTest',
]);

Route::any('student/requestTest',[
    'uses' => 'StudentController@requestTest',
]);

Route::any('student/responseTest',[
    'uses' => 'StudentController@responseTest',
]);

Route::group(['middleware' => ['web']],function (){
    Route::any('student/sessionTest1',[
        'uses' => 'StudentController@sessionTest1',
    ]);
    Route::any('student/sessionTest2',[
        'uses' => 'StudentController@sessionTest2',
    ]);
    Route::any('student/sessionTest3',[
        'uses' => 'StudentController@sessionTest3',
    ]);
});

Route::any('student/redirectTest',[
    'uses' => 'StudentController@redirectTest',
]);

Route::any('student/activity0',[
    'uses' => 'StudentController@activity0',
]);

Route::group(['middleware' => ['activity']],function (){
    Route::any('student/activity1',[
        'uses' => 'StudentController@activity1',
    ]);
    Route::any('student/activity2',[
        'uses' => 'StudentController@activity2',
    ]);
});

Route::group(['middleware' => ['web']],function (){
    Route::any('student/index',[
        'uses' => 'StudentController@index',
    ]);
    Route::any('student/create',[
        'uses' => 'StudentController@create',
    ]);
    Route::any('student/save',[
        'uses' => 'StudentController@save',
    ]);
});








