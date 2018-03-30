<div class="row">
    <hr>
</div>

<?php if ($smof_data['pkb_post_mod_title']) { ?>
    <div class="row section-title">
        <div class="columns large-10">
            <?php if ($smof_data['pkb_post_mod_url']) { ?>
                <h4 class="replace"><a
                        href="?p=<?php echo stripslashes($smof_data['pkb_post_mod_url']); ?>"><?php echo stripslashes($smof_data['pkb_post_mod_title']); ?></a>
                </h4>
            <?php } else { ?>
                <h4 class="replace"><?php echo stripslashes($smof_data['pkb_post_mod_title']); ?></h4>
            <?php } ?>

        </div>
        <?php if ($smof_data['pkb_post_mod_more_link']) { ?>
            <div class="columns large-2 hide-for-small">
                <a href="?pagename=<?php echo stripslashes($smof_data['pkb_post_mod_url']); ?>"
                   class="button fancy small secondary"><?php echo stripslashes($smof_data['pkb_post_mod_more_link']); ?></a>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<div class="row">

    <section class="featured-post">
        <?php
        $featPostNumber = $smof_data['pkb_post_mod_number'];
        if ($featPostNumber == 2) {
            $featPostColNumber = 'large-6 small-12';
        } elseif ($featPostNumber == 3) {
            $featPostColNumber = 'large-4 small-12';
        } else {
            $featPostColNumber = 'large-3 small-12';
        };
        ?>

        <?php if ($featPostNumber >= 2) { ?>
            <article class="<?php echo $featPostColNumber ?> columns">
                <?php
                if ($smof_data['pkb_homepage_post_1']) {
                    $the_query = new WP_Query($smof_data['pkb_homepage_post_1']);
                } else {
                    $the_query = new WP_Query('posts_per_page=1&ignore_sticky_posts=true');
                }
                while ($the_query->have_posts()) : $the_query->the_post();?>
                    <div class="post-module">

                        <?php if ((has_post_thumbnail() && function_exists('has_post_thumbnail'))) { ?>
                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('pkb-post-image-home'); ?> </a>
                        <?php } ?>
                        <div class="excerpt_container">
                            <h3 class="entry-title replace"><a href="<?php the_permalink(); ?>"
                                                               title="<?php printf(esc_attr__('Permalink to %s', 'peekaboo'), the_title_attribute('echo=0')); ?>"
                                                               rel="bookmark"><?php the_title(); ?></a></h3>

                            <p><?php echo get_the_excerpt(); ?>


                        </div>
                    </div>
                    <?php
                endwhile; wp_reset_postdata();
                ?>
            </article>
            <article class="<?php echo $featPostColNumber ?> columns">
                <?php
                if ($smof_data['pkb_homepage_post_2']) {
                    $the_query = new WP_Query($smof_data['pkb_homepage_post_2']);
                } else {
                    $the_query = new WP_Query('posts_per_page=1&offset=1&ignore_sticky_posts=true');
                }
                while ($the_query->have_posts()) : $the_query->the_post();?>
                    <div class="post-module">

                        <?php if ((has_post_thumbnail() && function_exists('has_post_thumbnail'))) { ?>
                            <div class="figure"><a
                                    href="<?php the_permalink() ?>"><?php the_post_thumbnail('pkb-post-image-home'); ?> </a>
                            </div>
                        <?php } ?>
                        <div class="excerpt_container">
                            <h3 class="entry-title replace"><a href="<?php the_permalink(); ?>"
                                                               title="<?php printf(esc_attr__('Permalink to %s', 'peekaboo'), the_title_attribute('echo=0')); ?>"
                                                               rel="bookmark"><?php the_title(); ?></a></h3>

                            <p><?php echo get_the_excerpt(); ?>


                        </div>
                    </div>
                    <?php
                endwhile; wp_reset_postdata();
                ?>
            </article>
        <?php } ?>
        <?php if ($featPostNumber >= 3) { ?>
            <article class="<?php echo $featPostColNumber ?> columns">
                <?php
                if ($smof_data['pkb_homepage_post_3']) {
                    $the_query = new WP_Query($smof_data['pkb_homepage_post_3']);
                } else {
                    $the_query = new WP_Query('posts_per_page=1&offset=2&ignore_sticky_posts=true');
                }
                while ($the_query->have_posts()) : $the_query->the_post();?>
                    <div class="post-module">

                        <?php if ((has_post_thumbnail() && function_exists('has_post_thumbnail'))) { ?>
                            <div class="figure"><a
                                    href="<?php the_permalink() ?>"><?php the_post_thumbnail('pkb-post-image-home'); ?> </a>
                            </div>
                        <?php } ?>
                        <div class="excerpt_container">
                            <h3 class="entry-title replace"><a href="<?php the_permalink(); ?>"
                                                               title="<?php printf(esc_attr__('Permalink to %s', 'peekaboo'), the_title_attribute('echo=0')); ?>"
                                                               rel="bookmark"><?php the_title(); ?></a></h3>

                            <p><?php echo get_the_excerpt(); ?>


                        </div>
                    </div>
                    <?php
                endwhile; wp_reset_postdata();
                ?>
            </article>
        <?php } ?>
        <?php if ($featPostNumber >= 4) { ?>
            <article class="<?php echo $featPostColNumber ?> columns">
                <?php
                if ($smof_data['pkb_homepage_post_4']) {
                    $the_query = new WP_Query($smof_data['pkb_homepage_post_4']);
                } else {
                    $the_query = new WP_Query('posts_per_page=1&offset=3&ignore_sticky_posts=true');
                }
                while ($the_query->have_posts()) : $the_query->the_post();?>
                    <div class="post-module">

                        <?php if ((has_post_thumbnail() && function_exists('has_post_thumbnail'))) { ?>
                            <div class="figure"><a
                                    href="<?php the_permalink() ?>"><?php the_post_thumbnail('pkb-post-image-home'); ?> </a>
                            </div>
                        <?php } ?>
                        <div class="excerpt_container">
                            <h3 class="entry-title replace"><a href="<?php the_permalink(); ?>"
                                                               title="<?php printf(esc_attr__('Permalink to %s', 'peekaboo'), the_title_attribute('echo=0')); ?>"
                                                               rel="bookmark"><?php the_title(); ?></a></h3>

                            <p><?php echo get_the_excerpt(); ?>


                        </div>
                    </div>
                    <?php
                endwhile; wp_reset_postdata();
                ?>
            </article>
        <?php } ?>

    </section>
</div>