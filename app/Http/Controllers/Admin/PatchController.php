<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
//use App\Http\Controllers\Admin\Controller;

use App\Patch;

class PatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$app_id,$version_id)
    {
        $data['app'] = \App\App::findOrFail($app_id);
        $data['version'] = \App\Version::findOrFail($version_id);

        $patch = Patch::whereRaw("version_id = '{$version_id}'")->first();
        if($patch === null){
            return view('admin.patch.add')->with($data);
        }else{
            return view('admin.patch.edit')->with($data)->withPatch($patch);
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'version_id'=>'required',
            'file'=>'required'
        ]);

        if(!$request->hasFile('file')) {
            return $this->error('文件上传失败');
        }

        $patch = new Patch;

        if(!$patch->setPatchFile($request->file('file'))){
            return $this->error('文件上传失败');
        }

        $patch->version_id = $request->get('version_id');
        $patch->info = $request->get('info');

        if ($patch->save()) {
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
    public function edit($id)
    {
        //
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
        $patch = Patch::findOrFail($id);

        $file = $request->file('file');
        if($file && !$patch->setPatchFile($file)){
            return $this->error('文件上传失败');
        }

        $patch->info = $request->get('info');

        if ($patch->save()) {
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
        $patch = Patch::find($id);

        if ($patch->delete()) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}
