@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    编辑版本
                    <span class="label label-primary">{{ $app->name }}</span>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="/admin/app/{{ $app->id }}/version/{{ $version->id }}" role="form" method="POST">
                        {!! csrf_field() !!}
                        {!! method_field('put') !!}

                        <div class="form-group{{ $errors->has('app_type') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">类型</label>

                            <div class="col-md-6">
                                <label class="radio-inline">
                                    <input type="radio" name="app_type" @if ($version->app_type == '1') checked @endif value="1"> android
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="app_type" @if ($version->app_type == '2') checked @endif value="2"> IOS
                                </label>
                                @if ($errors->has('app_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('app_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">版本号</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="code" value="{{ $version->code }}">

                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('index') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">实际版本</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="index" value="{{ $version->index }}">

                                @if ($errors->has('index'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('index') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">下载地址</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="url" value="{{ $version->url }}">

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">版本信息</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="info" value="{{ $version->info }}">

                                @if ($errors->has('info'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('info') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>编辑
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
