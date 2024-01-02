<div class="row">
    <div class="col-md-6 ">
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="text" name="name" value="{{ @$data->name }}">
            <label>Name</label>
        </div>
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="text" name="slug" value="{{ @$data->slug }}">
            <label>Slug</label>
        </div>
    </div>
</div>
<button class="btn green" type="submit">Save</button>
<a href="{{ url('/'.$view) }}" class="btn red"> Cancel </a>