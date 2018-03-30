<?php 
/*
* The Loop for portfolio overview pages. Works in conjunction with the file template-portfolio.php and taxonomy-portfolio_entries.php
*/



global $avia_config;
$avia_config['avia_is_overview'] = true;

if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }

$loop_counter = 1;
// check if we got a page to display:
if (have_posts()) :
	
	$extraClass = 'first';
	$style = 'portfolio-entry-no-description';
	
	$grid = 'one_fourth';
	$image_size = 'portfolio_fixed';

	
	
	switch($avia_config['portfolio_columns'])
	{
		case "1": $grid = 'fullwidth';  $image_size = 'fullsize'; break;
		case "2": $grid = 'one_half';   break;
		case "3": $grid = 'one_third';  break;
		case "4": $grid = 'one_fourth'; break;
	}
	
	$avia_config['portfolio_columns_iteration'] = $avia_config['portfolio_columns'][0];
	if(!isset($avia_config['remove_portfolio_text'])) $style = 'portfolio-entry-description';
	
	
	$includeArray = "";
	if(isset($avia_config['new_query']['tax_query'][0]['terms'])) $includeArray = $avia_config['new_query']['tax_query'][0]['terms'];
	
	$args = array(
	
		'taxonomy'	=> 'portfolio_entries',
		'hide_empty'=> 0,
		'include'	=> $includeArray
	
	);

	$categories = get_categories($args);
	$container_id = "";
	
	
	if(!isset($avia_config['portfolio_sorting']) || $avia_config['portfolio_sorting'] == 'yes')
	{
		if(!empty($categories[0]))
		{
			$output = "<div class='sort_width_container ".$avia_config['portfolio_width']."' ><div id='js_sort_items'>";
	
			$hide = "hidden";
			if (isset($categories[1])){ $hide = ""; }
			
			$output .= "<div class='sort_by_cat $hide '>";
			$output .= "<a href='#' data-filter='all_sort' class='all_sort_button active_sort'>".__('All','avia_framework')."</a>";
			
			foreach($categories as $category)
			{
				$output .= "<span class='text-sep ".$category->category_nicename."_sort_sep'>/</span><a href='#' data-filter='".$category->category_nicename."_sort' class='".$category->category_nicename."_sort_button' >".$category->cat_name."</a>";
				$container_id .= $category->term_id;
			}
			
			$output .= "</div>";
			
	
			$output .= "</div></div>";
			
			echo $output;
		}
	}
	
	echo "<div class='preloading preloading-container ".$avia_config['portfolio_width']." '>";
	echo "<div class='portfolio-sort-container'>";	
	//iterate over the posts
	while (have_posts()) : the_post();	
	
	//get the categories for each post and create a string that serves as classes so the javascript can sort by those classes
	$sort_classes = "";
	$item_categories = get_the_terms( $id, 'portfolio_entries' );

	if(is_object($item_categories) || is_array($item_categories))
	{
		foreach ($item_categories as $cat)
		{
			$sort_classes .= $cat->slug.'_sort ';
		}
	}
			
?>

		
		<div data-ajax-id='<?php echo get_the_ID();?>' class='post-entry post-entry-<?php echo get_the_ID();?> flex_column all_sort no_margin <?php echo $sort_classes.' '.$grid.' '.$extraClass.' '.$style; ?>'>
			
			<div class='inner-entry'>										
				<?php 
										
					$forceSmall = true;
					$slider = new avia_slideshow(get_the_ID());
					$slider -> setImageSize($image_size);
					
					echo $slider->display($forceSmall);
					
					echo "<h1 class='post-title portfolio-title'>";
					echo "<a href='".get_permalink()."' rel='bookmark' title='".__('Permanent Link:','avia_framework')." ".get_the_title()."'>".get_the_title()."</a>";
					echo "</h1>";
				
				 
				?>		
			</div>		        
		<!-- end post-entry-->
		</div>
	
	<?php 

	$loop_counter++;
	$extraClass = "";

	if($loop_counter > $avia_config['portfolio_columns_iteration'])
	{
		$loop_counter = 1;
		$extraClass = 'first';
	}


	endwhile;
	
	echo "</div>";	// end portfolio-sort-container
	echo "</div>";	// end loading
	
	
	
	if(!isset($avia_config['remove_pagination'] ))
	{
		echo "<div class='hr hr_invisible'></div>";
		echo avia_pagination();	
	}	
	echo "<!-- end -->"; //dont remove
	else: 
?>	
	
	<div class="entry">
		<h1 class='post-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
		<p><?php _e('Sorry, no posts matched your criteria', 'avia_framework'); ?></p>
	</div>
<?php

	


	endif;
	
unset($avia_config['avia_is_overview']);		
?>