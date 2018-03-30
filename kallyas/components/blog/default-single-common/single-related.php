<?php if(! defined('ABSPATH')){ return; }
/**
* Single Related
*/

if( zget_option( 'zn_show_related_posts', 'blog_options', false, 'yes' ) == 'yes' ) :

    /*
     * DISPLAY 3 RELATED POSTS
     */

    // Start the query
    $args = array(
        'posts_per_page' => 3,
        'category__in' => wp_get_post_categories( get_the_ID(), array('fields' => 'ids')),
        'orderby' => 'rand',
        'order'=> 'ID',
        'post__not_in' => array( get_the_ID() ),
    );
    $theQuery = new WP_Query( $args );
    $usePostFirstImage = (zget_option( 'zn_use_first_image', 'blog_options' , false, 'yes' ) == 'yes');

    if($theQuery->have_posts()) {
    ?>
    <div class="related-articles kl-blog-related">

        <?php

        // Load title
        include(locate_template( 'components/blog/default-single-common/single-related-title.php' ));

        ?>

        <div class="row kl-blog-related-row">
            <?php
                while($theQuery->have_posts())
                {
                    $theQuery->the_post();

                    // Load title
			        include(locate_template( 'components/blog/default-single-common/single-related-item.php' ));

                }
                wp_reset_postdata();
            ?>
        </div>

    </div>
    <?php }
endif;
