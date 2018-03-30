<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<!-- START HEADER ROW -->
<?php
if ( apply_filters( 'yit-enable-header-row', yit_get_option( 'header-enable-header-row' ) ) == 'yes' ): ?>
<div id="header-row" class="<?php echo class_exists( 'YIT_Style_Picker' ) ? apply_filters( 'yit-stylepicker-header-row-class', '' ) : ''; ?>">
    <div class="container">
        <div class="header-wrapper clearfix">
            <?php
               if ( yit_get_header_skin() == 'skin3' ) :
                    yit_get_template( '/header/navigation.php' );
                else : ?>
                    <div class="header-row-left">
                        <?php dynamic_sidebar( 'header-row-left' ) ?>
                    </div>
                    <div class="header-row-right">
                        <?php dynamic_sidebar( 'header-row-right' ) ?>
                    </div>
                    <div class="header-row-middle">
                        <?php dynamic_sidebar( 'header-row-middle' ) ?>
                    </div>
                <?php
                endif;
             ?>
        </div>
    </div>
</div>
<!-- END HEADER ROW -->
<?php endif; ?>