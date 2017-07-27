
$(function(){
	
	$('.carousel').carousel();
	
	$('.li').hover(function(){
		$(this).find('.li-div').css('display','block');
	},function(){
		$(this).find('.li-div').css('display','none');
	})
})
