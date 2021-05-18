<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).off('click','a.deleteDTRow').on('click','a.deleteDTRow',function(e){
            let url = $(this).attr('data-modal-url');
            if(!url || url == "")return false;
            let datatable = $(this).closest('.dataTable');
            let tr = $(this).closest('tr');
            // let csrf_token = $('meta[name="csrf_token"]').attr('content');
            e.preventDefault();
            Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the record!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            }).then((confirmation) => {
            if (confirmation.value) {
                $.ajax({
                method: "DELETE",
                url: url,
                success:function(result){
                    if(datatable.length>0) datatable.DataTable().ajax.reload();
                    else if(tr || tr != "") tr.remove();
                    Swal.fire(result.title,result.msg,result.type);
                },
                error:function(result){
                    Swal.fire(result.responseJSON.title,'Please contact for technical support',result.responseJSON.type);
                }
                })

            }
            })
        });
    })

</script>
