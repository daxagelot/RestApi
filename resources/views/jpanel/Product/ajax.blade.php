<script>
    function addMore(){
        $('.ansList').append('<div class="row"><div class="col-md-4"> <div class="form-group"> <label for="title">Title</label> <input type="text" class="form-control form-control-sm" id="title" name="title[]" placeholder="Enter Title"> <div class="text-danger title"></div> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="value">Value</label> <input type="text" class="form-control form-control-sm" id="value" name="value[]" placeholder="Enter Value"> <div class="text-danger value"></div> </div> </div> <div class="col-md-2 mt-4 ml-1"> <div class="form-group"> <label for=""></label><button type="button" class="removeBox text-danger btn btn-sm bg-pcb" id="Rmemo" onclick="removeBox(this);"><i class="fas fa-trash"></i></button> </div> </div></div>');
    };
    function removeBox(elementId){
        elementId.parentElement.parentElement.parentElement.remove();
    }
    // validation of add product
    function validate1(){
        if($('#name').val() == '' || $('#price').val() == ''|| $('#category').val() == ''){
            if($('#name').val() ==''){
                $('.name').html("This name field is required!");
            }
            else{
                $('.name').html('');
            }
            if($('#price').val() ==''){
                $('.price').html("This price field is required!");
            }   
            else{
                $('.price').html('');
            }
            if($('#category').val() ==''){
                $('.category').html("This Select Category is invalid!");
            }   
            else{
                $('.category').html('');
            }
        }
        else{
            $('.name').html('');
            $('.price').html('');
            $('.category').html('');
            next('PP-2','PP-1');
        }
    }
    function validate6(){
        // if($('#mTitle').val() == '' || $('#mKeyword').val() == '' || $('#mDesc').val() == ''){
        //     if($('#mTitle').val() ==''){
        //         $('.mTitle').html("This meta title field is required!");
        //     }
        //     else{
        //         $('.mTitle').html('');
        //     }
        //     if($('#mKeyword').val() ==''){
        //         $('.mKeyword').html("This meta keyword field is required!");
        //     }   
        //     else{
        //         $('.mKeyword').html('');
        //     }
        //     if($('#mDesc').val() ==''){
        //         $('.mDesc').html("This meta description field is required!");
        //     }   
        //     else{
        //         $('.mDesc').html('');
        //     }
        // }
        // else{
        //     $('.mTitle').html('');
        //     $('.mKeyword').html('');
        //     $('.mDesc').html('');
        // }
        $('#productForm').submit();
    }
    // ---------------------------------------------------Image Base 64 Convert----------------------------------------------
    function tobase64(element) {
        var values=new Array();
        $('.imagePreview').html('');
        for (let i = 0; i < element.files.length; i++) {
           var file = element.files[i];
            reader = new FileReader();
            values.push(reader);
            reader.readAsDataURL(file);
        }
        for(let k=0; k < values.length; k++){
            values[k].onloadend = function() {
                $('.imagePreview').removeClass('d-none');
                $('.imagePreview').append('<img src="'+values[k].result+'" alt="image not found" width="80px" class="m-3"/>');
            }
        }
    }
    function removeTR(val){
        val.parentElement.parentElement.remove();
    }
    //-------------------------------------------------------Common for pagination--------------------------------------------
    function previous(show,hide){
        $('#'+show).removeClass('d-none');
        $('#'+hide).addClass('d-none');
    }
    function next(show,hide){
        $('#'+show).removeClass('d-none');
        $('#'+hide).addClass('d-none');
    }
    //--------------------------Product Status-----------------------
    $("#productDataTable").on('change.bootstrapSwitch','.productStatus', function(e){
        let status = $(this).prop('checked') == true ? 1 : 0; 
        let id = $(this).data('id');
        $.ajax({
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            type: "POST",
            dataType: "json",
            url: '{{route("status.product")}}',
            data: {'status': status, 'id': id},
            success: function(data){
                if(data.status=="success"){
                var selector=".flash-message .messageArea";
                var message_status="success";
                var message_data="Product status has been changed successfully!";
                alertMessage(selector,message_status,message_data);
                }
            }
        });
    });
    //Product Delete
    $("#productDataTable").on('click','.deleteProduct' ,function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let url='{{route("delete.product",":id")}}';
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
                            var message_data="Product has been deleted successfully!";
                            alertMessage(selector,message_status,message_data);
                            location.reload();
                        }
                    }
                });
            }
          });
    });
    //Product Attribute value on change
    function getValues(val){
        $.ajax({
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            type: "get",
            dataType: "json",
            url: '{{route("attribute.value.product")}}',
            data: {'id': val},
            success: function(data){
                $('#attribute_value_id').html('');
                $('#attribute_value_id').append('<option value="">Select Attribute Value</option>');
                $.each(data.AttrValue,function(key,value){
                    $('#attribute_value_id').append('<option value="'+value.id+'">'+value.value+'</option>');
                });
            }
        });
    }
    //Product Attribute Delete
    $(".deleteProductAttribute").on('click', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let url='{{route("delete.attribute.product",":id")}}';
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
                            var message_data="Product Attribute has been deleted successfully!";
                            alertMessage(selector,message_status,message_data);
                            $('.dataRow'+id).hide();
                        }
                    }
                });
            }
          });
    });
    //Product Image order
    $(".imageOrder").on('change', function(e) {
        let orderNo = $(this).val();
        let id = $(this).data('id');
        let product_id = $("#productId").val(); 
        $.ajax({
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            type: "POST",
            dataType: "json",
            url: '{{ route("order.image.product") }}',
            data: {
                'orderNo': orderNo,
                'id': id,
                'product_id': product_id,
            },
            success: function(data) {
                if (data.success) {
                    alert(data.success);
                    var selector=".flash-message .messageArea";
                    var message_status = "success";
                    var message_data = data.success;
                    alertMessage(selector, message_status, message_data);
                }
                else{
                    alert(data.error);
                    var selector=".flash-message .messageArea";
                    var message_status = "error";
                    var message_data = data.error;
                    alertMessage(selector, message_status, message_data);
                }
            }
        });
    });
    //Product Attribute Datatable
    $("#attributeValueDataTable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons":{
            dom:{
                button:{className: "bg-pcb btn border-0"}
            },
            "buttons":["copy", "csv", "excel", "pdf", "print"]
        } 
    }).buttons().container().appendTo('#attributeValueDataTable_wrapper .col-md-6:eq(0)');
    //Product Datatable
    $('#productDataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('list.product') }}",
        order: [[ 0, "desc" ]],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'price', name: 'price'},
            {data: 'category', name: 'category'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: true, searchable: true},
        ]
    });
</script>