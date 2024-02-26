@extends('admin.layouts.master')

@section('contents')

<div id="pagetitle" class="pagetitle">
    <div class="row d-flex justify-content-between align-items-center">
        <div class="col-8  align-items-center ">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Admin Profile</li>
                </ol>
            </nav>
        </div>

    </div>

</div>




@endsection
