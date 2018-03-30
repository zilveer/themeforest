<?php
global $post, $splash_welcome_text, $page_head_subtitle, $fave_header_full_screen, $adv_search_which_header_show, $adv_search_over_header_pages, $adv_search_selected_pages;

$splash_welcome_text = get_post_meta( $post->ID, 'fave_page_header_title', true );
$page_head_subtitle = get_post_meta( $post->ID, 'fave_page_header_subtitle', true );
$page_head_search = get_post_meta( $post->ID, 'fave_page_header_search', true );

$mp4 = get_post_meta( $post->ID, 'fave_page_header_bg_mp4', true );
$webm = get_post_meta( $post->ID, 'fave_page_header_bg_webm', true );
$ogv = get_post_meta( $post->ID, 'fave_page_header_bg_ogv', true );

$video_overlay = get_post_meta( $post->ID, 'fave_page_header_video_overlay', true );
$overlay_img_id = get_post_meta( $post->ID, 'fave_page_header_video_overlay_img', true );
$overlay_img = wp_get_attachment_image_url( $overlay_img_id );
$page_header_video_img = get_post_meta( $post->ID, 'fave_page_header_video_img', true );
$page_header_video_img = wp_get_attachment_image_url( $page_header_video_img );

$video_loop = houzez_option('video_loop');
$video_audio = houzez_option('video_audio');


if( $video_loop != 0 ) {
    $video_loop = 'true';
} else {
    $video_loop = 'false';
}

if( $video_audio != 0 ) {
    $video_audio = 'true';
} else {
    $video_audio = 'false';
}

if( $video_overlay != 'no' ) {
    $overlay = 'true';
} else {
    $overlay = 'false';
}

if (!empty($mp4)) {
?>

<script>
    jQuery(document).ready( function($) {
        $(".video").vegas({
            overlay: <?php echo esc_attr( $overlay ); ?>,
            slides: [
                {
                    src: '<?php echo esc_url( $page_header_video_img ); ?>',
                    video: {
                        src: [
                            '<?php echo esc_url( $mp4 ); ?>',
                            '<?php echo esc_url( $webm ); ?>',
                            '<?php echo esc_url( $ogv ); ?>'
                        ],
                        loop: <?php echo esc_attr( $video_loop ); ?>,
                        mute: <?php echo esc_attr( $video_audio ); ?>
                    }
                }
            ]
        });
    });
</script>

<?php
}
if( !empty($overlay_img) ) { ?>
<style type="text/css" scoped>
    .vegas-overlay {
        background: url(<?php echo esc_url( $overlay_img ); ?>) center center repeat;
    }
</style>
<?php } ?>

<div class="header-media">
    <div id="banner-module-3" class="banner-module banner-single-item banner-video <?php echo esc_attr( $fave_header_full_screen ); ?>">
        <div class="banner-video-inner"></div>
        <div class="banner-caption">
            <?php if( $page_head_search != 'yes' ) { ?>
                <h1><?php echo esc_attr($splash_welcome_text); ?></h1>
                <h2><?php echo esc_attr($page_head_subtitle); ?></h2>
            <?php } ?>

            <?php
            if( $page_head_search != 'no' ) {
                get_template_part( 'template-parts/splash', 'search' );
            }?>
        </div>

    </div>
    <?php
    if( $adv_search_which_header_show['header_video'] != 0 ) {
        if( $adv_search_over_header_pages == 'only_home' ) {
            if (is_front_page()) {
                get_template_part('template-parts/advanced-search/desktop', 'type2');
            }
        } else if( $adv_search_over_header_pages == 'all_pages' ) {
            get_template_part('template-parts/advanced-search/desktop', 'type2');

        } else if ( $adv_search_over_header_pages == 'only_innerpages' ){
            if (!is_front_page()) {
                get_template_part('template-parts/advanced-search/desktop', 'type2');
            }
        } else if( $adv_search_over_header_pages == 'specific_pages' ) {
            if( is_page( $adv_search_selected_pages ) ) {
                get_template_part('template-parts/advanced-search/desktop', 'type2');
            }
        }
    }
    ?>
</div>