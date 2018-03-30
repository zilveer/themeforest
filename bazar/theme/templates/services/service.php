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
?>
<!-- START SERVICE -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
	        
	            <div class="clear"></div>
	            <div class="posts">
	                <?php                      
	                $item_id = get_the_ID();
	                $title = is_null( get_the_title() ) ? __( '(this post has no title)', 'yit' ) : the_title('<h2>', '</h2>', false);
	                ?>
	                <div id="post-<?php the_ID(); ?>" <?php post_class( 'hentry-post group blog-big' ); ?>>
	                    <?php                         
	                    if( get_the_title() == '' )
	                        { $title = __( '(this post does not have a title)', 'yit' ); }
	                    else
	                        { $title = get_the_title(); }	                    
	                    ?>							
	                    <!-- post content -->
	                    <div class="the-content<?php if( is_single() ) echo ' single'; ?> group">
	                        <?php yit_string( "<h1 class=\"post-title\">", yit_decode_title($title), "</h1>" ) ?>
	                        <?php the_content() ?>
	                    </div>
		                
	                    <?php wp_link_pages(); ?>
	                    
	                    <div class="clear"></div>
	                    
	                	<?php
	                    if( is_paged() && is_single() ) { previous_post_link(); echo ' | '; next_post_link(); }
	                    ?>    
	                </div>        
	                         
	            </div>
	        
	        </div>
	        <!-- END CONTENT -->
	        <?php do_action( 'yit_after_content' ) ?>
	        
	        <?php do_action( 'yit_before_sidebar' ) ?>
	        <?php get_sidebar() ?>
	        <?php do_action( 'yit_after_sidebar' ) ?>
	    </div>
    </div>
</div>
<!-- END TESTIMONIALS -->