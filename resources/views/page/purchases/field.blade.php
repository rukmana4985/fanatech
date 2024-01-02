<div class="row">
    <div class="col-md-6 ">
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="number" name="number" value="{{ @$data->number }}">
            <label>Nomor</label>
        </div>      
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="date" name="date" value="{{ @$data->date }}">
            <label>Tanggal</label>
        </div>
        <div class="form-body form-group form-md-line-input">
            {!! Template::selectbox($listUser,@$data->user_id,"user_id",[ 'class' => 'form-control' ]) !!}
            <label>User</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-success" id="add_row"><i class="fa fa-plus"></i> Add</a><br><br>
    </div>
    <table class="table">
        
        <thead>
            
            <tr>
                <th>Barang</th>
                <th>Stok</th>
                <th>Harga Satuan</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="detail" class="table table-hover table-light">
                @if(!empty($data->purchase_details))
                @foreach($data->purchase_details as $detail)
                @php
                $subtotal = @$detail->qty * @$detail->price;
                @$total += $subtotal;
                @endphp
                <tr>
                <td>
                    <div class="form-group form-md-line-input has-success">
                        {!! Template::selectbox($listInventory->toArray(),@$detail->inventory_id,"inventory_id[]",[ 'class' => 'form-control inventory_id select' ]) !!}
                    </div>
                </td>
                <td>
                    <div class="form-group form-md-line-input has-success">
                        <input type="text" readonly class="form-control stock" value="{{@$detail->inventory->stock}}">
                        <label for="">Stock</label>
                    </div>
                </td>
                <td>
                    <div class="form-group form-md-line-input has-success">
                        <input type="number" readonly  id="" class="form-control at_price" value="{{@$detail->inventory->price}}">
                        <label for="">Harga Satuan</label>
                    </div>
                </td>
                <td>
                    <div class="form-group form-md-line-input has-success">
                        <input type="number" name="qty[]" id="" class="form-control qty" value="{{@$detail->qty}}">
                        <label for="">Qty</label>
                    </div>
                </td>
                <td>
                    <div class="form-group form-md-line-input has-success">
                        <input type="number" readonly name="price[]" id="" class="form-control price" value="{{@$detail->price}}">
                        <label for="">Harga</label>
                    </div>
                </td>
                <td><a class="hapus" title="Delete Record" id=""><i class="fa fa-trash-o"></i></a></td>
             </tr>
             @endforeach
            @endif
            </tbody>
    </table>
</div>
<button class="btn green" type="submit">Save</button>
<button class="btn red"> Cancel </button>
@section('js')
<script>
    $(document).ready(function() {
    
    $("body").on('click','.hapus', function(){
        $('.hapus').eq($(this).index()).parent().parent().remove();
    });
    $("#add_row").click(function(){
        var url = "{{ url('purchases/detail') }}";
        $.get( url, function( data ) {
            $("#detail").append( data );
            $('.select').select2();
        });
    });

    $("body").on('change','.inventory_id', function(){
        var index       = $(this).index(".inventory_id");
        var inventory_id     = $(this).val();
        
        $( ".stock" ).eq(index).val(0);
        $( ".at_price" ).eq(index).val(0);
        if(inventory_id > 0)
        {
            var url = "{{ url('api/inventories') }}"+"/"+inventory_id;
            $.get( url, function( data ) {
                console.log(data.data.stock);
                if(data.data.stock > 0)
                {
                    $(".stock").eq(index).val(data.data.stock);
                    $('.at_price').eq(index).val(data.data.price);   
                }
            }, "json" );
        }
    });
    $("body").on('keyup','.qty', function(){
        var index       = $(this).index(".qty");
        subtotal(index);
    }); 

    $("body").on('keyup','.qty', function(){
        var index       = parseFloat($('.qty').val());
        var stock       = parseFloat($('.stock').val());
        var price = parseFloat($('.at_price').val());
        $(".price").val(price * index);
    });

    function subtotal(index){
        var qty     = $(".qty").eq(index).val();
        var price   = $(".at_price").eq(index).val();
        $(".price").eq(index).val(qty * price);
        
    }

});
</script>
@endsection


