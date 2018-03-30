<?php 
$register = new mk_artbees_products();

$header_data = wp_get_theme();

$pages = array(
	THEME_NAME => __('Register Product', 'mk_framework'),
	'theme-support' => __('Support', 'mk_framework'),
	'theme-templates' => __('Templates', 'mk_framework'),
	//'theme-addon' => __('Add-ons', 'mk_framework'),
	//'theme-image-size' => __('Image Sizes', 'mk_framework'),
	'theme-status' => __('System Status', 'mk_framework'),
	);
?>
<div class="cp-header clearfix">
	<span class="logo-holder">
		<!--<img src="<?php echo THEME_CONTROL_PANEL_ASSETS; ?>/images/logo.png">-->
		<span>The ken <?php _e('Control Panel', 'mk_framework'); ?></span>
	</span>
	<span class="version-holder">
		<?php _e('Version:', 'mk_framework'); ?> <?php echo $header_data['Version']; ?>
	</span>
</div>

<p class="header-desc"><?php _e('You are awesome! You are now equipped with arguably the most powerful WordPress Website builder. To enjoy the full experience we strongly recommend to register your product.', 'mk_framework'); ?></p>

<ul class="cp-tabs-holder">
	<?php foreach ($pages as $slug => $name) { 
		$current_class = ($view_params['page_slug'] == $slug) ? ' class="current"' : '';
		?>
		<li<?php echo $current_class; ?>><a href="<?php echo admin_url('admin.php?page='.$slug); ?>"><?php echo $name; ?>
		<?php if(!$register->is_verified_artbees_customer() && $slug == THEME_NAME) { ?>
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
				<circle fill="#F95C32" cx="8" cy="8" r="8"/>
				<rect x="7.1" y="3" fill="#FFFFFF" width="1.9" height="6.3"/>
				<circle fill="#FFFFFF" cx="8" cy="12.3" r="1.2"/>
			</svg>
		<?php } ?>

		</a></li>
	<?php } ?>
</ul>