<?php if(($content_bottom_area == "yes") && (is_active_sidebar($content_bottom_area_sidebar))) { ?>
	<div class="mkd-content-bottom" <?php libero_mikado_inline_style($content_bottom_background_color); ?>>
		<?php if($content_bottom_area_in_grid == 'yes'){ ?>
			<div class="mkd-container">
				<div class="mkd-container-inner clearfix">
		<?php } ?>
				<?php dynamic_sidebar($content_bottom_area_sidebar); ?>
		<?php if($content_bottom_area_in_grid == 'yes'){ ?>
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>