<?php 
/**
 * Template Name: Default with Sidebar
 *
 *
 * @author owwwlab
 */
?>

<?php get_header(); ?>

<!--Page main wrapper-->
<div id="main-content" class="regular-page"> 
	<div class="page-wrapper">
		

		<div class="container">
			<div class="row">
				<div class="col-md-9">

					<?php if (ot_get_option('show_breadcrumbs','on') == 'on'): ?>
					<!-- breadcrumbs -->
					<ol class="breadcrumb">
						<?php if(function_exists('the_owlab_breadcrumbs')) the_owlab_breadcrumbs(); ?>
					</ol>
					<!--/ breadcrumbs -->
					<?php endif; ?>

					<?php while( have_posts() ) : the_post(); ?>
						<!-- page title -->	
						<h2 class="section-title double-title">
							<?php the_title(); ?>
						</h2>
						<!--/ page title -->
						<?php the_content(); ?>
					<?php endwhile; ?>
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div>
			</div>
		</div>
			


	</div>
</div>
<!--/Page main wrapper-->

<?php get_footer(); ?>