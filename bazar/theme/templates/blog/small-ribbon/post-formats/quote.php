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
?>
<div class="thumbnail span<?php echo $span ?>">
    <!-- post title -->
    <?php 
    $link = get_permalink();
    
    if( get_the_title() == '' )
        { $title = __( '(this post does not have a title)', 'yit' ); }
    else
        { $title = get_the_title(); }
    ?>
    
    <!-- post meta -->
    <div>
        <?php yit_string( "<blockquote class=\"post-title\"><a href=\"$link\">", get_the_content(), "</a><cite>" . $title . "</cite></blockquote>" ) ?>
    </div>
</div>

<div class="clear"></div>      