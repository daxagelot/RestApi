<script>
//Fetch State on change country
function getState(val){
    let url="{{route('state.fetch',':id')}}";
    url=url.replace(':id',val);
    $.get(url,function(data){
        $("[name='state']").html('<option value="">Select State</option>');
        $.each(data.data,function(key,value){
            $("[name='state']").append('<option value='+value.id+'>'+value.name+'</option>');
        });
    });
}    
function getCity(val){
    let url="{{route('city.fetch',':id')}}";
    url=url.replace(':id',val);
    $.get(url,function(data){
        $("[name='city']").html('<option value="">Select City</option>');
        $.each(data.data,function(key,value){
            $("[name='city']").append('<option value='+value.id+'>'+value.name+'</option>');
        });
    });
}  
</script>