<?php
global $post;
$format = get_post_format($post->ID);
if (false === $format) {
    $format = 'standard';
}
?>
<!-- Post -->
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >

    <!-- Post Date and Comments -->
    <div class="left_meta clearfix entry-meta">
        <time class="entry-date published updated" datetime="<?php echo esc_attr( get_the_date('c') ); ?>"><?php echo get_the_date('M'); ?>
            <strong><?php echo get_the_date( 'd' ); ?></strong></time>
        <span class="comments_count clearfix entry-comments-link"><?php comments_popup_link(__('0', 'framework'), __('1', 'framework'), __('%', 'framework')); ?></span>
    </div>

    <!-- Post contents -->
    <div class="right-contents">
        <header class="entry-header">
            <?php
            /* Get post header based on format */
            get_template_part("post-formats/$format");

            /* No need to display title, post meta and post excerpt for link and quote */
            if (($format !== 'quote') && ($format !== 'link')) {
                ?>
                <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                <span class="entry-author" >
                    <?php _e('Posted by', 'framework') ?>
                    <span class="entry-author-link vcard">
                        <?php
                        printf( '<a class="url fn" href="%1$s" title="%2$s" rel="author">%3$s</a>',
                            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                            esc_attr( sprintf( __( 'View all posts by %s', 'framework' ), get_the_author() ) ),
                            get_the_author()
                        );
                        ?>
                    </span>
                </span>
            <?php
            }
            ?>
        </header>
        <?php
        if (($format !== 'quote') && ($format !== 'link')) {
            ?>
            <div class="entry-content">
                <?php the_content(''); ?>
            </div>
        <?php
        }

        /* No need to display Read More button with link and Quote */
        if ( ($format !== 'quote') && ($format !== 'link') ) {
            ?><a class="read-more" href="<?php the_permalink(); ?>" rel="bookmark"><?php _e('Read More', 'framework'); ?></a><?php
        }
        ?>
    </div>
</article>