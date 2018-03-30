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

$span = yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9;
?>

<div class="blog-bazar-header span<?php echo $span; ?>">
		
	<!-- post date -->
	<?php if( yit_get_option( 'blog-show-date' ) ) : ?>
		<p class="date"><span class="month"><?php echo get_the_date( 'M' ) ?></span><span class="day"><?php echo get_the_date( 'd' ) ?></span></p>
	<?php endif ?>
	
	<!-- post title -->
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
	
	<!-- post author -->
	<div class="meta">
		<?php if( yit_get_option( 'blog-show-author' ) ) : ?><span class="author"><?php _e( 'posted by', 'yit' ) ?> <?php the_author_posts_link() ?></span><?php endif; ?>
	</div>
    
    <!-- post comments -->
	<?php if( yit_get_option( 'blog-show-comments' ) ) : ?>
		<p class="comments">
			<!--<i class="<?php echo yit_get_icon( 'blog-comments-icon' ) ?>"></i>-->
			<i class="blog-bazar-comment-icon"></i>
			<span><?php comments_popup_link( '0', '1', '%' ); ?></span>
		</p>
	<?php endif ?>
	
</div>


<div class="thumbnail span<?php echo $span ?>">
	<div class="border">

		<div>
		    <?php yit_string( "<blockquote class=\"post-title\"><a href=\"$link\">", get_the_content(), "</a><cite>" . $title . "</cite></blockquote>" ) ?>
		</div>
	</div>
</div>

<div class="clear"></div>      