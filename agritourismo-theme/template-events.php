<?php
/*
Template Name: Events Page
*/	
?>
<?php get_header(); ?>
<?php get_template_part(THEME_INCLUDES.'top'); ?>
<?php
	wp_reset_query();
	$paged = get_query_string_paged();
	$posts_per_page = get_post_meta ( $post->ID, THEME_NAME."_events_items", true ); 
	
	$postAge = get_post_meta (OT_page_id(), THEME_NAME."_post_age", true );
	$now = time();
	$compare = $now-($postAge*24*60*60);

	if($posts_per_page == "") {
		$posts_per_page = get_option('posts_per_page');
	}
	$catSlug = $wp_query->queried_object->slug;
	if(!$catSlug) {
		$title = get_the_title();
		$my_query = new WP_Query(
			array(
				'post_type' => 'events-item', 
				'posts_per_page' => $posts_per_page, 
				'paged'=>$paged,
				'order' => 'ASC',
				'orderby'	=> 'meta_value_num',
				'meta_key'	=> THEME_NAME.'_datepicker',
				'meta_query' => array(
				    array(
				        'key' => THEME_NAME.'_datepicker',
				        'value'   => $compare,
				        'compare'   => '>='
				    )
				),
			)
		); 
	} else {
		$title = $wp_query->queried_object->name;
		$my_query = new WP_Query(
			array(
				'post_type' => 'events-item', 
				'posts_per_page' => $posts_per_page, 
				'paged'=>$paged,				
				'order' => 'ASC',
				'orderby'	=> 'meta_value_num',
				'meta_key'	=> THEME_NAME.'_datepicker', 
				'meta_query' => array(
				    array(
				        'key' => THEME_NAME.'_datepicker',
				        'value'   => $compare,
				        'compare'   => '>='
				    )
				),
				'tax_query' => array(
					array(
						'taxonomy' => 'events-cat',
						'field' => 'slug',
						'terms' => $catSlug
					)
				)
			)
		); 
	}
	
	$postCount = $my_query->post_count;

	$counter = 1;

?>
<?php get_template_part(THEME_LOOP."loop","start"); ?>
	<?php ot_get_sidebar($post->ID, 'left'); ?>	
			<div class="content-main alternate <?php OT_content_class($post->ID);?>">

				<?php get_template_part(THEME_SINGLE."page","title"); ?>

				<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
					<?php get_template_part(THEME_LOOP."event"); ?>
					<?php $counter++; ?>
					<?php endwhile; ?>
				<?php else : ?>
						<?php get_template_part(THEME_LOOP."no","post"); ?>
				<?php endif; ?>
				<?php customized_nav_btns($paged, $my_query->max_num_pages); ?>
			<!-- END .content-main -->
			</div>
	<?php ot_get_sidebar($post->ID, 'right'); ?>	
<?php get_template_part(THEME_LOOP."loop","end"); ?>
<?php get_footer(); ?>