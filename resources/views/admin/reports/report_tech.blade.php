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
<section class="section pt-3" id="section_admin">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <div class="card_head">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-12">
                                <h5 class="card-title">Technician List</h5>
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
                                         Name
                                    </th>
                                    <th>Task Number</th>
                                    <th>New Task</th>
                                    <th>Pending</th>
                                    <th>Completed</th>
                                    <th>Quotation</th>
                                    <th>Review Rate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($finalData as $key=>$finalData)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $finalData['name']}}</td>
                                        <td>{{ $finalData['product_id'] }}</td>
                                        <td>{{ $finalData['tasks']['New Task'] ?? 'Task not found' }}</td>
                                        <td>{{ $finalData['tasks']['Pending'] ?? 'Task not found' }}</td>
                                        <td>{{ $finalData['tasks']['Completed'] ?? 'Task not found' }}</td>
                                        <td>{{ $finalData['tasks']['Quotation'] ?? 'Task not found' }}</td>

                                        <td></td>
                                        <td>
                                            <div class="action_icon ">
                                                <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="View"
                                                    href="{{ route('admin.reports.techreport_view', ['id' =>$finalData['techuser_id']]) }}">
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
