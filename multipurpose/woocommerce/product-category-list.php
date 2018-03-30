<?php
$options = array(
	'hierarchical' => false,
	'hide_empty' => false
	);
$categories = get_terms('product_cat', $options);
$count = count($categories);
$cols = 3;
$break1 = floor($count / $cols);
$break2 = $break1 * 2;
if($count) : ?>
	<section class="columns">
	<h2><span><?php _e('Product categories', 'multipurpose'); ?></span></h2>
	<div class="col col<?php echo $cols ?>"><ul class="product-cats">
<?php endif;
foreach($categories as $k=>$cat) : ?>
	<?php if($k == $break1 || $k == $break2): ?></ul></div><div class="col col<?php echo $cols ?>"><ul class="product-cats"><?php endif; ?>
	<li><a href="<?php echo get_term_link($cat); ?>"><?php echo $cat->name ?></a> (<?php echo $cat->count; ?>)</li>
<?php endforeach; 
if($count) : ?></ul></div></section><?php endif;
?>