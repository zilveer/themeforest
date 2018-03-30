<?php

/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php
    function edit_view_link( $view_link ){
        return str_replace( __( 'View', 'buddypress' ), __( '+ more', 'yit' ), $view_link );
    }

    add_filter('bp_get_member_latest_update', 'edit_view_link');

    wp_enqueue_script( 'jquery-masonry' );
?>

<?php do_action( 'bp_before_members_loop' ); ?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>

    <div id="pag-top" class="pagination">

        <div class="pag-count" id="member-dir-count-top">

            <?php bp_members_pagination_count(); ?>

        </div>

        <div class="pagination-links" id="member-dir-pag-top">

            <?php bp_members_pagination_links(); ?>

        </div>

    </div>

    <?php do_action( 'bp_before_directory_members_list' ); ?>

    <div class="clearfix"></div>

    <ul id="members-list" class="row clearfix" role="main">

        <?php while ( bp_members() ) : bp_the_member(); ?>

            <li class="yit_animate fadeInUp col-md-4 col-sm-6 masonry_item">
                <div class="item-container">
                    <div class="item-header clearfix">
                        <div class="item-avatar">
                            <a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar( array( 'height' => 60, 'width' => 60 ) ); ?></a>
                        </div>

                        <div class="item">
                            <div class="item-username"
                                ><a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
                            </div>

                            <div class="item-meta">
                                <span class="activity"><?php bp_member_last_active(); ?></span>
                            </div>

                            <?php do_action( 'bp_directory_members_item' ); ?>

                            <?php
                            /***
                             * If you want to show specific profile fields here you can,
                             * but it'll add an extra query for each member in the loop
                             * (only one regardless of the number of fields you show):
                             *
                             * bp_member_profile_data( 'field=the field name' );
                             */
                            ?>
                        </div>
                    </div>

                    <div class="item-quote">
                        <?php if ( bp_get_member_latest_update() ) : ?>
                            <span class="update"> <?php bp_member_latest_update(); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="action">

                        <?php do_action( 'bp_directory_members_actions' ); ?>

                    </div>

                </div>
            </li>

        <?php endwhile; ?>

    </ul>

    <?php do_action( 'bp_after_directory_members_list' ); ?>

    <?php bp_member_hidden_fields(); ?>

    <div id="pag-bottom" class="pagination">

        <div class="pag-count" id="member-dir-count-bottom">

            <?php bp_members_pagination_count(); ?>

        </div>

        <div class="pagination-links" id="member-dir-pag-bottom">

            <?php bp_members_pagination_links(); ?>

        </div>

    </div>

<?php else: ?>

    <div id="message" class="info">
        <p><?php _e( "Sorry, no members were found.", 'buddypress' ); ?></p>
    </div>

<?php endif; ?>

<?php do_action( 'bp_after_members_loop' ); ?>

<script>
    jQuery(document).ready(function ($) {
        var container = $('#members-list');

        container.masonry({
            itemSelector: 'li.masonry_item',
            isAnimated: false
        });

        $( 'body' ).on( 'gridloaded', function(){
            $( 'li.masonry_item').removeClass('animated');
            container.masonry({
                itemSelector: 'li.masonry_item',
                isAnimated: false
            });
            $( 'li.masonry_item').yit_waypoint();
        } );
    } );
</script>
