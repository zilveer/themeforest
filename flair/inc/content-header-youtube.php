<?php  
	/**
	 * All variables in here are being brought from /page_builder_blocks/header_block.php
	 * This is a separate file so that you can override it easily from your child theme.
	 */
?>

<section id="home" class="top_video" style="background-image: url(<?php echo $image; ?>);">

	<div id="overlay"></div>
		
	<div id="BigVideo" class="player" data-property="{videoURL:'<?php echo $youtube; ?>', containment:'.top_video', autoPlay:true, mute:true, opacity:1, showControls : false}"></div>	

	<?php include( locate_template('inc/content-header-titles.php') ); ?>
		
</section>

<script type="text/javascript">
jQuery(window).load(function(){
	jQuery(function(){
    	jQuery(".player").mb_YTPlayer();
    });
});
</script>