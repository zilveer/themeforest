<?php
/**
 * Home Boxes
 *
 * This outputs the homepage boxes (three per row) below the intro
 */

// get home_box items
$home_boxes_query = new WP_Query( array(
	'post_type'			=> 'risen_home_box',
	'posts_per_page'	=> -1, // unlimited (pagination is via JavaScript show/hide)
	'order'				=> 'ASC',
	'orderby'			=> 'menu_order'
) );

// we have content
if ( $home_boxes_query->have_posts() ) :

?>

<div id="home-row-widgets">

	<div class="thumb-grid">	
	
		<?php while ( $home_boxes_query->have_posts() ) : $home_boxes_query->the_post(); // loop home_boxes ?>

			<div class="widget thumb-grid-item image-frame">
				
				<?php
				$click_url = esc_url( trim( do_shortcode( get_post_meta( $post->ID, '_risen_home_box_click_url', true ) ) ) );
				if ( $click_url ) :
				?>
				<a href="<?php echo esc_url( $click_url ); ?>">
				<?php endif; ?>
				
					<div class="thumb-grid-image-container">
						<img src="<?php echo apply_filters( 'risen_thumb_placeholder_url', RISEN_THEME_URI . '/images/thumb-placeholder.png' ); ?>" class="thumb-grid-item-placeholder" alt="">
						<?php the_post_thumbnail( 'risen-big-thumb', array( 'alt' => '', 'title' => '', 'class' => 'thumb-grid-image' ) ); ?>
					</div>
				
					<?php
					$title = trim( strip_tags( get_post_meta( $post->ID, '_risen_home_box_title', true ) ) );
					if ( ! empty( $title ) ) :
					?>
					<div class="widget-image-title">
						<?php echo $title; ?>
					</div>
					<?php endif; ?>
					
				<?php if ( $click_url ) : ?>
				</a>
				<?php endif; ?>
				
			</div>

		<?php endwhile; ?>
		
		<div class="clear"></div>
		
	</div>
	
</div>

<?php

// destroy previous query
wp_reset_postdata();

endif; // end have items

