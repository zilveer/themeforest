<?php
/**
 * Single For Gallery
 * @package by Theme Record
 * @auther: MattMao
 */
get_header();

?>
<div id="main" class="fullwidth">

<!--Begin Content-->
<article id="content">
	<?php if (have_posts()) : the_post(); ?>

	<div class="post post-gallery-single clearfix" id="post-<?php the_ID(); ?>">

	<?php theme_post_gallery('gallery'); ?>

	<?php 
		$content = get_the_content(); 
		if($content) : 
	?>
		<div class="post-format">
		<?php the_content(); ?>
		</div>
	<?php endif; ?>

	</div>
	<!--End Portfolio Single-->

	<?php endif; ?>
</article>
<!--End Content-->

</div>
<!-- #main -->

<?php get_footer(); ?>
