






<div>
<style>
.suboffice
{
    /* border: 1px solid rgb(214, 214, 214); */
}
</style>
   <section class="section dashboard">

            <div class="row">

                <div class="col-xxl-3 col-md-6">
                    <div class="{{ $admin==='suboffice' ? 'suboffice': 'card  '}} info-card sales-card text-center">


                        <div class="card-body ">
                            {{-- @if ($admin === 'tech')
                                <a
                                    href="{{ route('tech.joballocation.myjob_list_each_task', ['id' => $data_id1['New Task']]) }}">
                            @endif --}}


                            <h5 class="card-title">New Task</h5>
                            <div class=" d-flex text-center align-items-center justify-content-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <img class="icons_svg" src="{{ asset('admin/assets/img/New_task.svg') }}">
                                </div>




                                <div class="ps-3">
                                    <h6>{{ isset($taskCounts['1']) ? $taskCounts['1'] : 0 }}</h6>
                                </div>
                            </div>
                            {{-- @if ($admin === 'tech')
                                </a>
                            @endif --}}
                        </div>

                    </div>
                </div>






                <div class="col-xxl-3 col-md-6">
                    <div class="{{ $admin==='suboffice' ? 'suboffice': 'card  '}} info-card sales-card text-center">



                        <div class="card-body ">

                            {{-- @if ($admin === 'tech')
                                <a
                                    href="{{ route('tech.joballocation.myjob_list_each_task', ['id' => $data_id1['Pending']]) }}">
                            @endif --}}

                            <h5 class="card-title">Pending Task</h5>

                            <div class=" d-flex text-center align-items-center justify-content-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <img class="icons_svg" src="{{ asset('admin/assets/img/Pending_task.svg') }}">
                                </div>
                                <div class="ps-3">

                                    <h6>{{ isset($taskCounts['2']) ? $taskCounts['2'] : 0 }}</h6>


                                </div>
                            </div>
                            {{-- @if ($admin === 'tech')
                                </a>
                            @endif --}}

                        </div>

                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="{{ $admin==='suboffice' ? 'suboffice': 'card  '}} info-card sales-card text-center">



                        <div class="card-body ">
                            {{-- @if ($admin === 'tech')
                                <a
                                    href="{{ route('tech.joballocation.myjob_list_each_task', ['id' => $data_id1['Completed']]) }}">
                            @endif --}}

                            <h5 class="card-title">Completed Task</h5>

                            <div class=" d-flex text-center align-items-center justify-content-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <img class="icons_svg" src="{{ asset('admin/assets/img/Completed_task.svg') }}">
                                </div>
                                <div class="ps-3">

                                    <h6>{{ isset($taskCounts['4']) ? $taskCounts['4'] : 0 }}</h6>


                                </div>
                            </div>
                            {{-- @if ($admin === 'tech')
                                </a>
                            @endif --}}
                        </div>

                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="{{ $admin==='suboffice' ? 'suboffice': 'card  '}} info-card sales-card text-center">



                        <div class="card-body ">
                            {{-- @if ($admin === 'tech')
                                <a
                                    href="{{ route('tech.joballocation.myjob_list_each_task', ['id' => $data_id1['Quotation']]) }}">
                            @endif --}}

                            <h5 class="card-title">Approval Waiting</h5>

                            <div class=" d-flex text-center align-items-center justify-content-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <img class="icons_svg" src="{{ asset('admin/assets/img/Asign to other.svg') }}">
                                </div>
                                <div class="ps-3">

                                    <h6>{{ isset($taskCounts['6']) ? $taskCounts['6'] : 0 }}</h6>


                                </div>
                            </div>
                            {{-- @if ($admin === 'tech')
                                </a>
                            @endif --}}
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </div>




