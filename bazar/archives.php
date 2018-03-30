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

/*
Template Name: Archive
*/

get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-archives" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 8 ?> content group">
	        <?php do_action( 'yit_archives' ) ?>
	        </div>
	        <!-- END CONTENT -->
	        <?php do_action( 'yit_after_content' ) ?>
	        
	        <?php get_sidebar() ?>
	        
	        <?php do_action( 'yit_after_sidebar' ) ?>
		</div>
    </div>
</div>
<!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>