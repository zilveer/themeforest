<div class="mkd-fullscreen-menu-holder-outer">
	<div class="mkd-fullscreen-menu-holder" <?php hue_mikado_inline_style(array($fullscreen_background_image)); ?>>
		<div class="mkd-fullscreen-menu-holder-inner">
			<?php if($fullscreen_menu_in_grid) : ?>
			<div class="mkd-container-inner">
				<?php endif;

                if($have_logo){
                    hue_mikado_get_fullscreeen_logo();
                }

				//Sidearea above menu
				if(is_active_sidebar('fullscreen_menu_above')) : ?>
					<div class="mkd-fullscreen-above-menu-widget-holder">
						<?php dynamic_sidebar('fullscreen_menu_above'); ?>
					</div>
				<?php endif;

				//Navigation
				hue_mikado_get_full_screen_menu_navigation();

				//Sidearea under menu
				if(is_active_sidebar('fullscreen_menu_below')) : ?>
					<div class="mkd-fullscreen-below-menu-widget-holder">
						<?php dynamic_sidebar('fullscreen_menu_below'); ?>
					</div>
				<?php endif;

				if($fullscreen_menu_in_grid) : ?>
			</div>
		<?php endif; ?>
		</div>
	</div>
</div>