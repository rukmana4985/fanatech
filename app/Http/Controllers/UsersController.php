<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

use App\Models\UserAll;
use App\Models\Role;

use App\Traits\ImagesTrait;
use Yajra\DataTables\Facades\DataTables;
use DB,General,View,JsValidator;

class UsersController extends Controller
{
    use ImagesTrait;

    public $view;
    public $main_model;

    public function __construct(UserAll $main_model){
        $this->view         = 'users';
        $this->title        = 'Pengguna';
        $this->main_model   = $main_model;
        $this->validate     = 'UserRequest';

        $listRole        = Role::pluck('name','id');
        View::share('listRole', $listRole);
        View::share('view', $this->view);
        View::share('title', $this->title);
    }

    public function index(Request $request)
    {   
        $columns = [
            'username',
            'action'
        ];
        $datas = $this->main_model->select(['*'])->where('role_id', '2')->orderBy('created_at','desc');     
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

    public function store(UserRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try{
            $input['image'] = General::setImage($request->file('image'),$this->view);  
            $input['password'] = bcrypt($request->password);           
            $data = $this->main_model->create($input);
            DB::commit();
            toast()->success('Data berhasil input', $this->title);
            General::setImage($request->file('image'),$data->id,$this->view);
            return redirect()->route($this->view.'.index');
        }catch(\Exception $e) {
            toast()->error('Terjadi Kesalahan ' . $e->getMessage(), $this->title);            
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

    public function update(UserRequest $request, $id)
    {
        $input = $request->all();
        $data = $this->main_model->findOrFail($id);
        DB::beginTransaction();
        try{
            $input['image'] = General::setImage($request->file('image'),$this->view);            
            $data->fill($input)->save();
            DB::commit();
            return redirect()->route($this->view.'.index');
        }catch(\Exception $e) {
            toast()->error('Terjadi Kesalahan ' . $e->getMessage(), $this->title);            
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
        toast()->error('Terjadi Kesalahan ' . $e->getMessage(), $this->title);
        return redirect()->back();
    }
}
