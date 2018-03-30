<?php
/* common excerpt template for search results */
global $post;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(' clearfix'); ?>>

    <!-- main contents -->
    <div class="main-contents">
        <header class="entry-header">
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        </header>
        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div>
        <a class="read-more" href="<?php the_permalink(); ?>" rel="bookmark"><?php _e('Read More', 'framework'); ?></a>
    </div>

</article>