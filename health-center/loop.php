<?php

/**
 * Catch-all post loop
 */

// display full post/image or thumbs
if(!isset($called_from_shortcode)) {
	$image = 'true';
	$show_content = true;
	$nopaging = false;
	$width = 'full';
	$news = false;
	$layout = 'normal';
	$column = 1;
}

global $wpv_loop_vars;
$old_wpv_loop_vars = $wpv_loop_vars;
$wpv_loop_vars = array(
	'image' => $image,
	'show_content' => $show_content,
	'width' => $width,
	'news' => $news,
	'column' => $column,
	'layout' => $layout,
);

?>
<div class="loop-wrapper clearfix <?php if($news) echo 'news row'; else echo 'regular'; ?> <?php if($layout) echo $layout ?> <?php if(!$nopaging) echo 'paginated' ?>" data-columns="<?php echo $column ?>">
<?php

	do_action('wpv_before_main_loop');

	$i = 0;
	global $wp_query;
	if(have_posts()) while(have_posts()): the_post();

		$post_class = array();
		$post_class[] = 'page-content post-header';
		$post_class[] = $column > 1 ? "grid-1-$column" : 'clearfix';
		if($news && $i%$column == 0)
			$post_class[] = 'clearboth';

		if(!is_single())
			$post_class[] = 'list-item';
?>
		<div <?php post_class(implode(' ', $post_class)) ?> >
			<div>
				<?php get_template_part('templates/post', get_post_type());	?>
			</div>
		</div>
<?php
		$i++;
	endwhile;

	do_action('wpv_after_main_loop');
?>
</div>

<?php $wpv_loop_vars = $old_wpv_loop_vars; ?>
<?php if(!$nopaging) WpvTemplates::pagination() ?>
