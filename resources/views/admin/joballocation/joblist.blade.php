@extends('admin.layouts.master')

@section('contents')
    <style>
        .start_date {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>

    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-12  align-items-center ">
                    <h1>Job List</h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>

                            @if(!empty($search_page))
                            <li class="breadcrumb-item active"><a href="{{ route('admin.joballocation.job_list') }}">Job List</a></li>
                            <li class="breadcrumb-item active">Job Serach Result</li>
                            @else
                            <li class="breadcrumb-item active">Job List</li>
                            @endif
                        </ol>
                    </nav>
                </div>

            </div>

        </div>
    </section>


    @include('components.task_status_admin')

    {{-- $notifications = auth()->user()->notifications; --}}
    <section class="section pt-3" id="section_Search">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body ">
                        <div class="row gy-3 mt-3">

                            <form action="{{ route('admin.joballocation.search') }}" class="row g-3" method="GET">

                            <div class="col-xxl-3 col-md-6 ">



                                <div class="row">
                                    <div class="start_date">
                                        <div class="col-sm-4 mt-2">
                                            <label for="inputDate" class="form-label">Start Date :</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="Start_date"  autocomplete="Start_date" value="{{ !empty($search_page) ? $search_page['start_date'] : '' }}">
                                        </div>

                                    </div>
                                    @error('Start_date')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div class="row">
                                    <div class="start_date">
                                        <div class="col-sm-4  mt-2">
                                            <label for="inputDate" class="form-label">End Date :</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="End_date" autocomplete="End_date" value="{{  !empty($search_page) ? $search_page['end_date'] : '' }}">
                                        </div>

                                    </div>
                                    @error('End_date')
                                        <div class="alert-color" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6 text-center">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="Task_value">
                                            <option value=""  selected >Please Choose Task</option>

                                            @foreach ($task as $item)
                                                <option value="{{ $item->id }} " {{ !empty($search_page) && $search_page['Task_value'] == $item->id ? 'selected' : '' }}> <span class="service_option_size">
                                                        {{ $item->task_name }} </span></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xxl-3 col-md-6 text-center ">
                                <div class="search">
                                    <div class="form-floating mb-3 ">
                                        <button type="submit" class="btn bg-primary_expert"
                                            style="height: 100%; width:50%">search</button>
                                    </div>
                                </div>

                            </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="section pt-3" id="section_admin">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <div class="card_head">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-12">
                                    <h5 class="card-title">Job List</h5>
                                </div>

                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table id="admin_table" class="table datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>sl.no</th>
                                        <th> Product Code</th>
                                        <th>Office Name</th>
                                        <th>Loaction</th>
                                        <th>Service</th>
                                        <th>Task</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prdt_task as $prdt_task)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $prdt_task->product_add->product_code }}</td>
                                            <td>{{ $prdt_task->product_add->client_pdt->office }}</td>
                                            <td>{{ $prdt_task->product_add->client_pdt->location }}</td>
                                            <td>{{ $prdt_task->type_service->service_name }}</td>
                                            <td>{{ $prdt_task->task->task_name }}</td>

                                            <td>
                                                <div class="action_icon ">
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"
                                                        href="{{ route('admin.joballocation.job_list_view', ['id' => encrypt($prdt_task->product_id)]) }}">
                                                        <button type="button" class="btn">
                                                            <i class="bi bi-eye"></i>
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
@endsection
