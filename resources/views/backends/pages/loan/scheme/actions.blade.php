<div class="dropdown-primary dropdown open">
    <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>
    <div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
        <a href="{{route('loan_scheme.edit',$loanScheme->encryptId)}}" class="dropdown-item waves-effect waves-light">
            <i class="ti-pencil-alt"></i>
            Edit
        </a>
        <a href="#" class="dropdown-item waves-light waves-effect deleteDTRow"
            data-modal-url="{{ route('loan_scheme.destroy',$loanScheme->encryptId)}}">
            <i class="ti-trash"></i> Delete
        </a>
    </div>
</div>


