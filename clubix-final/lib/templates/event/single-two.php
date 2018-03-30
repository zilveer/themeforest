<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$prefix = Haze_Meta_Boxes::get_instance()->prefix;
$Event = clx_get_event_meta(get_the_ID());
?>

<div class="col-sm-8">
<div class="container-row">
<div class="row">
    <div class="col-sm-12">
        <article class="post-article event-02 single-post clearfix">
            <div class="content-event-article clearfix">
                <figure class="event clearfix">
                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                        <figcaption>
                            <a href="<?= wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>" rel="prettyPhoto[gallery]"><?php the_post_thumbnail('song_single'); ?></a>
                        </figcaption>
                    <?php endif; ?>
                    <div class="content">
                        <h1>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h1>
                        <hr>
                        <div class="event-details">
                            <div class="details">
                                <?php if($Event['event_venue_name']): ?>
                                    <p>
                                <span>
                                    <strong><?php _e('Venue:', LANGUAGE_ZONE); ?></strong>
                                </span>
                                        <?= $Event['event_venue_name']; ?>
                                    </p>
                                <?php endif; ?>

                                <?php if($Event['event_city'] && $Event['event_country']): ?>
                                    <p>
                                <span>
                                    <strong><?php _e('Location:', LANGUAGE_ZONE); ?></strong>
                                </span>
                                        <?= $Event['event_city'] . ', ' . $Event['event_country']; ?>
                                    </p>
                                <?php elseif($Event['event_city']) : ?>
                                    <p>
                                <span>
                                    <strong><?php _e('Location:', LANGUAGE_ZONE); ?></strong>
                                </span>
                                        <?= $Event['event_city']; ?>
                                    </p>
                                <?php elseif($Event['event_country']) : ?>
                                    <p>
                                <span>
                                    <strong><?php _e('Location:', LANGUAGE_ZONE); ?></strong>
                                </span>
                                        <?= $Event['event_country']; ?>
                                    </p>
                                <?php endif; ?>

                                <p>
                            <span>
                                <strong><?php _e('Date:', LANGUAGE_ZONE); ?></strong>
                            </span>
                                    <?php // TODO Here, take the date format from the user. ?>
                                    <?php echo date_i18n('M d', strtotime($Event['event_start_date'])) . ' '. __('to', LANGUAGE_ZONE) . ' ' . date_i18n('M d', strtotime($Event['event_end_date'])); ?>
                                </p>

                                <?php if( $Event['event_all_day'] ): ?>
                                    <p>
                                <span>
                                    <strong><?php _e('Length:', LANGUAGE_ZONE); ?></strong>
                                </span>
                                        <?php _e('All day.', LANGUAGE_ZONE); ?>
                                    </p>
                                <?php else : ?>
                                    <p>
                                <span>
                                    <strong><?php _e('Length:', LANGUAGE_ZONE); ?></strong>
                                </span>
                                        <?php
                                        global $clx_data;
                                        $c12h = $clx_data['event-time-format'];
                                        $event_start_hour = absint( $Event['event_start_hour'] );
                                        $event_end_hour = absint( $Event['event_end_hour'] );
                                        
                                        if( ! $clx_data['event-time-format'] ) {
                                            if( 'pm' == $Event['event_start_am_pm'] ) {
                                            	$event_start_hour += 12;
                                            }
                                            
                                            if( 'pm' == $Event['event_end_am_pm'] ) {
                                            	$event_end_hour += 12;
                                            }
                                        }
                                        
                                        echo $event_start_hour;
                                        echo ':';
                                        echo $Event['event_start_minute'];
                                        
                                        if( $clx_data['event-time-format'] ) {
                                            echo ' ';
                                            echo $Event['event_start_am_pm'];
                                        }
                                        
                                        echo ' &ndash; ';
                                        echo $event_end_hour;
                                        echo ':';
                                        echo $Event['event_end_minute'];
                                        
                                        if( $clx_data['event-time-format'] ) {
                                            echo ' ';
                                            echo $Event['event_end_am_pm'];
                                        }
                                        ?>
                                    </p>
                                <?php endif; ?>

                                <?php if($Event['event_price'] && $Event['event_enable_tickets']): ?>
                                    <p>
                                <span>
                                    <strong><?php _e('Ticket Price:', LANGUAGE_ZONE); ?></strong>
                                </span>
                                        <?= $Event['event_price_currency'] . $Event['event_price']; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>

                        <?php clx_buy_tickets_button(get_the_ID()); ?>

                        <div class="date">
                            <p>
                            <?php // TODO Here, take the date format from the user. ?>
                            <?php
                            echo date_i18n('d / M / Y', strtotime($Event['event_start_date']));
                            ?>
                            </p>
                        </div>
                    </div>
                </figure>
            </div>
            <div class="content-article clearfix">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <?= clx_get_google_maps($Event['event_address'], $Event['event_show_map']); ?>

            </div>
        </article>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <!-- ============== COMMENTS CONTAINER ============= -->
        <div class="comment-container">
            <div class="col-sm-12">

                <?php comments_template('', true); ?>

            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- ========= WIDGETS HERE ======== -->
<div class="col-sm-4">
    <?php get_sidebar('main-sidebar'); ?>
</div>