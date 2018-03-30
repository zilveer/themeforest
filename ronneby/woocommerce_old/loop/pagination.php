<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.10
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;

if ($wp_query->max_num_pages > 1) : ?>

    <nav class="page-nav">

        <?php echo dfd_kadabra_pagination(); ?>

    </nav>

<?php endif; ?>