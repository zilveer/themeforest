<?php

/**
 * BuddyPress Delete Account
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

?>

<?php get_header( 'buddypress' ); ?>

<div class="main-content-left">

	<div class="page-content" id="content">
    
		<?php do_action( 'bp_before_member_settings_template' ); ?>

        <div id="item-header">

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

        <div id="item-body" role="main">

            <?php do_action( 'bp_before_member_body' ); ?>

            <div class="item-list-tabs no-ajax" id="subnav">
                <ul>

                    <?php bp_get_options_nav(); ?>

                    <?php do_action( 'bp_member_plugin_options_nav' ); ?>

                </ul>
            </div><!-- .item-list-tabs -->

            <h3><?php _e( 'Delete Account', 'buddypress' ); ?></h3>

            <div id="message" class="info">
                
                <?php if ( bp_is_my_profile() ) : ?>

                    <p><?php _e( 'Deleting your account will delete all of the content you have created. It will be completely irrecoverable.', 'buddypress' ); ?></p>
                    
                <?php else : ?>

                    <p><?php _e( 'Deleting this account will delete all of the content it has created. It will be completely irrecoverable.', 'buddypress' ); ?></p>

                <?php endif; ?>

            </div>

            <form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/delete-account'; ?>" name="account-delete-form" id="account-delete-form" class="standard-form" method="post">

                <?php do_action( 'bp_members_delete_account_before_submit' ); ?>

                <label>
                    <input type="checkbox" name="delete-account-understand" id="delete-account-understand" value="1" onclick="if(this.checked) { document.getElementById('delete-account-button').disabled = ''; } else { document.getElementById('delete-account-button').disabled = 'disabled'; }" />
                     <?php _e( 'I understand the consequences.', 'buddypress' ); ?>
                </label>

                <div class="submit">
                    <input type="submit" disabled="disabled" value="<?php _e( 'Delete Account', 'buddypress' ); ?>" id="delete-account-button" name="delete-account-button" />
                </div>

                <?php do_action( 'bp_members_delete_account_after_submit' ); ?>

                <?php wp_nonce_field( 'delete-account' ); ?>

            </form>

            <?php do_action( 'bp_after_member_body' ); ?>

        </div><!-- #item-body -->

        <?php do_action( 'bp_after_member_settings_template' ); ?>

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