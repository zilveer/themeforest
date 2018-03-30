<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

define( 'A13_GALLERIES_LIST_PAGE', true );
get_header();

/**
 * The loop that displays items.
 *
 */

global $wp_query, $paged, $apollo13;


//settings
$genre_template     = defined('A13_GENRE_TEMPLATE');
$variant            = $apollo13->get_option('cpt_gallery', 'galleries_size');
$filter             = $apollo13->get_option('cpt_gallery', 'categories_filter') === 'on';
$title_value        = $apollo13->get_option('cpt_gallery', 'galleries_list_title');
$show_titles        = $apollo13->get_option('cpt_gallery', 'show_titles') === 'on';
$show_subtitles     = $apollo13->get_option('cpt_gallery', 'show_subtitles') === 'on';
$full_width         = $apollo13->get_option('cpt_gallery', 'full_width') === 'on';
$original_query = $wp_query;
$offset = -1;
$paged = 0;
$per_page = -1;

$args = array(
    'posts_per_page'      => $per_page,
    'offset'              => $offset,
    'post_type'           => A13_CUSTOM_POST_TYPE_GALLERY,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
);

if($genre_template === true){
    $term_slug = get_query_var('term');
    if( ! empty( $term_slug ) ){
        $args[A13_CPT_GALLERY_TAXONOMY] = $term_slug;
        $term_obj = get_term_by( 'slug', $term_slug, A13_CPT_GALLERY_TAXONOMY);
        $title_value = sprintf( __( '%1$s : %2$s', 'fame' ), $title_value, $term_obj->name );
    }
}

a13_title_bar($title_value);

?>

<article id="content" class="clearfix<?php echo $full_width ? ' full-width' : ''; ?>">

    <div id="col-mask">

    <?php
    //make query for galleries
    $wp_query = new WP_Query( $args );

    /* If there are no posts to display, such as an empty archive page */
    if ( ! have_posts() ) :
    ?>

        <div class="real-content empty-blog">
            <?php
            echo '<p>'.__( 'Apologies, but no results were found for the requested archive.', 'fame' ).'</p>';
            get_template_part( 'no-content');
            ?>
        </div>
    <?php
    /* If there ARE some posts */
    elseif ($wp_query->have_posts()) :
        //classes and other attributes
        $classes = 'bricks_'.$variant;
        $classes .= ' '.$apollo13->get_option('cpt_gallery', 'gl_hover_type' );
        $image_size_string = 'cpt-cover-'.$variant;
        if($variant === 'fluid'){
            $image_size_string = 'gallery-cover-fluid';
        }

        if($variant !== 'fluid'){
            $classes .= ' non-fluid';
        }

        echo '<div class="cpt-list-container galleries-list '.$classes.'">';

        //filter
        if($filter){
            get_template_part( 'parts/genre-filter' );
        }

        echo '<div id="a13-galleries" class="bricks-list">';

        while ( have_posts() ) :
            the_post();

            $post_id        = get_the_ID();
            $href           = get_permalink();

            //get album genres
            $terms = wp_get_post_terms(get_the_ID(), A13_CPT_GALLERY_TAXONOMY, array("fields" => "all"));
            $pre = 'data-genre-';
            $suf = '="1" ';
            $genre_string = '';

            //get all genres that item belongs to
            if( count( $terms ) ):
                foreach($terms as $term) {
                    $genre_string .= $pre.$term->term_id.$suf;
                }
            endif;

            echo '<div class="g-item" ' . $genre_string . '>';
            echo '<a class="g-link link" href="'.esc_url($href).'" id="work-' . $post_id . '">';
            echo a13_make_work_image($post_id, $image_size_string );
            echo '<em class="cov"><span>'.($show_subtitles? a13_subtitle('small') : '').($show_titles? '<strong>'.get_the_title().'</strong>' : '').'</span></em>';
            echo '</a>';
            //like plugin
            if( function_exists('dot_irecommendthis') ){
                dot_irecommendthis();
            };
            echo '</div>';
        endwhile;

        echo '  </div>';//.bricks-list
        echo '</div>';//.cpt-list-container
    endif;


    //restore previous query
    $wp_query = $original_query;
    wp_reset_postdata();
    ?>
    </div>
</article>


<?php get_footer(); ?>