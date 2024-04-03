<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A4 Sheet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{--
    <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}

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
            padding: 25px;
            height: 125px;
            position: relative;
            /* Added: Set position to relative */
        }

        .header_image {
            width: 100%;
        }

        .header_image img {
            width: 100%;

            object-fit: cover;
        }

        .header_logo {
            position: absolute;
            top: 10px;
            /* Adjust as needed */
            left: 20px;
            /* Adjust as needed*/
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
            border-top: 1px solid #ccc;
            padding: 10px 0;

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

        .footer td {
            border: 0px solid #ccc;
      padding: 5px;

             width: 100%;
        }

        .header_image {
            text-align: center;
        }

        .header_image img {
            width: 75%;
            object-fit: cover;
        }

        .remarks {
            border: 1px solid #ccc;
            height: 150px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="content ">

        <div class="header">
            <div class="header_image">
                <img class="header_image_top" src="{{ $base64Images['image0'] }}" alt="">

            </div>
        </div>

        <section class="section pt-3" id="section_admin" style="padding: 0px 0px 0px 0px ;">
            <div class="row text-center">
                <div class="col-12 ">
                    <h4 class="card-title" style="text-decoration: underline;">Installation/ Services Report</h4>

                </div>

            </div>
        </section>

        <section class="section " id="section_admin">
            <div class="container">
                <div class="row" style="padding:0px 15px 0px 15px ">
                    <div class="col-lg-12">

                        <p>Sl No: {{ $prdt_task->product_add->product_code }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section " id="section_admin" style="padding: 20px 0px 20px 0px">
            <div class="container">
                <div class="row" style="padding:0px 15px 0px 15px ">
                    <div class="col-lg-12">
                        <table>
                            <tr>
                                <td>
                                    <span class="left_heading">Office Name :</span>
                                    <span class="left_answer">{{ $prdt_task->product_add->client_pdt->office }} </span>

                                </td>
                                <td>
                                    <span class="left_heading">Location :</span>
                                    <span class="left_answer">{{ $prdt_task->product_add->client_pdt->location }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="left_heading">Product Code :</span>
                                    <span class="left_answer"> {{ $prdt_task->product_add->product_code }}</span>

                                </td>
                                <td>
                                    <span class="left_heading">Serial No :</span>
                                    <span class="left_answer"> {{ $prdt_task->product_add->serial_number }} </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="left_heading">Equipment :</span>
                                    <span class="left_answer">{{ $prdt_task->product_add->equip_pdt->Item_name }}
                                    </span>

                                </td>
                                <td>
                                    <span class="left_heading">Brand :</span>
                                    <span class="left_answer">{{ $prdt_task->product_add->equip_pdt->Brand }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="left_heading">Modal :</span>
                                    <span class="left_answer">{{ $prdt_task->product_add->equip_pdt->Model }}</span>

                                </td>
                                <td>
                                    @php
                                    $endDate = \Carbon\Carbon::parse(
                                    $prdt_task->product_add->warranty->end_date,
                                    );
                                    $currentDate = \Carbon\Carbon::now();
                                    $isWarrantyValid = $endDate->gte($currentDate);
                                    @endphp
                                    <span class="left_heading">Warranty Status :</span>
                                    <span class="left_answer">{{ $isWarrantyValid ? 'Yes' : 'No' }} </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="left_heading">Warranty Start date :</span>
                                    <span class="left_answer">{{ $prdt_task->product_add->warranty->Start_date }}
                                    </span>

                                </td>
                                <td>
                                    <span class="left_heading">Warranty End date :</span>
                                    <span class="left_answer">{{ $prdt_task->product_add->warranty->end_date }} </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="left_heading">Service Type :</span>
                                    <span class="left_answer"> {{  $prdt_task->type_service->service_name }}</span>

                                </td>
                                <td>
                                    <span class="left_heading">Date :</span>
                                    <span class="left_answer"> {{ $prdt_task->updated_at }} </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section class="section " id="section_admin" style="padding: 20px 0px 20px 0px">
            <div class="container">
                <div class="row" style="padding:0px 15px 0px 15px ">
                    <div class="col-lg-12">
                        <table>
                            <h6>
                                Findings/Diagnosist/Installation Remarks
                            </h6>
                            <tr>
                                <div class="remarks">
                                    <div class="remk" style="padding: 10px 10px 10px 10px">
                                        {{ $prdt_task->Reamarks }}
                                    </div>


                                </div>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section class="section " id="section_admin" style="padding: 20px 0px 20px 0px">
            <div class="container">
                <div class="row" style="padding:0px 15px 0px 15px ">
                    <div class="col-lg-12">
                        <table>
                            <h6>
                                Client Details
                            </h6>
                            <tr>
                            <tr>
                                <td>
                                    <span class="left_heading">Name :</span>
                                    <span class="left_answer"> {{ $client_signatures->name }}</span>

                                </td>
                                <td>
                                    <span class="left_heading">Postion :</span>
                                    <span class="left_answer">{{ $client_signatures->postion }} </span>
                                </td>
                            </tr>
                            </tr>
                            <tr>
                            <tr>
                                <td>
                                    <span class="left_heading">Email Id:</span>
                                    <span class="left_answer">{{ $client_signatures->email_id_sign }} </span>

                                </td>
                                <td>
                                    <span class="left_heading">Phone Number :</span>
                                    <span class="left_answer"> {{ $client_signatures->phone_sign }}</span>
                                </td>
                            </tr>
                            </tr>
                            <tr>
                            <tr>
                                <td>


                                </td>
                                <td>
                                    <div class="Signature_pad">
                                        <span class="left_heading">Signature :</span>
                                        <span class="left_answer"><img src="{{$client_signatures->signature_data }}" width="150px"
                                            height="40px" /> </span>
                                    </div>

                                </td>
                            </tr>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </section>
        {{-- <section class="section " id="section_admin" style="padding: 20px 0px 20px 0px">
            <div class="container">
                <div class="row" style="padding:0px 15px 0px 15px ">
                    <div class="col-lg-12">
                        <table>
                            <h6>
                                Technician Name
                            </h6>
                            <tr>
                            <tr>
                                <td>
                                    <span class="left_heading">Name :</span>
                                    <span class="left_answer">{{$prdt_task->users_pdt->name }} </span>

                                </td>
                                <td>
                                    <span class="left_heading">Email Id:</span>
                                    <span class="left_answer">{{$prdt_task->users_pdt->email }}  </span>

                                </td>
                            </tr>
                            </tr>


                            <tr>
                                <td>


                                </td>
                                <td>
                                    <div class="Signature_pad">
                                        <span class="left_heading">Signature :</span>
                                        <span class="left_answer"> <img src="{{$prdt_task->users_pdt->signature_data }}" width="150px"
                                            height="40px" /></span>
                                    </div>

                                </td>
                            </tr>


                        </table>
                    </div>
                </div>
            </div>
        </section> --}}





        <div class="watermark">

            <img src="{{ $base64Images['image2'] }}" alt="">
        </div>

        <div class="footer">
            <section class="section " id="section_admin" style="padding: 00px 0px 00px 0px">
                <div class="container">
                    <div class="row" style="padding:0px 15px 0px 15px ">
                        <div class="col-lg-12">
                            <table>

                                <tr>
                                <tr>
                                    <td>
                                        <p> <span class="left_heading_footer">Address : Deira</span></p>
                                        <p> <span class="left_answer_footer">Dubai </span></p>
                                        <p><span class="left_answer_footer">United Arab Emirates</span></p>

                                    </td>
                                    <td style="text-align: right">
                                        <p> <span class="left_heading_footer">Phone :+971 52 326 3270</span></p>
                                        <p> <span class="left_answer_footer">Email :support@garagexpert.com </span></p>
                                        <p><span class="left_answer_footer">Web : www.garagexpert</span></p>


                                    </td>
                                </tr>
                                </tr>





                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- @php
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

    @for ($page = 0; $page < $totalPages; $page++) <div class="content">
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
                        <tr>
                            <td>Date Of Schedule</td>
                            <td>{{ $data['Date_Of_Schedule'] }}</td>
                        </tr>
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
                            <td><img src="{{ $data['signatures_data']->signature_data }}" width="150px" height="40px" />
                            </td>
                        </tr>
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

        @if ($page < $totalPages - 1) <!-- Add a page break if there are more pages -->
            <div style="page-break-after: always;"></div>
            @endif
            @endfor --}}

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous">
            </script>
</body>

</html>
