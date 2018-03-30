<?php
$prefix = "st_"; 
if($of_option[$prefix.'translate']){	
	$tr_filter = $of_option[$prefix.'tr_filter'];
	$tr_showall = $of_option[$prefix.'tr_showall'];
}else{			
	$tr_filter = __('Filter', 'spacing');	
	$tr_showall = __('Show All', 'spacing');	
}
?>

	<div id="portfolio-filters">    
          
        <ul id="filters" class="sorting-menu option-set clearfix" data-option-key="filter">
            <li class="sorting-title"><?php echo $tr_filter ?>:</li>
            <li><a href="#filter" data-option-value="*" class="selected"><?php echo $tr_showall ?></a></li>
            
            <?php portfolio_filters(); ?>
        </ul>
        
    </div>