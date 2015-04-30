$(document).ready(function(){
	$('#footer_scroll_to_top').click(function() {
		$("html,body").animate({scrollTop:0},400);
	});
	var main_container_height = $(window).height() - 210;
	if ( $('.main .container').height() < main_container_height)
	{
		$('.main .container').css('height', main_container_height);
	};
});