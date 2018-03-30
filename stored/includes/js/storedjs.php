<?php
/*
Stored JS
Code and stuff you need for the Stored theme by Design Crumbs
*/
?>
<script type="text/javascript">
/* <![CDATA[  */ 
jQuery(document).ready(function($){
	
	// increase counter on add to cart
	$(document).ajaxComplete(function(event,request, settings) {
		if(JSON.parse(request.responseText).msgId == 0) {
			var currentCount = parseInt($('#header_cart_count').text());
			var newCount = currentCount + parseInt(JSON.parse(request.responseText).requestedQuantity);
			$('#header_cart_count').text(newCount);
		}
	});
	
	// Children Flyout on Menu
	$("#main_menu ul li ul").css({display: "none"}); // Opera Fix
	$("#main_menu ul li").hover(function(){
		$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(300);
		},function(){
		$(this).find('ul:first').css({visibility: "hidden"});
	});
	
	// Fancybox
	$(".lightbox").attr('rel', 'gallery').fancybox();
	
	<?php if (is_front_page()) { ?>
	// The Slider
	$(function(){
		$('#slides').slides({
			preload: true,
			preloadImage: '<?php echo get_template_directory_uri() ?>/images/loading.gif',
			play: 8000,
			pause: 2500,
			hoverPause: false,
			effect: 'fade',
			generateNextPrev: true,
			autoHeight: true
		});
	});
	
	// replaces the slide pagination
	$('.slide_pag_link').click(function(){
		var link = $(this).attr('href').replace('#','');
		$('#slides .pagination li:eq(' + (link - 1) + ') a').click();
		return false;
	});
	
	$('.slide_pag_link img').fadeTo('fast', 0.3);
	$('.slide_pag_link img').hover(function(){
			$(this).fadeTo('fast', 1.0); 
	},function(){
		if($(this).parent().hasClass('current_slide')==false)
	{
		$(this).fadeTo('fast', 0.3);
	}
	});

	<?php } ?>
	
	// Add divs and classes
	$('<div class="clear"></div>').insertAfter('#products_grid .single_grid_product:nth-child(4n)');
	$('<div class="clear"></div>').insertAfter('#archive_grid .single_grid_product:nth-child(3n)');
	$('<div class="clear"></div>').insertAfter('.Cart66ButtonPrimary');
	$('<div class="clear"></div>').insertAfter('.home_widget_overflow .home_widget:nth-child(3n)');
	$('<div class="clear"></div>').insertAfter('#Cart66AccountLogin');	
	
	<?php if (of_get_option('sticky_header') == 'yes') { ?>
	$("#main_menu").sticky({topSpacing:0});
	<?php } ?>

});

/* ]]> */
</script>