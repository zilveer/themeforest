<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */

get_header('error');
global $road_opt;
?>
	<div class="page-404">
		<div class="message-404">
			<h3><?php _e( "Page not found", "roadthemes" ); ?></h3>
			<p class="home-link"><?php _e( "Please go to the home page: ", 'roadthemes' ); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php _e( 'home page', 'roadthemes' ); ?>"><?php _e( 'home page', 'roadthemes' ); ?></a></p>
			
		</div>
	</div>
</div>
<?php get_footer('error'); ?>