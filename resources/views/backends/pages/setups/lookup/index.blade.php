@extends('backends.pages.main')
@section('main-body')

<div class="card">
    <div class="card-header">
        <h5 class="card-header-text">All LOOKUPS</h5>
        <a href="{{route('lookup.create')}}" class="m-b-20 float-right">
            <span class="label label-primary label-md">
                <i class="ace-icon fa fa-plus bigger-120"></i>
                Add LOOKUP
            </span>
        </a>
    </div>
    <div class="card-block accordion-block">
        <div id="accordion" role="tablist" aria-multiselectable="true">
            @foreach ($lookups as $lookup)
                @php $id = $lookup->id; @endphp
                @php $did = Crypt::decrypt($lookup->id); @endphp
                <div class="accordion-panel">
                    <div class="accordion-heading" role="tab" id="heading{{$did}}">
                        <h5 class="card-title accordion-title" >
                            <div class="accordion-msg">
                                <a style="color: white;font-size: inherit;" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$id}}" aria-expanded="true" aria-controls="collapse{{$lookup->id}}">
                                    {{$lookup->name}} - ({{$did}})
                                </a>
                                <small style="float:right;">
                                    <a href="{{route('lookup.lookup_detail.create',$id)}}">
                                        <span class="label label-info">
                                            <i class="ace-icon fa fa-plus"></i>
                                            Add
                                        </span>
                                    </a>
                                    <a href="{{route('lookup.edit',$id)}}" class="edit">
                                        <span class="label label-info">
                                            <i class="ace-icon fa fa-pencil"></i>
                                            Edit
                                        </span>
                                    </a>
                                </small>
                            </div>
                        </h5>
                    </div>
                    <div id="collapse{{$id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$did}}">
                        <div class="accordion-content accordion-desc">
                            <div class="dt-responsive table-responsive">
                                <table data-source="{{route('lookup.lookup_detail.index',$id)}}" class="table lookup-datatable compact table-hover table-bordered nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>ID</th>
                                            <th>Value</th>
                                            <th>remarks</th>
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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
        {data: 'udid', name: 'udid', "defaultContent": "<i>Not set</i>"},
        {data: 'value', name: 'value'},
        {data: 'remarks', name: 'remarks'},
        {data: 'status', name: 'status'},
        {data: 'actions', name: 'actions'},
    ];
    $(document).ready(function(){
        adjustWidth();
        $('.lookup-datatable').each(function(){
            loadDatatableWithColumns($(this),columns);
        });
    });
</script>
@endsection
