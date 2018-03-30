<?php $width = 690; ?>
<?php $height = 320;?>
<?php if (has_post_thumbnail(get_the_ID())): ?>
<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array($width,$height)); ?>
<?php $imageUrl = $image[0]; ?>
<a href="<?php the_permalink(); ?>"><img src="<?php echo $imageUrl?>" alt=" " class="simpleFrame post-photo"></a>
<?php endif; ?>