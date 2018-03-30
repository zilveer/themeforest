<?php
/**
 *  Single template page for portfolio - full light
 * 
 * @package Toranj
 * @author owwwlab
 */

global $allow_contained;
$allow_contained = 1;

?>

<div id="main-content" class=""> 
	<div class="page-wrapper portfolio-single-full regular-page full-width">
		

			<?php the_content(); ?>

		

			<?php owlab_portfolio_regular_nav('full-page'); ?>

	</div>
</div>