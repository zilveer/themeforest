<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry clearfix'); ?> role="article">
		
		<?php mnky_post_links(); ?>
		
		<?php 
		$args = array(
			'post_type' => 'attachment',
			'numberposts' => -1,
			'post_status' => null,
			'post_parent' => $post->ID
		);

		$attachments = get_posts( $args );
		
		if ( $attachments ) {
			wp_enqueue_style('flexslider');
			wp_enqueue_script('flexslider');
						
			echo '
			<script>
				jQuery(window).load(function() {
					jQuery(".gallery-slider").flexslider({
						animation: "'.wp_kses_post(get_post_meta( get_the_ID(), 'gallery_animation', true )).'",
						slideshowSpeed: "'.wp_kses_post(get_post_meta( get_the_ID(), 'gallery_delay', true )).'",
					});
				});
			</script>';
			
			if( function_exists( 'aq_resize' ) ){
				echo '<div class="post-preview"><div class="gallery-slider flexslider"><ul class="slides">';
				foreach ( $attachments as $attachment ) {
					$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'large' );

					echo '<li>';
						echo '<img alt="'.esc_attr(get_the_title()).'" src="'. aq_resize( $image_attributes[0], 800, wp_kses_post(get_post_meta( get_the_ID(), 'gallery_height', true )), true, true, true ) .'"/>';
					echo '</li>';
				}
				echo '</ul></div></div>';
			} else {
				echo '<div class="post-preview-error"><h5>';
					$url = admin_url( 'themes.php?page=tgmpa-install-plugins' );
					$link = sprintf( __( 'Please install <a href="%s" >MNKY Theme Core Extend</a> plugin to enable this feature!', 'care' ), esc_url( $url ) );
					echo $link;
				echo '</h5></div>';
			}
		}
		?>
		
		<?php if ( !is_single() ) : ?>
		<header class="post-entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'care' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php mnky_post_meta(); ?>
		</header><!-- .entry-header -->
		<?php endif; ?>
		
		<?php if( is_single() ) : ?>
			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'care' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
				?>
			</div><!-- .entry-content -->
		<?php elseif( is_search() ) : ?>
			<div class="entry-summary">

			</div><!-- .entry-summary -->		
		<?php else : ?>
			<div class="entry-summary">
				<?php if ( ot_get_option('content_type') != 'excerpt') : ?>
					<?php 
					$more_link_text = __('Read more','care');
					the_content($more_link_text);
					?>
				<?php else : ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</div><!-- .entry-summary -->
		<?php endif; ?>
		
		<?php mnky_post_meta_footer(); ?>

	</article><!-- #post-<?php the_ID(); ?> -->