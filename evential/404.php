<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Evential
 * @subpackage Evential
 * @since Evential 1.0
 */

get_header(); ?>
<?php 
	global $tlazya_evential; 
	if (isset($tlazya_evential['inner_url']['url']) && $tlazya_evential['inner_url']['url'] != '' ) { 
?>
<section id="top" class="innder-page" style="background: url(<?php echo esc_url($tlazya_evential['inner_url']['url']); ?>) no-repeat 0% 0%;">
<?php 
	}
	else 
	{
?>
<section id="top" class="innder-page" style="background: url(<?php echo get_template_directory_uri(); ?>/img/register-bg.png) no-repeat 0% 0%;">
<?php
	}
?>
	<div class="container">
		<div class="countdown">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 text-center">
					<h1 class="contant_404_header_title"><?php _e( 'Not Found', 'evential' ); ?></h1>
					<h3><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'evential' ); ?></h3>
					<br/>
					<?php get_search_form(); ?>
					<h3>OR</h3>
					<p>Get bact to <a href="<?php echo get_home_url(); ?>" title="home">Home</a></p>
				</div>
			</div><!-- #content -->
		</div><!-- #primary -->
	</div>
</section>
<?php
get_footer();
