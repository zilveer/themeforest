<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			content-search.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-search anim-css" data-delay="100">
		<header class="entry-header">
			<?php 
				// Get post type info
				$pt = get_post_type( get_the_ID() );
				$from = __( 'Blog', SPECTRA_THEME );
				$taxonomy = '';

				switch ( $pt ) {

					case 'post':
						$from = __( 'Blog', SPECTRA_THEME );
						$taxonomy = 'category';
						break;

					case 'spectra_events':
						$from = __( 'Event', SPECTRA_THEME );
						$taxonomy = 'spectra_event_categories';
						break;
					
					case 'spectra_portfolio':
						$from = __( 'Portfolio', SPECTRA_THEME );
						$taxonomy = 'spectra_portfolio_cats';
						break;
					case 'page':
						$from = __( 'Page', SPECTRA_THEME );
						$taxonomy = '';
						break;
				}

			 ?>
		
			<span class="post-type"><?php echo esc_html( $from ) ?></span>
			<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>

			<div class="entry-meta">
				<div class="meta-posted-by"><?php _e( 'Posted by: ', SPECTRA_THEME ) ?> <?php the_author_link() ?></div>
				<div class="meta-categories"><?php _e( 'Categories: ', SPECTRA_THEME ) ?>
				<?php 
					if ( $taxonomy !== '' ) {
						$check_tax = get_the_term_list( get_the_ID(), $taxonomy, '', ' &bull; ', '' );
						if ( ! is_wp_error( $check_tax) ){
							echo get_the_term_list( get_the_ID(), $taxonomy, '', ' &bull; ', '' );
						}
					} else {
						_e( 'Page', SPECTRA_THEME );
					}

				 ?>

				</div>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

	</div><!-- .entry -->

</article><!-- #post-## -->