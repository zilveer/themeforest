<?php
/**
 * Template Part Name: Page Header Events
 *
 * @package smartfood
 */

$alt_logo = false;
$bg_image = tdp_option('event_header_bg_image');

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

	<div id="subheader" data-img="<?php echo $bg_image['url'];?>">
		<div id="page-header-overlay"></div>
		<div class="container" id="overlay-content">
			<div class="row clearfix">
				<?php if(tribe_is_month() || tribe_is_list_view() || tribe_is_day()) : ?>

					<h2><?php echo tdp_option('events_archive_page_subtitle');?></h2>
					<h1 class="entry-title month-title" itemprop="headline"><?php echo tdp_option('events_archive_page_title'); ?></h1>

				<?php else: ?>

					<h2><?php echo category_description(); ?></h2>
					<h1 class="entry-title" itemprop="headline"><?php echo single_cat_title( '', true ); ?></h1>

				<?php endif; ?>
				<div id="title-separator"></div>
				<!-- Tribe Bar -->
				<?php tribe_get_template_part( 'modules/bar' ); ?>
			</div>
		</div>
	</div>
	
</header>