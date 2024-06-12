@extends('client.layouts.master')

@section('contents')
    <style>
        .bluck_add {
            padding: 20px;
            border: 1px solid #d1d1d1;
            border-radius: 5px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .rating .icon {
            color: #ccc;
        }

        .rating input[type="radio"]:checked~.icon {
            color: #f90;
        }

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .Review_submit {
            display: flex;
            flex-direction: row-reverse;
        }

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .star-rating-complete {
            color: #c59b08;
        }

        .rating-container .form-control:hover,
        .rating-container .form-control:focus {
            background: #fff;
            border: 1px solid #ced4da;
        }

        .rating-container textarea:focus,
        .rating-container input:focus {
            color: #000;
        }

        .rated {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rated:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ffc700;
        }

        .rated:not(:checked)>label:before {
            content: '★ ';
        }

        .rated>input:checked~label {
            color: #ffc700;
        }

        .rated:not(:checked)>label:hover,
        .rated:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rated>input:checked+label:hover,
        .rated>input:checked+label:hover~label,
        .rated>input:checked~label:hover,
        .rated>input:checked~label:hover~label,
        .rated>label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>
    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-8  align-items-center ">
                    <h1>Review </h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('client.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Review Details</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-4 d-flex justify-content-end">


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

                                        <div class="col-md-6 custom-border ">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Product Code</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3">
                                                            {{ $customer_reviews->product_task_rew->product_add->product_code }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6 custom-border ">
                                            <div class="under_line">
                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Serial number</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3"> @nullOrValue($customer_reviews->product_task_rew->product_add->serial_number, 'Serial number')</p>
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
                                                        <p class="text-muted job_detatil_v3">
                                                            {{ $customer_reviews->product_task_rew->product_add->equip_pdt->Brand }}
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
                                                        <p class="text-muted job_detatil_v3">
                                                            {{ $customer_reviews->product_task_rew->product_add->equip_pdt->Model }}
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
                                                            {{ $customer_reviews->product_task_rew->product_add->equip_pdt->Item_name }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6 custom-border">
                                            <div class="under_line ">

                                                <div class="row ">
                                                    <div class="col-6 ">
                                                        <p class="mb-0">Warranty </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-muted job_detatil_v3">
                                                            {{ $customer_reviews->product_task_rew->product_add->warranty->warranty_type === '1' ? 'Yes' : 'No' }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        {{-- @if ($customer_reviews->product_task_rew->product_add->warranty->warranty_type === '1') --}}
                                            <div class="col-md-6 custom-border">
                                                <div class="under_line ">

                                                    <div class="row ">
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Warranty Current Status</p>
                                                        </div>
                                                        <div class="col-6">
                                                            @php
                                                                $endDate = \Carbon\Carbon::parse(
                                                                    $customer_reviews->product_task_rew->product_add
                                                                        ->warranty->end_date,
                                                                );
                                                                $currentDate = \Carbon\Carbon::now();
                                                                $isWarrantyValid = $endDate->gte($currentDate);
                                                            @endphp

                                                            <p class="text-muted job_detatil_v3">
                                                                {{ $isWarrantyValid ? 'Yes' : 'No' }}</p>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6 custom-border">
                                                <div class="under_line ">

                                                    <div class="row ">
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Warranty Start Date</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="text-muted job_detatil_v3">
                                                                {{ $customer_reviews->product_task_rew->product_add->warranty->Start_date }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>


                                            <div class="col-md-6 custom-border">
                                                <div class="under_line ">

                                                    <div class="row ">
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Warranty End Date</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="text-muted job_detatil_v3">
                                                                {{ $customer_reviews->product_task_rew->product_add->warranty->end_date }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        {{-- @endif --}}



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
                        <div class="card_head">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-12">
                                    <h5 class="card-title">Review</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <form action="{{ route('client.client.review.update') }}" method="Post">
                                @csrf
                                <input type="hidden" name='id' value="{{ $customer_reviews->id }}">
                                <div class="col-12">
                                    <div id="job_deatail_v2" class="bluck_add mb-4">
                                        <div class="head-profie">
                                            <h5 class="card-title">Product Review</h5>
                                        </div>
                                        <div class="row gy-3">

                                            <div class="col-md-6 custom-border ">
                                                <div class="under_line">
                                                    <div class="row ">
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Star Rating</p>
                                                        </div>
                                                        <div class="col-6">




                                                            <div class="rated">
                                                                @for ($i = 1; $i <= $customer_reviews->Product_reviews_star; $i++)
                                                                    {{-- <input type="radio" id="star{{$i}}" class="rate" name="rating" value="5"/> --}}
                                                                    <label class="star-rating-complete"
                                                                        title="text">{{ $i }} stars</label>
                                                                @endfor
                                                            </div>


                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6 custom-border ">
                                                <div class="under_line">
                                                    <div class="row ">
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Comments</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="text-muted job_detatil_v3">
                                                                {{ $customer_reviews->Product_reviews }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-12 custom-border ">

                                                <div class="under_line pb-5">
                                                    <div class="row ">
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Star Rating</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="col">
                                                                <div class="rate">
                                                                    <input type="radio" id="star5_1" class="rate"
                                                                        name="rating_1" value="5" />
                                                                    <label for="star5_1" title="text">5 stars</label>
                                                                    <input type="radio" checked id="star4_1"
                                                                        class="rate" name="rating_1" value="4" />
                                                                    <label for="star4_1" title="text">4 stars</label>
                                                                    <input type="radio" id="star3_1" class="rate"
                                                                        name="rating_1" value="3" />
                                                                    <label for="star3_1" title="text">3 stars</label>
                                                                    <input type="radio" id="star2_1" class="rate"
                                                                        name="rating_1" value="2">
                                                                    <label for="star2_1" title="text">2 stars</label>
                                                                    <input type="radio" id="star1_1" class="rate"
                                                                        name="rating_1" value="1" />
                                                                    <label for="star1_1" title="text">1 star</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Comments</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="col">
                                                                <textarea class="form-control" name="comment_product" rows="6 " placeholder="Comment" maxlength="200"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Additional content here -->
                                            </div>

                                            <!-- Additional content here -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div id="job_deatail_v2" class="bluck_add mb-4">
                                        <div class="head-profie">
                                            <h5 class="card-title">Technician Review</h5>
                                        </div>
                                        <div class="row gy-3">
                                            <div class="col-md-6 custom-border ">
                                                <div class="under_line">
                                                    <div class="row ">
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Star Rating</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="rated">
                                                                @for ($i = 1; $i <= $customer_reviews->tech_reviews_star; $i++)
                                                                    {{-- <input type="radio" id="star{{$i}}" class="rate" name="rating" value="5"/> --}}
                                                                    <label class="star-rating-complete"
                                                                        title="text">{{ $i }} stars</label>
                                                                @endfor
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6 custom-border ">
                                                <div class="under_line">
                                                    <div class="row ">
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Comments</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="text-muted job_detatil_v3">
                                                                {{ $customer_reviews->tech_reviews }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-12 custom-border ">
                                                <div class="under_line pb-5">
                                                    <div class="row ">
                                                        <div class="col-6 ">
                                                            <p class="mb-0">Star Rating</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="col">
                                                                <div class="rate">
                                                                    <input type="radio" id="star5_2" class="rate"
                                                                        name="rating_2" value="5" />
                                                                    <label for="star5_2" title="text">5 stars</label>
                                                                    <input type="radio" checked id="star4_2"
                                                                        class="rate" name="rating_2" value="4" />
                                                                    <label for="star4_2" title="text">4 stars</label>
                                                                    <input type="radio" id="star3_2" class="rate"
                                                                        name="rating_2" value="3" />
                                                                    <label for="star3_2" title="text">3 stars</label>
                                                                    <input type="radio" id="star2_2" class="rate"
                                                                        name="rating_2" value="2">
                                                                    <label for="star2_2" title="text">2 stars</label>
                                                                    <input type="radio" id="star1_2" class="rate"
                                                                        name="rating_2" value="1" />
                                                                    <label for="star1_2" title="text">1 star</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-6 ">
                                                            <p class="mb-0">Comments</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="col">
                                                                <textarea class="form-control" name="comment_tech" rows="6 " placeholder="Comment" maxlength="200"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- Additional content here -->
                                            </div>

                                            <!-- Additional content here -->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="Review_submit">
                                        <button type="submit" class="btn bg-primary_expert btn-style">Submit</button>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sections = document.querySelectorAll('.bluck_add');

                sections.forEach(section => {
                    const stars = section.querySelectorAll('.rate .rate');
                    const ratingInputs = section.querySelectorAll('input[type="radio"]');

                    stars.forEach((star, index) => {
                        star.addEventListener('click', function() {
                            // Deselect all stars in this section
                            ratingInputs.forEach(input => input.checked = false);
                            // Select the clicked star and all stars before it in this section
                            for (let i = 0; i <= index; i++) {
                                ratingInputs[i].checked = true;
                            }
                        });
                    });
                });

                // Prevent form submission if no rating is selected in any section
                document.getElementById('ratingForm').addEventListener('submit', function(event) {
                    const selectedRating = document.querySelectorAll('input[type="radio"]:checked');
                    if (selectedRating.length === 0) {
                        event.preventDefault();
                        alert('Please select a rating in each section.');
                    }
                });
            });
        </script>
    @endpush
@endsection
