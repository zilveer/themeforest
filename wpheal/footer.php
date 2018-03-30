<?php 
	//Extracting the values that user defined in OptionTree Plugin 
	$copyrightText = ot_get_option('copyright_text');
	$footerTweetCount = ot_get_option('footer_tweet_count');
	$subscribeFormUrl = ot_get_option('subscribe_form_url');
	$footerLogo = ot_get_option('footer_logo');
	$footerEmail = ot_get_option('email');
	$footerTelephone = ot_get_option('telephone');
	$footerSkype = ot_get_option('skype');
	$footerAddress = ot_get_option('clinic_address');
	$facebook = ot_get_option('facebook_url');
	$twitter = ot_get_option('twitter_url');
	$rss = ot_get_option('rss_url');
	$linkedin = ot_get_option('linkedin_url');
	$google = ot_get_option('google_url');
	$review1 = ot_get_option('review1');
	$review_author1 = ot_get_option('review_author1');
	$review2 = ot_get_option('review2');
	$review_author2 = ot_get_option('review_author2');
	$review3 = ot_get_option('review3');
	$review_author3 = ot_get_option('review_author3');
	$review4 = ot_get_option('review4');
	$review_author4 = ot_get_option('review_author4');
	
	$tweetusername = ot_get_option('footer_tweet_username');
	
	$footerAddress = explode(";", $footerAddress);
?>
	<!-- BEGIN FOOTER -->
	<footer>
		<div id="footer">
			<div id="prefooter-line"></div>
			<div class="container">
			
				<?php dynamic_sidebar( 'footer_section' );  ?>	
			
				<br class="clear" />
				<div class="sixteen columns" id="copyright-info">
					<div><?php echo $copyrightText; ?></div>
					<div id="social-button">
						<?php if ($facebook != '') { ?><a href="<?php echo $facebook; ?>"><div id="facebook-img"></div></a><?php } ?>					
						<?php if ($twitter != '') { ?><a href="<?php echo $twitter; ?>"><div id="twitter-img"></div></a><?php } ?>					
						<?php if ($rss != '') { ?><a href="<?php echo $rss; ?>"><div id="rss-img"></div></a><?php } ?>						
						<?php if ($linkedin != '') { ?><a href="<?php echo $linkedin ?>"><div id="linkedin-img"></div></a><?php } ?>					
						<?php if ($google != '') { ?><a href="<?php echo $google ?>"><div id="google-img"></div></a><?php } ?>				
					</div>
				</div>
			</div>
			<a href="#to-top" id="back-to-top"></a>
		</div>
	</footer>
	<!-- END FOOTER -->
	<?php wp_footer(); ?>
	</body>	
</html>