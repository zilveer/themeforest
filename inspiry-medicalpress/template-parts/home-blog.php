<?php
global $theme_options;

if ($theme_options['news_variation'] == '1') {
    $home_blog = 'text-center';
} else {
    $home_blog = 'blog-var-two';
}

?>
<div class="home-blog <?php echo $home_blog; ?> clearfix">
    <div class="container">
        <div class="row">

            <div class="<?php bc_all('12'); ?>">
                <?php
                if (!empty($theme_options['home_news_title']) || !empty($theme_options['home_news_description'])) {
                    ?>
                    <div class="slogan-section animated fadeInUp clearfix">
                        <?php
                        if (!empty($theme_options['home_news_title'])) {
                            echo '<h2>' . $theme_options['home_news_title'] . '</h2>';
                        }
                        if (!empty($theme_options['home_news_description'])) {
                            echo '<p>' . $theme_options['home_news_description'] . '</p>';
                        }
                        ?>
                    </div>
                    <?php
                }

                $number_of_news = 3;
                if( !empty( $theme_options['home_news_count'] ) ) {
                    $number_of_news = intval( $theme_options['home_news_count'] );
                }

                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $number_of_news,
                    'ignore_sticky_posts' => 1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio'),
                            'operator' => 'NOT IN'
                        )
                    ),
                    'meta_query' => array(
                        'relation' => 'OR',
                        array(
                            'key' => '_thumbnail_id',
                            'compare' => 'EXISTS'
                        ),
                        array(
                            'key' => 'MEDICAL_META_embed_code',
                            'compare' => 'EXISTS'
                        ),
                        array(
                            'key' => 'MEDICAL_META_gallery',
                            'compare' => 'EXISTS'
                        )
                    )
                );

                // The Query
                $blog_query = new WP_Query($args);

                // The Loop
                if ($blog_query->have_posts()) {
                    ?>
                    <div class="row">
                    <?php
                    while ($blog_query->have_posts()) {
                        $blog_query->the_post();
                        global $post;
                        $format = get_post_format($post->ID);
                        if (false === $format) {
                            $format = 'standard';
                        }
                        ?>
                        <div class="<?php
                        if( $number_of_news ==  4 ) {
                            bc( '3', '3', '6', '' );
                        } elseif ( $number_of_news == 3 ) {
                            bc( '4', '4', '6', '' );
                        } elseif ( $number_of_news == 2 ) {
                            bc( '', '', '6', '' );
                        } elseif ( $number_of_news == 1 ) {
                            bc( '', '', '12', '' );
                        }
                        // bc('4', '4', '12', '');
                        ?>">
                            <article class="common-blog-post hentry animated fadeInRight clearfix">
                                <?php get_template_part("post-formats/grid/$format"); ?>
                                <div class="text-content clearfix">
                                    <h5 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h5>
                                    <div class="entry-meta">
                                        <time class="published updated" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date( 'j F, Y' ); ?></time>,
                                        <span class="entry-author vcard">
                                            <?php _e('by','framework'); ?>
                                            <?php
                                            printf( '<a class="url fn" href="%1$s" title="%2$s" rel="author">%3$s</a>',
                                                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                                esc_attr( sprintf( __( 'View all posts by %s', 'framework' ), get_the_author() ) ),
                                                get_the_author()
                                            );
                                            ?>
                                        </span>
                                    </div>
                                    <div class="for-border"></div>
                                    <p><?php inspiry_excerpt(20); ?> </p>
                                </div>
                            </article>
                            <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'framework'); ?></a>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                <?php
                } else {
                    nothing_found( _e('No post found !','framework') );
                }
                /* Restore original Post Data */
                wp_reset_query();
                ?>
            </div>

        </div>
    </div>
</div>

