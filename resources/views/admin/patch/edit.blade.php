@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    编辑补丁
                    <span class="label label-primary">{{ $app->name }}</span>
                    <span class="label label-success">{{ $version->code }} - {{ $version->index }}</span>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="/admin/patch/{{ $patch->id }}" role="form" method="POST">
                        {!! csrf_field() !!}
                        {!! method_field('put') !!}

                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">补丁</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="url" value="{{ $patch->url }}">

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">信息</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="info" value="{{ $patch->info }}">

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
