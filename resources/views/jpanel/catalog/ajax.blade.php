<script>
    $(function() {


        //STATUS SWITCH ON CHANGE EVENT
        $(".categoryStatus").on('change.bootstrapSwitch', function(e) {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let category_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route('status.change.category') }}',
                data: {
                    'status': status,
                    'category_id': category_id
                },
                success: function(data) {
                    if (data.status == "success") {
                        var selector = ".flash-message .messageArea";
                        var message_status = "success";
                        var message_data = "Category status has been changed successfully!";
                        alertMessage(selector, message_status, message_data);
                    }
                }
            });
        })
        //STATUS SWITCH ON CHANGE EVENT
        $(".categoryMenuStatus").on('change.bootstrapSwitch', function(e) {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let category_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route('menu.status.category') }}',
                data: {
                    'status': status,
                    'category_id': category_id
                },
                success: function(data) {
                    if (data.status == "success") {
                        var selector = ".flash-message .messageArea";
                        var message_status = "success";
                        var message_data =
                            "Category menu status has been changed successfully!";
                        alertMessage(selector, message_status, message_data);
                        setTimeout(function() { // wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 2000);
                    }
                }
            });
        })
        //DELETE Category
        $(".deleteCategory").on('click', function(e) {
            e.preventDefault();
            let category_id = $(this).data('id');

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
                        url: '{{ route('category.delete') }}',
                        data: {
                            'category_id': category_id
                        },
                        success: function(data) {

                            if (data.status == "success") {
                                var selector = ".flash-message .messageArea";
                                var message_status = "success";
                                var message_data =
                                    "User has been deleted successfully!";
                                alertMessage(selector, message_status,
                                message_data);

                                for (var i = 0; i < data.categories.length; i++) {
                                    var category = data.categories[i];
                                    $('.dataRow' + category.id).hide();
                                }
                                $('.dataRow' + category_id).hide();
                            }
                        }
                    });
                }
            });
        })




        //STATUS SWITCH ON CHANGE EVENT
        $(".brandStatus").on('change.bootstrapSwitch', function(e) {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let brand_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route('status.change.brand') }}',
                data: {
                    'status': status,
                    'brand_id': brand_id
                },
                success: function(data) {
                    if (data.status == "success") {
                        var selector = ".flash-message .messageArea";
                        var message_status = "success";
                        var message_data = "Brand status has been changed successfully!";
                        alertMessage(selector, message_status, message_data);
                    }
                }
            });
        })

        //DELETE Brand
        $(".deleteBrand").on('click', function(e) {
            e.preventDefault();
            let brand_id = $(this).data('id');

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
                        url: '{{ route('brand.delete') }}',
                        data: {
                            'brand_id': brand_id
                        },
                        success: function(data) {

                            if (data.status == "success") {
                                var selector = ".flash-message .messageArea";
                                var message_status = "success";
                                var message_data =
                                    "Brand has been deleted successfully!";
                                alertMessage(selector, message_status,
                                message_data);
                                $('.dataRow' + brand_id).hide();
                            }
                        }
                    });
                }
            });
        })




        //STATUS SWITCH ON CHANGE EVENT
        $(".attributeStatus").on('change.bootstrapSwitch', function(e) {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let attribute_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route('status.change.attribute') }}',
                data: {
                    'status': status,
                    'attribute_id': attribute_id
                },
                success: function(data) {
                    if (data.status == "success") {
                        var selector = ".flash-message .messageArea";
                        var message_status = "success";
                        var message_data =
                        "Attrinute status has been changed successfully!";
                        alertMessage(selector, message_status, message_data);
                    }
                }
            });
        })

        //DELETE Brand
        $(".deleteAttribute").on('click', function(e) {
            e.preventDefault();
            let attribute_id = $(this).data('id');

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
                        url: '{{ route('attribute.delete') }}',
                        data: {
                            'attribute_id': attribute_id
                        },
                        success: function(data) {

                            if (data.status == "success") {
                                var selector = ".flash-message .messageArea";
                                var message_status = "success";
                                var message_data =
                                    "Attribute has been deleted successfully!";
                                alertMessage(selector, message_status,
                                message_data);
                                $('.dataRow' + attribute_id).hide();
                            }
                        }
                    });
                }
            });
        })
        $(".deleteAttributeValue").on('click', function(e) {
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
                        url: '{{ route('attribute.value.delete') }}',
                        data: {
                            'id': id
                        },
                        success: function(data) {

                            if (data.status == "success") {
                                var selector = ".flash-message .messageArea";
                                var message_status = "success";
                                var message_data =
                                    "Attribute Value has been deleted successfully!";
                                alertMessage(selector, message_status,
                                message_data);
                                $('.dataRow' + id).hide();
                            }
                        }
                    });
                }
            });
        })
        $("#categoryDataTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": {
                dom: {
                    button: {
                        className: "bg-pcb btn border-0"
                    }
                },
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }
        }).buttons().container().appendTo('#categoryDataTable_wrapper .col-md-6:eq(0)');
        $("#brandDataTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": {
                dom: {
                    button: {
                        className: "bg-pcb btn border-0"
                    }
                },
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }
        }).buttons().container().appendTo('#brandDataTable_wrapper .col-md-6:eq(0)');

        $("#attributeDataTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": {
                dom: {
                    button: {
                        className: "bg-pcb btn border-0"
                    }
                },
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }
        }).buttons().container().appendTo('#attributeDataTable_wrapper .col-md-6:eq(0)');

        $("#attributeValueDataTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": {
                dom: {
                    button: {
                        className: "bg-pcb btn border-0"
                    }
                },
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }
        }).buttons().container().appendTo('#attributeValueDataTable_wrapper .col-md-6:eq(0)');


        //STATUS SWITCH ON CHANGE EVENT Gallery
        $(".galleryStatus").on('change.bootstrapSwitch', function(e) {
            let status = $(this).prop('checked') == true ? 1 : 0;
            let gallery_id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                dataType: "json",
                url: '{{ route('status.change.gallery') }}',
                data: {
                    'status': status,
                    'gallery_id': gallery_id
                },
                success: function(data) {
                    if (data.status == "success") {
                        var selector = ".flash-message .messageArea";
                        var message_status = "success";
                        var message_data = "Gallery status has been changed successfully!";
                        alertMessage(selector, message_status, message_data);
                    }
                }
            });
        })


        //DELETE Gallery
        $(".deleteGallery").on('click', function(e) {
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
                        type: "POST",
                        dataType: "json",
                        url: '{{ route('gallery.delete') }}',
                        data: {
                            'id': id,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.status == "success") {
                                var selector = ".flash-message .messageArea";
                                var message_status = "success";
                                var message_data =
                                    "Gallery has been deleted successfully!";
                                alertMessage(selector, message_status,
                                message_data);

                                $('.dataRow' + id).hide();
                            } else {
                                // Handle other response statuses (if any)
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });

        $("#galleryDataTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": {
                dom: {
                    button: {
                        className: "bg-pcb btn border-0"
                    }
                },
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }
        }).buttons().container().appendTo('#galleryDataTable_wrapper .col-md-6:eq(0)');


    });
</script>
