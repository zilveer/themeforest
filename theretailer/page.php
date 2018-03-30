<?php get_header(); ?>

<div class="global_content_wrapper page_default">

<div class="container_12">

    <div class="grid_12">

		<?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', 'page' ); ?>

        <?php endwhile; // end of the loop. ?>
        
	</div>

</div>

</div>

<?php get_template_part("light_footer"); ?>
<?php get_template_part("dark_footer"); ?>

<?php get_footer(); ?>