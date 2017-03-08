<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Seuic GMS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="{{ elixir('assets/backend/css/app.min.css') }}">
</head>
<body id="login" class="hold-transition login-page">
{{--style="background-image: url('{{array_random(config('cowcat.background-images'))}}');"--}}
<div class="login-box">
    <div class="login-logo">
        <font color="black"><b>Seuic</b> GMS</font>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">
            {{--Happy Coding--}}
        </p>
        <form action="{{URL::to('/auth/login')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="账号" name="email" value="{{old('email')}}">
                        <span class="fa fa-user form-control-feedback"></span>
                        @include('backend.layout.tip',['field'=>'email'])
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="密码" name="password" value="{{old('password')}}">

                        <span class="fa fa-lock form-control-feedback"></span>
                        @include('backend.layout.tip',['field'=>'password'])
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="验证码" name="captcha" value="{{old('captcha')}}" >
                        <span class="fa form-control-feedback" style="width: 70px;pointer-events:auto"><a href="javascript:void(0);" onclick="re_captcha()">换一张？</a></span>
                        @include('backend.layout.tip',['field'=>'captcha'])
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group has-feedback text-center " >
                        <a style="cursor:pointer"><img id="recaptcha" src="<?php echo captcha_src();?>" alt="点击刷新" onclick="re_captcha()"></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-success btn-block btn-flat">登 录</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{ elixir('assets/backend/js/app.min.js') }}"></script>
<script>
    function re_captcha() {
        $url = "{{ URL('captcha/default') }}"+"?"+ Math.random();
        document.getElementById("recaptcha").src=$url;
    }
</script>

</body>

</html>
