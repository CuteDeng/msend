@extends('common.layouts')

@section('content')
    @include('common.validator')
    <div class="card ">
        <div class="card-header">新增学生</div>
        <div class="card-body text-center">
            @include('student._form')
        </div>
    </div>
    <br>
@stop
