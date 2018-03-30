<?php

/**
 * Displays social sharing buttons
 *
 * @package wpv
 */

global $post;

$networks = array(
	'facebook' => array(
		'link' => 'https://www.facebook.com/sharer/sharer.php?u=',
		'title' => __('Share on Facebook', 'health-center'),
		'text' => __('Like', 'health-center'),
	),
	'twitter' => array(
		'link' => 'https://twitter.com/intent/tweet?text=',
		'title' => __('Share on Twitter', 'health-center'),
		'text' => __('Tweet', 'health-center'),
	),
	'googleplus' => array(
		'link' => 'https://plus.google.com/share?url=',
		'title' => __('Share on Google Plus', 'health-center'),
		'text' => __('+1', 'health-center'),
	),
	'pinterest' => array(
		'link' => '#',
		'title' => __('Share on Pinterest', 'health-center'),
		'text' => __('Pin it', 'health-center'),
	),
);

if(WpvTemplates::has_share($context)):
?>
<div class="clearfix <?php echo apply_filters('wpv_share_class', 'share-btns')?>">
	<div class="sep-3"></div>
	<ul class="socialcount" data-url="<?php esc_attr_e(get_permalink()) ?>" data-share-text="<?php esc_attr_e(get_the_title()) ?>" data-media="">
		<?php foreach($networks as $slug => $cfg): ?>
			<?php if(wpv_get_option("share-$context-$slug")): ?>
				<li class="<?php echo $slug ?>">
					<a href="<?php echo $cfg['link'] ?><?php echo urlencode(get_permalink()) ?>" title="<?php esc_attr_e($cfg['title']) ?>">
						<?php echo do_shortcode( "[icon name='$slug']" ) ?>
						<span class="count"><?php echo $cfg['text'] ?></span>
					</a>
				</li>&nbsp;
			<?php endif ?>
		<?php endforeach ?>
	</ul>
</div>
<?php
endif;