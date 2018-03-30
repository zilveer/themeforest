<?php
/**
 * 
 * 404 template
 *
 */
global $rt_sidebar_location;
get_header(); ?>

<section class="content_block_background">
	<section class="content_block clearfix">
		<section id="page-404" class="content full" >		
			<div class="row"> 

		 		<div class="clearfix page-404">	
					
					<div class="box three first">
						<span class="icon-address"></span>
					</div>

					<div class="box two-three last">
						<h1>404</h1>

						<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'rt_theme'); ?></p>

						<?php get_template_part("searchform"); ?>
					</div>

				</div>


			</div>
		</section><!-- / end section .content -->   
	</section>
</section>
<?php get_footer(); ?>