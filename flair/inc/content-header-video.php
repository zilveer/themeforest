<?php  
	/**
	 * All variables in here are being brought from /page_builder_blocks/header_block.php
	 * This is a separate file so that you can override it easily from your child theme.
	 */
?>

<section id="home" class="wallpapered video-section" data-wallpaper-options='{"source":{
		"webm":"<?php echo $webm; ?>",
		"mp4":"<?php echo $mpfour; ?>",
		"ogg":"<?php echo $ogg; ?>",
		"poster":"<?php echo $image; ?>"}}'>
		
		<div class="video_overlay">	
		
			<?php include( locate_template('inc/content-header-titles.php') ); ?>
		
		</div>	
		
</section>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#home').css({ height: $(window).innerHeight() });
		
		$(window).resize(function(){
			$('#home').css({ height: $(window).innerHeight() });
		});  
		$(window).on('resize', function resize()  {
		    $(window).off('resize', resize);
		    setTimeout(function () {
		        var content = $('#content');
		        var top = (window.innerHeight - content.height()) / 2;
		        content.css('top', Math.max(0, top) + 'px');
		        $(window).on('resize', resize);
		    }, 50);
		}).resize();
	});
</script> 