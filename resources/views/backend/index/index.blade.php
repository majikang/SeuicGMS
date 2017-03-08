@extends("backend.layout.main")
@section('after.css')
@endsection
@section("content")
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red-gradient">
                <div class="inner">
                    <h3>{{$users}}</h3>

                    <p>用户管理</p>
                </div>

                <div class="icon">
                    <i class="fa fa-user-secret"></i>
                </div>

                <a href="{{route('backend.user.index')}}" class="small-box-footer">更多信息
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$depart}}</h3>

                    <p>部门管理</p>
                </div>

                <div class="icon">
                    <i class="fa fa-list-alt"></i>
                </div>

                <a href="{{route('backend.depart.index')}}" class="small-box-footer">更多信息
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$roles}}</h3>

                    <p>角色管理</p>
                </div>

                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>

                <a href="{{route('backend.role.index')}}" class="small-box-footer">更多信息
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$actions}}</h3>

                    <p>权限管理</p>
                </div>

                <div class="icon">
                    <i class="fa fa-key"></i>
                </div>

                <a href="{{route('backend.permission.index')}}" class="small-box-footer">更多信息
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
