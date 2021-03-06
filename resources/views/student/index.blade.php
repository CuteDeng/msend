@extends('common.layouts')

@section('content')
    @include('common.message')
    <div class="card">
        <div class="card-header">
            学生列表
        </div>
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>年龄</th>
                    <th>性别</th>
                    <th>添加时间</th>
                    <th width="150">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <th scope="row">{{$student->id}}</th>
                    <td>{{$student->name}}</td>
                    <td>{{$student->age}}</td>
                    <td>{{$student->sexInfo($student->sex)}}</td>
                    <td>{{$student->created_at}}</td>
                    <td>
                        <a href="{{url('student/detail',['id' => $student->id])}}">详情</a>
                        <a href="{{url('student/update',['id' => $student->id])}}">修改</a>
                        <a href="{{url('student/delete',['id' => $student->id])}}" onclick="if(confirm('確定刪除？') == false) return false">删除</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div class="float-right">
        <div class="pull-right">
            {{$students->render()}}
        </div>
    </div>
@stop

