<?php
/**
 * Template Name: Maintenance 1
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

global $post, $breadcrumb;
get_header(); ?>

<style type="text/css">
	html {
		height: 100%;
		width: 100%;
		margin: 0 !important;
	}
</style>

<?php $layout = cshero_generetor_layout();?>
	<div id="primary" class="content-area<?php if($breadcrumb == '0'){ echo ' no_breadcrumb_page'; }; ?><?php echo esc_attr($layout->class); ?>">
        <div class="<?php echo get_post_meta($post->ID, 'cs_layout', true) ? 'no-container' : 'container'; ?>">
			<div class="row">
				<div class="content-wrap <?php echo esc_attr($layout->blog); ?>">
                    <main id="main" class="site-main" role="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'framework/templates/page/page'); ?> 
                        <?php endwhile; // end of the loop. ?>
                    </main><!-- #main -->
                </div>
			</div>
		</div>
	</div><!-- #primary -->
<?php get_footer(); ?>

