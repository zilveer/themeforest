<?php
wp_enqueue_script( 'jquery-masonry' );
?>

<?php if ( bp_group_has_members( bp_ajax_querystring( 'group_members' ) ) ) : ?>

	<?php do_action( 'bp_before_group_members_content' ); ?>

	<div id="pag-top" class="pagination">

		<div class="pag-count" id="member-count-top">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

	<?php do_action( 'bp_before_group_members_list' ); ?>

	<ul id="member-list" role="main" class="row clearfix">

		<?php while ( bp_group_members() ) : bp_group_the_member(); ?>

			<li class="yit_animate fadeInUp col-md-4 col-sm-6 masonry_item">
                <div class="item-container">
                    <div class="item-avatar">
                        <a href="<?php bp_group_member_domain(); ?>">

                            <?php bp_group_member_avatar_thumb(); ?>

                        </a>
                    </div>

                    <div class="item">
                        <div class="item-username">
                            <?php bp_group_member_link(); ?>
                        </div>
                        <div class="item-meta">
                            <span class="activity"><?php bp_group_member_joined_since(); ?></span>
                        </div>

                        <?php do_action( 'bp_group_members_list_item' ); ?>
                    </div>

                    <?php if ( bp_is_active( 'friends' ) ) : ?>

                        <div class="action">

                            <?php bp_add_friend_button( bp_get_group_member_id(), bp_get_group_member_is_friend() ); ?>

                            <?php do_action( 'bp_group_members_list_item_action' ); ?>

                        </div>

                    <?php endif; ?>
                </div>
			</li>

		<?php endwhile; ?>

	</ul>

	<?php do_action( 'bp_after_group_members_list' ); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

	<?php do_action( 'bp_after_group_members_content' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'This group has no members.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

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
