<?php
function startuply_shortcode_atts_downloads($out, $pairs, $atts) { // add custom atts to download shortcode
	// we must initialize our additional parameters anyway
	// override some default values for only our shortcode parameters!!!

	if (!empty($atts['startuply_edd_view'])){
		$out['startuply_edd_view'] = $atts['startuply_edd_view'];
	} else {
		$out['startuply_edd_view'] = 'list';
	}

	// if (!empty($atts['columns'])){
	// 	$out['columns'] = $atts['columns'];
	// } else {
	// 	if ($out['startuply_edd_view'] == 'list'){
	// 			$out['columns'] = '1';
	// 		} elseif ($out['startuply_edd_view'] == 'grid'){
	// 			$out['columns'] = '2';
	// 		} elseif ($out['startuply_edd_view'] == 'material-grid'){
	// 			$out['columns'] = '2';
	// 	}
	// }

	$out['paging_on'] = empty($atts['paging_on']) ? 'NO' : $atts['paging_on'];

	return $out;
}
add_filter( 'shortcode_atts_downloads', 'startuply_shortcode_atts_downloads', 10, 3 );

function startuply_downloads_shortcode(	$display,
										$atts,
										$atts_buy_button,
										$atts_columns,
										$column_width,
										$downloads,
										$atts_excerpt,
										$atts_full_content,
										$atts_price,
										$atts_thumbnails,
										$query) {

	$output = '';

	if ( $downloads->have_posts() ) :
		$column = 12 / $atts['columns'];
		$columnSm = 12;

		if ($column == 4) {
			$columnSm = 6;
		} else if ($column == 3) {
			$columnSm = 4;
		}

		ob_start();
		?>

		<div class="edd-downloads-container row <?php echo $atts['startuply_edd_view'] ?>">

		<?php if (!empty($atts['startuply_edd_view']) && $atts['startuply_edd_view'] === 'material-grid') :  // code for material-grid view ?>

			<?php while ( $downloads->have_posts() ) : $downloads->the_post(); ?>

				<?php $schema = edd_add_schema_microdata() ? 'itemscope itemtype="http://schema.org/Product" ' : ''; ?>

				<div <?php echo $schema; ?>class="item col-md-<?php echo $column; ?> col-sm-<?php echo $columnSm; ?>">
					<div class="item-inner">
					<?php do_action( 'edd_download_before' );?>

						<div class="item-image-wrapper">
	 					<?php if ( 'false' != $atts['thumbnails'] ) {
		 						edd_get_template_part( 'shortcode', 'content-image' );
		 						do_action( 'edd_download_after_thumbnail' );
		 					} ?>

		 					<span class="item-price base_clr_bg">
							<?php if ( $atts['price'] == 'yes' ) {
									edd_get_template_part( 'shortcode', 'content-price' );
									do_action( 'edd_download_after_price' );
								} ?>
	 						</span>

							<div class="item-controls">
							<?php if ( $atts['buy_button'] == 'yes' ) {
								edd_get_template_part( 'shortcode', 'content-cart-button' );
							} ?>
							</div>
						</div>

						<div class="item-content">
	 						<h3 itemprop="name" class="item-title">
	 						<?php edd_get_template_part( 'shortcode', 'content-title' );
								do_action( 'edd_download_after_title' ); ?>
	 						</h3>

	 						<div class="item-description">
							<?php if ( $atts['excerpt'] == 'yes' && $atts['full_content'] != 'yes' ) {
								edd_get_template_part( 'shortcode', 'content-excerpt' );
								do_action( 'edd_download_after_content' );
							} else if ( $atts['full_content'] == 'yes' ) {
								edd_get_template_part( 'shortcode', 'content-full' );
								do_action( 'edd_download_after_content' );
							} ?>
							</div>
						</div>

					<?php do_action( 'edd_download_after' );?>
					</div>
				</div>

			<?php endwhile; ?>

		<?php else : // code for list/grid view ?>

			<?php while ( $downloads->have_posts() ) : $downloads->the_post(); ?>

				<?php $schema = edd_add_schema_microdata() ? 'itemscope itemtype="http://schema.org/Product" ' : ''; ?>

				<?php if ($atts['startuply_edd_view'] === 'list') : ?>
					<div <?php echo $schema; ?>class="item col-md-<?php echo $column; ?>">
				<?php else : ?>
					<div <?php echo $schema; ?>class="item col-md-<?php echo $column; ?> col-sm-<?php echo $columnSm; ?>">
				<?php endif; ?>

					<div class="item-inner">
					<?php do_action( 'edd_download_before' );?>

	 					<div class="item-image-wrapper">

	 					<?php if ( 'false' != $atts['thumbnails'] ) {
		 						edd_get_template_part( 'shortcode', 'content-image' );
		 						do_action( 'edd_download_after_thumbnail' );
		 					} ?>

	 					</div>

	 					<div class="item-content">
	 						<span class="item-price">
							<?php if ( $atts['price'] == 'yes' ) {
									edd_get_template_part( 'shortcode', 'content-price' );
									do_action( 'edd_download_after_price' );
								} ?>
	 						</span>

	 						<h3 itemprop="name" class="item-title">
	 						<?php edd_get_template_part( 'shortcode', 'content-title' );
								do_action( 'edd_download_after_title' ); ?>
	 						</h3>

	 						<div class="item-description">
							<?php if ( $atts['excerpt'] == 'yes' && $atts['full_content'] != 'yes' ) {
								edd_get_template_part( 'shortcode', 'content-excerpt' );
								do_action( 'edd_download_after_content' );
							} else if ( $atts['full_content'] == 'yes' ) {
								edd_get_template_part( 'shortcode', 'content-full' );
								do_action( 'edd_download_after_content' );
							} ?>
							</div>

							<div class="item-controls">
							<?php if ( $atts['buy_button'] == 'yes' ) {
								edd_get_template_part( 'shortcode', 'content-cart-button' );
							} ?>
							</div>
	 					</div>

	 				<?php do_action( 'edd_download_after' );?>
					</div>
				</div>

			<?php endwhile; ?>

		<?php endif; ?>

		</div>

		<?php wp_reset_postdata(); ?>

		<?php
			$pagination = false;

			if ( is_single() ) {
				$pagination = paginate_links( apply_filters( 'edd_download_pagination_args', array(
					'base'    => get_permalink() . '%#%',
					'format'  => '?paged=%#%',
					'current' => max( 1, $query['paged'] ),
					'total'   => $downloads->max_num_pages
				), $atts, $downloads, $query ) );
			} else {
				$big = 999999;
				$search_for   = array( $big, '#038;' );
				$replace_with = array( '%#%', '&' );
				$pagination = paginate_links( apply_filters( 'edd_download_pagination_args', array(
					'base'    => str_replace( $search_for, $replace_with, get_pagenum_link( $big ) ),
					'format'  => '?paged=%#%',
					'current' => max( 1, $query['paged'] ),
					'total'   => $downloads->max_num_pages
				), $atts, $downloads, $query ) );
			}
		?>

		<?php
		if ( ! empty( $pagination ) && (empty($atts['paging_on']) || $atts['paging_on'] == 'YES') ) : ?>
		<div id="edd_download_pagination" class="navigation">
			<?php echo $pagination; ?>
		</div>
		<?php endif; ?>

		<?php $output = ob_get_clean();
	else :
		$output = sprintf( _x( 'No %s found', 'download post type name', 'startuply' ), edd_get_label_plural() );
	endif;

	return $output;
}

add_filter('downloads_shortcode', 'startuply_downloads_shortcode', 999, 11);
?>
