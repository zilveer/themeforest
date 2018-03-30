<hr class="top-dashed"> 

<div class="container">

	<div class="row clear">
		
		<?php get_template_part( 'section', 'title' ); ?>

	</div><!-- row -->

	<div class="row clear section-contact">

		<?php the_content(); ?>		

		<?php echo retro_mail_form_html(); ?>

		<?php if ( op_theme_opt( 'show-social' ) ) : ?>

			<div class="social-icons">

				<?php if ( op_theme_opt( 'social-label' ) ) : ?>

					<h5 class="section-title"><?php echo op_theme_opt( 'social-label' ) ?></h5>

					<hr>  

				<?php endif; ?>

				<?php echo retro_get_social_links(); ?>

			</div><!-- social-icons -->	

		<?php endif; ?>			

	</div><!-- row --> 

</div><!-- container -->

<hr class="bottom-dashed"> 