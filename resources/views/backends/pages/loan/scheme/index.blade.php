@extends('backends.pages.main')
@section('main-body')

<!-- HTML5 Export Buttons table start -->
<div class="card">
    <div class="card-header table-card-header">
        <h5 class="text-inverse">LIST OF LOAN SCHEME</h5>
        <a href="{{route('loan_scheme.create')}}" class="btn btn-sm btn-primary m-b-20 float-right">+ Add Loan Scheme</a>
    </div>
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table data-source="{{route('loan_scheme.data')}}" class="table loan-scheme-datatable compact table-hover table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Amount Range</th>
                        <th>Rate (%)</th>
                        <th>Late Fee</th>
                        <th>Max Installment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    {{-- <tr>
                        <th></th>
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
        {data: 'name', name: 'name'},
        {data: 'amount_range', name: 'amount_range'},
        {data: 'rate', name: 'rate'},
        {data: 'late_fee', name: 'late_fee'},
        {data: 'max_installment', name: 'max_installment'},
        {data: 'status', name: 'status'},
        {data: 'actions', name: 'actions'},
    ]
    $(document).ready(function(){
        adjustWidth();
        loadDatatableWithColumns($('.loan-scheme-datatable'),columns);
    });
</script>

@endsection
