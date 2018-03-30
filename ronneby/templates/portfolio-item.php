<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
//TODO: Check if not in use and delete

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

if (get_post_meta($post->ID, 'folio_vimeo_video_url', true) || get_post_meta($post->ID, 'folio_youtube_video_url', true) ||
    (get_post_meta($post->ID, 'folio_self_hosted_mp4', true) != '') || (get_post_meta($post->ID, 'folio_self_hosted_webm', true) != '')){
    $folio_video = true;
}
?>

<div class="project one-photo clearfix">
    <div class="eight columns">
        <div class="entry-thumb">
            <img src="<?php echo esc_url($article_image); ?>" alt="<?php the_title(); ?>"/>
        </div>
    </div>
    <div class="four columns">
        <h4 class="box-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

        <span class="dopinfo"><?php get_template_part('templates/folio', 'terms'); ?></span>

        <div class="entry-content">
            <?php the_excerpt();?>
        </div>

        <a href="<?php the_permalink();?>" class="button"><?php echo __('Read details', 'dfd'); ?></a>
    </div>
</div>
