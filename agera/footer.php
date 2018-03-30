<?php
/**
 * @package WordPress
 * @subpackage Agera
 */
global $page_id;
$mp_option = agera_get_global_options(); ?>
<div class="clear"></div>
<span class="mpc-footer-ribbon">
	<span class="plus"></span>
	<span class="minus"></span>
</span>
<footer id="agera_footer">
	<p class="copyrights">
		<?php echo $mp_option['agera_copyright_text']; ?>
	</p>
	<ul class="social-icons">
		<?php if ($mp_option['agera_facebook_icon'] == "1") { ?>
		<li class="facebook">
			<a href="<?php echo $mp_option['agera_facebook_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_twitter_icon'] == "1") { ?>
		<li class="twitter">
			<a href="<?php echo $mp_option['agera_twitter_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_google_icon'] == "1") { ?>
		<li class="google">
			<a href="<?php echo $mp_option['agera_google_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_rss_icon'] == "1") { ?>
		<li class="rss">
			<a href="<?php echo $mp_option['agera_rss_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_dribbble_icon'] == "1") { ?>
		<li class="dribbble">
			<a href="<?php echo $mp_option['agera_dribbble_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_vimeo_icon'] == "1") { ?>
		<li class="vimeo">
			<a href="<?php echo $mp_option['agera_vimeo_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_forrst_icon'] == "1") { ?>
		<li class="forrst">
			<a href="<?php echo $mp_option['agera_forrst_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_flickr_icon'] == "1") { ?>
		<li class="flickr">
			<a href="<?php echo $mp_option['agera_flickr_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_deviant_icon'] == "1") { ?>
		<li class="deviant">
			<a href="<?php echo $mp_option['agera_deviant_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_digg_icon'] == "1") { ?>
		<li class="digg">
			<a href="<?php echo $mp_option['agera_digg_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_linkedin_icon'] == "1") { ?>
		<li class="linkedin">
			<a href="<?php echo $mp_option['agera_linkedin_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_picasa_icon'] == "1") { ?>
		<li class="picaso">
			<a href="<?php echo $mp_option['agera_picasa_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_stumble_icon'] == "1") { ?>
		<li class="stumbel">
			<a href="<?php echo $mp_option['agera_stumble_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
		<?php if ($mp_option['agera_instagram_icon'] == "1") { ?>
		<li class="instagram">
			<a href="<?php echo $mp_option['agera_instagram_link']; ?>">
				<span class="icon"></span>
				<span class="icon-color"></span>
			</a>
		</li>
		<?php } ?>
	</ul>


	<?php wp_footer(); ?>
</footer><!-- footer end -->
</div><!-- #page end -->

</body>
</html>