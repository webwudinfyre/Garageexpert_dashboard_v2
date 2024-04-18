@extends('client.layouts.master')

@section('contents')
<style>






        .rated:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rated:not(:checked)>label {


            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;

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
                                    <h5 class="card-title">Review Detail</h5>
                                </div>

                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table id="admin_table" class="table datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>sl.no</th>

                                        <th>Product Deatils</th>
                                        <th>Service</th>
                                        <th>Product Review</th>
                                        <th>Technician Review</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($customer_reviews as $prdt_task)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="width: 30%">
                                                <ul>
                                                    <li>Product Code
                                                        :{{ $prdt_task->product_task_rew->product_add->product_code }}</li>

                                                    <li>Brand
                                                        :{{ $prdt_task->product_task_rew->product_add->equip_pdt->Brand }}
                                                    </li>
                                                    <li>Model
                                                        :{{ $prdt_task->product_task_rew->product_add->equip_pdt->Model }}
                                                    </li>
                                                    <li>Item name
                                                        :{{ $prdt_task->product_task_rew->product_add->equip_pdt->Item_name }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>{{ $prdt_task->type_service->service_name }}</td>
                                            <td>
                                                <ul>
                                                    <li>Star Rating :

                                                            @for ($i = 1; $i <= $prdt_task->Product_reviews_star; $i++)
                                                                {{-- <input type="radio" id="star{{$i}}" class="rate" name="rating" value="5"/> --}}
                                                                <label class="star-rating-complete"
                                                                    title="text"><i class="bi bi-star-fill"></i> </label>
                                                            @endfor

                                                    </li>
                                                    <li>Review :{{ $prdt_task->Product_reviews }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>Star Rating :
                                                        @for ($i = 1; $i <= $prdt_task->tech_reviews_star; $i++)
                                                        {{-- <input type="radio" id="star{{$i}}" class="rate" name="rating" value="5"/> --}}
                                                        <label class="star-rating-complete"
                                                            title="text"><i class="bi bi-star-fill"></i> </label>
                                                    @endfor
                                                    </li>
                                                    <li>Review :{{ $prdt_task->tech_reviews }}
                                                    </li>
                                                </ul>
                                            </td>


                                            <td>
                                                <div class="action_icon ">
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"
                                                        href="{{ route('client.client.client_review_edit', ['id' => encrypt($prdt_task->id)]) }}">
                                                        <button type="button" class="btn">
                                                            <i class="bi bi-pencil-square"></i>
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
