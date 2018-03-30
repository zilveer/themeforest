<?php 
global $wp_query;
wp_reset_query();
while (have_posts()) : the_post(); ?>
    <?php if (get_post_meta(get_the_id(), '_display_page_name', '1') == '1') { ?>
        <h1><?php the_title(); ?></h1>
        <hr>
    <?php } ?>

    <?php  
    the_content();
    ?>
    
    <?php wp_link_pages(array('before' => '<div id="page-nav">', 'after' => '</div>', 'link_before' => '<span class="post_page">','link_after' => '</span>',)); ?>
<?php endwhile; // End the loop ?>
