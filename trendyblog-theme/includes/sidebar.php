<?php
	wp_reset_query();
	//fixed menu
	$stickyMenu = df_get_option(THEME_NAME."_stickyMenu");

	$sidebar = get_post_meta( DF_page_ID(), "_".THEME_NAME.'_sidebar_select', true );

	if(is_category()) {
		$sidebar = df_get_custom_option( get_cat_id( single_cat_title("",false) ), 'sidebar_select', false );
	} elseif(is_tax()){
		$sidebar = df_get_custom_option( get_queried_object()->term_id, 'sidebar_select', false );
	}
	
	if($sidebar=='' && function_exists('is_woocommerce') && is_woocommerce()) {
		$sidebar = 'df_woocommerce';
	}
	if($sidebar=='' && function_exists("is_bbpress") && is_bbpress()) {
		$sidebar = 'df_bbpress';
	}

	if($sidebar=='' && function_exists("is_buddypress") && is_buddypress()) {
		$sidebar = 'df_buddypress';
	}
	

	if ( $sidebar=='' || is_search()) {
		$sidebar='default';
	}	
	
	if($sidebar!="off") {

		$marginTop = 30;

		if($stickyMenu=="on") {
			$marginTop = $marginTop+70;
		}

		if ( is_admin_bar_showing() ) {
		    $marginTop = $marginTop+30;
		}
?>
	
    <!-- Sidebar -->
    <div class="col col_3_of_12 sidebar sidebar_area" data-top="<?php echo intval($marginTop);?>">

	
		    <div class="theiaStickySidebar">

				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?>
				<?php endif; ?>

		    </div>
	  


	<!-- END sidebar -->
	</div>
<?php }  ?>
<?php wp_reset_query();  ?>