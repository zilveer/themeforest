<?php
//Template Name: Sitemap
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
                    <div class="bottom40">

                        <?php
                        the_content();
                        ?>
                        <ul class="sitemap_content">
                            <li class="bottom24">
                                <div class="box-title bottom20"><h2><b><?php _e('Pages','bd'); ?></b></h2></div>
                                <ul class="bd_line_list">
                                    <?php wp_list_pages('title_li='); ?>
                                </ul>
                            </li>

                            <li class="bottom24">
                                <div class="box-title bottom20"><h2><b><?php _e('Categories','bd'); ?></b></h2></div>
                                <ul class="bd_line_list">
                                    <?php wp_list_categories('title_li='); ?>
                                </ul>
                            </li>

                            <li class="bottom24">
                                <div class="box-title bottom20"><h2><b><?php _e('Tags','bd'); ?></b></h2></div>

                                <div class="tagcloud">
                                    <?php $tags = get_tags();
                                    if ($tags)
                                    {
                                        foreach ($tags as $tag)
                                        {
                                            echo '<a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a> ';
                                        }
                                    }
                                    ?>
                                </div>
                            </li>

                            <li>
                                <div class="box-title bottom20"><h2><b><?php _e('Authors','bd'); ?></b></h2></div>
                                <ul class="bd_line_list" >
                                    <?php wp_list_authors('optioncount=1&exclude_admin=0'); ?>
                                </ul>
                            </li>

                        </ul>
                        <?php
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