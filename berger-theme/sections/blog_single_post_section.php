
                <!-- Post Header -->
                <div class="post-header">

                    <ul class="meta-categories title-has-line">
                        <?php the_category(); ?>
					</ul>

                    <h1 class="post-title-no-link"><?php the_title(); ?></h1>

                    <ul class="entry-meta">
                        <li class="entry-date"><a href="#"><?php the_time('F j, Y'); ?></a></li>
                        <li class="entry-author"><?php _e('Posted by', THEME_LANGUAGE_DOMAIN ); ?> <?php the_author_posts_link(); ?></li>
                        <li class="entry-comments"><?php comments_popup_link(); ?></li>
						<?php the_tags('<ul class="clapat-tags"><li class="entry-tags">', '</li><li class="entry-tags">', '</li></ul>'); ?>
                    </ul>

                </div>
                <!--/Post Header -->

                <!-- Post Content -->
                <div class="post-content">

                    <?php the_content(); ?>

                    <div class="page-links">
                        <?php

                        wp_link_pages();

                        ?>
                    </div>

                </div>
                <!--/Post Content -->


                <?php comments_template(); ?>


                <!-- Blog Navigation -->
                <ul class="blog-nav">
                    <?php previous_post_link( '<li class="prev-posts">%link</li>', __('Prev Post', THEME_LANGUAGE_DOMAIN ) ); ?>
                    <?php next_post_link( '<li class="next-posts">%link</li>', __('Next Post', THEME_LANGUAGE_DOMAIN ) ); ?>
                </ul>
                <!--/Blog Navigation -->