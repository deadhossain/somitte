<div class="dropdown-primary dropdown open">
    <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>
    <div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
        {{-- @if (Auth::user()->id == $user->id || $user->active_fg==0) --}}
            <a href="{{route('user.edit',$user->id)}}" class="dropdown-item waves-effect waves-light">
                <i class="ti-pencil-alt"></i>
                Edit
            </a>
        {{-- @endif --}}
        <a href="#" data-modal-url="{{route('user.destroy',$user->id)}}" class="dropdown-item waves-light waves-effect deleteDTRow">
            <i class="ti-trash"></i>
            Delete
        </a>
    </div>
</div>
