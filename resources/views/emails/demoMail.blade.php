{{--
<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>

    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download"
    href="{{ route('mail.job_pdf_dowmload_mail', ['id' => encrypt(13)]) }}"
    onclick="showModal()">
    111111
    <button type="button" class="btn">


        <i class="bi bi-download"></i></i>
    </button>
</a>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    <p>Thank you</p>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mailData['title'] }}</title>
    <style>
        /* Styles for email layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 18px;
            margin-bottom: 10px;
            text-align: center;
        }

        .card-content {
            font-size: 14px;
            color: #666666;
            text-align: center;
        }

        .download-status {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .grid-cat {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px; /* Increased gap for better spacing */
        }

        .grid-item {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
        }

        .table-container {
            overflow-x: auto; /* Enable horizontal scroll if table is wider */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td, table th {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }

        .under_line {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .job_detail_v3 {
            font-weight: bold;
        }
        .btn {
        display: inline-block;
        padding: 4px 4px;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        color: #ffffff;
        background-color: #ff530a; /* Primary color, change as needed */
        border: none;
        border-radius: 4px;
        cursor: pointer;

        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #ff530a; /* Darker shade of primary color on hover */
    }

    /* Bootstrap Icon Styling */
    .bi {
        vertical-align: text-bottom; /* Align icon vertically with text */
        margin-right: 8px; /* Add space between icon and text */
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="{{ $message->embed(public_path('admin/assets/img/Asset_6@4x.png')) }}" alt="Logo" style="max-width: 300px">
        </div>

        <div class="card">
            <h2 class="card-title">Product Details</h2>
            <div class="grid-cat">
                <div class="grid-item">
                    <div class="table-container">
                        <table>

                            <tr>
                                <td><strong>Product Code</strong></td>
                                <td>{{ $mailData['data']->product_code }}</td>
                            </tr>
                            <tr>
                                <td><strong>Serial Number</strong></td>
                                <td>{{ $mailData['data']->serial_number ?: 'Not available' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Brand Name</strong></td>
                                <td>{{ $mailData['data']->equip_pdt->Brand }}</td>
                            </tr>
                            <tr>
                                <td><strong>Model</strong></td>
                                <td>{{ $mailData['data']->equip_pdt->Model }}</td>
                            </tr>
                            <tr>
                                <td><strong>Product Name</strong></td>
                                <td>{{ $mailData['data']->equip_pdt->Item_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Warranty</strong></td>
                                <td>{{ $mailData['data']->warranty->warranty_type === '1' ? 'Yes' : 'No' }}</td>
                            </tr>
                            @if ($mailData['data']->warranty->warranty_type === '1')
                                <tr>
                                    <td><strong>Warranty Current Status</strong></td>
                                    @php
                                        $endDate = \Carbon\Carbon::parse($mailData['data']->warranty->end_date);
                                        $currentDate = \Carbon\Carbon::now();
                                        $isWarrantyValid = $endDate->gte($currentDate);
                                    @endphp
                                    <td>{{ $isWarrantyValid ? 'Active' : 'Expired' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Warranty Start Date</strong></td>
                                    <td>{{ $mailData['data']->warranty->Start_date }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Warranty End Date</strong></td>
                                    <td>{{ $mailData['data']->warranty->end_date }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
                <h1></h1>


                <div class="card">
                    {{-- <h2>Task History Details</h2>222 --}}
                    <h1>{{ $mailData['taskHistory_detail']['ServiceName'] }}</h1>


                    <div class="grid-cat">
                        <div class="grid-item">
                            <div class="table-container">
                                <table>

                                    <tr>
                                        <td><strong>Services</strong></td>
                                        <td>{{ $mailData['taskHistory_detail']['ServiceName'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Technician name</strong></td>
                                        <td>{{ $mailData['taskHistory_detail']['user_id'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date Of Action </strong></td>
                                        <td>{{ $mailData['taskHistory_detail']['date_time'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>QuotationValue Details</strong></td>
                                        <td>{{ $mailData['taskHistory_detail']['quotationValue_name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Remarks </strong></td>
                                        <td>{{ $mailData['taskHistory_detail']['Remarks'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Signature person </strong></td>
                                        <td>{{ $mailData['taskHistory_detail']['signatures_data']['name'] }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>Postion </strong></td>
                                        <td>{{ $mailData['taskHistory_detail']['signatures_data']['postion'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email </strong></td>
                                        <td>{{ $mailData['taskHistory_detail']['signatures_data']['email_id_sign'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone no: </strong></td>
                                        <td>{{ $mailData['taskHistory_detail']['signatures_data']['phone_sign'] }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td><strong>Signature </strong></td>
                                        {{ $mailData['taskHistory_detail']['signatures_data']['signature_data'] }}
                                        <td><img src="{{ $mailData['taskHistory_detail']['signatures_data']['signature_data'] }}" width="150px"
                                            height="40px" /></td>

                                    </tr> --}}

                                </table>
                            </div>
                        </div>


                <div class="grid-item">
                    <p class="card-content">

                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download"
                           href="{{ route('mail.job_pdf_dowmload_mail', ['id' => encrypt( $mailData['data']->product_id)]) }}"
                           onclick="showModal()">
                            <button type="button" class="btn">
                                <i class="bi bi-download"> Click to download full details</i>
                            </button>
                        </a>
                    </p>
                    <p class="card-content">

                    </p>
                </div>
            </div>

        </div>

    </div>
</body>

</html>

