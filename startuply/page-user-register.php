<?php
/**
 * Template name: User registration
 */

get_header(); ?>

<div id="main-content" class="registration">
	<div class="vc_row-fluid window_height centered-content">
		<div class="container">
			<div class="vc_col-sm-12">
				<div class="light reg-page-header">

				<?php if (!is_user_logged_in()) { ?>

					<div class="section-wrap text-center">
						<h1 class="section-title">Get your <b>free</b> account now</h1>
						<p class="sub-hero-header heading-font" style="">free trial for 30 days!</p>
					</div>

				<?php } ?>

				</div>
			</div>

			<div id="reg_box" class="col-sm-4 col-sm-offset-4">
				<?php echo vivaco_register_form(); ?>
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
