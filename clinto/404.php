<?php get_header(); ?>

<?php get_template_part( 'partials/primary-nav' ); ?>

<section class="container">

	<div class="row-fluid">
		<div class="span12 header" style="background-image:url(<?php echo get_blog_header_image(); ?>); ">
			<div class="carousel-caption span8 offset2">
				<h1>Oops!</h1>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="offset2 span8 entry">

			<!-- Article -->
			<article>
				<?php echo bootstrapwp_breadcrumbs(); ?>
				<hr class="sexy_line">

				<h1 class="post-title"><?php _e( 'Sorry, nothing to display.', 'spritz' ); ?></h1>
				<p class="center"><?php _e( 'You are looking for an empty page. We are sorry for the inconvenience.', 'spritz' ); ?></p>

				<!-- Searchform -->
				<div class="we center">
					<form method="get" class="" action="<?php echo home_url(); ?>" >
						<input id="s" type="text" name="s" onfocus="if(this.value==''){this.value=''};" 
						onblur="if(this.value==''){this.value=''};" value="" class="center search-query input-large"  placeholder="<?php echo esc_attr( __( 'Search', 'spritz' ) ) ?>">
					</form>
					<p class="center"><a href="/"><?php _e( 'Return to home', 'spritz' ); ?></a></p>
				</div>
				<!-- /Searchform -->

				<hr class="sexy_line">
			</article>
			<!-- /Article -->

		</div>
	</div>

</section>

<?php get_footer(); ?>