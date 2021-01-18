$(function () {
    var table = $('.users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/home",
        columns: [
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'email', name: 'email'},
            {data: 'gender', name: 'gender'},
            {data: 'birthday', name: 'birthday'},
            {data: 'contact_number', name: 'contact_number'},
            {data: 'address', name: 'address'},
            {data: 'city', name: 'city'},
            {data: 'country', name: 'country'},
            {data: 'province', name: 'province'},
            {data: 'zip_code', name: 'zip_code'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
    });

    $(document).on('click', '.btn-view', function () {
        var id = $(this).attr("id");
        var url = window.location.origin + '/contacts/' + id;
        window.location.replace(url);
    });

    $(document).on('click', '.btn-delete', function () {
        var id = $(this).attr("id");
        var token = $('meta[name=csrf-token]').attr('content');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this account",
            icon: "warning",
            buttons: [
                'No, cancel it!',
                'Yes, I am sure!'
            ],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "/contacts/"+id,
                    type: "DELETE",
                    dataType: 'JSON',
                    data:{
                        'id': id,
                        '_token': token,
                    },               
                });
                location.reload();
            } else {
                swal("Cancelled", "Account not removed", "error");
            }
        })
    
    });

  });