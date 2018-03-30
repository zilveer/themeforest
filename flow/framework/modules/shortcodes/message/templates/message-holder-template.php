<div class="eltd-message  <?php echo esc_attr($message_classes)?>" <?php  echo flow_elated_get_inline_style($message_styles)?>>
	<div class="eltd-message-inner">
		<?php		
		if($type == 'with_icon'){
			$icon_html = flow_elated_get_shortcode_module_template_part('templates/' . $type, 'message', '', $params);
			print $icon_html;
		}
		?>
		<a href="#" class="eltd-close">
			<i class="eltd_font_elegant_icon icon_close"></i>
		</a>
		<div class="eltd-message-text-holder">
			<div class="eltd-message-text">
				<div class="eltd-message-text-inner">
					<?php echo do_shortcode($content)?>
				</div>
			</div>
		</div>
	</div>
</div>
