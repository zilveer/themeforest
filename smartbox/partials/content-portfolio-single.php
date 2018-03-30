<?php
/**
 * Portfolio single template
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 1.3
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

// if override image not empty , display default image as portfolio background.
$img = '';
$data_image = '';
$override_image = get_post_meta( $post->ID, THEME_SHORT . '_background', true );
if( !empty( $override_image ) ) {
    $img = wp_get_attachment_image_src( $override_image, 'full' );
    if( $img[0] !== null ) {
        $img = $img[0];
        $data_image = 'data-background="url(' . $img . ') no-repeat top"';
    }
}
if ( have_posts() ):
    the_post();
    // create content for post
    $content = get_the_content();
    // strip video embed from content if video post
    switch( get_post_format() ) {
        case 'video':
            $video_shortcode = oxy_get_content_shortcode( $post, 'embed' );
            if( $video_shortcode !== null ) {
                if( isset( $video_shortcode[0] ) ) {
                    $video_shortcode = $video_shortcode[0];
                    if( isset( $video_shortcode[0] ) ) {
                        $content = str_replace( $video_shortcode[0], '', get_the_content() );
                    }
                }
            }
        break;
        case 'gallery':
            $gallery_shortcode = oxy_get_content_shortcode( $post, 'gallery' );
            if( $gallery_shortcode !== null ) {
                if( isset( $gallery_shortcode[0] ) ) {
                    // show gallery
                    $gallery_ids = null;
                    if( array_key_exists( 3, $gallery_shortcode ) ) {
                        if( array_key_exists( 0, $gallery_shortcode[3] ) ) {
                            $gallery_attrs = shortcode_parse_atts( $gallery_shortcode[3][0] );
                            if( array_key_exists( 'ids', $gallery_attrs) ) {
                                $gallery_ids = explode( ',', $gallery_attrs['ids'] );
                            }
                        }
                    }
                    // strip shortcode from the content
                    $gallery_shortcode = $gallery_shortcode[0];
                    if( isset( $gallery_shortcode[0] ) ) {
                        $content = str_replace( $gallery_shortcode[0], '', get_the_content() );
                    }
                }
            }
        break;
    }
?>
<section class="section section-padded section-dark" <?php echo $data_image ?> >
    <div class="container-fluid">
        <div class="super-hero-unit">
            <?php if ( $img == ''): ?>
                <div class="section-header">
                    <h1>
                       <?php the_title(); ?>
                    </h1>
                </div>
            <?php else: ?>
                <h1 class="animated fadeinup delayed text-center">
                   <?php the_title(); ?>
                </h1>
            <?php endif ?>
            <div class="row-fluid margin-top">
                <div class="span4">
                    <span class="lead margin-top">
                        <?php echo apply_filters( 'the_content', $content ); ?>
                    </span>
                    <!-- skills section -->
                    <?php
                    $skills = wp_get_post_terms( $post->ID, 'oxy_portfolio_skills' );
                    if ( !empty($skills) ) : ?>
                        <ul class="lead icons icons-small">
                        <?php foreach ($skills as $skill) : ?>
                            <li><i class="icon-ok"></i><?php echo $skill->name ?></li>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="span8">
                    <?php
                    switch( get_post_format() ) {
                        case '':
                            if( has_post_thumbnail( $post->ID ) ) {
                                the_post_thumbnail( 'full' );
                            }
                        break;
                        case 'gallery':
                            if( $gallery_ids !== null ) { ?>
                                <div class="post-media">
                                    <?php oxy_create_flexslider( $gallery_ids ); ?>
                                </div>
                            <?php
                            }
                        break;
                        case 'video':
                            // get video embed shortcpde
                            if( isset( $video_shortcode[0] ) ) {
                                // use the video in the archives
                                global $wp_embed;
                                echo $wp_embed->run_shortcode( $video_shortcode[0] );
                                $content = str_replace( $video_shortcode[0], '', get_the_content() );
                            }
                        break;
                    }?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif;

// get related posts excluding this one.
$cats = wp_get_post_terms( $post->ID, 'oxy_portfolio_categories' );
if( !empty( $cats ) ) {
    $args = array(  'post_type' => 'oxy_portfolio_image' ,
                    'numberposts' => 3 ,
                    'post__not_in' => array($post->ID) ,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'oxy_portfolio_categories',
                            'field' => 'slug',
                            'terms' => $cats[0]->slug
                        )
                    )
                );

    $related = get_posts($args);
    if( $related ) : ?>
        <section class="section section-padded">
            <div class="container-fluid">
                <div class="section-header">
                    <h1>
                        <?php echo oxy_filter_title( oxy_get_option( 'portfolio_related_title' ) ); ?>
                    </h1>
                </div>
                <div class="row-fluid">
                    <ul class="thumbnails portfolio">
                        <?php foreach( $related as $post ) {
                           setup_postdata($post); ?>
                            <li class="span4">
                                 <?php get_template_part( 'partials/content', 'portfolio' ); ?>
                            </li>
                        <?php wp_reset_postdata();  } ?>
                    </ul>
                </div>
            </div>
        </section>
    <?php
    endif;
    wp_reset_postdata();
}

get_footer();
