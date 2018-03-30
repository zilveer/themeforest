<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	$post_type = get_post_type();

	//sidebars
	$sidebar = get_post_meta ( DF_page_ID(), "_".THEME_NAME."_sidebar_select", true ); 
	$sidebarPosition = get_post_meta ( DF_page_ID(), "_".THEME_NAME."_sidebar_position", true ); 

	if(is_category()) {
		$catID = get_cat_id( single_cat_title("",false) );
		//sidebars
		$sidebar = df_get_custom_option ( $catID, "sidebar_select", false ); 
		$sidebarPosition = df_get_custom_option ( $catID, "sidebar_position", false ); 
	} elseif(is_tax()){
		$sidebar = df_get_custom_option ( get_queried_object()->term_id, "sidebar_select", false );
		$sidebarPosition = df_get_custom_option ( get_queried_object()->term_id, "sidebar_position", false );
	}


	if(is_search()) {
		$sidebar = "default";
		$sidebarPosition = "right";
	}

	if ( $sidebar=='') {
		$sidebar='default';
	}		

	//default main sidebar position
	$defPosition = df_get_option(THEME_NAME."_sidebar_position");
	if (($sidebarPosition == '' && $defPosition != "custom") || ($sidebarPosition != '' && $defPosition != "custom")) {
		$sidebarPosition = $defPosition;
	} else if ((!$sidebarPosition && $defPosition == "custom") || ($sidebarPosition == '' && $defPosition == "custom")) {
		$sidebarPosition = "right";
	}
	



?>
				<?php if(!is_page_template('template-homepage.php')) { ?>
							</div><!-- End Main content -->
						<?php 
							if($sidebar!="off" && $sidebarPosition == "right") {
								get_template_part(THEME_INCLUDES."sidebar");
							}   


						?>
		            </div>
            	<?php } ?>
        </div>
    </section><!-- End Section -->


				