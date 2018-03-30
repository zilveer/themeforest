<?php
/**
 *  Single template page for portfolio - regular light
 * 
 * @package Toranj
 * @author owwwlab
 */
?>

<div id="main-content" class="dark-template"> 
	<div class="page-wrapper regular-page-dark">
		<div class="container">

			<!-- page title -->
			<h2 class="section-title double-title">
				<?php the_title(); ?>
			</h2>
			<!--/ page title -->


			<div class="row mb-large">
				
				<div class="col-md-9">
					<?php the_content(); ?>
				</div>
				<div class="col-md-3">
					<h3 class="bordered">Details</h3>
					<ul class="list-items">
						<?php owlab_portfolio_meta($owlabpfl_meta); ?>
					</ul>
					<div>
						<?php echo wpautop(array_key_exists('owlabpfl_side_des', $owlabpfl_meta) ? $owlabpfl_meta["owlabpfl_side_des"][0] : ''); ?>
					</div>
				</div>

			</div>

		

			<?php owlab_portfolio_regular_nav(); ?>
			<hr>
			<a class="back-to-top" href="#"></a>
		</div>
	</div>
</div>