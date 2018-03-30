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

        <div id="content">
            <div class="padder">
                <?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>
    
                <?php do_action( 'bp_before_group_plugin_template' ); ?>
    
                <div id="item-header">
                    <?php locate_template( array( 'groups/single/group-header.php' ), true ); ?>
                </div><!-- #item-header -->
    
                <div id="item-nav">
                    <div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
                        <ul>
                            <?php bp_get_options_nav(); ?>
    
                            <?php do_action( 'bp_group_plugin_options_nav' ); ?>
                        </ul>
                    </div>
                </div><!-- #item-nav -->
    
                <div id="item-body">
    
                    <?php do_action( 'bp_before_group_body' ); ?>
    
                    <?php do_action( 'bp_template_content' ); ?>
    
                    <?php do_action( 'bp_after_group_body' ); ?>
                </div><!-- #item-body -->
    
                <?php do_action( 'bp_after_group_plugin_template' ); ?>
    
                <?php endwhile; endif; ?>
    
            </div><!-- .padder -->
        </div><!-- #content -->

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