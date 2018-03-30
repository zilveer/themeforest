<?php

/**
 * BuddyPress - Members Directory
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
$override = get_post_meta($post->ID, "Hide Trending", $single = true);
if($override!="" && $override!="null") {
	$oswc_trending_hide=$override;
	if($oswc_trending_hide=="false") {
		$oswc_trending_hide=false;	
	} else {
		$oswc_trending_hide=true;
	}
}
$sidebar="Default Sidebar";
if($oswc_bp_sidebar_unique) { $sidebar="BuddyPress Default Sidebar"; }
if($oswc_bp_members_sidebar_unique) { $sidebar="BuddyPress Members Sidebar"; }
if ( is_page_template('template-full-width.php') ) {
	$displaysidebar=false;
}else{
	$displaysidebar=true;
}

get_header( 'buddypress' ); ?>

<?php do_action( 'bp_before_directory_members_page' ); ?>

<div class="main-content<?php if($displaysidebar) { ?>-left<?php } ?>">

	<div class="page-content" id="content">
    
		<?php do_action( 'bp_before_directory_members' ); ?>

        <form action="" method="post" id="members-directory-form" class="dir-form">

            <h3><?php _e( 'Members Directory', 'buddypress' ); ?></h3>

            <?php do_action( 'bp_before_directory_members_content' ); ?>

            <div id="members-dir-search" class="dir-search" role="search">

                <?php bp_directory_members_search_form(); ?>

            </div><!-- #members-dir-search -->

            <div class="item-list-tabs" role="navigation">
                <ul>
                    <li class="selected" id="members-all"><a href="<?php echo trailingslashit( bp_get_root_domain() . '/' . bp_get_members_root_slug() ); ?>"><?php printf( __( 'All Members <span>%s</span>', 'buddypress' ), bp_get_total_member_count() ); ?></a></li>

                    <?php if ( is_user_logged_in() && bp_is_active( 'friends' ) && bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>

                        <li id="members-personal"><a href="<?php echo bp_loggedin_user_domain() . bp_get_friends_slug() . '/my-friends/' ?>"><?php printf( __( 'My Friends <span>%s</span>', 'buddypress' ), bp_get_total_friend_count( bp_loggedin_user_id() ) ); ?></a></li>

                    <?php endif; ?>

                    <?php do_action( 'bp_members_directory_member_types' ); ?>

                </ul>
            </div><!-- .item-list-tabs -->

            <div class="item-list-tabs" id="subnav" role="navigation">
                <ul>

                    <?php do_action( 'bp_members_directory_member_sub_types' ); ?>

                    <li id="members-order-select" class="last filter">

                        <label for="members-order-by"><?php _e( 'Order By:', 'buddypress' ); ?></label>
                        <select id="members-order-by">
                            <option value="active"><?php _e( 'Last Active', 'buddypress' ); ?></option>
                            <option value="newest"><?php _e( 'Newest Registered', 'buddypress' ); ?></option>

                            <?php if ( bp_is_active( 'xprofile' ) ) : ?>

                                <option value="alphabetical"><?php _e( 'Alphabetical', 'buddypress' ); ?></option>

                            <?php endif; ?>

                            <?php do_action( 'bp_members_directory_order_options' ); ?>

                        </select>
                    </li>
                </ul>
            </div>

            <div id="members-dir-list" class="members dir-list">

                <?php locate_template( array( 'members/members-loop.php' ), true ); ?>

            </div><!-- #members-dir-list -->

            <?php do_action( 'bp_directory_members_content' ); ?>

            <?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ); ?>

            <?php do_action( 'bp_after_directory_members_content' ); ?>

        </form><!-- #members-directory-form -->

        <?php do_action( 'bp_after_directory_members' ); ?>
    
        <?php do_action( 'bp_after_directory_members_page' ); ?>

	</div>
    
    <?php if(!$oswc_trending_hide) { ?>
    
    	<br class="clearer" />
    
    	<?php oswc_get_template_part('trending'); // show trending ?>
        
    <?php } ?>
	
</div>

<?php if($displaysidebar) { ?>
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
<?php } ?>

<br class="clearer" />

<?php get_footer( 'buddypress' ); ?>
