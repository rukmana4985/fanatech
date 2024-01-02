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
                <div class="actions">
                    <a class="btn white btn-outline btn-circle" href="{{ route($view.'.create') }}">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-xs"> Add </span>
                    </a>
                </div>
            </div>

            <div class="portlet-body">
                <table id="datatable" class="table table-striped table-bordered table-hover table-checkable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection
