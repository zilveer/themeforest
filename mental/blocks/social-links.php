<?php
/**
 * Social networks links template part
 *
 * @author Edgar <eibrahimov@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
?>

<?php if( ! get_mental_option('hide_social_links') ): ?>
	<div class="mb-social">
		<?php $social_links = get_mental_option( 'social_links' ) ?>
		<?php foreach ( $social_links as $social_link ): ?>
			<?php if(!empty($social_link['link']) && !empty($social_link['link'])) : ?>
				<a target="_blank" href="<?php echo esc_url($social_link['link']); ?>"><i class="<?php echo esc_attr($social_link['class']); ?>"></i></a>
			<?php endif ?>
		<?php endforeach ?>
	</div>
<?php endif ?>
