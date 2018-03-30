<?php
/**
 * @package berg-wp
 */

global $items_links; 

if ($items_links == 1) {
	$food_link = esc_url(get_permalink());
} else {
	$food_link = '#';
}
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

$pretty_photo = $img = '';
if(YSettings::g('berg_food_menu_squares_open') == 'open_overlay') {
	$pretty_photo = 'class="prettyphoto" rel="prettyPhoto[rel-food]"';
	$img = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
	$img = $img[0];
	$food_link = '';
} elseif (YSettings::g('berg_food_menu_squares_open') == 'open_post') {
	$food_link = $food_link;
} else {
	$food_link = '';
}
?>
<div class="menu-item <?php echo YSettings::g('berg_food_menu_squares_open') ;?>">

	<?php if (YSettings::g('berg_food_menu_squares_open') == 'open_overlay' || YSettings::g('berg_food_menu_squares_open') == 'open_post') : ?>

	<a href="<?php echo $food_link; ?><?php echo $img ;?>" <?php echo $pretty_photo ;?>>
		<figure>
			<?php if(has_post_thumbnail( get_the_id() )) {
				the_post_thumbnail('menu_thumb');
			} else { ?>
				<img src="<?php echo THEME_DIR_URI.'/img/placeholder.png'?>" width="300" height="300"/>
			<?php } ?>

			<div class="actions">
				
			</div>
			<?php if (YSettings::g('berg_food_menu_squares_open') == 'open_overlay') : ?>
				<i class="icon-magnifier-add"></i>
			<?php endif ;?>
		</figure>
	</a>
	<?php else : ?>
	<div class="product-image">
		<figure>
			<?php if(has_post_thumbnail( get_the_id() )) {
				 the_post_thumbnail('menu_thumb');
			} else { ?>
				<img src="<?php echo THEME_DIR_URI.'/img/placeholder.png'?>" width="300" height="300"/>
			<?php } ?>
		</figure>
	</div>
	<?php endif; ?>
	<div class="item-description">
		<div class="">
			<div class="">
				<?php if($badge !== '') : ?>
				  <div class="food-badges"><?php echo $badge ;?></div>
				<?php endif ;?>
				<?php if ($items_links == 0 ): ?>
				<?php the_title( '<h5 class="entry-title">', '<span class="item-title">'.$icon_output.'</span></h5>' ); ?>
				<?php else: ?>
				<?php the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark" class="item-title">', esc_url( get_permalink() ) ), ''.$icon_output.'</a></h5>' ); ?>
				<?php endif; ?>
				<p class="desc">
					<?php the_excerpt(); ?>
				</p>
				<?php echo 	apply_filters('the_content', get_post_meta(get_the_id(),'menu_details', true )); ?>
			</div>
		</div>
	</div>
</div>