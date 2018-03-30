<?php
//Template Name: Tags
get_header();
global $bd_data;

/* Sidebar */
if(get_post_meta($post->ID, 'bd_full_width', true)){
    $post_full      = ' post_full_width';
}
elseif(get_post_meta($post->ID, 'bd_sidebar_position', true) == 'left'){
    $post_po        = ' post_sidebar_left';
}
elseif(get_post_meta($post->ID, 'bd_sidebar_position', true) == 'right'){
    $post_po        = ' post_sidebar_right';
}

$bd_criteria_display = get_post_meta(get_the_ID(), 'bd_criteria_display', true); ?>

    <div class="bd-container <?php echo $post_po; echo $post_full; ?>">
        <div class="bd-main">
            <div class="page-title"><h2> <?php the_title();?> </h2></div>

            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <article <?php post_class('article'); ?> id="post-<?php the_ID(); ?>">
                    <div class="tagcloud bottom40">
                        <?php
                        the_content();
                        $args = array(
                            'smallest'                  => 8,
                            'largest'                   => 22,
                            'unit'                      => 'pt',
                            'number'                    => 0);
                        wp_tag_cloud( $args );
                        wp_link_pages();
                        ?>

                    </div>
                </article>
            <?php endwhile; ?>

        </div><!-- .bd-main-->

        <?php get_sidebar(); ?>
    </div><!-- .bd-container -->

<?php
get_footer();