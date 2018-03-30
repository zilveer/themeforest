<!-- Our Latest News Page -->
<div class="page-container pattern-2" id="news">
    <div class="row">
        <div class="twelve columns page-content">
            <h1 class="page-title"><?php global $smof_data; $dreamer_news_page_title = $smof_data['news_page_title']; echo $dreamer_news_page_title ?></h1>
            <h2 class="page-subtitle"><?php global $smof_data; $dreamer_news_page_description = $smof_data['news_page_description']; echo $dreamer_news_page_description ?></h2>
        </div>

        <div class="twelve columns news">
            <!-- News Item -->
            <div class="news-section">

                <?php wp_reset_query(); ?>
                <?php query_posts( 'posts_per_page=6' ); ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="four columns news-item mobile-two">
                    <section class="news-cat-image">
                        <img src="<?php global $smof_data; $dreamer_news_image_post_icon = $smof_data['news_image_post_icon']; echo $dreamer_news_image_post_icon ?>" alt="News Image">
                    </section>
                    <span class="news-date"><?php the_time('F j, Y'); ?></span>
                    <a href="<?php the_permalink(); ?>" class="photo-link">
                        <section class="news-hover hide-for-small">
                            <div class="open-news-item">
                            </div>
                        </section>
                    <?php the_post_thumbnail('news-thumbnail'); ?></a>
                    <section class="news-details">
                        <h3 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="news-title-divider"></div>
                        <p class="news-content"><?php $trimcontent = get_the_content(); $shortcontent = wp_trim_words( $trimcontent, $num_words = 18, $more = '...' ); echo $shortcontent;  ?></p>
                    </section>
                </div>
                <?php endwhile; endif; ?>

            </div>


            <?php global $smof_data;

                $more_posts = $smof_data['more_blog_posts'];
             ?>


        </div>

        <a class="readMorePosts" href="<?php echo $more_posts; ?>">Read More Blog Posts</a>

    </div>
</div>


<?php wp_reset_query(); ?>