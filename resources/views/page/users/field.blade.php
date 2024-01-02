<div class="row">
    <div class="col-md-6 ">
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="text" name="username" value="{{ @$data->username }}">
            <label>Nama</label>
        </div>
        <div class="form-body form-group form-md-line-input">
            @if(url($view.'/create'))
                <input class="form-control" type="password" name="password"  value="{{ @$data->password }}">
            @else
                <input class="form-control" type="password" readonly name="password"  value="{{ @$data->password }}">
            @endif
            <label>Password</label>
        </div>
        <div class="form-body form-group form-md-line-input">
            {!! Template::selectbox($listRole,@$data->role_id,"role_id",[ 'class' => 'form-control' ]) !!}
            <label>Jabatan</label>
        </div>
    </div>
</div>
<button class="btn green" type="submit">Save</button>
<button class="btn red"> Cancel </button>
