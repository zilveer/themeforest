<?php
if (is_page_template('template-nocontent.php')) :
	the_content();
else :
	global $smof_data; ?>
	<footer id="footer">
		<div class="right-side"><?php
			if(!empty($smof_data['footer_right_side']))
					echo wp_kses_post(do_shortcode($smof_data['footer_right_side']));
				else
					echo do_shortcode( __('&copy; [the-year] [blog-title]. All Rights Reserved.', 'royalgold') ); ?></div>
		<div class="left-side"><?php
			if( ! empty($smof_data['footer_left_side'])) {
				echo wp_kses_post(do_shortcode($smof_data['footer_left_side']));
			}
		?></div>
		<div class="clear"></div>
	</footer>

<?php
	get_template_part('part-background');
endif; // if full template

wp_footer(); ?>
</body>
</html>