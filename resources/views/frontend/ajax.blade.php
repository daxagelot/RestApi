<script>
    // contact us page
    $('#contactSubmit').on('click',function(e){
        e.preventDefault();
        var formdata=new FormData($('#contactForm')[0]);
        $.ajax({
            url: '{{route("store.contactus")}}',
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(data){
                if(data.status=="success"){
                    $("[name='name']").removeClass('is-invalid').removeClass('border-danger');
                    $('.name').html('');
                    $("[name='email']").removeClass('is-invalid').removeClass('border-danger');
                    $('.email').html('');
                    $("[name='phone']").removeClass('is-invalid').removeClass('border-danger');
                    $('.phone').html('');
                    $("[name='message']").removeClass('is-invalid').removeClass('border-danger');
                    $('.message').html('');
                    $('html, body').animate({
                        scrollTop: $(".banner").offset().bottom-200
                    }, 300);
                    alert("Your message has been submitted");
                    $("#contactForm")[0].reset();
                }
                else{
                    $("[name='name']").removeClass('is-invalid').removeClass('border-danger');
                    $('.name').html('');
                    $("[name='email']").removeClass('is-invalid').removeClass('border-danger');
                    $('.email').html('');
                    $("[name='phone']").removeClass('is-invalid').removeClass('border-danger');
                    $('.phone').html('');
                    $("[name='message']").removeClass('is-invalid').removeClass('border-danger');
                    $('.message').html('');
                    $.each(data.errors,function(key,value){
                        $('.'+key).append(value);
                        $("[name='"+key+"']").addClass('is-invalid').addClass('border-danger');
                    });
                }
            }
        });
    });
</script>