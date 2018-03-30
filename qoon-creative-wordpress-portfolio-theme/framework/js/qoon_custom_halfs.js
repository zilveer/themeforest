jQuery.noConflict()(function($){
	"use strict";
		$('#menu_slide_xs').click(function(e) {
	e.preventDefault();
	$('#nav-toggle').toggleClass("active");
	$('body').toggleClass("show_xs_menu");
})
		$('.oi_crea_a').click(function(e) {
		var first = $('.oi_creative_p_content').attr('data-first');
		var last = $('.oi_creative_p_content').attr('data-last');
		if($('#oi_current_image_shortcode').length){
			var img = $('#oi_current_image_shortcode').css('background-image');
			img = img.replace('url("','"').replace(')','');
		}else{
			var img = $('#oi_current_image').attr('style');
		}
		var id = $(this).attr('data-id');
		var tempurl = oi_theme.theme_url;
		var url = tempurl+'/framework/ajax-c.php';
		$('.oi_creative_p_content').animate({'opacity': 0,'bottom':'100px'	}, 100);
		$.get
			  (
			  url,"id="+id+"&first="+first+"&last="+last,function(result,status)
				{
					$(result.new_posts).imagesLoaded( function(){
						if($('#oi_current_image_shortcode').length){
							$('#oi_current_image_shortcode').css('background-image','url('+img+')');
							$('#oi_next_image_shortcode').css('background-image','url("'+result.new_posts.url+'")')
						}else{
							$('#oi_current_image').attr('style',img);
							$('#oi_next_image').attr('style','background:url("'+result.new_posts.url+'")')
						}
						
						$('.oi_creative_p_content').css({'bottom':'50px'})
						
						$('.oi_prev_c_p').attr('data-id',result.new_posts.prev);
						$('.oi_next_c_p').attr('data-id',result.new_posts.next);
						$('.oi_c_title a').html(result.new_posts.title);
						$('.oi_c_date').html(result.new_posts.date);
						$('.oi_c_cats').html(result.new_posts.cat);
						$('.oi_c_description_content').html(result.new_posts.descr);
						$('.oi_c_details').attr('href',result.new_posts.details);
						$('.oi_c_title a').attr('href',result.new_posts.details);
						$('.oi_c_title a').attr('data-id',result.new_posts.cur);
						$('.oi_c_details').attr('data-id',result.new_posts.cur);
						if($('#oi_current_image_shortcode').length){
							$('#oi_next_image_shortcode').animate({'opacity': 1}, 600);
							setTimeout(function(){$('#oi_current_image_shortcode').css('background-image','url("'+result.new_posts.url+'")')}, 560);
							setTimeout(function(){$('#oi_next_image_shortcode').animate({'opacity': 0}, 100)}, 600);
						}else{
							$('#oi_next_image').animate({'opacity': 1}, 600);
							setTimeout(function(){$('#oi_current_image').attr('style','background:url("'+result.new_posts.url+'")')}, 560);
						}
						setTimeout(function(){$('.oi_creative_p_content').animate({'opacity': 1}, 300)}, 360);
						
						
					});
				},
			  "json"
			 );
		e.preventDefault();
	});
	$('.oi_left_half').css('margin-bottom',$('.fixed_footer').outerHeight())
});