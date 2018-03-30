 <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <article class="uk-article" data-permalink="<?php the_permalink(); ?>">

        <?php if (has_post_thumbnail()) : ?>
            <?php 
                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                ?>
            <img src="<?php echo $large_image_url[0]; ?>" alt="<?php echo the_title_attribute('echo=0'); ?>" class="uk-thumbnail" />

        <?php endif; ?>

        <h1 class="uk-article-title"><?php the_title(); ?></h1>

        <p class="uk-article-meta">
            <?php
                $date = '<time datetime="'.get_the_date('Y-m-d').'" pubdate>'.get_the_date().'</time>';
                printf(__('Written by %s on %s. Posted in %s', 'warp'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
            ?>
        </p>

        <?php the_content(''); ?>

        <?php if ($this['config']->get('postTags')) : ?>
            <?php the_tags('<p class="tagcloud" style="display: inline-block; margin-top: 15px;"><span style="float: left;">'.__('Tags: ', 'warp').'</span>', ' ',  '</p>'); ?>
        <?php endif ?>

        <?php edit_post_link(__('Edit this post.', 'warp'), '<p><i class="uk-icon-pencil"></i> ','</p>'); ?>

        <?php if ($this['config']->get('postTrackBack')) : ?>
            <?php if (pings_open()) : ?>
            <p><?php printf(__('<a href="%s">Trackback</a> from your site.', 'warp'), get_trackback_url()); ?></p>
            <?php endif; ?>
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
        
        <?php if ($this['config']->get('postComment')) : ?>
            <?php comments_template(); ?>
        <?php endif; ?>

    </article>

    <?php endwhile; ?>
 <?php endif; ?>