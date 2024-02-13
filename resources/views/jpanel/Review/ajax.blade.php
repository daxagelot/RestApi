<script>
     //review Status
     $(".reviewStatus").on('change.bootstrapSwitch', function(e){
        let status = $(this).prop('checked') == true ? 1 : 0; 
        let id = $(this).data('id');
        $.ajax({
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            type: "POST",
            dataType: "json",
            url: '{{route("status.review")}}',
            data: {'status': status, 'id': id},
            success: function(data){
                if(data.status=="success"){
                var selector=".flash-message .messageArea";
                var message_status="success";
                var message_data="Review status has been changed successfully!";
                alertMessage(selector,message_status,message_data);
                }
            }
        });
    });
    //Review Delete
    $(".deleteReview").on('click', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let url='{{route("delete.review",":id")}}';
        url=url.replace(':id',id);
            swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    type: "POST",
                    dataType: "json",
                    url: url,
                    data: '',
                    success: function(data){
                        if(data.status=="success"){
                            var selector=".flash-message .messageArea";
                            var message_status="success";
                            var message_data="Review has been deleted successfully!";
                            alertMessage(selector,message_status,message_data);
                            setTimeout(function(){// wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 500);
                        }
                    }
                });
            }
          });
    });
    //Review Restore
    $(".restoreReview").on('click', function(e){
        e.preventDefault(); 
        let id = $(this).data('id');
        let url='{{route("restore.review",":id")}}';
        url=url.replace(':id',id);
        swal({
            title: `Are you sure you want to restore this record?`,
            icon: "warning",
            buttons: true,
            dangerMode: false,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    type: "POST",
                    dataType: "json",
                    url: url,
                    data: {'id': id},
                    success: function(data){
                        if(data.status=="success"){
                            var selector=".flash-message .messageArea";
                            var message_status="success";
                            var message_data="Review has been restore successfully!";
                            alertMessage(selector,message_status,message_data);
                            setTimeout(function(){// wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 500);
                        }
                    }
                });
            }
        });
    });
    $("#reviewDataTable").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons":{
            dom:{
                button:{className: "bg-pcb btn border-0"}
            },
            "buttons":["copy", "csv", "excel", "pdf", "print"]
        } 
    }).buttons().container().appendTo('#reviewDataTable_wrapper .col-md-6:eq(0)');
</script>