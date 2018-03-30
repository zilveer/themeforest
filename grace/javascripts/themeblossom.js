jQuery(document).ready(function($) {

	// User Agent
	var nAgt = navigator.userAgent;

	// prettyPhoto
	$('a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg]').each(function()
	{
	
		if($(this).attr('rel') === undefined || $(this).attr('rel') === '')
		{
		
			if ($(this).parent().hasClass('gallery-icon')) {
				$(this).attr('rel', 'prettyPhoto[gallery]');
			} else {
				$(this).attr('rel', 'prettyPhoto');	
			}			
			
		} else {
			if ($(this).hasClass('scale-with-grid')) {
				$(this).attr('rel', 'prettyPhoto');	
			}			
		}
		
		$(this).addClass('imageLink');
	});
	
	$("a[rel^='prettyPhoto']:not('.iframe')").addClass('thumb').addClass('magn');
	$(".thumbnails a.thumb").removeClass('thumb');
	
	$("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'normal',
			slideshow: 4000,
			autoplay_slideshow: false,
			theme: 'facebook'
	});
	
	$("a.thumb img").each(function() {
		if ($(this).hasClass('alignright')) {
			$(this).removeClass('alignright').parent().addClass('alignright');
		} else if ($(this).hasClass('alignleft')) {
			$(this).removeClass('alignleft').parent().addClass('alignleft');
		} else if ($(this).hasClass('aligncenter')) {
			$(this).removeClass('aligncenter').parent().addClass('aligncenter');			
		} else {
			//
		}
	});
	
	
	// it isn't IE 8'

	$("#contentarea a.thumb").hover(function(){
    
        $(this).prepend("<span class='more'><span></span></span>");
        $(this).find("span.more").stop().animate({opacity:0}, 0);
        var sh = $(this).innerHeight()+2;
        var sw = $(this).innerWidth()+2;
      
		if (sh > sw) {
			var hw = sw/2;
		} else {
			var hw = sh/2;
		}
		
        $(this).find("span.more").height('0').width('0').css({'top':sh/2,'left':sw/2,'borderRadius':hw/2}).stop().animate({opacity:1,height:hw,width:hw,top:(sh/2 - hw/2),left:(sw/2 - hw/2)},400,
		
		function(){		
			
			$(this).find("span").css({opacity:1,height:hw,width:hw});
			
		}
);        
		
      
    }, function(){
        $(this).find("span.more span").css({opacity:0});
		$(this).find("span.more").stop().animate({opacity:0},300,
		
		function() { $(this).remove();}
	
	);
       
    });
	
	// Triggers
	$('#phoneNumbersTrigger').click(function() {
		$('#phoneNumbers').fadeToggle();
	});
	
	// Positions
	$('#contentarea div.contentSpacer:last').css({display: 'none'});
	
	// Sidebar
	$('#sidebar .widget_categories li, #sidebar .widget_pages li, #sidebar .widget_archive li, #sidebar .widget_nav_menu li, #sidebar .widget_recent_entries li, #sidebar .widget_recent_comments li, #sidebar .widget_meta li, #sidebar .widget_sermon_menu li, #sidebar .widget_user_login li, #sidebar .product_list_widget li, #sidebar [class*="widget_display"] li').each(function() {
		var tb_link = $(this).find('a');
		var href = tb_link.attr('href');
		var text = tb_link.text();
		
		if (href && text) {
			$(this).addClass('fulldp');
			
			if (!$(this).parent().parent().hasClass('widget_sermon_menu') && !$(this).parent().hasClass('product_list_widget')) {
				$(this).prepend('<span aria-hidden="true" class="icon-stop"></span>');
			}
			
			if (!$(this).parent().parent().hasClass('widget_sermon_menu')) {
				$(this).append('<a href="' + href + '" class="fulld">' + text + '</a>');
			}
		}
	});
	
	// borders, margins, heights
	$('.post:last').addClass('noborder');
	$('.widget-container').each(function() {
		$(this).find('.listPost:last').addClass('noborder');
	});
	
	var allOurMembers = 0;
	$('#allOurMembers .one_third').each(function() {
		var memberHeight = $(this).find('h5').height();
		if (memberHeight > allOurMembers) {
			allOurMembers = memberHeight;
		}
	});
		
	$('#allOurMembers .one_third').each(function() {
		$(this).find('h5').height(allOurMembers);
	});
			
	// Plugins
	// EWDP
	$('p.donation label input[type=text]').each(function() {
		$(this).parent().addClass('padding5');
	});
	
	// MEJS
	$('.mejs-play').addClass('padding5');
	
	/* HIDE AND SHOW */
	$(document).mouseup(function (e)
	{
	    var navSearchForm = $("#navigation #navigationSearchForm");
		
		$("#navigation #navigationSearch").click(function() {
			if (navSearchForm.is(':hidden')) {
				navSearchForm.fadeIn();
			}
		});

	    if (navSearchForm.has(e.target).length === 0)
	    {
	        navSearchForm.fadeOut();
	    }
	});
});



/* SMOOTH SCROLLING */
jQuery(document).ready(function($) {	
    $('.scroll').bind('click',function(event){
        var $anchor = $(this); 
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1000);
        event.preventDefault();
    });
});