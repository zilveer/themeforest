<?php 
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

get_header(); ?>
<div class="content-404">
	<h1 class="hN"><?php _e( 'Whoops!', 'heap' ); ?></h1>
	<p class="description"><?php _e( 'The page you’re looking for could have been deleted or never have existed*', 'heap' ); ?></p>
	<a class="btn btn--primary btn--beta btn--large" href="<?php echo home_url(); ?>" title="<?php bloginfo('name') ?>" rel="home">
		<?php _e( '&#8592; Return to the Home Page', 'heap' ); ?>
	</a>

</div>
<p class="description second"><?php _e( '*but you can hit space bar for another GIF', 'heap' ); ?></p>
<div class="overlay overlay--color"></div>
<div class="overlay overlay--shadow"></div>
  
<?php get_footer();