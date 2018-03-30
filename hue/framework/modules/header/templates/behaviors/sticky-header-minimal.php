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
						</div>
					</div>
					<div class="mkd-position-right">
						<div class="mkd-position-right-inner">
                            <a href="javascript:void(0)" class="mkd-fullscreen-menu-opener">
                                <span class="mkd-fullscreen-menu-opener-icon">
                                    <span class="mkd-fsm-first-line"></span>
                                    <span class="mkd-fsm-second-line"></span>
                                    <span class="mkd-fsm-third-line"></span>
                                </span>
                            </a>
						</div>
					</div>
				</div>
				<?php if($sticky_header_in_grid) : ?>
			</div>
		<?php endif; ?>
		</div>
	</div>

<?php do_action('hue_mikado_after_sticky_header'); ?>