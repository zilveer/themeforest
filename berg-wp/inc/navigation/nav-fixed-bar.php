<?php if(YSettings::g('navigation_type') == '2') : ?>
<div class="nav-fixed-bar hidden-xs hidden-sm nav-alt">
	<div class="logo pull-left">
		<a href="<?php echo home_url(); ?>">
			<figure class="static-logo">
				<span class="spacer"></span>
				<?php
				$logo = YSettings::g('logo_image_'.YSettings::g('navigation_slide_down_logo'));
				if(isset($logo['url']) && $logo != '') : ?>						
				<img src="<?php echo $logo['url']; ?>" class="" alt="<?php bloginfo('name'); ?>" />
				<?php endif; ?>
			</figure>
		</a>
	</div>
<?php 
$after = '';

if (class_exists('Woocommerce')) {
	if (function_exists('icl_object_id')) {
		$shopPageID = (int)icl_object_id(get_option('woocommerce_shop_page_id'), 'page', true);
	} else {
		$shopPageID = get_option('woocommerce_shop_page_id');
	}

	if (YSettings::g('woocommerce_show_in_navbar', 1) == 1) {
		$after .= '<li class="menu-item '. ((is_shop()) ? 'current-menu-item' : '') .'"><a href="'.get_permalink($shopPageID).'"><span><i class="icon-bag"></i> '.get_the_title($shopPageID).' </span></a></li>';
	}
}

	if (has_nav_menu('primary')) {
		wp_nav_menu(array(
			'theme_location' => 'primary',
			'depth'=>3,
			'container_class' => 'main-nav',
			'walker' => new Child_Wrap(),
			'items_wrap' => '<ul id="%1$s" class="%2$s hidden-xs hidden-sm">%3$s'.$after.'</ul>',
		));
	}
?>
</div>

<?php endif; ?>