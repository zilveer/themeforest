<?php
/**
 * Template Name: Dashboard
 */

get_header(); 
?>

	<?php // Get layout's data :
	$dashboard_drag_drop = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('dashboard_drag_drop') : ''; ?>

	<?php // Start the Loop.
	while ( have_posts() ) : the_post(); ?>

		<div id="left-content">

			<?php  //GET THEME HEADER CONTENT
			woffice_title(get_the_title()); ?> 	

			<!-- START THE CONTENT CONTAINER -->
			<div id="content-container">

				<!-- START CONTENT -->
				<div id="content">

					<?php
					//	<div class="box">
					//  	<div class="intern-padding">
					//	
					//		</div>
					//	</div>
					do_action('woffice_before_dashboard');
					?>
					
					<?php if ( is_active_sidebar( 'dashboard' ) && woffice_is_user_allowed() ) : ?>

						<?php do_action('woffice_before_dashboard_allowed'); ?>
						
						<div id="dashboard" class="<?php echo (is_user_logged_in() && $dashboard_drag_drop == "yep") ? 'is-draggie' : 'is-fixed'; ?>">
							<?php // LOAD THE WIDGETS
							$user_custom_widgets = get_user_meta(get_current_user_id(), 'woffice_dashboard_order', true);
							if(is_user_logged_in() && !empty($user_custom_widgets) && $dashboard_drag_drop == "yep") :
								woffice_dashboard_widgets($user_custom_widgets);
							else :
								dynamic_sidebar( 'dashboard' );
							endif;
							?>
						</div>

						<?php do_action('woffice_after_dashboard_allowed'); ?>
						
					<?php else: ?>

						<?php get_template_part( 'content', 'none' ); ?>

					<?php endif; ?>

					<?php do_action('woffice_after_dashboard'); ?>
					
				</div>
					
			</div><!-- END #content-container -->
		
			<?php woffice_scroll_top(); ?>

		</div><!-- END #left-content -->

	<?php // END THE LOOP 
	endwhile; ?>

<?php 
get_footer();


