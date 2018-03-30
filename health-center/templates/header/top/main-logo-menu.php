<div class="<?php if(!wpv_get_option('full-width-header')) echo 'limit-wrapper' ?>">
	<div class="header-contents header-content-wrapper">
		<div class="first-row">
			<?php get_template_part('templates/header/top/logo') ?>
		</div>

		<div class="second-row <?php if(wpv_get_option('enable-header-search')) echo 'has-search' ?>">
			<div id="menus">
				<?php get_template_part('templates/header/top/main-menu') ?>
			</div>
		</div>

		<?php do_action('wpv_header_cart') ?>

		<?php if(wpv_get_option('enable-header-search')): ?>
			<div class="search-wrapper">
				<?php get_template_part('templates/header/top/search-button') ?>
			</div>
		<?php endif ?>

		<?php if(wpv_get_option('phone-num-top') != ''): ?>
			<div id="phone-num"><div><?php echo do_shortcode(wpv_get_option('phone-num-top'))?></div></div>
		<?php endif ?>
	</div>
</div>