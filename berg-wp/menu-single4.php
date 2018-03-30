<?php
/**
 * @package berg-wp
 */

global $items_links; 

$icon = YSettings::g('icon_food');
$icon_output = '<span class="icon-food"></span>';
if(isset($icon)) {
	$attachments = array_filter( explode( ',', $icon ) );
	if ( $attachments ) {
		$icon_output = '';
		foreach ( $attachments as $attachment_id ) {
			$icon_output .= '<span class="icon-food">'.wp_get_attachment_image( $attachment_id, 'thumbnail' ).'</span>';

		}
	}
}
if(YSettings::g('berg_food_menu_badge') == 1) {
	$price = apply_filters('the_content', get_post_meta(get_the_id(),'menu_details', true ));
	// $icon = '<span class="icon-food">'. get_post_meta(get_the_id(),'icon_food', true ) .'</span>';
	$badge = apply_filters('the_content', get_post_meta(get_the_id(),'menu_badge', true ));
} else {
	$price = $badge = '';
}


?>
<div class="menu-item">
	<div class="item-description">
		<?php if ($items_links == 0): ?>
		<?php the_title( '<h5 class="entry-title"><span class="food-badges">'.$badge.'</span><span class="item-title">', ''.$icon_output.'</span><span class="dots"></span><div class="menu-details">'.$price.'</div></h5>' ); ?>
		<?php else: ?>
		<?php the_title( sprintf( '<h5 class="entry-title"><span class="food-badges">'.$badge.'</span><a href="%s" rel="bookmark" class="item-title">', esc_url( get_permalink() ) ), ''.$icon_output.'</a><span class="dots"></span><div class="menu-details">'.$price.'</div></h5>' ); ?>
		<?php endif; ?>
		<?php if (YSettings::g('food_menu_show_items_full_text', '0') == '1'): ?>
		<?php the_content(); ?>
		<?php else: ?>
		<?php the_excerpt(); ?>
		<?php endif; ?>

	</div>
</div>