@extends('backends.pages.main')
@section('main-body')

<!-- HTML5 Export Buttons table start -->
<div class="card">
    <div class="card-header table-card-header">
        <h5 class="text-inverse">LIST OF SAVINGS ACCOUNTS</h5>
        <a href="{{route('account.create')}}" class="btn btn-sm btn-primary m-b-20 float-right">+ Add Savings Account</a>
    </div>
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table data-source="{{route('account.data')}}" class="table savings-account-datatable compact table-hover table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Customer</th>
                        <th>Account No</th>
                        <th>Scheme</th>
                        <th>First Deposit</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th><input autocomplete="off" style="width:87%" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th><input autocomplete="off" style="width:87%" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th><input autocomplete="off" style="width:87%" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th><input autocomplete="off" style="width:87%" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th><input autocomplete="off" style="width:87%" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th><input autocomplete="off" style="width:87%" type="text" class="form-control filter-datatable" placeholder="search"></th>
                        <th></th>
                    </tr>
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
        {data: 'account_no', name: 'account_no'},
        {data: 'savings_scheme.name', name: 'savings_scheme.name'},
        {data: 'first_deposit_amount', name: 'first_deposit_amount'},
        {data: 'start_date', name: 'start_date'},
        {data: 'status', name: 'status'},
        {data: 'actions', name: 'actions'},
    ]
    $(document).ready(function(){
        loadDatatableWithColumns($('.savings-account-datatable'),columns);
    });
</script>

@endsection
