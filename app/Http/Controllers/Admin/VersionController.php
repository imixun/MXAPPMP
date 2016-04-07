<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
//use App\Http\Controllers\Admin\Controller;

use App\Version;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1(Request $request)
    {
        $filter = $request->get('filter');

        $db = DB::table('versions')
            ->select('apps.name as app_name', 'versions.id', 'versions.code', 'versions.index', 'versions.created_at')
            ->leftJoin('apps', 'apps.id', '=', 'versions.app_id')
            ->whereNull('versions.deleted_at');
        //$db->where();

        $data = $db->paginate(10);

        $data1 = Version::whereRaw("code like '%{$filter}%'")
            ->orderBy('created_at','desc')
            ->paginate(10);

        return view('admin.version.index')->withVersions($data);
    }
    public function index(Request $request,$app_id)
    {
        $filter = $request->get('filter');

        $db = \DB::table('versions')
            ->select('versions.id', 'versions.code', 'versions.index', 'versions.created_at')
            ->whereNull('versions.deleted_at')
            ->where('versions.app_id', '=', $app_id);

        if (!empty($filter)){
            $db->where('versions.code','like',"%{$filter}%");
        }

        $data = $db->paginate(10);

        return view('admin.version.index')->withApp(\App\App::findOrFail($app_id))->withVersions($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($app_id)
    {
        return view('admin.version.add')->withApp(\App\App::find($app_id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'app_id'=>'required',
            'app_type'=>'required',
            'code' => 'required',
            'index' => 'required',
            'url' => 'required',
            'info' => ''
        ]);

        $version = new Version;
        $version->app_id = $request->get('app_id');
        $version->app_type = $request->get('app_type');
        $version->code = $request->get('code');
        $version->index = $request->get('index');
        $version->url = $request->get('url');
        $version->info = $request->get('info');

        if ($version->save()) {
            return $this->success('添加成功');
        } else {
            return $this->error('添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($app_id,$version_id)
    {
        return view('admin.version.edit')->withApp(\App\App::find($app_id))->withVersion(Version::findOrFail($version_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            //'app_id'=>'required',
            'app_type'=>'required',
            'code' => 'required',
            'index' => 'required',
            'url' => 'required',
            'info' => ''
        ]);

        $version = Version::find($id);
        //$version->app_id = $request->get('app_id');
        $version->app_type = $request->get('app_type');
        $version->code = $request->get('code');
        $version->index = $request->get('index');
        $version->url = $request->get('url');
        $version->info = $request->get('info');

        if ($version->save()) {
            return $this->success('编辑成功');
        } else {
            return $this->error('编辑失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $version = Version::find($id);

        if ($version->delete()) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}
