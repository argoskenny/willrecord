$(document).ready(function(){
	$('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				var attr = $(this).attr('rel');
				if ( typeof attr !== 'undefined' && attr !== false ) {
					project_change( $(this).attr('rel') );
				}
				$('html,body').animate({scrollTop: target.offset().top}, 600);
				return false;	
			}
		}
	});
});

function resizeBg(){
	// 位置效正
	var title_left = ( $(window).width() / 2 )  - ( $('.title').width() / 2 );
	var grid_left = $(window).width() / 24;
	var grid_top = $(window).height() / 12;
	var custom_left = ( $('.title').width() - $('.custom').width() ) / 2 - 20;

	var jumbotron_left = ( $(window).width() / 2 )  - ( $('.jumbotron').width() / 2 ) - 80;

	if ( $(window).width() > 460 ) {
		
		$('.main').css('height',$(window).height());
		
		$('.intro_question').css('height',$(window).height());
		
		$('.smoke').css('left',grid_left * 6);
		$('.smoke').css('top',grid_top * 4);
		$('.diet').css('left',grid_left * 16);
		$('.diet').css('top',grid_top * 4.5);
		$('.excercise').css('left',grid_left * 10);
		$('.excercise').css('top',grid_top * 6);

		$('.intro_project').css('padding-top',$(window).height() / 4 );
		$('.intro_project').css('padding-bottom',$(window).height() / 4 );

		$('.intro_dayrecord').css('height',$(window).height());
		
		$('.intro_record').css('padding-top',$(window).height() / 4 );
		$('.intro_record').css('padding-bottom',$(window).height() / 4 );
		
		$('.title').css('padding-top',grid_top * 2);
		$('.title').css('left',title_left - 40);

		$('.jumbotron').css('left',jumbotron_left);

		$('.intro_other').css('height',$(window).height());
		$('.intro_other').css('padding-top',$(window).height() / 4 );
	}
	else{
		$('.main').css('height',460);
		
		$('.intro_question').css('height',460);
		
		$('.smoke').css('left',( $(window).width() / 2 )  - ( $('.smoke').width() / 2 ) - 20 );
		$('.smoke').css('top',grid_top * 3.5);
		$('.diet').css('left',( $(window).width() / 2 )  - ( $('.diet').width() / 2 ) - 20 );
		$('.diet').css('top',grid_top * 5.5);
		$('.excercise').css('left',( $(window).width() / 2 )  - ( $('.excercise').width() / 2 ) - 20 );
		$('.excercise').css('top',grid_top * 7.5);

		$('.intro_project').css('padding-top',100);
		$('.intro_project').css('padding-bottom',100);
		
		$('.intro_dayrecord').css('height',460);

		$('.intro_record').css('padding-top',100 );
		$('.intro_record').css('padding-bottom',100 );
		
		$('.title').css('padding-top',grid_top * 1);
		$('.title').css('padding-right',40);

		$('.jumbotron').css('left',20);
		$('.jumbotron').css('width',$(window).width() - 40 );
		
		$('.intro_other').css('padding-top',100 );
	}

	$('.custom').css('left',title_left + custom_left);
	$('.custom').css('top',grid_top * 10);

	$('.study').css('left',grid_left * 17);
	$('.study').css('top',grid_top * 7);
	$('.save').css('left',grid_left * 7);
	$('.save').css('top',grid_top * 8);
}