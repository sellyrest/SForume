@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Response</h6>
        </div>
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-3">
                    

                </div>
                <div class=" mb-3 col-6 offset-3">
                    <form method="GET"
                    class="d-none d-sm-inline-block form-inline navbar-search float-end w-100">
                    <div class="input-group-lg float-end">
                        <input name="keyword" type="text" class="form-control bg-light border-0 small search-topic"
                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div id="load-icon" class="spinner position-absolute start-50 top-50" style="display: none"></div>
            <div class="table-responsive p-3" id="content-response">

            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        var url = "{{ route('admin.response.index') }}"
        getResponse(url)

       $('#search-response').keyup(function (e) { 
        e.preventDefault()
        var search = $(this).val();
        getResponse(url + '?search=' + search)
    });

    function getResponse(url) {
        $.ajax({
            type: "GET",
            url: url,
            cache: false,
            beforeSend: function () {
                $('#load-icon').show();
            },
            success: function (response) {
                $('#load-icon').hide();  
                $('#content-response').html(response); 
                $('ul.pagination a').click(function (e) { 
                e.preventDefault();
                var href = $(this).attr('href');
                getResponse(href)
                });
            }
        });
    }
    function deleteResponse(e, id) {
        e.preventDefault()
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/response') }}/"+id,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status == true) {
                        swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )   
                    } else {
                        swalWithBootstrapButtons.fire(
                        'Error!',
                        'This user owns a topic so it cant be deleted',
                        'error'
                        )
                    }
                    getResponse(url)
                }
            }); 
        }
        }) 
    }
    </script>
@endsection
