<?php
/**
* MetaBoxes Fields Class.
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/


class vanMetaFields{

  	public function van_categories(){
		$categories = get_categories('hide_empty=0'); 
		$wp_cats = array();  
		foreach ($categories as $category_list ) {  
	       		$wp_cats[$category_list->cat_ID] = $category_list->cat_name;  
		}  
		return $wp_cats;
	}
	public function van_meta_fields( $field ){
		global $post;

		if ( isset( $field['id'] ) ) {
			$open              = '<div id="' . van_item_id($field['id']) . '-block" class="post-option-field">';
			$close             = '</div> <!-- ' . van_item_id($field['id']) . '-block -->';
		}
		$description    = ( isset($field['desc']) ) ? '<div class="van-panel-item-desc">'. $field['desc'] .'</div>' : "";
		$help               = ( isset($field['help']) ) ? '<div style="clear:both"><small>'. $field['help'] . '</small></div>' : '';
		$data               = get_post_custom($post->ID);
		$current_value = ( isset( $field['id'] ) && isset( $data[$field['id']][0] ) ) ? $data[$field['id']][0] : "";
	           
		switch ($field['type']) {
			case 'open':
				$item_id   = van_item_id($field['title']);
				echo '<div id="van-' . $item_id . '" class="van-panel-item post-option-item"><h4 class="section-title">' . $field['title'] . '</h4><div class="section-option">';
			break;
			case 'close':
				echo "</div></div><!-- .van-box-item -->";
			break;
			case 'text':
				echo  $open . $description;
				echo '<input type="text" name="' . $field['id'] . '"  value="' . $current_value . '" />';
				echo  $help . $close;
			break;
			case 'textarea':
				echo $open . $description;
				echo '<textarea name="'. $field['id'] .'" rows="7" >' . $current_value . '</textarea>';
				echo $help . $close;
			break;
			case 'select':
				echo $open . $description ; 
				echo '<select style="width:160px;" name="'. $field['id'] . '" >';
				if ( isset($field['sidebarslist']) ) {
					$sidebars_list = van_get_option('van_sidebars');
					echo '<option value="">Default</option>';
					if ($sidebars_list) {
						foreach($sidebars_list as $sidebars){
							$selected = ($sidebars == $current_value) ? $selected = "selected" : $selected = "";
							echo '<option value="' . $sidebars . '" '.  $selected .'>' . $sidebars . '</option>';
						}
					}
				}elseif ( isset($field["category"] ) ) {
					$wp_cats      = $this->van_categories();
					echo '<option value="" >None</option>';
					foreach ($wp_cats as $value => $key) {
						$selected = ( $value == $current_value ) ? 'selected' : $selected = '';
						echo '<option value="' . $value . '" '.  $selected .'>' . $key . '</option>';
					}
				}else{
					foreach($field['opts'] as $key => $value){
						$selected = ($value == $current_value) ? $selected = "selected" : $selected = "";
						echo '<option value="' . $value . '" '.  $selected .'>' . $key . '</field>';
					}
				}
				echo '</select>';
				echo $help . $close;
			break;
			case 'checkbox':
				echo $open . $description ; 
				$checked = (  $current_value  )  ? "checked=\"checked\"" : ""; 
				echo '<div class="switch-checkbox"><label for="' . $field['id'] . '"  ><input id="' . $field['id'] . '" name="' . $field['id']. '" class="van-checkbox" type="checkbox" value="true"  '.$checked.'><span class="checkbox-container"><span class="on">ON</span><span class="switcher"></span><span class="off">OFF</span></span></label></div>';
				echo  $help . $close;
			break;
			case 'radioimg':
				echo $open . $description; 
				$item_id = van_item_id($field['id']);
				echo '<div class="radio-img"><ul id="radioimg-'. $item_id  . '">';
				foreach($field['opts'] as $key => $value){
					$checked = ($current_value == $key) ? $checked = "checked=\"checked\"" : $checked = ""; 
					echo '<li><label for="'. $item_id .'-' . $key .'" class="radio-select"><input id="'. $item_id .'-' . $key .'" name="'. $field['id'] .'" type="radio" value="'. $key . '" '. $checked .' /><img src="'. $value . '" /></label></li>';
				}
				echo '</ul></div>';
				echo  $help . $close;
			break;
			case 'radio':
				echo $open . $description; 
				foreach($field['opts'] as $key => $value){
					$checked = ( $value == $current_value  )  ? "checked=\"checked\"" : ""; 
					echo '<p class="van-radio-rounded"><label><input class="van-radio" type="radio" name="'.$field['id'].'" value="' . $value . '" ' . $checked . '><span class="van-rounded"></span>' . $key . '</label></p>';
				}
				echo  $help . $close;
			break;
			case 'custom':
				if( isset($field['code']) ) {
					echo $field['code'];
				}
			break;
	        }
	}

}