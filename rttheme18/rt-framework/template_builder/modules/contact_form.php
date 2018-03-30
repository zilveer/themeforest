<?php
class rt_generate_contact_form_class extends RTThemePageLayoutOptions{
	#
	#	Contact Form Box
	#
	function rt_generate_contact_form($theGroupID,$theTemplateID,$options,$randomClass){

			$boxName       = __("Contact Form", "rt_theme_admin");
			$contet_type   = "contact_form";
			$theTemplateID = str_replace('_'.$contet_type,'',$theTemplateID);			
			$isNewBox      = (trim($randomClass)=="") ? false : true;
			$opacity       = 1;
			$layout        = "one passive_module" ;
			$position      = $isNewBox ? 'open minus' : 'plus';
			$data_position = 'display: none;';
			$text          = isset( $options['text'] ) ? $options['text'] : '' ;  			

			echo '<li class="ui-state-default '.$layout.'" style="opacity:'.$opacity.';">';
			echo '<div class="box_shadow"><div class="Itemholder"><div class="Itemheader"><h5>'.$boxName.'</h5>';
			echo $this->module_controls( $isNewBox );
			echo '</div><div class="ItemData" style="'.$data_position.'">';
			echo '<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'"><input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'"><input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">';

			$options = array (
						array(
							"desc" => __("You can use this template module to add a contactform to the page content.",'rt_theme_admin'),	 
							"hr" => "true",
							"type" => "info", 
						),
						 
						array("type" 	=> "table_start"),					

						array(
								"name" => __("Contactform Title",'rt_theme_admin'),
								"desc"      => __('Enter a title to be displayed above the contactform.','rt_theme_admin'),
								"id" => $theTemplateID.'_'.$theGroupID."_contact_form[title]",
								"value"=> @$options["title"], 
								"type" => "text"),

						array(
								"name" 		=> __("Description",'rt_theme_admin'),
								"desc"      => __('Enter a (short) description. Any valid html and shortcode are allowed.','rt_theme_admin'),
								"id" 		=> $theTemplateID.'_'.$theGroupID."_contact_form[text]",
								"value"		=> $text, 
								"type" 		=> "textarea" 
						),							
			
						array(
								"name" 	=> __("Contact Form Email",'rt_theme_admin'),
								"desc" 	=> __("The contactform will send the email to the emailaddress as set in this field.",'rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_contact_form[email]",
								"default"	=> get_option('admin_email'),
								"dont_save"=> true,
								"value"	=> @$options["email"], 
								"type" 	=> "text"),

						array("type" 	=> "td_col"),	 
			
						array(
								"name" 	=> __("3rd party contactform shortcode",'rt_theme_admin'),
								"desc" 	=> __('Insert in here any 3rd party contactform shortcode to replace the theme default contactform. There are great contactform plugins on the <a href="http://wordpress.org/extend/plugins/">WordPress plugins page</a> like <a href="http://wordpress.org/extend/plugins/contact-form-7/">Contact Form 7</a>.','rt_theme_admin'),
								"id" 	=> $theTemplateID.'_'.$theGroupID."_contact_form[shortcode]",
								"value"	=> @$options["shortcode"], 
								"hr" => "true",
								"type" 	=> "textarea"),	 

						array("type" 	=> "table_end"),	 
					);
					
			
			echo  $this->rt_generate_forms($options);
			
			echo  '</div></div></div></li>';
	}
}	
?>	