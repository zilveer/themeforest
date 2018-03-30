<?php
/**
 * Template Part Name: Page Header
 *
 * @package smartfood
 */

$alt_logo = true;

if(get_field('page_subheader_layout') == 'Fullwidth Background' && get_field('header_type') == 'Transparent') :
	$alt_logo = false;
endif;

?>
<header <?php tdp_attr( 'header' ); ?>>

	<div class="nav-main" id="nav-main">
		<div class="container">
			<div class="row">

				<div class="col-md-4 col-sm-12 col-xs-12 hide-mobile" id="left-menu-wrapper">
					
					<nav id="main" class="site-navigation primary-navigation" <?php tdp_attr( 'menu', 'primary' ); ?>>
						<?php wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'container'       => '',
								'menu_class'      => 'sf-menu',
								'fallback_cb'     => '',
								'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
							)
						); ?>
					</nav>

				</div>

				<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="site-logo" id="site-logo">
					<?php tdp_logo($alt_logo);?>
					</div>
				</div>

				<div class="col-md-4 col-sm-12 col-xs-12 hide-mobile">
					
					<nav id="secondary" class="site-navigation secondary-navigation" <?php tdp_attr( 'menu', 'secondary' ); ?>>
						<?php wp_nav_menu(
							array(
								'theme_location'  => 'secondary',
								'container'       => '',
								'menu_class'      => 'sf-menu',
								'fallback_cb'     => '',
								'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
							)
						); ?>
					</nav>

				</div>

				<div class="clearfix"></div>

			</div>
		</div>
	</div>

	<?php if(get_field('page_subheader_layout') == 'Fullwidth Background') : ?>

		<div id="subheader" <?php tdp_attr( 'subheader' ); ?>>

			<?php if(get_field('background_image_color_overlay')) : ?>
				<div id="page-header-overlay"></div>
			<?php endif; ?>

			<div class="container" id="overlay-content">
				<div class="row clearfix">
					
					<?php if(get_field('sub_header_subtitle')) : ?>
					<h2><?php the_field('sub_header_subtitle'); ?></h2>
					<?php endif; ?>
					
					<h1 <?php tdp_attr( 'entry-title' ); ?>><?php the_field('sub_header_title');?></h1>
					
					<div id="title-separator"></div>

				</div>
			</div>
		</div>

	<?php else: ?>

	<div id="subheader-static">
		<div class="container">
			<div class="row clearfix">
			
			<?php if(get_field('add_custom_title_&_subtitle')) : ?>

				<?php if(get_field('sub_header_subtitle')) : ?>
				
				<h2><?php the_field('sub_header_subtitle'); ?></h2>
				
				<?php endif; ?>
					
				<h1 <?php tdp_attr( 'entry-title' ); ?>><?php the_field('sub_header_title');?></h1>

				<div id="title-separator"></div>

			<?php else : ?>
				<h1><?php the_title();?></h1>
			<?php endif; ?>

			</div>
		</div>
	</div>

	<?php endif; ?>

</header>