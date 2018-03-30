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
 
wp_reset_query();

if( yit_get_sidebar_layout() == 'sidebar-no' )
    { return; }
$span_class= 'span3';

/*
if ( is_page_template('contact.php') ) {
	$span_class= 'span4';
}
*/

do_action( 'yit_before_sidebar_' . sanitize_title( yit_get_choosen_sidebar() ) ) ?>
<!-- START SIDEBAR -->
<div id="sidebar-<?php echo sanitize_title( yit_get_choosen_sidebar() ) ?>" class="<?php echo $span_class ?> sidebar group">
    <?php
    if( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( yit_get_choosen_sidebar() ) )
        { do_action( 'yit_default_sidebar' ); }
    ?>
</div>
<!-- END SIDEBAR -->
<?php do_action( 'yit_after_sidebar_' . sanitize_title( yit_get_choosen_sidebar() ) ) ?>