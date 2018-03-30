<?php 
$portfolio_categories = wp_get_post_terms(get_the_ID(),'project-type');

if(is_array($portfolio_categories) && count($portfolio_categories)){

    $portfolio_categories_array = array();
    foreach($portfolio_categories as $portfolio_category) {
        $portfolio_categories_array[] = $portfolio_category->name;
    } 
	?>
	
	<div class="new-project-category">
		<h3><?php esc_html_e('Category', 'larx'); ?></h3>
		<p>  
			<?php echo mb_strtolower( implode(', ', $portfolio_categories_array) ); ?>
		</p>
	</div>
		
<?php } ?>