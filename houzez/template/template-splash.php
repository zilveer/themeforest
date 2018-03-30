<?php
/**
 * Template Name: Splash Page Template
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 18/12/15
 * Time: 3:49 PM
 */
get_header();
global $houzez_local, $post;
$search_template = houzez_get_template_link('template/template-search.php');
$background_type = houzez_option('backgroud_type');
$splash_welcome_text = houzez_option( 'splash_welcome_text' );
$page_head_subtitle = houzez_option( 'splash_welcome_sub' );
$splash_callus_icon = houzez_option( 'splash_callus_icon' );
$splash_callus_text = houzez_option( 'splash_callus_text' );
$splash_callus_phone = houzez_option( 'splash_callus_phone' );
$splash_overlay = houzez_option( 'splash_overlay' );
$splash_layout = houzez_option('splash_layout');

$allowed_html = array(
    'i' => array(
        'class' => array()
    )
);

if( $splash_overlay != 0 ) {
    $overlay = 'true';
} else {
    $overlay = 'false';
}

if( isset($_GET['splash_type'] ) ) {
    $background_type = $_GET['splash_type'];
}

$bg_img = '';
if( $background_type == 'image' ) {
    $image_url = houzez_option( 'splash_image', false, 'url' );
    if (!empty($image_url)) {
        $bg_img = 'style="background-image: url(' . esc_url ( $image_url ). ');"';
    }
} else if ( $background_type == 'slider' ) {
    $image_ids = houzez_option( 'splash_slider' );
    $image_ids = explode(',', $image_ids );
    $images = '';
    foreach ( $image_ids as $id ) {
        $url = wp_get_attachment_image_src($id, array(2000, 1000));
        $images .= '{ src: "'.esc_url( $url[0] ).'" },';
    }
    ?>

    <script>
        jQuery(document).ready( function($) {
            $(".splash-inner-media").vegas({
                delay: 7000,
                preloadImage: true,
                timer: true,
                shuffle: true,
                transition: ['fade'],
                transitionDuration: 2000,
                overlay: <?php echo esc_attr($overlay); ?>,
                slides: [
                    <?php echo wp_kses($images, $allowed_html); ?>
                ]
            });
        });
    </script>
<?php
} else if( $background_type == 'video' ) {
    $mp4 = houzez_option( 'splash_bg_mp4', false, 'url' );
    $webm = houzez_option( 'splash_bg_webm', false, 'url' );
    $ogv = houzez_option( 'splash_bg_ogv', false, 'url' );
    $splash_video_image = houzez_option('splash_video_image', false, 'url');
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

    if (!empty($mp4)) {
        ?>

        <script>
            jQuery(document).ready( function($) {
                $(".splash-inner-media").vegas({
                    overlay: <?php echo esc_attr( $overlay ); ?>,
                    slides: [
                        {
                            src: '<?php echo esc_url( $splash_video_image ); ?>',
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
}
?>
<!--start section top-->
<section id="splash-section">

    <?php if( $background_type == 'image' && $splash_overlay != 0 ) { ?>
    <div class="vegas-overlay"></div>
    <?php } ?>
    <div class="splash-inner-media" <?php echo wp_kses( $bg_img, $allowed_html ); ?>></div>

    <div class="splash-inner-content">
        <div class="<?php echo esc_attr( $splash_layout ); ?>">
            <!--start section header-->
            <?php get_template_part( 'inc/header/header', 'splash'); ?>
            <!--end section header-->

            <div class="splash-search">
                <div class="search-table fave-screen-fix-inner">
                    <div class="search-col">
                        <?php get_template_part( 'template-parts/splash', 'search' ); ?>
                    </div>
                </div>
            </div>

            <div class="splash-footer">
                <div class="row">
                    <div class="col-sm-6 col-xs-6 splash-foot-left">
                        <p><?php echo wp_kses( $splash_callus_icon, $allowed_html ); ?> <?php echo esc_attr( $splash_callus_text ); ?> <strong><?php echo esc_attr( $splash_callus_phone ); ?></strong></p>
                    </div>
                    <?php if( houzez_option('social-splash') != '0' ): ?>
                        <div class="col-sm-6 col-xs-6 splash-foot-right">
                            <p>
                                <?php echo $houzez_local['follow_us']; ?>
                                <?php if( houzez_option('sp-facebook') != '' ){ ?>
                                    <a target="_blank" class="btn-facebook" href="<?php echo esc_url(houzez_option('sp-facebook')); ?>"><i class="fa fa-facebook-square"></i></a>
                                <?php } ?>

                                <?php if( houzez_option('sp-twitter') != '' ){ ?>
                                    <a target="_blank" class="btn-twitter" href="<?php echo esc_url(houzez_option('sp-twitter')); ?>"><i class="fa fa-twitter-square"></i></a>
                                <?php } ?>

                                <?php if( houzez_option('sp-linkedin') != '' ){ ?>
                                    <a target="_blank" class="btn-linkedin" href="<?php echo esc_url(houzez_option('sp-linkedin')); ?>"><i class="fa fa-linkedin-square"></i></a>
                                <?php } ?>

                                <?php if( houzez_option('sp-googleplus') != '' ){ ?>
                                    <a target="_blank" class="btn-google-plus" href="<?php echo esc_url(houzez_option('sp-googleplus')); ?>"><i class="fa fa-google-plus-square"></i></a>
                                <?php } ?>

                                <?php if( houzez_option('sp-instagram') != '' ){ ?>
                                    <a target="_blank" class="btn-instagram" href="<?php echo esc_url(houzez_option('sp-instagram')); ?>"><i class="fa fa-instagram"></i></a>
                                <?php } ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--end section top-->
<?php get_footer(); ?>