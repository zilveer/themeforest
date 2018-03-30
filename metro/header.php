<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php if(get_option(OM_THEME_PREFIX . 'responsive') == 'true') { ?><meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" /><?php } ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
	<![endif]-->

	<?php echo get_option( OM_THEME_PREFIX . 'code_before_head' ) ?>
	
	<?php wp_head(); ?>
</head>
<?php
	$body_class='';
	if(get_option(OM_THEME_PREFIX.'sidebar_position')=='left')
		$body_class='flip-sidebar';
	if(@$post) {
		$sidebar_post=get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'sidebar_custom_pos', true);
		if($sidebar_post == 'left')
			$body_class='flip-sidebar';
		elseif($sidebar_post == 'right')
			$body_class='';
	}
	if(get_option(OM_THEME_PREFIX.'content_panes_dark_bg')=='true')
		$body_class.=' dark-panes-bg';
?>
<body <?php body_class( $body_class ) ?>>
<!--[if lt IE 8]><p class="chromeframe"><?php _e('Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.','om_theme'); ?></p><![endif]-->
<div class="bg-overlay">

	<div class="container">
		
		<header>
			
			<!-- Headline -->
			<?php
				$icons_html='';
				if(get_option(OM_THEME_PREFIX.'socicons_position') == 'header') {
					$icons_html = om_get_social_icons_html();
				}
			?>
			<div class="headline block-full<?php if($icons_html) echo ' with-socials' ?>">
				<?php if($icons_html) { ?>
					<div class="headline-social"><?php echo $icons_html ?></div>
				<?php } ?>
				<div class="headline-text">
					<?php echo get_option(OM_THEME_PREFIX . 'intro_text') ?>
				</div>
				<div class="clear"></div>
			</div>
			<!-- /Headline -->
		
			<!-- Logo & Menu -->
			
			<nav>
				
				<div class="logo-pane block-3 block-h-1 bg-color-menu<?php if(get_option(OM_THEME_PREFIX . 'logo_remove_bg') == 'true' && get_option(OM_THEME_PREFIX . 'site_logo_type') == 'image') echo ' logo-pane-no-bg' ?>">
					<div class="logo-pane-inner">
		
						<?php
						if(get_option(OM_THEME_PREFIX . 'site_logo_type') == 'text') {
							echo '<div class="logo-text"><a href="' . home_url() .'">'. get_option(OM_THEME_PREFIX . 'site_logo_text') .'</a></div>';
						} else {
							if( $tmp=get_option(OM_THEME_PREFIX . 'site_logo_image') )
								echo '<div class="logo-image"><a href="' . home_url() .'"><img src="'.$tmp.'" alt="'.htmlspecialchars( get_bloginfo( 'name' ) ).'" /></a></div>';
						}
						?>
					</div>
				</div>
				
				<?php
					if ( has_nav_menu( 'primary-menu' ) ) {
		
						function om_nav_menu_classes ($items) {
		
							function hasSub ($menu_item_id, &$items) {
				        foreach ($items as $item) {
			            if ($item->menu_item_parent && $item->menu_item_parent==$menu_item_id) {
			              return true;
			            }
				        }
				        return false;
							};					
							
							$menu_root_num=0;
							foreach($items as $item) {
								if(!$item->menu_item_parent)
									$menu_root_num++;
									
								if (hasSub($item->ID, $items)) {
									$item->classes[] = 'menu-parent-item';
								}
							}
							if($menu_root_num < 7)
								$size_class='block-h-1';
							else
								$size_class='block-h-half';
							foreach ($items as &$item) {
								if($item->menu_item_parent)
									continue;
								$item->classes[] = 'block-1';
								$item->classes[] = $size_class;
							}
							return $items;    
						}
						add_filter('wp_nav_menu_objects', 'om_nav_menu_classes');	
		
						$menu = wp_nav_menu( array(
							'theme_location' => 'primary-menu',
							'container' => false,
							'echo' => false,
							'link_before'=>'<span>',
							'link_after'=>'</span>',
							'items_wrap' => '%3$s'
						) );
						
						remove_filter('wp_nav_menu_objects', 'om_nav_menu_classes');	
						
						$root_num=preg_match_all('/class="[^"]*block-1[^"]*"/', $menu, $m);
						echo '<ul class="primary-menu block-6 no-mar'.(get_option(OM_THEME_PREFIX . 'show_dropdown_symbol')=='true'?' show-dropdown-symbol':'').'">'.$menu;
						$blank_num=0;
						$blank_str='';
						if($root_num < 7) {
							$blank_num=6-$root_num;
							$blank_str='<li class="block-1 block-h-1 blank">&nbsp;</li>';
						} elseif($root_num < 13) {
							$blank_num=12-$root_num;
							$blank_str='<li class="block-1 block-h-half blank">&nbsp;</li>';
						}
						echo str_repeat($blank_str,$blank_num);
						echo '</ul>';
		
				
						echo '<div class="primary-menu-select bg-color-menu">';
						om_select_menu( 'primary-menu' );
						echo '</div>';
					}
				?>
				<div class="clear"></div>
				
			</nav>
			
			<!-- /Logo & Menu -->
			
		</header>

		<?php if( is_front_page() ) { get_template_part('includes/homepage-slider'); } ?>