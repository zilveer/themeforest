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

$post_classes = 'hentry-post group blog-big-ribbon row';

$span = yit_get_sidebar_layout() == 'sidebar-no' ? yit_get_option( 'blog-show-date' ) || yit_get_option( 'blog-show-comments' ) ? 11 : 12 : 8;

if( yit_get_option( 'blog-post-formats-list' ) )
    { $post_classes .= ' post-formats-on-list'; }
?>                 
<div id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
    <!-- post featured & title -->
    <?php
    $post_format = get_post_format() == '' ? 'standard' : get_post_format();
    $post_format = yit_get_option( 'blog-post-formats-list' ) && get_post_format() != ''  ? get_post_format() : $post_format;
    
    yit_get_template( 'blog/big-ribbon/post-formats/' . $post_format . '.php' );
    ?>
    
    <!-- post content -->
    <div class="the-content<?php if( is_single() ) echo ' single'; ?> span<?php echo $span ?> group"><?php
			
		if( $post_format != 'quote' )
        {
			if( yit_get_option( 'blog-show-read-more' ) )
			{
	            the_content( yit_get_option( 'blog-read-more-text' ) );
	        }
	        else
	        {
	            the_excerpt();
	        }
		}
        
        if( is_single() ) : ?>
            <p>
            <?php
            if( yit_get_option( 'blog-show-author' ) ) : ?><span class="author"><?php _e( 'Posted by', 'yit' ) ?> <?php the_author_posts_link() ?></span><?php endif;
            if( yit_get_option( 'blog-show-categories' ) ) : ?><span class="categories"> <?php _e( 'in', 'yit' ) ?> <?php the_category( ', ' ) ?></span><?php endif;
            if( yit_get_option( 'blog-show-tags' ) ) : the_tags( '<br /><span class="tags">' . __( 'Tags: ', 'yit' ), ', ', '</span>' ); endif;
            ?>
            </p>
        <?php endif ?>
    </div>
    
    <div class="clear"></div>
    
    <?php wp_link_pages(); ?>
	<?php if( is_paged() && is_single() ) { previous_post_link(); echo ' | '; next_post_link(); } ?>    
</div>