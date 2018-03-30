<?php
/**
 * Share
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.10
 */

$social_networks = array(
	"fb" => "Facebook",
	"tw" => "Twitter",
	"gp" => "Google +",
	"li" => "LinkedIN",
);
$social_icons = array(
	"tw" => "soc_icon-twitter-3",
	"fb" => "soc_icon-facebook",
	"gp" => "soc_icon-google__x2B_",
	"li" => "soc_icon-linkedin",
);

$social_class = array(
	"tw" => "twitter",
	"fb" => "facebook",
	"gp" => "googleplus",
	"li" => "linkedin",
);

$data_link = get_the_permalink();
$data_title = get_the_title();
?>
<div class="share-wrap">
	<div class="box-name"><?php _e('Share','dfd'); ?></div>
	<div class="entry-share-no-popup" data-directory="<?php echo get_template_directory_uri(); ?>">
		<?php
		foreach ($social_networks as $short => $original):
			$icon = (isset($social_icons[$short])) ? $social_icons[$short] : '';
		?>
			<a href="#<?php echo esc_attr($social_class[$short]); ?>" class="<?php echo esc_attr($icon); ?> entry-share-link-<?php echo esc_attr($social_class[$short]); ?>" data-url="<?php echo esc_url($data_link); ?>" title="<?php echo esc_attr($data_title); ?>"></a>
		<?php
		endforeach;
		?>
	</div>
</div>
