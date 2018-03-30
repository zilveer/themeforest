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

$has_thumbnail = ( !yit_image( 'size=blog_bazar&image_scan=' . yit_get_option('blog-show-first-content-image'), false ) || ( ! is_single() && ! yit_get_option( 'blog-show-featured' ) ) || ( is_single() && ! yit_get_option( 'blog-show-featured-single' ) ) ) ? false : true; 

if( yit_get_sidebar_layout() == 'sidebar-no' ) {
    $span = $has_thumbnail ? ( yit_get_option( 'blog-show-date' ) || yit_get_option( 'blog-show-comments' ) ? 7 : 8 ) : ( yit_get_option( 'blog-show-date' ) || yit_get_option( 'blog-show-comments' ) ? 11 : 12 );
} else {
    $span = $has_thumbnail ? ( yit_get_option( 'blog-show-date' ) || yit_get_option( 'blog-show-comments' ) ? 4 : 5 ) : ( yit_get_option( 'blog-show-date' ) || yit_get_option( 'blog-show-comments' ) ? 8 : 9 );
}
?>
                       
<div id="post-<?php the_ID(); ?>" <?php post_class( 'hentry-post group blog-small-ribbon row' ); ?>>   
    <?php if( yit_get_option( 'blog-show-date' ) || yit_get_option( 'blog-show-comments' ) ) : ?>
    <div class="date-comments span1">
        <?php if( yit_get_option( 'blog-show-date' ) ) : ?><p class="date"><span class="month"><?php echo get_the_date( 'M' ) ?></span><span class="day"><?php echo get_the_date( 'd' ) ?></span></p><?php endif; ?>
        <?php if( yit_get_option( 'blog-show-comments' ) ) : ?><p class="comments"><i class="<?php echo yit_get_icon( 'blog-comments-icon' ) ?>"></i><span><?php comments_popup_link( '0', '1', '%' ); ?></span></p><?php endif ?>
    </div>
    <?php endif ?>
    
    <!-- post featured & title -->
    <?php
    if( get_post_format() == 'quote' ) :
        yit_get_template( 'blog/small-ribbon/post-formats/quote.php' );  
    else :
    ?>                
    <div class="<?php if ( ! $has_thumbnail ) echo 'without ' ?>thumbnail span4">
        <?php if ( $has_thumbnail ) : ?>        
            <?php yit_image( 'size=blog_small_ribbon&image_scan=' . yit_get_option('blog-show-first-content-image') ); ?>
        <?php endif ?>          
    
        <?php if( get_post_format() != '' ) : ?><span class="post-format <?php echo get_post_format() ?>"><?php _e( ucfirst( get_post_format() ), 'yit' ) ?></span><?php endif ?>
    </div>
    
    <!-- post title -->
    <div class="span<?php echo $span ?>">
        <?php 
        $link = get_permalink();
        
        if( get_the_title() == '' )
            { $title = __( '(this post does not have a title)', 'yit' ); }
        else
            { $title = get_the_title(); }
        
        if ( is_single() )
            { yit_string( "<h1 class=\"post-title\"><a href=\"$link\">", $title, "</a></h1>" ); } 
        else
            { yit_string( "<h2 class=\"post-title\"><a href=\"$link\">", $title, "</a></h2>" ); }
        ?>
        <div class="the-content">
        <?php
        if( yit_get_option( 'blog-show-read-more' ) ) {
            the_content( yit_get_option( 'blog-read-more-text' ) );
        } else {
            the_excerpt();
        }
        ?>
        
        <?php edit_post_link( __( 'Edit', 'yit' ), '<p class="edit-link"><i class="icon-pencil"></i>', '</p>' ); ?>
        </div>
    </div>
    
    <?php endif //if quote ?>  
    
    <?php wp_link_pages(); ?>

	<?php if( is_single() && ( yit_get_option( 'blog-show-author' ) || yit_get_option( 'blog-show-categories' ) || yit_get_option( 'blog-show-tags' ) ) ) : ?>
        <p>
        <?php
        if( yit_get_option( 'blog-show-author' ) ) : ?><span class="author"><?php _e( 'Posted by', 'yit' ) ?> <?php the_author_posts_link() ?></span><?php endif;
        if( yit_get_option( 'blog-show-categories' ) ) : ?><span class="categories"> <?php _e( 'in', 'yit' ) ?> <?php the_category( ', ' ) ?></span><?php endif;
        if( yit_get_option( 'blog-show-tags' ) ) : the_tags( '<br /><span class="tags">' . __( 'Tags: ', 'yit' ), ', ', '</span>' ); endif;
        ?>
        </p>
    <?php endif ?>
</div> 