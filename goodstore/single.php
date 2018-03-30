<?php get_header(); ?>

<!-- Row for main content area -->
<div id="content" class="<?php echo implode(' ', jwLayout::content_width()); ?> <?php echo jwLayout::content_layout(); ?>" role="main">
    <div class="post-box  builder-section" >

        <?php
        if (get_post_type() == 'jaw-portfolio'){
            echo jaw_get_template_part('single-portfolio', 'custom-posts');
        }elseif(get_post_type() == 'jaw-team'){
            echo jaw_get_template_part('single-team', 'custom-posts');
        }else{
            echo jaw_get_template_part('single-post', 'blog');
        }
        ?>	

    </div><!-- End Content row -->
    
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>