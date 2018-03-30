<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Kratong
 */
?>

	<br class="clear"/>
	<div id="footer">
		<?php
			$pp_footer_social = get_option('pp_footer_social');
			
			if(!empty($pp_footer_social))
			{
				$social_dir = 'social';
				
				if(isset($_SESSION['pp_skin']))
				{
				    $pp_skin = $_SESSION['pp_skin'];
				}
				else
				{
				    $pp_skin = get_option('pp_skin');
				}					
				if($pp_skin == 'light')
				{
					$social_dir = 'social_black';
				}
		?>
		<div class="social_wrapper">
		    <ul>
		    	<?php
		    		$pp_twitter_username = get_option('pp_twitter_username');
		    		
		    		if(!empty($pp_twitter_username))
		    		{
		    	?>
		    	<li><a href="http://twitter.com/<?php echo $pp_twitter_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/<?php echo $social_dir; ?>/twitter.png" alt=""/></a></li>
		    	<?php
		    		}
		    	?>
		    	<?php
		    		$pp_facebook_username = get_option('pp_facebook_username');
		    		
		    		if(!empty($pp_facebook_username))
		    		{
		    	?>
		    	<li><a href="http://facebook.com/<?php echo $pp_facebook_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/<?php echo $social_dir; ?>/facebook.png" alt=""/></a></li>
		    	<?php
		    		}
		    	?>
		    	<?php
		    		$pp_flickr_username = get_option('pp_flickr_username');
		    		
		    		if(!empty($pp_flickr_username))
		    		{
		    	?>
		    	<li class="flickr"><a href="http://flickr.com/people/<?php echo $pp_flickr_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/<?php echo $social_dir; ?>/flickr.png" alt=""/></a></li>
		    	<?php
		    		}
		    	?>
		    	<?php
		    		$pp_youtube_username = get_option('pp_youtube_username');
		    		
		    		if(!empty($pp_youtube_username))
		    		{
		    	?>
		    	<li><a href="http://youtube.com/user/<?php echo $pp_youtube_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/<?php echo $social_dir; ?>/youtube.png" alt=""/></a></li>
		    	<?php
		    		}
		    	?>
		    	<?php
		    		$pp_vimeo_username = get_option('pp_vimeo_username');
		    		
		    		if(!empty($pp_vimeo_username))
		    		{
		    	?>
		    	<li><a href="http://vimeo.com/<?php echo $pp_vimeo_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/<?php echo $social_dir; ?>/vimeo.png" alt=""/></a></li>
		    	<?php
		    		}
		    	?>
		    	<?php
		    		$pp_tumblr_username = get_option('pp_tumblr_username');
		    		
		    		if(!empty($pp_tumblr_username))
		    		{
		    	?>
		    	<li><a href="http://<?php echo $pp_tumblr_username; ?>.tumblr.com"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/<?php echo $social_dir; ?>/tumblr.png" alt=""/></a></li>
		    	<?php
		    		}
		    	?>
		    </ul>
		</div>
		<?php
		}
		?>
		<div id="copyright">
		    <?php
		    	/**
		    	 * Get footer text
		    	 */
	
		    	$pp_footer_text = get_option('pp_footer_text');
	
		    	if(empty($pp_footer_text))
		    	{
		    		$pp_footer_text = 'Wordpress Theme by <a href="http://themeforest.net/user/peerapong">Peerapong Pulpipatnan</a>.';
		    	}
		    	
		    	echo stripslashes(html_entity_decode($pp_footer_text));
		    ?>
		</div>
	</div>
	<br class="clear"/>
	</div>
	
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
