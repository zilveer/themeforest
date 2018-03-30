<?php
global $qode_options;

$portfolio_hide_categories = "no";
if(isset($qode_options['portfolio_hide_categories'])) {
	$portfolio_hide_categories = $qode_options['portfolio_hide_categories'];
}

$portfolio_categories = wp_get_post_terms(get_the_ID(),'portfolio_category');

if(is_array($portfolio_categories) && count($portfolio_categories) && $portfolio_hide_categories != "yes"){

	$portfolio_categories_array = array();
	foreach($portfolio_categories as $portfolio_category) {
		$portfolio_categories_array[] = $portfolio_category->name;
	}

	?>
	<div class="info portfolio_single_categories">
		<h6 class="info_section_title"><?php _e('Category ','qode'); ?></h6>
		<p>
			<span class="category">
			<?php echo implode(', ', $portfolio_categories_array); ?>
			</span> <!-- close span.category -->
		</p>
	</div> <!-- close div.info.portfolio-categories -->
<?php } ?>