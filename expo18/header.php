<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php if(get_option(OM_THEME_PREFIX . 'responsive') == 'true') : ?><meta name="viewport" content="width=device-width,initial-scale=1" /><?php endif; ?>

	<!-- Pingbacks -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

	<?php echo get_option( OM_THEME_PREFIX . 'code_before_head' ) ?>
</head>
<body <?php body_class(  ); ?>>
	<!-- Head Line: Header, Countdown -->

	<div class="headline-wrapper a-bg-l1">
		<?php $is_right_column = ( get_option(OM_THEME_PREFIX . 'countdown_date') != '' || get_option(OM_THEME_PREFIX . 'location_date') != '' ) ?>
		<div class="headline a-bg-l2<?php echo ( $is_right_column ? '': ' right-empty') ?>">
			<div class="headline-inner">
				<div class="fixw">
					<div class="headline-left">
						<?php
						if(get_option(OM_THEME_PREFIX . 'site_logo_type') == 'text') {
							echo '<div class="logo-text"><a href="' . home_url() .'">'. get_option(OM_THEME_PREFIX . 'site_logo_text') .'</a></div>';
						} else {
							if( $tmp=get_option(OM_THEME_PREFIX . 'site_logo_image') )
								echo '<div class="logo-image"><a href="' . home_url() .'"><img src="'.$tmp.'" alt="'.htmlspecialchars( get_bloginfo( 'name' ) ).'" /></a></div>';
							else
								echo '<div class="logo-image"><a href="' . home_url() .'"><img src="'. get_template_directory_uri() .'/img/logo.png" alt="'.htmlspecialchars( get_bloginfo( 'name' ) ).'" /></a></div>';
						}
						?>
					</div>
					<?php if($is_right_column) { ?>
						<div class="headline-right">
							<?php if(get_option(OM_THEME_PREFIX . 'location_date') != '') { ?>
								<!-- Date and Place -->
								<div class="dates-place"><?php echo get_option(OM_THEME_PREFIX . 'location_date') ?></div>
							<?php } ?>
	
							<?php if(get_option(OM_THEME_PREFIX . 'countdown_date') != '') { ?>
								<!-- Countdown -->
								<div class="countdown">
									<div id="countdown"<?php if(get_option(OM_THEME_PREFIX . 'countdown_hide_seconds') == 'true') echo ' data-hideseconds="true"' ?> data-days="<?php _e('days','om_theme') ?>" data-hrs="<?php _e('hrs','om_theme') ?>" data-min="<?php _e('min','om_theme') ?>" data-sec="<?php _e('sec','om_theme') ?>" data-label="<?php _e('time left','om_theme') ?>"><?php echo get_option(OM_THEME_PREFIX . 'countdown_date') ?><!--UNTIL TIME, FORMAT YYYY-MM-DD HH:MM:SS--></div>
								</div>
								<!-- /Countdown -->
							<?php } ?>
						</div>
					<?php } ?>
					<div class="clear">&nbsp;</div>

				</div>
			</div>
		</div>
	</div>
	<!-- /Head Line -->

	<?php
		$sidebar_position=get_option(OM_THEME_PREFIX.'sidebar_position');
		if(!$sidebar_position)
			$sidebar_position='right';
	?>
	
	<!-- Container -->
	<div class="container-wrapper">
		<div class="container fixw sidebar-<?php echo $sidebar_position; ?>">
			<div class="container-col-full-width">
				<!-- Menu -->
				<div class="menu-pane">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary-menu',
							'container' => false,
							'menu_class' => 'primary-menu',
							'fallback_cb' => 'om_primary_menu_fallback',
						) );

						if ( has_nav_menu( 'secondary-menu' ) ) {
							?>
							<div class="secondary-menu-container">
								<div class="secondary-menu-control"><?php echo om_menu_name('secondary-menu') ?></div>
								<div class="secondary-menu-wrapper">
								<?php
								wp_nav_menu( array(
									'theme_location' => 'secondary-menu',
									'container' => false,
									'menu_class' => 'secondary-menu'
								) );
								?>
								</div>
							</div>
							<?php
						}

						$special_button=get_option(OM_THEME_PREFIX.'special_button_title');
						if($special_button) {
							$special_button_link=get_option(OM_THEME_PREFIX.'special_button_link');
							echo '<a href="'.$special_button_link.'" class="menu-special-button">'.$special_button.'</a>';
						}
												
					?>
					<div class="clear"></div>
				</div>
				<div class="primary-menu-select">
					<select onchange="if(this.value!=''){document.location.href=this.value}"><option value=""><?php _e('Menu:','om_theme')?></option>
						<?php
						echo om_select_menu_options( 'primary-menu' );
						if ( has_nav_menu( 'secondary-menu' ) ) {
							echo om_select_menu_options( 'secondary-menu' );
						}
						?>
					</select>
				</div>
				<?php
					if($special_button) {
						echo '<a href="'.$special_button_link.'" class="menu-special-button-mobile">'.$special_button.'</a>';
					}
				?>
				<!-- /Menu -->
			</div>