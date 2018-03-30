
<div id="footerwrap">		
		<div id="breadcrumb">
			<?php the_breadcrumb(); ?>
		</div>
		
		
		<?php if ( of_get_option('twitterfooter_checkbox') == true ) { ?>
			<?php if ( of_get_option('twitter_url') ) { ?>
			<div id="lasttweet">
				<div id="status"></div>
			</div>
			<?php } else { ?>
				<div class="color-hr"></div>
			<?php } ?>
		<?php } else { ?>
			<div class="color-hr"></div>
		<?php } ?>
		
		
		<div id="footer" class="clearfix">
		
			<div id="footerlogo" class="col-4">
				<?php if ( of_get_option('footerlogo_upload') ) { ?>
            		<h4><a href="<?php echo home_url(); ?>/"><img src="<?php echo of_get_option('footerlogo_upload'); ?>" alt="<?php bloginfo('name'); ?>" /></a></h4>
            	<?php } else { ?>
            		<h4><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a></h4>
            	<?php } ?>
            	<p class="description"><?php echo of_get_option('footer_text'); ?></p>
			</div>
			
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widgets')); ?>
			
		</div>
		<div id="copyright">
			&copy; Copyright <?php echo date("Y"); echo " "; bloginfo('name'); ?> / WordPress Theme by <a href="http://hellominti.com">minti</a>
			<div id="back-to-top">
				<a href="#wrap"><img src="<?php bloginfo('template_url'); ?>/framework/images/top.png" alt="top" width="18" height="16" /></a>
			</div>
		</div>
		

</div>

</div>
	
	<?php wp_footer(); ?>

    <script type="text/javascript">
		$(document).ready(function() {
			$.getJSON('<?php echo get_template_directory_uri(); ?>/framework/functions/twitter.php?url='+encodeURIComponent('statuses/user_timeline.json?screen_name=<?php echo of_get_option('twitter_url'); ?>&count=1'), function(tweets){
				$("#lasttweet").html(tz_format_twitter(tweets));
			}); 
		});
	</script>
	
	<?php if ( of_get_option('analytics_code') != "" ) { 
		echo of_get_option('analytics_code');
	} ?>
	
</body>

</html>
