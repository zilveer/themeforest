<?php

if (!mad_custom_get_option('share-product-enable'))
	return;

// Social Share Page
$image = esc_url(wp_get_attachment_url( get_post_thumbnail_id() ));
$permalink = esc_url( apply_filters( 'the_permalink', get_permalink() ) );
$title = esc_attr(get_the_title());
$extra_attr = 'target="_blank" ';
?>

<div class="share-links-wrapper v_centered">

	<span class="title"><?php _e('Share this', 'flatastic') ?>:</span>

	<div class="share-links">

		<?php if (mad_custom_get_option('share-product-facebook')): ?>
			<a href="http://www.facebook.com/sharer.php?m2w&amp;s=100&amp;p&#091;url&#093;=<?php echo $permalink ?>&amp;p&#091;images&#093;&#091;0&#093;=<?php echo $image ?>&amp;p&#091;title&#093;=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php esc_html_e('Facebook', 'flatastic') ?>" class="share-facebook share-link"><?php esc_html_e('Facebook', 'flatastic') ?></a>
		<?php endif; ?>

		<?php if (mad_custom_get_option('share-product-twitter')): ?>
			<a href="https://twitter.com/intent/tweet?text=<?php echo $title ?>&amp;url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php _e('Twitter', 'flatastic') ?>" class="share-twitter"><?php _e('Twitter', 'flatastic') ?></a>
		<?php endif; ?>

		<?php if (mad_custom_get_option('share-product-linkedin')): ?>
			<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php _e('LinkedIn', 'flatastic') ?>" class="share-linkedin"><?php _e('LinkedIn', 'flatastic') ?></a>
		<?php endif; ?>

		<?php if (mad_custom_get_option('share-product-googleplus')): ?>
			<a href="https://plus.google.com/share?url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php _e('Google +', 'flatastic') ?>" class="share-googleplus"><?php _e('Google +', 'flatastic') ?></a>
		<?php endif; ?>

		<?php if (mad_custom_get_option('share-product-pinterest')): ?>
			<a href="https://pinterest.com/pin/create/link/?url=<?php echo $permalink ?>&amp;media=<?php echo $image ?>" <?php echo $extra_attr ?> title="<?php _e('Pinterest', 'flatastic') ?>" class="share-pinterest"><?php _e('Pinterest', 'flatastic') ?></a>
		<?php endif; ?>

		<?php if (mad_custom_get_option('share-product-vk')): ?>
			<a href="https://vk.com/share.php?url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>&amp;image=<?php echo $image ?>&amp;noparse=true" <?php echo $extra_attr ?> title="<?php _e('VK', 'flatastic') ?>" class="share-vk"><?php _e('VK', 'flatastic') ?></a>
		<?php endif; ?>

		<?php if (mad_custom_get_option('share-product-tumblr')): ?>
			<a href="http://www.tumblr.com/share/link?url=<?php echo $permalink ?>&amp;name=<?php echo urlencode($title) ?>&amp;description=<?php echo urlencode(get_the_excerpt()) ?>" <?php echo $extra_attr ?> title="<?php _e('Tumblr', 'flatastic') ?>" class="share-tumblr"><?php _e('Tumblr', 'flatastic') ?></a>
		<?php endif; ?>

		<?php if (mad_custom_get_option('share-product-xing')): ?>
			<a href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php _e('Xing', 'flatastic') ?>" class="share-xing"><?php _e('Xing', 'flatastic') ?></a>
		<?php endif; ?>

	</div><!--/ .share-links-->

</div><!--/ .share-links-wrapper-->

