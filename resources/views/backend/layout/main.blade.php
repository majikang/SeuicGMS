<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>{{ $page_title or "Seuic GMS" }}</title>
    @yield('before.css')
    <link rel="stylesheet" type="text/css" href="/assets/backend/plugins/pace/pace.min.css">
    <link rel="stylesheet" type="text/css" href="{{ elixir('assets/backend/css/app.min.css') }}">
    @yield('after.css')
</head>

<body class="skin-black fixed">
<div class="wrapper">
    @inject('mainPresenter','App\Presenters\MainPresenter')
    <!--header-->
    @include('backend.layout.header')
    <!--sidebar-->
    @include('backend.layout.sidebar')
    <!--content-->
    <div class="content-wrapper">
        <section class="content-header">
            <!--面包屑-->
            @include('backend.layout.breadcrumbs')
            <!--成功和错误提示信息-->
            @include('backend.layout.errors')
            @include('backend.layout.success')
        </section>
        <section class="content">
            @yield('content')
        </section>
    </div>
    <!--footer-->
    @include('backend.layout.footer')
</div>

@yield('before.js')
<script type="text/javascript" src="{{ elixir('assets/backend/js/app.min.js') }}"></script>
<script type="text/javascript" src="/assets/backend/plugins/pace/pace.min.js"></script>
<script type="text/javascript" src="/assets/backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript">
    $(function () {
        if ($('.select2').length > 0) {
            $('.select2').select2();
        }

        if ($('#created_at').length == 1) {
            $('#created_at').daterangepicker({timePickerIncrement: 30, format: 'YYYY/MM/DD HH:mm:ss'});
        }

        @if(Session::has('success'))
            $('#success-message').delay(3000).fadeOut();
        @endif

        @if(Session::has('errors'))
            $('#errors-message').delay(5000).fadeOut();
        @endif
    });
</script>
@yield('after.js')
</body>
</html>
