<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */

// Option path
$option_path = 'social'.(get_post_type() == 'post' ? (is_singular() ? '/single' : '/list') : '');
$theme_option_path = get_post_type().'/'.$option_path;
$post_option_path  = 'options/'.str_replace('/', '_', $option_path);

// Social visibility
$visible = Website::io($post_option_path, $theme_option_path.'/visible');

// Social
if ($visible === true || $visible === 'on') {

	$social_items = Website::to($theme_option_path.'/items');

	if (!empty($social_items)) {

		$permalink = esc_url(get_permalink());

		echo '<ul class="social clear">';

		foreach ($social_items as $social_item) {

			switch ($social_item) {
				case 'twitter':
					printf('<li class="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-url="%s" data-text="%s">Tweet</a></li>', $permalink, esc_attr(get_the_title()));
					break;
				case 'facebook':
					printf('<li class="facebook"><div class="fb-like" data-href="%s" data-send="false" data-layout="button_count" data-show-faces="false"></div></li>', $permalink);
					break;
				case 'googleplus':
					printf('<li class="googleplus"><div class="g-plusone" data-size="medium" data-href="%s"></div></li>', $permalink);
					break;
				case 'pinterest':
					if (has_post_thumbnail()) {
						list($thumbnail_src) = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
					} else {
						$thumbnail_src = '';
					}
					printf('<li class="pinterest"><a href="https://www.pinterest.com/pin/create/button/?url=%s&amp;media=%s&amp;description=%s" data-pin-do="buttonPin" data-pin-config="beside" data-pin-zero="true"><img border="0" src="//assets.pinterest.com/images/pidgets/pin_it_button.png" title="Pin it" /></a></li>', urlencode($permalink), urlencode($thumbnail_src), urlencode(get_the_title()));
					break;
				case 'linkedin':
					printf('<li class="inshare"><script class="inshare" type="IN/Share" data-url="%s" data-counter="right" data-showzero="true"></script></li>', $permalink);
					break;
			}

		}

		echo '</ul>';

	}

}