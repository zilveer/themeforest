<?php
/**
 * The Template for displaying all single posts.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $apollo13;
get_header(); ?>

<?php the_post(); ?>

<?php a13_title_bar(); ?>

<article id="content" class="clearfix">

    <div id="col-mask">

        <div id="post-<?php the_ID(); ?>" <?php post_class('post-content'); ?>>
            <?php
            if(post_password_required()){
                the_content();
            }
            else{
                a13_top_image_video();
            ?>

            <div class="real-content">
                <?php the_content(); ?>

                <div class="clear"></div>

                <?php
                    wp_link_pages( array(
                        'before' => '<div id="page-links">'.__( 'Pages: ', 'fame' ),
                        'after'  => '</div>')
                    );
                ?>
                <?php
                if($apollo13->get_option( 'blog', 'post_under_content_tags' ) === 'on'){
                    echo '<p class="under_content_tags">';

                    $cat_list = get_the_category_list(', ');
                    if ( $cat_list ) {
                       echo '<span>'.__( 'Categories: ', 'fame' ).$cat_list.'</span>';
                    }

                    $tag_list = get_the_tag_list( '',', ' );
                    if ( $tag_list ) {
                        echo '<span>'.__( 'Tags: ', 'fame' ).$tag_list.'</span>';
                    }

                    echo '</p>';
                }
                ?>
            </div>


            <?php if($apollo13->get_option( 'blog', 'author_info' ) === 'on'): ?>
            <div class="about-author clearfix">
                <h3 class="title widget-title"><span><?php _e('About the author', 'fame' ); ?></span></h3>
                <?php $author_ID = get_the_author_meta( 'ID' );
                    echo '<a href="'.get_author_posts_url($author_ID).'" class="avatar">'.get_avatar( $author_ID, 50 ).'</a>';
                ?>
                <div class="author-inside">

                    <div class="author-description">
                        <?php
                            echo '<strong class="author-name">'.get_the_author();
                            $u_url = get_the_author_meta( 'user_url' );
                            if( ! empty( $u_url ) ){
                                echo '<a href="' . esc_url($u_url) . '" class="url">(' . $u_url . ')</a>';
                            }
                            echo '</strong> - ';
                            the_author_meta( 'description' );
                         ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php
            if($apollo13->get_option( 'blog', 'posts_navigation' ) === 'on'){
                //posts navigation
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                $is_next = is_object($next_post);
                $is_prev = is_object($prev_post);

                if($is_prev || $is_next){
                    echo '<div class="posts-nav clearfix">';

                    if($is_prev){
                        $id = $prev_post->ID;
                        $img = a13_make_post_image( $id, 'sidebar-size');
                        $full = (!$img)? ' full' : '';
                        echo '<a href="'.get_permalink($id).'" class="item prev'.$full.'">'
                            .$img.'<span>'.$prev_post->post_title.'</span>'
                            .mysql2date(get_option('date_format'), $prev_post->post_date).
                            '<i class="fa fa-arrow-left"></i></a>';
                    }
                    if($is_next){
                        $id = $next_post->ID;
                        $img = a13_make_post_image( $id, 'sidebar-size');
                        $full = (!$img)? ' full' : '';
                        echo '<a href="'.get_permalink($id).'" class="item next'.$full.'">'
                            .$img.'<span>'.$next_post->post_title.'</span>'.
                            mysql2date(get_option('date_format'), $next_post->post_date).
                            '<i class="fa fa-arrow-right"></i></a>';
                    }

                    echo '</div>';
                }
            }
            ?>

            <?php a13_similar_posts(); ?>

            <?php comments_template( '', true ); ?>

            <?php }//end of if password_protected ?>
        </div>



        <?php get_sidebar(); ?>

    </div>

</article>

<?php get_footer(); ?>
