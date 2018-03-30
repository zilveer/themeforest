<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 */

get_header();

?>
<div class="wrapper">

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<header class="pageheader">
			<h1><?php the_title(); ?></h1>
		</header><!-- /.pageheader -->
	<?php endwhile; endif; ?>

	<?php thb_page_before(); ?>

		<?php thb_page_start(); ?>
		<?php
			rewind_posts();
			get_template_part("loop/attachments");
		?>
		<?php thb_page_end(); ?>
</div>
	<?php thb_page_after(); ?>

<?php get_footer(); ?>