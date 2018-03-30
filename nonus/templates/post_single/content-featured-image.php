<?php $width = 690; ?>
<?php $height = 320;
$atr = ct_get_featured_image_data (get_the_ID(), $width, $height);?>
<?php if (has_post_thumbnail(get_the_ID())): ?>
<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array($width, $height)); ?>
<?php $imageUrl = $image[0]; ?>
	  <a class="post-media" href="<?php echo get_permalink(get_the_ID())?>"><img src="<?php echo $imageUrl?>" alt="<?php echo esc_attr( $atr['alt']) ?>"
                                                                                 title="<?php echo esc_attr( $atr['title']) ?>"></a>
<?php endif; ?>