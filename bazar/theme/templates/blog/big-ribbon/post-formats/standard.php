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
    $link = get_permalink();
    
    if( get_the_title() == '' )
        { $title = __( '(this post does not have a title)', 'yit' ); }
    else
        { $title = get_the_title(); }
    ?>

    <?php
    if( $has_thumbnail ) {
        yit_image( "size=blog_big_ribbon" );//the_post_thumbnail( 'blog_big_ribbon' );
    }
    ?>
    
    <!-- post meta -->
    <?php
    if ( is_single() )
        { yit_string( "<h1 class=\"post-title\"><a href=\"$link\">", $title, "</a></h1>" ); } 
    else
        { yit_string( "<h2 class=\"post-title\"><a href=\"$link\">", $title, "</a></h2>" ); }
    ?>
    
    <?php if( get_post_format() != '' && !is_single() ) : ?><span class="post-format <?php echo get_post_format() ?>"><?php _e( ucfirst( get_post_format() ), 'yit' ) ?></span><?php endif ?>
</div>

<div class="clear"></div>