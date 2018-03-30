<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
if (isset($dfd_ronneby['custom_logo_image']['url']) && $dfd_ronneby['custom_logo_image']['url']): ?>
	<div class="logo-for-panel">
		<a href="<?php echo home_url(); ?>/">
			<img src="<?php echo esc_url($dfd_ronneby['custom_logo_image']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
		</a>
	</div>
<?php endif; ?>

<nav class="mega-menu">
	<ul id="menu-news-navigation" class="nav-menu">
		<li class="mega-menu-item nav-item menu-item-depth-0">
			<a href="<?php echo home_url(); ?>" class="menu-link main-menu-link">
				<span class="item-title"><i class="moon-home-6"></i></span>
			</a>
		</li>
		<li class="mega-menu-item nav-item menu-item-depth-0 has-submenu">
			<a title="Category list" href="#" class="menu-link main-menu-link">
				<span class="item-title"><i class="moon-menu-6"></i></span>
			</a>
			<div class="sub-nav">
				<ul class="menu-depth-1 sub-menu sub-nav-group">
				<?php // has-submenu
					wp_list_categories(array(
						'title_li' => false,
						'use_desc_for_title' => 0,
					));
				?>
				</ul>
			</div>
		</li>
	</ul>
</nav>

<?php get_template_part('templates/header/block', 'main_menu'); ?>

<div class="right">
	<?php echo dfd_woocommerce_total_cart(); ?>
</div>
