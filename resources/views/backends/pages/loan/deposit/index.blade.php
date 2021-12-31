@extends('backends.pages.main')
@section('main-body')

<!-- HTML5 Export Buttons table start -->
<div class="card">
    <form action="{{route('loan_deposit.index')}}" method="post">
        @csrf
        <div class="card-header table-card-header">
            <div class="row">
                <div class="col-md-9">
                    <h5 class="text-inverse">LIST OF LOAN DEPOSITS: {{$month}}</h5>
                </div>

                <div class="col-md-3">
                    <div class="input-group input-group-button">
                        <input name="month-picker" type="text" class="form-control month-picker" autocomplete="off" value="{{$month}}">
                        <span  class="input-group-addon btn btn-primary" id="basic-addon10" type="submit" onclick="event.preventDefault();
                        $(this).closest('form').submit();">
                            <span style="color: white">Submit</span>
                        </span>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </form>
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table data-source="{{route('loan_deposit.data',$month)}}" class="table loan-deposit-datatable compact table-hover table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th style="width: 15%">Customer</th>
                        <th style="width: 12%">Scheme</th>
                        <th style="width: 8%">Account No</th>
                        <th title="Total Amount" style="width: 5%">TA</th>
                        <th title="Total Paid Amount" style="width: 5%">TPA</th>
                        <th style="width: 5%">Per Installment</th>
                        <th style="width: 5%">Late Fee</th>
                        <th style="width: 5%">Status</th>
                        <th style="width: 8%">Action</th>
                    </tr>
                    {{-- <tr>
                        <th></th>
                        <th><input autocomplete="off" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th><input autocomplete="off" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th><input autocomplete="off" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th><input autocomplete="off" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th><input autocomplete="off" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th><input autocomplete="off" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th><input autocomplete="off" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th><input autocomplete="off" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th></th>
                    </tr> --}}
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('backends.partials.datatablescript')
<script type="text/javascript">
    var columns = [
        {
            "data": 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {data: 'customer.name', name: 'customer.name'},
        {data: 'loan_scheme.name', name: 'loan_scheme.name'},
        {data: 'account_no', name: 'account_no'},
        {data: 'total_payable_amount', name: 'total_payable_amount'},
        {data: 'totalLoanDeposits', name: 'totalLoanDeposits'},
        {data: 'per_installment', name: 'per_installment'},
        {data: 'loan_scheme.late_fee', name: 'loan_scheme.late_fee'},
        {data: 'paymentStatus', name: 'paymentStatus'},
        {data: 'actions', name: 'actions'},
    ]
    $(document).ready(function(){
        adjustWidth();
        loadDatatableWithColumns($('.loan-deposit-datatable'),columns);
    });
</script>

@endsection
