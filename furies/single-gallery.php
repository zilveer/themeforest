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

<div class="page_control">
    <a id="page_minimize" href="#">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/icon_minus.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>

<!-- Begin content -->
<div id="page_content_wrapper">

    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    		<div id="page_caption">
    			<h1 class="cufon"><?php _e( 'How to create gallery page', THEMEDOMAIN ); ?></h1>
    		</div>

    		<div id="page_main_content" class="sidebar_content full_width transparentbg">
    
    			<p>You have to create a page and attach gallery to it instead of directly link to the gallery.</p>
    			
    			<p>
    				Furies has 10 predefined gallery templates. From your admin sidebar, open <strong>Pages > Add New</strong>. You will get add new page form. Enter page title and description.
					<br/><br/>
					Next look at <strong>"Page Options" box</strong>. On gallery... templates, you can select "Static image" or "Slideshow" as page background. If you select "Slideshow" then you have to select "Background Gallery" for it. But if you choose "Static image", you have to upload "set featured image" for its background.
					<br/><br/>
					Then you have to select "Content Gallery". This is the main images contents display on page and every gallery templates have to had this option selected.
					<br/><br/>
					You can also add "Password Protected" for this individual gallery page. Just enter your gallery password and when visitor view your page, they will need to enter password, you have entered here. This is option is best for displaying image gallery for certain customers :)
					<br/><br/>
					Next look at <strong>Page Attributes" box</strong>. Furies has 10 predefined gallery templates and you can select one for this page :)
    			</p>
    			
    			<br/><br/><hr/>
    			
    			<p><strong>Please follow the theme's instructions in /manual/index.html it will help you get through all theme features.</strong></p>

    		</div>
    		
    	</div>
    </div>
    	
<!-- End content -->

<?php
//Setup Google Analytic Code
get_template_part ("google-analytic");
?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>