<?php
/**
 * The default template for displaying content
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
<?php
    $g1_data = g1_part_get_data();
    $g1_collection = $g1_data['collection'];
    $g1_elems = $g1_data['elems'];
    $g1_options = !empty($g1_data['options']) ? $g1_data['options'] : array();

    // Prepare config helpers
    $g1_elems['byline'] = $g1_elems['date'] || $g1_elems['author'] || $g1_elems['comments-link'];
    $g1_elems['terms'] = $g1_elems['categories'] || $g1_elems['tags'];
?>
<article itemscope itemtype="<?php g1_render_entry_itemtype(); ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
        if ( $g1_elems['featured-media'] ) {
            g1_render_entry_featured_media( array(
                'size'              => $g1_collection->get_image_size(),
                'lightbox_group'    => $g1_collection->get_lightbox_group(),
                'force_placeholder' => $g1_collection->get_force_placeholder(),
            ));
        }
    ?>

    <div class="g1-nonmedia">
        <div class="g1-inner">
            <header class="entry-header">
                <?php if ( $g1_elems['title'] )                { g1_render_entry_title(); } ?>
                <?php if ( $g1_elems['byline'] ): ?>
                <p class="entry-meta g1-meta">
                    <?php if ( $g1_elems['date'] )             { g1_render_entry_date(); } ?>
                    <?php if ( $g1_elems['author'] )           { g1_render_entry_author(); } ?>
                    <?php if ( $g1_elems['comments-link'] )    { g1_render_entry_comments_link(); } ?>
                </p>
                <?php endif; ?>
            </header><!-- .entry-header -->

            <?php if ( $g1_elems['summary'] )                  {
                if ( !empty($g1_options['summary-type']) ) {
                    g1_render_entry_summary(null, $g1_options['summary-type']);
                } else {
                    g1_render_entry_summary(null);
                }
            }  ?>

            <footer class="entry-footer">
                <?php if ( $g1_elems['terms'] ): ?>
                <div class="g1-meta entry-terms">
                    <?php if ( $g1_elems['categories'] )       { g1_render_entry_categories(); } ?>
                    <?php if ( $g1_elems['tags'] )             { g1_render_entry_tags(); } ?>
                </div>
                <?php endif; ?>

                <?php if ( $g1_elems['button-1'] ):?>
                    <div>
                        <?php g1_render_entry_button_1(); ?>
                    </div>
                <?php endif; ?>
            </footer><!-- .entry-footer -->
        </div>
        <div class="g1-01"></div>
    </div>

</article><!-- .post-XX -->