<?php
/**
 * Created by PhpStorm.
 * User: dxw
 * Date: 2019/12/9
 * Time: 11:45 AM
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

/********************************************* 原生方式操作數據庫 *****************************/

    public function info(){
        $students =  DB::select('select * from student');
        dump($students);die;
    }

    public function add(){
        $bool = DB::insert('insert into student(name,age) values (?,?)',['dave',18]);
        dump($bool);die;
    }

    public function update(){
        $num = DB::update('update student set age = ? where name = ?',[20,'dave']);
        dump($num);die;
    }

    public function delete(){
        $num = DB::delete('delete from student where name = ?',['dave']);
        dump($num);die;
    }

/********************************************* 查詢構造器方式操作數據庫 *****************************/

    // 新增數據
    public function new(){
        $bool = DB::table('student')->insert([
            'name' => 'tom',
            'age' =>18
        ]);

        dump($bool);die;
    }

    //返回新增的id
    public function getNewId(){
        $id = DB::table('student')->insertGetId([
            'name' => 'jimmy',
            'age' => 20
        ]);
        dump($id);die;
    }

    //批量添加
    public function newStudents(){
        $bool = DB::table('student')->insert([
            ['name' => 'jack','age' => 30],
            ['name' => 'kary','age' => 50],
        ]);
        dump($bool);die;
    }

    public function edit(){
        $num = DB::table('student')
            ->where('id' , 1002)
            ->update(['age' => 33 ]);
        dump($num);die;
    }
    // 年齡自增3，默認自增1
    public function increAge(){
        $num = DB::table('student')
            ->where('id' , 1002)
            ->increment('age',3 );
        dump($num);die;
    }

    public function decreAge(){
        $num = DB::table('student')
            ->where('id' , 1002)
            ->decrement('age',3 );
        dump($num);die;
    }

    // 自增的同事修改其他字段
    public function increAgeAndUpdate(){
        $num = DB::table('student')
            ->where('id' , 1002)
            ->increment('age',3,['name' => 'tom2'] );
        dump($num);die;
    }
    // 刪除數據
    public function remove(){
        $num = DB::table('student')
            ->where('id' , '>=',1005)
            ->delete();
        dump($num);die;
    }

    // 清空數據
    public function truncateStudent(){
        DB::table('student')
            ->truncate();
    }

    //查詢數據
    public function getStudents(){
        $students = DB::table('student')->get()->toArray();
        dump($students);die;
    }

    //查詢數據,返回指定字段
    public function fieldsStudents(){
        $students = DB::table('student')->select('name','age')->get()->toArray();
        dump($students);die;
    }

    // 多條件查詢,返回指定字段
    public function findStudents(){
        $students = DB::table('student')->whereRaw('id >= ? and age > ?',[1,30])->pluck('name','name')->toArray();
        dump($students);die;
    }

    //查詢第一條數據
    public function firstStudent(){
        $student = DB::table('student')->first();
        dump($student);die;
    }

    //查詢數據,分段獲取
    public function chunkStudents(){
        DB::table('student')->orderBy('age','DESC')->chunk(1,function ($students){
            var_dump($students);
        });
    }

    //聚合函數
    public function calStudents(){
        $count = DB::table('student')->count();
        $maxAge = DB::table('student')->max('age');
        $minAge = DB::table('student')->min('age');
        $aveAge = DB::table('student')->avg('age');
        $sumAge = DB::table('student')->sum('age');
        dump($count,$maxAge,$minAge,$aveAge,$sumAge);die;
    }

}
