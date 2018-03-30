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

$class = yit_get_sidebar_layout() == 'sidebar-no' ? yit_get_option( 'blog-show-date' ) || yit_get_option( 'blog-show-comments' ) || yit_get_option( 'blog-show-author' ) ? ' width11' : ' width12' : ' width8';
?>
<div class="thumbnail<?php echo $class ?>">    
    <!-- post meta -->
    <div>
        <?php yit_string( "<blockquote class=\"post-title\"><a href=\"" . get_permalink() . "\">", get_the_content(), "</a><cite>" . get_the_title() . "</cite></blockquote>" ) ?>
    </div>
</div>

<div class="clear"></div>      