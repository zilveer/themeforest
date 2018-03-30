<?php
/**
 * The template for displaying 404 not found page.
 *
 * @package WordPress
 * @subpackage Quasar
 * @since Quasar 1.0
 */
 
 /*
Template Name:	404

*/


get_header(); ?>
<div class="vertical-space-big"></div>
	<div id="primary" class="content-area large-12 column">
		<div id="content" class="site-content error-404" role="main">
			<div class="row">
            
                <div class="large-9 columns large-centered">
                	<div class="large-10 large-centered columns">
                        <i class="fa fa-warning error-404-icon"></i>
                        <div class="error-404-details">
                            <h1 class="error-404-header"><?php _e('404 : PAGE NOT FOUND', 'quasar'); ?></h1>
                            <p class="error-404-description"><?php _e('Sorry, we couldn\'t find that page.','quasar'); ?></p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="vertical-space"></div>
                    
                    <p><strong><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. <br/>Please try the following:','quasar'); ?></strong></p>
                    <ul>
                        <li><?php _e('Make sure that the Web site address displayed in the address bar of your browser is spelled and formatted correctly','quasar'); ?></li>
                        <li><?php _e('If you reached this page by clicking a link, contact us to alert us that the link is incorrectly formatted','quasar'); ?></li>
                        <li><?php _e('Forget that this ever happened, and go to our ','quasar'); ?><a href="<?php echo home_url(); ?>"><?php _e('home page','quasar'); ?> <i class="fa-angle-double-right"></i></a></li>
                    </ul>
                    <div class="vertical-space-big"></div>
                </div>
                
            </div>
		</div><!-- #content -->
	</div><!-- #primary -->

</div>
<?php get_footer(); ?>