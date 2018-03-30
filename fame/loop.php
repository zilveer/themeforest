<?php
/**
 * The loop that displays posts.
 *
 * It is used only on page with posts list: blog, archive, search
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $apollo13;
?>


<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php
if ( ! have_posts() ):
    global $a13_empty_error_msg;
    $a13_empty_error_msg = true; //set to anything
    ?>
    <div class="real-content empty-blog">
    <?php
    echo '<p>'.__( 'Apologies, but no results were found for the requested archive.', 'fame' ).'</p>';
    get_template_part( 'no-content');
    ?>
    </div>
    <?php

else:
    echo '<div id="only-posts-here">'; /* needed in case of masonry variant*/
    $special_post_formats = array('link', 'status', 'chat', 'quote');

    while ( have_posts() ) : the_post();
        //we style different when some post formats are used
        $post_format = get_post_format();
        $pf_class = (in_array($post_format, $special_post_formats)? ' special-post-format' : '');
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('archive-item'.$pf_class); ?>>

            <?php
            if(post_password_required()){
                echo '<h2 class="post-title"><a href="'. esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>';
                echo '<div class="real-content">';
                the_content();
                echo '</div>';
                a13_post_meta();
            }
            else{
                get_template_part( 'content', get_post_format() );
            }
            ?>

		</div>

    <?php endwhile;

    echo '</div>'; /* needed in case of masonry variant*/

endif;