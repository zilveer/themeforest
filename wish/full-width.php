<?php
/*
Template Name: Full Width
*/
?>
<?php get_header() ?>



<div <?php post_class("wish-full-width"); ?> >
<?php if(have_posts()): while(have_posts()): the_post(); ?>

			<?php the_content(); ?>

<?php endwhile; ?>

<?php endif; ?>
</div>
	   
<?php get_footer() ?>