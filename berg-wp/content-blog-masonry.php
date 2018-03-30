<?php
/**
 * @package berg-wp
 */

global $pageId;

$layout = $layout_index;

$image_id = get_post_thumbnail_id();

$lTemp = $layout;	
$layout = $layouts[$layout];
if ( $layout == 'w1-h1' ) {
	$image_url = wp_get_attachment_image_src($image_id, 'blog_thumb', false);
} elseif ( $layout == 'w2-h1' ) {
	$image_url = wp_get_attachment_image_src($image_id, 'blog_thumb', false);
	$layout .= ' post-large-title';
} elseif ( $layout == 'w2-h2' ) {
	$image_url = wp_get_attachment_image_src($image_id, 'large-bg', false);
	$layout .= ' post-large-title';
} else {
	$image_url = wp_get_attachment_image_src($image_id, 'large-bg', false);
}


if ( $image_url[0] ) {
	$image = $image_url[0];
} else {
	$image = 'http://placehold.it/675x418&amp;text=Please+select+featured+image';
}
$classes = array();
$classes[] = 'post';

$classes[] = $layout;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<div class="layer">
		<div class="img-bg" data-depth="0.50" style="<?php echo 'background-image: url('.$image.')'; ?>">
			<img src="<?php echo $image; ?>"/>
		</div>
	</div>
	
	<div class="overlay-masonry"></div>
	<div class="post-content-wrapper">
		<div class="post-content">

			<?php if(YSettings::g('blog_show_date', $pageId) == 1) :?>
			<div class="date">
				<?php berg_wp_posted_on(); ?>
			</div>
			<?php endif ;?>

			<?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
			<div class="blog-details">
				<?php echo get_post_details('', 'blog', $pageId); ?>
			</div>
	
			<?php

			// var_dump(YSettings::g('blog_show_excerpt', $pageId)); 
			// var_dump($pageId);
			?>
			<?php if (YSettings::g('blog_show_excerpt', $pageId) == 1 && (YSettings::g('blog_excerpt_length', $pageId) != '' && YSettings::g('blog_excerpt_length', $pageId) != '0')) {
				echo '<div class="content hidden-xs">';
				the_excerpt(); 
				echo '</div>';
			}; ?>
			<?php if(YSettings::g('blog_show_btn', $pageId) == 1) :?>
			<div class="blog-button">
				<a href="<?php echo esc_url(get_permalink());?>" class="btn btn-light-o btn-sm"><?php echo __('Read more', 'BERG');?></a>
			</div> 
			<?php endif ;?>
		</div>			
	</div>
</article>