<?php
/**
 * Created by PhpStorm.
 * User: dxw
 * Date: 2019/12/9
 * Time: 11:01 AM
 */

namespace App\Http\Controllers;


use App\Member;

class MemberController extends Controller
{
    public function info(){
        $name = Member::getMember();
        return view('member/info',['name' => $name]);
    }

    public function list(){
        echo 'member list';
    }

    public function edit(){
        return Route('memberedit');
    }

    public function update($id){
        echo 'member_'.$id;
    }
}
