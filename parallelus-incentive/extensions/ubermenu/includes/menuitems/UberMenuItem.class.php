<?php


/**
 * Parent Class
 */
abstract class UberMenuItem{

	protected $type = 'unknown';
	protected $ID = 0;
	protected $source_id = 0;

	protected $output;
	protected $item;
	protected $depth;
	protected $args;
	protected $id;
	protected $walker;

	protected $settings;
	protected $submenu_advanced;
	protected $submenu_tag = 'ul';
	protected $submenu_classes = array();

	protected $item_classes = array( 0 => '' );	//Put in an empty entry to mimic the custom class used by real items, for when we have a dummy item
	protected $item_atts = array();

	protected $auto_child = '';
	protected $prev_auto_child = '';

	protected $alter_structure = false;


	protected $has_children = false;
	protected $submenu_type = false;
	protected $drop_sub = false;

	protected $is_dummy = false;

	//protected $branch_prefix = '';

	/*
	protected $detached = false;
	protected $detached_submenu = false;
	protected $parent_detached_context = 0;
	protected $passed_content = '';
	*/

	function __construct( &$output , &$item , $depth = 0, &$args = array() , $id = 0 , &$walker , $has_children = false ){
		$this->output 	= &$output;
		$this->item 	= &$item;
		$this->depth 	= $depth;
		$this->args 	= &$args;
		$this->id 		= $id;
		$this->walker 	= &$walker;
		$this->has_children = $has_children;

		$this->ID = $this->item->ID;
		//up( $this->ID );

		//Setup dummy
		if( isset( $this->item->is_dummy ) && $this->item->is_dummy ){
			$this->is_dummy = true;
		}

		//Setup settings
		$this->settings = $this->get_settings();
		
		
		$this->source_id = $this->item->db_id;

		if( isset( $this->item->object ) && ( $this->item->object == 'ubermenu-custom' ) ){
			//echo 'set source_id ' . $this->item->object_id;
			$this->source_id = $this->item->object_id;
		}


//uberp( $this->item->classes , 2 );

		$this->init();
		

		//Only check if necessary (Advanced submenu set to auto)	
		if( $this->getSetting( 'submenu_advanced' ) == 'auto' ){
			if( $this->item->classes == null ){
				//echo '<h3>[['.$this->item->title.']]</h3>';
				//up( $this->item );
			}
			if( is_array( $this->item->classes ) ){
				if( in_array( 'advanced-sub' , $this->item->classes ) ){
					$this->submenu_advanced = true;
					$this->submenu_tag = 'div';
				}
			}
		}
		else if( $this->getSetting( 'submenu_advanced' ) == 'enabled' ){
			$this->submenu_advanced = true;
			$this->submenu_tag = 'div';
		}


	}

	/* Allows subclasses to hook in */
	function init(){}

	function get_item(){
		return $this->item;
	}

	function get_branch_prefix(){
		return $this->branch_prefix;
	}

	function get_id(){
		return $this->ID;
	}

	function get_transient_key( $prefix ){
		return 'ubertk_'.$prefix.$this->walker->unique_path_key( $this->get_id() );
	}

	function get_depth(){
		return $this->depth;
	}

	function display_on(){

		if( $this->getSetting( 'disable_on_mobile' ) == 'on' ){
			if( wp_is_mobile() ){
				return false;
			}
		}
		
		if( $this->getSetting( 'disable_on_desktop' ) == 'on' ){
			if( !wp_is_mobile() ){
				return false;
			}
		}

		return true;
	}

	function disable_children(){
		$this->has_children = false;

		$_item = $this->item;
		if( ( $key = array_search( 'menu-item-has-children', $_item->classes ) ) !== false) {
			unset( $_item->classes[$key] );
		}
		//Possibly remove menu item parent/menu item ancestor classes as well
	}


	function create_reference( $source_id , &$children , $reference_index = '' ){

		if( $reference_index == '' ){
			$reference_index = '_ref_'.$source_id;
		}
		
		if( !$this->walker->feed_trash_collector( $reference_index ) ){

			if( isset( $children[$source_id] ) && !empty( $children[$source_id] ) ){
				$children[$reference_index] = $children[$source_id];

			}
		}

		return $reference_index;

	}


	/* If this item models a term, return its ID */
	function get_term_id(){
		return false;
	}
	/* If this item models a post, return its ID */
	function get_post_id(){
		return false;
	}

	function dynamic_alter( $tab_id , $source_id , $umitem , &$children ){
		return false;
	}

	function get_settings(){
		if( isset( $this->settings ) ) return $this->settings;
		
		$settings = get_post_meta( $this->item->ID, UBERMENU_MENU_ITEM_META_KEY , true );
		//Allow dummy settings to override source item settings
		if( $this->is_dummy && isset( $this->item->settings ) ){
			if( !is_array( $settings ) ) $settings = array();
			foreach( $this->item->settings as $key => $val ){
				$settings[$key] = $val;
			}
		}

		$settings = apply_filters( 'ubermenu_item_settings' , $settings , $this->ID );
		
		return $settings;
	}

	function get_menu_op( $op ){
		//Determine menu instance
		//$instance = 'main';		//TODO
		//$instance = $this->args[0]->uber_instance;
		
		$instance = $this->get_config_id();
		return ubermenu_op( $op , $instance );
	}

	function get_config_id(){
		return $this->args->uber_instance;
	}

	function alter_structure(){
		return $this->alter_structure;
	}
	function alter( &$children ){}

	function get_submenu_tag(){
		return $this->submenu_tag;
	}

	function pass_content( $content ){
		$this->passed_content.= $content;
	}

	function getAutoChild(){
		return $this->auto_child;
	}

	function getType(){
		return $this->type;
	}

	function getSetting( $key ){
		if( isset( $this->settings[$key] ) ){
			$val = $this->settings[$key];
		}
		else{ //} if( isset( $this->walker->setting_defaults[$key] ) ){
			$val = $this->walker->setting_defaults[$key];
		}
		return $val;
	}
	
	//1
	function start_el(){
		$this->output.= $this->get_start_el();
	}

	//4
	function end_el(){
		$this->output.= $this->get_end_el();
	}

	//2
	function start_lvl(){
		$this->output.= $this->get_submenu_wrap_start();
	}

	//3
	function end_lvl(){		
		$this->output.= $this->get_submenu_wrap_end();		
	}

	//Detached content
	
	function detach(){
		$this->detached_submenu = true;
		$this->walker->detach( $this->ID );
		//echo 'detached ' . $this->ID . '<br/>';
	}
	function undetach(){
		$this->detached_submenu = false;
		$this->walker->undetach();
	}
	function complete_detachment(){}	//do nothing by default



	abstract function get_start_el();

	function get_end_el(){
		$item_output = "</li>"; //<!-- end ".$this->item->ID."-->\n";
		return $item_output;
	}

	function get_submenu_type( $submenu_type = false ){

		if( !$this->has_children ) return false;

		//If already cached, don't reprocess
		if( $this->submenu_type ) return $this->submenu_type;
		
		//If not passed, grab setting
		if( !$submenu_type ) $submenu_type = $this->getSetting( 'submenu_type' );

		//echo $this->item->title . ' : '. $submenu_type ." : $this->depth <br/>";
		if( $submenu_type == 'auto' ){

			//$classes[] = 'ubermenu-submenu-type-auto';

			//figure it out
			if( $this->depth == 0 ){
				$submenu_type = 'mega';
			}
			else if( $this->depth >= 1 ){
				$parent = $this->walker->parent_item();
				if( $parent && $parent->type == 'row' ){
					$parent = $this->walker->grandparent_item(); 
				}
				//up( $parent );
				//echo 'Parent of '.$this->item->title . ' is ' . $parent->getSetting( 'submenu_type_calc' ) .'<br/>';
				$parent_submenu = $parent->getSetting( 'submenu_type_calc' );
//echo ' -- ' .$this->item->title . ' : ' . $parent_submenu . '<br/>';
				switch( $parent_submenu ){
					case 'mega':
					case 'block':
					case 'tab-content-panel':
					case 'toggles-content-panel':
						$submenu_type = 'stack';
						break;
					case 'flyout':
						$submenu_type = 'flyout';
						break;
					default:
						//inherit parent
						$submenu_type = $parent_submenu;
						break;
				}
				
			}
		}

		$this->submenu_type = $submenu_type;

		return $submenu_type;
	}

	function get_submenu_wrap_start(){

		//$this->classes = array();
		$classes = $this->submenu_classes;
		$classes[] = 'ubermenu-submenu';
		$classes[] = 'ubermenu-submenu-id-' . $this->item->ID;

		//Submenu Type
		$submenu_type = $this->getSetting( 'submenu_type' );
		//echo $this->item->title . ' : '. $submenu_type ." : $this->depth <br/>";
		
		if( $submenu_type == 'auto' ){
			$classes[] = 'ubermenu-submenu-type-auto';
			$submenu_type = $this->get_submenu_type( $submenu_type );
		}
		$this->settings['submenu_type_calc'] = $submenu_type;

		$classes[] = 'ubermenu-submenu-type-'.$submenu_type;


		if( in_array( $submenu_type , array( 'mega' , 'flyout' ) ) ){
			$this->drop_sub = true;
			$classes[] = 'ubermenu-submenu-drop';
		}
		

		//Mega menu submenu alignment
		if( $submenu_type == 'mega' ){
			$classes[] = 'ubermenu-submenu-align-' . $this->getSetting( 'submenu_position' );
		}
		else if( $submenu_type == 'flyout' ){
			$classes[] = 'ubermenu-submenu-align-' . $this->getSetting( 'flyout_submenu_position' );
		}

		//Autoclear
		$submenu_col_default = $this->getSetting( 'submenu_column_default' );
		if( $this->getSetting( 'submenu_column_autoclear' ) == 'on' && $submenu_col_default != 'auto' && $submenu_col_default != 'natural' ){
			$classes[] = 'ubermenu-autoclear';
		}

		//Padding
		if( $this->getSetting( 'submenu_padded' ) == 'on' ){
			$classes[] = 'ubermenu-submenu-padded';
		}

		//Background Image
		if( $this->getSetting( 'submenu_background_image' ) ){	//Not 'on', image URL
			$classes[] = 'ubermenu-submenu-bkg-img';
		}

		//Submenu Grid
		if( $this->getSetting( 'submenu_grid' ) == 'on' ){
			$classes[] = 'ubermenu-submenu-grid';
		}

		//Retractors
		$retractor_top = $this->drop_sub && ubermenu_display_retractors() && ( ubermenu_op( 'display_retractor_top' , $this->args->uber_instance ) == 'on' );
		if( $retractor_top ) $classes[] = 'ubermenu-submenu-retractor-top';

		//Close Button
		$close_button = $this->drop_sub && ( ubermenu_op( 'display_submenu_close_button' , $this->args->uber_instance ) == 'on' );
		if( $close_button ){
			if( $retractor_top ) $classes[] = 'ubermenu-submenu-retractor-top-2';
			else 				 $classes[] = 'ubermenu-submenu-retractor-top';
		}


		$class = 'class="'.implode( ' ' , $classes ).'"';


		//Inline styles
		$_styles = array();

		//Explicit width (should be moved)
		
		/*$submenu_width = $this->getSetting( 'submenu_width' );
		if( $submenu_width != '' ){
			if( is_numeric( $submenu_width ) ) $submenu_width.= 'px';
			$_styles['width'] = $submenu_width;
		}
		*/

		//Create inline styles string if necessary
		$styles = '';
		if( count( $_styles ) > 0 ){
			$styles.= 'style="';
			foreach( $_styles as $property => $val ){
				$styles.= "$property:$val;";
			}
			$styles.='"';
		}

		
		$item_output = "<$this->submenu_tag $class $styles>";


		//Retractor Top
		if( $retractor_top ){
			$retractor_tag = $this->submenu_tag == 'ul' ? 'li' : 'div';

			$retractor_label = ubermenu_op( 'retractor_label' , $this->args->uber_instance );
			if( !$retractor_label )	$retractor_label = __( 'Close' , 'ubermenu' );

			$item_output.= '<'.$retractor_tag.' class="ubermenu-retractor ubermenu-retractor-mobile"><i class="fa fa-times"></i> '.$retractor_label.'</'.$retractor_tag.'>';
		}

		//Close button
		if( $close_button ){
			$retractor_tag = $this->submenu_tag == 'ul' ? 'li' : 'div';
			$item_output.= '<'.$retractor_tag.' class="ubermenu-retractor ubermenu-retractor-desktop"><i class="fa fa-times"></i></'.$retractor_tag.'>';			
		}
		

		return $item_output;

	}
	function get_submenu_wrap_end(){

		$html = '';

		//Footer Content
		$footer_content = $this->getSetting( 'submenu_footer_content' );
		if( $footer_content ){
			$fc_tag = 'li';
			if( $this->submenu_tag != 'ul' ) $fc_tag = 'div';
			$html.= '<'.$fc_tag.' class="ubermenu-submenu-footer ubermenu-submenu-footer-id-'.$this->ID.'">'.$footer_content.'</'.$fc_tag.'>';
		}

		//Retractor Bottom
		if( $this->drop_sub && ubermenu_display_retractors() && ( ubermenu_op( 'display_retractor_bottom' , $this->args->uber_instance ) == 'on' ) ){
			$retractor_tag = $this->submenu_tag == 'ul' ? 'li' : 'div';
			
			$retractor_label = ubermenu_op( 'retractor_label' , $this->args->uber_instance );
			if( !$retractor_label )	$retractor_label = __( 'Close' , 'ubermenu' );

			$html.= '<'.$retractor_tag.' class="ubermenu-retractor ubermenu-retractor-mobile"><i class="fa fa-times"></i> '.$retractor_label.'</'.$retractor_tag.'>';
		}

		$html.= "</$this->submenu_tag>";

		return $html;
	}


	function getVirtualDepth(){
		return $this->depth;
	}




	function add_class_item_defaults(){
		//$this->item_classes = empty( $this->item->classes ) ? array() : (array) $this->item->classes;
		if( is_array( $this->item->classes ) ){
			$this->item_classes = array_merge( $this->item_classes , $this->item->classes );
		}
	}
	function add_class_id(){
		$this->item_classes[] = 'menu-item-' . $this->item->ID;
	}
	function prefix_classes(){
		//uberp( $this->item_classes );
		$k = 0;
		$found = false;
		foreach( $this->item_classes as $i => $class ){
			//if( $class == 'menu-item' ) $classes[$i] = 'ubermenu-item';
			
			//The first class is custom, so ignore it 
			//if( $k == 0 ){ $k++; continue; }

			//menu-item marks the first class we want to preix, so ignore everything before that
			if( !$found && $class == 'menu-item' ) $found = true;
			if( !$found ) continue;
			
			if( $class ){
				if( substr( $class , 0 , 4 ) == 'menu' ){
					$this->item_classes[$i] = 'uber'.$class;
				}
				else $this->item_classes[$i] = 'ubermenu-'.$class;
				//add to end if using both
			}
		}
	}
	function add_class_item_display(){

		$this->settings['item_display_calc'] = '';

		//Item Display
		if( $this->depth > 0 ){
			$item_display = $this->getSetting( 'item_display' );
			$this->item_classes[] = 'ubermenu-item-'.$item_display;

			//Determine auto
			if( $item_display == 'auto' ){
				
				$parent_type = $this->walker->parent_item()->getType();

				switch( $parent_type ){

					//For items inside a content panel, act like a mega sub
					case 'toggle_content_panel':
						$item_display = 'header';
						break;

					//For terms inside a content panel, look to the grandparent
					case 'dynamic_posts':
					case 'dynamic_terms':
						if( $this->walker->grandparent_item() ){
							if( $this->walker->grandparent_item()->getType() == 'toggle_content_panel' ){
								$item_display = 'header';
							}
							//echo '//'.$this->walker->grandparent_item()->getType().'//<br/>';
						}
						break;

					//case 'column':
					//	$item_display = 'normal';
					//	break;

				}

				//Still auto?
				if( $item_display == 'auto' ){

					$in_sub = $this->walker->parent_item()->getSetting('submenu_type_calc');

					switch( $in_sub ){

						case 'mega' :

							if( $this->depth == 1 ){
								$item_display = 'header';
							}
							else if( $this->depth > 1 && $this->walker->parent_item()->getVirtualDepth() == 1 ){
								$item_display = 'header';
							}
							else if( $this->walker->parent_item()->getType() == 'row' ){
								$item_display = 'header';
							}
							else if( $this->walker->parent_item()->getType() == 'menu_segment' &&
										$this->walker->grandparent_item()->getType() == 'row'){
								$item_display = 'header';
							}
							else if( $this->depth > 1 && $this->walker->grandparent_item()->getSetting('submenu_type_calc') == 'flyout' ){
								$item_display = 'header';
							}
							else{
								//For items that are in the submenu but yet undetermined
								if( $this->depth > 1 ){
									//If it's parent wasn't a header, but the sub of the parent was a mega, this should probably be a header
									if( $this->walker->parent_item()->getSetting( 'item_display_calc' ) != 'header' ){
										$item_display = 'header';
									}
								}
								else $item_display = 'normal';
							}
							break;

						case 'flyout':
							$item_display = 'normal';
							break;

						case 'stack':
							$item_display = 'normal';
							break;
						case 'block':
							$item_display = 'header';
							break;
						case 'tabs-group':
						case 'toggles-group':
							//Ignore, use 'ubermenu-toggle' instead
							$item_display = '';
							break;
						case 'tab-content-panel':
						case 'toggles-content-panel':
							$item_display = 'header';
							break;
						/*
						case 'dynamic-terms':
							$item_display = 'header';
							break;*/

						default:
							$item_display = 'unknown-['.$in_sub.']';
							break;

					}
				}

				if( $item_display ){
					$this->item_classes[] = 'ubermenu-item-'.$item_display;
					$this->settings['item_display_calc'] = $item_display;
				}
			}
		}
	}

	function add_class_level(){
		$this->item_classes[] = 'ubermenu-item-level-'.$this->getVirtualDepth(); //$this->depth;
	}

	function add_class_layout_columns(){

		if( $this->depth > 0 ){
			$parent_submenu_type = $this->walker->parent_item()->getSetting('submenu_type_calc');
			if( $parent_submenu_type == 'flyout' ) return;	//no columns in flyouts
		}

		//if( $this->depth > 1 ){

		$cols = $this->getSetting( 'columns' );
		if( $this->depth > 0 ){
			//Widgets are full width if Columns set to Auto
			if( ( $this->getSetting( 'widget_area' ) || $this->getSetting( 'auto_widget_area' ) )
				&& $cols == 'auto' ){
				$cols = 'full';
			}
			//If set to auto, apply submenu column default from parent item
			else if( $cols == 'auto' ){
				$cols = $this->walker->parent_item()->getSetting( 'submenu_column_default' );
			}
		}
		$this->item_classes[] = 'ubermenu-column ubermenu-column-' . $cols;


		//New Row
		if( $this->getSetting( 'clear_row' ) == 'on' ){
			$this->item_classes[] = 'ubermenu-clear-row';
		}

		//if( $this->walker->parent_item()->getSetting)
	}

	function add_class_alignment(){
		$align = $this->getSetting( 'item_align' );
		if( $align && $align != 'auto' ){
			$this->item_classes[] = 'ubermenu-align-'.$align;
		}
	}

	function add_class_mini_item(){
		if( $this->getSetting( 'mini_item' ) == 'on' ){
			$this->item_classes[] = 'ubermenu-item-mini';
		}
	}

	function add_class_rtl_sub(){
		if( ( $this->get_submenu_type() == 'mega' ) && ( $this->getSetting( 'submenu_position' ) == 'right_edge_item' ) ) {
			$this->item_classes[] = 'ubermenu-submenu-rtl';
		}
		else if( ( $this->get_submenu_type() == 'flyout' ) && ( $this->getSetting( 'flyout_submenu_position' ) == 'right_edge_item' ) ){
			$this->item_classes[] = 'ubermenu-submenu-rtl';
			$this->item_classes[] = 'ubermenu-submenu-reverse';
		}
	}
	function add_class_responsive(){
		if( $this->getSetting( 'hide_on_mobile' ) == 'on' ){
			$this->item_classes[] = 'ubermenu-hide-mobile';
		}
		if( $this->getSetting( 'hide_on_desktop' ) == 'on' ){
			$this->item_classes[] = 'ubermenu-hide-desktop';
		}
	}
	function add_class_submenu(){
		$submenu_type = $this->get_submenu_type();
		if( $submenu_type ){
			if( in_array( $submenu_type , array( 'mega' , 'flyout' ) ) ){
				$this->item_classes[] = 'ubermenu-has-submenu-drop';

				//Show current
				if( ( $this->getSetting( 'show_current' ) == 'on' ) &&
					( in_array( 'ubermenu-current-menu-ancestor' , $this->item_classes ) ||
					  in_array( 'ubermenu-current-menu-item' , $this->item_classes ) 
					) ){
					$this->item_classes[] = 'ubermenu-active';
				}

				//Show Default
				if( $this->getSetting( 'show_default' ) == 'on' ){
					$this->item_classes[] = 'ubermenu-active';
				}
			}
			$this->item_classes[] = 'ubermenu-has-submenu-'.$submenu_type;
		}

		if( ( $this->getSetting( 'submenu_position' ) == 'vertical_parent_item' ) ||
			( $this->getSetting( 'flyout_submenu_position' ) == 'vertical_parent_item' ) ){
			$this->item_classes[] = 'ubermenu-relative';
		}

		if( $submenu_type == 'flyout' && $this->getSetting( 'flyout_submenu_position' ) == 'vertical_full_height' ){
			$this->item_classes[] = 'ubermenu-flyout-full-height';
		}
	}

	function add_class_disable_padding(){
		$disable_padding = $this->getSetting( 'disable_padding' );
		if( $disable_padding == 'on' ){
			$this->item_classes[] = 'ubermenu-disable-padding';
		}
	}

	function filter_item_classes(){
		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @since 3.0.0
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of arguments. @see wp_nav_menu()
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $this->item_classes ), $this->item, $this->args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		return $class_names;
	}

	function filter_item_id(){
		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @since 3.0.1
		 *
		 * @param string The ID that is applied to the menu item's <li>.
		 * @param object $item The current menu item.
		 * @param array $args An array of arguments. @see wp_nav_menu()
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $this->item->ID, $this->item, $this->args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		
		return $id;
	}


	function setup_trigger(){
		$trigger = $this->getSetting( 'item_trigger' );
		if( $trigger && $trigger != 'auto' ){
			$this->item_atts['data-ubermenu-trigger'] = $trigger;
		}
	}

	function get_url(){
		return $this->item->url;
	}
	function set_url( $url ){
		$this->item->url = $url;
	}

	/**
	 * Get the attributes for the anchor, including class, title, target, rel, href
	 * Filterable with 'nav_menu_link_attributes'
	 * @return array 	An array of attributes with attribute names as keys and attribute values as values i.e. $key="$val"
	 */
	function anchor_atts(){
		$atts = array();
		$atts['class']	= 'ubermenu-target';	//add UberMenu specific meta
		$atts['title']  = ! empty( $this->item->attr_title ) ? $this->item->attr_title : '';
		$atts['target'] = ! empty( $this->item->target )     ? $this->item->target     : '';
		$atts['rel']    = ! empty( $this->item->xfn )        ? $this->item->xfn        : '';
		$atts['href']   = ! empty( $this->item->url )        ? $this->item->url        : '';

		if( $this->depth == 0 ){
			$atts['tabindex'] = 0;
		}

		/**
		 * Filter the HTML attributes applied to a menu item's <a>.
		 *
		 * @since 3.6.0
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
		 *
		 *     @type string $title  The title attribute.
		 *     @type string $target The target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item The current menu item.
		 * @param array  $args An array of arguments. @see wp_nav_menu()
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $this->item, $this->args );

		return $atts;
	}


	/**
	 * Get the Anchor and its contents
	 * @param  array $atts An array of attributes to add to the anchor
	 * @return string       The HTML for the anchor
	 */
	function get_anchor( $atts ){

		if( $this->item->title == '--divide--' ){
			return '<div class="ubermenu-divider"><hr/></div>';
		}


		$a = '';
		$tag = 'a';

		//Highlight
		if( $this->getSetting( 'highlight' ) == 'on' ){
			$atts['class'].= ' ubermenu-highlight';
		}


		//Image
		$image = $this->get_image();
		if( $image ) $atts['class'] .= ' ubermenu-target-with-image';


		//Icon
		$icon = $this->getSetting( 'icon' );
		if( $icon ){
			$atts['class'] .= ' ubermenu-target-with-icon';
			$icon = '<i class="ubermenu-icon '.$icon.'"></i>';
		}

		//Layout
		$layout = $this->getSetting( 'item_layout' );
		$atts['class'].= ' ubermenu-item-layout-'.$layout;

		//Content Align
		$content_align = $this->getSetting( 'content_alignment' );
		if( $content_align != 'default' ){
			$atts['class'].= ' ubermenu-content-align-'.$content_align;
		}

		
		if( $layout == 'default' ){

			if( $image ){
				$layout = 'image_left';
			}
			else if( $icon ){
				if( function_exists( 'ubermenu_icon_layout_default' ) ){
					$layout = ubermenu_icon_layout_default( $this );
				}
				else $layout = 'icon_left';
				
			}
			else{
				$layout = 'text_only';
			}

			$atts['class'].= ' ubermenu-item-layout-'.$layout;
		}

		$layout_order = ubermenu_get_item_layouts( $layout );
		if( !$layout_order ){
			ubermenu_admin_notice( __( 'Unknown layout order:', 'ubermenu' ).' '.$layout.' ['.$this->item->title.'] ('.$this->ID.')' );
		}
		

		//No wrap
		if( $this->getSetting( 'no_wrap' ) == 'on' ){
			$atts['class'].= ' ubermenu-target-nowrap';
		}



		//Disabled Link (change tag)
		$disable_link = false;
		if( $this->getSetting( 'disable_link' ) == 'on' ){
			$tag = 'span';
			$disable_link = true;
			unset( $atts['href'] );
		}


		//Disable Submenu Indicator
		$disable_submenu_indicator = false;
		if( $this->getSetting( 'disable_submenu_indicator' ) == 'on' ){
			$atts['class'].= ' ubermenu-noindicator';
		}
		

		//ScrollTo
		$scrollTo = $this->getSetting( 'scrollto' );
		if( $scrollTo ){
			$atts['data-ubermenu-scrolltarget'] = $scrollTo;
		}

		//Target ID
		$target_id = $this->getSetting( 'target_id' );
		if( $target_id ){
			$atts['id'] = $target_id;
		}

		//Target Class
		$target_class = $this->getSetting( 'target_class' );
		if( $target_class ){
			$atts['class'].= ' '.$target_class;
		}

		//Note: anchor atts used to be here

		//Title
		$title = '';
		if( $this->getSetting( 'disable_text' ) == 'off' ){

			$_title = $this->item->title;
			if( $this->get_menu_op( 'allow_shortcodes_in_labels' ) == 'on' ){
				$_title = do_shortcode( $_title );
			}

			$title .= '<span class="ubermenu-target-title ubermenu-target-text">';
			$title .= apply_filters( 'the_title', $_title, $this->item->ID );
			//$title .= $_title;
			$title .= '</span>';
			
		}
		else{
			//Flag items with disabled text
			$atts['class'].= ' ubermenu-item-notext';
		}


		//Description
		$description = '';
		//if( $this->getSetting( 'disable_text' ) == 'off' ){
		if( $this->item->description ){

			if( ( ( $this->depth == 0 ) && ( $this->get_menu_op( 'descriptions_top_level' ) == 'on' ) ) ||
				( ( $this->depth > 0  ) && ( $this->getSetting('item_display_calc') == 'header' ) && ( $this->get_menu_op( 'descriptions_headers' ) == 'on' ) ) ||
				( ( $this->depth > 0  ) && ( $this->getSetting('item_display_calc') == 'normal' ) && ( $this->get_menu_op( 'descriptions_normal'  ) == 'on' ) ) ){

				$_desc = $this->item->description;
				if( $this->get_menu_op( 'allow_shortcodes_in_labels' ) == 'on' ){
					$_desc = do_shortcode( $_desc );
				}

				//Divider
				$divider = $this->get_menu_op( 'target_divider' );
				if( $title && $divider ) $description.= '<span class="ubermenu-target-divider">'.$divider.'</span>';

				$description.= '<span class="ubermenu-target-description ubermenu-target-text">';
				$description.= $_desc;
				$description.= '</span>';
			}
		}


		//Anchor Attributes
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) || $value === 0 ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		//Check if we still have something to print
		if( !$title && !$description && !$image && !$icon ){
			return '';
		}


		//Build the Layout
		
		//Get custom pieces 
		$custom_pieces = array();
		extract( apply_filters( 'ubermenu_custom_item_layout_data' , $custom_pieces , $layout , $this->ID , $this->item->object_id ) );
		
		//Gather all the pieces in the layout order into an array
		$layout_pieces = compact( $layout_order );

		//Output the anchor
		$a .= $this->args->before;
		$a .= '<'.$tag. $attributes .'>';
		$a .= $this->args->link_before;

		//Add pieces based on layout order		
		foreach( $layout_pieces as $piece ){
			$a.= $piece;
		}
		
		$a .= $this->args->link_after;
		$a .= '</'.$tag.'>';
		$a .= $this->args->after;

		return $a;
	}

	/**
	 * Get the HTML for the image attached to this menu item
	 * @return string img HTML
	 */
	function get_image(){

		//Ignore mobile?
		if( ( $this->get_menu_op( 'disable_images_mobile' ) == 'on' ) && wp_is_mobile() ){
			return '';
		}


		//Image
		$img = '';
		$img_id = $this->getSetting( 'item_image' );

		if( $this->getSetting( 'inherit_featured_image' ) == 'on' ){
			if( $this->item->type == 'post_type' ){
				$thumb_id = get_post_thumbnail_id( $this->item->object_id );
				if( $thumb_id ) $img_id = $thumb_id;
			}
		}

		if( $img_id ){
			$atts = array();

			$atts['class'] = 'ubermenu-image';

			//Determine size of image to get
			$img_size = $this->getSetting( 'image_size' );
			if( $img_size == 'inherit' ){
				$img_size = $this->get_menu_op( 'image_size' );
			}
			//echo '['.$img_size.']';
			$atts['class'].= ' ubermenu-image-size-'.$img_size;

			//Get the reight image file
			$img_src = wp_get_attachment_image_src( $img_id , $img_size );

			//Lazy Load
			if( $this->depth > 0 && $this->get_menu_op( 'lazy_load_images' ) == 'on' ){
				$atts['class'].= ' ubermenu-image-lazyload';
				$atts['data-src'] = $img_src[0];
			}
			//Normal Load
			else{
				$atts['src'] = $img_src[0];
			}


			//Determine dimensions
			$img_w = '';
			$img_h = '';
			$dimensions = $this->getSetting( 'image_dimensions' );

			switch( $dimensions ){

				//Custom Dimensions use Menu Item Settings
				case 'custom':
					$img_w = $this->getSetting( 'image_width_custom' );
					$img_h = $this->getSetting( 'image_height_custom' );
					break;

				//Inherit settings from main Menu Settings
				case 'inherit':
					$img_w = $this->get_menu_op( 'image_width' );
					$img_h = $this->get_menu_op( 'image_height' );
					break;

				//Add width and height atts for natural width
				case 'natural':
					//Done below
					break;

				default: 
					break;
			}

			//Apply natural dimensions if not already set
			if( $this->get_menu_op( 'image_set_dimensions' ) ){
				if( $img_w == '' && $img_h == '' ){
					$img_w = $img_src[1];
					$img_h = $img_src[2];
				}
			}

			//Add dimensions as attributes, with pixel units if missing
			if( $img_w ){
				//if( is_numeric( $img_w ) ) $img_w.='px';	//Should always be numeric only, no units
				$atts['width']	= $img_w;
			}
			if( $img_h ){
				//if( is_numeric( $img_h ) ) $img_h.='px';	//Should always be numeric only, no units
				$atts['height'] = $img_h;	
			} 

			//Add 'alt' & 'title'
			$meta = get_post_custom( $img_id );
			$alt = isset( $meta['_wp_attachment_image_alt'] ) ? $meta['_wp_attachment_image_alt'][0] : '';	//Alt field
			$title = '';

			if( $alt == '' ){
				$title = get_the_title( $img_id );
				$alt = $title;
			}
			$atts['alt'] = $alt;

			if( $this->get_menu_op( 'image_title_attribute' ) == 'on' ){
				if( $title == '' ) $title = get_the_title( $img_id );
				$atts['title'] = $title;
			}

			//Build attributes string
			$attributes = '';
			foreach( $atts as $name => $val ){
				$attributes.= $name . '="'. esc_attr( $val ) .'" ';
			}			
			
			$img = "<img $attributes />";
			//$img = "<span class='ubermenu-image'><img $attributes /></span>";
		}
		return $img;
	}

	function get_custom_content(){

		$html = '';
		
		$custom_content = $this->getSetting( 'custom_content' );
		if( $custom_content ){
			$pad_custom_content = $this->getSetting( 'pad_custom_content' ) == 'on' ? 'ubermenu-custom-content-padded' : '' ;
			$html.= '<div class="ubermenu-content-block ubermenu-custom-content '.$pad_custom_content.'">';
			$html.= do_shortcode( $custom_content );
			$html.= '</div>';
		}

		return $html;

	}

	function get_widget_area(){

		$html = '';

		$widget_area_id = $this->getSetting( 'widget_area' );

		if( $this->getSetting( 'auto_widget_area' ) ){
			$custom_area_id = 'umitem_'.$this->ID;
			if( is_active_sidebar( $custom_area_id ) ){
				$widget_area_id = $custom_area_id;
			}
			else{
				$notice = __( 'The widget area is empty.' , 'ubermenu' );
				$notice.= ' <a target="_blank" href="'.admin_url( 'widgets.php' ).'">'.__( 'Assign a widget' , 'ubermenu' ).'</a>';
				global $wp_registered_sidebars;
				if( isset( $wp_registered_sidebars[$custom_area_id] ) ){
					$sidebar = $wp_registered_sidebars[$custom_area_id];
					$notice.= ' to <strong>'.$sidebar['name'].'</strong>';
				}

				$html.= ubermenu_admin_notice( $notice , false );
				return $html;
			}
		}

		//If this is a top level widget and that setting is not enabled, show an admin message
		if( $this->depth == 0 && $widget_area_id && ubermenu_op( 'allow_top_level_widgets' , 'general' ) != 'on' ){

			$msg = '<strong>[Menu Item: '. $this->item->title . ']</strong> '. __( 'You have assigned a widget area to a top level menu item.  If you want the widget to appear in a submenu, please attach it to a child menu item.  If you want the widget to appear in the menu bar (always visible), please enable the setting in the UberMenu Control Panel > General Settings > Widgets > Allow Top Level Widgets', 'ubermenu' );
			ubermenu_admin_notice( $msg , true );	//Deliberately printed BEFORE the menu rather than within it because the message is so long.
			//$html.= ubermenu_admin_notice( $msg , true );
			return $html;
		}

		if( $widget_area_id && is_active_sidebar( $widget_area_id ) ){

			global $wp_registered_sidebars;
			global $wp_registered_widgets;

			//global $_wp_sidebars_widgets;
			$sidebars_widgets = wp_get_sidebars_widgets();

			$num_widgets = count( $sidebars_widgets[$widget_area_id] );

			//Evenly divided
			$cols = 'ubermenu-column-1-'.$num_widgets;

			//If col number is set
			$widget_area_columns = $this->getSetting( 'widget_area_columns' );
			if( is_numeric( $widget_area_columns ) ){
				$cols = 'ubermenu-column-1-'.$widget_area_columns;
			}			

			foreach( $sidebars_widgets[$widget_area_id] as $widget_id ){
				$wp_registered_widgets[$widget_id]['classname'].=' '.$cols;
			}


			//ob_flush();
			ob_start();
			dynamic_sidebar( $widget_area_id );
			$widget_area = ob_get_contents();
			//$widget_area = ob_get_clean(); //ob_get_contents();
			ob_end_clean();

			$html.= '<ul class="ubermenu-content-block ubermenu-widget-area ubermenu-row ubermenu-autoclear">';
			$html.= $widget_area;
			$html.= '</ul>';
		}
		//No widgets
		else if( $widget_area_id ){

			global $wp_registered_sidebars;
			$notice = __( 'The widget area is empty.  ' , 'ubermenu' );
			$notice.= '<a target="_blank" href="'.admin_url( 'widgets.php' ).'">'.__( 'Assign a widget' , 'ubermenu' ).'</a>';
			if( isset( $wp_registered_sidebars[$widget_area_id] ) ){
				$sidebar = $wp_registered_sidebars[$widget_area_id];
				$notice.= ' to <strong>'.$sidebar['name'].'</strong>';
			}
			$html.= ubermenu_admin_notice( $notice , false );
			
			return $html;
		}
		else{
			//Nothing assigned - fine if a normal menu item, but if this is a Widget Area menu item, stop the presses.
			if( $this->type == 'widget_area' ){
				$notice = __( 'Please enter a name for your Custom Widget Area, or assign a Reusable Widget Area to this menu item.' , 'ubermenu' );
				$notice.= ' <strong>Item ID: '.$this->ID.' '.$this->item->title.'</strong>';
				$html.= ubermenu_admin_notice( $notice , false );
			}
		}

		return $html;

	}



}



/* A Horizontal Rule */
class UberMenuItemDivider extends UberMenuItem{
	function get_start_el(){
		return '<li class="ubermenu-divider"><hr/>';
	}
}