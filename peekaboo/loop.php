<?php
/*
 * The loop that displays posts.
 */
global $smof_data;
?>

<?php if (!have_posts()) : /* If there are no posts to display */ ?>
    <h1><?php _e('Not Found', 'peekaboo'); ?></h1>
    <p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'peekaboo'); ?></p>
    <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); /* Start the Loop */ ?>

    <?php /* How to display posts in the Home Page. */ ?>
    <?php if (is_front_page()) : ?>
        <div class="post">
            <div class="post_image"><a
                    href="<?php the_permalink() ?>"><?php the_post_thumbnail('post-image', array('class' => 'shadow')); ?> </a>
            </div>
            <h2 class="post_title replace"><a href="<?php the_permalink(); ?>"
                                              title="<?php printf(esc_attr__('Permalink to %s', 'peekaboo'), the_title_attribute('echo=0')); ?>"
                                              rel="bookmark"><?php the_title(); ?></a></h2>

            <div class="clearfix"><?php the_content(); ?></div>
        </div>

        <?php /* How to display posts in the Blog Post Page. */ ?>
    <?php elseif (is_home()) : ?>
        <div class="post">
            <?php if ($smof_data['pkb_post_img'] == '1') {
                if ((has_post_thumbnail() && function_exists('has_post_thumbnail'))) {
                    ?>
                    <div class="post_image"><a
                            href="<?php the_permalink() ?>"><?php the_post_thumbnail('post-image', array('class' => 'shadow')); ?> </a>
                    </div>
                <?php }
            } ?>

            <h2 class="post_title replace"><a href="<?php the_permalink(); ?>"
                                              title="<?php printf(esc_attr__('Permalink to %s', 'peekaboo'), the_title_attribute('echo=0')); ?>"
                                              rel="bookmark"><?php the_title(); ?></a></h2>

            <div class="clearfix"><?php the_excerpt(); ?></div>
            <ul class="meta clearfix">
                <?php pkb_posted_in(); ?>
            </ul>
            <hr/>
        </div>

        <?php /* How to display posts in Archive Page or Search Page. */ ?>
    <?php elseif (is_search() || is_archive()) : ?>
        <div class="post">
            <h3 class="post_title replace"><a href="<?php the_permalink(); ?>"
                                              title="<?php printf(esc_attr__('Permalink to %s', 'peekaboo'), the_title_attribute('echo=0')); ?>"
                                              rel="bookmark"><?php the_title(); ?></a></h3>

            <div class="post_meta"><?php pkb_posted_on(); ?></div>
            <div class="clearfix"><?php the_excerpt(); ?></div>
            <hr class="thin"/>
        </div>

        <?php /* How to display Display all other posts. */ ?>
    <?php else : ?>
        <div class="post">
            <h2 class="post_title"><a href="<?php the_permalink(); ?>"
                                      title="<?php printf(esc_attr__('Permalink to %s', 'peekaboo'), the_title_attribute('echo=0')); ?>"
                                      rel="bookmark"><?php the_title(); ?></a></h2>

            <div class="post_meta"><em><?php pkb_posted_on(); ?></em> <a href="<?php the_permalink(); ?>" class="comment_count"><?php comments_number('0', '1', '%'); ?></a>
            </div>
            <div class="clearfix"><?php the_content(__('Learn More &rarr;', 'peekaboo')); ?></div>
            <ul class="meta clearfix">
                <?php pkb_posted_in(); ?>
            </ul>
            <hr/>
        </div>
    <?php endif; ?>

<?php endwhile; /* End the loop. */ ?>

<?php if (function_exists("pkb_pagination")) { /* Display navigation to next/previous pages when applicable */
    pkb_pagination();
} ?>