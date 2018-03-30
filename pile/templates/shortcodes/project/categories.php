<?php

if ( ! isset( $post->ID ) || ! is_numeric( $post->ID ) ) {
	return;
}
$cats = wp_get_object_terms($post->ID, 'pile_portfolio_categories');
if ( ! empty( $cats ) ) { ?>
	<ul class="meta meta--project">
	<?php foreach ( $cats as $cat ) { ?>
		<li><a href="<?php echo get_term_link($cat, 'pile_portfolio_categories'); ?>"><?php echo $cat->name; ?></a></li>
	<?php } ?>
	</ul>
<?php }