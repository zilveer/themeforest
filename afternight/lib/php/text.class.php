<?php
	class text{
		static function preview( $family = null , $size = null , $weight = null , $text = null ){
			$classes = 'dinamic-text-preview-' . time() . '-' . rand( 1000 , 9999 ) ;

			if( empty( $family ) && isset($_POST['family'])){ 
				$family = isset( $_POST['family'] ) ? $_POST['family'] : exit;
				$size 	= isset( $_POST['size'] ) ? $_POST['size'] : exit;
				$weight = isset( $_POST['weight'] ) ? $_POST['weight'] : exit;
				$text 	= isset( $_POST['text'] ) ? $_POST['text'] : exit;
				$ajax	= true;
			}else{  
				$ajax	= false;
			}

			$result = '';
			
				$result  = '<style>';
				if(strlen($family)){
					$latest_g_fonts = includes::get_latest_google_fonts();
		            $result .= '@import url("' . $latest_g_fonts[ str_replace('&v1','', str_replace( ' ' , '+' , $family )) ] . '");';
		        }
				$result .= 'h3.' . $classes . '{';
				if(strlen($family)){
					$result .= 'font-family:"' . str_replace( '+' , ' ' , rtrim( $family , '&v1' ) ) . '";';
				}
				$result .= 'font-size:' . $size . 'px;';
				$result .= 'font-weight:' . $weight . ';';
				$result .= '}';
				$result .= '</style>';
				
				$result .= '<h3 class="' . $classes . '">' . $text . '</h3>';
			

			if( $ajax ){ 
				echo $result;
				exit;
			}else{
				return $result;
			}
		}
		
		static function fields( $page , $prefix , $classes = '' , $text = 'Test text for preview' , $default = array( 'Francois+One&v1' , 24 , 'normal' ), $show_font_weight = true, $show_font_size = false ){
			if(strlen($default[0])){
				$family = strlen( options::get_value( $page , $prefix . '_font_family' ) ) ? options::get_value( $page , $prefix . '_font_family' ) : $default[0];
			}elseif( strlen( options::get_value( $page , $prefix . '_font_family' )) ){
				$family =  options::get_value( $page , $prefix . '_font_family' );
			}else{
				$family = '';	
			} 
			
			$size   = (int) options::get_value( $page , $prefix . '_font_size' ) > 0  ? options::get_value( $page , $prefix . '_font_size' ) : $default[1];
			$weight = strlen( options::get_value( $page , $prefix . '_font_weight' ) ) ? options::get_value( $page , $prefix . '_font_weight' ) : $default[2];
			
			$hide_size = '';
			$hide_weight = '';
			if(!$show_font_weight){
				$hide_weight = 'hidden';
			}

			if(!$show_font_size){
				$hide_size = 'hidden';
			}

			$action = "act.preview( extra.val('#" . $prefix . "_font_family') , extra.val('#" . $prefix . "_font_size') , extra.val('#" . $prefix . "_font_weight') , '" . $text . "' ,'#" . $prefix . '_font_preview' . "' );";
			options::$fields[ $page ][ $prefix . '_font_family'] 	= array('type' => 'st--select' , 'label' => __( 'Font Family' , 'cosmotheme' ) , 'value' => includes::fonts() , 'action' => $action  , 'id' => $prefix . '_font_family' , 'classes' => $classes );
			options::$fields[ $page ][ $prefix . '_font_size']      = array('type' => 'st--select' , 'label' => __( 'Font Size' , 'cosmotheme' ) , 'value' => options::get_digit_array( 80 ) , 'action' => $action  , 'id' => $prefix . '_font_size' ,  'classes' => $classes.' '.$hide_size );
			options::$fields[ $page ][ $prefix . '_font_weight']    = array('type' => 'st--select' , 'label' => __( 'Font Weight' , 'cosmotheme' ) , 'value' => array( 'normal' => 'Normal' , 'bold' => 'Bold' ) , 'action' => $action  , 'id' => $prefix . '_font_weight' ,  'classes' => $classes.' '.$hide_weight );	
			
			if(strlen($default[0])){  
				options::$fields[ $page ][ $prefix . '_text_preview']   = array('type' => 'st--preview'  , 'label' => __( 'Preview Text' , 'cosmotheme' ) , 'content' => text::preview( $family  , $size , $weight  , $text ) , 'classes' => $classes , 'cid' => $prefix . '_font_preview' );
			}else{ 
				options::$fields[ $page ][ $prefix . '_text_preview']   = array('type' => 'st--preview'  , 'label' => __( 'Preview Text' , 'cosmotheme' ) , 'content' => text::preview( $family  , $size , $weight  , $text ) , 'classes' => $classes , 'cid' => $prefix . '_font_preview' );
			} 
			if(strlen($default[0])){
				options::$default[ $page ][ $prefix . '_font_family'] 	= $default[0];
			}
			options::$default[ $page ][ $prefix . '_font_size'] 	= $default[1];
			options::$default[ $page ][ $prefix . '_font_weight'] 	= $default[2];
			
		}
		
		static function family( $page , $prefix ){
			return str_replace( '+' , ' ' , rtrim( options::get_value( $page , $prefix . '_font_family' )  , '&v1' ) );
		}
		
		static function size( $page , $prefix ){
			return options::get_value( $page , $prefix . '_font_size' );
		}
		
		static function weight( $page , $prefix ){
			return options::get_value( $page , $prefix . '_font_weight' );
		}
	}
?>