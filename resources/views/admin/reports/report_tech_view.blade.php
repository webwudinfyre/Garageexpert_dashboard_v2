@extends('admin.layouts.master')

@section('contents')
    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-8  align-items-center ">
                    <h1>Technician Reports</h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Technician Reports</li>

                        </ol>
                    </nav>
                </div>



            </div>

        </div>
    </section>

    @php
    $asd = $techusers['user_id'];
@endphp

<x-example-component :adminId="$asd"  admin="admin" />
    <section class="section pt-3" id="section_admin">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <div class="card_head">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-12">
                                    <h5 class="card-title">Technician Name : {{ $techusers['firstname'] }}
                                        {{ $techusers['lastname'] }}</h5>
                                </div>

                            </div>
                        </div>


                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table id="admin_table" class="table datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl.no</th>
                                        <th>
                                            Product Details
                                        </th>
                                        <th>Client Details</th>
                                        <th>Task Status</th>
                                        <th>Type Service</th>
                                        <th>Date</th>


                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($prdt_task as $key => $prdt_task)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                <ul>
                                                    <li>Product code : {{ $prdt_task->product_add->product_code }}
                                                    </li>
                                                    <li>Serial Number:{{ $prdt_task->product_add->serial_number }}
                                                    </li>

                                                </ul>

                                            </td>
                                            <td>
                                                <ul>
                                                    <li>Office Name : {{ $prdt_task->product_add->client_pdt->office }}
                                                    </li>
                                                    <li>Location :{{ $prdt_task->product_add->client_pdt->location }}
                                                    </li>

                                                </ul>

                                            </td>
                                            <td>{{ $prdt_task->task->task_name }}
                                            </td>
                                            <td>{{ $prdt_task->type_service->service_name }}
                                            </td>
                                            @php
                                                $startDate = \Carbon\Carbon::parse($prdt_task->date_of_schedule);
                                                $endDate = \Carbon\Carbon::parse($prdt_task->updated_at);
                                                $dateDifference = $endDate->diffInDays($startDate);

                                                if ($dateDifference === 0) {
                                                    $differenceDescription = 'on date';
                                                } elseif ($dateDifference > 0) {
                                                    $differenceDescription = 'late by ' . $dateDifference . ' days';
                                                } else {
                                                    $differenceDescription =
                                                        'early by ' . abs($dateDifference) . ' days';
                                                }
                                            @endphp
                                            <td>
                                                <ul>
                                                    <li>Date Difference: {{ $dateDifference }}
                                                    </li>
                                                    <li>Description: {{ $differenceDescription }}
                                                    </li>

                                                </ul>

                                            </td>

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
