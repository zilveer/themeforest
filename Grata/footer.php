<?php global $smof_data; ?>
</div>
<!-- /MAIN -->

<!-- FOOTER -->
<div class="l-footer">

	<?php if ($smof_data['footer_show_widgets'] != 0) { ?>
	<!-- subfooter: top -->
	<div class="l-subfooter at_top">
		<div class="l-subfooter-h i-cf g-cols offset_default">

			<div class="one-third">
				<?php dynamic_sidebar('footer_first') ?>
			</div>

			<div class="one-third">
				<?php dynamic_sidebar('footer_second') ?>
			</div>

			<div class="one-third">
				<?php dynamic_sidebar('footer_third') ?>
			</div>

		</div>
	</div>
	<?php } ?>

	<!-- subfooter: bottom -->
	<div class="l-subfooter at_bottom">
		<div class="l-subfooter-h i-cf">

<?php if ($smof_data['footer_socials']) { ?>
			<div class="w-socials">
				<div class="w-socials-list">

<?php
$socials = array (
	'facebook' => 'Facebook',
	'twitter' => 'Twitter',
	'google' => 'Google+',
	'linkedin' => 'LinkedIn',
	'youtube' => 'YouTube',
	'vimeo' => 'Vimeo',
	'flickr' => 'Flickr',
	'instagram' => 'Instagram',
	'behance' => 'Behance',
	'pinterest' => 'Pinterest',
	'skype' => 'Skype',
	'tumblr' => 'Tumblr',
	'dribbble' => 'Dribbble',
	'vk' => 'Vkontakte',
	'xing' => 'Xing',
	'twitch' => 'Twitch',
	'yelp' => 'Yelp',
	'soundcloud' => 'SoundCloud',
	'deviantart' => 'DeviantArt',
	'foursquare' => 'Foursquare',
	'github' => 'GitHub',
);

$output = '';

foreach ($socials as $social_key => $social)
{
	if ($smof_data[$social_key.'_link'] != '')
	{
		if ($social_key == 'email')
		{
			$output .= '<div class="w-socials-item '.$social_key.'">
					<a class="w-socials-item-link" href="mailto:'.$smof_data[$social_key.'_link'].'">
						<i class="fa fa-envelope"></i>
					</a>
					<div class="w-socials-item-popup"><span>'.$social.'</span></div>
					</div>';

		}
		elseif ($social_key == 'google')
		{
			$output .= '<div class="w-socials-item gplus">
					<a class="w-socials-item-link" target="_blank" href="'.$smof_data[$social_key.'_link'].'">
						<i class="fa fa-google-plus"></i>
					</a>
					<div class="w-socials-item-popup"><span>'.$social.'</span></div>
					</div>';

		}
		elseif ($social_key == 'youtube')
		{
			$output .= '<div class="w-socials-item '.$social_key.'">
					<a class="w-socials-item-link" target="_blank" href="'.$smof_data[$social_key.'_link'].'">
						<i class="fa fa-youtube-play"></i>
					</a>
					<div class="w-socials-item-popup"><span>'.$social.'</span></div>
					</div>';

		}
        elseif ($social_key == 'vimeo')
        {
            $output .= '<div class="w-socials-item '.$social_key.'">
					<a class="w-socials-item-link" target="_blank" href="'.$smof_data[$social_key.'_link'].'">
						<i class="fa fa-vimeo-square"></i>
					</a>
					<div class="w-socials-item-popup"><span>'.$social.'</span></div>
					</div>';

        }
		else
		{
			$output .= '<div class="w-socials-item '.$social_key.'">
					<a class="w-socials-item-link" target="_blank" href="'.$smof_data[$social_key.'_link'].'">
						<i class="fa fa-'.$social_key.'"></i>
					</a>
					<div class="w-socials-item-popup"><span>'.$social.'</span></div>
					</div>';
		}
	}
}

echo $output;
?>
				</div>
			</div>
<?php } ?>

			<div class="w-copyright"><?php echo $smof_data['footer_copyright'] ?></div>
		</div>
	</div>

</div>
<!-- /FOOTER -->

<div class="l-border at_top"></div>
<div class="l-border at_right"></div>
<div class="l-border at_bottom"></div>
<div class="l-border at_left"></div>

<a class="w-toplink" href="#"><i class="fa fa-angle-up"></i></a>

<script>
	window.ajaxURL = '<?php echo admin_url('admin-ajax.php'); ?>';
	window.nameFieldError = "<?php echo __("Please enter your Name", 'us'); ?>";
	window.emailFieldError = "<?php echo __("Please enter your Email", 'us'); ?>";
	window.phoneFieldError = "<?php echo __("Please enter your Phone Number", 'us'); ?>";
	window.messageFieldError = "<?php echo __("Please enter a Message", 'us'); ?>";
	window.messageFormSuccess = "<?php echo (@$smof_data['contact_form_mailchimp'] == 1 AND @$smof_data['contact_form_mailchimp_api_key'] != '' AND @$smof_data['contact_form_mailchimp_list_id'] != '')?__("Subscribe Successfull! Please check your inbox and confirm subscribtion!", 'us'):__("Thank you! Your message was sent.", 'us'); ?>";
    window.preloaderType = "<?php $preloader_type = (isset($smof_data['preloader']))?substr($smof_data['preloader'], -1):'1';
    if ( ! in_array($preloader_type, array(1, 2, 3, 4, 5, 6, 7))) {
        $preloader_type = 1;
    }
    $preloader_type_class = ' type_'.$preloader_type;

     echo $preloader_type_class; ?>";
    window.disable_wc_lightbox = <?php echo (get_option('woocommerce_enable_lightbox') == 'yes')?'false':'true'; ?>;
	<?php if ( ! empty($smof_data['header_height']) AND $smof_data['header_height'] >= 50 AND $smof_data['header_height'] <= 120) {?>window.defaultHeaderHeight = "<?php echo $smof_data['header_height']; ?>";<?php } ?>
	<?php if ( ! empty($smof_data['header_height_mobile']) AND $smof_data['header_height_mobile'] >= 50 AND $smof_data['header_height_mobile'] <= 120) {?>window.mobileHeaderHeight = "<?php echo $smof_data['header_height_mobile']; ?>";<?php } ?>
	<?php if ( ! empty($smof_data['mobile_nav_width'])) {?>window.mobileNavWidth = "<?php echo $smof_data['mobile_nav_width']; ?>";<?php } ?>
    <?php if ( ! empty($smof_data['logo_height']) AND $smof_data['logo_height'] >= 20 AND $smof_data['logo_height'] <= 120) {?>window.defaultLogoHeight = "<?php echo $smof_data['logo_height']; ?>";<?php } ?>
    <?php if ( ! empty($smof_data['logo_height_mobile']) AND $smof_data['logo_height_mobile'] >= 20 AND $smof_data['logo_height_mobile'] <= 120) {?>window.mobileLogoHeight = "<?php echo $smof_data['logo_height_mobile']; ?>";<?php } ?>
</script>
<?php if($smof_data['tracking_code'] != "") { echo $smof_data['tracking_code']; } ?>
<?php wp_footer(); ?>

</body>
</html>