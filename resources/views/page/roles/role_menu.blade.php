@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="portlet green-sharp box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings"></i>
                    <span class="caption-subject font-white sbold uppercase">{{ $title }}</span>
                    <small>managemen data {{ $title }}</small>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                        <i class="fa-plus"></i>
                    </a>
                </div>
            </div>

            <div class="portlet-body">
                <form method="post" action="{{ route('role_menus.store') }}" enctype="multipart/form-data" class="m-form">
                    {{ csrf_field() }}
					<input type="hidden" value="{{request()->route('id')}}" name="role_id">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="m-form__group form-group">
                            @if(!empty($menus))
                            @foreach($menus as $menu)
                            @if(!empty($menu->url))
                            <div class="m-checkbox-list">
                                <label class="m-checkbox m-checkbox--state-success">
                                    <input type="checkbox" name="menu_id[]" {{ (array_key_exists($menu->id, $list_role_menu) ? 'checked' : ' asdfsafdsad') }} value="{{ $menu->id }}">
                                    <strong>{{ $menu->name }}</strong>
                                    <span></span>
                                </label>
                            </div>
                            @else
                                <label><strong>{{ $menu['head'] }}</strong></label>
                                <div class="m-checkbox-list">
                                @foreach($menu['detail'] as $det)
                                <label class="m-checkbox m-checkbox--state-success">
                                    <input type="checkbox" name="menu_id[]" {{ (array_key_exists($det->id, $list_role_menu) ? 'checked' : '') }} value="{{ $det->id }}">
                                    {{ $det->name }}
                                    <span></span>
                                </label>
                                @endforeach
                                </div>
                            @endif
                            @endforeach
                            @endif
                            </div>


                        </div>
                    </div>
                    <button class="btn green" type="submit">Save</button>
                    <a href="{{ url('/'.$view) }}" class="btn red"> Cancel </a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
