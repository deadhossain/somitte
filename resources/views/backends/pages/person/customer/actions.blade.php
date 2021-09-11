<div class="dropdown-primary dropdown open">
    <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>
    <div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
        <a href="{{route('customer.edit',$customer->id)}}" class="dropdown-item waves-effect waves-light">
            <i class="ti-pencil-alt"></i>
            Edit
        </a>
        <a href="#" class="dropdown-item waves-light waves-effect deleteDTRow"
            data-modal-url="{{ route('customer.destroy',$customer->id)}}">
            <i class="ti-trash"></i> Delete
        </a>
        {{-- <a href="#" class="dropdown-item waves-light waves-effect" onclick="$(this).find('form').submit()">
            <i class="ti-trash"></i>
            Delete
            <form action="{{ route('customer.destroy', $customer->id) }}" method="POST">
                <input autocomplete="off" type="hidden" name="_method" value="DELETE">
                <input autocomplete="off" type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </a> --}}
    </div>
</div>


