@extends('backend.layout.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('backend.depart.update',['id'=>$depart->id])}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_method" value="put">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">编辑部门</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>上一级部门</label>
                            <select class="form-control select2" style="width: 100%;" name="pid">
                                <option @if($depart->pid == 0) selected="selected" @endif value="0">顶级部门</option>
                                @foreach($tree as $item)
                                    <option  value="{{$item['id']}}" @if($depart->pid == $item['id']) selected="selected" @endif>
                                        {{ $item['html'] }}{{ trans($item['name']) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">部门名称</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="部门名称" value="{{$depart->name}}">
                        </div>
                        <div class="form-group">
                            <label for="description">部门描述</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="部门描述" value="{{$depart->description}}">
                        </div>
                        <div class="form-group">
                            <label for="sort">部门排序</label>
                            <input type="text" class="form-control" id="sort" name="sort" placeholder="部门排序" value="0" value="{{$depart->sort}}">
                        </div>
                        <div class="form-group">
                            <label for="state">是否启用</label>
                            <div class="form-group">
                                <select class="form-control select2" name="state">
                                    <option selected="selected" value="1">启用</option>
                                    <option value="0">禁用</option>
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
                            <i class="fa fa-save"></i>
                            修 改
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

