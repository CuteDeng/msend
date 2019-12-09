@extends('layouts')

@section('header')
    @parent
    this is header
@stop


@section('sidebar')
    <!-- 通過路由名稱生成url -->
    <a href="{{ url('student/urlTest') }}">url</a>
    <br>
    <a href="{{ action('StudentController@urlTest') }}">action</a>
    <br>
    <a href="{{ route('testurl') }}">route</a>
@stop


@section('content')
    <!-- 模板中輸出php變量 -->
    <p>{{$name}}</p>
    <!-- 模板中調用php代碼 -->
    <p>{{time()}}</p>
    <p>{{date('Y-m-d')}}</p>
    <!-- 原樣輸出 -->
    <p>@{{$name}}</p>
    <!-- 引入子視圖 -->
    @include('student.common',['msg' => 'this is a message'])
    <!-- 路程控制 -->
    @if($name == 'sean')
        <p>I am sean</p>
    @elseif($name == 'dave')
        <p>I am dave</p>
    @else
        <p>Who am I ?</p>
    @endif

    @unless($name == 'sean')
        <p>I am sean</p>
    @endunless
    <!-- 循環 -->
    @for($i = 0;$i<5;$i++)
        <p>{{$i}}</p>
    @endfor

    @foreach($students as $student)
        <p>{{$student}}</p>
    @endforeach
@stop
