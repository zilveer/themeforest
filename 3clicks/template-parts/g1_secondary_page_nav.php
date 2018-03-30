<?php
/**
 *
 * The navigation block is after the main content for SEO purposes.
 * This will be fixed via CSS rules.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
        <div id="secondary" class="g1-sidebar widget-area" role="complementary">
            <div class="g1-inner">
                <nav class="g1-side-nav">
                    <?php
                    global $post;

                    if ( $post->post_parent ) {
                        $ancestors = get_post_ancestors( $post->ID );
                        $parent = array_pop( $ancestors );
                    } else {
                        $parent = $post->ID;
                    }
                    ?>
                    <ul class="g1-menu">
                        <?php wp_list_pages( 'title_li=&link_before=<span>&link_after=</span>&include=' . $parent ); ?>
                        <?php wp_list_pages( 'title_li=&link_before=<span>&link_after=</span>&child_of='. $parent ); ?>
                    </ul>
                </nav>
            </div>
            <div class="g1-background">
                <div></div>
            </div>
        </div>
