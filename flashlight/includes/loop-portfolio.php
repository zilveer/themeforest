<?php
global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }

$loop_counter = 1;
// check if we got a page to display:
if (have_posts()) :

	$extraClass = 'first';
	$style = 'portfolio-entry-no-description';

	$showcaption = true;
	$hr_class = "hr";
	$grid = '';
	$image_size = 'portfolio';

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



	$container_id = "container-id-".$image_size."-".$container_id;


	echo "<div class='ajaxContainer' id=".$container_id."><div class='innerAjax'>";

	//iterate over the posts
	while (have_posts()) : the_post();

?>


		<div class='post-entry all_sort <?php echo $grid.' '.$extraClass.' '.$style; ?>'>

			<?php
			//get_feature image here
			$image = "";
 	 		$image = get_the_post_thumbnail( get_the_ID(), 'portfolio' );
 	 		if(empty($image))
 	 		{
				$attachments = avia_post_meta(get_the_ID(), 'slideshow');
				if(!empty($attachments))
				{
					$thumbid = $attachments[0][slideshow_image];
					$image =  wp_get_attachment_image( $thumbid, 'portfolio' );
                }
 	 		}

 	 		$output = "";
 	 		if($image)
 	 		{
 	 			$output =  "<a class='portfolio_image external-link' href='".get_permalink()."' rel='bookmark' title='".__('Permanent Link:','avia_framework')." ".get_the_title()."'>".$image."</a>";
 	 		}

 	 		if(post_password_required())
 	 		{
 	 			$output =  "<a class='portfolio_image external-link locked-link' href='".get_permalink()."' rel='bookmark' title='".__('Permanent Link:','avia_framework')." ".get_the_title()."'></a>";
 	 		}

 	 		echo $output;

 	 		//$showcaption

			if(!isset($avia_config['remove_portfolio_text']))
			{
				$title = "<a href='".get_permalink()."' rel='bookmark' title='".__('Permanent Link:','avia_framework')." ".get_the_title()."'>".get_the_title()."</a>";

				if(isset($avia_config['portfolio_title']) && $avia_config['portfolio_title'] == "no")
				{
					$title = get_the_title();
				}

				echo "<h1 class='post-title'>";
				echo $title;
				echo "</h1>";

				echo '<div class="entry-content">';

				if($avia_config['portfolio_columns'] == 1)
				{
					echo '<span class="portfolio-categories">';
					echo get_the_term_list(  get_the_ID(), 'portfolio_entries', '<strong>'.__('Categories','avia_framework').': </strong>', ', ','');
					echo '</span>';
				}

				the_excerpt();
				//echo '<a class="more-link" href="'. get_permalink().'">'.__('Read more  &rarr;','avia_framework').'</a>';
				echo "</div>";

			}
			else
			{
				$hr_class = 'hr hr_invisible';
			}

		?>
		<!-- end post-entry-->
		</div>

	<?php

	$loop_counter++;
	$extraClass = "";
	if($loop_counter > $avia_config['portfolio_columns'])
	{
		$loop_counter = 1;
		$extraClass = 'first';
		echo "<div class='hr_portfolio $hr_class'></div>";
	}


	endwhile;

	if($loop_counter != 1){ echo "<div class='hr hr_invisible'></div>"; }

	if(!isset($avia_config['remove_pagination'] ))
		echo avia_pagination();

	echo "</div></div>"; //close ajax container

	else:
?>

	<div class="entry">
		<h1 class='post-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
		<p><?php _e('Sorry, no posts matched your criteria', 'avia_framework'); ?></p>
	</div>
<?php




	endif;


?>