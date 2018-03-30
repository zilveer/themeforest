<?php ob_start();/* Template Name: Login */
get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<div class="login">
			<div class="row">
				<?php if (is_user_logged_in()) :?>
					<div class="col-md-12">
						<div class="page-content">
							<?php echo is_user_logged_in_data(vpanel_options("user_links"));?>
						</div>
					</div><!-- End col-md-12 -->
				<?php else:?>
					<div class="col-md-6">
						<div class="page-content">
							<h2><?php _e("Login","vbegy")?></h2>
							<div class="form-style form-style-3">
								<?php echo do_shortcode("[ask_login]");?>
							</div>
						</div><!-- End page-content -->
					</div><!-- End col-md-6 -->
					<div class="col-md-6">
						<div class="page-content">
							<h2><?php _e("Register Now","vbegy")?></h2>
							<p><?php echo stripslashes(vpanel_options("register_content"))?></p>
							<div class="button small color signup"><?php _e("Create an account","vbegy")?></div>
						</div><!-- End page-content -->
					</div><!-- End col-md-6 -->
				<?php endif;?>
			</div><!-- End row -->
		</div><!-- End login -->
	<?php endwhile; endif;
get_footer();?>