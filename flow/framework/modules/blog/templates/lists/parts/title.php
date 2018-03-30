<?php
	if(isset($title_tag)){
		
		$title_tag = $title_tag;
		
	}else {
		
		$title_tag = 'h3';
		
	}
	$link_class = '';
	$target = '_self';
	$post_link = flow_elated_get_post_link();

	if(isset($external_link) && $external_link !== '') {
		
		$target = $link_target;
		$link_class = 'eltd-external-link'; //link type on expanding tiles should be open in new tab
		$post_link = $external_link;

	}
		
	

?>
<<?php echo esc_attr($title_tag);?> class="eltd-post-title">
<a href="<?php echo esc_html($post_link); ?>" class="<?php echo esc_attr($link_class)?>" title="<?php the_title_attribute(); ?>" target="<?php echo esc_attr($target)?>">
	<?php the_title(); ?>
</a>
</<?php echo esc_attr($title_tag);?>>