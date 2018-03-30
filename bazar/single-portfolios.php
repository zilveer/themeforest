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

global $post;
$vars = yit_portfolio_query_vars();

get_header();
do_action( 'yit_before_primary' );

?>

<!-- START PRIMARY -->
<div id="primary" class="sidebar-no">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span12 content group">          
	        
			<?php
			if( !isset( $vars->post_id ) ) : yit_portfolio($post->post_name); 
			else :
			?>
	        
	            <div class="clear"></div>
	            <div class="posts">      
	                
	                <div id="post-<?php if (isset($vars->item_id)) echo $vars->item_id; ?>" class="hentry-post group portfolio-post internal-post">
	                	
	                	<?php yit_get_template( 'portfolios/full-description/loop.php', array( 'current_portfolio' => $vars->post_id ) ); ?>
						
						<div class="clear"></div>
	                </div>      
	            
	            </div>
	        <?php endif ?>
	        </div>
	        <!-- END CONTENT -->
	        <?php do_action( 'yit_after_content' ) ?>
	        
	        <?php //do_action( 'yit_before_sidebar' ) ?>
	        <?php //get_sidebar() ?>
	        <?php //do_action( 'yit_after_sidebar' ) ?>
	    </div>
    </div>
</div>
<!-- END PRIMARY -->         
<?php
do_action( 'yit_after_primary' );
get_footer() ?>