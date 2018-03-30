<?php
/**
 * The main template file for display error page.
 *
 * @package WordPress
*/


get_header(); 

$pp_homepage_bg = get_option('pp_homepage_bg'); 

if(empty($pp_homepage_bg))
{
	$pp_homepage_bg = get_template_directory_uri().'/example/bg.jpg';
}

wp_enqueue_script("script-static-bg", get_template_directory_uri()."/templates/script-static-bg.php?bg_url=".$pp_homepage_bg, false, THEMEVERSION, true);
?>

<br class="clear"/>
</div>

<!-- Begin content -->
<div id="page_content_wrapper">

    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    		<div id="page_caption">
    			<h1 class="cufon"><?php _e( '404 Not Found', THEMEDOMAIN ); ?></h1>
    			
    			<?php _e( 'Apologies, but the page you requested could not be found.', THEMEDOMAIN ); ?><br/>
    		</div>
    		
    	</div>
    	
    </div>
    <br class="clear"/>
    <?php get_footer(); ?>