$(function(){
	$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
});

var options = {
            success:       showResponse,
            dataType: 'json'
        };
$('#loadimg').click(function(){
	$('#picpaths').click();
});



$('#picpaths').change(function(){
	 $('#upload').ajaxForm(options).submit();
            
});
       function showResponse(response)  {
        if(response.success == false)
        {
            var responseErrors = response.errors;
            $.each(responseErrors, function(index, value)
            {
                if (value.length != 0)
                {
                    $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                }
            });
            $("#validation-errors").show();
        } else {

//          $('.upload-mask').hide();
//          $('.upload-file').hide();
//          $('.pic-upload').next().css('display','block');

            console.log(response.status);
            $('.img-rounded').attr('src','http://localhost/ShopProject/public/img/dataimg/'+response.img);
			$('#upimg').attr('value','http://localhost/ShopProject/public/img/dataimg/'+response.img);
//          $("#"+response.id).attr('src',response.pic);
//          $("#"+response.id).next().attr('value',response.pic);
        } 
        }

})





