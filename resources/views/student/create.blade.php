@extends('common.layouts')

@section('content')
    @include('common.validator')
    <div class="card ">
        <div class="card-header">新增学生</div>
        <div class="card-body text-center">
            <form action="" method="post">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 control-label">姓名</label>
                    <div class="col-sm-5">
                        <input type="text" name="Student[name]" value="{{old('Student')['name']}}" class="form-control" id="name" placeholder="请输入学生姓名">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Student.name')}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="age" class="col-sm-2 control-label">年龄</label>
                    <div class="col-sm-5">
                        <input type="text" name="Student[age]" value="{{old('Student')['age']}}" class="form-control" id="age" placeholder="请输入学生年龄">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Student.age')}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="age" class="col-sm-2 control-label">性别</label>
                    <div class="col-sm-5">
                        @foreach($student->sex() as $index => $sex)
                        <label class="radio-inline">
                            <input type="radio" name="Student[sex]" value="{{$index}}" }> {{$sex}}
                        </label>
                        {{--<label class="radio-inline">--}}
                            {{--<input type="radio" name="Student[sex]" value="20" {{old('Student')['sex'] == 20 ? 'checked' : ''}}> 男--}}
                        {{--</label>--}}
                        {{--<label class="radio-inline">--}}
                            {{--<input type="radio" name="Student[sex]" value="30" {{old('Student')['sex'] == 30 ? 'checked' : ''}}> 女--}}
                        {{--</label>--}}
                        @endforeach
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('Student.sex')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
@stop
