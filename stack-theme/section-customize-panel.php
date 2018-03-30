<script type="text/javascript">
//<![CDATA[ 
	jQuery(document).ready(function($) {
		
		// Layout
		$('[name="custom-layout"]').change(function(){
			$('#layout').removeClass().addClass( $(this).val() );
			$(window).trigger('resize');

			if( $(this).val() == 'boxed' ){
				if( $('#customize-background-pattern li.active').length + $('#customize-background-image li.active').length == 0 ) {
					$('#customize-background-pattern li:first-child').trigger('click');
				}
			}
		});

		// Color
		$('#primary-color-custom').iris({
		    palettes: ['#ad0000', '#ff6600', '#70b001', '#00ad8d', '#008abc', '#600089', '#bc0054', '#333333'],
		    change: function(event, ui) {
		        $(this).siblings('.color-indicator').css('background-color', ui.color.toString());

		        // Color
		        $(document).contents().find('head').append('<style type="text/css"> a, .color-scheme, .dropcap, header.dark #social-box a, header.dark #social-box form input, .stack-callout em, .stack-callout.bg-dark .button-primary, ul.price-list li.row-price sup, ul.price-list li.row-price em, header.light #primary-nav a:hover, header.dark #primary-nav ul li a:hover, .stack-callout.bg-dark .callout-icon, .feature-title i, .widget-title .word1, .stack-section-title h1 em { color: '+ui.color.toString()+';} </style>');
		        // Background
		        $(document).contents().find('head').append('<style type="text/css"> header.dark, .skill-score, ul.filter-button-list li a, .slide-control:hover a.has-sub, .button-primary, .stack-callout.bg-dark, .stack-section-title.bg-dark,	ul.price-list li.row-title, .stack-callout.bg-light .callout-icon, .post-content .slide-control a:hover, .button:hover, .button.active, .post-content .img-box .overlay .overlay-mask, #comments .comment-reply-link:hover, #comments .comment-edit-link:hover, .theme-form input[type="submit"], .theme-form input[type="submit"]:hover { background-color: '+ui.color.toString()+';} </style>');
		        // Border
		        $(document).contents().find('head').append('<style type="text/css"> header.light, aside .widget_pages ul li.current_page_item > a, .img-box:hover .overlay-always, aside .widget_sub_nav ul li.current_page_item > a, aside .widget_nav_menu ul li.current_page_item > a, aside .widget_pages ul li.current_page_item > a { border-color: '+ui.color.toString()+';} </style>');
		        
		    }
		});
		$('#bg-color-custom').iris({
		    palettes: ['#ad0000', '#ff6600', '#70b001', '#00ad8d', '#008abc', '#600089', '#bc0054', '#333333'],
		    change: function(event, ui) {
		        $(this).siblings('.color-indicator').css('background-color', ui.color.toString());
		        $('body').css('background-color', ui.color.toString()).css('background-image', 'none');
		    }
		});
		$(document).on('mousedown', function(ev){
			if ( $(ev.target).closest('.iris-picker').length == 0
				&& $(ev.target).siblings('.iris-picker').length == 0 ) {
				$('.iris-picker').hide();
			}
		});
		$('.input-color').focus(function(){
			$(this).iris('show');
		});
		
		// Header Style
		$('[name="custom-header-style"]').change(function(){
			$('header').removeClass().addClass( $(this).val() );
			if( $(this).val() == 'dark' ) {
				$('img', '#branding').each(function(){
					$(this).attr('src', $(this).attr('src').replace('stack-logo', 'stack-logo-white'));
				});
			} else {
				$('img', '#branding').each(function(){
					$(this).attr('src', $(this).attr('src').replace('stack-logo-white', 'stack-logo'));
				});
			}
		});

		// Background Pattern
		$('#customize-background-pattern li').click(function(){
			$('.customize-list li.active').removeClass('active');
			$(this).addClass('active');
			$('body').css('background-size', 'auto');
			$('body').css('background-attachment', 'fixed');
			if( $(this).data('src') ) {
				$('body').css('background-image', 'url(' + $(this).data('src') + ')' );
			} else {
				$('body').css('background-image', 'none' );
			}
		});

		// Background Image
		$('#customize-background-image li').click(function(){
			$('.customize-list li.active').removeClass('active');
			$(this).addClass('active');
			$('body').css('background-image', 'url(' + $(this).data('src') + ')' );
			$('body').css('background-size', 'cover');
			$('body').css('background-attachment', 'fixed');
		});
		
		// Customize Box
		$('#customize-box-open').click(function(){
			if( $('#customize-box').hasClass('open') ) {
				$('#customize-box').stop().animate({
					left: '-252'
				}, 500);
			} else {
				$('#customize-box').stop().animate({
					left: '0'
				}, 500);
			}
			$('#customize-box').toggleClass('open');
		});
			
	});
//]]>		
</script>
<!-- End - Home Slide JS -->

<div id="customize-box" class="">
<div id="customize-box-wrap">

<section class="customize-section">
<div class="customize-title">Appearance</div>

	<div class="customize-item-title">Layout</div>
	<div class="customize-item">
		<input type="radio" id="custom-layout-full-width" name="custom-layout" value="full-width" checked /><label for="custom-layout-full-width">Full Width</label> 
		<input type="radio" name="custom-layout" id="custom-layout-boxed" value="boxed" /><label for="custom-layout-boxed">Boxed</label>
	</div>

	<div class="customize-item-title">Primary Color</div>
	<div class="customize-item">
		<div class="color-indicator" style="background:#ff6600;"></div><input type="text" class="input-color" id="primary-color-custom" value="#ff6600" />
	</div>

</section>

<section class="customize-section">
<div class="customize-title">Header</div>

	<div class="customize-item">
		<input type="radio" id="custom-header-style-light" name="custom-header-style" value="light" /><label for="custom-header-style-light">Light</label> 
		<input type="radio" name="custom-header-style" id="custom-header-style-dark" value="dark" checked /><label for="custom-header-style-dark">Dark</label>
	</div>

</section>

<section class="customize-section">
<div class="customize-title">Background</div>

	<div class="customize-item-title">Color</div>
	<div class="customize-item">
		<div class="color-indicator"></div><input type="text" class="input-color" id="bg-color-custom" value="#eeeeee" />
	</div>

	<div class="customize-item-title">Pattern</div>
	<div class="customize-item">
		<ul class="customize-list" id="customize-background-pattern">
			<li data-src="<?php echo THEME_URI; ?>/images/patterns/bedge_grunge.png" style="background-image:url(<?php echo THEME_URI; ?>/images/patterns/sample/bedge_grunge.png);"></li>
			<li data-src="<?php echo THEME_URI; ?>/images/patterns/wood_pattern.png" style="background-image:url(<?php echo THEME_URI; ?>/images/patterns/sample/wood_pattern.png);"></li>
			<li data-src="<?php echo THEME_URI; ?>/images/patterns/agsquare.png" style="background-image:url(<?php echo THEME_URI; ?>/images/patterns/sample/agsquare.png);"></li>
			<li data-src="<?php echo THEME_URI; ?>/images/patterns/diamond_upholstery.png" style="background-image:url(<?php echo THEME_URI; ?>/images/patterns/sample/diamond_upholstery.png);"></li>
			<li data-src="<?php echo THEME_URI; ?>/images/patterns/noisy_grid.png" style="background-image:url(<?php echo THEME_URI; ?>/images/patterns/sample/noisy_grid.png);"></li>
			<li data-src="<?php echo THEME_URI; ?>/images/patterns/low_contrast_linen.png" style="background-image:url(<?php echo THEME_URI; ?>/images/patterns/sample/low_contrast_linen.png);"></li>
			<li data-src="<?php echo THEME_URI; ?>/images/patterns/square_bg.png" style="background-image:url(<?php echo THEME_URI; ?>/images/patterns/sample/square_bg.png);"></li>
			<li data-src="<?php echo THEME_URI; ?>/images/patterns/subtle_freckles.png" style="background-image:url(<?php echo THEME_URI; ?>/images/patterns/sample/subtle_freckles.png);"></li>
			<li data-src="<?php echo THEME_URI; ?>/images/patterns/subtle_white_feathers.png" style="background-image:url(<?php echo THEME_URI; ?>/images/patterns/sample/subtle_white_feathers.png);"></li>
			<li data-src="<?php echo THEME_URI; ?>/images/patterns/subtle_grunge.png" style="background-image:url(<?php echo THEME_URI; ?>/images/patterns/sample/subtle_grunge.png);"></li>
			<li data-src="<?php echo THEME_URI; ?>/images/patterns/wavegrid.png" style="background-image:url(<?php echo THEME_URI; ?>/images/patterns/sample/wavegrid.png);"></li>
			<li data-src="<?php echo THEME_URI; ?>/images/patterns/extra_clean_paper.png" style="background-image:url(<?php echo THEME_URI; ?>/images/patterns/sample/extra_clean_paper.png);"></li>

		</ul>
	</div>
	<div class="clear"></div>

	<div class="customize-item-title">Image</div>
	<div class="customize-item">
		<ul class="customize-list" id="customize-background-image">
			<li data-src="<?php echo get_site_url(); ?>/wp-content/uploads/2013/05/3035525037_cf67d9c64f_b.jpg" style="background-image:url(<?php echo get_site_url(); ?>/wp-content/uploads/2013/05/3035525037_cf67d9c64f_b-120x90.jpg);"></li>
			<li data-src="<?php echo get_site_url(); ?>/wp-content/uploads/2013/05/fx.jpg" style="background-image:url(<?php echo get_site_url(); ?>/wp-content/uploads/2013/05/fx-120x90.jpg);"></li>

		</ul>
	</div>
	<div class="clear"></div>
</section>

</div><!-- #customize-box-wrap -->

<div id="customize-box-open">
	<i class="icon icon-cog"></i>
	<i class="icon icon-times"></i>
</div>

</div><!-- #customize-box -->