<script>
    //Contact Delete
    $(".deleteContact").on('click', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let url='{{route("delete.contact",":id")}}';
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
                            var message_data="Contact has been deleted successfully!";
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
    //Contact Restore
    $(".restoreContact").on('click', function(e){
        e.preventDefault(); 
        let id = $(this).data('id');
        let url='{{route("restore.contact",":id")}}';
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
                            var message_data="Contact has been restore successfully!";
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
//Contact Datatable
$("#contactDataTable").DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "buttons":{
        dom:{
            button:{className: "bg-pcb btn border-0"}
        },
        "buttons":["copy", "csv", "excel", "pdf", "print"]
    } 
}).buttons().container().appendTo('#inquiryDataTable_wrapper .col-md-6:eq(0)');
</script>