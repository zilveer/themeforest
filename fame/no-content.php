<?php
/**
 * Used in 404 page, sitemap and no search results page
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

    global $a13_empty_error_msg, $wp_query, $post, $apollo13;
?>
<?php if( is_404() || isset($a13_empty_error_msg)) : ?>
    <p><span class="info-404"><a href="javascript:history.go(-1)"><?php _e( 'Go back', 'fame' ); ?></a> <?php _e( 'or use Site Map below:', 'fame' ); ?></span></p>

<?php else:
    //site map page content
    if ( have_posts() ){
        while ( have_posts() ){
            the_post();
            the_content();
        }
    }
endif;
    ?>
    <div class="clear"></div>

    <div class="left50">
        <?php
        if ( has_nav_menu( 'header-menu' ) ){
            echo '<h3>' . __('Main navigation', 'fame' ) . '</h3>';
            wp_nav_menu( array(
                    'container'       => false,
                    'link_before'     => '',
                    'link_after'      => '',
                    'menu_class'      => 'styled in-site-map',
                    'theme_location'  => 'header-menu' )
            );
        }
        ?>

        <h3><?php _e( 'Categories', 'fame' ); ?></h3>
        <ul class="styled">
            <?php wp_list_categories('title_li='); ?>
        </ul>

        <?php
        /* List galleries */
        $original_query = $wp_query;
        $original_post = $post;

        $args = array(
            'posts_per_page'      => -1,
            'offset'              => -1,
            'post_type'           => A13_CUSTOM_POST_TYPE_GALLERY,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
        );

        //make query for albums
        $wp_query = new WP_Query( $args );

        if ($wp_query->have_posts()) :
            echo '<h3>' . __( 'Galleries', 'fame' ) .'</h3>';
            echo '<ul class="styled">';

            while ( have_posts() ) :
                the_post();
                echo '<li><a href="'. get_permalink() . '">' . get_the_title() . '</a></li>';
            endwhile;

            echo '</ul>';
        endif;

        //restore previous query
        $wp_query = $original_query;
        $post = $original_post;
        wp_reset_postdata();
        ?>
    </div>

    <div class="right50">
        <h3><?php _e( 'Pages', 'fame' ); ?></h3>
        <ul class="styled">
            <?php wp_list_pages('title_li='); ?>
        </ul>
        <?php
            /* List works */
            $original_query = $wp_query;
            $original_post = $post;

            $args = array(
                'posts_per_page'      => -1,
                'offset'              => -1,
                'post_type'           => A13_CUSTOM_POST_TYPE_WORK,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true,
            );

            //make query for albums
            $wp_query = new WP_Query( $args );

            if ($wp_query->have_posts()) :
                echo '<h3>' . __( 'Works', 'fame' ) .'</h3>';
                echo '<ul class="styled">';

                while ( have_posts() ) :
                    the_post();
                    echo '<li><a href="'. get_permalink() . '">' . get_the_title() . '</a></li>';
                endwhile;

                echo '</ul>';
            endif;

            //restore previous query
            $wp_query = $original_query;
            $post = $original_post;
            wp_reset_postdata();
        ?>
    </div>

    <div class="clear"></div>





