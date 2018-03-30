<?php


/**
 * [g1_bbp_forums] shortcode callback function.
 *
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function g1_bbp_forums_shortcode( $atts, $content ) {
    /* We need a static counter to trace a shortcode without the id attribute */
    static $counter = 0;
    $counter++;

    extract( shortcode_atts( array(
        'id'                        => '',
        'class'                     => ''
    ), $atts, 'g1_bbp_forums' ) );

    // Compose final HTML id attribute
    $final_id = strlen( $id ) ? $id : 'g1-bbp-forums-' . $counter;

    // Compose final HTML class attribute
    $final_class = array(
        'g1-bbp-forums',
    );

    $final_class = array_merge( $final_class, explode( ' ', $class ) );

    // Note: private and hidden forums will be excluded via the
    // bbp_pre_get_posts_normalize_forum_visibility action and function.
    $query = new WP_Query( array(
        'post_type'           => bbp_get_forum_post_type(),
        'post_parent'         => $settings['parent_forum'],
        'post_status'         => bbp_get_public_status_id(),
        'posts_per_page'      => get_option( '_bbp_forums_per_page', 50 ),
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
        'orderby'             => 'menu_order title',
        'order'               => 'ASC'
    ) );

    if ( ! $query->have_posts() ) {
        return '';
    }

    // Start output buffer
    ob_start();
    ?>
    <div class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $final_class ) ); ?>">
        <div class="g1-collection g1-collection--grid g1-collection--one-third g1-collection--simple">
            <ul>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <li class="g1-collection__item">
                    <article>
                        <?php if ( has_post_thumbnail() ): ?>
                            <figure class="entry-featured-media">

                                <a href="<?php bbp_forum_permalink( $query->post->ID ); ?>">
                                    <?php the_post_thumbnail( 'g1_one_third' ); ?>
                                </a>
                            </figure>
                        <?php else: ?>
                            <?php echo do_shortcode( '[placeholder icon="camera" size="g1_one_third"]' ); ?>
                        <?php endif; ?>
                        <div class="g1-nonmedia">
                            <div class="g1-inner">
                                <header class="entry-header">
                                    <h3 class="entry-title">
                                        <a href="<?php bbp_forum_permalink( $query->post->ID ); ?>"><?php bbp_forum_title( $query->post->ID ); ?></a>
                                    </h3>
                                    <p class="entry-meta g1-meta">
                                        <span><?php _e( 'Topics', 'bbpress' ); ?>: <?php bbp_forum_topic_count( $query->post->ID ); ?></span>
                                        <span><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?>: <?php bbp_show_lead_topic() ? bbp_forum_reply_count( $query->post->ID ) : bbp_forum_post_count( $query->post->ID ); ?></span>
                                    </p>
                                </header>
                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </div>
                    </article>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
    <?php

    // Reset the $post global
    wp_reset_postdata();

    // Return and flush the output buffer
    return ob_get_clean();
}

add_shortcode( 'g1_bbp_forums', 'g1_bbp_forums_shortcode' );