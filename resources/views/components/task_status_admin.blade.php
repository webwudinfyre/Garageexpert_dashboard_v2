<section class="section dashboard p-2 ">



    <div class="regular slider">


        <div class="col-xxl-3 col-md-6">
            <div class="card info-card sales-card text-center">



                <div class="card-body ">
                    <a href="{{ route('admin.joballocation.job_list_each_task', ['id' => $data_id1['New Task']]) }}">
                        <h5 class="card-title">New Task </h5>

                        <div class=" d-flex text-center align-items-center justify-content-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <img class="icons_svg" src="{{ asset('admin/assets/img/New_task.svg') }}">
                            </div>
                            <div class="ps-3">
                                <h6>{{ $taskCount['New Task'] }}</h6>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>



        <div class="col-xxl-3 col-md-6">
            <div class="card info-card sales-card text-center">



                <div class="card-body ">
                    <a href="{{ route('admin.joballocation.job_list_each_task', ['id' => $data_id1['Pending']]) }}">
                        <h5 class="card-title">Pending Task</h5>

                        <div class=" d-flex text-center align-items-center justify-content-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <img class="icons_svg" src="{{ asset('admin/assets/img/Pending_task.svg') }}">
                            </div>
                            <div class="ps-3">
                                <h6>{{ $taskCount['Pending'] }}</h6>


                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>


        <div class="col-xxl-3 col-md-6">
            <div class="card info-card sales-card text-center">



                <div class="card-body ">
                    <a href="{{ route('admin.joballocation.job_list_each_task', ['id' => $data_id1['Completed']]) }}">
                        <h5 class="card-title">Completed Task</h5>

                        <div class=" d-flex text-center align-items-center justify-content-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                                <img class="icons_svg" src="{{ asset('admin/assets/img/Completed_task.svg') }}">
                            </div>
                            <div class="ps-3">
                                <h6>{{ $taskCount['Completed'] }}</h6>


                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>



        <div class="col-xxl-3 col-md-6">
            <div class="card info-card sales-card text-center">



                <div class="card-body ">
                    <a href="{{ route('admin.joballocation.job_list_each_task', ['id' => $data_id1['Quotation']]) }}">
                        <h5 class="card-title">Quotation </h5>

                        <div class=" d-flex text-center align-items-center justify-content-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <img class="icons_svg" src="{{ asset('admin/assets/img/Asign to other.svg') }}">
                            </div>
                            <div class="ps-3">
                                <h6>{{ $taskCount['Quotation'] }}</h6>


                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>




        <div class="col-xxl-3 col-md-6">
            <div class="card info-card sales-card text-center">



                <div class="card-body ">
                    <a href="{{ route('admin.joballocation.job_list_each_task', ['id' => $data_id1['Waiting Approve']]) }}">
                        <h5 class="card-title">Waiting Approve</h5>

                        <div class=" d-flex text-center align-items-center justify-content-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <img class="icons_svg" src="{{ asset('admin/assets/img/Approval_waiting.svg') }}">
                            </div>
                            <div class="ps-3">
                                <h6>{{ $taskCount['Waiting Approve'] }}</h6>


                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>



    </div>





</section>



@push('scripts')
<script type="text/javascript">
    $(document).on('ready', function() {

            $(".regular").slick({
                dots: true,
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4,

                autoplay: true,
                autoplaySpeed: 2000,
                adaptiveHeight: true,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 920,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }

                ]
            });

        });
</script>
@endpush

{{--
<section class=""> --}}
    {{-- <div>
        1
    </div>
    <div>
        2
    </div>
    <div>
        3
    </div>
    <div>
        4
    </div>
    <div>
        5
    </div>

</section> --}}
