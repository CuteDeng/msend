<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>laravel @yield('title')</title>
    <style>
        .header {
            width: 1000px;
            height: 150px;
            margin: 0 auto;
            background: #f5f5f5;
            border: 1px solid #dddddd;
        }

        .main {
            width: 1000px;
            height: 300px;
            margin: 0 auto;
            margin-top: 15px;
            clear: both;
        }

        .main .sidebar {
            float: left;
            width: 20%;
            height: inherit;
            background: #f5f5f5;
            border: 1px solid #dddddd;
        }

        .main .content {
            float: right;
            width: 75%;
            height: inherit;
            background: #f5f5f5;
            border: 1px solid #dddddd;
        }

        .footer {
            width: 1000px;
            height: 150px;
            margin: 0 auto;
            margin-top: 15px;
            background: #f5f5f5;
            border: 1px solid #dddddd;
        }
    </style>
</head>
<body>
    <div class="header">
        @section('header')
        頭部
        @show
    </div>
    <div class="main">
        <div class="sidebar">
            @section('sidebar')
                側邊欄
            @show
        </div>
        <div class="content">
            @yield('content','主要內容')
        </div>
    </div>
    <div class="footer">
        @section('footer')
            底部
        @show
    </div>
</body>
</html>
