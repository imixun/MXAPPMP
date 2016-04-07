@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">应用列表</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ url('admin/app/create') }}" class="btn btn-info">添加应用</a>
                        </div>
                        <div class="col-lg-6">
                            <form method="get">
                                <div class="input-group">
                                    <input type="text" value="{{ request('filter') }}" name="filter" class="form-control" placeholder="应用名称">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">搜索</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>


                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>应用名称</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($apps as $app)
                            <tr>
                                <th scope="row">{{ $app->id }}</th>
                                <td>{{ $app->name }}</td>
                                <td>{{ $app->created_at }}</td>
                                <td>{{ $app->updated_at }}</td>
                                <td>
                                    <a href="/admin/app/{{ $app->id }}/version">版本</a>
                                    <a href="/admin/app/{{ $app->id }}/edit">编辑</a>
                                    <a class="obj_delete" href="javascript:void(0);" data-tip="确定删除应用 {{ $app->name }} 吗" data-url="/admin/app/{{ $app->id }}" >删除</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center">找不到数据</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    {!! $apps->appends(['filter'=>request('filter')])->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
