<?php

$args = array(
	'items_per_page'              => $query_filter['num'],
	'items_orderby'               => $query_filter['orderby'],
	'items_order'                 => $query_filter['order'],
	'items_filter'                => $query_filter['filter'],
	'items_filter_exclude'        => thb_isset( $query_filter, 'filter_exclude', '' ),
	'items_include_subcategories' => $query_filter['include_subcategories'],
	'paged'                       => 1
);

$args['carousel']                 = $carousel;
$args['carousel_module']          = $carousel_module;
$args['carousel_show_nav_arrows'] = $carousel_show_nav_arrows;
$args['carousel_nav_arrows_position'] = $carousel_nav_arrows_position;
$args['carousel_show_pagination'] = $carousel_show_pagination;
$args['carousel_autoplay']        = (int) $carousel_autoplay;
$args['carousel_transition_time'] = ! empty( $carousel_transition_time ) ? $carousel_transition_time : 1;

?>

<?php if ( $title != '' || ( $carousel_show_nav_arrows && $carousel_nav_arrows_position == 'top' ) ) : ?>
	<div class="thb-section-block-header">
		<h1 class="thb-section-block-title">
			<?php echo thb_text_format( $title ); ?>
		</h1>

		<?php if ( $carousel_show_nav_arrows && $carousel_nav_arrows_position == 'top' ) : ?>
			<?php thb_carousel_nav_arrows(); ?>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php
	thb_get_template_part( 'loop/blog-' . $layout, array(
		'args'  => $args,
		'_block_data' => $_block_data
	) );

	wp_reset_query();
?>