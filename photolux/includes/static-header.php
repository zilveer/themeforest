<div id="slider-container" class="center">
<div id="static-header-img">
<?php if(is_page()){ 
	if(function_exists('has_post_thumbnail') && has_post_thumbnail()){ ?>
 <?php the_post_thumbnail('static-header-img'); ?>
<?php } 
 }else{ 
 	global $pex_page;
 	?>
<img src="<?php echo $pex_page->static_image; ?>"/>
<?php } ?>
</div>
</div>