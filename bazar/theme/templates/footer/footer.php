<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files there is a collection of a functions useful for the core
 * of the framework.   
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

$footer_type = yit_get_option( 'footer-type' );

if( strstr( $footer_type, 'big' ) || strstr( $footer_type, 'sidebar' ) ) {
    /**
     * @see yit_footer_big
     */
    do_action( 'yit_footer_big' );
}
?>

<?php do_action( 'yit_before_copyright' ) ?>
<!-- START COPYRIGHT -->
<div id="copyright">
	
	<div class="border borderstrong borderpadding container"></div>
	<div class="border container"></div>
	<div class="border container"></div>
	<div class="border container"></div>
	
    <div class="container">
        <div class="row">
        <?php
        /**
         * @see yit_copyright
         */
        do_action( 'yit_copyright' ) ?>
        </div>
    </div>
</div>
<!-- END COPYRIGHT -->
<?php do_action( 'yit_after_copyright' ) ?>