<?php if(! defined('ABSPATH')){ return; }
/**
* Single Related Item
*/
?>
<div class="col-sm-4">
    <div class="rta-post kl-blog-related-post">
        <?php
            $thumb   = get_post_thumbnail_id( get_the_ID() );

            if( !empty( $thumb ) ){
                $f_image = wp_get_attachment_url( $thumb );

                $alt = get_post_meta($thumb, '_wp_attachment_image_alt', true);
                $title = get_the_title($thumb);

                $image = vt_resize( '', $f_image, 370, 240, true );
                if( !empty( $image ) ){
                    echo '<a class="kl-blog-related-post-link" href="' . get_permalink() . '">
                    <img class="kl-blog-related-post-img" src="'. $image['url'] . '" width="' . $image['width'] . '" height="' .$image['height'] . '" alt="'.$alt.'" title="'.$title.'"/></a>';
                }
            }
            elseif ( $usePostFirstImage  && ! post_password_required() ){
                $f_image = echo_first_image();


                if ( ! empty ( $f_image ) ) {

                    $alt = ZngetImageAltFromUrl( $f_image );
                    $title = ZngetImageTitleFromUrl( $f_image );

                    $image = vt_resize( '', $f_image, 370, 240, true );

                    if( !empty( $image ) ){
                        echo '<a class="kl-blog-related-post-link" href="' . get_permalink() . '">
                        <img class="kl-blog-related-post-img" src="'. $image['url'] . '" width="' . $image['width'] . '" height="' .$image['height'] . '" alt="'.$alt.'" title="'.$title.'"/></a>';
                    }

                }
            }

        ?>
        <h5 class="kl-blog-related-post-title"><a class="kl-blog-related-post-title-link" href="<?php echo get_permalink(); ?>"><?php the_title();?></a></h5>
    </div>
</div>
