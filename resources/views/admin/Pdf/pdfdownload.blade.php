<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A4 Sheet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}

    <style>
        /* Define A4 size */
        @page {
            size: A4;
            margin: 0;
            page-break-after: always;
        }


        /* Define the layout for the sheet */
        body {
            margin: 0;
            padding: 0;
            background-color: #fff;
            /* Change as needed */
            font-family: Arial, sans-serif;
            /* Change as needed */
        }

        .pt-3 {
            padding-top: 1rem !important;
        }

        .card {
            border: 0px solid rgba(0, 0, 0, .125);
        }

        body {
            margin: 0;

            font-size: 1rem;
            font-weight: 400;

            color: #212529;

            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }

        .content {
            position: relative;
            /* Added: Set position to relative */
            width: 210mm;
            /* Width of A4 sheet */
            height: 297mm;
            /* Height of A4 sheet */
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

            /* Optional: Add shadow */
        }

        .header {
            height: 125px;
            position: relative;
            /* Added: Set position to relative */
        }

        .header_image {
            width: 210mm;
        }

        .header_image img {
            width: 210mm;
            height: 140px;
            object-fit: cover;
        }

        .header_logo {
            position: absolute;
            top: 10px;
            /* Adjust as needed */
            left: 20px;
            /* Adjust as needed*/
        }

        .header_logo img {
            width: 85mm;
            height: 85px;
        }

        .watermark {
            position: absolute;
            top: 50%;
            /* Place the watermark at 50% from the top */
            left: 50%;
            /* Place the watermark at 50% from the left */
            transform: translate(-50%, -50%);
            /* Center the watermark */
            opacity: 0.5;
            /* Adjust opacity as needed */
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;

            padding: 10px 0;
            text-align: center;
        }

        .footer img {
            width: 210mm;
            height: 200px;
            object-fit: cover;
        }




        table {
            width: 100%;
            border-collapse: collapse;

        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: left;
            width: 100%;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <div class="content ">

        <div class="header">
            <div class="header_image">
                <img class="header_image_top" src="{{ $base64Images['image0'] }}" alt="">
                <div class="header_logo">
                    <img src="{{ $base64Images['image1'] }}" alt="">
                </div>
            </div>
        </div>

        <section class="section pt-3" id="section_admin" style="padding: 0px 20px 0px 20px ;">
            <div class="row text-center">
                <div class="col-12 ">
                    <h2 class="card-title">Job Information</h2>
                </div>

            </div>
        </section>
        <section class="section " id="section_admin">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card_head">
                                    <div class="row">
                                        <div class="col-12">
                                            {{-- <h5 class="card-title">Job Information</h5> --}}
                                        </div>
                                    </div>
                                </div>
                                <section class="section" id="section_admin">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <div id="job_deatail_v1" class="bluck_add mb-4">
                                                    <div class="head-profie pt-3 pb-3">
                                                        <h5 class="card-title">Client Details</h5>
                                                    </div>
                                                    <table>

                                                        <tr>
                                                            <td>Office Name</td>
                                                            <td>{{ $data->client_pdt->office }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Location Name</td>
                                                            <td>{{ $data->client_pdt->location }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>{{ $data->client_pdt->users->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone Number</td>
                                                            <td>{{ $data->client_pdt->phonenumber }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-12 pt-5 pb-5">
                                                <div id="job_deatail_v2" class="bluck_add mb-4">
                                                    <div class="head-profie pt-3 pb-3">
                                                        <h5 class="card-title">Product Details</h5>
                                                    </div>
                                                    <table>

                                                        <tr>
                                                            <td>Product Code</td>
                                                            <td>{{ $data->product_code }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Serial Number</td>
                                                            <td>{{ $data->serial_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Brand Name</td>
                                                            <td>{{ $data->equip_pdt->Brand }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Model</td>
                                                            <td>{{ $data->equip_pdt->Model }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Product Name</td>
                                                            <td>{{ $data->equip_pdt->Item_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Warranty</td>
                                                            <td>{{ $data->warranty->warranty_type === '1' ? 'Yes' : 'No' }}
                                                            </td>
                                                        </tr>
                                                        @if ($data->warranty->warranty_type === '1')
                                                            @php
                                                                $endDate = \Carbon\Carbon::parse(
                                                                    $data->warranty->end_date,
                                                                );
                                                                $currentDate = \Carbon\Carbon::now();
                                                                $isWarrantyValid = $endDate->gte($currentDate);
                                                            @endphp
                                                            <tr>
                                                                <td>Warranty Current Status</td>
                                                                <td>{{ $isWarrantyValid ? 'Yes' : 'No' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Warranty Start Date</td>
                                                                <td>{{ $data->warranty->Start_date }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Warranty End Date</td>
                                                                <td>{{ $data->warranty->end_date }}</td>
                                                            </tr>
                                                        @endif
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>





        <div class="watermark">

            <img src="{{ $base64Images['image2'] }}" alt="">
        </div>

        <div class="footer">

            <img src="{{ $base64Images['image3'] }}" alt="">
        </div>
    </div>

    @php
        use Carbon\Carbon;

        // Flatten the array and sort it by 'date_time'
        $sortedArray = collect($taskHistoryArray)->flatten(1);

        $itemsPerPage = 2; // Default value
        if (isset($perPage) && is_numeric($perPage) && $perPage > 0) {
            $itemsPerPage = $perPage;
        }

        // Calculate the total number of pages
        $totalPages = ceil($sortedArray->count() / $itemsPerPage);

    @endphp

    @for ($page = 0; $page < $totalPages; $page++)
        <div class="content">
            <div class="header">
                <div class="header_image">
                    <img class="header_image_top" src="{{ $base64Images['image0'] }}" alt="">
                    <div class="header_logo">
                        <img src="{{ $base64Images['image1'] }}" alt="">
                    </div>
                </div>
            </div>

            @php
                // Slice the array to get sections for the current page
                $currentPageSections = $sortedArray->slice($page * 2, 2);
            @endphp
            <section class="section pt-1" id="section_admin" style="padding: 0px 20px 0px 20px ;">
                <div class="row text-center">
                    <div class="col-12 ">
                        <h2 class="card-title">Task History</h2>
                    </div>
                </div>
            </section>

            @foreach ($currentPageSections as $taskId => $data)
                <section class="section pt-1 pe-4 ps-5" id="section_admin" style="padding: 0px 20px 0px 20px ;">
                    <div class="bluck_add ">
                        <div class="head-profie">
                            @php

                                $name = explode('_next_', $data['name']);
                                $serviceName = end($name);
                            @endphp

                            <h5 class="card-title">
                                {{ ucfirst(str_replace('_', ' ', $serviceName)) }}</h5>

                        </div>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Services</td>
                                    <td>{{ $data['Services'] }}</td>
                                </tr>
                                @if ($data['assign'] === $data['user_id'])
                                    <tr>
                                        <td>Technician name</td>
                                        <td>{{ $data['user_name'] }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>Technician name</td>
                                        <td>[{{ $data['user_name'] }}] <span class="assign_to">Assign To</span>
                                            [{{ $data['assign_name'] }}]</td>
                                    </tr>
                                @endif
                                @if (!empty($data['Date_Of_Schedule']))
                                    <tr>
                                        <td>Date Of Schedule</td>
                                        <td>{{ $data['Date_Of_Schedule'] }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Date Of Action</td>
                                    <td>{{ $data['date'] }} {{ $data['time'] }}</td>
                                </tr>
                                @if (!empty($data['Remarks']))
                                    <tr>
                                        <td>Remarks</td>
                                        <td>{{ $data['Remarks'] }}</td>
                                    </tr>
                                @endif
                                @if (!empty($data['signatures_data']))
                                    <tr>
                                        <td>Signature person</td>
                                        <td> {{ $data['signatures_data']->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Postion</td>
                                        <td> {{ $data['signatures_data']->postion }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td> {{ $data['signatures_data']->email_id_sign }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone no:</td>
                                        <td> {{ $data['signatures_data']->phone_sign }}</td>
                                    </tr>
                                    <tr>
                                        <td>Signature</td>
                                        <td><img src="{{ $data['signatures_data']->signature_data }}" width="150px"
                                                height="40px" /></td>
                                    </tr>
                                @endif

                                @if (!empty($data['aproval_waiting']))
                                    <tr>
                                        <td>Reference Number</td>
                                        <td>{{ $data['aproval_waiting']->Refrence_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>Start Date</td>
                                        <td>{{ $data['aproval_waiting']->date_start }}</td>
                                    </tr>

                                    @if (!empty($data['aproval_waiting']->date_end))
                                        <tr>
                                            <td>End date</td>
                                            <td>{{ $data['aproval_waiting']->date_end }}</td>
                                        </tr>

                                        <tr>
                                            <td>Toatal Date Approval</td>
                                            <td> {{ \Carbon\Carbon::parse($data['aproval_waiting']->date_start)->diffInDays(
                                                \Carbon\Carbon::parse($data['aproval_waiting']->date_end),
                                            ) }}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>Status</td>
                                            <td>Waiting For Approval</td>
                                        </tr>
                                    @endif
                                @endif



                            </tbody>
                        </table>
                    </div>
                </section>
            @endforeach

            <div class="watermark">
                <img src="{{ $base64Images['image2'] }}" alt="">
            </div>

            <div class="footer">
                <img src="{{ $base64Images['image3'] }}" alt="">
            </div>
        </div>

        @if ($page < $totalPages - 1)
            <!-- Add a page break if there are more pages -->
            <div style="page-break-after: always;"></div>
        @endif
    @endfor

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
