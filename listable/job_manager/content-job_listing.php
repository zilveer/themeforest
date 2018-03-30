<?php
/**
 * The template for displaying the WP Job Manager listing on archives
 *
 * @package Listable
 */

global $post;

$taxonomies  = array();
$terms       = get_the_terms( get_the_ID(), 'job_listing_category' );
$termString  = '';
$data_output = '';
if ( ! is_wp_error( $terms ) && ( is_array( $terms ) || is_object( $terms ) ) ) {
	$firstTerm = $terms[0];
	if ( ! $firstTerm == null ) {
		$term_id = $firstTerm->term_id;
		$data_output .= ' data-icon="' . listable_get_term_icon_url( $term_id ) . '"';
		$count = 1;
		foreach ( $terms as $term ) {
			$termString .= $term->name;
			if ( $count != count( $terms ) ) {
				$termString .= ', ';
			}
			$count ++;
		}
	}
}

$listing_classes = 'card  card--listing';
$listing_is_claimed = false;
$listing_is_featured = false;

if ( is_position_featured($post) ) $listing_is_featured = true;

if ( class_exists( 'WP_Job_Manager_Claim_Listing' ) ) {
	$classes = WP_Job_Manager_Claim_Listing()->listing->add_post_class( array(), '', $post->ID );

	if ( isset( $classes[0] ) && ! empty( $classes[0] ) ) {
		$listing_classes .= '  ' . $classes[0];

		if( $classes[0] == 'claimed' )
			$listing_is_claimed = true;
	}
}

if ( true === $listing_is_featured ) $listing_classes .= '  is--featured';

$listing_classes = apply_filters( 'listable_listing_archive_classes', $listing_classes, $post ); ?>
<a class="grid__item" href="<?php the_job_permalink(); ?>">
	<article class="<?php echo esc_attr( $listing_classes ); ?>" itemscope itemtype="http://schema.org/LocalBusiness"
			data-latitude="<?php echo esc_attr( get_post_meta( $post->ID, 'geolocation_lat', true ) ); ?>"
			data-longitude="<?php echo esc_attr( get_post_meta( $post->ID, 'geolocation_long', true ) ); ?>"
			data-img="<?php echo esc_attr( listable_get_post_image_src( $post->ID, 'listable-card-image' ) ); ?>"
			data-permalink="<?php echo esc_attr( get_the_job_permalink() ); ?>"
			data-categories="<?php echo esc_attr( $termString ); ?>"
		<?php echo $data_output; ?> >
		<aside class="card__image" style="background-image: url(<?php echo listable_get_post_image_src( $post->ID, 'listable-card-image' ); ?>);">
			<?php if ( true === $listing_is_featured ): ?>
			<span class="card__featured-tag"><?php esc_html_e( 'Featured', 'listable' ); ?></span>
			<?php endif; ?>

			<?php do_action('listable_job_listing_card_image_top', $post ); ?>

			<?php do_action('listable_job_listing_card_image_bottom', $post ); ?>

		</aside><!-- .card__image -->
		<div class="card__content">
			<h2 class="card__title" itemprop="name"><?php
				echo get_the_title();

				if( $listing_is_claimed ) :
					echo '<span class="listing-claimed-icon">';
					get_template_part('assets/svg/checked-icon-small');
					echo '<span>';
				endif;
			?></h2>
			<div class="card__tagline" itemprop="description"><?php the_company_tagline(); ?></div>
			<footer class="card__footer">
				<?php
				$rating = get_average_listing_rating( $post->ID, 1 );
				$geolocation_street = get_post_meta( $post->ID, 'geolocation_street', true );
				if ( ! empty( $rating ) ) { ?>
					<div class="rating  card__rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
						<meta itemprop="ratingValue" content = "<?php echo get_average_listing_rating( $post->ID, 1 ); ?>">
						<meta itemprop="reviewCount" content = "<?php echo get_comments_number( $post->ID ) ?>; ?>">
						<span class="js-average-rating"><?php echo get_average_listing_rating( $post->ID, 1 ); ?></span>
					</div>
				<?php } elseif ( ! empty( $geolocation_street ) ) { ?>
					<div class="card__rating  card__pin">
						<?php get_template_part( 'assets/svg/pin-simple-svg' ) ?>
					</div>
				<?php }

				if ( ! is_wp_error( $terms ) && ( is_array( $terms ) || is_object( $terms ) ) ) { ?>
					<ul class="card__tags">
						<?php foreach ( $terms as $term ) {
							$icon_url = listable_get_term_icon_url( $term->term_id );
							$attachment_id = listable_get_term_icon_id( $term->term_id );
							if ( empty( $icon_url ) ) {
								continue;
							} ?>
							<li>
								<div class="card__tag">
									<div class="pin__icon">
										<?php listable_display_image( $icon_url, '', true, $attachment_id ); ?>
									</div>
								</div>
							</li>
						<?php } ?>
					</ul><!-- .card__tags -->
				<?php }

				$listing_address = listable_get_formatted_address( $post );

				if ( ! empty( $listing_address ) ) { ?>
					<div class="address  card__address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<?php echo $listing_address ?>
					</div>
				<?php } ?>
			</footer>
		</div><!-- .card__content -->
	</article><!-- .card.card--listing -->
</a><!-- .grid__item -->
