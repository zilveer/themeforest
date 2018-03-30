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
    { yit_get_template( 'blog/big-ribbon/post-formats/standard.php' ); return; }
 
$span = yit_get_sidebar_layout() == 'sidebar-no' ? yit_get_option( 'blog-show-date' ) || yit_get_option( 'blog-show-comments' ) ? 11 : 12 : 8;
 
$has_thumbnail = ( ! has_post_thumbnail() || ( ! is_single() && ! yit_get_option( 'blog-show-featured' ) ) || ( is_single() && ! yit_get_option( 'blog-show-featured-single' ) ) ) ? false : true; ?>

<?php if( yit_get_option( 'blog-show-date' ) || yit_get_option( 'blog-show-comments' ) ) : ?>
<div class="date-comments span1">
    <?php if( yit_get_option( 'blog-show-date' ) ) : ?><p class="date"><span class="month"><?php echo get_the_date( 'M' ) ?></span><span class="day"><?php echo get_the_date( 'd' ) ?></span></p><?php endif; ?>
    <?php if( yit_get_option( 'blog-show-comments' ) ) : ?><p class="comments"><i class="<?php echo yit_get_icon( 'blog-comments-icon' ) ?>"></i><span><?php comments_popup_link( '0', '1', '%' ); ?></span></p><?php endif ?>
</div>
<?php endif ?>

<div class="<?php if ( ! $has_thumbnail ) echo 'without ' ?>thumbnail span<?php echo $span ?>">
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
            $image = wp_get_attachment_image_src( $attachment->ID, 'blog_big' );
            $html .= yit_image( "id=$attachment->ID&size=blog_big&output=url", false ) . PHP_EOL;
        }
        
        $html = '[images_slider effect="fade" width="0" height="auto" direction="horizontal" speed="5000"]' . PHP_EOL . $html . '[/images_slider]';
        
        echo do_shortcode( $html );
    }

    $link = get_permalink();
    
    if( get_the_title() == '' )
        { $title = __( '(this post does not have a title)', 'yit' ); }
    else
        { $title = get_the_title(); }

    yit_string( "<h1 class=\"post-title\"><a href=\"$link\">", $title, "</a></h1>" );
    ?>
</div>

<div class="clear"></div>