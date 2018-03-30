<?php
/**
 * Blog entry layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Should we check for the more tag?
$check_more_tag = apply_filters( 'wpex_check_more_tag', true ); ?>

<div class="blog-entry-excerpt wpex-clr">

    <?php
    // Display excerpt if auto excerpts are enabled in the admin
    if ( wpex_get_mod( 'blog_exceprt', true ) ) :

        // Check if the post tag is using the "more" tag
        if ( $check_more_tag && strpos( get_the_content(), 'more-link' ) ) :

            // Display the content up to the more tag
            the_content( '', '&hellip;' );

        // Otherwise display custom excerpt
        else :

            // Display custom excerpt
            wpex_excerpt( array(
                'length' => wpex_excerpt_length(),
            ) );

        endif;

    // If excerpts are disabled, display full content
    else :

        the_content( '', '&hellip;' );

    endif; ?>

</div><!-- .blog-entry-excerpt -->