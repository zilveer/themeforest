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

if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
    return;
}

?>
<!-- [favicon] begin -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo yit_get_favicon() ?>" />
<link rel="icon" type="image/x-icon" href="<?php echo yit_get_favicon() ?>" />
<!-- [favicon] end -->

<!-- Touch icons more info: http://mathiasbynens.be/notes/touch-icons -->
<?php yit_print_mobile_favicons() ;?>

