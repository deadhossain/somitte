@extends('backends.pages.main')
@section('main-body')

<!-- HTML5 Export Buttons table start -->
<div class="card">
    <form action="{{route('deposit.report.month-wise')}}" method="post">
        @csrf
        <div class="card-header table-card-header">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 25px">
                    <h5 class="text-inverse">MONTH WISE SAVINGS DEPOSIT REPORT</h5>
                </div>

                <div class="col-md-12">
                    <div class=" col-md-3 form-group row @error('monthfilter') has-error @enderror">
                        <label class="col-form-label"> Select Date Range </label>
                        <input readonly autocomplete="off" type="text" class="form-control" name="monthfilter" placeholder="Select Month" value="{{$daterange}}" required>
                        <span class="messages popover-valid">
                            @error('monthfilter')
                                <i class="text-danger error icofont icofont-close-circled" data-toggle="tooltip" data-placement="top" data-trigger="hover" title="" data-original-title="{{$message}}"></i>
                            @enderror
                        </span>
                    </div>

                    <div class=" col-md-3 form-group row">
                        <label class="col-form-label"> </label>
                        <input type="submit" class="btn btn-primary m-b-0" name="month-wise-report" value="Submit">
                    </div>
                </div>


            </div>
            <hr>
        </div>
    </form>
    <div class="card-block">

        <div class="dt-responsive table-responsive">
            <table data-source="{{route('deposit.data')}}" class="table savings-deposit-datatable compact table-hover table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Customer Name</th>
                        <th>Customer ID</th>
                        <th>Savings Scheme</th>
                        <th>Account No</th>
                        <th>Jan-21</th>
                        <th>Feb-21</th>
                        <th>Mar-21</th>
                        <th>Apr-21</th>
                        <th>May-21</th>
                        <th>Jun-21</th>
                        <th>Jul-21</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- @include('backends.partials.datatablescript') --}}
<script type="text/javascript">
    var columns = [
        {
            "data": 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {data: 'active_customer.name', name: 'active_customer.name'},
        {data: 'active_savings_scheme.name', name: 'active_savings_scheme.name'},
        {data: 'account_no', name: 'account_no'},
        {data: 'active_savings_scheme.amount', name: 'active_savings_scheme.amount'},
        {data: 'active_savings_scheme.late_fee', name: 'active_savings_scheme.late_fee'},
        {data: 'paymentStatus', name: 'paymentStatus'},
        {data: 'actions', name: 'actions'},
    ]
    $(document).ready(function(){
        loadDatatableWithColumns($('.savings-deposit-datatable'),columns);
    });
</script>

@endsection
