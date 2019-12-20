<?php
/**
 * Created by PhpStorm.
 * User: dxw
 * Date: 2019/12/9
 * Time: 11:45 AM
 */

namespace App\Http\Controllers;


use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

//    public function update(){
//        $num = DB::update('update student set age = ? where name = ?',[20,'dave']);
//        dump($num);die;
//    }

//    public function delete(){
//        $num = DB::delete('delete from student where name = ?',['dave']);
//        dump($num);die;
//    }

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

    /********************************************* ORM方式操作數據庫 *****************************/

    public function allStudents(){
        $students = Student::all()->toArray();
        dump($students);die;
    }

    public function oneStudent(){
        $student = Student::find(1);
        $student1 = Student::findOrFail(1000);
        $name = $student1->name;
        dump($name);die;
    }

    public function getAllStudents(){
        $students = Student::get();
        dd($students);die;
    }

    public function getOneStudent(){
        $student = Student::where('id','=','6')
            ->orderBy('age','desc')
            ->first();
        echo $student->created_at;
        dd($student);die;
    }

    public function getChunkStudents(){
         Student::chunk(2,function ($students){
             var_dump($students);
         });
    }

    public function countStudent(){
        $count = Student::count();
        $maxAge = Student::max('age');
        dd($count,$maxAge);die;
    }

    public function newStudent(){
        $student = new Student();
        $student->name = 'jason';
        $student->age = 30;
        $bool = $student->save();
        dd($bool);die;
    }

    public function createStudent(){
        $student = Student::create([
            'name' => 'mild',
            'age' => 21,
            'sex' => 30
        ]);
        dump($student);die;
    }
    //通過屬性查找記錄，不存在則新增
    public function firstOrCreateStudent(){
        $student = Student::firstOrCreate([
           'name' => 'dave'
        ]);
        dd($student);
    }

    //通過屬性查找記錄，不存在則新增實例
    public function firstOrNewStudent(){
        $student = Student::firstOrNew([
            'name' => 'marquis'
        ]);
        $bool = $student->save();
        dd($student,$bool);
    }

    public function updateOneStudent(){
        $student = Student::find(14);
        $student->name = 'travis';
        $bool = $student->save();
        dd($bool);die;
    }

    public function updateStudents(){
        $num = Student::where('id','<','5')
            ->update([
                'age' => 41
            ]);
        dd($num);die;
    }

    public function deleteOneStudent(){
        $bool = $student = Student::find(14);
        $student->delete();
        dd($bool);die;
    }

    public function destroyStudent(){
        $num = $student = Student::destroy([12,13]);
        dd($num);die;
    }

    public function deleteStudent(){
        $num = $student = Student::where('id','<','10')
            ->delete();
        dd($num);die;
    }

    /********************************************* 使用模板 *****************************/

    public function studentInfo(){
        return view('student.info',['name' => 'dave','students' => ['a','b']]);
    }

    public function urlTest(){
        return 'urlTest';
    }

    /******************************************* Controller ****************************/

    public function requestTest(Request $request){
        // 取值
        $name = $request->input('name','dave');
        dump($name);
        // 判斷有沒有值
        if($request->has('name')){
            echo $request->input('name');
        }else{
            echo '不存在';
        }
        // 獲取url中所有參賽
        $params = $request->all();
        dump($params);
        // 判斷請求類型
        $method = $request->method();
        dump($method);
        if($request->isMethod('GET')){
            echo  'yes';
        }else{
            echo  'no';
        }
        //判斷是否是ajax
        if($request->ajax()){
            echo 'ajax request';
        }
        // 判斷請求格式
        if($request->is('student/*')){
            dump('success');
        }else{
            dump('fail');
        }
        // 獲取當前url
        dump($request->url());
        die;
    }

    public function sessionTest1(Request $request){
        // 使用$request的session()方法操作session
        $request->session()->put('key1','value1');
        $key1 = $request->session()->get('key1');
        dump($key1);
        die;
    }

    public function sessionTest2(){
        // 使用session辅助函数
        session()->put('key2','value2');
        $key2 = session()->get('key2');
        dump($key2);
        $message = session()->get('message');
        dump($message);
        die;
    }

    public function sessionTest3(){
        // 使用Session类
        Session::put('key3','value3');
        $key3 = Session::get('key3');
        dump($key3);
        $key4 = Session::get('key4','value4');
        dump($key4);
        Session::put(['key5' => 'value5','key6' => 'value6']);
        $key5 = Session::get('key5');
        $key6 = Session::get('key6');
        dump($key5);
        dump($key6);
        // 使用数组的方式存储session
        Session::push('key','value7');
        Session::push('key','value8');
        $key7 = Session::get('key');
        dump($key7);
        // 从session中取出后删除该session
        $key7 = Session::pull('key');
        dump($key7);
        //判断某个session是否存在
        $bool = Session::has('key');
        dump($bool);
        // 从session中取出所有值
        $all = Session::all();
        dump($all);
        // 删除session
        Session::forget('key3');
        dump(Session::has('key3'));
        // 清空session
        Session::flush();
        dump(Session::all());
        // 暂存session,只保存一次请求
        Session::flash('key8','value8');
        dump(Session::get('key8'));
        die;
    }

    public function responseTest(){
        $data = [
            'errorCode' => 0,
            'errorMessage' => 'success',
            'data' => []
        ];
        return \response()->json($data);
    }


    public function redirectTest(){
        //重定向
        return redirect()->route('testurl')->with('test','test');
        // 或者
        return redirect()->action('StudentController@sessionTest2')->with('message' ,'flush data aaa');
        // 或者
        return redirect('student/sessionTest2')->with('message' ,'flush data');
        // 返回上一个页面
        return redirect()->back();
    }

    public function middlewareTest(){

    }

    public function activity0(){
        echo '活动还未开始';
    }

    public function activity1(){
        echo '活动正在进行';
    }

    public function activity2(){
        echo '活动已经结束';
    }

    /******************************************* Form ****************************/

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $students = Student::paginate(10);
        return view('student.index',['students' => $students]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(Request $request){
        $studnet = new Student();
        if($request->isMethod('POST')){

            // 表单验证，Validator类验证
            $validator = Validator::make($request->input(),[
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ],[
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'max' => ':attribute 为必填项',
                'integer' => ':attribute 必须为整数',
            ],[
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = $request->input('Student');

            if(Student::create($data)){
                return redirect('student/index')->with('success','添加成功');
            }else{
                return redirect()->back()->with('error','添加失败');
            }
        }
        return view('student.create',[
            'student' => $studnet
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request){
        $data = $request->input('Student');
        $student = new Student();
        $student->name = $data['name'];
        $student->age = $data['age'];
        $student->sex = $data['sex'];

        if($student->save()){
            return redirect('student/index');
        }else{
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request,$id) {
        $student = Student::find($id);
        if($request->isMethod('POST')){
            // 表单验证，控制器验证
            $this->validate($request,[
               'Student.name' => 'required|min:2|max:20',
               'Student.age' => 'required|integer',
               'Student.sex' => 'required|integer',
            ],[
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'max' => ':attribute 为必填项',
                'integer' => ':attribute 必须为整数',
            ],[
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);
            $data = $request->input('Student');
            $student->name = $data['name'];
            $student->age = $data['age'];
            $student->sex = $data['sex'];
            if($student->save()){
                return redirect('student/index')->with('success','修改成功 => '.$id);
            }
        }
        return view('student.update',[
            'student' => $student
        ]);
    }

    public function detail($id){
        $student = Student::find($id);
        return view('student.detail',[
            'student' => $student
        ]);
    }

    public function delete($id){
        $student = Student::find($id);
        if($student->delete()){
            return redirect('student/index')->with('success','刪除成功 =>'.$id);
        }else{
            return redirect('student/index')->with('error','刪除失敗 =>'.$id);
        }
    }
}
