<?php get_header(); ?>
	
<div id="page" class="border-top clearfix">

	<div class="color-hr2"></div>
	
	<div id="subtitle">
		
		<h2><span><?php the_title(); ?>.</span> <?php echo get_post_meta( get_the_ID( ), 'minti_subtitle', true ); ?></h2>
		
		<div class="posts-nav">
			<?php previous_post_link('<div class="posts-next">%link</div>', 'Next in category'); ?>
			<?php next_post_link('<div class="posts-prev">%link</div>', 'Prev in category'); ?>  
		</div>
		
	</div>
	
	<div id="content-full" class="clearfix">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
	<div class="clearfix">
	
				<div class="work-detail-thumb">
				
				<?php if( get_post_meta( get_the_ID(), 'minti_embed', true ) == "" ){ ?>
				
				<div id="work-slider" class="flexslider2">
	    			<ul class="slides">
					<?php global $wpdb, $post;
				    $meta = get_post_meta( get_the_ID( ), 'minti_screenshot', false );
				    if ( !is_array( $meta ) )
				    	$meta = ( array ) $meta;
				    if ( !empty( $meta ) ) {
				    	$meta = implode( ',', $meta );
				    	$images = $wpdb->get_col( "
				    	SELECT ID FROM $wpdb->posts
				    	WHERE post_type = 'attachment'
				    	AND ID IN ( $meta )
				    	ORDER BY menu_order ASC
				    	" );
				    	foreach ( $images as $att ) {
				    		// Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
				    		$src = wp_get_attachment_image_src( $att, 'work-detail' );
				    		$src = $src[0];
				    		// Show image
				    		echo "<li><img src='{$src}' /></li>";
				    	}
				    } ?>
			    	</ul>
			    </div>
			    
			    <?php } else { ?>
			    
			    <?php  
			    if (get_post_meta( get_the_ID(), 'minti_source', true ) == 'vimeo') {  
			        echo '<iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'minti_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="600" height="338" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';  
			    }  
			    else if (get_post_meta( get_the_ID(), 'minti_source', true ) == 'youtube') {  
			        echo '<iframe width="600" height="338" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'minti_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe>';  
			    }  
			    else {  
			        echo get_post_meta( get_the_ID(), 'minti_embed', true ); 
			    }  
			    ?>
			    
			    <?php } ?>
			    
				</div>
				
				<div class="work-detail-description">
					<h3><?php the_title(); ?></h3>
					<div class="taxonomy"><?php 
						$taxonomy = strip_tags( get_the_term_list($post->ID, 'filters', '', ', ', '') );
						echo $taxonomy;
					?></div>
					
					<?php the_content(); ?><br />

	
					<?php if( get_post_meta( get_the_ID(), 'minti_link', true ) != "") { ?>
					<a href="<?php echo get_post_meta( get_the_ID(), 'minti_link', true ); ?>" target="_blank" class="button light"><?php _e('Visit Website', 'framework'); ?></a><?php } ?>
				</div>
	
	</div>
	
	
	<?php comments_template(); ?>

	<?php endwhile; endif; ?>
	
	
	</div>
	
	
	
	

</div>

<?php get_footer(); ?>