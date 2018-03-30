<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package progression
 */

get_header(); ?>


<div id="page-title">		
	<div class="width-container">
		<?php if(function_exists('bcn_display')): ?><div id="bread-crumb"><?php bcn_display()?></div><?php endif; ?>
		<h1><?php _e( 'Oops! That page can&rsquo;t be found.', 'progression' ); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #page-title -->


<div id="main">

<div class="width-container">
	<p><?php _e( 'It looks like nothing was found at this location. Maybe try and search?', 'progression' ); ?></p>
			<div class="grid2column-progression">
				<?php get_search_form(); ?><br>
			</div>
	<div class="clearfix"></div>
</div>
<br><br>

<?php get_footer(); ?>