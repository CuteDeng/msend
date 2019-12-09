<?php
/**
 * Created by PhpStorm.
 * User: dxw
 * Date: 2019/12/9
 * Time: 11:01 AM
 */

namespace App\Http\Controllers;


class MemberController
{
    public function info(){
        return view('member/info',['name' => 'dave']);
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
