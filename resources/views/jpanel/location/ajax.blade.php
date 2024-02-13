<script>
    //DELETE Country
     $(".deleteCountry").on('click', function(e){
        e.preventDefault(); 
        let id = $(this).data('id');
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
                    url: '{{route("delete.country")}}',
                    data: {'id': id},
                    success: function(data){
                        if(data.status=="success"){
                            var selector=".flash-message .messageArea";
                            var message_status="success";
                            var message_data="Country has been deleted successfully!";
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
    //Restore Country
     $(".restoreCountry").on('click', function(e){
        e.preventDefault(); 
        let id = $(this).data('id');
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
                    url: '{{route("restore.country")}}',
                    data: {'id': id},
                    success: function(data){
                        if(data.status=="success"){
                            var selector=".flash-message .messageArea";
                            var message_status="success";
                            var message_data="Country has been restore successfully!";
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
    //DELETE State
     $(".deleteState").on('click', function(e){
        e.preventDefault(); 
        let id = $(this).data('id');
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
                    url: '{{route("delete.state")}}',
                    data: {'id': id},
                    success: function(data){
                        if(data.status=="success"){
                            var selector=".flash-message .messageArea";
                            var message_status="success";
                            var message_data="State has been deleted successfully!";
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
    //Restore State
     $(".restoreState").on('click', function(e){
        e.preventDefault(); 
        let id = $(this).data('id');
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
                    url: '{{route("restore.state")}}',
                    data: {'id': id},
                    success: function(data){
                        if(data.status=="success"){
                            var selector=".flash-message .messageArea";
                            var message_status="success";
                            var message_data="State has been restore successfully!";
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
    //DELETE City
    $("#cityDatatable").on('click','.deleteCity', function(e){
        e.preventDefault(); 
        let id = $(this).data('id');
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
                    url: '{{route("delete.city")}}',
                    data: {'id': id},
                    success: function(data){
                        if(data.status=="success"){
                            var selector=".flash-message .messageArea";
                            var message_status="success";
                            var message_data="City has been deleted successfully!";
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
    //Restore City
    $("#cityDatatable").on('click','.restoreCity', function(e){
        e.preventDefault(); 
        let id = $(this).data('id');
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
                    url: '{{route("restore.city")}}',
                    data: {'id': id},
                    success: function(data){
                        if(data.status=="success"){
                            var selector=".flash-message .messageArea";
                            var message_status="success";
                            var message_data="City has been restore successfully!";
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
    //DELETE Area
    //  $(".deleteArea").on('click', function(e){
    //     e.preventDefault(); 
    //     let id = $(this).data('id');
    //     swal({
    //         title: `Are you sure you want to delete this record?`,
    //         text: "If you delete this, it will be gone forever.",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //     }).then((willDelete) => {
    //         if (willDelete) {
    //             $.ajax({
    //                 headers: {
    //                     'X-CSRF-Token': '{{ csrf_token() }}',
    //                 },
    //                 type: "POST",
    //                 dataType: "json",
    //                 url: '{{route("delete.area")}}',
    //                 data: {'id': id},
    //                 success: function(data){
    //                     if(data.status=="success"){
    //                         var selector=".flash-message .messageArea";
    //                         var message_status="success";
    //                         var message_data="Area has been deleted successfully!";
    //                         alertMessage(selector,message_status,message_data);
    //                         setTimeout(function(){// wait for 5 secs(2)
    //                             location.reload(); // then reload the page.(3)
    //                         }, 500);
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // });
    //Restore Area
    //  $(".restoreArea").on('click', function(e){
    //     e.preventDefault(); 
    //     let id = $(this).data('id');
    //     swal({
    //         title: `Are you sure you want to restore this record?`,
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: false,
    //     }).then((willDelete) => {
    //         if (willDelete) {
    //             $.ajax({
    //                 headers: {
    //                     'X-CSRF-Token': '{{ csrf_token() }}',
    //                 },
    //                 type: "POST",
    //                 dataType: "json",
    //                 url: '{{route("restore.area")}}',
    //                 data: {'id': id},
    //                 success: function(data){
    //                     if(data.status=="success"){
    //                         var selector=".flash-message .messageArea";
    //                         var message_status="success";
    //                         var message_data="Area has been restore successfully!";
    //                         alertMessage(selector,message_status,message_data);
    //                         setTimeout(function(){// wait for 5 secs(2)
    //                             location.reload(); // then reload the page.(3)
    //                         }, 500);
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // });
    //country datatable
    $("#countryDataTable").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons":{
                dom:{
                    button:{className: "bg-pcb btn border-0"}
                },
                "buttons":["copy", "csv", "excel", "pdf", "print"]
            } 
    }).buttons().container().appendTo('#countryDataTable_wrapper .col-md-6:eq(0)');
    //state datatable
    $("#stateDataTable").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons":{
                dom:{
                    button:{className: "bg-pcb btn border-0"}
                },
                "buttons":["copy", "csv", "excel", "pdf", "print"]
            } 
    }).buttons().container().appendTo('#stateDataTable_wrapper .col-md-6:eq(0)');
    //city datatable
    $('#cityDatatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('list.city') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'state', name: 'state'},
            {data: 'action', name: 'action', orderable: true, searchable: true},
        ]
    });
    //area datatable
    // $("#areaDataTable").DataTable({
    //         "responsive": true, "lengthChange": true, "autoWidth": false,
    //         "buttons":{
    //             dom:{
    //                 button:{className: "bg-pcb btn border-0"}
    //             },
    //             "buttons":["copy", "csv", "excel", "pdf", "print"]
    //         } 
    // }).buttons().container().appendTo('#areaDataTable_wrapper .col-md-6:eq(0)');
</script>