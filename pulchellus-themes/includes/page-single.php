<?php
	wp_reset_query();
	$singleImage = get_post_meta( $post->ID, THEME_NAME."_single_image", true );
	if(get_option(THEME_NAME."_show_single_thumb") == "on"  && $singleImage=="show" || !$singleImage) {
		$image = get_post_thumb($post->ID,640,300);
	} else {
		$image = false;
	}
	$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
	$sidebarPositionCustom = get_post_meta ( df_page_id(), THEME_NAME."_sidebar_position", true ); 

?>
	<?php 
		if( $sidebarPosition == "left" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "left") ) { 
			get_template_part(THEME_INCLUDES."sidebar");
		}
		wp_reset_query();
	?>


    <!-- Primary content -->
    <div id="primary" class="eleven columns">
		<?php if (have_posts()) : ?>
    	<!-- Post -->
    	<article <?php post_class("entry-post"); ?>>
		
			<?php if($image['show']==true) { ?>
				<div class="entry-thumb">
					<img src="<?php echo $image['src'];?>" alt="<?php the_title(); ?>" class="image-polaroid">
				</div>
			<?php } ?>
            
            <h2 class="entry-title">
            	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>

            <div class="entry-content">
				<?php the_content(); ?>			
			</div>
        </article>
        
		<?php wp_reset_query(); ?>
		<?php if ( comments_open() ) : ?>

			<?php comments_template(); // Get comments.php template ?>

		<?php endif; ?>

		<?php else: ?>
			<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
		<?php endif; ?>
        
    </div>
	
	<?php 
		if( $sidebarPosition == "right" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "right") ) { 
			get_template_part(THEME_INCLUDES."sidebar");
		} else if ( $sidebarPosition == "custom" && !$sidebarPositionCustom ) {
			get_template_part(THEME_INCLUDES."sidebar");
		}
	?>
	</div>