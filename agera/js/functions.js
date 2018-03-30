jQuery.noConflict();
jQuery(document).ready(function($) {
	
	$('.menu > li:first-child').addClass('first-item');
	$('.menu > li:last-child').addClass('last-item');
	
	$('.sub-menu li:first-child').addClass('first-item');
	$('.sub-menu li:last-child').addClass('last-item');
	
	$('#agera_footer li:first-child').addClass('first');
	$('#agera_footer li:last-child').addClass('last');
	
	//$("a.mpc-fancybox").fancybox();
	
	$("a.mpc-fancybox").click(function() {
		$this = $(this);
		/* Lighbox Image */
		if($this.hasClass('mpc-image')) {
			$.fancybox({
				'padding' : 0,
				'transitionIn'	: 'fade',
				'transitionOut'	: 'fade',
				'title'			: this.title,
				'href'			: this.href
			});
		/* Lighbox YouTube Video */
		} else if($this.hasClass('mpc-youtube-video')){
			$.fancybox({
				'padding' : 0,
				'autoScale'		: true,
				'transitionIn'	: 'fade',
				'transitionOut'	: 'fade',
				'title'			: this.title,
				'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
				'type'			: 'swf',
				'swf'			: {
				'wmode'				: 'transparent',
				'allowfullscreen'	: 'true'
				}
			});
		/* Lighbox Vimeo Video */
		} else if($this.hasClass('mpc-vimeo-video')){
			$.fancybox({
				'padding' : 0,
				'transitionIn'	: 'fade',
				'autoScale'		: true,
				'transitionOut'	: 'fade',
				'title'			: this.title,
				'href'			: this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1'),
				'type'			: 'swf',
				'swf'			: {
				'wmode'				: 'transparent',
				'allowfullscreen'	: 'true'
				}
			});
		/* Lighbox iFrame */
		} else if($this.hasClass('mpc-iframe')){
			$.fancybox({
				'padding'			 : 0,
				'width'				: '75%',
				'height'			: '75%',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'title'				: this.title,
				'href'				: this.href,
				'type'				: 'iframe'
			});
		/* Lighbox SWF */
		} else if($this.hasClass('mpc-swf')){
			$.fancybox({
				'padding' 			: 0,
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'title'				: this.title,
				'href'				: this.href,
				'type'				: 'swf'
			});
		}

		return false;
	});

	var biggestHeight = 0;
		$('.port_equal_columns').each(function(){
			if($(this).height() > biggestHeight){
			biggestHeight = $(this).height();
			}
		});
	

	$('#cancel-comment-reply-link').click(function(){
		$('#respond').css('display', 'none');
		$('#respond').fadeIn();
	});
	
	$('.comment-reply-link').click(function(){
		$('#respond').css('display', 'none');
		$('#respond').fadeIn();
	});

	
	$("ul.sub-menu").parents().addClass('parent_menu_item');


	// main menu functions
	$(".menu ul").css({display: "none"}); 
	
	$(".menu li").hover(function() {
		$(this).find('ul:first').css({
			visibility: "visible",
			display: "none"
		}).fadeIn();
	}, function() {
		$(this).find('ul:first').delay(500).css({
			visibility: "hidden"
		});
	});

	$("ul.sub-menu li").hover(function() {
		$(this).find('ul.sub-menu').css('left', $(this).width() + 23);
	});	
	
	// Create the dropdown base
	$('#slogan').after('<select id="nav-select"/>');
	
	// Populate dropdown with menu items
	$('#nav a').each(function() {
	 var el = $(this);
	 $('<option />', {
	     'value'   : el.attr('href'),
	     'text'    : el.text()
	 }).appendTo('#nav-select');
	});	
	
	$('#nav-select').find('option').each( function(){
		var $this = $(this);
		if($(location).attr('href') == $this.val()){
			$this.attr('selected', 'selected');
		}
	});
	
	$("#nav-select").change(function() {
		window.location = $(this).find("option:selected").val();
		
	});
});
	
	