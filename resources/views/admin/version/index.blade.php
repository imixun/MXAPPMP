@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    版本列表
                    <span class="label label-primary">{{ $app->name }}</span>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="/admin/app/{{ $app->id }}/version/create" class="btn btn-info">添加版本</a>
                        </div>
                        <div class="col-lg-6">
                            <form method="get">
                                <div class="input-group">
                                    <input type="text" value="{{ request('filter') }}" name="filter" class="form-control" placeholder="版本">
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
                            <th>版本号</th>
                            <th>实际版本</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($versions as $version)
                            <tr>
                                <th scope="row">{{ $version->id }}</th>
                                <td>{{ $version->code }}</td>
                                <td>{{ $version->index }}</td>
                                <td>{{ $version->created_at }}</td>
                                <td>
                                    <a href="{{ url("admin/app/{$app->id}/version/{$version->id}/patch") }}">补丁</a>
                                    <a href="{{ url("admin/app/{$app->id}/version/{$version->id}/edit") }}">编辑</a>
                                    <a class="obj_delete" href="javascript:void(0);" data-tip="确定删除版本{{ $version->code }} - {{ $version->index }} 吗" data-url="{{ url("admin/app/{$app->id}/version/{$version->id}") }}">删除</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center">找不到数据</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    {!! $versions->appends(['filter'=>request('filter')])->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection
