<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files there is a collection of a functions useful for the core
 * of the framework.   
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$span_image = yit_get_sidebar_layout() == 'sidebar-no' ? 5 : 4;
$span_text = yit_get_sidebar_layout() == 'sidebar-no' ? 6 : 5;

if( !yit_get_option( '404-custom' ) ) : ?>
	<div class="border-bold">
		<div class="border">
			<div class="border-img">
				<img class="error-404-image group" src="<?php echo get_template_directory_uri() ?>/images/404.png" title="<?php _e( 'Error 404', 'yit' ); ?>" alt="404" />
			</div>
		</div>
	</div>
	
    <div class="error-404-text group left-text">
    	<h1><?php echo __( 'WHOOPS, OUR BAD...', 'yit' ); ?></h1>
    	<p><?php echo __( 'The page you requested was not found, and we have a fine guess why.<br /><br />- If you typed the URL directly, please make sure the spelling is correct.<br />- If you clicked on a link to get here, the link is outdated.', 'yit' ); ?></p>
   </div>
   <div class="error-404-text group right-text">
    	<h2><?php echo __( 'WHAT CAN I DO?', 'yit' ); ?></h2>
    	<p><?php printf( __( 'There are many ways you can get back on track with %s<br />- Go to the <a href="%s">home page</a><br />- Use the search form below', 'yit' ), get_bloginfo( 'title' ), home_url() ) ?></p>
        <?php get_search_form() ?>
    </div>
<?php
else : 
    if( yit_get_option( '404-image-position' ) == 'left' ) : ?>
    	<div class="border-bold span<?php echo $span_image; ?> no-margin">
    		<div class="border">
				<div class="border-img">
		        	<img class="error-404-image group" src="<?php echo yit_get_option( '404-image' ); ?>" title="<?php _e( '404 Error', 'yit' ) ?>" alt="<?php _e( '404 Error', 'yit' ) ?>" />
		    	</div>
    		</div>
    	</div>
		<div class="error-404-text group left-text span<?php echo $span_text; ?>"><?php echo yit_convert_tags( yit_addp( do_shortcode( stripslashes( yit_get_option( '404-text' ) ) ) ) ); get_search_form() ?></div>
    <?php else : ?> 
        <div class="error-404-text group right-text span<?php echo $span_text; ?> no-margin"><?php echo yit_convert_tags( yit_addp( do_shortcode( stripslashes( yit_get_option( '404-text' ) ) ) ) ); get_search_form() ?></div>
        <div class="border-bold span<?php echo $span_image; ?>">
    		<div class="border">
				<div class="border-img">
        			<img class="error-404-image group" src="<?php echo yit_get_option( '404-image' ); ?>" title="<?php _e( '404 Error', 'yit' ) ?>" alt="<?php _e( '404 Error', 'yit' ) ?>" />
        		</div>
    		</div>
    	</div>
    <?php
    endif;
endif;
?>