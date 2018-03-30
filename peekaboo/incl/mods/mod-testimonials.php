<div class="row">
    <hr>
</div>

<?php if ($smof_data['pkb_testimonial_mod_title']) { ?>
    <div class="row section-title">
        <div class="columns large-10">
            <?php if ($smof_data['pkb_testimonial_mod_url']) { ?>
                <h4 class="replace"><a
                        href="?pagename=<?php echo stripslashes($smof_data['pkb_testimonial_mod_url']); ?>"><?php echo stripslashes($smof_data['pkb_testimonial_mod_title']); ?></a>
                </h4>
            <?php } else { ?>
                <h4 class="replace"><?php echo stripslashes($smof_data['pkb_testimonial_mod_title']); ?></h4>
            <?php } ?>
        </div>
        <?php if ($smof_data['pkb_testimonial_mod_more_link']) { ?>
            <div class="columns large-2 hide-for-small">
                <a href="?pagename=<?php echo stripslashes($smof_data['pkb_testimonial_mod_url']); ?>"
                   class="button fancy small secondary"><?php echo stripslashes($smof_data['pkb_testimonial_mod_more_link']); ?></a>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<div class="row">
    <div class="large-12 columns">
        <section class="testimonial-mod">

            <?php
            $testimonialsNumber = $data['pkb_testimonial_mod_col'];

            if ($data['pkb_testimonial_mod_rand'] == 1) {
                $rand = '&orderby=rand';
            } else {
                $rand = null;
            }

            if ($testimonialsNumber == 2) {
                echo '<ul class="large-block-grid-2 small-block-grid-1">';
            } elseif ($testimonialsNumber == 3) {
                echo '<ul class="large-block-grid-3 small-block-grid-1">';
            } else {
                echo '<ul class="large-block-grid-4 small-block-grid-1">';
            };

            if ($testimonialsNumber == 2) {
                $the_query = new WP_Query('post_type=testimonial&posts_per_page=2' . $rand . '');
            } elseif ($testimonialsNumber == 3) {
                $the_query = new WP_Query('post_type=testimonial&posts_per_page=3' . $rand . '');
            } else {
                $the_query = new WP_Query('post_type=testimonial&posts_per_page=4' . $rand . '');
            };

            while ($the_query->have_posts()) : $the_query->the_post();

                $testiName = get_post_meta(get_the_ID(), 'pkb_author_name', true);
                $testiTitle = get_post_meta(get_the_ID(), 'pkb_author_title', true);

                ?>
                <li>
                    <a class="testimonial-post" href="<?php the_permalink(); ?>"
                       title="<?php printf(esc_attr__('Permalink to %s', 'peekaboo'), the_title_attribute('echo=0')); ?>"
                       rel="bookmark">

                        <div class="testimonial_excerpt_container">
                            <?php the_excerpt(); ?>
                            <div class="testimonial_author">
                                <?php echo $testiName ?><br>
                                <span><?php echo $testiTitle ?></span>
                            </div>
                        </div>
                    </a>
                </li>
            <?php endwhile; wp_reset_postdata(); ?>
            </ul>

        </section>
    </div>
</div>