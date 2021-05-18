@extends('backends.pages.main')
@section('main-body')

<!-- HTML5 Export Buttons table start -->
<div class="card">
    <div class="card-header table-card-header">
        <h5 class="text-inverse">LIST OF USERS</h5>
        <a href="{{route('user.create')}}" class="btn btn-sm btn-primary m-b-20 float-right">+ Add User</a>
    </div>
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table class="table basic-datatable compact table-hover table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created By</th>
                        <th>Crated Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl = 0; @endphp
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('backends.partials.datatablescript')

@endsection
