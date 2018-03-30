<div id="blogNav">
	<?php if(is_single()){
		previous_post_link('%link', '&rarr;', TRUE); 
		next_post_link('%link', '&larr;', TRUE);
	} elseif(is_category() || is_search()){
		next_posts_link('&rarr;');
		previous_posts_link('&larr;');
	}
	if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();?>
</div>

<div id="leftBg" class="bigBg"></div>
<div id="rightBg" class="bigBg"></div>

<div id="mesh"></div>

</div><!--end pageContent-->

<?php wp_footer(); ?>

<script>
jQuery.noConflict(); jQuery(document).ready(function(){
		
	<?php
	//DEFAULT BACKGROUND
	$background = get_theme_mod('themolitor_customizer_bg');

	//IF CUSTOM BACKGROUND
	if(is_single() || is_page() || is_front_page()) {
		$data = get_post_meta( $post->ID, 'key', true );
		if ($data[ 'background' ]) { 
			$background = $data[ 'background' ];
		}
	//IF CATEGORY BACKGROUND
	} elseif(is_category() && category_description()){
		$background = category_description();
	}
	//IF NOT GALLERY PAGE
	if(!is_page_template('page_gallery.php')){?>
	
		//LOAD BACKGROUND
		jQuery.backstretch("<?php echo $background;?>", {speed: 300});
		
	<?php } ?>
	
});
</script>

</body>
</html>