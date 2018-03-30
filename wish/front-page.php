<?php  
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} else {

?>
<?php get_header() ?>


<div <?php post_class("wish-full-width front-page container"); ?> >
<?php if(have_posts()): while(have_posts()): the_post(); ?>

			<?php the_content(); ?>

<?php endwhile; ?>

<?php endif; ?>
</div>
	   
<?php get_footer() ?>


<?php } ?>