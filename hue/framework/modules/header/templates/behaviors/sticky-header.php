<?php do_action('hue_mikado_before_sticky_header'); ?>

	<div class="mkd-sticky-header">
		<?php do_action('hue_mikado_after_sticky_menu_html_open'); ?>
		<div class="mkd-sticky-holder">
			<?php if($sticky_header_in_grid) : ?>
			<div class="mkd-grid">
				<?php endif; ?>
				<div class=" mkd-vertical-align-containers">
					<div class="mkd-position-left">
						<div class="mkd-position-left-inner">
							<?php if(!$hide_logo) {
								hue_mikado_get_logo('sticky');
							} ?>
                            <?php hue_mikado_get_sticky_menu('mkd-sticky-nav'); ?>
						</div>
					</div>
					<div class="mkd-position-right">
						<div class="mkd-position-right-inner">
							<?php if(is_active_sidebar('mkd-sticky-right')) : ?>
								<div class="mkd-sticky-right-widget-area">
									<?php dynamic_sidebar('mkd-sticky-right'); ?>
								</div>

							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php if($sticky_header_in_grid) : ?>
			</div>
		<?php endif; ?>
		</div>
	</div>

<?php do_action('hue_mikado_after_sticky_header'); ?>