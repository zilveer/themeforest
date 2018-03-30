<?php 
if (of_get_option('qs_separate_posts')) {
    $separate_posts = 'separate';
} else {
    $separate_posts = '';
}
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">


    <?php
        if(qs_get_meta( 'qs_gallery_code', $post->ID ) ) {

		echo apply_filters('the_content', qs_get_meta( 'qs_gallery_code', $post->ID ) );

	}
    ?>

    <div class="clear"></div>
    <?php get_template_part('post-meta'); ?>

    <section class="post-content post-desc-col last">                                        
        <header>


            <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" class="<?php echo $separate_posts; ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>



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