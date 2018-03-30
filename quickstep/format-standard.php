<?php 
if (of_get_option('qs_separate_posts')) {
    $separate_posts = 'separate';
} else {
    $separate_posts = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">


    <?php
    // check if the post has a Post Thumbnail assigned to it.
    if (has_post_thumbnail()) {

        $thumb_id = get_post_thumbnail_id($post->ID);
        $image = wp_get_attachment_image_src($thumb_id, 'full');
        $prettyphoto_enabled = of_get_option('qs_blog_prettyphoto');
        if ($prettyphoto_enabled == '1') :
            echo '<a rel="prettyPhoto" href="' . $image[0] . '" >';
        endif;

        the_post_thumbnail('blog');
        if ($prettyphoto_enabled == '1') :
            echo '</a>';
        endif;
    }
    ?>

    <div class="clear"></div>
    <?php get_template_part('post-meta'); ?>

    <section class="post-content post-desc-col last">                                        
        <header>


            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" class="<?php echo $separate_posts; ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>



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