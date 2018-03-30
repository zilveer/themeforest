<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$prefix = Haze_Meta_Boxes::get_instance()->prefix;
$social_icons = rwmb_meta("{$prefix}artist_social");
$songs = rwmb_meta("{$prefix}artist_songs", array('type'=>'checkbox_list'));
$events = rwmb_meta("{$prefix}artist_events", array('type'=>'checkbox_list'));
$albums = rwmb_meta("{$prefix}artist_albums", array('type'=>'checkbox_list'));
?>

<div class="col-sm-4">

    <div class="container-row">
        <div class="row">
            <div class="col-sm-12">
                <div class="widget artist-widget">
                    <figure class="clearfix">
                        <figcaption>
                            <div class="artist-min-details">
                                <!-- SOCIAL MEDIA LIST -->
                                <nav class="social-list clearfix">
                                    <ul>
                                        <?= do_shortcode($social_icons); ?>
                                    </ul>
                                </nav>
                                <h4>
                                    <?php the_title(); ?>
                                </h4>
                            </div>
                            <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                <a href="<?= wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>" rel="prettyPhoto[gallery]"><?php the_post_thumbnail('song_single'); ?></a>
                            <?php endif; ?>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <?php if(!empty($songs)): ?>
    <div class="container-row">
        <div class="row">
            <div class="col-sm-12">
                <div class="widget">
                    <div class="minimal-player">

                        <?= clx_simple_song_player($songs); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!empty($events)): ?>
    <div class="container-row">
        <div class="row">
            <div class="col-sm-12">
                <h3 style="text-transform: uppercase;font-size: 22px;font-weight: 400;margin-top: 0;"><?php _e('Events', LANGUAGE_ZONE); ?></h3>
                <div class="underline-bg">
                    <div class="underline template-based-element-background-color"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="widget events-widget">

                    <?php

                    // Construct the query
                    $ids = clx_get_events_ordered_ids(true);
                    $i = 0;
                    if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
                    elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
                    else { $paged = 1; }
                    $args = array(
                        'post_type'         => EventPostType::get_instance()->postType,
                        'post_status'       => 'publish',
                        'paged'             => $paged,
                        'post__in'          => $ids,
                        'orderby'           => 'post__in',
                        'posts_per_page'    => 999
                    );

                    $query = new WP_Query($args);

                    ?>

                    <?php if ( $query->have_posts() ) : ?>

                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                            <?php
                            $Event = clx_get_event_meta(get_the_ID());

                            // Show this if we are on the first event from the past.
                            $Event = clx_get_event_meta(get_the_ID());
                            $date = strtotime($Event['event_start_date'] . ' ' . $Event['event_start_hour'].':'.$Event['event_start_minute'] .' '. $Event['event_start_am_pm'] );
                            $now = strtotime('now');

                            if($i == 0 && $date < $now) {
                                $i++;
                            }

                            if ( $i != 0 || $Event['event_tickets_type'] != 'selling' ) {
                                $event_class = 'buy canceled';
                            } else {
                                $event_class = 'buy';
                            }

                            ?>

                            <?php if(in_array(get_the_ID(), $events)): ?>
                            <article class="clearfix">
                                <div class="left">
                                    <span><?= date('d', strtotime($Event['event_start_date'])); ?></span>
                                    <span><?= date('M', strtotime($Event['event_start_date'])); ?></span>
                                    <span><?= date('Y', strtotime($Event['event_start_date'])); ?></span>
                                </div>
                                <div class="right">
                                    <div class="<?= $event_class; ?>">
                                        <?php if($Event['event_enable_tickets']) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php
                                                switch($Event['event_tickets_type']) {
                                                    case 'selling': _e('Buy Tickets', LANGUAGE_ZONE); break;
                                                    case 'free': _e('Free Entry', LANGUAGE_ZONE); break;
                                                    case 'cancelled': _e('Cancelled', LANGUAGE_ZONE); break;
                                                    case 'soldout': _e('Sold Out', LANGUAGE_ZONE); break;
                                                }
                                                ?>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php
                                                _e('Read More', LANGUAGE_ZONE);
                                                ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <h4>
                                        <?php the_title(); ?>
                                    </h4>
                                    <?php if($Event['event_city'] && $Event['event_country']): ?>
                                        <p>
                                            <i class="fa fa-map-marker"></i>
                                            <?= $Event['event_city'] . ', ' . $Event['event_country']; ?>
                                        </p>
                                    <?php elseif($Event['event_city']) : ?>
                                        <p>
                                            <i class="fa fa-map-marker"></i>
                                            <?= $Event['event_city']; ?>
                                        </p>
                                    <?php elseif($Event['event_country']) : ?>
                                        <p>
                                            <i class="fa fa-map-marker"></i>
                                            <?= $Event['event_country']; ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </article>
                            <?php endif; ?>

                        <?php endwhile; ?>

                    <?php else : ?>

                        <?php
                        /* Get the none-content template (error) */
                        get_template_part( 'content', 'none' );
                        ?>

                    <?php endif; ?>
                    <?php
                    wp_reset_postdata();
                    // End The Loop
                    ?>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>

<div class="col-sm-8">

    <div class="container-row">
        <div class="row">
            <div class="col-sm-12">
                <article class="post-article single-post clearfix">
                    <div class="content-article clearfix">
                        <h1>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h1>

                        <hr>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>

    <?php if(!empty($albums)): ?>
    <div class="conteiner-row">
    <div class="row">
        <div class="col-sm-12">
            <h3 style="text-transform: uppercase;font-size: 22px;font-weight: 400;margin-top: 0;"><?php _e('Albums', LANGUAGE_ZONE); ?></h3>
            <div class="underline-bg">
                <div class="underline template-based-element-background-color"></div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="ablums-posts-bottom owl-albums">

        <?php

        // Construct the query
        $args = array(
            'post_type'         => AlbumPostType::get_instance()->postType,
            'post_status'       => 'publish',
            'post__in'          => $albums,
            'posts_per_page'    => 999
        );

        $query = new WP_Query($args);

        ?>

        <?php if ( $query->have_posts() ) : ?>

            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <?php
                /**
                 * Remove filter because it stays activated throw all posts.
                 */
                remove_filter('zen_get_content_more', 'zen_return_empty_string', 15);

                $artist = rwmb_meta( "{$prefix}album_artist_name" );
                ?>

                <article class="clearfix col-sm-12">
                    <div class="left clearfix">
                        <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                            <figure class="clearfix">
                                <figcaption>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('blog_image_1'); ?>
                                    </a>
                                </figcaption>
                                <?php clx_tags(); ?>
                            </figure>
                        <?php endif; ?>
                        <div class="content">
                            <h4>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            <div class="rating">
                                <?php $rating = rwmb_meta("{$prefix}album_rating"); ?>
                                <div class="full" style="width: <?= $rating; ?>%;">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="empty">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                            </div>
                            <p>
                                <?php zen_the_excerpt(); ?>
                            </p>
                            <?= zen_get_content_more(); ?>
                        </div>
                    </div>
                    <div class="right clearfix">
                        <div class="minimal-player">

                            <!-- Here comes the player -->
                            <?php
                            $ids = rwmb_meta("{$prefix}album_songs", array('type' => 'checkbox_list'));
                            ?>
                            <?php echo clx_simple_song_player($ids); ?>

                        </div>
                    </div>
                </article>

            <?php endwhile; ?>

        <?php else : ?>

            <?php
            /* Get the none-content template (error) */
            get_template_part( 'content', 'none' );
            ?>

        <?php endif; ?>
        <?php
        wp_reset_postdata();
        // End The Loop
        ?>

    </div>
    </div>
    </div>
    <?php endif; ?>

</div>