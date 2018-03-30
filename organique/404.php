<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="page-not-found  push-down-30">
				<div class="page-not-found__background">
					<img src="<?php echo get_template_directory_uri() . '/assets/images/404.png'; ?>" alt="<?php _e( 'Error 404' , 'organique_wp' ); ?>" width="217" height="222" />
				</div>
				<h1><span class="light">Error.</span> Looks Like Something Went Wrong!</h1>
				<hr class="divider">
				<p class="page-not-found__text">
					<?php _e( 'Looks like something went wrong! The page you were looking for is not here.' , 'organique_wp' ); ?><br />
					<?php printf( _x( 'Go %sHome%s or try to search:', '%s is for the link to home page, wrap the word Home in two %s' , 'organique_wp' ), '<a href="' . site_url() . '">', '</a>' ); ?>
				</p>
				<div class="row">
					<div class="col-xs-12  col-sm-offset-3  col-sm-6  col-md-offset-4  col-md-4  push-down-30">
						<?php echo get_search_form(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>