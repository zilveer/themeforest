<?php

/**
 * BuddyPress - Users Home
 *
 * @package BuddyPress
 * @subpackage bp-default
 */
 
//get theme options
global $oswc_bp;

//set theme options
$oswc_bp_sidebar_unique = $oswc_bp['bp_sidebar_unique'];
$oswc_bp_members_sidebar_unique = $oswc_bp['bp_members_sidebar_unique'];

//setup variables
$sidebar="Default Sidebar";
if($oswc_bp_sidebar_unique) { $sidebar="BuddyPress Default Sidebar"; }
if($oswc_bp_members_sidebar_unique) { $sidebar="BuddyPress Members Sidebar"; } 

get_header( 'buddypress' ); ?>

<div class="main-content-left">

	<div class="page-content" id="content">
    
		<?php do_action( 'bp_before_member_home_content' ); ?>

        <div id="item-header" role="complementary">

            <?php locate_template( array( 'members/single/member-header.php' ), true ); ?>

        </div><!-- #item-header -->

        <div id="item-nav">
            <div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
                <ul>

                    <?php bp_get_displayed_user_nav(); ?>

                    <?php do_action( 'bp_member_options_nav' ); ?>

                </ul>
            </div>
        </div><!-- #item-nav -->

        <div id="item-body">

            <?php do_action( 'bp_before_member_body' );

            if ( bp_is_user_activity() || !bp_current_component() ) :
                locate_template( array( 'members/single/activity.php'  ), true );

             elseif ( bp_is_user_blogs() ) :
                locate_template( array( 'members/single/blogs.php'     ), true );

            elseif ( bp_is_user_friends() ) :
                locate_template( array( 'members/single/friends.php'   ), true );

            elseif ( bp_is_user_groups() ) :
                locate_template( array( 'members/single/groups.php'    ), true );

            elseif ( bp_is_user_messages() ) :
                locate_template( array( 'members/single/messages.php'  ), true );

            elseif ( bp_is_user_profile() ) :
                locate_template( array( 'members/single/profile.php'   ), true );

            elseif ( bp_is_user_forums() ) :
                locate_template( array( 'members/single/forums.php'    ), true );

            elseif ( bp_is_user_settings() ) :
                locate_template( array( 'members/single/settings.php'  ), true );

            // If nothing sticks, load a generic template
            else :
                locate_template( array( 'members/single/plugins.php'   ), true );

            endif;

            do_action( 'bp_after_member_body' ); ?>

        </div><!-- #item-body -->

        <?php do_action( 'bp_after_member_home_content' ); ?>

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
