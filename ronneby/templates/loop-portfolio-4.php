<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$terms = get_the_terms(get_the_ID(), 'my-product_category');

if (has_post_thumbnail()) {
	$thumb = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
} else {
	$img_url = get_template_directory_uri() . '/img/no-image-large.jpg';
}

$article_columns = 'three';
$article_image = dfd_aq_resize($img_url, 280, 280, true, true, true);
if(!$article_image) {
	$article_image = $img_url;
}

$article_tags_classes = '';

$folio_hover_style_option = get_post_meta($post->ID, 'folio_hover_style', true);

$folio_hover_style = !empty($folio_hover_style_option) ? $folio_hover_style_option : 'portfolio-hover-style-1';

if(is_array($terms)) {
	foreach ($terms as $term) {
		$article_tags_classes .= ' ' . strtolower(preg_replace('/\s+/', '-', $term->slug)) . ' ';
	}
}

?>
<article class="<?php echo esc_attr($article_columns); ?> columns project <?php echo esc_attr($folio_hover_style); ?>" data-category="<?php echo esc_attr($article_tags_classes); ?>">
	<div class="cover">
		<div class="entry-thumb">
			<img src="<?php echo esc_url($article_image) ?>" alt="<?php the_title(); ?>"/>

			<?php get_template_part('templates/portfolio/entry-hover'); ?>
		</div>

		<div class="feature-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

		<?php get_template_part('templates/folio', 'terms'); ?>
	</div>
</article>