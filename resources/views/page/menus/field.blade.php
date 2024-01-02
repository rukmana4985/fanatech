<div class="row">
    <div class="col-md-6 ">
        <div class="form-body form-group form-md-line-input">
            {!! Template::selectbox([''=>' - Pilih Menu - '] + $listMenus->toArray(),@$data->parent_id,"parent_id",["class" => "form-control"]) !!}
            <label>Name</label>
        </div>
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="text" name="name" value="{{ @$data->name }}">
            <label>Name</label>
        </div>
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="text" name="url" value="{{ @$data->url }}">
            <label>URL</label>
        </div>
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="text" name="icon" id="icon" value="{{ @$data->icon }}">
            <label>Icon</label>
            <div class="input-icon right">
                <i id="show_icon" class=""></i>
            </div>
        </div>
    </div>
</div>
<button class="btn green" type="submit">Save</button>
<button class="btn red"> Cancel </button>
@section('js')
<script>
$("#icon").keyup(function(){
    $("#show_icon").attr("class", $(this).val());
});
$("#icon").keyup();
</script>
@endsection
