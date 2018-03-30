<?php
/**
 * The template for displaying posts in the Image post format
 *
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry clearfix'); ?> role="article">
	
		<?php mnky_post_links(); ?>
			
		<?php 	
		$img_url = esc_url(wp_get_attachment_url( get_post_thumbnail_id($post->ID) )); 
		
		if( get_post_meta( get_the_ID(), 'image_embed', true ) ) { 
			global $wp_embed;
			$embed = $wp_embed->run_shortcode('[embed width="800"]'.wp_kses_post(get_post_meta( get_the_ID(), 'image_embed', true )).'[/embed]');
			echo '<div class="post-preview">'. $embed .'</div>';
		} elseif( $img_url != '' ){
			if( is_single() ){
				echo '<div class="post-preview">'. get_the_post_thumbnail($post->ID, "large") .'</div>';
			} else {
				if( function_exists( 'aq_resize' ) ){
					echo '<div class="post-preview"><a href="'. esc_url(get_permalink()) .'" class="local-image"><img alt="'.esc_attr(get_the_title()).'" src="'. aq_resize($img_url, 800, 400, true, true, true) .'" /></a></div>';
				} else {
					echo '<div class="post-preview-error"><h5>';
						$url = admin_url( 'themes.php?page=tgmpa-install-plugins' );
						$link = sprintf( __( 'Please install <a href="%s" >MNKY Theme Core Extend</a> plugin to enable this feature!', 'craftsman' ), esc_url( $url ) );
						echo $link;
					echo '</h5></div>';
				}
			}
		}
		
		?>
		
		<?php if ( !is_single() ) : ?>
			<header class="post-entry-header">
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'craftsman' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				<?php mnky_post_meta(); ?>
			</header><!-- .entry-header -->
		<?php endif; ?>

		<?php if( is_single() ) : ?>
			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'craftsman' ) . '</span>',
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
					$more_link_text = __('Read more','craftsman');
					the_content($more_link_text);
					?>
				<?php else : ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</div><!-- .entry-summary -->
		<?php endif; ?>
		
		<?php mnky_post_meta_footer(); ?>

	</article><!-- #post-<?php the_ID(); ?> -->