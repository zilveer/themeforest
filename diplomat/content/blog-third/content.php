<?php
$image_size = '745*450';

$post_link = get_permalink($post->ID);

$post_title = $post->post_title;
$title_symbols_count = $_REQUEST['title_symbols'];
if ($_REQUEST['title_symbols'])
	$post_title = (strlen($post_title)> $title_symbols_count) ? mb_substr($post_title, 0, $title_symbols_count) . " ..." : $post_title;
?>
<div class="entry-media">

	<?php include(locate_template('article-default.php')); ?>

	<div class="entry-content">

		<header class="entry-header">

			<h3 class="entry-title"><a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($post_title); ?></a></h3>

		</header>

		<footer class="entry-footer">

			<span class="posted-on"><a href="<?php echo esc_url(TMM_Helper::get_post_date_link(get_the_date('d.m.Y', $post->ID))); ?>"><?php echo get_the_date(TMM::get_option('date_format'), $post->ID) ?></a></span>

			<?php if (get_the_author()) { ?>
			<span class="byline"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
			<?php } ?>

			<span class="comments-link"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>#comments"><?php echo esc_html($post->comment_count); ?></a></span>

		</footer>

	</div>

</div>