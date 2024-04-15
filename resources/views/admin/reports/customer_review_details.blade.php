@extends('admin.layouts.master')

@section('contents')
    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-8  align-items-center ">
                    <h1>Review Reports</h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active"> <a   href="{{ route('admin.reports.customer_review') }}">Customer Review </a> </li>
                            <li class="breadcrumb-item active">product Review </li>

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
                                    <h5 class="card-title">Job Information</h5>
                                </div>

                            </div>
                        </div>
                        <div class="row">


                            <div class="col-12">

                                <div id="job_deatail_v2" class="bluck_add mb-4">
                                    <div class="head-profie">
                                        <h5 class="card-title">Product Details</h5>

                                    </div>
                                    <div class="row gy-3">


                                        <div class="col-md-6 custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Item Id</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3">{{ $eqpt_id->item_id }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 custom-border">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Brand Name</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3">{{ $eqpt_id->Brand }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 custom-border">
                                            <div class="under_line ">
                                                <div class="row ">

                                                    <div class="col-6 ">
                                                        <p class="mb-0">Model</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3">{{ $eqpt_id->Model }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6 custom-border">
                                            <div class="under_line ">

                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Product Name </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3">
                                                            {{ $eqpt_id->Item_name }}</p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>






                                    </div>


                                </div>

                            </div>



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
                        <h5 class="card-title">Review Details</h5>


                        <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                            <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="table-responsive pt-2">
                                    <table id="admin_table" class="table datatable table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Product Task</th>
                                                <th>Client Details</th>
                                                <th>Product Reviews</th>
                                                <th>Star Rating (out of 5)</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($customer_reviews as $key => $customer_reviews)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>



                                                    <td>
                                                         <ul>
                                                            <li>Product Code
                                                                :{{ $customer_reviews->product_task_rew->product_add->product_code }}
                                                            </li>
                                                            <li>Serial Number
                                                                :{{ $customer_reviews->product_task_rew->product_add->serial_number }}
                                                            </li>

                                                            <li>Service Name
                                                                :{{ $customer_reviews->type_service->service_name }}</li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                         <ul>
                                                            <li>office Name
                                                                : {{ $customer_reviews->product_task_rew->product_add->client_pdt->office }}</li>

                                                            <li>Location
                                                                :{{ $customer_reviews->product_task_rew->product_add->client_pdt->location }}
                                                            </li>
                                                            <li>Phone Number
                                                                :{{ $customer_reviews->product_task_rew->product_add->client_pdt->phonenumber }}
                                                            </li>

                                                        </ul>

                                                    <td>{{ $customer_reviews->Product_reviews }}</td>
                                                    <td>
                                                        @for ($i = 1; $i <= $customer_reviews->Product_reviews_star; $i++)

                                                            <label class="star-rating-complete" title="text"><i
                                                                    class="bi bi-star-fill"></i> </label>
                                                        @endfor
                                                    </td>
                                                    <td>





                                                    </td>



                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div><!-- End Bordered Tabs Justified -->

                    </div>
                </div>



            </div>

        </div>
    </section>
@endsection
