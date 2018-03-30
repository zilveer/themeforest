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

if( dynamic_sidebar( 'Default Sidebar' ) )
    { return; }
?>
<div class="widget widget_search">            
    <h3><?php _e( 'Search', 'yit' ) ?></h3>
    <?php do_action( 'yit_searchform', 'post' ) ?>
</div>

<div class="widget widget_archives">
    <h3><?php _e( 'Archives', 'yit' ) ?></h3>
    <ul>
        <?php wp_get_archives('type=monthly&show_post_count=1'); ?>
    </ul>
</div>

<div class="widget widget_list_categories">
    <h3><?php _e( 'Categories', 'yit' ) ?></h3>
    <ul>
        <?php 
			$cat_params = Array(
					'hide_empty'	=>	FALSE,
					'title_li'		=>	''
				);
			if( strlen( trim( yit_get_option( 'blog-cats-exclude[2]' ) ) ) > 0 ){
				$cat_params['exclude'] = trim( yiw_get_option( 'blog-cats-exclude[2]' ) );
			}
			wp_list_categories( $cat_params ); 
        ?>
    </ul>
</div>

<div class="widget">
    <h3><?php _e( 'Blogroll', 'yit' ) ?></h3>
    <ul>
        <?php wp_list_bookmarks( 'title_li=&categorize=0' ) ?>
    </ul>
</div>