<div class="first-row limit-wrapper header-content-wrapper">
	<?php get_template_part('templates/header/top/logo') ?>
</div>

<div class="second-row">
	<div class="limit-wrapper">
		<div class="second-row-columns">
			<?php if(wpv_get_option('phone-num-top') != '' || wpv_get_option('enable-header-search')): ?>
				<div class="header-left">
					<?php if(wpv_get_option('phone-num-top') != ''): ?>
						<div id="phone-num"><div><?php echo do_shortcode(wpv_get_option('phone-num-top'))?></div></div>
					<?php endif ?>
				</div>
			<?php endif ?>

			<div class="header-center">
				<div id="menus">
					<?php get_template_part('templates/header/top/main-menu') ?>
				</div>
			</div>

			<?php do_action('wpv_header_cart') ?>

			<?php if(wpv_get_option('phone-num-top') != '' || wpv_get_option('enable-header-search')): ?>
				<div class="header-right">
					<?php get_template_part('templates/header/top/search-button') ?>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>