@extends('backends.pages.main')
@section('main-body')

<!-- HTML5 Export Buttons table start -->
<div class="card">
    <form action="{{route('deposit.index')}}" method="post">
        @csrf
        <div class="card-header table-card-header">
            <div class="row">
                <div class="col-md-9">
                    <h5 class="text-inverse">LIST OF SAVINGS DEPOSIT: {{$month}}</h5>
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
            <table data-source="{{route('deposit.data')}}" class="table savings-deposit-datatable compact table-hover table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Customer</th>
                        <th>Scheme</th>
                        <th>Account No</th>
                        <th>Deposit Amount</th>
                        <th>Late Fee</th>
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
        {data: 'active_customer.name', name: 'active_customer.name'},
        {data: 'active_savings_scheme.name', name: 'active_savings_scheme.name'},
        {data: 'account_no', name: 'account_no'},
        {data: 'active_savings_scheme.amount', name: 'active_savings_scheme.amount'},
        {data: 'active_savings_scheme.late_fee', name: 'active_savings_scheme.late_fee'},
        {data: 'status', name: 'status'},
        {data: 'actions', name: 'actions'},
    ]
    $(document).ready(function(){
        loadDatatableWithColumns($('.savings-deposit-datatable'),columns);
    });
</script>

@endsection
