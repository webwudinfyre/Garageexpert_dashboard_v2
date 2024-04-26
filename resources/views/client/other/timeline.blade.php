@extends('client.layouts.master')

@section('contents')
    <style>
        #timeline-3 {
            height: 400px !important;

        }

        .timeline_links {}

        .active>.page-link,
        .page-link.active {
            z-index: 1;
            color: #dee2e6;
            background-color: #ff530a;
            border-color: #dee2e6;
        }

        .timeline_links.d-flex {
            display: flex;
            justify-content: flex-end;
        }

        .page-link {
            position: relative;
            display: block;

            color: #ff530a;
        }

        .page-link:hover {
            z-index: 2;
            color: #ff530a;
            background-color: var(--bs-pagination-hover-bg);
            border-color: var(--bs-pagination-hover-border-color);
        }
    </style>

    <section class="pagetitle_sec">
        <div id="pagetitle" class="pagetitle">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-8  align-items-center ">
                    <h1>Tracking Details </h1>
                    <nav>
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="{{ route('client.dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Tracking
                                Details</li>
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
                        <h5 class="card-title">Tracking <span>| List</span></h5>

                        <div id="timeline-container" class="timeline-container">
                            <div id="timeline" class="timeline">
                                <div class="row">
                                    @foreach ($taskHistoryArray as $taskId => $taskHistory)
                                        <div class="col-lg-4 col-md-6 mb-4">
                                            <div class="">
                                                <div class="card-body">
                                                    <div class="timeline_card_head">
                                                        <h4 class="card-title">Code : {{ $taskHistory['product_add_code'] }}
                                                        </h4>

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

                                                                        <p>Assigned : {{ $value['assign_name'] }}</p>

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

                            <div class="timeline_links d-flex">
                                {!! $client_latest->links() !!}
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
