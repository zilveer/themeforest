<div class="thb-shortcode thb-tagcloud <?php echo implode(' ', $class); ?>">
	<?php wp_tag_cloud(array(
		'number'  => $num,
		'orderby' => $orderby,
		'order'   => $order,
		'taxonomy'=> $tax
	)); ?>
</div>