<?php
/**
* Panel Fields Class.
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

class optionsFields{
	
	private $webfonts   = array("" => "Default");

	public function van_fields($field= array(),$type=""){
		if($type == "menu" ){
			if($field['type'] == 'open'){
				$section     = van_item_id($field['title']);
				echo  '<li><a href="javascript:;"><span class="'.$section.'"></span>'.$field['title'].'</a></li>';
			}

		}else{
			if($field['type'] != 'open' && $field['type'] != 'close'){
			        if(isset($field['itemstyle'])){
			        		if ( isset( $field['id'] ) ) {
			            		$openitem  = '<div class="van-panel-item"><div class="'.$field['id'].'"><h3 class="section-title">'.$field['title'].'</h3><div class="section-option" >';
			            		$closeitem = '</div><!-- .section-option --></div> <!-- .'.$field['id'].' --><div class="clear"></div></div><!-- .van-panel-item -->';
			            	}
			        }else{
			        		if ( isset( $field['id'] ) ) {
						$openitem  = '<div class="'.$field['id'].' panel-field" >';
						$closeitem = '<div class="clear"></div></div><!-- .'.$field['id'].' -->';
					}
			        }    
	    		}
			switch ($field['type']) {
				case 'open':
					$section     = van_item_id($field['title']);
					echo  '<div class="section" id="van-'.$section.'">';
				break;
				case 'close':
					echo '</div><!-- .section -->';
				break;
				case 'openitem':
					$itemid     = van_item_id($field['title']);
					echo '<div id="'.$itemid.'" class="van-panel-item">';
					echo '<h3 class="section-title">'.$field['title'].'</h3>';
					echo '<div class="section-option">';
				break;
				case 'closeitem':
					echo '</div><!-- .section-option --></div><!-- .van-panel-item -->';
				break;
				case 'upload':
					echo $openitem;
					if(isset($field['desc'])){ echo '<div class="van-panel-item-desc">'.$field['desc'].'</div><!-- .van-panel-item-desc -->';} 
					$this->van_upload($field);
					if(isset($field['help'])){echo '<span class="help" style="clear:both;display:block"><small>'.$field['help'].'</small></span>';}
					echo $closeitem;
				break;			
				case 'colorpicker':
					echo $openitem;
					if(isset($field['desc'])){ echo '<div class="van-panel-item-desc">'.$field['desc'].'</div><!-- .van-panel-item-desc -->';} 
					$this->van_colorpicker($field);
					if(isset($field['help'])){echo '<span class="help" style="clear:both;display:block"><small>'.$field['help'].'</small></span>';}
					echo $closeitem;
				break;
				case 'text':
					echo $openitem;
					if(isset($field['desc'])){ echo '<div class="van-panel-item-desc">'.$field['desc'].'</div><!-- .van-panel-item-desc -->';} 
					$this->van_text($field);
					if(isset($field['help'])){echo '<span class="help" style="clear:both;display:block"><small>'.$field['help'].'</small></span>';}
					echo $closeitem;
				break;
				case 'textarea':
					echo $openitem;
					if(isset($field['desc'])){ echo '<div class="van-panel-item-desc">'.$field['desc'].'</div><!-- .van-panel-item-desc -->';} 
					$this->van_textarea($field);
					if(isset($field['help'])){echo '<span class="help" style="clear:both;display:block !important; margin:0"><small>'.$field['help'].'</small></span>';}
					echo $closeitem;
				break;
				case 'select':
					echo $openitem;
					if(isset($field['desc'])){ echo '<div class="van-panel-item-desc">'.$field['desc'].'</div><!-- .van-panel-item-desc -->';} 
					$this->van_select($field);
					if(isset($field['help'])){echo '<span class="help" style="clear:both;display:block"><small>'.$field['help'].'</small></span>';}
					echo $closeitem;
				break;			
				case 'radio':
					echo $openitem;
					if(isset($field['desc'])){ echo '<div class="van-panel-item-desc">'.$field['desc'].'</div><!-- .van-panel-item-desc -->';} 
					$this->van_radio($field);
					if(isset($field['help'])){ echo '<span class="help" style="clear:both;display:block"><small>'.$field['help'].'</small></span>';}
					echo $closeitem;
				break;
				case 'checkbox':
					echo $openitem;
					if(isset($field['desc'])){ echo'<div class="van-panel-item-desc">'.$field['desc'].'</div><!-- .van-panel-item-desc -->';} 
					$this->van_checkbox($field);
					if(isset($field['help'])){echo '<span class="help" style="clear:both;display:block"><small>'.$field['help'].'</small></span>';}
					echo $closeitem;
				break;
				case 'radioimg':
					echo $openitem;
					if(isset($field['desc'])){ echo'<div class="van-panel-item-desc">'.$field['desc'].'</div><!-- .van-panel-item-desc -->';} 
					$this->van_radioimg($field);
					if(isset($field['help'])){echo '<span class="help" style="clear:both;display:block"><small>'.$field['help'].'</small></span>';}
					echo $closeitem;
				break;			
				case 'webfonts':
					echo $openitem;
					if(isset($field['desc'])){ echo'<div class="van-panel-item-desc">'.$field['desc'].'</div><!-- .van-panel-item-desc -->';} 
					$this->van_webfonts($field);
					if(isset($field['help'])){echo '<span class="help" style="clear:both;display:block"><small>'.$field['help'].'</small></span>';}
					echo $closeitem;
				break;
			}
		}
	}
	public function van_categories(){
		$categories = get_categories('hide_empty=0'); 
		$wp_cats = array();  
		foreach ($categories as $category_list ) {  
	       		$wp_cats[$category_list->cat_ID] = $category_list->cat_name;  
		}  
		return $wp_cats;
	}
	private function van_sidebars_list(){
		$sidebars_list = van_get_option("van_sidebars");
		return $sidebars_list;
	}
	private function van_current_value($id){
		return van_get_option($id);
	}
	private function van_upload($field){
		if( $this->van_current_value($field['id']) ){
			$preview_style = ''; 
       		}else{
       			$preview_style = 'style="display:none"';
       		}
       		echo '<div class="van-uploader"><input id="van_options['.$field['id'].']" name="van_options['.$field['id'].']" value="'.$this->van_current_value($field['id']).'" type="text"  class="uploader-patch"  size="55" ><input type="button" value="upload" class="van-btn upload-btn"><div class="uploader-preview" '.$preview_style.' ><div class="preview-inner"><img src="'.$this->van_current_value($field['id']).'" /><a class="img-delete" title="Delete"><span></span></a></div></div></div>';
        	}
	private function van_colorpicker($field){
	       $pickerid      = van_item_id($field['id']);
	        echo '<div id="'.$pickerid.'-picker" class="picker"><div style="background-color:'. $this->van_current_value($field['id']) .'"></div></div><input style="width:85px; margin-right:5px;"  name="van_options['.$field['id'].']" id="'.$pickerid.'-color" type="text" value="'. $this->van_current_value($field['id'])  .'" />';            
	        echo '<script type="text/javascript">jQuery("#'.$pickerid.'-picker").ColorPicker({color:"'. $this->van_current_value($field['id']) .'",onShow:function(colpkr){jQuery(colpkr).fadeIn(500);return false},onHide:function(colpkr){jQuery(colpkr).fadeOut(500);return false},onChange:function(hsb,hex,rgb){jQuery("#'.$pickerid.'-picker div").css("backgroundColor","#"+hex);jQuery("#'.$pickerid.'-color").val("#"+hex)}});</script>';
	}
	private function van_text($field){
	       if( $field['id'] == "add_sidebar" ){
	            echo '<div style="width:190px;display: inline-block;float: left;"><input type="text" placeholder="Enter sidebar name" name="'.$field['id'].'" id="'.$field['id'].'" value="" /><input id="addsidebar" type="button" class="van-btn" value="add" /></div><div class="sidebars-list">';
		            if($this->van_sidebars_list()){
		            	foreach($this->van_sidebars_list() as $sidebars){
		            		echo '<div class="sidebar-title">'.$sidebars.'<a class="del-sidebar"></a><input id="van_sidebars" name="van_options[van_sidebars][]" type="hidden" value="'.$sidebars.'" /></div><!-- sidebar-title -->';
		            	}
		            }  
	            echo "</div><!-- sidebars-list -->";      
	        }else{
	            if(  isset($field['smallinput']) ){ $inpusize = 'style="width:35px"'; }else{$inpusize = "";} 
	            if($field['id'] == "slider_tags" || isset($field['tags'])) {$inputid = $field['id']."_list"; }else{$inputid = $field['id'];}   
	            echo '<input type="text" '.$inpusize.' name="van_options['.$field['id'].']" id="'.$inputid.'" value="'.$this->van_current_value($field['id']).'" />';    
	            if($field['id'] == "slider_tags" || isset($field['tags'])){echo '<div class="tags-content">';$tags_list=get_tags('orderby=count&order=desc&number=50');foreach($tags_list as $tag){echo  '<a id="'.$field['id'].'" rel="'.$tag->name.'">'.$tag->name.'</a>';}echo '</div>';}
	        }		
	}
	private function van_textarea($field){
		if( $field['id'] == "export" ){
	            echo '<textarea rows="7">'.base64_encode( serialize( get_option("van_options") ) ).'</textarea>';
	         }elseif($field['id'] == "import"){
	            echo '<textarea rows="7" name="van_import"></textarea>';
	         }else{
	            echo '<textarea name="van_options['.$field['id'].']" id="'.$field['id'].'" rows="7">'.htmlspecialchars_decode($this->van_current_value($field['id'])).'</textarea>';   
	         }
	}
	private function van_select($field){
		echo '<div class="van-select"><select  name="van_options['.$field['id'].']" id="'.$field['id'].'"  >';
		if( isset($field["category"]) ){
			if( isset($field['emp_val']) ) {

				$empty_name = isset( $field["empty_name"] ) ? $field["empty_name"] : "None";
				echo '<option value="" >' . $empty_name . '</option>';
			}
			
			$wp_cats = $this->van_categories();
			foreach ($wp_cats as $value => $key) { 
				if($value == $this->van_current_value($field['id'])){
					$selected = 'selected="selected"';
				}else{ 
					$selected = '';
				}
				echo '<option value="'.$value.'" '.$selected.' >'.$key.'</option>';
			}
		}elseif(isset($field['sidebarslist'])){
			echo '<option value="">Default</option>';
			if($this->van_sidebars_list()){
				foreach($this->van_sidebars_list() as $val){
					if($val == $this->van_current_value($field['id'])){ $selected = 'selected';}else{$selected = '';}
					echo '<option value="'.$val.'" '.$selected.'>'.$val.'</option>';
				}
			}
		}else{
			foreach($field['opts'] as $key => $value){
				if($value == $this->van_current_value($field['id'])){ $selected = 'selected';}else{$selected = '';}
				echo '<option value="'.$value.'" '.$selected.'>'.$key.'</option>';
			}
		}
		echo '</select></div>';
	}
	private function van_radio($field){
		echo '<div style="float:left; width: 295px;">';
		foreach($field['opts'] as $key => $value){
			if($value == $this->van_current_value($field['id'])){
				$checked = 'checked';
			}else{ $checked = '';}
			echo '<p class="van-radio-rounded"><label><input class="van-radio" type="radio" id="' . van_item_id($field['id']) . '" name="van_options['.$field['id'].']" value="'.$value.'" '.$checked.'><span class="van-rounded"><span class="bull"></span></span>'.$key.'</label></p>';
		}
		echo '</div>';
	}
	private function van_checkbox($field){
	        $itemid = van_item_id($field['id']);
	        $checked = ( $this->van_current_value($field['id']) ) ? $checked = "checked=\"checked\"" : $checked = ""; 	
	        echo '<div class="switch-checkbox"><label for="' .  $itemid . '"  ><input id="' .  $itemid . '" name="van_options['.$field['id'].']" class="van-checkbox" type="checkbox" value="true"  '.$checked.'><span class="checkbox-container"><span class="on">YES</span><span class="switcher"></span><span class="off">NO</span></span></label></div>';
	}
	private function van_radioimg($field){
	        $itemid = van_item_id($field['id']);
	        echo '<div class="radio-img"><ul id="radioimg-'.$itemid.'" >';
	        foreach($field['opts'] as $key => $value){
			$checked = ( $this->van_current_value($field['id']) == $key) ? $checked = "checked=\"checked\"" : $checked = ""; 
			echo '<li><label for="'. $itemid .'-' . $key .'" class="radio-select"><input id="'. $itemid .'-' . $key .'" name="van_options['.$field['id'].']" type="radio" value="'.$key.'" '.$checked.'/><img src="'. $value . '" /> </label></li>';
	        }
	        echo '</ul></div>';

	}
	private function van_webfonts($field){
		require VAN_PANEL . "/webfonts-google.php";
		$decode = json_decode($google_api_fonts,  true);
		$webfonts = $this->webfonts;
		foreach ($decode['items'] as $key => $value) {
		    $font_family    = $decode['items'][$key]['family'];
		    $variants         = $decode['items'][$key]['variants'];
		    $font_name      =  str_replace(' ','+',$font_family);
		    $font_variants = implode(',',$variants );
		    $webfonts[$font_name.':'.$font_variants] = $font_family;
		}			
		// var's 
		$cur_value    = $this->van_current_value('typography');
		$item_value   = isset( $cur_value[$field['id']] ) ? $cur_value[$field['id']] : array('color'=>'', 'size'=>'', 'family'=>'', 'weight'=>'', 'style'=>'');
		$font_weight = array(""=>"","normal"=>"normal","bold"=>"bold","lighter"=>"lighter","bolder"=>"bolder","100"=>"100","200"=>"200","300"=>"300","400"=>"400","500"=>"500","600"=>"600","700"=>"700");
		$font_style   = array(""=>"","normal"=>"normal","italic"=>"italic","oblique"=>"oblique");

		//open table
		echo '<table width="100%" border="0" cellpadding="2" cellspacing="0"><tr><td>Font Color</td><td>Font Family</td><td>Font Size (px)</td><td>Font Weight</td><td>Font Style</td></tr><tr>';
		//color
		echo '<td><div id="'.van_item_id($field['id']).'-picker" class="picker"><div style="background-color:'.$item_value['color'].'"></div></div><input style="width:70px; margin-right:5px;"  name="van_options[typography]['.$field['id'].'][color]" id="'.van_item_id($field['id']).'-color" type="text" value="'.$item_value['color'].'" />';             
		echo '<script type="text/javascript">jQuery("#'.van_item_id($field['id']).'-picker").ColorPicker({color:"'.$item_value['color'].'",onShow:function(colpkr){jQuery(colpkr).fadeIn(500);return false},onHide:function(colpkr){jQuery(colpkr).fadeOut(500);return false},onChange:function(hsb,hex,rgb){jQuery("#'.van_item_id($field['id']).'-picker div").css("backgroundColor","#"+hex);jQuery("#'.van_item_id($field['id']).'-color").val("#"+hex)}});</script></td>';
		// font family
		echo '<td><select name="van_options[typography]['.$field['id'].'][family]">';
		foreach ($webfonts as $key => $value) {
		    	$selected    = ($item_value['family'] == $key) ? 'selected="selected"' : '';
		    	echo '<option value="'.$key.'"  '.$selected.' >'.$value.'</option>';
		}
		echo '</select></td>';
		// font size
		echo '<td><input type="text" style="width:45px;" name="van_options[typography]['.$field['id'].'][size]" value="'.$item_value['size'].'" ></td>';
		// font weight
		echo '<td><select name="van_options[typography]['.$field['id'].'][weight]" style="width:90px;">';
		foreach ($font_weight as $key => $value) {
		 	$selected    = ($item_value['weight'] == $key) ? 'selected="selected"' : '';
		 	echo '<option value="'.$key.'"  '.$selected.' >'.$value.'</option>';
		}
		echo '</select></td>';
		// font style
		echo '<td><select name="van_options[typography]['.$field['id'].'][style]" style="width:90px;">';
		foreach ($font_style as $key => $value) {
		 	$selected    = ($item_value['style'] == $key) ? 'selected="selected"' : '';
		 	echo '<option value="'.$key.'"  '.$selected.' >'.$value.'</option>';
		}
		echo '</select></td>';
		echo '</tr></table>';
	}
}