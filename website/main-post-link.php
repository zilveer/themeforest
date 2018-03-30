<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<section class="main">
	<h1 class="title">
		<a href="<?php
			if ((Website::to('format_post/link/title/link') == 'url' || is_singular()) && Website::po('link/url')) {
				echo Website::po('link/url');
			} else {
				the_permalink();
			}
		?>" title="<?php the_title_attribute(); ?>"<?php if (Website::to('format_post/link/title/target_blank')) echo ' target="_blank"'; ?>><?php the_title(); ?></a>
	</h1>
	<?php get_template_part('content', 'post'); ?>
</section>