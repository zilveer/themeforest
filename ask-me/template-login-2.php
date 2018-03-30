<?php ob_start();/* Template Name: Login 2 */
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
								<?php echo do_shortcode("[ask_login forget='false']");?>
							</div>
						</div><!-- End page-content -->
					</div><!-- End col-md-6 -->
					<div class="col-md-6">
						<div class="tabs-warp tabs-register-forget">
						    <ul class="tabs">
						        <li class="tab"><a href="#"><?php _e("Register Now","vbegy")?></a></li>
						        <li class="tab"><a href="#"><?php _e("Forget","vbegy")?></a></li>
						    </ul>
						    <div class="tab-inner-warp">
						    	<div class="tab-inner">
						    		<div class="form-style form-style-3">
						    			<?php echo do_shortcode("[ask_signup dark_button='dark_button']");?>
						    		</div>
						    	</div>
						    </div>
						    <div class="tab-inner-warp">
						    	<div class="tab-inner">
						    		<div class="form-style form-style-3">
						    			<?php echo do_shortcode("[ask_lost_pass dark_button='dark_button']");?>
						    		</div>
						    	</div>
						    </div>
						</div>
					</div><!-- End col-md-6 -->
				<?php endif;?>
			</div><!-- End row -->
		</div><!-- End login -->
	<?php endwhile; endif;
get_footer();?>