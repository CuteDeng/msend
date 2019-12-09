<?php
/**
 * Created by PhpStorm.
 * User: dxw
 * Date: 2019/12/9
 * Time: 11:23 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public static function getMember(){
        return 'dave';
    }
}
