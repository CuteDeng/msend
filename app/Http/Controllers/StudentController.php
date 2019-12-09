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
    // 原生方式操作數據庫
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
}
