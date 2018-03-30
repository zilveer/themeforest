<?php
	include_once('wdmenus-init.php');
	include_once('wdmenus-admin.php');

/*########################################Custom Frontend########################################*/
/*
 * Walker for the Front End UberMenu
 */
class WD_Walker_Nav_Menu extends Walker_Nav_Menu{
	
	public $lv1_order;
	public $lv2_order;
	public $lv0_subcount;
	public $lv1_subcount;
	public $lv0_desc;
	public $lv1_desc;
	public $parent_mega_enable;
	public $parent_widecolumn;
	public $parent_sidebar;
	public $parent_sidebar_str;
	public $menu_config;
	public $parent_fullwidth;
	public $sum_column_count;
	
	function __construct() {
		//parent dunt have contruct method
		//parent::__construct();
		$wd_mega_menu_config = get_option(THEME_SLUG.'wd_mega_menu_config','');
		$wd_mega_menu_config_arr = unserialize($wd_mega_menu_config);
		if( is_array($wd_mega_menu_config_arr) && count($wd_mega_menu_config_arr) > 0 ){
			if ( !array_key_exists('area_number', $wd_mega_menu_config_arr) ) {
				$wd_mega_menu_config_arr['area_number'] = 1;
			}
			if ( !array_key_exists('thumbnail_width', $wd_mega_menu_config_arr) ) {
				$wd_mega_menu_config_arr['thumbnail_width'] = 16;
			}
			if ( !array_key_exists('thumbnail_height', $wd_mega_menu_config_arr) ) {
				$wd_mega_menu_config_arr['thumbnail_height'] = 16;
			}	
			if ( !array_key_exists('menu_text', $wd_mega_menu_config_arr) ) {
				$wd_mega_menu_config_arr['menu_text'] = 'Menu';
			}	
			if ( !array_key_exists('disabled_on_phone', $wd_mega_menu_config_arr) ) {
				$wd_mega_menu_config_arr['disabled_on_phone'] = 0;
			}			
		}else{
			$wd_mega_menu_config_arr = array(
				'area_number' 			=> 1
				,'thumbnail_width' 		=> 16
				,'thumbnail_height' 	=> 16
				,'menu_text' 			=> 'Menu'
				,'disabled_on_phone' 	=> 0
			);
		}
		$this->menu_config = $wd_mega_menu_config_arr;
    }	

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}

	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
	
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$wide_custom_color = get_post_meta( $item->ID, WD_MEGA_MENU.'_menu_item_wide_custom_color', true );
		$wide_style = (int) get_post_meta( $item->ID, WD_MEGA_MENU.'_menu_item_wide_style', true );
		$wide_column = (int) get_post_meta( $item->ID, WD_MEGA_MENU.'_menu_item_wide_column', true );
		$sub_column = (int) get_post_meta( $item->ID, WD_MEGA_MENU.'_menu_item_sub_column', true );
		$wide_thumbnail = get_post_meta( $item->ID, WD_MEGA_MENU.'_menu_item_thumbnail', true );		
		$wide_thumbnail_id = get_post_meta( $item->ID, WD_MEGA_MENU.'_menu_item_thumbnail_id', true );		
		$side_bar = get_post_meta( $item->ID, WD_MEGA_MENU.'_menu_item_sidebars', true );
		$aligh_right = (int) get_post_meta( $item->ID, WD_MEGA_MENU.'_menu-item-align-right', true );

		
		$click_icon_html = $prepend = $append = $inline_style = $_desc_sub_class = '';
		
		//if( $item->menu_order == 1 ){
		//	$output .= $indent . '<li class="menu-item-0 menu-item-level-0 menu-dropdown" id="wd-menu-item-dropdown" style="display:none;"><span class="menu-text">'.stripslashes(esc_attr($this->menu_config['menu_text'])).'</span><span class="menu-icon"></span></li>'; 
		//}
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'menu-item-level' . $depth;
		
		if( (int) $item->sub_count > 0 ){
			$classes[] = "have-child";
		}

		if($depth < 3){
			/************************ ADD CLASSES FOR WDMENU ************************/
			if($depth == 0 ){
				$this->parent_fullwidth = false;
				$this->sum_column_count = 0 ;
				if($wide_style == 1){
					$this->parent_mega_enable = true ;
					$this->parent_widecolumn = $wide_column ;
					$classes[] = "wd-mega-menu";
					$classes[] = "columns-{$wide_column}";
					if( $wide_column == 0 ){
						$classes[] = "fullwidth-menu";
						$this->parent_fullwidth = true;
					}
					if( $aligh_right == 1 ){
						$classes[] = "aligh-right";
					}
					$this->lv1_order = 0;
					if( strlen($wide_custom_color) > 0 ){
						$inline_style = "style=\"color:{$wide_custom_color}\"";
					}
					if(strlen($side_bar) > 0){
						$number_widget = wd_mega_sidebar_count($side_bar);
						$classes[] = "wd-mega-menu-sidebar sidebar-column-{$number_widget}";
						$this->parent_sidebar = true ;
					}else{
						$this->parent_sidebar = false ;
					}
				}else{
					$this->parent_mega_enable = false ;
				}
				
				$this->lv0_subcount = (int) $item->sub_count;

			}
			
			if( absint($this->menu_config['disabled_on_phone']) == 1 && wp_is_mobile() && WD_IS_MOBILE === true ){
				$this->parent_mega_enable = false ;
			}
			
			//if( strlen($item->description) > 0 && $this->parent_mega_enable == true ){
			if( strlen($item->description) > 0 ){
				if(	absint($this->menu_config['disabled_on_phone']) == 1 && WD_IS_MOBILE === true ){
					$_desc_sub_class = "hidden-phone";
				}
				$append = "{$indent}\t\t<span class=\"menu-desc-lv{$depth} {$_desc_sub_class}\">". esc_attr($item->description) ."</span>";
			}
			if( (int) $item->sub_count > 0 || ( $this->parent_mega_enable == true && strlen($side_bar) > 0 ) ){
				$click_icon_html = "{$indent}\t\t<span class=\"visible-xs menu-drop-icon drop-icon-lv{$depth}\"></span>";
				//$click_icon_html .= "{$indent}\t\t<span class=\"menu-close-icon close-icon-lv{$depth}\">X</span>";
			}			
			
			
			if($depth == 1 && $this->parent_mega_enable){
				if( $this->parent_fullwidth == true && $sub_column > 0){
					$classes[] = "col-sm-{$sub_column}";
					$this->sum_column_count = $this->sum_column_count + $sub_column;
				}
				$this->lv1_subcount = (int) $item->sub_count;
				$this->lv2_order = 0;
				$this->lv1_order = $this->lv1_order + 1; 
				if( strlen($wide_custom_color) > 0 ){
					$inline_style = "style=\"color:{$wide_custom_color}\"";
				}
				
				if(strlen($side_bar) > 0){
					$number_widget = wd_mega_sidebar_count($side_bar);
					$classes[] = "wd-mega-menu-sidebar sidebar-column-{$number_widget}";
				}
				
			}

			if($depth == 2 && $this->parent_mega_enable){
				$this->lv2_order = $this->lv2_order + 1; 
				if( strlen($wide_custom_color) > 0 ){
					$inline_style = "style=\"color:{$wide_custom_color}\"";
				}
			}		

			if( !$this->parent_mega_enable ){
				$classes[] = "wd-fly-menu";
			}	
			/************************ END ADD CLASSES FOR WDMENU ************************/
			
			/************************ ADD THUMB FOR WDMENU ************************/
			if( (int)$wide_thumbnail_id > 0 && $depth < 3){
				$thumb_html = wp_get_attachment_image( $wide_thumbnail_id, 'wd_menu_thumb',false,array(
					'class'	=> "icon_menu",
					'alt'   => trim(strip_tags( get_post_meta($wide_thumbnail_id, '_wp_attachment_image_alt', true) )),
				));
				//$thumb_html = print_thumbnail($wide_thumbnail,true,$item->title,$this->menu_config['thumbnail_width'],$this->menu_config['thumbnail_height'],'icon_menu',false);
			}else{
				$thumb_html = '';
			}
			/************************ END ADD THUMB FOR WDMENU ************************/
		
		}

		
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		// $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		// $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		// $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		// $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}		
		
		if( is_object($args) && isset($args->before) ){
			$item_output = $args->before;
		}else{
			$item_output = '';
		}
		
		$item_output .= "\n{$indent}\t<a". $attributes .'>';
		
		if( !isset($item->title) || strlen($item->title) <= 0 ){
			$item->title = $item->post_title;
		}

		/****************** ADD ON HTML **************/
		$title = "\n{$indent}\t\t<span {$inline_style}  class='menu-label-level-{$depth}'>" . apply_filters( 'the_title', $item->title, $item->ID ) . "</span>\n";
		$item_output.= $thumb_html ;
		
		if( is_object($args) && isset($args->link_before) && isset($args->link_after) ){
			$item_output.= $args->link_before . $prepend . $title . $append . $args->link_after ;
		}else{
			$item_output.=  $prepend . $title . $append  ;
		}
	    		
		
		/****************** END ADD ON HTML **************/
		
		$item_output .= "{$indent}\t</a>";
		$item_output .= "{$indent}\t{$click_icon_html}";
		
		if( is_object($args) && isset($args->after) ){
			$item_output .= $args->after;
		}
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}	
	
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		
		/**
			thu tu in nhu sau
			in child truoc ( neu co )
			in side bar ( neu co )
			in description cuoi cung ( neu co )
		
		**/
		//neu enable mega thi lam
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		if( $this->parent_mega_enable == true ){
			$parent_id = $item->menu_item_parent;
			$side_bar = get_post_meta( $item->ID, WD_MEGA_MENU.'_menu_item_sidebars', true );
			$parent_side_bar = get_post_meta( $parent_id, WD_MEGA_MENU.'_menu_item_sidebars', true );
			
			
			//lv 1 ,sidebar and no child
			///if( $depth == 1 && strlen($this->lv1_desc) > 0 && $this->lv1_subcount == 0 && strlen($side_bar) > 0 ){
			if( $depth == 1 && strlen($side_bar) > 0 && $this->lv1_subcount == 0 ){			
				$sidebar_str = '';
				$sidebar_str .= "{$indent}<li class=\"sidebar-" . ($depth-1). "\">\n" ;
				$class.= ' wpmega-widgetarea ss-colgroup-'.wd_mega_sidebar_count($side_bar);	
				$gooeyCenter = wd_mega_sidebar($side_bar);
				$sidebar_str .= '<div class="'.$class.'">';
				$sidebar_str .= $gooeyCenter;
				$sidebar_str .= '<div class="clear"></div>';	
				$sidebar_str .= '</div>';
				$sidebar_str .=  "{$indent}</li>\n";


				$output .= "{$indent}<ul class=\"sub-menu\">\n";
				$output .= $sidebar_str;
				$output .= "{$indent}</ul>\n";
				$output .= "{$indent}\t";
			}			
			
			//co sidebar o lv 0 hoac 1
			if( $depth < 3 && $depth > 0  && strlen($parent_side_bar) > 0 ){
				// neu co desc,in luon desc tiep theo,vi desc luon in cuoi cung
				if ( $this->lv0_subcount == $this->lv1_order && $depth == 1){
					if( strlen($parent_side_bar) > 0 ){
						$class = 'wpmega-nonlink';
						$class.= ' wpmega-widgetarea ss-colgroup-'.wd_mega_sidebar_count($parent_side_bar);	
						$this->parent_sidebar_str = '';
						$gooeyCenter = wd_mega_sidebar($parent_side_bar);
						$this->parent_sidebar_str .= '<div class="'.$class.'">';
						$this->parent_sidebar_str .= $gooeyCenter;
						$this->parent_sidebar_str .= '<div class="clear"></div>';	
						$this->parent_sidebar_str .= '</div>';
					}else{
						$this->parent_sidebar_str .= '';
					}

					$output .= "{$indent}</li>\n";
					$output .= "{$indent}<li class='mega-new-line'></li>\n";
					//$output .= "{$indent}<li class=\"sidebar-menu sidebar-" . ($depth). "\">\n" . $this->parent_sidebar_str . "{$indent}</li>\n"; 
					$output .= "{$indent}<li class=\"sidebar-menu sidebar-" . ($depth). "\">\n" . $this->parent_sidebar_str . "{$indent}\n"; 
					$output .= "{$indent}\t";
					$this->parent_sidebar_str = '';
				}			

				if ( $this->lv1_subcount == $this->lv2_order && $depth == 2){
					if( strlen($parent_side_bar) > 0 ){
						$class = 'wpmega-nonlink';
						$class.= ' wpmega-widgetarea ss-colgroup-'.wd_mega_sidebar_count($parent_side_bar);	
						$this->parent_sidebar_str = '';
						$gooeyCenter = wd_mega_sidebar($parent_side_bar);
						$this->parent_sidebar_str .= '<div class="'.$class.'">';
						$this->parent_sidebar_str .= $gooeyCenter;
						$this->parent_sidebar_str .= '<div class="clear"></div>';	
						$this->parent_sidebar_str .= '</div>';
					}else{
						$this->parent_sidebar_str .= '';
					}

					$output .= "{$indent}</li>\n";
					$output .= "{$indent}<li class='mega-new-line'></li>\n";
					//$output .= "{$indent}<li class=\"sidebar-menu sidebar-" . ($depth). "\">\n" . $this->parent_sidebar_str . "{$indent}</li>\n"; 
					$output .= "{$indent}<li class=\"sidebar-menu sidebar-" . ($depth). "\">\n" . $this->parent_sidebar_str . "{$indent}\n"; 
					$output .= "{$indent}\t";
					$this->parent_sidebar_str = '';
				}	

			}			
		

			
			if( ( $this->parent_widecolumn != 0 && ($this->lv1_order % $this->parent_widecolumn) == 0 ) && 
					$this->lv1_order != $this->lv0_subcount && $depth == 1 && $this->lv0_subcount > 0 ){
				$output .= "{$indent}</li>\n";
				$output .= "{$indent}<li class='mega-new-line'>";
			}
	
			if( $this->parent_widecolumn == 0 && $this->sum_column_count >= 12 && $depth == 1 && $this->lv0_subcount > 0 ){
				$this->sum_column_count = 0;
				$output .= "{$indent}</li>\n";
				$output .= "{$indent}<li class='mega-new-line'>";
			}
	

			
			if( $depth == 0 && $this->lv0_subcount == 0 ){
				if( $this->parent_sidebar == true ){
					$output .= "{$indent}<ul class=\"sub-menu\">\n";
					
					$class = 'wpmega-nonlink';
					$class.= ' wpmega-widgetarea ss-colgroup-'.wd_mega_sidebar_count($side_bar);	
					$sidebar_str = '';
					$gooeyCenter = wd_mega_sidebar($side_bar);
					$sidebar_str .= '<div class="'.$class.'">';
					$sidebar_str .= $gooeyCenter;
					$sidebar_str .= '<div class="clear"></div>';	
					$sidebar_str .= '</div>';
					$output .= "{$indent}<li class=\"sidebar-menu sidebar-" . ($depth). "\">\n" . $sidebar_str . "{$indent}</li>\n"; 


					$output .= "{$indent}</ul>\n";
					$output .= "{$indent}\t";
				}

			}

		
		}
		$output .= "\n{$indent}</li>\n";
	}
}



 

?>