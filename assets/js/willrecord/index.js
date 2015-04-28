$(document).ready(function(){

	resizeBg();
	$(window).resize(function(event) {
		resizeBg();
	});

	//$('.main').parallax("50%", 0.1);
	//$('.intro_question').parallax("50%", 0);
	$('#question_scene').parallax({
		calibrateX: false,
		calibrateY: false,
		invertX: true,
		invertY: true,
		limitX: false,
		limitY: false,
		scalarX: 10,
		scalarY: 15,
		frictionX: 0.5,
		frictionY: 0.7
	});

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

var scrollpoint = -200;
$(window).bind('scroll',function(e){
	if ( $(window).width() > 460 ) {
		parallaxScroll();
	}
	else{
		var topmiddle = 460 / 4;
		$('.jumbotron').css('top',topmiddle + 'px');
	}
});
function parallaxScroll(){
    var scrolled = $(window).scrollTop();
    var currentTop = parseInt($('.jumbotron').css('top').replace('px',''),10);
    var currentAll = scrolled - $(window).height() * 2
    if (scrolled > $(window).height() * 2 && currentTop < $(window).height() / 3 ) {
    	scrollpoint += 100;
    	$('.jumbotron').css('top',scrollpoint+'px');
    };
}

function project_change(tagflag){
	var defaultArr = [];
	defaultArr['1'] = [];
	defaultArr['2'] = [];
	defaultArr['3'] = [];
	defaultArr['4'] = [];
	defaultArr['5'] = [];

	// 吸煙
	defaultArr['1']['topic'] = '戒除煙酒回歸健康生活。';
	defaultArr['1']['goal1'] = '絕不抽煙！';
	defaultArr['1']['goal2'] = '一週只能喝兩次酒。';
	defaultArr['1']['goal3'] = '每天持續作健身操，轉移注意力！';
	defaultArr['1']['finalgoal'] = '完全戒除煙與酒。';

	// 減重
	defaultArr['2']['topic'] = '瘦身減重大作戰！';
	defaultArr['2']['goal1'] = '每週至少作有氧運動3次，每次至少30分鐘！';
	defaultArr['2']['goal2'] = '避免吃澱粉類及高熱量食物。';
	defaultArr['2']['goal3'] = '每天按摩腹部及腰部，雕塑身材。';
	defaultArr['2']['finalgoal'] = 'BMI下降至正常標準。';

	defaultArr['3']['topic'] = '緞練出結實身材。';
	defaultArr['3']['goal1'] = '每天伏立挺身50下，仰臥起坐50下。';
	defaultArr['3']['goal2'] = '每天慢跑3000公尺。';
	defaultArr['3']['goal3'] = '局部肌肉訓練30分鐘。';
	defaultArr['3']['finalgoal'] = '練出明顯六塊肌、人魚線及其它肌肉線條。';

	defaultArr['4']['topic'] = '一定要上榜！加油加油再加油！';
	defaultArr['4']['goal1'] = '每天至少自主念書兩小時。';
	defaultArr['4']['goal2'] = '絕不接觸任何網路遊戲。';
	defaultArr['4']['goal3'] = '每天放空半小時，沉澱學習內容。';
	defaultArr['4']['finalgoal'] = '考上理想的學校或職業。';

	defaultArr['5']['topic'] = '日本旅遊行！我來囉！';
	defaultArr['5']['goal1'] = '平日不花超過200元。';
	defaultArr['5']['goal2'] = '假日每天不花超過500元。';
	defaultArr['5']['goal3'] = '一週至少兼差一次。';
	defaultArr['5']['finalgoal'] = '存到足夠旅遊日本的錢。';

	$('#project_title').html( defaultArr[tagflag]['topic'] );
	$('#goal1').html( defaultArr[tagflag]['goal1'] );
	$('#goal2').html( defaultArr[tagflag]['goal2'] );
	$('#goal3').html( defaultArr[tagflag]['goal3'] );
	$('#finalgoal').html( defaultArr[tagflag]['finalgoal'] );
}
