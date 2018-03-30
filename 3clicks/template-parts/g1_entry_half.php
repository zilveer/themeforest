<?php
/**
 * The Template for displaying work archive|index.
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
    global $post;
    $g1_elems = G1_Elements()->get();
    $g1_title = $g1_elems[ 'title' ] ? the_title( '', '', false ) : '';
    $g1_subtitle = wp_kses_data( get_post_meta( $post->ID, '_g1_subtitle', true ) );
?>
<article itemscope itemtype="<?php g1_render_entry_itemtype(); ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <div class="g1-hgroup">
            <?php if ( $g1_title ): ?>
                <h1 class="entry-title"><?php echo $g1_title; ?></h1>
            <?php endif; ?>
            <?php if ( $g1_subtitle ): ?>
                <h3 class="entry-subtitle"><?php echo $g1_subtitle; ?></h3>
            <?php endif; ?>
        </div>

        <?php if ( $g1_elems['date'] || $g1_elems['author'] || $g1_elems['comments-link'] ): ?>
        <p class="g1-meta entry-meta">
            <?php
                if ( $g1_elems['date'] )            { g1_render_entry_date(); }
                if ( $g1_elems['author'] )          { g1_render_entry_author(); }
                if ( $g1_elems['comments-link'] )   { g1_render_entry_comments_link(); }
            ?>
        </p>
        <?php endif; ?>
    </header><!-- .entry-header -->


    <div class="g1-essentials">
        <div class="g1-essential-media">
            <?php if ( $g1_elems[ 'media-box' ] ) { g1_render_entry_media_box( array(
                'size' => 'g1_one_half',
                'type' => $g1_elems[ 'media-box' ]
            ) ); } ?>
        </div>
        <div class="g1-essential-nonmedia">
            <div class="entry-content">
                <?php the_content(); ?>
                <?php g1_wp_link_pages(); ?>
            </div><!-- .entry-content -->

            <?php if ( $g1_elems['categories'] || $g1_elems['tags'] ): ?>
            <div class="g1-meta entry-terms">
                <?php
                if ( $g1_elems['categories'] )          { g1_render_entry_categories(); }
                if ( $g1_elems['tags'] )                { g1_render_entry_tags(); }
                ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php get_template_part( 'template-parts/g1_single_nav' ); ?>
    <?php get_template_part( 'template-parts/g1_about_author' ); ?>

    <?php do_action( 'g1_extra_entry_blocks' ); ?>

    <div class="entry-utility">
        <?php edit_post_link( __( 'Edit', 'g1_theme' ), '<span class="edit-link">', '</span>' ); ?>
    </div><!-- .entry-utility -->

    <?php comments_template( '', true ); ?>

</article>
