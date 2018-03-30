<?php 
global $qode_options;
global $qode_page_id;
$sidebar_id =  $qode_page_id;
$sidebar_classes = array();
if(isset($qode_options['sidebar_widget_border']) && $qode_options['sidebar_widget_border'] != "" && $qode_options['sidebar_widget_border'] == 'yes'){
	$sidebar_classes[] = 'enable_widget_borders';
}

if(isset($qode_options['sidebar_alignment']) && $qode_options['sidebar_alignment'] !== '') {
	$sidebar_classes[] = $qode_options['sidebar_alignment'];
}

?>
	<div class="column_inner">
		<aside class="sidebar <?php echo implode(' ', $sidebar_classes) ?>">
			<?php	
			$sidebar = "";

            $is_woocommerce=false;
            if(function_exists("is_woocommerce")) {
                $is_woocommerce = is_woocommerce();
                if($is_woocommerce){
					$sidebar_id = get_option('woocommerce_shop_page_id');
                }
            }
		
			if(get_post_meta($sidebar_id, 'qode_choose-sidebar', true) != ""){
				$sidebar = get_post_meta($sidebar_id, 'qode_choose-sidebar', true);
			}else{
				if (is_singular("post")) {
					if($qode_options['blog_single_sidebar_custom_display'] != ""){
						$sidebar = $qode_options['blog_single_sidebar_custom_display'];
					}else{
						$sidebar = "Sidebar";
					}
				} elseif (is_singular("portfolio_page") && $qode_options['portfolio_single_sidebar_custom_display'] != ""){
					$sidebar = $qode_options['portfolio_single_sidebar_custom_display'];
				} else {
					$sidebar = "Sidebar Page";
				}
			}
			?>
				
			<?php if(function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar)) : 
			endif;  ?>
		</aside>
	</div>
