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

            <!-- stampa il sottomenu di wpml -->
            <?php do_action('icl_language_selector'); ?>

<?php
$wpml_options = get_option('_wcml_settings');
if( $wpml_options && isset($wpml_options['enable_multi_currency']) && $wpml_options['enable_multi_currency'] == 2): ?>
<div id="wcml_currency_switcher">
    <ul>
        <li>
            <?php echo do_shortcode('[currency_switcher]') ?>
        </li>
    </ul>
</div>
<?php endif ?>