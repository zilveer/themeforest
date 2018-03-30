<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

global $mk_options;

$id = Mk_Static_Files::shortcode_id();

$query = mk_wp_query(array(
    'post_type' => 'pricing',
    'count' => $table_number,
    'posts' => $tables,
    'orderby' => $orderby,
    'order' => $order,
));

$loop = $query['wp_query'];

switch ($table_number) {
	case 1:
		$column = 'one-table';
		break;
	case 2:
		$column = 'two-table';
		break;
	case 3:
		$column = 'three-table';
		break;
	case 4:
		$column = 'four-table';
		break;			
}
?>

<div class="pricing-table <?php echo $style; ?> <?php echo $el_class; ?> <?php echo ( strlen( $content ) < 5 ? 'no-pricing-offer' : ''); ?>">
	<?php echo mk_get_shortcode_view('mk_pricing_table', 'components/offers', true, ['content' => $content]); ?>
	<ul class="pricing-cols"><?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php $featured = get_post_meta( get_the_ID(), 'featured', true ); ?>
<li class="pricing-col <?php echo $column; ?> <?php echo ($featured == 'true' ? 'featured-plan' : ''); ?>">
			<div class="pricing-heading" <?php echo ( $style == 'multicolor' ) ? ( 'style="background-color:'.get_post_meta( get_the_ID(), 'skin', true ).'"' ) : ''; ?>>
				<?php echo mk_get_shortcode_view('mk_pricing_table', 'components/plan', true, ['style' => $style, 'featured' => $featured]); ?>
				<?php echo mk_get_shortcode_view('mk_pricing_table', 'components/price', true); ?>
			</div>
			<?php echo mk_get_shortcode_view('mk_pricing_table', 'components/features', true); ?>
			<?php echo mk_get_shortcode_view('mk_pricing_table', 'components/button', true, ['featured' => $featured, 'style' => $style]); ?>
</li><?php endwhile; wp_reset_query(); ?>
</ul>
</div>


