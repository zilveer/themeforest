<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 */
?>
	
<?php
	/**
    *	Setup Google Analyric Code
    **/
    include (get_template_directory() . "/google-analytic.php");
?>

<br class="clear"/>
<?php
    $pp_footer_display_sidebar = get_option('pp_footer_display_sidebar');

    if(!empty($pp_footer_display_sidebar))
    {
    	$pp_footer_style = get_option('pp_footer_style');
    	$footer_class = '';
    	
    	switch($pp_footer_style)
    	{
    		case 1:
    			$footer_class = 'one';
    		break;
    		case 2:
    			$footer_class = 'two';
    		break;
    		case 3:
    			$footer_class = 'three';
    		break;
    		case 4:
    			$footer_class = 'four';
    		break;
    		default:
    			$footer_class = 'four';
    		break;
    	}
    	
    	global $pp_homepage_style;
?>
<div id="footer" class="<?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo $pp_homepage_style; } ?> fade-in two">
<ul class="sidebar_widget <?php echo $footer_class; ?>">
    <?php dynamic_sidebar('Footer Sidebar'); ?>
</ul>

<br class="clear"/>
</div>
<?php
    }
?>

</div>

</div>

<?php
	global $pp_homepage_style;
?>
<div class="footer_bar <?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo $pp_homepage_style; } ?> fade-in two">
	<div class="footer_bar_wrapper">
	    <?php
	        $pp_footer_text = get_option('pp_footer_text');
	        if(!empty($pp_footer_text))
	        {
	        	echo '<div id="copyright">'.pp_apply_content(stripslashes($pp_footer_text)).'</div>';
	        }
	    ?>
	    <div class="social_wrapper">
	        <ul>
	            <?php
	            	$pp_twitter_username = get_option('pp_twitter_username');
	            	
	            	if(!empty($pp_twitter_username))
	            	{
	            ?>
	            <li><a title="Twitter" href="http://twitter.com/<?php echo $pp_twitter_username; ?>" target="_blank"><img width="20px" height="20px" src="<?php echo get_template_directory_uri(); ?>/images/social/twitter.png" alt=""/></a></li>
	            <?php
	            	}
	            ?>
	            <?php
	            	$pp_facebook_username = get_option('pp_facebook_username');
	            	
	            	if(!empty($pp_facebook_username))
	            	{
	            ?>
	            <li><a title="Facebook" href="http://facebook.com/<?php echo $pp_facebook_username; ?>" target="_blank"><img width="20px" height="20px" src="<?php echo get_template_directory_uri(); ?>/images/social/facebook.png" alt=""/></a></li>
	            <?php
	            	}
	            ?>
	            <?php
	            	$pp_flickr_username = get_option('pp_flickr_username');
	            	
	            	if(!empty($pp_flickr_username))
	            	{
	            ?>
	            <li><a title="Flickr" href="http://flickr.com/people/<?php echo $pp_flickr_username; ?>" target="_blank"><img width="20px" height="20px" src="<?php echo get_template_directory_uri(); ?>/images/social/flickr.png" alt=""/></a></li>
	            <?php
	            	}
	            ?>
	            <?php
	            	$pp_youtube_username = get_option('pp_youtube_username');
	            	
	            	if(!empty($pp_youtube_username))
	            	{
	            ?>
	            <li><a title="Youtube" href="http://youtube.com/user/<?php echo $pp_youtube_username; ?>" target="_blank"><img width="20px" height="20px" src="<?php echo get_template_directory_uri(); ?>/images/social/youtube.png" alt=""/></a></li>
	            <?php
	            	}
	            ?>
	            <?php
	            	$pp_vimeo_username = get_option('pp_vimeo_username');
	            	
	            	if(!empty($pp_vimeo_username))
	            	{
	            ?>
	            <li><a title="Vimeo" href="http://vimeo.com/<?php echo $pp_vimeo_username; ?>" target="_blank"><img width="20px" height="20px" src="<?php echo get_template_directory_uri(); ?>/images/social/vimeo.png" alt=""/></a></li>
	            <?php
	            	}
	            ?>
	            <?php
	            	$pp_tumblr_username = get_option('pp_tumblr_username');
	            	
	            	if(!empty($pp_tumblr_username))
	            	{
	            ?>
	            <li><a title="Tumblr" href="http://<?php echo $pp_tumblr_username; ?>.tumblr.com" target="_blank"><img width="20px" height="20px" src="<?php echo get_template_directory_uri(); ?>/images/social/tumblr.png" alt=""/></a></li>
	            <?php
	            	}
	            ?>
	            <?php
	            	$pp_google_username = get_option('pp_google_username');
	            	
	            	if(!empty($pp_google_username))
	            	{
	            ?>
	            <li><a title="Google+" href="<?php echo $pp_google_username; ?>" target="_blank"><img width="20px" height="20px" src="<?php echo get_template_directory_uri(); ?>/images/social/google.png" alt=""/></a></li>
	            <?php
	            	}
	            ?>
	            <?php
	            	$pp_dribbble_username = get_option('pp_dribbble_username');
	            	
	            	if(!empty($pp_dribbble_username))
	            	{
	            ?>
	            <li><a title="Dribbble" href="http://dribbble.com/<?php echo $pp_dribbble_username; ?>" target="_blank"><img width="20px" height="20px" src="<?php echo get_template_directory_uri(); ?>/images/social/dribbble.png" alt=""/></a></li>
	            <?php
	            	}
	            ?>
	            <?php
	            	$pp_linkedin_username = get_option('pp_linkedin_username');
	            	
	            	if(!empty($pp_linkedin_username))
	            	{
	            ?>
	            <li><a title="Linkedin" href="<?php echo $pp_linkedin_username; ?>" target="_blank"><img width="20px" height="20px" src="<?php echo get_template_directory_uri(); ?>/images/social/linkedin.png" alt=""/></a></li>
	            <?php
	            	}
	            ?>
	            <?php
	            	$pp_pinterest_username = get_option('pp_pinterest_username');
	            	
	            	if(!empty($pp_pinterest_username))
	            	{
	            ?>
	            <li><a title="Pinterest" href="http://pinterest.com/<?php echo $pp_pinterest_username; ?>" target="_blank"><img width="20px" height="20px" src="<?php echo get_template_directory_uri(); ?>/images/social/pinterest.png" alt=""/></a></li>
	            <?php
	            	}
	            ?>
	            <?php
	            	$pp_instagram_username = get_option('pp_instagram_username');
	            	
	            	if(!empty($pp_instagram_username))
	            	{
	            ?>
	            <li><a title="Instagram" href="http://instagram.com/<?php echo $pp_instagram_username; ?>" target="_blank"><img width="20px" height="20px" src="<?php echo get_template_directory_uri(); ?>/images/social/instagram.png" alt=""/></a></li>
	            <?php
	            	}
	            ?>
	        </ul>
	    </div>
	    
	    <div id="toTop">
		<img src="<?php echo get_template_directory_uri(); ?>/images/arrow_up_24x24.png" alt=""/>
	</div>
	</div>
</div>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
