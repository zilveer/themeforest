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
		reLayout<?php echo $_GET['id']; ?>();
	    $window.smartresize( reLayout<?php echo $_GET['id']; ?> );

	    $container.addClass('visible');
	    
	    $container.children('.wall_entry').children('.gallery_type').each(function(){
		    $j(this).addClass('fade-in');
	    });
	});
	
	function reLayout<?php echo $_GET['id']; ?>() {
		var columnCount = $j('#pp_wall_columns').val();
	
		if(jQuery.type(columnCount) === "undefined")
		{
			var columnCount = 4;
		}
		
		if(jQuery(window).width() < 480)
		{
			var columnCount = 1;
		}

	    masonryOpts = {
		  columnWidth: $container.width() / columnCount
		};
		
		$container.addClass('visible');

	    $container.isotope({
	      resizable: false, // disable resizing by default, we'll trigger it manually
	      itemSelector : '.wall_entry',
	      masonry: masonryOpts
	    }).isotope( 'reLayout' );

	}
});