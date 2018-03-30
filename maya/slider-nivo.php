<?php
/**
 * @package WordPress
 * @subpackage Maya
 * @since 1.0
 */ 
?>
        <!-- BEGIN NIVO SLIDER -->
        <div id="slider" class="nivo group inner mobile">
            <div class="slider-images">
            <?php
            while( yiw_have_slide() ) :
                yiw_slide_the( 'featured-content', array(
                    'container' => false
                ));
            endwhile; ?>
            </div>
            <div class="slider-nivo-static">
                <h3>
                <?php
                $static_title = stripslashes( yiw_slide_get( 'static_title' ) );
                $static_title = str_replace(
                    array( '[', ']'),
                    array( '<span>', '</span>' ),
                    $static_title
                );
                
                echo $static_title;
                ?>
                </h3>
                <?php echo yiw_addp ( stripslashes( yiw_slide_get( 'text' ) ) ); ?>
                <?php
                $short_text = yiw_slide_get( 'static_short_text' );
                $short_text = str_replace( array( '[', ']' ), array( '<strong>', '</strong>' ), $short_text );
                
                if( !empty( $short_text ) ) {
                    echo '<p class="short-text">', do_shortcode( stripslashes( $short_text ) ), '</p>';
                }
                ?>
            </div>
            <div class="clear"></div>
        </div>
        <!-- END NIVO SLIDER -->