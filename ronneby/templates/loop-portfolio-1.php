<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (has_post_thumbnail()) {
	$thumb = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
} else {
	$img_url = get_template_directory_uri() . '/img/no-image-large.jpg';
}
$article_image = dfd_aq_resize($img_url, 780, 320, true, true, true); //resize & crop img
if(!$article_image) {
	$article_image = $img_url;
}

$folio_video = false;

$folio_hover_style_option = get_post_meta($post->ID, 'folio_hover_style', true);

$folio_hover_style = !empty($folio_hover_style_option) ? $folio_hover_style_option : 'portfolio-hover-style-1';

if (
	get_post_meta($post->ID, 'folio_vimeo_video_url', true) || 
	get_post_meta($post->ID, 'folio_youtube_video_url', true) ||
	(get_post_meta($post->ID, 'folio_self_hosted_mp4', true)!='') || 
	(get_post_meta($post->ID, 'folio_self_hosted_webm', true)!='')
) {
	$folio_video = true;
}
?>

<div class="project project-one-column one-photo clearfix <?php echo esc_attr($folio_hover_style); ?>">
    <div class="eight columns">
        <div class="entry-thumb">
            <img src="<?php echo esc_url($article_image) ?>" alt="<?php the_title(); ?>"/>
			
			<?php get_template_part('templates/portfolio/entry-hover'); ?>
        </div>
    </div>
    <article class="four columns">
        <div class="feature-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

		<?php get_template_part('templates/folio', 'terms'); ?>
	
        <div class="entry-content">
			<?php the_excerpt(); ?>
			<a href="<?php echo get_the_permalink(); ?>" class="more-button" title=""><?php _e('More', 'dfd'); ?></a>
        </div>
		
    </article>
</div>
