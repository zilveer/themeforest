<?php if($image != '') {  ?>
	<div class="qodef-client-holder <?php echo esc_attr($class);?>" <?php echo qode_startit_get_inline_style($client_styles); ?>>
		<div class="qodef-client-holder-inner">
			<div class="qodef-client-image-holder">
				<?php if($link != '') { ?>
					<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($link_target); ?>">
				<?php } else { ?>
                    <span class="qodef-client-image-nolink">
                <?php } ?>
					<span class="qodef-client-image">
						<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_url($image_alt); ?>" />
					</span>
					<?php if($hover_image != '') {  ?>
						<span class="qodef-client-hover-image">
							<img src="<?php echo esc_url($hover_image); ?>" alt="<?php echo esc_url($hover_image_alt); ?>" />
						</span>
					<?php } ?>
				<?php if($link != '') { ?>
					</a>
                <?php } else { ?>
                    </span>
                <?php } ?>
			</div>
		</div>
	</div>
<?php } ?>