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
	$pp_homepage_bg = get_stylesheet_directory_uri().'/example/bg.jpg';
}
?>
<script type="text/javascript"> 
    jQuery.backstretch( "<?php echo $pp_homepage_bg; ?>", {speed: 'slow'} );
</script>

<!-- Begin content -->
<div id="page_content_wrapper">

    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    		<div id="page_caption" class="sidebar_content full_width" style="padding-bottom:0">
    			<h1 class="cufon"><?php _e( '404 Not Found', THEMEDOMAIN ); ?></h1>
    			<div class="page_control">
    				<a id="page_minimize" href="#">
    					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_minus.png" alt=""/>
    				</a>
    				<a id="page_maximize" href="#">
    					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    				</a>
    			</div>
    		</div>

    		<div class="sidebar_content full_width">
    
    			<p><?php _e( 'Apologies, but the page you requested could not be found.', THEMEDOMAIN ); ?></p>

    		</div>
    		
    	</div>
    	
    </div>
    <br class="clear"/>
    <?php get_footer(); ?>
</div>
<!-- End content -->
<br class="clear"/>