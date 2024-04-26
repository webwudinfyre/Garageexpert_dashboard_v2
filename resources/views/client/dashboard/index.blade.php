@extends('client.layouts.master')

@section('contents')
    <style>
        .card-title {
            padding: 20px 0 15px 0;
            font-size: 18px;
            font-weight: 500;
            color: #000000;
            font-family: "Poppins", sans-serif;
        }
    </style>
    <div class="pagetitle">
        <h1>Client Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">

                <x-task-listclient adminId='{{ Auth::user()->id }}' admin="tech" />

            </div>






            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">



                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">

                                <a class="icon" href="{{ route('client.client.tracking_details') }}">View More</a>

                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Tracking <span>/Latest</span></h5>

                                <div id="timeline-container" class="timeline-container">
                                    <div id="timeline" class="timeline">
                                        <div class="row">
                                            @foreach ($taskHistoryArray as $taskId => $taskHistory)
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <div class="">
                                                        <div class="card-body">
                                                            <div class="timeline_card_head">
                                                                <h4 class="card-title">Code :
                                                                    {{ $taskHistory['product_add_code'] }} </h4>

                                                                <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    data-bs-title="View"
                                                                    href="{{ route('client.joballocation.job_list_view', ['id' => encrypt($taskHistory['product_add'])]) }}">

                                                                    <i class="bi bi-eye"></i>

                                                                </a>
                                                            </div>

                                                            <ul id="timeline-3" class="timeline-3">
                                                                <li>

                                                                    <p>Service: {{ $taskHistory['service_name'] }}</p>
                                                                    <p>Brand: {{ $taskHistory['Brand'] }}</p>
                                                                    <p>Model: {{ $taskHistory['Model'] }}</p>
                                                                    <p>Name: {{ $taskHistory['Item_naame'] }}</p>
                                                                    <p>Status: {{ $taskHistory['Status'] }}</p>

                                                                </li>
                                                                @foreach ($taskHistory as $key => $value)
                                                                    @if (is_array($value) && $key !== 'product_add' && $key !== 'product_add_code' && $key !== 'service_name')
                                                                        <li>
                                                                            @php
                                                                                $subValueParts = explode(
                                                                                    '_next_',
                                                                                    $value['name'],
                                                                                );
                                                                                $lastPart = end($subValueParts);
                                                                            @endphp
                                                                            <div class="timeline-date">
                                                                                <div class="timeline_head">
                                                                                    {{ ucfirst(str_replace('_', ' ', $lastPart)) }}
                                                                                </div>
                                                                                <div class="timeline_head">
                                                                                    {{ $value['Date_Of_Schedule'] }}</div>
                                                                            </div>


                                                                            <div class="timeline-content">


                                                                                <p>Task Status:
                                                                                    {{ $value['task_name_status'] === 'New Task' ? 'Progress' : $value['task_name_status'] }}
                                                                                </p>

                                                                                <p>Assigned : {{ $value['assign_name'] }}
                                                                                </p>

                                                                                <p>Date Of Schedule:
                                                                                    {{ $value['Date_Of_Schedule'] }}</p>

                                                                                @if (isset($value['quotationValue_value_data']))
                                                                                    <p>Quotation Status:
                                                                                        {{ $value['quotationValue_value_data'] }}
                                                                                    </p>
                                                                                @endif
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- <div class="d-flex">
                                        {!! $client_latest->links() !!}
                                    </div> --}}
                                </div>


                            </div>

                        </div>
                    </div><!-- End Reports -->


                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">



                <div class="card" style="height: 475px; overflow-y: auto; scrollbar-width: 1px;">


                    <div class="card-body">
                        <h5 class="card-title">Product Review <span>| Latest</span></h5>


                        <div class="activity">



                            @foreach ($customer_reviews as $review1)
                                <div class="activity-item d-flex">
                                    <div class="activite-label"> {{ $review1->updated_at->format('H:i:s') }}
                                    </div>
                                    <i
                                        class="bi bi-circle-fill activity-badge {{ $review1->color_class }} align-self-start"></i>
                                    <div class="activity-content">
                                        @for ($i = 1; $i <= $review1->Product_reviews_star; $i++)
                                            {{-- <input type="radio" id="star{{$i}}" class="rate" name="rating"
                                            value="5" /> --}}
                                            <label class="star-rating-complete" title="text"><i
                                                    class="bi bi-star-fill"></i> </label>
                                        @endfor
                                        <br>{!! $review1->Type_service->service_name !!}
                                        <br>{!! $review1->product_task_rew->product_add->client_pdt->office !!}
                                        {{-- <br>{{ $review1->Product_reviews }} --}}


                                        {{-- {!! $review->Product_reviews_star !!} --}}

                                    </div>
                                </div><!-- End activity item-->
                            @endforeach
                        </div>

                    </div>
                </div>


               
                <!-- Website Traffic -->

                <!-- News & Updates Traffic -->

            </div><!-- End Right side columns -->

        </div>
    </section>
    <style>

    </style>
@endsection
