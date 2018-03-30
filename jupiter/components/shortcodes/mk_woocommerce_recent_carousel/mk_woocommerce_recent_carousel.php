<?php
$path = pathinfo(__FILE__) ['dirname'];
include ($path . '/config.php');

?>
<div class="mk-woocommerce-carousel <?php echo $style; ?>-style <?php echo $el_class; ?>">


<?php 
	$atts = array(
		'per_page' => $per_page,
		'orderby' => $orderby,
		'category' => $category,
		'posts' => $posts,
		'author' => $author,
		'order' => $order,
		'featured' => $featured,
		'title' => $title,
		'image_size' => $image_size,
		'per_view' => $per_view
	);
	echo mk_get_shortcode_view('mk_woocommerce_recent_carousel', 'loop-styles/' . $style, true, $atts);
?>

<div class="clearboth"></div>
</div>


