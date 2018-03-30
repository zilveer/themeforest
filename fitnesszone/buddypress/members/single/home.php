<div id="buddypress">

	<?php do_action( 'bp_before_member_home_content' ); ?>

    <div id="item-header" role="complementary">
        <?php
        /**
         * If the cover image feature is enabled, use a specific header
         */
        if ( bp_displayed_user_use_cover_image_header() ) :
            bp_get_template_part( 'members/single/cover-image-header' );
        else :
            bp_get_template_part( 'members/single/member-header' );
        endif;
        ?>
    </div><!-- #item-header -->

	<div class="dt-sc-member-container">
        <div id="item-nav">
            <div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
                <ul>
    
                    <?php bp_get_displayed_user_nav(); ?>
    
                    <?php do_action( 'bp_member_options_nav' ); ?>
    
                </ul>
            </div>
        </div><!-- #item-nav -->
	</div>        

	<div id="item-body" role="main">

		<?php do_action( 'bp_before_member_body' );

		if ( bp_is_user_activity() || !bp_current_component() ) :
			bp_get_template_part( 'members/single/activity' );

		elseif ( bp_is_user_blogs() ) :
			bp_get_template_part( 'members/single/blogs'    );

		elseif ( bp_is_user_friends() ) :
			bp_get_template_part( 'members/single/friends'  );

		elseif ( bp_is_user_groups() ) :
			bp_get_template_part( 'members/single/groups'   );

		elseif ( bp_is_user_messages() ) :
			bp_get_template_part( 'members/single/messages' );

		elseif ( bp_is_user_profile() ) :
			bp_get_template_part( 'members/single/profile'  );

		elseif ( bp_is_user_forums() ) :
			bp_get_template_part( 'members/single/forums'   );

		elseif ( bp_is_user_notifications() ) :
			bp_get_template_part( 'members/single/notifications' );

		elseif ( bp_is_user_settings() ) :
			bp_get_template_part( 'members/single/settings' );

		// If nothing sticks, load a generic template
		else :
			bp_get_template_part( 'members/single/plugins'  );

		endif;

		do_action( 'bp_after_member_body' ); ?>

	</div><!-- #item-body -->

	<?php do_action( 'bp_after_member_home_content' ); ?>

</div><!-- #buddypress -->
