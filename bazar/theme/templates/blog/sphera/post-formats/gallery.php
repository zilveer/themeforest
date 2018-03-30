<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if( !is_single() && !yit_get_option( 'blog-post-formats-list' ) )
    { yit_get_template( 'blog/sphera/post-formats/standard.php' ); return; }

$image = yit_image( 'size=blog_sphera&output=array' );
$has_thumbnail = ( ! has_post_thumbnail() || ( ! is_single() && ! yit_get_option( 'blog-show-featured' ) ) || ( is_single() && ! yit_get_option( 'blog-show-featured-single' ) ) ) ? false : true; ?>

<div class="<?php if ( ! $has_thumbnail ) echo 'without ' ?>thumbnail" style="max-height:<?php echo $image[2] ?>px;width:<?php echo $image[1] ?>px">
    <!-- post title -->
    <?php
    $attachments = get_posts( array(
    	'post_type' 	=> 'attachment',
    	'numberposts' 	=> -1,
    	'post_status' 	=> null,
    	'post_parent' 	=> get_the_ID(),
    	'post_mime_type'=> 'image',
    	'orderby'		=> 'menu_order',
    	'order'			=> 'ASC'
    ) );
    
    if( $attachments ) {
        $height = 0;
        $html = '';
                                                        
        foreach ( $attachments as $key => $attachment ) { 
            $image = yit_image( "id=$attachment->ID&size=blog_sphera&output=array" );
            $html .= $image[0] . PHP_EOL;
        }
        
        $html = '[images_slider effect="fade" width="0" height="auto" direction="horizontal" speed="5000"]' . PHP_EOL . $html . '[/images_slider]';
        
        echo do_shortcode( $html );
    }
    ?>
    <div class="clear"></div>
</div>