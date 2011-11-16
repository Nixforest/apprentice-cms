$(document).ready(function(){
	$('.dropdownMenu').each(function () {
		$(this).parent().hover(
			function () {
				$('.dropdownMenu:eq(0)', this).show();
			}, function () {	
				$('.dropdownMenu:eq(0)', this).hide();
			});
	});
	$(".tabMenu li").hover(function(){ 

        $(this).find('ul:first').css({visibility: "visible",display: "none"}).show(400); 
        },function(){ 
        $(this).find('ul:first').css({visibility: "hidden"}); 
		
        }); 
});