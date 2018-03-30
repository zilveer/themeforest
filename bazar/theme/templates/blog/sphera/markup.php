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

$post_classes = 'hentry-post group blog-sphera row margin-bottom';

if( yit_get_option( 'blog-post-formats-list' ) )
    { $post_classes .= ' post-formats-on-list'; }
?>                 
<div id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
    
    <?php if( yit_get_option( 'blog-show-date' ) || yit_get_option( 'blog-show-comments' ) ) : ?>
    <div class="meta span1">
        <?php if( yit_get_option( 'blog-show-date' ) ) : ?><p class="date"><span class="month-day"><?php echo get_the_date( 'M j' ) ?></span><span class="year"><?php echo get_the_date( 'Y' ) ?></span></p><?php endif; ?>
        <?php if( yit_get_option( 'blog-show-author' ) ) : ?><p class="author"><span><?php echo get_avatar( get_the_author_meta( 'ID' ), 41 ) ?></span></p><?php endif; ?>
        <?php if( yit_get_option( 'blog-show-comments' ) ) : ?><p class="comments"><span><?php comments_popup_link( '0', '1', '%' ); ?></span></p><?php endif ?>
        <img src="<?php echo YIT_THEME_TEMPLATES_URL ?>/blog/sphera/images/vertical-line.jpg" class="vertical-line" id="vertical-line-top" alt="" /> 
        <img src="<?php echo YIT_THEME_TEMPLATES_URL ?>/blog/sphera/images/vertical-line.jpg" class="vertical-line" id="vertical-line-bottom" alt="" />
    </div>
    <?php endif ?>
    
    <!-- post featured & title -->
    <?php
    $post_format = get_post_format() == '' ? 'standard' : get_post_format();
    $post_format = yit_get_option( 'blog-post-formats-list' ) && get_post_format() != ''  ? get_post_format() : $post_format;
    
    yit_get_template( 'blog/sphera/post-formats/' . $post_format . '.php' );
    ?>
    
    <?php if( get_post_format() != 'quote' ) : ?>
    <div class="the-content-container">
        <!-- post content -->
        <div class="the-content<?php if( is_single() ) echo ' single'; ?> group"><?php
            $link = get_permalink();
            
            if( get_the_title() == '' )
                { $title = __( '(this post does not have a title)', 'yit' ); }
            else
                { $title = get_the_title(); }
            
            if ( is_single() )
                { yit_string( "<h1 class=\"post-title\"><a href=\"$link\">", $title, "</a></h1>" ); } 
            else
                { yit_string( "<h2 class=\"post-title\"><a href=\"$link\">", $title, "</a></h2>" ); }
            
            if( yit_get_option( 'blog-show-read-more' ) ) {
	            the_content( yit_get_option( 'blog-read-more-text' ) );
	        } else {
	            the_excerpt();
	        }
            
            if( is_single() && yit_get_option( 'blog-show-tags' ) ) : ?>
                <p>
                <?php the_tags( '<br /><span class="tags">' . __( 'Tags: ', 'yit' ), ', ', '</span>' ) ?>
                </p>
            <?php endif ?>
        </div>
    </div>
    <?php endif ?>
    
    <div class="clear"></div>
    
    <?php wp_link_pages(); ?>
	<?php if( is_paged() && is_single() ) { previous_post_link(); echo ' | '; next_post_link(); } ?>    
</div>