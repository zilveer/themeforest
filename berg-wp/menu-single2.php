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
	<div class="menu-item-wrapper">
		<div class="item-description">
			<?php if($badge !== '') : ?>
			  <div class="food-badges"><?php echo $badge ;?></div>
			<?php endif ;?>
			<?php if ($items_links == 0): ?>
				<?php the_title( '<h5 class="entry-title">', '<span class="item-title">'.$icon_output.'</span></h5>' ); ?>
			<?php else: ?>
				<?php the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark" class="item-title">', esc_url( get_permalink() ) ), ''.$icon_output.'</a></h5>' ); ?>
			<?php endif; ?>

			<?php the_excerpt(); ?>
			<?php echo 	apply_filters('the_content', get_post_meta(get_the_id(), 'menu_details', true )); ?>
		</div>
	</div>
</div>