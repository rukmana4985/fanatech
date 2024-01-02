<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;

use App\Models\Menu;

use App\Traits\ImagesTrait;
use Yajra\DataTables\Facades\DataTables;
use DB,General,View,JsValidator;

class MenusController extends Controller
{
    use ImagesTrait;

    public $view;
    public $main_model;

    public function __construct(Menu $main_model){
        $this->title        = 'Menu';
        $this->view         = 'menus';
        $this->main_model   = $main_model;
        $this->validate     = 'MenuRequest';

        $listMenus          = Menu::pluck('name','id');

        View::share('listMenus', $listMenus);
        View::share('view', $this->view);
        View::share('title', $this->title);
    }

    public function index(Request $request)
    {
        $columns = ['parent','name','url','icon','action'];
        $datas = $this->main_model->with(['parent'])->select(['*']);
        if($request->ajax())
        {
            return Datatables::of($datas)
                ->addColumn('parent',function($data){
                        return @$data->parent->name;
                    })
                ->addColumn('icon',function($data){
                        return '<i class='.@$data->icon.'></i>';
                    })
                ->addColumn('action',function($data){
                        return view('page.'.$this->view.'.action',compact('data'));
                    })
                ->escapeColumns(['actions'])
                ->make(true);
        }
     	return view('page.'.$this->view.'.index')
			->with(compact('datas','columns'));
    }

    public function create()
    {
        $validator = JsValidator::formRequest('App\Http\Requests\\'.$this->validate);
		return view('page.'.$this->view.'.create')->with(compact('validator'));
    }

    public function store(MenuRequest $request)
    {
        $input = $request->all();
    	DB::beginTransaction();
    	try{
            $data = $this->main_model->create($input);
	        DB::commit();
            toast()->success('Data berhasil input', $this->title);
            return redirect()->route($this->view.'.index');
	    }catch(\Exception $e) {
    		DB::rollback();
    	}
        toast()->error('Terjadi Kesalahan', $this->title);
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = $this->main_model->findOrFail($id);
        $validator = JsValidator::formRequest('App\Http\Requests\\'.$this->validate);
		return view('page.'.$this->view.'.edit')->with(compact('validator','data'));
    }

    public function update(MenuRequest $request, $id)
    {
        $input = $request->all();
        $data = $this->main_model->findOrFail($id);
    	DB::beginTransaction();
    	try{
            $data->fill($input)->save();
	        DB::commit();
            toast()->success('Data berhasil input', $this->title);
            return redirect()->route($this->view.'.index');
	    }catch(\Exception $e) {
    		DB::rollback();
    	}
        toast()->error('Terjadi Kesalahan', $this->title);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $data = $this->main_model->findOrFail($id);
        DB::beginTransaction();
    	try{
        	$data->delete();
        	DB::commit();
            toast()->success('Data berhasil di hapus', $this->title);
            return redirect()->route($this->view.'.index');
        }catch(\Exception $e) {
    		DB::rollback();
    	}
        toast()->error('Terjadi Kesalahan', $this->title);
        return redirect()->back();
    }
}
