<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$DF_builder = new DF_home_builder; 
	//get block data
	$dataArray = $DF_builder->get_data(); 
	$sliderSet = $DF_builder->sliderSet(); 

?>

<!-- BEGIN .row -->
<div class="row">
<?php

	if(isset($dataArray[0]->columns)) {
		$col = $dataArray[0]->columns;
	} elseif(isset($dataArray[0]->layoutColumns)) {
		$col = $dataArray[0]->layoutColumns;
	}
	if(isset($dataArray[0]->row)) {
		$row = $dataArray[0]->row;
	} else {
		$row = false;
	}

	if ((strpos($row,'homepageLayout') !== false)) { 
		$layout = true;
	} else {
		$layout = false;
	}

	$counter = 1;

 	//foreach row columns
	foreach ($col as $columns) {

		if(isset($columns->columnID)) { 
			$colID = $columns->columnID; 
		} elseif(isset($columns->layoutID)) { 
			$colID = $columns->layoutID;
		}

		$colID = filter_var($colID, FILTER_SANITIZE_NUMBER_INT);
		if($layout == true && ($colID == "3" || $colID == "2")) {
			if($colID == "3") {
				$class = "sidebar";
			} elseif($colID == "2") {
				$class = "sidebar-small";
			}
		} elseif($layout == true) {
			if(isset($double) && $double==true) {
				$class = "main-content-double";
			} else {
				$class = "main-content";
			}
		} else {
			$class = false;
		}
?>
	<div class="col col_<?php echo esc_attr__($colID);?>_of_12 <?php echo esc_attr__($class); if(isset($columns->layoutID)) { echo " ".esc_attr__($columns->layoutID); } ?>">
		<?php 
			if($sliderSet==false && ($class == "main-content" || $class == "main-content-double") && get_post_meta ( DF_page_id(), "_".THEME_NAME."_sliderStyle", true ) == "1") { 
				get_template_part(THEME_SLIDERS."main-slider");
				$DF_builder->sliderSet(true);
			}
		?>
		<?php
			if(!empty($columns->contentBlocks)) { 
				
				//foreach column blocks
				foreach ($columns->contentBlocks as $blocks) {

					if(isset($blocks->blocksContentName)) {
						$block = $blocks->blocksContentName;
						$DF_builder->$block($blocks,$columns->columnID);
					} else {
						$sidebar = $blocks->SidebarName;
						if(!$sidebar) { $sidebar = "default"; }
						echo '<div class="theiaStickySidebar">';
						if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) :
						endif;
						echo '</div>';
						echo "&nbsp;";
					}

				} 
			} else if(isset($columns->layoutRows)) {

				foreach ($columns->layoutRows as $layoutRows) {
					$DF_builder->columRows($layoutRows);
				}
			} else {
				echo "&nbsp;";
			}
		?>
	</div>
<?php $counter++; ?>
<?php } ?>
<!-- END .split-blocks -->
</div>