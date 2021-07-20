@extends('backends.pages.main')
@section('main-body')

<div class="card">
    <div class="card-header">
        <h5 class="card-header-text">ALL LOOKUP</h5>
        <a href="{{route('lookup.create')}}" class="btn btn-sm btn-primary m-b-20 float-right">+ Add Lookup</a>
    </div>
    <div class="card-block accordion-block color-accordion-block">
        <div class="color-accordion" id="color-accordion">
            @foreach ($lookups as $lookup)
                @php $id = $lookup->id; @endphp

                <a class="accordion-msg b-none">
                    {{$lookup->name}} - ({{$lookup->id}})
                    <button class="btn btn-mini btn-inverse"><i class="icofont icofont-exchange"></i>Add</button>
                </a>
                <div class="accordion-desc">
                    <div class="dt-responsive table-responsive">
                        <table data-source="{{route('lookup.lookupDetails.index',$id)}}" class="table users-datatable compact table-hover table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>remarks</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th><input style="width:87%" type="text" class="form-control filter-datatable" placeholder="search"></th>
                                    <th><input style="width:87%" type="text" class="form-control filter-datatable" placeholder="search"></th>
                                    <th><input style="width:87%" type="text" class="form-control filter-datatable" placeholder="search"></th>
                                    <th>
                                        <select style="width:95%" name="active_fg" class="form-control" data-column="active_fg">
                                            <option value="">All</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php $sl = 0; @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td> {{++$sl}} </td>
                                        <td> {{$user->name}} </td>
                                        <td> {{$user->email}} </td>
                                        <td> {{$user->user->name}} </td>
                                        <td> {{$user->created_at}} </td>
                                        <td> {!! $user->status !!} </td>
                                        <td> @include('backends.pages.user.actions') </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
