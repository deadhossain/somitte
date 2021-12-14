@extends('backends.pages.main')
@section('main-body')

<!-- HTML5 Export Buttons table start -->
<div class="card">
    <div class="card-header table-card-header">
        <h5 class="text-inverse">LIST OF CUSTOMERS</h5>
        <a href="{{route('customer.create')}}" class="btn btn-sm btn-primary m-b-20 float-right">+ Add Customer</a>
    </div>
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table data-source="{{route('customer.data')}}" class="table customer-datatable compact table-hover table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>NID No</th>
                        <th>Phone</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
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
        {data: 'image_path', name: 'image_path'},
        {data: 'name', name: 'name'},
        {data: 'nid_no', name: 'nid_no'},
        {data: 'phone', name: 'phone'},
        {data: 'start_date', name: 'start_date'},
        {data: 'status', name: 'status'},
        {data: 'actions', name: 'actions'},
    ]
    $(document).ready(function(){
        adjustWidth();
        loadDatatableWithColumns($('.customer-datatable'),columns);
    });
</script>

@endsection
