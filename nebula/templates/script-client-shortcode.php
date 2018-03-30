<?php 
header("content-type: application/x-javascript"); 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
?>

$j(document).ready(function() {
	var $window = jQuery(window);
  
	// cache container
	var $container = jQuery('#<?php echo $_GET['id']; ?>');
	
	// start up isotope with default settings
	$container.imagesLoaded( function(){
		reClientLayout();
	    $window.smartresize( reClientLayout );

	    $container.addClass('visible');
	});
	
	jQuery('.client_content').tipsy({fade: true, gravity: 's'});
	
	$container.waypoint(function(direction) {
		$container.children('.wall_entry').children('.gallery_type').each(function(){
		    $j(this).addClass('fade-in');
	    });
	
		$j(this).addClass('animationClass', direction === 'down');
	} , { offset: '50%' });
	
	function reClientLayout() {
		var $container = jQuery('#<?php echo $_GET['id']; ?>');
	
		if($container.data('columns') != "undefined")
		{
			var columnCount = $container.data('columns');
		}
		else
		{
	    	var columnCount = $j('#pp_wall_columns').val();
	    }
	    
	    if(jQuery.type(columnCount) === "undefined")
		{
			var columnCount = 3;
		}

	    masonryOpts = {
		  columnWidth: $container.width() / columnCount
		};

	    $container.isotope({
	      resizable: false,
	      itemSelector : '.wall_entry',
	      masonry: masonryOpts
	    }).isotope();

	}
});