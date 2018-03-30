<?php

/**
 * Scrollable blog
 *
 * @package wpv
 */

global $wpv_loop_vars, $wp_query;
$old_wpv_loop_vars = $wpv_loop_vars;
$wpv_loop_vars = array(
	'image' => $image,
	'show_content' => $show_content,
	'width' => $width,
	'news' => true,
	'column' => $column,
	'scrollable' => true,
	'layout' => 'scroll-x',
);

?>
<div class="scrollable-wrapper">
	<div class="loop-wrapper clearfix news scroll-x">
		<ul class="clearfix" data-columns="<?php echo $column ?>">
			<?php
				$useColumns = $column > 1;
				$i = 0;
				global $wp_query;
				if(have_posts()) while(have_posts()): the_post();
					$last_in_row = (($i+1)%$column == 0 ||  $wp_query->post_count == $wp_query->current_post + 1);

					$post_class = array();
					$post_class[] = 'page-content post-head';
					$post_class[] = 'list-item';
				?>
					<li <?php post_class(implode(' ', $post_class)) ?>>
						<div>
							<?php get_template_part('templates/post');	?>
						</div>
					</li>
				<?php
					$i++;
				endwhile;
			?>
		</ul>
	</div>
</div>

<?php $wpv_loop_vars = $old_wpv_loop_vars; ?>
