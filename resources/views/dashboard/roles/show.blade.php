@extends('dashboard.layouts.master')
@section('title', 'عرض صلاحيات مستخدم')

@section('css')
    <!---Internal Fancy uploader css-->
    <link href="{{ asset('dashboard/assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal TelephoneInput css-->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
    <!--- Animations css-->
    <link href="{{ asset('dashboard/assets/css/animate.css') }}" rel="stylesheet">
@endsection

@section('page-title', 'عرض صلاحيات مستخدم')
@section('page-link-back')
    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.employees.index') }}">المستخدمين</a></li>
@endsection
@section('current-page', 'عرض صلاحيات مستخدم')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2> Show Role
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('dashboard.roles.index') }}"> Back</a>
                </div>
            </h2>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 mb-3">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 mb-3">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if (!empty($rolePermissions))
                @foreach ($rolePermissions as $v)
                    <label class="label label-secondary text-dark">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
