<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package berg-wp
 */

get_header();

$container = 'container';
$sidebar = '';
$posts_size_content = '';
$page_meta = get_post_meta(get_the_id());

if (isset($page_meta['page_width'][0])) {
	$page_width = $page_meta['page_width'][0];

	if ($page_width == 'page_width_1') {
		$posts_size_content = 'col-md-8 col-md-offset-2';
	} else if($page_width == 'page_width_2') {
		$posts_size_content = 'col-md-6 col-md-offset-3';
	} else if($page_width == 'page_width_3') {
		$posts_size_content = 'col-md-10 col-md-offset-1';
	} else if($page_width == 'page_width_4') {
		$post_size_content = 'col-md-12';
		$container = 'container-fluid';
	}
}

if (isset($page_meta['sidebar_settings'][0])) {
	$sidebar_settings = $page_meta['sidebar_settings'][0];

	if ($sidebar_settings == 'global') {
		$sidebar_settings = YSettings::g('sidebar_global_position', 'right');
	}

	if ($sidebar_settings == 'disabled') {
		$sidebar = 'hidden';
	}

	if ($sidebar_settings == 'right') {
		$sidebar = 'sidebar-right';
		$posts_size_content = 'col-md-7';
	}

	if ($sidebar_settings == 'left') {
		$sidebar = 'sidebar-left';
		$posts_size_content = 'col-md-7 col-md-offset-1 content-right';
	}
}

if (!berg_is_woocommerce_page()) : ?>
	<section class="section-scroll main-section section-padding">
		<div class="<?php echo $container;?>">
			<div class="row">
				<div class="col-xs-12 <?php echo $posts_size_content; ?>">
					<?php
					$post = get_post($id);
					the_post();
					the_content();
					?>
				</div>
				<div class="col-xs-12 col-md-4 widget-sidebar <?php echo $sidebar;?>">
					<?php get_sidebar('page'); ?>
				</div> 
			</div>
		</div>
	</section>
<?php else : ?>
	<section class="section-scroll main-section">
		<?php
		$post = get_post($id); 
		the_post();
		?>
		<?php include THEME_INCLUDES . '/woocommerce_menu.php'; ?>
		<header class="section-header"><h2 class="h3"><?php the_title(); ?></h2></header>
		<div class="container section-padding">
			<div class="row">
				<div class="col-md-12">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section>
<?php endif;?>
<?php
	berg_getFooter();
	get_template_part('footer'); 
?>