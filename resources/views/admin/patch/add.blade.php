@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    添加补丁
                    <span class="label label-primary">{{ $app->name }}</span>
                    <span class="label label-success">{{ $version->code }} - {{ $version->index }}</span>
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" action="/admin/app/{{ $app->id }}/version/{{ $version->id }}/patch" enctype="multipart/form-data" role="form" method="POST">
                        {!! csrf_field() !!}

                        <input type="hidden" name="version_id" value="{{ $version->id }}" >

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">补丁</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input class="form-control file_url" readonly >
                                    <input class="hidden" type="file" name="file">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" id="choose_file" >选择</button>
                                    </span>
                                </div>
                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">信息</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="info" value="{{ old('info') }}">

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
                                    添加
                                </button>
                                <a href="/admin/patch" class="btn btn-default">
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

@section('script')
    <script type="text/javascript">
        $(function(){
            $('#choose_file').click(function(){
                $('input[name=file]').click();
            });
            $('input[name=file]').change(function(){
                $('input.file_url').val($(this).val());
            });
        });
    </script>
@endsection