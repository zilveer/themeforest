<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */


/* Queue the first post, that way we know
 * what date we're dealing with (if that is the case).
 *
 * We reset this later so we can run the loop
 * properly with a call to rewind_posts().
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( have_posts() ){

    the_post();

    get_header();

    global $apollo13;

    $title = '';

    if ( is_author() )
        $title = sprintf( __( 'Author Archives: %s', 'fame' ), "<span class='vcard'>" . get_the_author() . "</span>" );
    elseif ( is_category() )
        $title = sprintf( __( 'Category Archives: %s', 'fame' ), '<span>' . single_cat_title( '', false ) . '</span>' );
    elseif ( is_tag() )
        $title = sprintf( __( 'Tag Archives: %s', 'fame' ), '<span>' . single_tag_title( '', false ) . '</span>' );
    elseif ( is_day() )
        $title = sprintf( __( 'Daily Archives: %s', 'fame' ), '<span>' . get_the_date() . '</span>' );
    elseif ( is_month() )
        $title = sprintf( __( 'Monthly Archives: %s', 'fame' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
    elseif ( is_year() )
        $title = sprintf( __( 'Yearly Archives: %s', 'fame' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
    else
        $title = __( 'Blog Archives', 'fame' );

    /* Since we called the_post() above, we need to
     * rewind the loop back to the beginning that way
     * we can run the loop properly, in full.
     */
    rewind_posts();
?>

<?php a13_title_bar($title); ?>

<article id="content" class="clearfix <?php echo $apollo13->get_option('blog', 'blog_variant'); ?>">

    <div id="col-mask">

        <div id="post-list">

            <?php
            /* Run the loop to output the post.
             * If you want to overload this in a child theme then include a file
             * called loop-single.php and that will be used instead.
             */
            get_template_part( 'loop' );
            ?>
            <?php a13_blog_nav(); ?>

        </div>

        <?php get_sidebar(); ?>

    </div>

</article>

<?php
    get_footer();

}/* end if have_posts()*/
else{
    global $a13_empty_error_msg;
    $a13_empty_error_msg = __( 'Apologies, but no results were found for the requested archive.', 'fame'  );
    get_template_part( '404' );
}
