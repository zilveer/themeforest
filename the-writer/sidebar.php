<?php $menustyle = get_option("ocmx_menu_style"); ?>
<div id="sidebar-container" class="nano">
	<div class="sidebar-content <?php echo $menustyle; ?>">
		<?php if (function_exists("wp_nav_menu")) :
			wp_nav_menu(array(
				'menu' => 'Obox Nav',
				'menu_id' => 'nav',
				'menu_class' => 'clearfix',
				'sort_column' 	=> 'menu_order',
				'theme_location' => 'primary',
				'container' => 'ul',
				'fallback_cb' => 'ocmx_fallback')
			);
		endif; ?>

		<?php if (function_exists('dynamic_sidebar')) :
			dynamic_sidebar('widgetarea');
		endif; ?>
	</div>
</div>