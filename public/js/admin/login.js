$(function(){
	$('#img').click(function(){
		
		$url = "http://localhost/ShopProject/public/admin/loginImg/";
        $url = $url+Math.ceil(Math.random()*10);
	$(this).attr('src',$url);
	})
})
