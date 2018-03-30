<div class="home-services clearfix">
    <div class="container">
        <div class="row">

            <?php
            global $theme_options;
            if ((!empty($theme_options['home_services_title'])) || (!empty($theme_options['home_services_description']))) {
                ?>
                <div class="<?php bc_all('12'); ?> ">
                    <div class="slogan-section animated fadeInUp clearfix">
                        <?php
                        if (!empty($theme_options['home_services_title'])) {
                            echo '<h2>' . $theme_options['home_services_title'] . '</h2>';
                        }
                        if (!empty($theme_options['home_services_description'])) {
                            echo '<p>' . $theme_options['home_services_description'] . '</p>';
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="<?php bc_all('12'); ?>">
                <div class="tab-main animated fadeInDown clearfix">

                    <div class="<?php bc_all('4'); ?>">
                        <?php
                        $services_args = array(
                            'post_type' => 'service',
                            'posts_per_page' => 5
                        );

                        // The Query
                        $services_query = new WP_Query($services_args);

                        // The Loop
                        if ($services_query->have_posts()) {
                            while ($services_query->have_posts()) {
                                $services_query->the_post();
                                ?>
                                <div class="tab-title">
                                    <h6><?php the_title(); ?></h6>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>

                    <div class="<?php bc_all('8'); ?>">
                        <div class="tab-content">
                            <?php
                            $services_query->rewind_posts();
                            while ($services_query->have_posts()) {
                                $services_query->the_post();
                                ?>
                                <article class="content clearfix hentry">
                                    <div class="row">
                                        <div class="<?php bc('6', '6', '12', ''); ?>">
                                            <figure>
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php the_post_thumbnail('gallery-post-single'); ?>
                                                </a>
                                            </figure>
                                        </div>
                                        <div class="<?php bc('6','6','12',''); ?>">
                                            <h5><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h5>
                                            <p><?php inspiry_excerpt(37); ?></p>
                                            <a rel="bookmark" class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More','framework'); ?></a>
                                        </div>
                                    </div>
                                </article>
                                <?php
                            }
                            ?>
                        </div><!-- end of tab-content -->
                    </div>

                </div><!-- tab-main -->
            </div>

        </div>
    </div>
</div>

