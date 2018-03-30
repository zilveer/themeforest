<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template logo slider
 *
 * @package Yithemes
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wp_reset_query();

$args = array(
    'post_type' => 'logo'
);

$args['posts_per_page'] = (!is_null( $items )) ? $items : -1;

$tests = new WP_Query( $args );

$html = '';
if( !$tests->have_posts() ) return $html;
    
?>

<div class="margin-bottom">
    <div class="logos-slider wrapper">
        <h4><?php echo $title; ?></h4>
        <div class="nav">
            <a class="prev" href="#"><i class="fa fa-angle-left"></i></a>
            <a class="next" href="#"><i class="fa fa-angle-right"></i></a>
        </div>
        <div class="list_carousel">

            <ul class="logos-slides" data-speed="<?php echo $speed ?>">
            
                <?php
                    
                    while( $tests->have_posts() ) : $tests->the_post();
                        $logo_title = the_title( '<strong><a href="' . get_permalink() . '" class="name">', '</a></strong>', false );
                        $logo_link = yit_get_post_meta( get_the_ID(), '_logo_site' );
                ?>
                    <li style="height: <?php echo $height; ?>px;">
                        <?php
                            if ($logo_link != ''):
                                echo '<a href="' . esc_url($logo_link) . '" class="bwWrapper">';
                            else:
                                echo '<a href="#" class="bwWrapper" >';
                            endif;
                            
                            $image_id = get_post_thumbnail_id();  
                            $image_url = wp_get_attachment_image_src($image_id,'full');  
                            $image_url = $image_url[0]; 
                            
                            echo '<img src="'.$image_url.'" style="max-height: '.$height.'px;" class="logo" />';
							
                            echo '</a>';
                        ?>
                    </li>
                <?php endwhile; wp_reset_query(); ?>
            </ul>
        </div>
        <div class="clear"></div>

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>

<?php
yit_enqueue_script( 'jquery-imagesloaded', YIT_Logos()->plugin_assets_url . '/js/jquery.imagesloaded.min.js', array( 'jquery' ), '', true );
yit_enqueue_script( 'owl-carousel', YIT_Logos()->plugin_assets_url . '/js/owl.carousel.min.js', array( 'jquery' ), '', true );
if ( $active_bw == 'yes' ) yit_enqueue_script( 'black-and-white', YIT_Logos()->plugin_assets_url . '/js/jQuery.BlackAndWhite.js', array( 'jquery' ), '', true );

echo $html;

add_action( 'wp_footer', array( YIT_Logos(), 'add_handler' ), 30 );