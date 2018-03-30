<?php 
	global $post;
    $format = get_post_format();
    if( false === $format ) {
        $format = 'standard';
    }
?>

<article <?php post_class(); ?>>
    <header>
        <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="post-meta <?php echo $format; ?>-meta thumb-<?php echo has_post_thumbnail()?'exist':'not-exist'; ?>">
            <span><?php _e('Posted on', 'framework'); ?> <span class="date"> <?php the_time('F d, Y'); ?></span></span>
            <span><?php _e('by', 'framework'); ?> <span class="author-link"><?php the_author() ?></span> <?php _e('in', 'framework'); ?> <?php the_category(', '); ?> </span>
        </div>
    </header>
    <?php get_template_part( "post-formats/$format" ); ?>
    <p><?php framework_excerpt(40);  ?></p>
    <a class="real-btn" href="<?php the_permalink(); ?>"><?php _e('Read more', 'framework'); ?></a>
</article>
