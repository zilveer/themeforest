<?php if($show_header_top) : ?>

	<?php do_action('hue_mikado_before_header_top'); ?>
    <?php if($show_header_top_background_div){ ?>
        <div class="mkd-top-bar-background"></div>
    <?php } ?>
	<div class="mkd-top-bar">
		<?php if($top_bar_in_grid) : ?>
		<div class="mkd-grid">
			<?php endif; ?>
			<?php do_action('hue_mikado_after_header_top_html_open'); ?>
			<div class="mkd-vertical-align-containers <?php echo esc_attr($column_widths); ?>">
				<div class="mkd-position-left mkd-top-bar-widget-area">
					<div class="mkd-position-left-inner mkd-top-bar-widget-area-inner">
						<?php if(is_active_sidebar('mkd-top-bar-left')) : ?>
							<?php dynamic_sidebar('mkd-top-bar-left'); ?>
						<?php endif; ?>
					</div>
				</div>
				<?php if($show_widget_center) { ?>
					<div class="mkd-position-center mkd-top-bar-widget-area">
						<div class="mkd-position-center-inner mkd-top-bar-widget-area-inner">
							<?php if(is_active_sidebar('mkd-top-bar-center')) : ?>
								<?php dynamic_sidebar('mkd-top-bar-center'); ?>
							<?php endif; ?>
						</div>
					</div>
				<?php } ?>
				<div class="mkd-position-right mkd-top-bar-widget-area">
					<div class="mkd-position-right-inner mkd-top-bar-widget-area-inner">
						<?php if(is_active_sidebar('mkd-top-bar-right')) : ?>
							<?php dynamic_sidebar('mkd-top-bar-right'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php if($top_bar_in_grid) : ?>
		</div>
	<?php endif; ?>
	</div>

	<?php do_action('hue_mikado_after_header_top'); ?>

<?php endif; ?>