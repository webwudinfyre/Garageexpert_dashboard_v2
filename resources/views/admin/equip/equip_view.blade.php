@extends('admin.layouts.master')

@section('contents')

    <style>
        .bluck_add {

            padding: 20px;
            border: 1px solid #d1d1d1;
            border-radius: 5px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .single_add {

            padding: 20px;
            border: 1px solid #d1d1d1;
            border-radius: 5px;
            margin-top: 20px;
        }

        .single_add h4 {
            margin-bottom: 20px;
        }

        .bluck_add h4 {
            margin-bottom: 20px;
        }

        .bluck_add form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .bluck_add .form-control-file {
            width: 100%;
            /* Take up full width */
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .bluck_add button {

            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <div id="pagetitle" class="pagetitle">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-8  align-items-center ">
                <h1>Equipment Details</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Equipments</li>
                    </ol>
                </nav>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <button type="button" class="btn bg-primary_expert" data-bs-toggle="modal" data-bs-target="#equipments"><i
                        class="bi bi-plus me-1"></i><span class="add"> Add Equipments</span></button>
            </div>
        </div>

    </div>

    <section class="section pt-3" id="section_admin">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <div class="card_head">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-12">
                                    <h5 class="card-title">Equipments List</h5>
                                </div>

                            </div>
                        </div>



                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table id="admin_table" class="table datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>sl.no</th>
                                        <th>
                                            Item Id
                                        </th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Item Name</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $items)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $items->item_id }}</td>
                                            <td>
                                                {{ $items->Brand }}
                                            </td>
                                            <td>{{ $items->Model }} </td>
                                            <td>{{ $items->Item_name }}</td>
                                            <td>
                                                <div class="action_icon ">
                                                    {{-- <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="View" >
                                                        <button type="button" class="btn" data-bs-target="#view_equip"
                                                        data-bs-whatever={{ $items->id }}>
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                    </a> --}}
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                   data-bs-title="View">
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#view_equip"
                                                        data-bs-whatever={{ $items->id }}>
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </a>

                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Password change">
                                                        <button type="button" class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#view_delete"
                                                            data-bs-whatever={{ $items->id }}>
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </a>







                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="Add_Equipments">
        <div class="modal fade" id="equipments" tabindex="-1" aria-labelledby="equipments" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Equipment</h1>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                                class="bi bi-x"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="bluck_add mb-4">

                            <h4 class="modal-title fs-5" id="exampleModalLabel">Add Bulk Equipments</h4>


                            <form action="/import" method="post" enctype="multipart/form-data">
                                @csrf
                                <label for="file" class="visually-hidden">Choose a file:</label>
                                <input type="file" name="file" id="file" accept=".xlsx"
                                    class="form-control-file">
                                <button type="submit" class="btn bg-primary_expert">Import</button>
                            </form>
                        </div>
                        <hr class="mt-5">
                        <h6 class="modal-title fs-5 text-center  ">OR</h6>
                        <hr class=" mb-5">
                        <div class="single_add mt-4">
                            <h4 class="modal-title fs-5" id="exampleModalLabel">Add Single Equipment </h4>
                            <form action="{{ route('admin.equipment.create') }}" class="row g-3" method="POST">
                                @csrf


                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingitem_id"
                                            placeholder="Item ID" name="item_id" required autocomplete="item_id"
                                            autofocus value="{{ old('item_id') }}">
                                        <label for="floatingitem_id">Item ID</label>
                                        @error('item_id')
                                            <div class="alert-color" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingItem_name"
                                            placeholder="Item Name" name="Item_name" required autocomplete="Item_name"
                                            autofocus value="{{ old('Item_name') }}">
                                        <label for="floatingItem_name">Item Name</label>
                                        @error('Item_name')
                                            <div class="alert-color" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingBrand"
                                            placeholder="Brand Name" name="Brand" required autocomplete="Brand"
                                            autofocus value="{{ old('Brand') }}">
                                        <label for="floatingBrand">Brand Name</label>
                                        @error('Brand')
                                            <div class="alert-color" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingModel"
                                            placeholder="Model" name="Model" required autocomplete="Model"
                                            autofocus value="{{ old('Model') }}">
                                        <label for="floatingModel">Model</label>
                                        @error('Brand')
                                            <div class="alert-color" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>






                                <div class="text-center">

                                    <button type="submit" class="btn bg-primary_expert btn-style">Submit</button>

                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="view" id="view">
        <div class="modal fade" id="view_equip" tabindex="-1" aria-labelledby="view_equip"
            aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Equipment Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.equipment.update') }}" class="row g-3" method="POST">
                            @csrf

                            <input type="text" class="form-control" id="recipient_name" name="id"  hidden>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingitem_id"
                                        placeholder="Item ID" name="item_id" required autocomplete="item_id"
                                        autofocus value="{{ old('item_id') }}" disabled>
                                    <label for="floatingitem_id">Item ID</label>
                                    @error('item_id')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingBrand"
                                        placeholder="Brand Name" name="Brand" required autocomplete="Brand"
                                        autofocus value="{{ old('Brand') }}">
                                    <label for="floatingBrand">Brand Name</label>
                                    @error('Brand')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    {{-- <input type="text" class="form-control" id="floatingItem_name"
                                        placeholder="Item Name" name="Item_name" required autocomplete="Item_name"
                                        autofocus value="{{ old('Item_name') }}">
                                    <label for="floatingItem_name">Item Name</label> --}}
                                    <textarea class="form-control" name="Item_name" placeholder="Address" id="floatingTextarea" style="height: 100px;"></textarea>
                                    <label for="floatingTextarea">Item_name</label>
                                    @error('Item_name')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingModel"
                                        placeholder="Model" name="Model" required autocomplete="Model"
                                        autofocus value="{{ old('Model') }}">
                                    <label for="floatingModel">Model</label>
                                    @error('Brand')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>






                            <div class="text-center">

                                <button type="submit" class="btn bg-primary_expert btn-style">Submit</button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="view" id="view">
        <div class="modal fade" id="view_delete" tabindex="-1" aria-labelledby="view_delete" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Equipment Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.equipment.delete') }}" class="row g-3" method="POST">
                            @csrf

                            <input type="text" class="form-control" id="recipient_name" name="id" hidden>
                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0">Item ID</p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"><span id="Item_ID"></span></p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0">Brand</p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"><span id="Brand"></span></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0">Model</p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"><span id="Model"></span></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <p class="mb-0">Item Name</p>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="text-muted mb-0"><span id="Item_Name"></span></p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-primary_expert btn-style">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($errors->any())
        @section('script')
            <script>
                $(document).ready(function() {
                    $('#equipments').modal('show');
                });
            </script>
        @endsection
    @endif


@endsection
