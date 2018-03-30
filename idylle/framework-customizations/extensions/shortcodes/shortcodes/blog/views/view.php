<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}
?>


<!-- Blog -->
<div class="idy_blog">

        <?php
            global $post;
            $idylle_posts_per_page = $atts['post_count'];
            $idylle_posts_category = $atts['posts']['0'];
            $posts = get_posts(
                array(
                    'numberposts'     => $idylle_posts_per_page,
                    'category' => $idylle_posts_category 
                )
            );

            $i = 1;
            foreach($posts as $post):
                setup_postdata( $post ); 
                $thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'idylle-mini-thumb' );
        ?> 

            <!-- Item -->
            <a href="<?php esc_url(the_permalink()); ?>" class="idy_blog_item">
                <img src="<?php echo esc_url($thumbnail_attributes[0]); ?>" alt="<?php the_title(); ?>">
                <h4><?php the_title(); ?></h4>
                <?php the_excerpt(); ?>
            </a>


            
        <?php 
            endforeach; 
            wp_reset_postdata(); 
        ?>

</div>
<!-- Blog End -->
