<?php
/*
Template Name: Blank Page
*/
?>
<?php get_header() ?>



<div <?php post_class("wish-blank"); ?> >
<?php if(have_posts()): while(have_posts()): the_post(); ?>

			<?php the_content(); ?>

<?php endwhile; ?>

<?php endif; ?>
</div>
	   
<?php get_footer() ?>