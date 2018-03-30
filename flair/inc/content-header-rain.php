<?php  
	/**
	 * All variables in here are being brought from /page_builder_blocks/header_block.php
	 * This is a separate file so that you can override it easily from your child theme.
	 */
?>

<section id="home" class="rain">

	<?php include( locate_template('inc/content-header-titles.php') ); ?>	
	
	<?php if( $image ) : ?>	
		<div id="parent">
			<img id="background" src="<?php echo esc_url( $image ); ?>" alt="rain"/>
		</div>
	<?php endif; ?>
	
</section>

<script type="text/javascript">
	jQuery(window).load(function($){
		
		jQuery('#home, #background').css({ height: jQuery(window).height() });
		jQuery('#background').css({ width: jQuery(window).width() });
		
		function rainy_run() {
			var engine = new RainyDay({
				element: 'background',
				blur: 4,
				opacity: 1,
				fps: 40
			});
			engine.rain([ [1, 2, 8000] ]);
			engine.rain([ [3, 3, 0.88], [5, 5, 0.9], [6, 2, 1] ], 100);
		}
		rainy_run();
		
		jQuery(window).resize(function(){
			jQuery('#home, #background').css({ height: jQuery(window).height() });
			jQuery('#background').css({ width: jQuery(window).width() });
		});  
		jQuery(window).on('resize', function resize()  {
		    jQuery(window).off('resize', resize);
		    setTimeout(function () {
		        var content = jQuery('#content');
		        var top = (window.innerHeight - content.height()) / 2;
		        content.css('top', Math.max(0, top) + 'px');
		        jQuery(window).on('resize', resize);
		    }, 50);
		}).resize();
	});
</script>  