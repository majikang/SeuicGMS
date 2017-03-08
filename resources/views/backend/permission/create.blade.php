@extends("backend.layout.main")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{route('backend.permission.store')}}">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">新增权限</h3>
                    </div>
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label>权限上级</label>
                            <select class="form-control select2" style="width: 100%;" name="pid">
                                <option selected="selected" value="0">顶级分类</option>
                                @foreach($tree as $item)
                                    <option value="{{$item['id']}}">
                                        {{ $item['html'] }}{{ trans($item['display_name']) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{--<div class="form-group">
                            <label for="name">权限分组</label>
                            <input type="text" class="form-control" id="group" name="group" placeholder="权限分组" value="{{$data->group}}">
                        </div>--}}
                        <div class="form-group">
                            <label for="group">权限分组名称</label>
                            <input type="text" class="form-control" id="group" name="group" placeholder="权限分组名称" value="{{old('group')}}">
                        </div>
                        <div class="form-group">
                            <label for="name">权限标识</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="权限标识" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="display_name">权限名称</label>
                            <input type="text" class="form-control" id="display_name" name="display_name" placeholder="权限名称" value="{{old('display_name')}}">
                        </div>
                        <div class="form-group">
                            <label for="description">权限描述</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="权限描述" value="{{old('description')}}">
                        </div>
                        <div class="form-group">
                            <label for="action">权限路由</label>
                            <input type="text" class="form-control" id="action" name="action" placeholder="权限路由" value="{{old('action')}}">
                        </div>
                        <div class="form-group">
                            <label for="is_menu">是否设置为菜单</label>
                            <div class="form-group">
                                <select class="form-control select2" name="is_menu">
                                    <option value="1">是</option>
                                    <option selected="selected" value="0">否</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="box-footer clearfix">
                        <a href="javascript:history.back(-1);" class="btn btn-default btn-flat">
                            <i class="fa fa-arrow-left"></i>
                            返回
                        </a>
                        <button type="submit" class="btn btn-success pull-right btn-flat">
                            <i class="fa fa-plus"></i>
                            新 增
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection