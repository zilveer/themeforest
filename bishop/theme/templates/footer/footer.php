<?php
/**
 * Your Inspiration Themes
 *
 * In this files there is a collection of a functions useful for the core
 * of the framework.
 *
 * @package    WordPress
 * @subpackage Your Inspiration Themes
 * @author     Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$footer_type = apply_filters( 'yit_footer_type', yit_get_option( 'footer-type' ) );

if ( $footer_type != 'none' ) {
    ?>
    <div id="footer-copyright-group">
        <?php
        if ( strstr( $footer_type, 'big' ) ) {
            /**
             * @see yit_footer_big
             */
            do_action( 'yit_footer_big' );
        }
        ?>

        <?php do_action( 'yit_before_copyright' ); ?>
        <!-- START COPYRIGHT -->
        <div id="copyright">
            <div class="container">
                <div class="border">
                    <div class="row fluid">
                        <?php
                        /**
                         * @see yit_copyright
                         */
                        do_action( 'yit_copyright' ) ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END COPYRIGHT -->
        <?php do_action( 'yit_after_copyright' ) ?>
    </div>
<?php } ?>