<?php
if (!defined('ABSPATH')) exit();

$show_post_metadata = TMM::get_option("blog_listing_show_all_metadata");
$blog_listing_show_category = TMM::get_option("blog_listing_show_category");
$blog_listing_show_date = TMM::get_option("blog_listing_show_date");
$blog_listing_show_author = TMM::get_option("blog_listing_show_author");
$blog_listing_show_tags = TMM::get_option("blog_listing_show_tags");
$blog_listing_show_comments = TMM::get_option("blog_listing_show_comments");
$blog_listing_show_likes = TMM::get_option("blog_listing_show_likes");

$post_types = array(
	'audio',
	'video',
	'quote',
	'gallery',
);

$date_format = TMM::get_option('date_format');

if (have_posts()) {
	?>
	<div id="post-area">
	<?php
	while (have_posts()) {
		the_post();
		$post_pod_type = get_post_format();
		$post_type_values = get_post_meta($post->ID, 'post_type_values', true);

		if (!in_array($post_pod_type, $post_types)) {
			$post_pod_type = 'default';
		}

		?>

		<article id="post-<?php the_ID(); ?>" <?php (TMM::get_option("blog_listing_effect")&&(TMM::get_option("blog_listing_effect")!='none')) ? post_class("post full-width ". TMM::get_option("blog_listing_effect") ) : post_class("post full-width"); ?>>

			<?php get_template_part('article', $post_pod_type); ?>

			<?php if ($post_pod_type !== 'quote') { ?>

				<header class="entry-header">

					<h2 class="entry-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h2>

				</header>

				<div class="entry-content">
					<?php
					if( strpos( $post->post_content, '<!--more-->' ) ){
						the_content();
					} else {
						if (TMM::get_option("excerpt_symbols_count") !== '0') {
							$symbols_count = (TMM::get_option("excerpt_symbols_count") > 0) ? (int) TMM::get_option("excerpt_symbols_count") : 220;
							if (empty($post->post_excerpt)) {
								$txt = do_shortcode($post->post_content);
								$txt = strip_tags($txt);
								$txt = mb_substr($txt, 0, $symbols_count) . " ...";
							} else {
								$txt = mb_substr($post->post_excerpt, 0, $symbols_count) . " ...";
							}
							echo '<p>'.$txt.'</p>';
						}
					}
					?>
				</div>

			<?php } ?>

			<footer class="entry-footer">
				<?php  if ($show_post_metadata !== '0') { ?>

					<div class="left">
						<?php  if ($blog_listing_show_category !== '0') { ?>
							<span class="cat-links"><?php echo get_the_category_list(', '); ?></span>
						<?php } ?>
					</div>

					<div class="right">
						<?php  if ($blog_listing_show_date !== '0') { ?>
							<span class="posted-on"><a href="<?php echo esc_url(TMM_Helper::get_post_date_link(get_the_date('d.m.Y'))); ?>"><?php echo get_the_date($date_format); ?></a></span>
						<?php } ?>
						<?php if ($blog_listing_show_tags !== '0' && get_the_tags()) { ?>
							<span class="tags-links"><?php the_tags('', ', ', ''); ?></span>
						<?php } ?>
						<?php  if ($blog_listing_show_author !== '0' && get_the_author()) { ?>
							<span class="byline"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
						<?php } ?>
						<?php  if ($blog_listing_show_comments !== '0') { ?>
							<span class="comments-link"><a href="<?php echo esc_url(get_permalink()); ?>#comments"><?php echo get_comments_number(); ?></a></span>
						<?php } ?>
						<?php  if ($blog_listing_show_likes !== '0') { ?>
							<?php echo TMM_Helper::get_post_like($post->ID); ?>
						<?php } ?>
					</div>

				<?php } ?>
			</footer>

		</article>

		<?php
	}
	?>
	</div>
	<?php

	get_template_part('content', 'pagenavi');

} else {
	get_template_part('content', 'none');
}