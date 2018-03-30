<?php
/**
 * The Template for displaying all single releases.
 *
 */
get_header();
?>
	<?php
		/**
		 * wolf_discography_before_main_content hook
		 *
		 * @hooked wolf_discography_output_content_wrapper - 10 (outputs opening divs for the content)
		 */
		//do_action( 'wolf_discography_before_main_content' );
	?>

	<?php while ( have_posts() ) : the_post();

	$post_id = get_the_ID();

	/* Metaboxes and Taxonomy */
		// band
		$band = '';

		if ( strip_tags( get_the_term_list( $post_id, 'band', '', ', ', '' ) ) != '' ) {

			$band =  '<strong>' . __( 'Band ', 'wolf') . '</strong> : ' . strip_tags( get_the_term_list( $post_id, 'band', '', ', ', '' ) ) . '<br>';

		}

		if ( wolf_get_release_option( 'use_band_tax' ) ) {
			$band = get_the_term_list( $post_id, 'band', '<strong>' . __( 'Band ', 'wolf') . '</strong> : ', ', ', '<br>' );
		}

		// label
		$label = '';

		if ( strip_tags( get_the_term_list( $post_id, 'label', '', ', ', '' ) ) != '' ) {

			$label =  '<strong>' . __( 'Label ', 'wolf') . '</strong> : ' . strip_tags( get_the_term_list( $post_id, 'label', '', ', ', '' ) ) . '<br>';

		}

		if ( wolf_get_release_option( 'use_label_tax' ) ) {
			$label = get_the_term_list( $post_id, 'label', '<strong>' . __( 'Label ', 'wolf') . '</strong> : ', ', ', '<br>' );
		}
	$release_title = get_post_meta( $post_id, '_wolf_release_title', true );
	$release_date = get_post_meta( $post_id, '_wolf_release_date', true );
	$release_label = get_post_meta( $post_id, '_wolf_release_label', true );
	$release_catalog = get_post_meta( $post_id, '_wolf_release_catalog_number', true );
	$release_type = get_post_meta( $post_id, '_wolf_release_type', true );

	$display_date = '';
	if ( $release_date ) {
		list( $month, $day, $year ) = explode( "-", $release_date );
		$sql_date = $year . '-' . $month . '-' . $day . ' 00:00:00';
		$display_date = mysql2date( get_option( 'date_format' ), $sql_date );
	}

	$thumbnail_size = get_post_meta( $post_id, '_wolf_release_type', true ) == 'DVD' || get_post_meta( $post_id, '_wolf_release_type', true ) == 'K7' ? 'DVD' : '2x2';

	$release_itunes = get_post_meta( $post_id, '_wolf_release_itunes', true );
	$release_amazon = get_post_meta( $post_id, '_wolf_release_amazon', true );
	$release_buy = get_post_meta( $post_id, '_wolf_release_buy', true );
	$release_free = get_post_meta( $post_id, '_wolf_release_free', true );
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'wolf-release' ) ); ?>>

		<div class="entry-thumbnail">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( $thumbnail_size ); ?>
			<?php endif; ?>
			<div id="wolf-release-buttons">
				<?php if ( $release_itunes ) : ?>
				<div class="wolf-release-button">
					<a href="<?php echo $release_itunes; ?>" class="wolf-release-itune wolf-button large square border-button-accent-hover">
						<span class="fa fa-apple"></span>
						iTunes
					</a>
				</div>
				<?php endif; ?>
				<?php if ( $release_amazon ) : ?>
				<div class="wolf-release-button">
					<a href="<?php echo $release_amazon; ?>" class="wolf-release-amazon wolf-button large square border-button-accent-hover">
						<span class="fa ti-amazon"></span>
						Amazon
					</a>
				</div>
				<?php endif; ?>
				<?php if ( $release_buy ) : ?>
				<div class="wolf-release-button">
					<a href="<?php echo $release_buy; ?>" class="wolf-release-buy wolf-button large square border-button-accent-hover">
						<span class="fa ti-cart"></span>
						<?php _e( 'Buy', 'wolf' ); ?>
					</a>
				</div>
				<?php endif; ?>
				<?php if ( $release_free ) : ?>
				<div class="wolf-release-button">
					<a href="<?php echo $release_free; ?>" class="wolf-release-free wolf-button large square border-button-accent-hover">
						<span class="fa fa-download"></span>
						<?php _e( 'Free Download', 'wolf' ); ?>
					</a>
				</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="entry-content">
			<h2 class="entry-title">
				<?php the_title(); ?>
			</h2>
			<div class="wolf-release-meta">
				<?php echo $band; ?>

				<?php // Title
				if ( $release_title ) : ?>
				<strong><?php _e( 'Title', 'wolf' ); ?></strong> : <?php echo $release_title; ?><br>
				<?php endif; ?>

				<?php // Date
				if ( $display_date ) : ?>
				<strong><?php _e( 'Release Date', 'wolf' ); ?></strong> : <?php echo $display_date; ?><br>
				<?php endif; ?>

				<?php // Label
				echo $label; ?>

				<?php // Catalog number
				if ( $release_catalog ) : ?>
				<strong><?php _e( 'Catalog ref.', 'wolf' ); ?></strong> : <?php echo $release_catalog; ?><br>
				<?php endif; ?>

				<?php // Type
				if ( $release_type && wolf_get_release_option( 'display_format' ) ) : ?>
				<strong><?php _e( 'Format', 'wolf' ); ?></strong> : <?php echo $release_type; ?><br>
				<?php endif; ?>
			</div>

			<?php the_content(); ?>

			<footer class="entry-meta">
				<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-meta -->
		</div><!-- .entry-content -->

	</article><!-- .wolf-release -->
	<div class="clear"></div>
		<div class="wrap"><?php wolf_release_nav(); ?></div>
	<?php endwhile; ?>
	<?php
		/**
		 * wolf_discography_after_main_content hook
		 *
		 * @hooked wolf_discography_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		//do_action('wolf_discography_after_main_content');
	?>

<?php
get_sidebar();
get_footer();
?>
