@extends("backend.layout.main")

@inject("PermissionPresenter","App\Presenters\PermissionPresenter")

@section("content")
    @ability('superadmin','backend.permission.create')
    @include('backend.components.handle',$handle = $PermissionPresenter->getHandle())
    @endability

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">权限列表</h3>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>权限ID</th>
                            <th>分组标识</th>
                            <th>权限名称</th>
                            <th>权限路由</th>
                            <th>权限描述</th>
                            <th>是否菜单</th>
                            <th>操作</th>
                        </tr>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->group}}</td>
                                <td>{{$item->display_name}}</td>
                                <td>{{$item->action}}</td>
                                <td>{{$item->description}}</td>
                                <td>

                                    @if($item->is_menu==1)
                                        是
                                    @elseif($item->is_menu==0)
                                        否
                                    @endif
                                </td>
                                <td>
                                    @ability('superadmin','backend.permission.edit')

                                    <a href="{{route('backend.permission.edit',['id'=>$item->id])}}" class="btn btn-primary btn-flat">编辑</a>
                                    @endability
                                    @ability('superadmin','backend.permission.destroy')

                                    <button class="btn btn-danger btn-flat"
                                            data-url="{{URL::to('backend/permission/'.$item->id)}}"
                                            data-toggle="modal"
                                            data-target="#delete-modal"
                                    >
                                        删除
                                    </button>
                                    @endability

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
    @include('backend.components.modal.delete',['title'=>'操作提示','content'=>'你确定要删除这个权限吗?'])
@endsection
