<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Trizzy
 */

get_header();

?>

<!-- Titlebar
================================================== -->
<?php if(ot_get_option('pp_blog_parallax') == 'on') { ?>
<section class="parallax-titlebar fullwidth-element"  data-background="<?php echo ot_get_option('pp_blog_parallax_color','#000'); ?>" data-opacity="<?php echo ot_get_option('pp_blog_parallax_opacity','0.45'); ?>" data-height="160">
    <img src="<?php echo ot_get_option('pp_blog_parallax_bg'); ?>" alt="" />
    <div class="parallax-overlay"></div>
    <div class="parallax-content">
       <h2><?php
                if ( is_category() ) {
                    printf( __( 'Category Archives: %s', 'trizzy' ), '<span>' . single_cat_title( '', false ) . '</span>' );

                } elseif ( is_tag() ) {
                    printf( __( 'Tag Archives: %s', 'trizzy' ), '<span>' . single_tag_title( '', false ) . '</span>' );

                } elseif ( is_author() ) {
                    /* Queue the first post, that way we know
                     * what author we're dealing with (if that is the case).
                    */
                    the_post();
                    printf( __( 'Author Archives: %s', 'trizzy' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
                    /* Since we called the_post() above, we need to
                     * rewind the loop back to the beginning that way
                     * we can run the loop properly, in full.
                     */
                    rewind_posts();

                } elseif ( is_day() ) {
                    printf( __( 'Daily Archives: %s', 'trizzy' ), '<span>' . get_the_date() . '</span>' );

                } elseif ( is_month() ) {
                    printf( __( 'Monthly Archives: %s', 'trizzy' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

                } elseif ( is_year() ) {
                    printf( __( 'Yearly Archives: %s', 'trizzy' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

                } else {
                    $pp_blog_page = ot_get_option('pp_blog_page');
                    if (function_exists('icl_register_string')) {
                        icl_register_string('Blog page title','pp_blog_page', $pp_blog_page);
                        echo icl_t('Blog page title','pp_blog_page', $pp_blog_page); }
                        else {
                            echo $pp_blog_page;
                        }
                    }
                    ?>
        </h2>

        <nav id="breadcrumbs">
            <?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
        </nav>
    </div>
</section>
<?php } else { ?>
<section class="titlebar">
    <div class="container">
    	<div class="sixteen columns">
    		<h2><?php
                    if ( is_category() ) {
                        printf( __( 'Category Archives: %s', 'trizzy' ), '<span>' . single_cat_title( '', false ) . '</span>' );

                    } elseif ( is_tag() ) {
                        printf( __( 'Tag Archives: %s', 'trizzy' ), '<span>' . single_tag_title( '', false ) . '</span>' );

                    } elseif ( is_author() ) {
                        /* Queue the first post, that way we know
                         * what author we're dealing with (if that is the case).
                        */
                        the_post();
                        printf( __( 'Author Archives: %s', 'trizzy' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
                        /* Since we called the_post() above, we need to
                         * rewind the loop back to the beginning that way
                         * we can run the loop properly, in full.
                         */
                        rewind_posts();

                    } elseif ( is_day() ) {
                        printf( __( 'Daily Archives: %s', 'trizzy' ), '<span>' . get_the_date() . '</span>' );

                    } elseif ( is_month() ) {
                        printf( __( 'Monthly Archives: %s', 'trizzy' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

                    } elseif ( is_year() ) {
                        printf( __( 'Yearly Archives: %s', 'trizzy' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

                    } else {
                        $pp_blog_page = ot_get_option('pp_blog_page');
                        if (function_exists('icl_register_string')) {
                            icl_register_string('Blog page title','pp_blog_page', $pp_blog_page);
                            echo icl_t('Blog page title','pp_blog_page', $pp_blog_page); }
                            else {
                                echo $pp_blog_page;
                            }
                        }
                        ?>
            </h2>

    		<nav id="breadcrumbs">
    			<?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
    		</nav>
    	</div>
    </div>
</section>
<?php
}

$layout = ot_get_option('pp_blog_layout');
if($layout == 'masonry') {
    get_template_part( 'masonry','loop' ) ;
} else {
    get_template_part( 'standard','loop' ) ;
}
?>
 </div>
<?php get_footer(); ?>
