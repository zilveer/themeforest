<?php
class rt_generate_blog_box_class extends RTThemePageLayoutOptions{
	#
	#	Blog Box
	#
	function rt_generate_blog_box($theGroupID,$theTemplateID,$options,$randomClass){
	  	   
			$boxName       = __("Blog Posts", "rt_theme_admin");
			$contet_type   = "blog_box";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);
			$isNewBox      = (trim($randomClass)=="") ? false : true;			
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus' : 'plus' ;
			$data_position = 'display: none;' ; 
			$categories    = $isNewBox ? '' :	$options['categories'];
			$pagination    = $isNewBox ? '' :	$options['pagination']; 
			$list_orderby  = $isNewBox ? '' :	$options['list_orderby'];
			$list_order    = $isNewBox ? '' :	$options['list_order'];
			$item_per_page = $isNewBox ? '' :	$options['item_per_page']; 
			$list_layout   = isset($options["list_layout"]) ? $options["list_layout"] : "";
			$list_style    = isset($options["list_style"]) ? $options["list_style"] : "";

			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';			

			$options = array (


					array(
							   "desc" => __("This module displays a bloglist following the settings below.",'rt_theme_admin'),	 
							   "hr" => "true",
							   "type" => "info", 
					),
					
					array( 
							"value"		=> "one", 						 
							"id" 		=> $theTemplateID.'_'.$theGroupID."_blog_box[layout]",
							"type" 		=> "hidden", 
					),
					
					array(  "type"		=> "table_start"),

					array(
							"name" 	=> __("Select Post Categories",'rt_theme_admin'),
							"desc" 	=> __("Select and set categories to filter (shorten) the amount of posts presented in the bloglist. If you don't select and set a category, this module will list all blogposts.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_blog_box[categories][]",
							"options" => RTTheme::rt_get_categories(),
							"purpose" => "sidebar",
							"type"	=> "selectmultiple",  
							"class"	=> $randomClass,
							"default"	=> $categories),
					
					array(
							"name"      => __("Listing Style",'rt_theme_admin'),
							"desc"      => __('Select and set one of the three available styles for listing the blog posts.','rt_theme_admin'),
							"id"        => $theTemplateID.'_'.$theGroupID."_blog_box[list_style]", 
							"options"   => array('style1'=>'Style One  ( Big Date Boxes )','style2'=>'Style Two ( Post Type Icons )','style3'=>'Style Three ( Classic ) '),					
							"value"     => $list_style,
							"default"   => "style1",
							"dont_save" => true,
							"type"      => "select"),

					array(
							"name"      => __("Listing Layout",'rt_theme_admin'),
							"desc"      => __('Select and set the column layout for listing the blog posts. (<strong>Note</strong> : when used in a column module which is f.e. set to a 1/5 column it is better to set the blog column layout to a 1/1 layout.)','rt_theme_admin'),
							"id"        => $theTemplateID.'_'.$theGroupID."_blog_box[list_layout]", 
							"options"   => array('one'=>'One Column','two'=>'Two Columns','three'=>'Three Columns','four'=>'Four Columns','five'=>'Five Columns'),					
							"value"     => $list_layout,
							"default"   => "one",
							"dont_save" => true,
							"type"      => "select"),

					array(  "type"		=> "td_col"),

					array(
							"name" 	=> __("OrderBy Parameter",'rt_theme_admin'),
							"desc" 	=> __("Select and set the sorting order for the blog posts within the bloglist by this parameter.",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_blog_box[list_orderby]", 
							"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),					
							"value"	=> $list_orderby,
							"default"	=> "date",
							"dont_save" => true,
							"type" 	=> "select"),
			
					array(
							"name" 	=> __("Order",'rt_theme_admin'),
							"desc" 	=> __("Select and set the ascending or descending order for the ORDERBY parameter",'rt_theme_admin'),
							"id" => $theTemplateID.'_'.$theGroupID."_blog_box[list_order]", 
							"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
							"value"	=> $list_order,
							"default"	=> "DESC",
							"dont_save" => true, 				
							"type" 	=> "select"),
	
					array(
							"name" 	=> __("Amount of blog post per page",'rt_theme_admin'),
							"desc"	=> __("Set the amount of posts to display at once per page.<br /><strong>Note</strong> : works in conjunction with the pagination settings.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_blog_box[item_per_page]",
							"min"	=> "1",
							"max"	=> "200",
							"class"	=> $randomClass,
							"value"	=> $item_per_page,
							"default"	=> "9",
							"dont_save" => true, 
							"type" 	=> "rangeinput"),

					array(
							"name" 	=> __("Pagination",'rt_theme_admin'),
							"check_desc"  => __("Enable (if checked) the pagination ability for the bloglist.",'rt_theme_admin'),
							"id" 	=> $theTemplateID.'_'.$theGroupID."_blog_box[pagination]",
							"type" 	=> "checkbox",
							"class"	=> $randomClass,
							"value"	=> $pagination,  
							"default"	=> "off",
							"std" 	=> "false"),

					array(  "type"		=> "table_end"),	
					
					);
						
						
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';	
	}
}	
?>	