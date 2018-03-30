<?php
/**
 * Outputs the portfolio entry title
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<h2 class="portfolio-entry-title entry-title">
    <a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>"><?php the_title(); ?></a>
</h2><!-- .portfolio-entry-title -->