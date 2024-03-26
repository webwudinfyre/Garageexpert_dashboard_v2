<div>



    <section class="section dashboard">

        <div class="row">

            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card text-center">



                    <div class="card-body ">
                        <a href="{{ route('admin.joballocation.job_list_each_task', ['id' => $data_id1['New Task']]) }}">
                            <h5 class="card-title">New Task </h5>

                            <div class=" d-flex text-center align-items-center justify-content-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
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
                                    <i class="bi bi-cart"></i>
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
                        <a
                            href="{{ route('admin.joballocation.job_list_each_task', ['id' => $data_id1['Completed']]) }}">
                            <h5 class="card-title">Completed Task</h5>

                            <div class=" d-flex text-center align-items-center justify-content-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
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
                        <a
                            href="{{ route('admin.joballocation.job_list_each_task', ['id' => $data_id1['Quotation']]) }}">
                            <h5 class="card-title">Quotation</h5>

                            <div class=" d-flex text-center align-items-center justify-content-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $taskCount['Quotation'] }}</h6>


                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </section>
</div>
