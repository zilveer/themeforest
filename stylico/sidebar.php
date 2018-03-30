<?php
/**
 * The Sidebar template containing the main widget area.
 */
 
if(is_page_template('page-leftsidebar.php'))
	$left_siderbar = true;

?>
		<aside id="main-sidebar" class="grid_4 <?php echo $left_siderbar ? 'alpha' : 'omega'; ?>" role="complementary">
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

                <div class="widget content-box">
                    <h3 class="widget-title"><?php _e( 'Widgetized Sidebar', 'stylico'); ?></h3>
                    <p>Put here your widgets</p>
                </div>

            <?php endif; ?>
		</aside>
