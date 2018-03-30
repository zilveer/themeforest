<?php 
	
	$canon_options = get_option('canon_options'); 
	$canon_options_post = get_option('canon_options_post'); 

	$autocomplete_string = $canon_options['autocomplete_words'];

	$autocomplete_explode_array = explode(",", $autocomplete_string);
	$autocomplete_array = array();

	foreach ($autocomplete_explode_array as $key => $value) {
		$value = trim($value);
		if (!empty($value)) { array_push($autocomplete_array, $value); }
	}

	wp_localize_script('canon-scripts','extDataAutocomplete', array(
		'autocompleteArray'			=> $autocomplete_array, 
	));        

?>


	<!-- SEARCH BOX -->

	    <!-- Start Outter Wrapper -->
	    <div class="outter-wrapper search-header-container" data-status="closed">
	        <!-- Start Main Navigation -->
	        <div class="wrapper">
	            <header class="clearfix">

	                <ul class="search_controls">
	                	<li class="search_control_search"><em class="fa fa-search"></em></li>
	                	<li class="search_control_close"><em class="fa fa-times"></em></li>
	                </ul>

	                <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	                    <input type="text" id="s" class="full" name="s" placeholder="<?php echo esc_attr($canon_options_post['search_box_text']); ?>" />
						<?php if (isset($_GET['lang'])) { printf("<input type='hidden' name='lang' value='%s' />", esc_attr($_GET['lang'])); } ?>
	                </form>



	            </header>
	        </div>
	        <!-- End Main Navigation -->
	    </div>
	    <!-- End Outter Wrapper -->		        