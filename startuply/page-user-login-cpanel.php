<?php
/**
 * Template name: User login & control panel
 */

get_header(); ?>

<div id="main-content" class="registration">

		<?php
			if (is_user_logged_in()) { echo vivaco_login_forgot_form(); ?>

				<div id="user-control-panel" class="row">
					<div class="col col-xs-12">
						<?php include get_template_directory() . '/admin/index.php' ?>
					</div>
				</div>

		<?php } else { ?>
		
			<div class="vc_row-fluid window_height centered-content">
				<div class="container">
					<div class="vc_col-sm-12">
						<div class="light reg-page-header">
							<div id="reg_box" class="col-sm-4 col-sm-offset-4">
								<?php echo vivaco_login_forgot_form(); ?>
							</div>
						</div>	
					</div>	
				</div>	
			</div>
			
		<?php } ?>
	
</div>

<?php wp_footer(); ?>
