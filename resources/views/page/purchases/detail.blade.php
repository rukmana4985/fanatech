<tr>
    <td>
        <div class="form-group form-md-line-input has-success">
            {!! Template::selectbox($listInventory->toArray(),@$detail->inventory_id,"inventory_id[]",[ 'class' => 'form-control inventory_id select' ]) !!}
        </div>
    </td>
    <td>
        <div class="form-group form-md-line-input has-success">
            <input type="text" readonly class="form-control stock" >
            <label for="">Stock</label>
        </div>
    </td>
    <td>
        <div class="form-group form-md-line-input has-success">
            <input type="number" readonly  id="" class="form-control at_price">
            <label for="">Harga Satuan</label>
        </div>
    </td>
    <td>
        <div class="form-group form-md-line-input has-success">
            <input type="number" name="qty[]" id="" class="form-control qty">
            <label for="">Qty</label>
        </div>
    </td>
    <td>
        <div class="form-group form-md-line-input has-success">
            <input type="number" readonly name="price[]" id="" class="form-control price">
            <label for="">Harga</label>
        </div>
    </td>
    <td><a class="hapus" title="Delete Record" id=""><i class="fa fa-trash-o"></i></a></td>
 </tr>