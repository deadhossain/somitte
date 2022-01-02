@extends('backends.pages.main')
@section('main-body')
<div class="row">

    <div class="col-lg-6 col-xl-3 col-md-6">
        <div class="card rounded-card user-card">
            <div class="card-block">
                <div class="img-hover">
                    {{-- <img style="width: 280px;height: 300px;margin: auto;" src="{{$customer->image_path}}" alt="customer-default-pic" class="img-thumbnail image-preview"> --}}
                    <img class="img-fluid img-radius" src="{{$customer->image_path}}" alt="customer-default-pic" style="height: 170px">
                    {{-- <div class="img-overlay img-radius">
                        <span>
                            <a href="#" class="btn btn-sm btn-primary" data-popup="lightbox"><i class="icofont icofont-plus"></i></a>
                            <a href="" class="btn btn-sm btn-primary"><i class="icofont icofont-link-alt"></i></a>
                        </span>
                    </div> --}}
                </div>
                <div class="user-content">
                    <h4 class="">{{$customer->name}}</h4>
                    <p class="m-b-0 text-muted">{{$customer->customer_uid}}</p>
                    <p class="m-b-0 text-muted">{{$customer->phone}}</p>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xl-9 col-md-6">
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                                <h4 class="text-white">$30200</h4>
                                <h6 class="text-white m-b-0">Total Savings Amount</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">Savings Account</p>
                            </div>
                            <div class="col-3 text-right">
                                <p class="text-white m-b-0">302</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                                <h4 class="text-white">$0</h4>
                                <h6 class="text-white m-b-0">With Draw</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">Times</p>
                            </div>
                            <div class="col-3 text-right">
                                <p class="text-white m-b-0">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                                <h4 class="text-white">$30200</h4>
                                <h6 class="text-white m-b-0">Balance</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">Active Savings Account</p>
                            </div>
                            <div class="col-3 text-right">
                                <p class="text-white m-b-0">302</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                                <h4 class="text-white">$30200</h4>
                                <h6 class="text-white m-b-0">Loan Amount</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">Loan Account</p>
                            </div>
                            <div class="col-3 text-right">
                                <p class="text-white m-b-0">302</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                                <h4 class="text-white">$30200</h4>
                                <h6 class="text-white m-b-0">Paid Loan Amount</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">Loan Account</p>
                            </div>
                            <div class="col-3 text-right">
                                <p class="text-white m-b-0">302</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-yellow update-card">
                    <div class="card-block">
                        <div class="row align-items-end">
                            <div class="col-8">
                                <h4 class="text-white">$30200</h4>
                                <h6 class="text-white m-b-0">Remaining Loan </h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">Loan Account</p>
                            </div>
                            <div class="col-3 text-right">
                                <p class="text-white m-b-0">302</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<div class="row">
    <div class="col-lg-12">
        <!-- tab header start -->
        <div class="tab-header card">
            <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#contacts" role="tab">Savings Account</a>
                    <div class="slide"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#review" role="tab">Loan Account</a>
                    <div class="slide"></div>
                </li>
            </ul>
        </div>
        <!-- tab header end -->
        <!-- tab content start -->
        <div class="tab-content">
            <!-- tab pane contact start -->
            <div class="tab-pane active" id="contacts" role="tabpanel">
                <div class="row">
                    <div class="col-xl-3">
                        <!-- user contact card left side start -->
                        <div class="card">
                            <div class="card-header contact-user">
                                <h5 class="m-l-10">Account List</h5>
                            </div>
                            <div class="card-block">
                                <ul class="list-group list-contacts">
                                    @foreach ($customer->savingsAccounts as $savingsAccount)
                                        <li class="list-group-item">
                                            <a href="#">{{$savingsAccount->account_no}}</a>
                                            <span class="badge badge-info badge-pill pull-right">30</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- user contact card left side end -->
                    </div>
                    <div class="col-xl-9">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- contact data table card start -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Deposit History</h5>
                                    </div>
                                    <div class="card-block contact-details">
                                        <div class="data_table_main table-responsive dt-responsive">
                                            <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>SChedule Date</th>
                                                        <th>Deposit Date</th>
                                                        <th>Deposit Amount</th>
                                                        <th>Late Fee</th>
                                                        {{-- <th>Status</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $sl = 0; @endphp
                                                    @foreach ($savingsAccount->activeSavingsDeposits as $savingsDeposits)
                                                        <tr>
                                                            <td> {{++$sl}} </td>
                                                            <td> {{showDateFormat($savingsDeposits->schedule_date)}} </td>
                                                            <td> {{showDateFormat($savingsDeposits->deposit_date)}} </td>
                                                            <td> {{$savingsDeposits->deposit_amount}} </td>
                                                            <td> {{$savingsDeposits->late_fee}} </td>
                                                            {{-- <td> {!! $user->status !!} </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- contact data table card end -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- contact data table card start -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-header-text">Deposit History</h5>
                                    </div>
                                    <div class="card-block contact-details">
                                        <div class="data_table_main table-responsive dt-responsive">
                                            <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Total Savings Amount</th>
                                                        <th>Rate</th>
                                                        <th>Total WithDraw Amount</th>
                                                        <th>Total Late Fee</th>
Total Withdraw amount - 5000
Total Late fee - 0
Remaining Saving amount - 10000
                                                        <th>Deposit Date</th>
                                                        <th>Deposit Amount</th>
                                                        <th>Late Fee</th>
                                                        {{-- <th>Status</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $sl = 0; @endphp
                                                    @foreach ($savingsAccount->activeSavingsDeposits as $savingsDeposits)
                                                        <tr>
                                                            <td> {{++$sl}} </td>
                                                            <td> {{showDateFormat($savingsDeposits->schedule_date)}} </td>
                                                            <td> {{showDateFormat($savingsDeposits->deposit_date)}} </td>
                                                            <td> {{$savingsDeposits->deposit_amount}} </td>
                                                            <td> {{$savingsDeposits->late_fee}} </td>
                                                            {{-- <td> {!! $user->status !!} </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- contact data table card end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- tab pane contact end -->
            <div class="tab-pane" id="review" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text">Review</h5>
                    </div>
                    <div class="card-block">
                        <ul class="media-list">
                            <li class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object img-radius comment-img" src="..\files\assets\images\avatar-1.jpg" alt="Generic placeholder image">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h6 class="media-heading">Sortino media<span class="f-12 text-muted m-l-5">Just now</span></h6>
                                    <div class="stars-example-css review-star">
                                        <i class="icofont icofont-star"></i>
                                        <i class="icofont icofont-star"></i>
                                        <i class="icofont icofont-star"></i>
                                        <i class="icofont icofont-star"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                    <div class="m-b-25">
                                        <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
                                    </div>
                                    <hr>
                                    <!-- Nested media object -->
                                    <div class="media mt-2">
                                        <a class="media-left" href="#">
                                            <img class="media-object img-radius comment-img" src="..\files\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                        </a>
                                        <div class="media-body">
                                            <h6 class="media-heading">Larry heading <span class="f-12 text-muted m-l-5">Just now</span></h6>
                                            <div class="stars-example-css review-star">
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                            </div>
                                            <p class="m-b-0"> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                            <div class="m-b-25">
                                                <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
                                            </div>
                                            <hr>
                                            <!-- Nested media object -->
                                            <div class="media mt-2">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object img-radius comment-img" src="..\files\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">Colleen Hurst <span class="f-12 text-muted m-l-5">Just now</span></h6>
                                                    <div class="stars-example-css review-star">
                                                        <i class="icofont icofont-star"></i>
                                                        <i class="icofont icofont-star"></i>
                                                        <i class="icofont icofont-star"></i>
                                                        <i class="icofont icofont-star"></i>
                                                        <i class="icofont icofont-star"></i>
                                                    </div>
                                                    <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                    <div class="m-b-25">
                                                        <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Nested media object -->
                                    <div class="media mt-2">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object img-radius comment-img" src="..\files\assets\images\avatar-1.jpg" alt="Generic placeholder image">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Cedric Kelly<span class="f-12 text-muted m-l-5">Just now</span></h6>
                                            <div class="stars-example-css review-star">
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                            </div>
                                            <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                            <div class="m-b-25">
                                                <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="media mt-2">
                                        <a class="media-left" href="#">
                                            <img class="media-object img-radius comment-img" src="..\files\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                        </a>
                                        <div class="media-body">
                                            <h6 class="media-heading">Larry heading <span class="f-12 text-muted m-l-5">Just now</span></h6>
                                            <div class="stars-example-css review-star">
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                            </div>
                                            <p class="m-b-0"> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                            <div class="m-b-25">
                                                <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
                                            </div>
                                            <hr>
                                            <!-- Nested media object -->
                                            <div class="media mt-2">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object img-radius comment-img" src="..\files\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">Colleen Hurst <span class="f-12 text-muted m-l-5">Just now</span></h6>
                                                    <div class="stars-example-css review-star">
                                                        <i class="icofont icofont-star"></i>
                                                        <i class="icofont icofont-star"></i>
                                                        <i class="icofont icofont-star"></i>
                                                        <i class="icofont icofont-star"></i>
                                                        <i class="icofont icofont-star"></i>
                                                    </div>
                                                    <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                    <div class="m-b-25">
                                                        <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media mt-2">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object img-radius comment-img" src="..\files\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Mark Doe<span class="f-12 text-muted m-l-5">Just now</span></h6>
                                            <div class="stars-example-css review-star">
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                            </div>
                                            <p class="m-b-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                            <div class="m-b-25">
                                                <span><a href="#!" class="m-r-10 f-12">Reply</a></span><span><a href="#!" class="f-12">Edit</a> </span>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Right addon">
                            <span class="input-group-addon"><i class="icofont icofont-send-mail"></i></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- tab content end -->
    </div>
</div>
@endsection
