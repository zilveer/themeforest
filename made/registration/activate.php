<?php 
//get theme options
global $oswc_bp;

//set theme options
$oswc_bp_sidebar_unique = $oswc_bp['bp_sidebar_unique'];
$oswc_bp_registration_sidebar_unique = $oswc_bp['bp_registration_sidebar_unique'];

//setup variables
$sidebar="Default Sidebar";
if($oswc_bp_sidebar_unique) { $sidebar="BuddyPress Default Sidebar"; }
if($oswc_bp_registration_sidebar_unique) { $sidebar="BuddyPress Registration Sidebar"; } 

get_header( 'buddypress' ); ?>

<div class="main-content-left">

	<div class="page-content" id="content">
    
		<?php do_action( 'bp_before_activation_page' ); ?>

        <div class="page" id="activate-page">

            <?php if ( bp_account_was_activated() ) : ?>

                <h2 class="widgettitle"><?php _e( 'Account Activated', 'buddypress' ); ?></h2>

                <?php do_action( 'bp_before_activate_content' ); ?>

                <?php if ( isset( $_GET['e'] ) ) : ?>
                    <p><?php _e( 'Your account was activated successfully! Your account details have been sent to you in a separate email.', 'buddypress' ); ?></p>
                <?php else : ?>
                    <p><?php _e( 'Your account was activated successfully! You can now log in with the username and password you provided when you signed up.', 'buddypress' ); ?></p>
                <?php endif; ?>

            <?php else : ?>

                <h3><?php _e( 'Activate your Account', 'buddypress' ); ?></h3>

                <?php do_action( 'bp_before_activate_content' ); ?>

                <p><?php _e( 'Please provide a valid activation key.', 'buddypress' ); ?></p>

                <form action="" method="get" class="standard-form" id="activation-form">

                    <label for="key"><?php _e( 'Activation Key:', 'buddypress' ); ?></label>
                    <input type="text" name="key" id="key" value="" />

                    <p class="submit">
                        <input type="submit" name="submit" value="<?php _e( 'Activate', 'buddypress' ); ?>" />
                    </p>

                </form>

            <?php endif; ?>

            <?php do_action( 'bp_after_activate_content' ); ?>

        </div><!-- .page -->

        <?php do_action( 'bp_after_activation_page' ); ?>    

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
