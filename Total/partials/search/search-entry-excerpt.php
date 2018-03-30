<?php
/**
 * Search entry excerpt
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="search-entry-excerpt clr">
    <?php wpex_excerpt( array(
        'length'          => '30',
        'readmore'        => false,
        'ignore_more_tag' => true,
    ) ); ?>
</div><!-- .search-entry-excerpt -->