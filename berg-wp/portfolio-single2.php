<?php
/**
 * @package berg-wp
 */
$default_layout = array(
	'w2-h2', 'w2-h1', 'w1-h1', 'w1-h1',
	'w1-h1', 'w1-h2', 'w1-h1', 'w1-h1', 'w1-h1', 'w2-h1',
	'w1-h1', 'w1-h1', 'w2-h2', 'w1-h1', 'w1-h1',
	'w2-h1', 'w1-h1', 'w1-h1',
	'w2-h1', 'w1-h2', 'w1-h1', 'w1-h1', 'w1-h1', 'w1-h1',
	'w2-h1', 'w1-h1', 'w1-h1', 'w1-h1', 'w1-h1', 'w2-h1',
	'w1-h1', 'w2-h1', 'w1-h1',
	'w1-h1', 'w1-h1', 'w2-h1',
	'w1-h1', 'w2-h2', 'w1-h1', 'w1-h1', 'w1-h1',
);
$custom_layout = YSettings::g('berg_masonry_layout');
if ( isset($custom_layout) && $custom_layout != '' ) {

	$custom_layout = str_replace('1', 'w1-h1', $custom_layout);
	$custom_layout = str_replace('2', 'w2-h1', $custom_layout);
	$custom_layout = str_replace('3', 'w1-h2', $custom_layout);
	$custom_layout = str_replace('4', 'w2-h2', $custom_layout);
	$custom_layout = explode(',', $custom_layout);
	$layouts = $custom_layout;
} else {
	$layouts = $default_layout;
}


$layout = $layout_index1;

$image_id = get_post_thumbnail_id();
$lTemp = $layout;
$layout = $layouts[$layout];
if ( $layout == 'w1-h1' ) {
	$image_url = wp_get_attachment_image_src($image_id, 'blog_thumb');
} elseif ( $layout == 'w2-h1' ) {
	$image_url = wp_get_attachment_image_src($image_id, 'blog_thumb');
	$layout .= ' post-large-title';
} elseif ( $layout == 'w2-h2' ) {
	$image_url = wp_get_attachment_image_src($image_id, 'large_bg');
	$layout .= ' post-large-title';
} else {
	$image_url = wp_get_attachment_image_src($image_id, 'large_bg');
}
if ( $image_url[0] ) {
	$image = $image_url[0];
	$noImage = '';
} else {
	$image = '';
	$noImage = 'width: 100%; height: 100%; background: #000';
}

$class = $categories = '';

$portfolioCategories = get_the_terms(get_the_id(), 'berg_portfolio_categories');
if(is_array($portfolioCategories)) {	
	foreach ($portfolioCategories as $category) {
		$class .= 'category-' . $category->slug . ' ';
		$categories .= '<li><a href="'.esc_url(get_category_link($category->term_id)).'" title="'.$category->name.'">'.$category->name.'</a><span class="dot-separator"></span></li>';
	}
}

$img_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog_thumb_small');
$img_width = $img_url[1];
$img_height = $img_url[2];
$img_url = $img_url[0];

if (has_post_thumbnail()) {
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
}

$get_categories = '<ul class="portfolio-categories">'.$categories.'</ul>';

$portfolioPost = get_post();

?>

<article class="<?php echo $layout; ?> <?php echo $class ;?>">
	<?php if(YSettings::g('berg_single_portfolio', $pageId) == 'open_overlay') : ?>
	<a class=" open-overlay" href="" data-post-id="<?php echo $post->ID ?>"></a>
	<?php else : ?>	
	<a href="<?php echo get_permalink($portfolioPost->ID);?>" class="open-post <?php echo $class; ?>" style="position: absolute; width: 100%; height: 100%; z-index: 11;" data-post-id="<?php echo $post->ID ?>"></a>
	<?php endif ;?>
	<div class="layer">
		<div class="img-bg" data-depth="0.50" style="<?php echo 'background-image: url('.$image.')'; ?> <?php echo $noImage ;?>">
			<img src="<?php echo $image; ?>"/>
		</div>
	</div>
	<div class="overlay-masonry" style="background: <?php echo YSettings::g('berg_portfolio_overlay', $pageId) ;?>"></div>
	<div class="portfolio-wrapper">
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
