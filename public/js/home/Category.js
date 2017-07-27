$(function(){
	var count=2;
	$('.ct-rt-bom-head-a').click(function(){
		$('.ct-rt-bom-head-a').removeClass('red');
		$('.ct-rt-bom-head-a').css('color','#000000');
		$(this).addClass('red');
		$(this).css('color','#ffffff');
	})
	$('.action').click(function(){
		count++;
		if(count%2==0){
			$(this).find('span').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		}else{
			$(this).find('span').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		}
		
	})
	$('.ct-ul-a').click(function(){
		$(this).parent().parent().find('li').children().removeClass('red');
		$(this).addClass('red');
	})

})
