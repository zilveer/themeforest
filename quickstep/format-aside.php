<?php 
if (of_get_option('qs_separate_posts')) {
    $separate_posts = 'separate';
} else {
    $separate_posts = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
    
    <?php get_template_part('post-meta'); ?>

    <section class="post-content post-desc-col last">                                        
        <!-- force more tag on permalink pages -->
        <?php global $more;
        $more = false; ?> 

            <?php the_content(__('Read More', 'qs_framework')); ?>
        
        <?php $more = true; ?>	
    </section> <!-- end article section -->

    <footer>

    </footer> <!-- end article footer -->

</article> <!-- end article -->