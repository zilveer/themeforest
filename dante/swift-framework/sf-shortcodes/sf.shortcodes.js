/* ==================================================

Swift Framework Shortcode Panel jQuery Function

================================================== */

/////////////////////////////////////////////
// jQuery Show/Hide Option Functions
/////////////////////////////////////////////

// jQuery No Conflict
var $j = jQuery.noConflict();

// Shortcodes Function
(function($j) {

$j(document).ready(function() {
  
	// Setup the array of shortcode options
	$j.shortcode_select = {
		'0' : $j([]),
		'shortcode-buttons' : $j('#shortcode-buttons'),
		'shortcode-icons' : $j('#shortcode-icons'),
		'shortcode-iconbox' : $j('#shortcode-iconbox'),
		'shortcode-imagebanner' : $j('#shortcode-imagebanner'),
		'shortcode-social' : $j('#shortcode-social'),
		'shortcode-social-share' : $j('#shortcode-social-share'),
		'shortcode-typography' : $j('#shortcode-typography'),
		'shortcode-tooltip' : $j('#shortcode-tooltip'),
		'shortcode-modal' : $j('#shortcode-modal'),
		'shortcode-fwvideo' : $j('#shortcode-fwvideo'),
		'shortcode-responsivevis' : $j('#shortcode-responsivevis'),
		'shortcode-columns' : $j('#shortcode-columns'),
		'shortcode-progressbar' : $j('#shortcode-progressbar'),
		'shortcode-chart' : $j('#shortcode-chart'),
		'shortcode-counters' : $j('#shortcode-counters'),
		'shortcode-countdown' : $j('#shortcode-countdown'),
		'shortcode-tables' : $j('#shortcode-tables'),
		'shortcode-pricingtables' : $j('#shortcode-pricingtables'),
		'shortcode-labelledpricingtables' : $j('#shortcode-labelledpricingtables'),
		'shortcode-lists' : $j('#shortcode-lists')
	};

	// Hide each option section
	$j.each($j.shortcode_select, function() {
		this.css({ display: 'none' });
	});
	
	// Show the selected option section
	$j('#shortcode-select').change(function() {
		$j.each($j.shortcode_select, function() {
			this.css({ display: 'none' });
		});
		$j.shortcode_select[$j(this).val()].css({
			display: 'block'
		});
	});
	
    $j('.font-icon-grid').on('click', 'li', function() {
    	var selection = $j(this),
    		iconName = selection.find('i').attr('class');
    	    		
    	$j('.font-icon-grid li').removeClass('selected');
    	selection.addClass('selected');
    	selection.parent().parent().find('input').not('.search-icon-grid').val(iconName);
    });
	
	$j('.search-icon-grid').on('input', function(event){
				 		
		if( $j(this).val().length > 1 ) {
				 
			 var str = $j(this).val();
			 str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
   					 return letter.toUpperCase();
				});
				
			var txAux = str.toLowerCase();
							   
			$j('.font-icon-grid > li').find('span').each(function(){
					
				if ($j(this).html().indexOf(txAux) < 0)
					$j(this).parent().hide();
				else{
					$j(this).parent().show();
					
				}				
			});
												
			}else{
				
				$j('.font-icon-grid > li').show();
			}
			
	});
    
});

})($j);


/////////////////////////////////////////////
// Embed Shortcode Function
/////////////////////////////////////////////