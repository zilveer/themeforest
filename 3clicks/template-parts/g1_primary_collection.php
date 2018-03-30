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
// Our tricky way to get variables that were passed to this template part
$g1_data = g1_part_get_data();
$g1_collection = $g1_data['collection'];
$g1_elems = G1_Elements()->get();
$g1_options = array(
    'summary-type' => !empty($g1_data['summary-type']) ? $g1_data['summary-type'] : 'excerpt'
);


// Build config array based on the name of a collection
$g1_collection = G1_Collection_Manager()->get_collection( $g1_collection );

$title = '';
$subtitle = '';

if ( is_home() ) {
    $title = __( 'Blog', 'g1_theme' );

    $page_id = (int) get_option( 'page_for_posts' );
    if( $page_id ) {
        // WPML fallback
        if ( G1_WPML_LOADED )
            $page_id = icl_object_id( $page_id, 'page', true );

        if (  $page_id ) {
            $title = get_the_title( $page_id );
            $subtitle = wp_kses_data( get_post_meta( $page_id, '_g1_subtitle', true ) );
        }
    }
} elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
    $page_id = g1_get_theme_option( 'post_type_'. get_query_var( 'post_type' ), 'page_for_posts' );

    if ( $page_id ) {
        // WPML fallback
        if ( G1_WPML_LOADED )
            $page_id = icl_object_id( $page_id, 'page', true );

        if ( $page_id ) {
            $subtitle = wp_kses_data( get_post_meta( $page_id, '_g1_subtitle', true ) );
        }
    }
} elseif ( is_category() ) {
    $title = '<span>' . single_term_title( '', false ) . '</span>';
    $subtitle = strip_tags( term_description() );
} elseif( is_tag() ) {
    $title = sprintf( __( 'Tag Archives: %s', 'g1_theme' ), '<span>' . single_term_title( '', false ) . '</span>' );
    $subtitle = strip_tags( term_description() );
} elseif( is_tax() ) {
    $title = single_term_title( '', false );
    $subtitle = strip_tags( term_description() );
} elseif ( is_year() ) {
    $title = get_the_date( 'Y' );
    $subtitle = __( 'Yearly Archives', 'g1_theme' );
} elseif ( is_month() ) {
    $title = get_the_date( 'F Y' );
    $subtitle = __( 'Monthly Archives', 'g1_theme' );
} elseif ( is_day() ) {
    $title = get_the_date();
    $subtitle = __( 'Daily Archives', 'g1_theme' );
} elseif ( is_author() ) {
    if	(	get_query_var('author_name' ) ) {
        $curauth = get_user_by( 'login', get_query_var('author_name') );
    } else {
        $curauth = get_userdata( get_query_var('author') );
    }
    if ( $curauth  ) {
        $title = $curauth->display_name;
    }
    $subtitle = __( 'Author Archives', 'g1_theme' );
}
?>
<div id="primary">
    <div id="content" role="main">
        <?php if ( have_posts() ) : ?>
            <?php if ( ( $g1_elems['title'] && strlen( $title ) ) || strlen( $subtitle ) ): ?>
            <header class="archive-header">
                <div class="g1-hgroup">
                    <?php if ( $g1_elems['title'] && strlen( $title ) ): ?>
                        <h1 class="archive-title"><?php echo $title; ?></h1>
                    <?php endif; ?>
                    <?php if ( strlen( $subtitle ) ): ?>
                        <h3 class="archive-subtitle"><?php echo $subtitle; ?></h3>
                    <?php endif; ?>
                </div>
            </header><!-- .archive-header -->
            <?php endif; ?>

            <?php
                global $wp_query;

                // Our tricky way to pass variables to a template part
                g1_part_set_data( array(
                    'query' => $wp_query,
                    'collection' => $g1_collection,
                    'options' => $g1_options,
                    'elems' => $g1_elems['collection'],
                ));

                get_template_part( $g1_collection->get_file() );

                G1_Pagination()->render();
            ?>
        <?php else: ?>
            <?php get_template_part( 'template-parts/g1_no_results', 'works' ); ?>
        <?php endif;?>

    </div><!-- #content -->
</div><!-- #primary -->