<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;

use App\Models\Role;
use App\Models\RoleMenu;
use App\Models\Menu;

use App\Traits\ImagesTrait;
use Yajra\DataTables\Facades\DataTables;
use DB,General,View,JsValidator;

class RolesController extends Controller
{
    use ImagesTrait;

    public $view;
    public $main_model;

    public function __construct(Role $main_model){
        $this->view         = 'roles';
        $this->title        = 'Role';
        $this->main_model   = $main_model;
        $this->validate     = 'RoleRequest';
        View::share('view', $this->view);
        View::share('title', $this->title);
    }

    public function index(Request $request)
    {
        $datas = $this->main_model->select(['*']);
        $columns = ['name','action'];
        if($request->ajax())
        {
            return Datatables::of($datas)
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

    public function store(RoleRequest $request)
    {
        $input = $request->all();
    	DB::beginTransaction();
    	try{
            $data = $this->main_model->create($input);
	        DB::commit();
            General::setImage($request->file('image'),$data->id,$this->view);
            return redirect()->route($this->view.'.index');
	    }catch(\Exception $e) {
    		DB::rollback();
    	}
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

    public function update(RoleRequest $request, $id)
    {
        $input = $request->all();
        $data = $this->main_model->findOrFail($id);
    	DB::beginTransaction();
    	try{   
            $data->fill($input)->save();
	        DB::commit();
            General::setImage($request->file('image'),$data->id,$this->view);
            return redirect()->route($this->view.'.index');
	    }catch(\Exception $e) {
    		DB::rollback();
    	}
        return redirect()->back();
    }

    public function destroy($id)
    {
        $data = $this->main_model->findOrFail($id);
        DB::beginTransaction();
    	try{
        	$data->delete();
        	DB::commit();
        	return redirect()->route($this->view.'.index');
        }catch(\Exception $e) {
    		DB::rollback();
    	}
    	Alert::error('Gagal', 'Terjadi Kesalahan');
        return redirect()->back();
    }

    public function access($id){
        $data = Role::findOrFail($id);
        $menus = [];
        $data_menus = Menu::where('url', '<>', '')->get();
        foreach($data_menus as $k=>$menu){
            if(empty($menu->parent_id)){
                $menus[$menu->id]    = $menu;
            } elseif(!array_key_exists($menu->parent_id, $menus)) {
                $menus[$menu->parent_id]['head']     = $menu->parent->name;
                $menus[$menu->parent_id]['icon']     = $menu->parent->icon;
                $menus[$menu->parent_id]['detail'][] = $menu;
            } elseif(array_key_exists($menu->parent_id, $menus)) {
                $menus[$menu->parent_id]['detail'][] = $menu;
            }
        }

        $list_role_menu = RoleMenu::whereRoleId($id)->pluck('role_id','menu_id')->toArray();
        return view('page.'.$this->view.'.role_menu')->with(compact('menus','data','list_role_menu'));
    }
}
