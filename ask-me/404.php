<?php get_header();?>
	<section class="container main-content">
		<div class="row">
			<div class="col-md-12">
				<div class="error_404">
					<div>
						<h2><?php _e("404","vbegy")?></h2>
						<h3><?php _e("Opps! Page Not Found","vbegy")?></h3>
					</div>
					<div class="clearfix"></div><br>
					<a href="<?php echo esc_url(home_url('/'));?>" class="button large color margin_0"><?php _e("Home Page","vbegy")?></a>
					<div class="gap"></div>
				</div>
			</div><!-- End main -->
		</div><!-- End row -->
	</section><!-- End container -->
	<?php
get_footer();?>