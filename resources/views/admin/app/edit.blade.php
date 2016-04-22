@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">编辑应用</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"  action="/admin/app/{{ $app->id }}" >
                        {!! csrf_field() !!}
                        {!! method_field('put') !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">应用名称</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $app->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">APP KEY</label>

                            <div class="col-md-6">
                                <p class="form-control-static">{{ $app->app_key }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">APP SECRET</label>

                            <div class="col-md-6">
                                <p class="form-control-static">{{ $app->app_secret }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    保存
                                </button>
                                <a href="/admin/app" class="btn btn-default">
                                    返回
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
