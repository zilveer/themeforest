<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Link
 */
?>

		<!-- Begin footer -->
		<div class="footer_wrapper">
		
		<div id="footer">
			<ul class="sidebar_widget">
				<?php dynamic_sidebar('Footer Sidebar'); ?>
			</ul>
			
			<br class="clear"/>
		
		</div>
		
		<div id="copyright">
			<div id="copyright_left">
		    <?php
		    	/**
		    	 * Get footer text
		    	 */
	
		    	$pp_footer_text = get_option('pp_footer_text');
	
		    	if(empty($pp_footer_text))
		    	{
		    		$pp_footer_text = 'Copyright © 2011. Remove this via Theme admin | Footer';
		    	}
		    	
		    	echo stripslashes(html_entity_decode($pp_footer_text));
		    ?>
		</div>
		<div class="social_wrapper">
		    <ul>
		    	<?php
		    		$pp_youtube_username = get_option('pp_youtube_username');
		    		
		    		if(!empty($pp_youtube_username))
		    		{
		    	?>
		    	<li><a href="http://youtube.com/user/<?php echo $pp_youtube_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_black/youtube.png" alt=""/></a></li>
		    	<?php
		    		}
		    	?>
		    	<?php
		    		$pp_tumblr_username = get_option('pp_tumblr_username');
		    		
		    		if(!empty($pp_tumblr_username))
		    		{
		    	?>
		    	<li><a href="http://<?php echo $pp_tumblr_username; ?>.tumblr.com"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_black/tumblr.png" alt=""/></a></li>
		    	<?php
		    		}
		    	?>
		    	<?php
		    		$pp_facebook_username = get_option('pp_facebook_username');
		    		
		    		if(!empty($pp_facebook_username))
		    		{
		    	?>
		    	<li><a href="http://facebook.com/<?php echo $pp_facebook_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_black/facebook.png" alt=""/></a></li>
		    	<?php
		    		}
		    	?>
		    	<?php
		    		$pp_twitter_username = get_option('pp_twitter_username');
		    		
		    		if(!empty($pp_twitter_username))
		    		{
		    	?>
		    	<li><a href="http://twitter.com/<?php echo $pp_twitter_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_black/twitter.png" alt=""/></a></li>
		    	<?php
		    		}
		    	?>
		    	<?php
		    		$pp_feedburner_id = get_option('pp_feedburner_id');
		    		
		    		if(!empty($pp_tumblr_username))
		    		{
		    	?>
		    	<li><a href="<?php echo $pp_feedburner_id; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_black/rss.png" alt=""/></a></li>
		    	<?php
		    		}
		    	?>
		    </ul>
		</div>
		</div>
		
		</div>
		<!-- End footer -->
		
	</div>
	<!-- End template wrapper -->

<?php
		/**
    	*	Setup Google Analyric Code
    	**/
    	include (TEMPLATEPATH . "/google-analytic.php");
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
