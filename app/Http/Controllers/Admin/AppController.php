<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\App;
use Redirect;

class AppController extends Controller
{

    public function index(Request $request)
    {
        $filter = $request->get('filter');

        $data = App::whereRaw("name like '%{$filter}%'")
            ->orderBy('created_at','desc')
            ->paginate(10);

        return view('admin.app.index')->withApps($data);
    }

    public function create()
    {
        return view('admin.app.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $app = new App;
        $app->name = $request->get('name');

        if ($app->save()) {
            return Redirect::to(action('Admin\AppController@index'));
        } else {
            return Redirect::back()->withInput()->withErrors('添加失败');
        }
    }

    public function edit($id)
    {
        return view('admin.app.edit')->withApp(App::findOrFail($id));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $app = App::find($id);
        $app->name = $request->get('name');

        if ($app->save()) {
            return $this->success('编辑成功');
        } else {
            return $this->error('编辑失败');
        }
    }

    public function destroy($id)
    {

        $app = App::find($id);

        if ($app->delete()) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }
    }
}
