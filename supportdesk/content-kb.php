<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>">
    <?php the_title(); ?>
    </a></h2>
    
<?php get_template_part( 'content-kb', 'meta' ); ?>

</article>