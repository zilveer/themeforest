<?php
$post_types = array(
	'audio',
	'video',
	'quote',
	'gallery',
);

$post_pod_type = get_post_format();
$post_type_values = get_post_meta($post->ID, 'post_type_values', true);

if (!in_array($post_pod_type, $post_types)) {
	$post_pod_type = 'default';
}
$image_size = '360*218';

$post_link = get_permalink($post->ID);

$post_title = $post->post_title;
$title_symbols_count = $_REQUEST['title_symbols'];
if ($_REQUEST['title_symbols'])
	$post_title = (strlen($post_title)> $title_symbols_count) ? substr($post_title, 0, $title_symbols_count) . " ..." : $post_title;

$excerpt_symbols_count = ($_REQUEST['excerpt_symbols']) ? $_REQUEST['excerpt_symbols'] : '0';

?>
<div class="row">
	<div class="large-6 columns">
		<div class="entry-media">
			<?php get_template_part('article', $post_pod_type);?>
		</div>
	</div>
	<div class="large-6 columns">
		<div class="entry-content">

			<header class="entry-header">

				<h4 class="entry-title"><a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($post_title); ?></a></h4>

			</header>

			<?php if ($post_pod_type !== 'quote' && $_REQUEST['show_excerpt']) { ?>
				<div class="entry-content">
					<p>
						<?php
						if( strpos( $post->post_content, '<!--more-->' ) ){
							the_content();
						} else {
							if (empty($post->post_excerpt)) {
								$txt = do_shortcode($post->post_content);
								$txt = strip_tags($txt);
								echo (strlen($txt)>$excerpt_symbols_count ) ? (substr($txt, 0, $excerpt_symbols_count) . " ...") : $txt;
							} else {
								echo (strlen($post->post_excerpt) > $excerpt_symbols_count) ? (substr($post->post_excerpt, 0, $excerpt_symbols_count) . " ...") : $post->post_excerpt;
							}
						}
						?>
					</p>
				</div>
			<?php } ?>

			<footer class="entry-footer">

				<div class="left">
					<span class="cat-links"><?php echo get_the_category_list(', ', '', $post->ID); ?></span>
				</div>

				<div class="right">
					<span class="posted-on"><a href="<?php echo esc_url(TMM_Helper::get_post_date_link(get_the_date('d.m.Y', $post->ID))); ?>"><?php echo get_the_date(TMM::get_option('date_format'), $post->ID) ?></a></span>
					<span class="comments-link"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>#comments"><?php echo esc_html($post->comment_count); ?></a></span>
				</div>

			</footer>

		</div>
	</div>
</div>


