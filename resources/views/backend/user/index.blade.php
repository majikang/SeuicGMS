@extends("backend.layout.main")

@inject("userPresenter","App\Presenters\UserPresenter")

@section("content")
    @ability('superadmin','backend.user.create')
    @include('backend.components.handle',$handle = $userPresenter->getHandle())
    @endability
    @ability('superadmin','backend.user.search')
    @include('backend.components.search', ['search' => $userPresenter->getSearchParams()])
    @endability
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">用户列表</h3>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>用户编号</th>
                            <th>用户邮箱</th>
                            <th>用户名称</th>
                            <th>所在部门</th>
                            <th>上次登录时间</th>
                            <th>上次登录ip</th>
                            <th>操作</th>
                        </tr>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->name}}</td>
                                <td>

                                    @if(!empty($item->dep_id))
                                        {{$depart[$item->dep_id]}}
                                    @endif
                                </td>
                                <td>{{$item->lastlogintime}}</td>
                                <td>{{$item->lastloginip}}</td>

                                <td>
                                    @ability('superadmin','backend.user.edit')
                                        <a href="{{route('backend.user.edit',['id'=>$item->id])}}" class="btn btn-primary btn-flat">编辑</a>
                                    @endability
                                    @ability('superadmin','backend.user.destroy')
                                    <button class="btn btn-danger btn-flat"
                                            data-url="{{URL::to('backend/user/'.$item->id)}}"
                                            data-toggle="modal"
                                            data-target="#delete-modal"
                                    >
                                        删除
                                    </button>
                                    @endability
                                    {{--<a href="{{route('backend.email.send',['id'=>$item->id])}}" class="btn btn-primary btn-flat">发送测试邮件</a>--}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>


                @if($data->render())
                    <div class="box-footer clearfix">
                        {!! $data->render() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section("after.js")
    @include('backend.components.modal.delete',['title'=>'操作提示','content'=>'你确定要删除这名用户吗?'])
@endsection
