<?php
$image_size = TMM_Helper::blog_classic_alias();

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

$post_title = $post->post_title;
$title_symbols_count = $_REQUEST['title_symbols'];
if ($_REQUEST['title_symbols'])
    $post_title = (strlen($post_title)> $title_symbols_count) ? substr($post_title, 0, $title_symbols_count) . " ..." : $post_title;

$excerpt_symbols_count = ($_REQUEST['excerpt_symbols']) ? $_REQUEST['excerpt_symbols'] : '0';

 get_template_part('article', $post_pod_type); ?>

<?php if ($post_pod_type !== 'quote') { ?>

	<header class="entry-header">

		<h3 class="entry-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html($post_title); ?></a></h3>

	</header>

	<?php

	if ($_REQUEST['show_excerpt']){
		?>

		<div class="entry-content">

			<?php
			if( strpos( $post->post_content, '<!--more-->' ) ){
				the_content();
			} else {
				if (empty($post->post_excerpt)) {
					$txt = do_shortcode($post->post_content);
					$txt = strip_tags($txt);
					$txt = (strlen($txt)>$excerpt_symbols_count ) ? (substr($txt, 0, $excerpt_symbols_count) . " ...") : $txt;

				} else {
					$txt =  (strlen($post->post_excerpt) > $excerpt_symbols_count) ? (substr($post->post_excerpt, 0, $excerpt_symbols_count) . " ...") : $post->post_excerpt;
				}
				echo '<p>'.$txt.'</p>';
			}
			?>

		</div>

	<?php } ?>

<?php } ?>

<footer class="entry-footer">

	<div class="left">

		<span class="cat-links"><?php echo get_the_category_list(', '); ?></span>

	</div>

	<div class="right">

		<span class="posted-on"><a href="<?php echo esc_url(TMM_Helper::get_post_date_link(get_the_date('d.m.Y'))); ?>"><?php echo esc_html(get_the_date(TMM::get_option('date_format'))); ?></a></span>

	<?php if (get_the_tags() && ($_REQUEST['show_tags'])) { ?>
		<span class="tags-links"><?php the_tags('', ', ', ''); ?></span>
	<?php } ?>

	<?php if ($_REQUEST['show_author'] && get_the_author()){ ?>
		<span class="byline"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
	<?php } ?>

		<span class="comments-link"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>#comments"><?php echo get_comments_number(); ?></a></span>

		<?php echo TMM_Helper::get_post_like($post->ID); ?>

	</div>

</footer>