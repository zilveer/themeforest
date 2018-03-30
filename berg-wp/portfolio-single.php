<?php
/**
 * @package berg-wp
 */

$class = $categories = '';

foreach (get_the_terms(get_the_id(), 'berg_portfolio_categories') as $category) {
	$class .= 'category-' . $category->slug . ' ';
	$categories .= '<li><a href="'.esc_url(get_category_link($category->term_id)).'" title="'.$category->name.'">'.$category->name.'</a><span class="dot-separator"></span></li>';
}
$get_categories = '<ul class="portfolio-categories">'.$categories.'</ul>';

$img_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog_thumb_small');
$img_width = $img_url[1];
$img_height = $img_url[2];
$img_url = $img_url[0];
if($img_url == '') {
	$img_url = 'http://placehold.it/500x300&amp;text=Please+select+featured+image';
}

if (has_post_thumbnail()) {
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
}

$portfolioPost = get_post();

?>
<article class="portfolio-grid mix <?php echo $class; ?>">
	<?php if(YSettings::g('berg_single_portfolio', $pageId) == 'open_overlay') : ?>
	<a class="open-overlay" href="" data-post-id="<?php echo $post->ID ?>"></a>
	<?php else : ?>	
	<a href="<?php echo get_permalink($portfolioPost->ID);?>" class="open-post <?php echo $class; ?>" data-post-id="<?php echo $post->ID ?>"></a>
	<?php endif ;?>
	<div class="img-bg">
		<img width="<?php echo $img_width; ?>" height="<?php echo $img_height; ?>" src="<?php echo THEME_DIR_URI; ?>/img/placeholder2.png" data-src="<?php echo $img_url; ?>" />
	</div>
	<div class="overlay-masonry" style="background: <?php echo YSettings::g('berg_portfolio_overlay', $pageId) ;?>"></div>
	<div class="content">
		<div class="portfolio-content-wrapper">
			<div class="portfolio-content">
				<?php the_title(sprintf('<h3 class="entry-title">', esc_url(get_permalink())), '</h3>'); ?>
				<?php if( YSettings::g('berg_portfolio_categories') == 1) {
					echo $get_categories; 
				} ;?>
			</div>
		</div>
	</div>
</article>