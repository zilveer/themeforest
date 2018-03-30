<div class="qodef-blog-list-holder <?php echo esc_attr($holder_classes) ?>">
	<ul class="qodef-blog-list">
	<?php if ($type == 'masonry') { ?>
		<li class="qodef-blog-list-masonry-grid-sizer"></li>
		<li class="qodef-blog-list-masonry-grid-gutter"></li>
	<?php } 
	$html = '';
		if($query_result->have_posts()):
		while ($query_result->have_posts()) : $query_result->the_post();
			$html .= qode_startit_get_shortcode_module_template_part('templates/'.$type, 'blog-list', '', $params);
		endwhile;
		print $html;
		else: ?>
		<div class="qodef-blog-list-messsage">
			<p><?php esc_html_e('No posts were found.', 'startit'); ?></p>
		</div>
		<?php endif;
		wp_reset_postdata();
	?>
	</ul>	
</div>
