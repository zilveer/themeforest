<?php
/**
 * Template Name: Page: Events
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
get_header();

$items = rwmb_meta('sd_ev_items');

$items = ( ! empty( $items ) ? $items : '6' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-full-width clearfix' ); ?>> 
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<!-- entry-content -->
</article>

<?php
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	$today = current_time( 'timestamp' );
		
	$args = array(
		'post_type'           => 'events',
		'paged'               => $paged,
		'posts_per_page'      => $items,
		'ignore_sticky_posts' => 1,
		'post_status'         => 'publish',
		'meta_key'            => 'sd_dov',
		'meta_value'          => $today,
		'meta_compare'        => '>=',
		'orderby'             => 'meta_value',
		'order'               => 'ASC',
	);
	
	$sd_query = new WP_Query( $args );
		
	$i = 0;
?>

<div class="sd-events-listing">
	<div class="container">
		<div class="row">
			<?php if ( $sd_query->have_posts() ) : while ( $sd_query->have_posts() ) : $sd_query->the_post(); $i++; ?>
				<?php 
					$dov     = rwmb_meta( 'sd_dov' );
					$ev_city = rwmb_meta( 'sd_event_city' );
					$ev_date = date_i18n( get_option( 'date_format' ), $dov );
					$ev_time = gmdate( get_option( 'time_format' ), $dov ); 
				
				?>
				<div class="col-md-4 col-sm-4 ev-listing-item">
					<?php if ( has_post_thumbnail() ) : ?>
						<figure>
							<?php the_post_thumbnail( 'sd-campaign-grid' ); ?>
						</figure>
					<?php endif; ?>
					<div class="ev-listing-content">
						<h3 class="sd-entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
						</h3>
						<?php if ( ! empty( $ev_city ) ) : ?>
							<span class="ev-city"><?php echo $ev_city; ?></span>
						<?php endif; ?>
						<p><?php echo substr( get_the_excerpt(), 0, 100 ) . '...'; ?></p>
						<a class="sd-more sd-link-trans" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'READ MORE', 'sd-framework' ); ?></a>
					</div>
					<!-- ev-listing-content -->
					<span class="ev-listing-date"><?php echo $ev_date . _x( ' @ ', 'at time', 'sd-framework' ) . $ev_time; ?></span>
				</div>
				<!-- col-md-4 -->
				<?php if ( $i == '3' ) { echo '<div class="clearfix"></div>'; $i = 0; } ?>
			<?php endwhile; endif;  wp_reset_postdata(); ?>
		</div>
		<!-- row -->
		<?php sd_custom_pagination( $sd_query->max_num_pages ); ?>
	</div>
	<!-- container -->
</div>
<!-- sd-events-listing -->

<?php get_footer(); ?>