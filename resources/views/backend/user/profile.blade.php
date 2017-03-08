@extends('backend.layout.main')

@section('content')

    <div class="row" style="width:80%; margin:0 auto;">
       {{-- <div class="col-md-3">
            <div class="box" style="border-top-color: #333;">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{$user->profile->avatar or '/assets/backend/images/user4-128x128.jpg'}}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{$user->name}}</h3>
                    <p class="text-muted text-center">{{$user->profile->job or ""}}</p>
                    --}}{{--<a href="#" class="btn btn-primary btn-block"><b>关注</b></a>--}}{{--
                </div>
            </div>

            <div class="box" style="border-top-color: #333;">
                <div class="box-header with-border">
                    <h3 class="box-title">自我描述</h3>
                </div>
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> 教育经历</strong>

                    <p class="text-muted">
                        {{$user->profile->education or ""}}
                    </p>

                    <hr>


                    <strong><i class="fa fa-pencil margin-r-5"></i> 技能兴趣</strong>

                    <p>
                        @if(!empty($user->profile->skills))
                            @foreach(explode(',',$user->profile->skills) as $key => $value)
                                <span class="label {{$color[$key % count($color)]}}">{{$value}}</span>
                            @endforeach
                        @endif
                    </p>

                    <hr>

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> 自我介绍</strong>

                    <p>{{$user->profile->introduction or ""}}</p>
                </div>
            </div>
        </div>--}}

        <div class="col-md-12" >
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">个人信息</a></li>
                    {{--<li><a href="#community" data-toggle="tab">网络社区</a></li>
                    <li><a href="#avatar" data-toggle="tab">修改头像</a></li>--}}
                </ul>
                <div class="tab-content" style="margin-right: 10%;">
                    <div class="tab-pane active" id="settings">
                        <form class="form-horizontal" method="post" action="{{route('backend.user.update-profile')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id" id="id" value="{{$id}}">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">用户名称</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="用户名称" value="{{$user->name or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">登录邮箱</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email"  placeholder="登录邮箱" value="{{$user->email or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">用户密码</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="用户密码" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="确认密码" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-black">确定</button>
                                </div>
                            </div>
                        </form>
                    </div>
                   {{-- <div class="tab-pane" id="community">
                        <form class="form-horizontal" method="post" action="{{route('backend.user.update-profile')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="user_id" id="user_id" value="{{$id}}">
                            <div class="form-group">
                                <label for="weibo" class="col-sm-2 control-label">微博</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="weibo" name="weibo" value="{{$user->profile->weibo or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="github" class="col-sm-2 control-label">Github</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="github" name="github" value="{{$user->profile->github or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="twitter" class="col-sm-2 control-label">Twitter</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="twitter" name="twitter" value="{{$user->profile->twitter or ''}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="skills" class="col-sm-2 control-label">技能兴趣</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="skills" name="skills" value="{{$user->profile->skills or ''}}" placeholder="使用逗号进行分割">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-black">确定</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="avatar">
                        <form id="uploadForm" class="form-horizontal" method="post" action="{{route('backend.user.update-profile')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="user_id" id="user_id" value="{{$id}}">
                            <div class="form-group">
                                <label for="file" class="col-sm-2 control-label">选择图片</label>

                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file" name="file">
                                    <input type="hidden" id="image" name="avatar" value="{{$user->profile->avatar or ''}}">
                                    @if(!empty($user->profile->avatar))
                                        <img src="{{$user->profile->avatar}}" alt="{{$user->name}}" id="preview" style="margin-top: 10px;border-radius: 10px;">
                                    @else
                                        <img src="" alt="" id="preview" style="margin-top: 10px;border-radius: 10px;">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-black">确定</button>
                                </div>
                            </div>
                        </form>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after.js')
    <script type="text/javascript">
        $(function () {
            $('#file').on('change', function () {
                $.ajax({
                    url: '{{route("backend.user.upload-avatar")}}',
                    type: 'POST',
                    cache: false,
                    data: new FormData($('#uploadForm')[0]),
                    processData: false,
                    contentType: false
                }).done(function (response) {
                    var url = response.data.url;
                    $('#image').attr('value', url);
                    $('#preview').attr('src', url);
                }).fail(function (response) {
                    console.log(response);
                });
            });
        });
    </script>
@endsection