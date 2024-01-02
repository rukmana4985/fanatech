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
                <form method="post" action="{{ url('/'.$view.'/'.$data->id) }}" enctype="multipart/form-data">
                    {{ method_field('PUT')}}
                    {{ csrf_field() }}
                    @include('page.'.$view.'.field')
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
