<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;

use App\Models\Purchase;
use App\Models\UserAll;
use App\Models\Inventory;
use App\Models\PurchaseDetail;
use App\Traits\ImagesTrait;
use Yajra\DataTables\Facades\DataTables;

use DB,General,View,Alert,JsValidator;

class PurchasesController extends Controller
{
    use ImagesTrait;

    public $view;
    public $main_model;

    public function __construct(Purchase $main_model){
        $this->view         = 'purchases';
        $this->title        = 'Pembelian';
        $this->main_model   = $main_model;
        $this->validate     = 'PurchaseRequest';
        $listUser           = UserAll::pluck('username','id');
        $listInventory      = Inventory::pluck('name','id');

        View::share('listInventory', $listInventory);
        View::share('listUser', $listUser);
        View::share('view', $this->view);
        View::share('title', $this->title);
    }

    public function index(Request $request)
    {
        $datas = $this->main_model->with(['user'])->select(['*']);
        $columns = ['number','date','user.username','action'];
        
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

    public function store(PurchaseRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try{
            $input['image'] = General::setImage($request->file('image'),$this->view);
            $data = $this->main_model->create($input);
            foreach($input['inventory_id'] as $k => $v)
            {
                $input_detail['purchase_id']   = $data->id;
                $input_detail['inventory_id'] = $input['inventory_id'][$k];
                $input_detail['qty']    = $input['qty'][$k];
                $input_detail['price']  = $input['price'][$k];
                PurchaseDetail::create($input_detail);
                $inventory    = Inventory::findOrFail($input['inventory_id'][$k]);
                $stock        = $inventory->stock + $input['qty'][$k];
                $update_stock['stock'] = $stock;
                $inventory->fill($update_stock)->save();
            }
            DB::commit();
            Alert::success('Berhasil', 'Data berhasil ditambahkan!');
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

    public function update(PurchaseRequest $request, $id)
    {
        $input = $request->all();
        $data = $this->main_model->findOrFail($id);
        DB::beginTransaction();
        try{
            $input['image'] = General::setImage($request->file('image'),$this->view);            
            $data->fill($input)->save();
            foreach($data->purchase_details as $detail){
                $inventory    = Inventory::findOrFail($detail->inventory_id);
                $stock      = $inventory->stock + $detail->qty;
                $update_stock['stock'] = $stock;
                $inventory->fill($update_stock)->save();
                PurchseDetail::whereSalesId($data->id)->delete();
            }

            foreach($input['inventory_id'] as $k => $v)
            {
                $input_detail['sales_id']   = $data->user_id;
                $input_detail['inventory_id'] = $input['inventory_id'][$k];
                $input_detail['qty']    = $input['qty'][$k];
                $input_detail['price']  = $input['price'][$k];
                PurchseDetail::create($input_detail);
                $inventory    = Inventory::findOrFail($input['inventory_id'][$k]);
                $stock        = $inventory->stock + $input['qty'][$k];
                $update_stock['stock'] = $stock;
                $inventory->fill($update_stock)->save();
            }
            PurchaseDetail::whereSalesId($data->id)->delete();
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

    public function detail()
    {
        return view('page.'.$this->view.'.detail');
    }
}
