<div class="modal fade" id="modal-location">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Location</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="locationData">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Add / Update Location</label>
                            <input type="text" class="form-control" name="location" value="{{ $location->location }}">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $location->id }}">
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onClick="submit()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submit(){
        var validateGroup = $(".needs-validation");
        var formData = new FormData($('#locationData')[0]);
        
        if($('#locationData')[0].checkValidity() === true){
            Swal.fire({
                title: 'Saving...',
                html: 'Please wait for a moment...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            })
            
            $.ajax({
                url:"{{url('ajax/store-location')}}",
                type:'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done((response) => {
                if(response.status == 'success'){
                    Swal.fire(
                        'Success!',
                        response.message,
                        response.status
                    )
                    .then((result) => {
                        if(result.value){
                            location.reload()
                        }
                    })
                } else {
                    Swal.fire(
                        'Error!',
                        response.message,
                        response.status
                    )
                }
            });
        } else {
            Swal.fire(
                'Error!',
                'Please fill all the required fields!',
                'error'
            )
            for (var i = 0; i < validateGroup.length; i++){
                validateGroup[i].classList.add('was-validated')
            }
        }
    }
    
</script>