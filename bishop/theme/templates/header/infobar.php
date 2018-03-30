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
<?php if ( apply_filters( 'yit-enable-infobar', yit_get_option('header-enable-infobar') ) == 'yes' ): ?>
    <div id="infobar" class="<?php echo class_exists( 'YIT_Style_Picker' ) ? apply_filters( 'yit-stylepicker-infobar-class', '' ) : ''; ?>">
        <div class="container">
            <?php yit_get_template( '/header/sidebar-infobar.php' ) ?>
        </div>
    </div>
<?php endif ?>