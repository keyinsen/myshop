$(function(){
	var count1=$('.font1').text();
	var id=setInterval(count,1000);
	function count(){
		count1=count1-1;
		if(count1<0){
			clearInterval(id);
		}else{
			
			$('.font1').text(count1);
			
		}
	}
})
