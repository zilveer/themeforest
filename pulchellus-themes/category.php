<?php
	get_header();
	get_template_part(THEME_INCLUDES."top");
	wp_reset_query();
?>
<?php
	wp_reset_query();
	$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
	$sidebarPositionCustom = get_post_meta ( df_page_id(), THEME_NAME."_sidebar_position", true ); 
?>
	<?php 
		if( $sidebarPosition == "left" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "left") ) { 
			get_template_part(THEME_INCLUDES."sidebar");
		}
	?>
			
    <div id="primary" class="eleven columns">
		<?php 
			global $query_string; 
			$counter=1;
		?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php
			global $more; $more = false;							
		?>
		<?php
			if(get_option(THEME_NAME."_show_first_thumb") == "on") {
				$image = get_post_thumb($post->ID,640,300);
				$imageBig = get_post_thumb($post->ID,640,'');
			}
		?>
    	<!-- Post -->
    	<article <?php post_class("entry-post"); ?> id="post-<?php the_ID(); ?>">
			<?php if($image['show']==true) { ?>
				<div class="entry-thumb hover-image">
					<a class="fancybox" href="<?php echo $imageBig['src'];?>"><img src="<?php echo $image['src'];?>" alt="<?php the_title();?>"></a>
				</div>
			<?php } ?>
			<h3 class="entry-title">
				<a href="<?php the_permalink();?>"><?php the_title();?></a>
			</h3>
            <ul class="entry-meta">
            	<li class="posted-author"><?php echo the_author_posts_link();?></li>
                <li class="posted-date"><?php the_time("F d, Y");?></li>
                <li class="posted-tags">
					<?php 
						$categories = get_the_category($post->ID);
						$catCount = count($categories);
						$counter=1;
						foreach ($categories as $categorie) {
					?>
						<a href="<?php echo get_category_link($categorie->term_id);?>"><?php echo $categorie->name;?></a><?php if($counter!=$catCount) echo ", ";?>
						<?php $counter++; ?>
					<?php } ?>

				</li>
            </ul>
            <div class="entry-content">
				<?php $content = get_the_content();?>
				<?php if(get_option(THEME_NAME."_show_first_pictures") == "off" || !get_option(THEME_NAME."_show_first_pictures")) { $content = remove_images($content); } ?>
				<?php if(get_option(THEME_NAME."_show_first_objects") == "off" || !get_option(THEME_NAME."_show_first_objects")) { $content = remove_objects($content);} ?>
				<p><?php echo WordLimiter($content,40);?></p>					
				<p><a href="<?php the_permalink();?>" class="more-link"><?php _e("Read more",THEME_NAME);?></a></p>

			</div>
        </article>

		<?php $counter++; ?>
		<?php endwhile; else: ?>
			<p><?php printf ( __('No posts were found', THEME_NAME)); ?></p>
		<?php endif; ?>
		<?php
			if (is_search()) {
				global $query_string;
					customized_nav_btns($paged, $wp_query->max_num_pages, $query_string);
			} else {
				customized_nav_btns($paged, $wp_query->max_num_pages);
			} 
		?>
        
    </div>

	<?php 
		if( $sidebarPosition == "right" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "right") ) { 
			get_template_part(THEME_INCLUDES."sidebar");
		} else if ( $sidebarPosition == "custom" && !$sidebarPositionCustom ) {
			get_template_part(THEME_INCLUDES."sidebar");
		}
	?>
</div>
<!-- InstanceEndEditable -->
<!-- End Main Content -->
<?php 
	get_footer();
?>