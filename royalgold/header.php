<?php
/**
 * The template for displaying the header
 *
 */
?><!doctype html>
<?php
global $smof_data, $is_IE;
if( $is_IE ) : ?>
<!--[if IE 8 ]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js ie" <?php language_attributes(); ?>><!--<![endif]-->
<?php else : ?>
<html class="no-js" <?php language_attributes(); ?>>
<?php endif; ?>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if ( ! function_exists('_wp_render_title_tag')) : ?>
<title><?php wp_title('&mdash;', true, 'right'); // falback for old WP versions ?></title>
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header id="header"<?php if( ! empty($smof_data['toggle_menu']) && ! empty($smof_data['toggle_menu_state'])) echo ' class="hide-menu"' ?>>
		<div id="logo"<?php if( empty($smof_data['custom_logo']) ) echo ' class="text-version"' ?>>
<?php if( ! empty($smof_data['custom_logo'])) : ?>
			<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php if(!empty($smof_data['meta-desc'])) { ?><?php echo esc_attr($smof_data['meta-desc']); ?><?php } else { echo esc_attr( get_bloginfo( 'description', 'display' )); } ?>"><img src="<?php echo esc_url($smof_data['custom_logo']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/></a></h1>
<?php else : ?>
			<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
<?php endif; ?>

<?php if( ! empty($smof_data['toggle_menu'])) : ?>
			<div class="menu-toggle"><span class="tooltip" title="<?php _e('Toggle Menu', 'royalgold') ?>"></span></div>
<?php endif; ?>
		</div>
		<nav id="menu"<?php if( ! empty($smof_data['menu_auto_expand_childs'])) echo ' class="expand-childs"' ?>>
			<?php
				wp_nav_menu(array(
					'theme_location' => 'main_menu',
					'container' => false,
					'items_wrap' => '<ul>%3$s</ul>',
				));
			?>
		</nav>
	</header>