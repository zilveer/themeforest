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
    			<h1 class="cufon"><?php _e( 'How to create gallery page', THEMEDOMAIN ); ?></h1>
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
    
    			<p>You have to create a page and attach gallery to it instead of directly link to the gallery.</p>
    			
    			<p>
    				Artemis has 7 predefined gallery templates. From your admin sidebar, open <strong>Pages > Add New</strong>. You will get add new page form. Enter page title and description.
					<br/><br/>
					Next look at <strong>"Page Options" box</strong>. On gallery... templates, you can select "Static image" or "Slideshow" as page background. If you select "Slideshow" then you have to select "Background Gallery" for it. But if you choose "Static image", you have to upload "set featured image" for its background.
					<br/><br/>
					Then you have to select "Content Gallery". This is the main images contents display on page and every gallery templates have to had this option selected.
					<br/><br/>
					You can also add "Password Protected" for this individual gallery page. Just enter your gallery password and when visitor view your page, they will need to enter password, you have entered here. This is option is best for displaying image gallery for certain customers :)
					<br/><br/>
					Next look at <strong>Page Attributes" box</strong>. Artemis has 6 predefined gallery templates and you can select one for this page :)
    			</p>
    			
    			<br/><br/><hr/>
    			
    			<p><strong>Please follow the theme's instructions in /manual/index.html it will help you get through all theme features.</strong></p>

    		</div>
    		
    	</div>
    	
    </div>
    <br class="clear"/>
    <?php get_footer(); ?>
</div>
<!-- End content -->
<br class="clear"/>