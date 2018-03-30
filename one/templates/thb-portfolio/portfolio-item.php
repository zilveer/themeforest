<?php
	$thb_title      = get_the_title();
	$thb_subtitle   = thb_get_portfolio_item_subtitle();
	$thb_item_class = thb_get_grid_layout_item_class();
	$thb_slides     = thb_get_portfolio_item_slides( get_the_ID() );
	$thb_fi         = thb_get_featured_image( $thb_size );

	if( $thb_fi == '' ) {
		$thb_item_class .= ' thb-empty-image';
	} else {
		$thb_item_class .= ' thb-w-image';
	}

	if( post_password_required() ) {
		$thb_title = __('Protected: ', 'thb_text_domain') . get_the_title();
	}

	$args = array(
		'thb_title' => $thb_title,
		'thb_subtitle' => $thb_subtitle,
		'thb_slides' => $thb_slides,
		'thb_fi' => $thb_fi
	);

	$thb_is_portfolio_grid_a = $thb_portfolio_layout == 'thb-portfolio-grid-a';
	$thb_is_portfolio_grid_b = $thb_portfolio_layout == 'thb-portfolio-grid-b';
	$thb_is_portfolio_grid_c = $thb_portfolio_layout == 'thb-portfolio-grid-c';
	$thb_is_portfolio_grid_d = $thb_portfolio_layout == 'thb-portfolio-grid-d';
	$thb_is_portfolio_carousel = $thb_portfolio_layout == 'thb-portfolio-carousel';
?>
<li id="post-<?php the_ID(); ?>" <?php thb_portfolio_post_class( $thb_item_class ); ?> <?php thb_portfolio_item_datafilters(); ?>>
	<article class="work-inner-wrapper">

		<?php
			$data = array(
				'args' => $args
			);

			if ( $thb_is_portfolio_grid_a ) {
				thb_get_template_part( 'loop/portfolio-item-a', $data );
			}
			elseif ( $thb_is_portfolio_grid_b ) {
				thb_get_template_part( 'loop/portfolio-item-b', $data );
			}
			elseif ( $thb_is_portfolio_grid_c ) {
				thb_get_template_part( 'loop/portfolio-item-c', $data );
			}
			elseif ( $thb_is_portfolio_grid_d ) {
				thb_get_template_part( 'loop/portfolio-item-d', $data );
			}
			elseif ( $thb_is_portfolio_carousel ) {
				thb_get_template_part( 'loop/portfolio-item-carousel', $data );
			}
		?>

	</article>
</li>