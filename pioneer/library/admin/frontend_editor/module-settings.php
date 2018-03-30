<div id="moduleselector">
	<div id="sortable_1" class="connectedSortable">	
	<script>
	
	jQuery(function($) {
	
	var panelstatus = readCookie('panelstatus');
	//alert(panelstatus);
			
	jQuery( "#moduleselector" ).dialog({
			autoOpen: false,
			title:"Drag and drop modules",
			show: "fade",
			hide: "fade",
			modal: false,
			width: 240,
			height: 760,
			position: [20,100],
			open: function (event, ui) {
                    jQuery('#moduleselector').css('overflow', 'hidden');
                },
             resizable:false
			
		});

		jQuery( "#openModuleSelector" ).click(function() {
			jQuery( "#moduleselector" ).dialog( "open" );
			return false;
		});
		
		
		
	});
	</script>


<?php
/* Page options - Page meta keys 
===========================================================*/
$pageorder = get_post_meta($post_id,'epic_pageorder',true);
$sortables_selected = $pageorder;
$sortables = getPageModules();

foreach($sortables as $sortable => $name ){

/* Check if modules are already added. Display only "free" modules */
$needle = strstr($sortables_selected, $sortable);		

if (!$needle) {
     $filename = TEMPLATEPATH.'/modules/'.$sortable.'.php';

	  if (file_exists($filename)) {
   		 include ($filename);
		} else {
    	  echo "The file $filename does not exist";
		}
     }
}
?>
	</div><!-- / Sortable -->	
</div>		