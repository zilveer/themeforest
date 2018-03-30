<?php
//get theme options
global $oswc_bp;

//set theme options
$oswc_bp_sidebar_unique = $oswc_bp['bp_sidebar_unique'];
$oswc_bp_groups_sidebar_unique = $oswc_bp['bp_groups_sidebar_unique'];

//setup variables
$sidebar="Default Sidebar";
if($oswc_bp_sidebar_unique) { $sidebar="BuddyPress Default Sidebar"; }
if($oswc_bp_groups_sidebar_unique) { $sidebar="BuddyPress Groups Sidebar"; }

get_header( 'buddypress' ); ?>

<div class="main-content-left">

	<div class="page-content" id="content">
    
		<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>

        <?php do_action( 'bp_before_group_home_content' ); ?>

        <div id="item-header" role="complementary">

            <?php locate_template( array( 'groups/single/group-header.php' ), true ); ?>

        </div><!-- #item-header -->

        <div id="item-nav">
            <div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
                <ul>

                    <?php bp_get_options_nav(); ?>

                    <?php do_action( 'bp_group_options_nav' ); ?>

                </ul>
            </div>
        </div><!-- #item-nav -->

        <div id="item-body">

            <?php do_action( 'bp_before_group_body' );

            if ( bp_is_group_admin_page() && bp_group_is_visible() ) :
                locate_template( array( 'groups/single/admin.php' ), true );

            elseif ( bp_is_group_members() && bp_group_is_visible() ) :
                locate_template( array( 'groups/single/members.php' ), true );

            elseif ( bp_is_group_invites() && bp_group_is_visible() ) :
                locate_template( array( 'groups/single/send-invites.php' ), true );

                elseif ( bp_is_group_forum() && bp_group_is_visible() && bp_is_active( 'forums' ) && bp_forums_is_installed_correctly() ) :
                    locate_template( array( 'groups/single/forum.php' ), true );

            elseif ( bp_is_group_membership_request() ) :
                locate_template( array( 'groups/single/request-membership.php' ), true );

            elseif ( bp_group_is_visible() && bp_is_active( 'activity' ) ) :
                locate_template( array( 'groups/single/activity.php' ), true );

            elseif ( bp_group_is_visible() ) :
                locate_template( array( 'groups/single/members.php' ), true );

            elseif ( !bp_group_is_visible() ) :
                // The group is not visible, show the status message

                do_action( 'bp_before_group_status_message' ); ?>

                <div id="message" class="info">
                    <p><?php bp_group_status_message(); ?></p>
                </div>

                <?php do_action( 'bp_after_group_status_message' );

            else :
                // If nothing sticks, just load a group front template if one exists.
                locate_template( array( 'groups/single/front.php' ), true );

            endif;

            do_action( 'bp_after_group_body' ); ?>

        </div><!-- #item-body -->

        <?php do_action( 'bp_after_group_home_content' ); ?>

        <?php endwhile; endif; ?>

	</div>
	
</div>

<div class="sidebar">

	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar) ) : else : ?>

		<div class="widget-wrapper">
		
			<div class="widget">
	
				<div class="section-wrapper"><div class="section">
				
					<?php _e(' Made Magazine ', 'made' ); ?>
				
				</div></div> 
				
				<div class="textwidget">  
											  
					<p><?php _e( 'This is a widget panel. To remove this text, login to your WordPress admin panel and go to Appearance >> Widgets, and drag &amp; drop a widget into the corresponding widget panel.', 'made' ); ?></p>
					
				</div>
							
			</div>
		
		</div>
	
	<?php endif; ?>
	
</div>

<br class="clearer" />

<?php get_footer( 'buddypress' ); ?>
