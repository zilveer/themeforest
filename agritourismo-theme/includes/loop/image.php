<?php
	if(!is_page_template('template-homepage.php')) { 
		$width = 200;
		$height = 160;
	} else {
		$width = 78;
		$height = 78;
	}

	$image = get_post_thumb($post->ID,$width,$height); 
	if(get_option(THEME_NAME."_show_first_thumb") == "on" && $image['show']==true) {
?>
	<div class="article-photo left">
		<a href="<?php the_permalink();?>" class="photo-border-1">
			<?php echo ot_image_html($post->ID,$width,$height); ?>
		</a>
	</div>
<?php } ?>