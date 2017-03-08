@extends("backend.layout.main")

@inject("departPresenter","App\Presenters\DepartPresenter")

@section("content")
    @ability('superadmin','backend.depart.create')
    @include('backend.components.handle',$handle = $departPresenter->getHandle())
    @endability
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">部门列表</h3>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>部门编号</th>
                            <th>上级部门</th>
                            <th>部门名称</th>
                            <th>排序</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>@if( isset($depart[$item->pid]) ) {{$depart[$item->pid]}} @endif </td>
                                <td>{{trans($item->name)}}</td>

                                <td>{{$item->sort}}</td>
                                <td>{{$departPresenter->showDisplayFormat($item->state)}}</td>
                                <td>
                                    @ability('superadmin','backend.depart.edit')
                                    <a href="{{route('backend.depart.edit',['id'=>$item->id])}}" class="btn btn-primary btn-flat">编辑</a>
                                    @endability
                                    @ability('superadmin','backend.depart.destroy')
                                    <button class="btn btn-danger btn-flat"
                                            data-url="{{URL::to('backend/depart/'.$item->id)}}"
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
    @include('backend.components.modal.delete',['title'=>'操作提示','content'=>'你确定要删除这个部门吗?'])
@endsection
