<?php get_header(); ?>

 <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <article class="uk-article" data-permalink="<?php the_permalink(); ?>">

        <h1 class="uk-article-title"><?php the_title(); ?></h1>

        <?php the_content(''); ?>

        <?php the_tags('<p>'.__('Tags: ', 'warp'), ', ', '</p>'); ?>

        <?php edit_post_link(__('Edit this post.', 'warp'), '<p><i class="uk-icon-pencil"></i> ','</p>'); ?>

        <?php if (pings_open()) : ?>
        <p><?php printf(__('<a href="%s">Trackback</a> from your site.', 'warp'), get_trackback_url()); ?></p>
        <?php endif; ?>

        <?php if (get_the_author_meta('description')) : ?>
        <div class="uk-panel uk-panel-box">

            <div class="uk-align-medium-left">

                <?php echo get_avatar(get_the_author_meta('user_email')); ?>

            </div>

            <h2 class="uk-h3 uk-margin-top-remove"><?php the_author(); ?></h2>

            <div class="uk-margin"><?php the_author_meta('description'); ?></div>

        </div>
        <?php endif; ?>

        <?php comments_template(); ?>

    </article>

    <?php endwhile; ?>
 <?php endif; ?>


 <?php get_footer(); ?>