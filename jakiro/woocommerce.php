<?php 
$main_class = dh_get_main_class();
?>
<?php get_header('shop') ?>
	<div class="content-container">
		<div class="<?php dh_container_class() ?>">
			<div class="row">
				<?php do_action('dh_left_sidebar')?>
				<?php do_action('dh_left_sidebar_extra')?>
				<div class="<?php echo esc_attr($main_class) ?>" role="main" data-itemprop="mainContentOfPage">
					<div class="main-content">
						<?php 
						if(class_exists('DH_Woocommerce'))
							DH_Woocommerce::content();
						?>
					</div>
				</div>
				<?php do_action('dh_right_sidebar_extra')?>
				<?php do_action('dh_right_sidebar')?>
			</div>
		</div>
	</div>
<?php get_footer('shop') ?>