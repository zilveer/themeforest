<?php $imageUrl = '';
$width = 600;
$height = 1000;
$atr = ct_get_featured_image_data (get_the_ID(),$width,$height);?>
<?php if (has_post_thumbnail(get_the_ID()) || has_portfolio_second_featured_image(get_the_ID())): ?>
	<?php $imgClass = has_portfolio_second_featured_image(get_the_ID())? 'ctFeaturedImage2':''?>
	<?php $imageUrl = ct_get_portfolio_featured_image_single(get_the_ID())?>
	<?php echo do_shortcode('[img class="'.$imgClass.'" src="' . $imageUrl . '" width="" height="" title="'.esc_attr( $atr['title']).'" alt="'. esc_attr( $atr['alt']).'" ]') ?>
<?php endif; ?>
