<?php
/**
 * The template for List Blog entry
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */

$kleo_post_format = get_post_format();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array("clearfix")); ?>>
        <div class="entry-image">
            <?php
            switch ( $kleo_post_format ) {

                case 'video' :
                    $video = get_cfield( 'embed' );
                    if ( !empty( $video ) ) {
                        global $wp_embed;
                        echo apply_filters( 'kleo_oembed_video', $video );
                    }
                break;

                case 'gallery':

                    $slides = get_cfield( 'slider' );

                    if ( $slides ) {
                        echo '<div class="fslider" data-arrows="false" data-lightbox="gallery">';
                        echo '<div class="flexslider"> <div class="slider-wrap">';
                        foreach( $slides as $slide ) {
                            if ( $slide ) {
                                $image = aq_resize( $slide, Kleo::get_config('post_gallery_img_width'), Kleo::get_config('post_gallery_img_height'), true, true, true );
                                //small hack for non-hosted images
                                if (! $image ) {
                                    $image = $slide;
                                }
                                echo '<div class="slide">' .
                                    '<a href="'. $slide .'" data-lightbox="gallery-item">
									<img class="image_fade" src="'.$image.'" alt="'. get_the_title() .'">'
                                    . '</a>' .
                                '</div>';
                            }
                        }
                        echo '</div></div>';
                        echo '</div>';
                    } elseif ( kleo_get_post_thumbnail_url() != '' ) {

                        $img_url = kleo_get_post_thumbnail_url();
                        $image = aq_resize( $img_url, Kleo::get_config('post_gallery_img_width'), null, true, true, true );
                        if( ! $image ) {
                            $image = $img_url;
                        }
                        echo '<a href="'. get_permalink() .'">'
                            . '<img class="image_fade" src="' . $image . '" alt="'. get_the_title() .'">'
                            . '</a>';
                    }

                    break;

                case 'link':

                    break;

                case 'quote':

                    break;

                case 'status':

                    break;

                case 'image':
                default:
                    if ( kleo_get_post_thumbnail_url() != '' ) {

                        $img_url = kleo_get_post_thumbnail_url();
                        $image = aq_resize( $img_url, Kleo::get_config('post_gallery_img_width'), null, true, true, true );
                        if( ! $image ) {
                            $image = $img_url;
                        }
                        echo '<a href="'. get_permalink() .'">'
                            . '<img class="image_fade" src="' . $image . '" alt="'. get_the_title() .'">'
                            . '</a>';
                    }

                    break;

            }
            ?>
        </div>

        <div class="entry-c">

            <?php if ( ! in_array( $kleo_post_format, array('status', 'quote', 'link') ) ): ?>
                <div class="entry-title">
                    <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                </div>
            <?php endif; ?>

            <?php kleo_entry_meta();?>

            <?php if ( ! in_array( $kleo_post_format, array('status', 'quote', 'link') ) ): ?>

                <?php if ( kleo_excerpt( '40' ) != '' ) : ?>
                    <div class="entry-content">

                        <?php echo kleo_excerpt( '40' ); ?>
                        <a class="more-link" href="<?php the_permalink();?>"><?php esc_html_e( "Read more","buddyapp" );?></a>

                    </div><!--end entry-content-->
                <?php endif; ?>
            <?php elseif( $kleo_post_format == 'link' ): ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            <?php elseif( $kleo_post_format == 'quote' ): ?>
                <blockquote>
                    <?php the_content();?>
                </blockquote>
            <?php elseif( $kleo_post_format == 'status' ): ?>

                <div class="entry-content">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php the_content();?>
                        </div>
                    </div>
                </div>

            <?php endif;?>


        </div>

</article>

