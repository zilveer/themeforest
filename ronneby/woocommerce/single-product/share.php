<?php
/**
 * Share
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.10
 */
/*$data_link = get_the_permalink();
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
*/
get_template_part('templates/entry-meta/mini','share-single');