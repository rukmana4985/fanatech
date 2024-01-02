<div class="row">
    <div class="col-md-6 ">
        <div class="form-body form-group form-md-line-input">
            {!! Template::selectbox($listRole,@$data->role_id,'role_id',['class' => 'form-control']) !!}
            <label>Role</label>
        </div>
        <div class="form-body form-group form-md-line-input">
            {!! Template::selectbox($listMenu,@$data->menu_id,'menu_id',['class' => 'form-control']) !!}
            <label>Menu</label>
        </div>
    </div>
</div>
<button class="btn green" type="submit">Save</button>
<button class="btn red"> Cancel </button>
