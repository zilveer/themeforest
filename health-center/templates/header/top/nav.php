<?php
	/**
	 * Top bar (above the logo)
	 * @package wpv
	 */

	$layout = wpv_get_option('top-bar-layout');

	$layout = !empty($layout) ? explode('-', $layout) : null;
?>
<?php if( $layout ): ?>
	<div id="top-nav-wrapper">
		<?php do_action('wpv_top_nav_before') ?>
		<nav class="top-nav <?php echo implode('-', $layout) ?>">
			<div class="<?php if(wpv_get_option('header-layout') != 'logo-menu' || !wpv_get_option('full-width-header')) echo 'limit-wrapper' ?> top-nav-inner">
				<div class="row">
					<div class="row">
						<?php
							foreach($layout as $part) {
								get_template_part('templates/header/top/nav', $part);
							}
						?>
					</div>
				</div>
			</div>
		</nav>
		<?php do_action('wpv_top_nav_after') ?>
	</div>
<?php endif ?>