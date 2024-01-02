<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InventoryRequest;

use App\Models\Inventory;

use App\Traits\ImagesTrait;
use Yajra\DataTables\Facades\DataTables;
use DB,General,View, Alert,JsValidator;

class InventoriesController extends Controller
{
    use ImagesTrait;

    public $view;
    public $main_model;

    public function __construct(Inventory $main_model){
        $this->view         = 'inventories';
        $this->title        = 'Inventori';
        $this->main_model   = $main_model;
        $this->validate     = 'InventoryRequest';
        View::share('view', $this->view);
        View::share('title', $this->title);
    }

    public function index(Request $request)
    {
        $datas = $this->main_model->select(['*']);
        $columns = ['code','name','price','stock','action'];
        
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

    public function store(InventoryRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try{
            $input['image'] = General::setImage($request->file('image'),$this->view);
            $data = $this->main_model->create($input);
            DB::commit();
            Alert::success('Berhasil', 'Data berhasil ditambahkan!');
            return redirect()->route($this->view.'.index');
        }catch(\Exception $e) {
            Alert::error('Terjadi Kesalahan yaitu ',$e->getMessage());
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

    public function update(InventoryRequest $request, $id)
    {
        $input = $request->all();
        $data = $this->main_model->findOrFail($id);
        DB::beginTransaction();
        try{
            $input['image'] = General::setImage($request->file('image'),$this->view);            
            $data->fill($input)->save();
            DB::commit();
            Alert::success('Berhasil', 'Data berhasil diubah!');
            return redirect()->route($this->view.'.index');
        }catch(\Exception $e) {
            Alert::error('Terjadi Kesalahan yaitu ',$e->getMessage());
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
            Alert::success('Berhasil', 'Data berhasil dihapus!');
            return redirect()->route($this->view.'.index');
        }catch(\Exception $e) {
            Alert::error('Terjadi Kesalahan yaitu ',$e->getMessage());
            DB::rollback();
        }
        return redirect()->back();
    }

    
}
