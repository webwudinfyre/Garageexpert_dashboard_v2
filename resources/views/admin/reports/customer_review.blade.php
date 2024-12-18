@extends('admin.layouts.master')

@section('contents')
    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-8  align-items-center ">
                    <h1>Client Reports</h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Customer Review </li>

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
                        <h5 class="card-title">Review Details</h5>

                        <!-- Bordered Tabs Justified -->
                        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-justified-home" type="button" role="tab"
                                    aria-controls="home" aria-selected="true">Product Review </button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#bordered-justified-profile" type="button" role="tab"
                                    aria-controls="profile" aria-selected="false">Technician Review</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                            <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="table-responsive pt-2">
                                    <table id="admin_table" class="table datatable table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Product Details</th>
                                                <th>Product Count</th>
                                                <th>Star Rating (out of 5)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach ($product_review as $key => $product_review)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <ul>
                                                        <li>Item Id: {{ $product_review->item_id }}</li>
                                                        <li>Brand: {{ $product_review->Brand }}</li>
                                                        <li>Model: {{ $product_review->Model }}</li>
                                                        <li>Item Name: {{ $product_review->Item_name }}</li>
                                                    </ul>
                                                </td>
                                                <td>{{ $product_review->total_reviews }}</td>
                                                <td>
                                                    {{-- Render filled stars --}}
                                                    @for ($i = 1; $i <= floor($product_review->average_rating_out_of_5); $i++)
                                                        <label class="star-rating-complete" title="Filled Star">
                                                            <i class="bi bi-star-fill"></i>
                                                        </label>
                                                    @endfor

                                                    {{-- Render half star if needed --}}
                                                    @if ($product_review->average_rating_out_of_5 - floor($product_review->average_rating_out_of_5) >= 0.5)
                                                        <label class="star-rating-complete" title="Half Star">
                                                            <i class="bi bi-star-half"></i>
                                                        </label>
                                                    @endif

                                                    {{-- Render empty stars --}}
                                                    @for ($i = ceil($product_review->average_rating_out_of_5) + 1; $i <= 5; $i++)
                                                        <label class="star-rating-complete" title="Empty Star">
                                                            <i class="bi bi-star"></i>
                                                        </label>
                                                    @endfor
                                                </td>
                                                <td>
                                                    <div class="action_icon">
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"
                                                            href="{{ route('admin.reports.customer.reviewdetails', ['id' => $product_review->equipment_id]) }}">
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
                            <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <div class="table-responsive pt-2">
                                    <table id="admin_table" class="table datatable table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Technician Name</th>
                                                <th>Total Reviews</th>
                                                <th>Star Rating</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                     <tbody>
                                        @foreach ($tech_reviews as $key => $tech_review)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $tech_review->name }}</td>
                                            <td>{{ $tech_review->total_reviews }}</td>
                                            <td>
                                                {{-- Render filled stars --}}
                                                @for ($i = 1; $i <= floor($tech_review->average_rating_out_of_5); $i++)
                                                    <label class="star-rating-complete" title="Filled Star">
                                                        <i class="bi bi-star-fill"></i>
                                                    </label>
                                                @endfor

                                                {{-- Render half star if needed --}}
                                                @if ($tech_review->average_rating_out_of_5 - floor($tech_review->average_rating_out_of_5) >= 0.5)
                                                    <label class="star-rating-complete" title="Half Star">
                                                        <i class="bi bi-star-half"></i>
                                                    </label>
                                                @endif

                                                {{-- Render empty stars --}}
                                                @for ($i = ceil($tech_review->average_rating_out_of_5) + 1; $i <= 5; $i++)
                                                    <label class="star-rating-complete" title="Empty Star">
                                                        <i class="bi bi-star"></i>
                                                    </label>
                                                @endfor
                                            </td>
                                            <td>
                                                <div class="action_icon">
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"
                                                       href="{{ route('admin.reports.customer.reviewdetails_tech', ['id' => $tech_review->tech_user_id]) }}">
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

                        </div><!-- End Bordered Tabs Justified -->

                    </div>
                </div>



            </div>

        </div>
    </section>
@endsection
