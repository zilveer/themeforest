<?php 
	get_header();
?>

<div class="page-heading bc-type-<?php etheme_option('breadcrumb_type'); ?>">
	<div class="container">
		<div class="row-fluid">
			<div class="col-md-12 a-center">
				<?php etheme_breadcrumbs(); ?>
				<h1><?php echo single_cat_title(); ?></h1>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="page-content">
		<div class="row">
			<div class="col-md-8">
				<?php if(have_posts()): while(have_posts()) : the_post(); ?>
					
					<article <?php post_class('blog-post post-single'); ?> id="post-<?php the_ID(); ?>">
						<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="post-info">
							<span class="posted-on">
								<?php _e('Posted on', ETHEME_DOMAIN) ?>
								<?php the_date(get_option('date_format')); ?> 
								<?php _e('at', ETHEME_DOMAIN) ?> 
								<?php the_time(get_option('time_format')); ?>
							</span> 
							<span class="posted-by"> <?php _e('by', ETHEME_DOMAIN);?> <?php the_author_posts_link(); ?></span> / 
							<span class="posted-in"><?php the_category(',&nbsp;') ?></span> 
							<?php // Display Comments 

								if(comments_open() && !post_password_required()) {
									echo ' / ';
									comments_popup_link('0', '1 Comment', '% Comments', 'post-comments-count');
								}

							 ?>
						</div>

                        <?php if ( wp_attachment_is_image() ) :
                        	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
                        	foreach ( $attachments as $k => $attachment ) {
                        		if ( $attachment->ID == $post->ID )
                        			break;
                        	}
                        	$k++;
                        	// If there is more than 1 image attachment in a gallery
                        	if ( count( $attachments ) > 1 ) {
                        		if ( isset( $attachments[ $k ] ) )
                        			// get the URL of the next image attachment
                        			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
                        		else
                        			// or get the URL of the first image attachment
                        			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
                        	} else {
                        		// or, if there's only 1 image attachment, get the URL of the image
                        		$next_attachment_url = wp_get_attachment_url();
                        	}
                        ?>
    						<p class="attachment"><a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
    							$attachment_width  = apply_filters( 'etheme_attachment_size', 900 );
    							$attachment_height = apply_filters( 'etheme_attachment_height', 900 );
    							echo wp_get_attachment_image( $post->ID, array( $attachment_width, $attachment_height ) ); // filterable image width with, essentially, no limit for image height.
    						?></a></p>

							<div class="articles-nav">
								<div class="left"><?php previous_image_link(false); ?></div>
								<div class="right"><?php next_image_link(false); ?></div>
								<div class="clear"></div>
							</div>
							
                        <?php else : ?>
						  <a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
                        <?php endif; ?>


						<?php if (has_tag()): ?>
							<p class="tag-container"><?php the_tags(); ?></p>
						<?php endif ?>
						<div class="post-navigation">
							<?php wp_link_pages(); ?>
						</div>

						<div class="clear"></div>

					</article>

				<?php endwhile; else: ?>

					<h1><?php _e('No posts were found!', ETHEME_DOMAIN) ?></h1>

				<?php endif; ?>

				<?php comments_template('', true); ?>

			</div>
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
		</div>


	</div>
</div>

	
<?php
	get_footer();
?>