<?php 
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

<?php do_action( 'template_notices' ); ?>

<div class="main-content-left">

	<div class="page-content" id="content">

        <div class="activity no-ajax" role="main">
            <?php if ( bp_has_activities( 'display_comments=threaded&show_hidden=true&include=' . bp_current_action() ) ) : ?>
        
                <ul id="activity-stream" class="activity-list item-list">
                <?php while ( bp_activities() ) : bp_the_activity(); ?>
        
                    <?php locate_template( array( 'activity/entry.php' ), true ); ?>
        
                <?php endwhile; ?>
                </ul>
        
            <?php endif; ?>
        </div>
        
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