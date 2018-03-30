<?php
if ( ! class_exists( 'DH_Category_Dropdown' ) ) :

	class DH_Category_Dropdown extends Walker {

		var $tree_type = 'category';

		var $db_fields = array( 'parent' => 'parent', 'id' => 'term_id', 'slug' => 'slug' );

		public function start_el( &$output, $cat, $depth = 0, $args = array(), $current_object_id = 0 ) {
			if ( ! empty( $args['hierarchical'] ) )
				$pad = str_repeat( '&nbsp;', $depth * 3 );
			else
				$pad = '';
			
			$cat_name = $cat->name;
			
			$value = isset( $args['value'] ) && $args['value'] == 'id' ? $cat->term_id : $cat->slug;
			
			$output .= "\t<option class=\"level-$depth\" value=\"" . $value . "\"";
			
			if ( $value == $args['selected'] ||
				 ( is_array( $args['selected'] ) && in_array( $value, $args['selected'] ) ) )
				$output .= ' selected="selected"';
			
			$output .= '>';
			
			$output .= $pad . $cat_name;
			
			if ( ! empty( $args['show_count'] ) )
				$output .= '&nbsp;(' . $cat->count . ')';
			
			$output .= "</option>\n";
		}

		public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
			if ( ! $element || 0 === $element->count ) {
				return;
			}
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
	}

endif;

function dh_walk_category_dropdown_tree() {
	$args = func_get_args();
	
	// the user's options are the third parameter
	if ( empty( $args[2]['walker'] ) || ! is_a( $args[2]['walker'], 'Walker' ) ) {
		$walker = new DH_Category_Dropdown();
	} else {
		$walker = $args[2]['walker'];
	}
	
	return call_user_func_array( array( &$walker, 'walk' ), $args );
}

if ( ! class_exists( 'DH_Walker' ) ) :

	class DH_Walker extends Walker_Nav_Menu {

		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul role=\"menu\" class=\"dropdown-menu\">\n";
		}

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
			if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else 
				if ( strcasecmp( $item->title, 'divider' ) == 0 && $depth === 1 ) {
					$output .= $indent . '<li role="presentation" class="divider">';
				} else 
					if ( strcasecmp( $item->attr_title, 'dropdown-header' ) == 0 && $depth === 1 ) {
						$output .= $indent . '<li role="presentation" class="dropdown-header">' .
							 esc_attr( $item->title );
					} else 
						if ( strcasecmp( $item->attr_title, 'disabled' ) == 0 ) {
							$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' .
								 esc_attr( $item->title ) . '</a>';
						} else {
							
							$class_names = $value = '';
							
							$classes = empty( $item->classes ) ? array() : (array) $item->classes;
							$classes[] = 'menu-item-' . $item->ID;
							
							$class_names = join( 
								' ', 
								apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
							
							if ( $args->has_children && $depth === 1 ) {
								$class_names .= ' dropdown-submenu';
							} elseif ( $args->has_children ) {
								$class_names .= ' dropdown';
							}
							if ( in_array( 'current-menu-item', $classes ) )
								$class_names .= ' active';
							
							$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
							
							$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
							$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
							
							$output .= $indent . '<li' . $id . $value . $class_names . '>';
							
							$atts = array();
							if ( strpos( $item->attr_title, 'class=' ) !== false ) {
								$atts['class'] = ( isset( $atts['class'] ) ? $atts['class'] . " " : '' ) .
									 str_replace( 'class=', '', $item->attr_title );
							} else {
								$atts['title'] = ! empty( $item->attr_title ) ? $item->attr_title : ( ! empty( 
									$item->title ) ? esc_attr( $item->title ) : '' );
							}
							$atts['target'] = ! empty( $item->target ) ? $item->target : '';
							$atts['rel'] = ! empty( $item->xfn ) ? $item->xfn : '';
							
							// If item has_children add atts to a.
							if ( $args->has_children && $depth === 0 ) {
								// $atts['href'] = '#';
								$atts['href'] = ! empty( $item->url ) ? $item->url : '';
								// $atts['data-toggle'] = 'dropdown';
								// $atts['data-hover'] = 'dropdown';
								$atts['class'] = 'dropdown-hover';
							} else {
								$atts['href'] = ! empty( $item->url ) ? $item->url : '';
							}
							
							$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
							
							$attributes = '';
							foreach ( $atts as $attr => $value ) {
								if ( ! empty( $value ) ) {
									$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
									$attributes .= ' ' . $attr . '="' . $value . '"';
								}
							}
							
							$item_output = $args->before;
							
							$item_output .= '<a' . $attributes . '>';
							
							$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) .
								 $args->link_after;
							$item_output .= ( $args->has_children && in_array( $depth, array( 0, 1 ) ) ) ? ' <span class="caret"></span></a>' : '</a>';
							$item_output .= $args->after;
							
							$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
						}
		}

		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element )
				return;
			
			$id_field = $this->db_fields['id'];
			
			// Display this element.
			if ( is_object( $args[0] ) )
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
	}


endif;

if ( ! class_exists( 'DH_Underline_Walker' ) ) :

	class DH_Underline_Walker extends DH_Walker {

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
			if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else 
				if ( strcasecmp( $item->title, 'divider' ) == 0 && $depth === 1 ) {
					$output .= $indent . '<li role="presentation" class="divider">';
				} else 
					if ( strcasecmp( $item->attr_title, 'dropdown-header' ) == 0 && $depth === 1 ) {
						$output .= $indent . '<li role="presentation" class="dropdown-header">' .
							 esc_attr( $item->title );
					} else 
						if ( strcasecmp( $item->attr_title, 'disabled' ) == 0 ) {
							$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' .
								 esc_attr( $item->title ) . '</a>';
						} else {
							
							$class_names = $value = '';
							
							$classes = empty( $item->classes ) ? array() : (array) $item->classes;
							$classes[] = 'menu-item-' . $item->ID;
							
							$class_names = join( 
								' ', 
								apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
							
							if ( $args->has_children && $depth === 1 ) {
								$class_names .= ' dropdown-submenu';
							} elseif ( $args->has_children ) {
								$class_names .= ' dropdown';
							}
							if ( in_array( 'current-menu-item', $classes ) )
								$class_names .= ' active';
							
							$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
							
							$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
							$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
							
							$output .= $indent . '<li' . $id . $value . $class_names . '>';
							
							$atts = array();
							if ( strpos( $item->attr_title, 'class=' ) !== false ) {
								$atts['class'] = ( isset( $atts['class'] ) ? $atts['class'] . " " : '' ) .
									 str_replace( 'class=', '', $item->attr_title );
							} else {
								$atts['title'] = ! empty( $item->attr_title ) ? $item->attr_title : ( ! empty( 
									$item->title ) ? esc_attr( $item->title ) : '' );
							}
							$atts['target'] = ! empty( $item->target ) ? $item->target : '';
							$atts['rel'] = ! empty( $item->xfn ) ? $item->xfn : '';
							
							// If item has_children add atts to a.
							if ( $args->has_children && $depth === 0 ) {
								// $atts['href'] = '#';
								$atts['href'] = ! empty( $item->url ) ? $item->url : '';
								// $atts['data-toggle'] = 'dropdown';
								// $atts['data-hover'] = 'dropdown';
								$atts['class'] = 'dropdown-hover';
							} else {
								$atts['href'] = ! empty( $item->url ) ? $item->url : '';
							}
							
							$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
							
							$attributes = '';
							foreach ( $atts as $attr => $value ) {
								if ( ! empty( $value ) ) {
									$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
									$attributes .= ' ' . $attr . '="' . $value . '"';
								}
							}
							
							$item_output = $args->before;
							
							$item_output .= '<a' . $attributes . '>';
							if ( $depth === 0 )
								$item_output .= '<span class="underline">' . $args->link_before .
									 apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after .
									 '</span>';
							else
								$item_output .= $args->link_before .
									 apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
							$item_output .= ( $args->has_children && in_array( $depth, array( 0, 1 ) ) ) ? ' <span class="caret"></span></a>' : '</a>';
							$item_output .= $args->after;
							
							$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
						}
		}
	}

endif;

if ( ! class_exists( 'DH_Mega_Walker' ) ) :

	class DH_Mega_Walker extends DH_Walker {

		private $_megamenu_status = '';

		private $_megamenu_fullwidth = '';

		private $_megamenu_columns = 4;

		private $_current_columns = 0;

		private $_megamenu_title = '';

		private $_megamenu_sidebar = '';

		private $_menu_icon = '';

		private $_menu_visibility = '';
		
		private $_number_of_root_elements = 0;

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$class_columns = $item_output = '';
			if ( $depth === 0 ) {
				$this->_megamenu_status = get_post_meta( $item->ID, '_dh_megamenu_status', true );
				$this->_megamenu_fullwidth = get_post_meta( $item->ID, '_dh_megamenu_fullwidth', true );
				$this->_megamenu_columns = get_post_meta( $item->ID, '_dh_megamenu_columns', true );
				$this->_current_columns = 0;
				if ( $this->_megamenu_status === 'yes' ) {
					$class_columns .= ' megamenu';
				}
				if ( $this->_megamenu_fullwidth === 'yes' ) {
					$class_columns .= ' megamenu-fullwidth';
				}
			}
			$this->_megamenu_title = get_post_meta( $item->ID, '_dh_megamenu_title', true );
			$this->_menu_icon = get_post_meta( $item->ID, '_dh_menu_icon', true );
			$this->_megamenu_sidebar = get_post_meta( $item->ID, '_dh_megamenu_sidebar', true );
			$this->_menu_visibility = get_post_meta( $item->ID, '_dh_menu_visibility', true );
			
			switch ( $this->_menu_visibility ) {
				case 'hidden-phone' :
					$class_columns .= ' hidden-xs';
					break;
				case 'hidden-tablet' :
					$class_columns .= ' hidden-sm hidden-md';
					break;
				case 'hidden-pc' :
					$class_columns .= ' hidden-lg';
					break;
				case 'visible-phone' :
					$class_columns .= ' visible-xs-inline';
					break;
				case 'visible-tablet' :
					$class_columns .= ' visible-sm-inline visible-md-inline';
					break;
				case 'visible-pc' :
					$class_columns .= ' visible-lg-inline';
					break;
			}
			
			if ( $depth === 1 && $this->_megamenu_status === 'yes' ) {
				$this->_current_columns++;
				if ( $this->_current_columns <= $this->_megamenu_columns ) {
					$class_columns .= ' mega-col-' . ( 12 / $this->_megamenu_columns );
				}
				$title = apply_filters( 'the_title', $item->title, $item->ID );
				$link = '';
				$link_close = '';
				if ( $this->_megamenu_title === 'no' ) {
					$href = ! empty( $item->url ) ? 'href="' . esc_url( $item->url ) . '"' : '';
					$link = '<a ' . $href . '>';
					$link_close = '</a>';
				}
				$title_icon = '';
				if ( ! empty( $this->_menu_icon ) ) {
					$title_icon = '<i class="navicon ' . $this->_menu_icon . '"></i>';
				}
				$heading = sprintf( '%s%s%s%s', $link, $title_icon, $title, $link_close );
				if ( $this->_megamenu_title != 'no' ) {
					$item_output .= '<h3 class="megamenu-title">' . $heading;
					$item_output .= ( $args->has_children && in_array( $depth, array( 0, 1 ) ) ) ? ' <span class="caret"></span></h3>' : '</h3>';
				} else {
					// $item_output .= $heading;
				}
				
				if ( ! empty( $this->_megamenu_sidebar ) && is_active_sidebar( $this->_megamenu_sidebar ) ) {
					$item_output .= '<div class="megamenu-sidebar">';
					ob_start();
					dynamic_sidebar( $this->_megamenu_sidebar );
					$item_output .= ob_get_clean();
					$item_output .= '</div>';
				}
			} else 
				if ( $depth === 2 && ! empty( $this->_megamenu_sidebar ) && is_active_sidebar( $this->_megamenu_sidebar ) && $this->_megamenu_status == "yes" ) {
					$item_output .= '<div class="megamenu-sidebar">';
					ob_start();
					dynamic_sidebar( $this->_megamenu_sidebar );
					$item_output .= ob_get_clean();
					$item_output .= '</div>';
				} else {
					$atts = array();
					if ( strpos( $item->attr_title, 'class=' ) !== false ) {
						$atts['class'] = ( isset( $atts['class'] ) ? $atts['class'] . " " : '' ) .
							 str_replace( 'class=', '', $item->attr_title );
					} else {
						$atts['title'] = ! empty( $item->attr_title ) ? $item->attr_title : ( ! empty( $item->title ) ? esc_attr( 
							$item->title ) : '' );
					}
					$atts['target'] = ! empty( $item->target ) ? $item->target : '';
					$atts['rel'] = ! empty( $item->xfn ) ? $item->xfn : '';
					
					// If item has_children add atts to a.
					if ( $args->has_children && $depth === 0 ) {
						$atts['href'] = ! empty( $item->url ) ? $item->url : '';
						$atts['class'] = 'dropdown-hover';
					} else {
						$atts['href'] = ! empty( $item->url ) ? $item->url : '';
					}
					
					$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
					
					$attributes = '';
					foreach ( $atts as $attr => $value ) {
						if ( ! empty( $value ) ) {
							$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
							$attributes .= ' ' . $attr . '="' . $value . '"';
						}
					}
					
					$item_output = $args->before;
					
					$item_output .= '<a' . $attributes . '>';
					
					if ( ! empty( $this->_menu_icon ) ){
						$item_output .= '<i class="navicon ' . $this->_menu_icon . '"></i>';
					}
					
					if ( $depth === 0 ) {
						$item_output .= '<span class="underline">' . $args->link_before .
							 apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after . '</span>';
					} else {
						$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) .
							 $args->link_after;
					}
					
					$item_output .= ( $args->has_children && in_array( $depth, array( 0, 1 ) ) ) ? ' <span class="caret"></span></a>' : '</a>';
					$item_output .= $args->after;
				}
			
			if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else 
				if ( strcasecmp( $item->title, 'divider' ) == 0 && $depth === 1 ) {
					$output .= $indent . '<li role="presentation" class="divider">';
				} else 
					if ( strcasecmp( $item->attr_title, 'dropdown-header' ) == 0 && $depth === 1 ) {
						$output .= $indent . '<li role="presentation" class="dropdown-header">' .
							 esc_attr( $item->title );
					} else 
						if ( strcasecmp( $item->attr_title, 'disabled' ) == 0 ) {
							$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' .
								 esc_attr( $item->title ) . '</a>';
						} else {
							
							$class_names = $value = '';
							
							$classes = empty( $item->classes ) ? array() : (array) $item->classes;
							$classes[] = 'menu-item-' . $item->ID;
							
							$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
							if( $depth === 0 && $args->has_children ) {
								if( $this->_megamenu_status == "yes" ) {
									$class_names .= ' dh-megamenu-menu';
								} else {
									$class_names .= ' dh-megamenu-menu';
								}
							}
							$class_names .= $class_columns;
							
							if ( $args->has_children && $depth === 1 ) {
								$class_names .= ' dropdown-submenu';
							} elseif ( $args->has_children ) {
								$class_names .= ' dropdown';
							}
							if ( in_array( 'current-menu-item', $classes ) )
								$class_names .= ' active';
							
							$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
							
							$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
							$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
							
							$output .= $indent . '<li' . $id . $value . $class_names . '>';
							
							$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
						}
		}
		
		public function walk($elements, $max_depth){
			$this->_number_of_root_elements = $this->get_number_of_root_elements($elements);
			$args = func_get_args();
			return call_user_func_array(array('parent','walk'), $args);
		}
		
		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= "</li>\n";
			$header_style = dh_get_theme_option('header-style','below');
			if($header_style =='center2'){
				static $static_nav_count = 0;
				if($depth === 0){
					$logo_url = dh_get_theme_option('logo');
					$logo_fixed_url = dh_get_theme_option('logo-fixed','');
					$logo_transparent_url = dh_get_theme_option('logo-transparent','');
					$logo_mobile_url = dh_get_theme_option('logo-mobile','');
					if(empty($logo_fixed_url))
						$logo_fixed_url = $logo_url;
					if(empty($logo_mobile_url))
						$logo_mobile_url = $logo_url;
					$menu_transparent = dh_get_theme_option('menu-transparent',0);
					if($menu_transparent)
						$logo_url = $logo_transparent_url;
					$logo_html = '';
					if(empty($logo_html)){
						ob_start();
						?>
						<a class="navbar-brand" data-itemprop="url" title="<?php esc_attr(bloginfo( 'name' )); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php if(!empty($logo_url)):?>
							<img class="logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($logo_url)?>">
							<?php else:?>
							<?php echo bloginfo( 'name' ) ?>
							<?php endif;?>
							<img class="logo-fixed" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($logo_fixed_url)?>">
							<img class="logo-mobile" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($logo_mobile_url)?>">
							<meta itemprop="name" content="<?php bloginfo('name')?>">
						</a>
						<?php
						$logo_html = ob_get_clean();
					}
					$static_nav_count ++;
					if($static_nav_count == round($this->_number_of_root_elements / 2,0,PHP_ROUND_HALF_DOWN)){
						$output .='<li class="menu-item-navbar-brand">'.$logo_html.'</li>';
					}
				}
			}
		}
	}

endif;