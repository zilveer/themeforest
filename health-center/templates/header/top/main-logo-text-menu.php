<div class="header-content-wrapper">
	<div class="first-row limit-wrapper">
		<div class="first-row-wrapper">
			<div class="first-row-left">
				<?php get_template_part('templates/header/top/logo') ?>
			</div>
			<div class="first-row-right">
				<div class="first-row-right-inner">
					<div id="phone-num"><div><?php echo do_shortcode(wpv_get_option('phone-num-top'))?></div></div>
				</div>
			</div>
		</div>
	</div>

	<div class="second-row">
		<div class="limit-wrapper">
			<div class="second-row-columns">
				<div class="header-center">
					<div id="menus">
						<?php get_template_part('templates/header/top/main-menu') ?>
					</div>
				</div>

				<?php do_action('wpv_header_cart') ?>

				<div class="search-wrapper">
					<?php get_template_part('templates/header/top/search-button') ?>
				</div>
			</div>
		</div>
	</div>
</div>