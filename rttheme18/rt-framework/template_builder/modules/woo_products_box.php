<?php
class rt_generate_woo_products_box_class extends RTThemePageLayoutOptions{
	#
	#	WooCommerce Box
	#	
	function rt_generate_woo_products_box($theGroupID,$theTemplateID,$options,$randomClass){
	   
			$boxName       = __("WooCommerce Products", "rt_theme_admin");
			$contet_type   = "woo_products_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox      = (trim($randomClass)=="") ? false : true;			
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus' : 'plus'	;
			$data_position = 'display: none;' ; 
			$item_width    = $isNewBox ? '' : $options['item_width'] ; 
			$pagination    = isset( $options['pagination'] ) ? $options['pagination'] : ""; 			
			$categories    = isset( $options['categories'] ) ? $options['categories'] : ""; 
			$list_orderby  = $isNewBox ? '' : $options['list_orderby'];
			$list_order    = $isNewBox ? '' : $options['list_order'];
			$item_per_page = $isNewBox ? '' : $options['item_per_page']; 
		
			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

			$options = array (
					
					array(
							   "desc" => __("This module displays WooCommerce products following the settings below.",'rt_theme_admin'),	 
							   "hr" => "true",
							   "type" => "info", 
					),
					
					array(	"type" => "table_start" ),		
 

					array(
							"name" 	=> __("Select a WooCommerce Product Category",'rt_theme_admin'),
							"desc" 	=> __("You need to select a woocommerce product category from the list below. ",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_woo_products_box[categories]",
							"options" => RTTheme::rt_get_woo_product_categories(),
							"purpose" => "sidebar",
							"type"	=> "select",
							"class"	=> $randomClass,
							"default"	=> $categories,							
							"value"	=>$categories,),
					
					array(
							"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 	=> __("Select and set the sorting order for the woocommerce products within the product list by this parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_woo_products_box[list_orderby]", 
							"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),					
							"value"	=> $list_orderby,
							"default"	=> "date",
							"dont_save" => true,
							"type" 	=> "select"),
			
					array(
							"name" 	=> __("Order",'rt_theme_admin'),
							"desc" 	=> __("Select and set the ascending or descending order for the ORDERBY parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_woo_products_box[list_order]", 
							"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"	=> $list_order,
							"default"	=> "DESC",
							"dont_save" => true, 				
							"type" 	=> "select"),
					
					array(	"type" => "td_col" ),	

					array(
						"name" 	=> __("Amount of products",'rt_theme_admin'),
						"desc"	=> __("Set the amount of products to be displayed within this module box.",'rt_theme_admin'),
						"id" 	=> $theTemplateID.'_'.$theGroupID."_woo_products_box[item_per_page]",
						"min"	=> "1",
						"max"	=> "200",
						"class"	=> $randomClass,
						"value"	=> $item_per_page,
						"default"	=> "9",
						"dont_save" => true, 
						"type" 	=> "rangeinput"),
			
					array(
						"name" 	=> __("Content Layout",'rt_theme_admin'),
						"desc"  => __('Select and set the column layout for the listed products.','rt_theme_admin'),
						"id" => $theTemplateID.'_'.$theGroupID."_woo_products_box[item_width]",
						"options" =>	array(
											5 => "1/5", 
											4 => "1/4",
											3 => "1/3",
											2 => "1/2",
											1 => "1/1"									
									),
						"default"=>"1",
						"value"=>$item_width, 
						"type" => "select"), 
									
	
					array(	"type" => "table_end" ),	

					);
						
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';		
	}
}
?>	