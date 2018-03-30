<?php
/**
 * @package WordPress
 * @subpackage NorthVantage
 */

/* ------------------------------------
:: SIDEBAR CONFIG
------------------------------------ */
	
	global $NV_layout,	
	$NV_sidebar_one_borders,
	$NV_sidebar_two_borders,
	$NV_sidebar_one_select,
	$NV_sidebar_two_select;
	
	// If not singular use default config.
	
	if( !is_page() ) {
		if(!is_singular()) {
		 $NV_layout=of_get_option('arhlayout','layout_four'); 
		 $NV_sidebar_one_select = of_get_option('archcolone');
		 $NV_sidebar_two_select = of_get_option('archcoltwo');
		}
	}
	
	// Search
	if( is_search() )
	{
		$NV_layout = of_get_option('pagelayout','layout_four');	
	}
	
	// If is singular but no layout config, use default.
	if( is_page() ) {
		if( empty( $NV_layout ) ) $NV_layout = of_get_option('pagelayout'); 
		if( empty( $NV_sidebar_one_select ) ) $NV_sidebar_one_select = of_get_option('archcolone');
		if( empty( $NV_sidebar_two_select ) ) $NV_sidebar_two_select = of_get_option('archcoltwo');
	}
	
	
	// Check if BuddyPress page
	if (class_exists( 'BP_Core_User' ) ) {
		
		if(!bp_is_blog_page()) {
			$NV_layout = of_get_option('buddylayout'); 
			$NV_sidebar_one_select = of_get_option('buddycolone');
			$NV_sidebar_two_select = of_get_option('buddycoltwo');
		}
	}
	
	if( class_exists( 'bbPress' ) ) {
	
		if ( is_bbpress() ) {
			$NV_layout=of_get_option('buddylayout'); 
			$NV_sidebar_one_select = of_get_option('buddycolone');
			$NV_sidebar_two_select = of_get_option('buddycoltwo');
		}
	
	}
	
	if( class_exists( 'woocommerce' ) )
	{
		if( is_woocommerce() )
		{
			$NV_layout = of_get_option('woocomlayout');
			$NV_sidebar_one_select = of_get_option('woocomcolone');
			$NV_sidebar_two_select = of_get_option('woocomcoltwo');			
		}
	}	
	
	global $NV_layout_force;
	
	if($NV_layout_force) {
		$NV_layout="layout_four";
	}
	
	if( empty( $NV_sidebar_one_select ) ) $NV_sidebar_one_select ='Sidebar1'; 
	if( empty( $NV_sidebar_two_select ) ) $NV_sidebar_two_select ='Sidebar2'; 
	
	if(
		$NV_layout=='layout_three' || 
		$NV_layout=='layout_five' || 
		$NV_layout=='layout_six'
	) 	$NV_columns ='three'; else $NV_columns='four';
	
	if($NV_layout == "layout_six" || $NV_layout == "layout_two" || $NV_layout == "layout_three" ) { ?>
			
		<div class="sidebar columns side_one <?php echo $NV_columns .' '. $NV_layout; ?> <?php if($NV_sidebar_one_borders != "borderless") { echo 'border'; } ?>">
        	<div class="sidebar-shadow top"></div>
            <div class="sidebar-shadow mid">
                <ul>
                    <?php  if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($NV_sidebar_one_select)) : endif; ?>
                </ul>
            </div>
            <div class="sidebar-shadow bottom"></div>
		</div><!-- /sidebar-content -->
	
	
	<?php if($NV_layout == "layout_three") { ?>     
	
		<div class="sidebar columns side_two <?php echo $NV_columns .' '. $NV_layout; ?>  <?php if($NV_sidebar_two_borders != "borderless") { echo 'border'; } ?>">
        	<div class="sidebar-shadow top"></div>
            <div class="sidebar-shadow mid">
                <ul>
                    <?php  if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($NV_sidebar_two_select)) : endif; ?>
                </ul>
            </div>
            <div class="sidebar-shadow bottom"></div>
		</div><!-- /sidebar-content -->
	   
	<?php } 
	
	}
	
	if($NV_layout != "layout_one") { ?>
		
		<?php if($NV_layout != "layout_two" && $NV_layout != "layout_three" && $NV_layout != "layout_six" ) { ?>
	
	
		<div class="sidebar columns side_one <?php echo $NV_columns .' '. $NV_layout; ?>  <?php if($NV_sidebar_one_borders != "borderless") { echo 'border'; } ?> <?php if( $NV_layout=="layout_five" ) echo 'right'; elseif( $NV_layout=="layout_four" || $NV_layout=='') echo 'right last';  ?>">
        	<div class="sidebar-shadow top"></div>
            <div class="sidebar-shadow mid">
                <ul>
                    <?php  if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($NV_sidebar_one_select)) : endif; ?>
                </ul>
            </div>
            <div class="sidebar-shadow bottom"></div>
		</div><!-- /sidebar-content -->
	
		 
	<?php } 
	
	if($NV_layout == "layout_five" || $NV_layout == "layout_six") { ?>
	
		<div class="sidebar columns side_two <?php echo $NV_columns .' '. $NV_layout; ?>  <?php if($NV_sidebar_two_borders != "borderless") { echo 'border'; } ?> <?php if($NV_layout=="layout_five" || $NV_layout=='layout_six') echo 'right last';  ?>">
        	<div class="sidebar-shadow top"></div>
            <div class="sidebar-shadow mid">
                <ul>
                    <?php  if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($NV_sidebar_two_select)) : endif; ?>
                </ul>
            </div>
            <div class="sidebar-shadow bottom"></div>
		</div><!-- /sidebar-content -->    
		 
	<?php } 
	
	}