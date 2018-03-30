<?php
if (has_post_thumbnail()):
$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-big');
$image_ratio = bucket::get_image_aspect_ratio( $image );

// let's get to know this post a little better
$full_width_featured_image = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_full_width_featured_image', true);
$disable_sidebar = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_disable_sidebar', true);

// let's use what we know
$content_width = $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds';
$featured_image_width = $full_width_featured_image == 'on' || $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds  palm-one-whole'; ?>

<div class="grid__item  float--left  <?php echo $featured_image_width; ?>  article__featured-image">
	<a href="<?php the_permalink(); ?>" class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
		<img src="<?php echo $image[0] ?>" alt="<?php echo $image[0] ?>" />
	</a>
</div>

<?php endif;

$html_title = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_html_title', true);
$audio_embed = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'audio_embed', true);
// let's get to know this post a little better
$full_width_featured_image = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_full_width_featured_image', true);
$disable_sidebar = get_post_meta(wpgrade::lang_post_id(get_the_ID()), '_bucket_disable_sidebar', true);
$class_image_width = $full_width_featured_image == 'on' || $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds  palm-one-whole';

if( !empty($audio_embed)): ?>
	<div class="grid__item  float--left  <?php echo $class_image_width; ?>  article__featured-image  article__featured-audio">
		<?php echo stripslashes(htmlspecialchars_decode($audio_embed)) ?>
	</div>
<?php else: # audio_embed is empty ?>
	<div class="grid__item  float--left  <?php echo $class_image_width; ?>  article__featured-image  article__featured-audio">
        <?php wpgrade::audio_selfhosted(wpgrade::lang_post_id(get_the_ID())); ?>
	</div>
<?php endif; ?>
