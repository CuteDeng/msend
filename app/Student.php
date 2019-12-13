<?php
/**
 * Created by PhpStorm.
 * User: dxw
 * Date: 2019/12/9
 * Time: 2:14 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //  性別常量
    const SEX_UN = 10;
    const SEX_BOY = 20;
    const SEX_GIRL = 30;

    //指定表面
    protected $table = 'student';
    //指定主鍵
    protected $primaryKey = 'id';

    //自動維護create_at和update_at
    public $timestamps = true;

    //指定允許批量賦值的字段
    protected $fillable = ['name','age','sex'];

    //指定不允許批量賦值的字段
    protected  $guarded = [];

    //設置時間格式
//    public function getDateFormat(){
//        return 'Y-m-d H:i';
//    }

    //如果時間格式是時間戳，設置不進行格式化
//    public function asDateTime($value)
//    {
//        return $value;
//    }

    /**
     * @return array
     */
    public function sex($index = null){
        $arr = [
          self::SEX_UN => '未知',
          self::SEX_BOY => '男',
          self::SEX_GIRL => '女',
        ];
        if($index){
            return array_key_exists($index,$arr) ? $arr[$index] : $arr[self::SEX_UN];
        }
        return $arr;
    }
}
