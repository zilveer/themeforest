<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      2.3
 */
?>

<section class="main">
	<h1 class="title">
		<a href="<?php
			if (Website::po('link/url')) {
				echo Website::po('link/url');
			} else {
				the_permalink();
			}
		?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
	</h1>
	<?php get_template_part('content', 'portfolio-item'); ?>
</section>