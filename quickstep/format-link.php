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
        <header>


            <h2 class="entry-title"><a href="<?php echo qs_get_meta( 'qs_link_url', $post->ID ); ?>" <?php if(qs_get_meta( 'qs_link_tab', $post->ID )) { echo 'target="_blank"';} ?> rel="bookmark" class="<?php echo $separate_posts; ?> <?php if(!qs_get_meta( 'qs_link_ajax', $post->ID )) { echo 'separate';} ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>



        </header> <!-- end article header -->

        <!-- force more tag on permalink pages -->
        <?php global $more;
        $more = false; ?> 
        <?php the_content(__('Read More', 'qs_framework')); ?>
        <?php $more = true; ?>	
    </section> <!-- end article section -->

    <footer>

    </footer> <!-- end article footer -->

</article> <!-- end article -->