<?php
global $post;
$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
$title = wptexturize( $post->post_title );
$permalink = get_permalink( $post->ID );

?>

<div class="thb-content-share">
	<p class="thb-content-share-title">
		<?php _e('Share on', 'thb_text_domain'); ?>
	</p>
	<ul>
		<li>
			<a data-type="thb-facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="thb-content-share-facebook">
				<span>
					<strong><?php _e('Share', 'thb_text_domain'); ?></strong> <?php _e('on Facebook', 'thb_text_domain'); ?>
				</span>
			</a>
		</li>
		<li>
			<a data-type="thb-pinterest" href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $src[0]; ?>&description=<?php echo $title; ?>" target="_blank" class="thb-content-share-pinterest">
				<span>
					<strong><?php _e('Pin', 'thb_text_domain'); ?></strong> <?php _e('this item', 'thb_text_domain'); ?>
				</span>
			</a>
		</li>
		<li>
			<?php
				$thb_twitter_text = urlencode( $title . ' ' . $permalink );
			?>

			<a data-type="thb-twitter" href="https://twitter.com/intent/tweet?source=webclient&amp;text=<?php echo $thb_twitter_text; ?>" target="_blank" class="thb-content-share-twitter">
				<span>
					<strong><?php _e('Tweet', 'thb_text_domain'); ?></strong> <?php _e('this item', 'thb_text_domain'); ?>
				</span>
			</a>
		</li>
		<li>
			<a data-type="thb-googleplus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<span>
					<?php _e( 'Share on', 'thb_text_domain' ); ?> <strong><?php _e('Google Plus', 'thb_text_domain'); ?></strong>
				</span>
			</a>
		</li>
		<li>
			<a data-type="thb-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode( $title ); ?>" target="_blank">
				<span>
					<?php _e( 'Share on', 'thb_text_domain' ); ?> <strong><?php _e('LinkedIn', 'thb_text_domain'); ?></strong>
				</span>
			</a>
		</li>
		<li>
			<a data-type="thb-email" target="_blank" href="mailto:entertheaddress@example.com?subject=<?php echo $title; ?>&amp;body=<?php the_permalink(); ?>" class="thb-content-share-email">
				<span>
					<strong><?php _e('Email', 'thb_text_domain'); ?></strong> <?php _e('a friend', 'thb_text_domain'); ?>
				</span>
			</a>
		</li>
	</ul>
</div>