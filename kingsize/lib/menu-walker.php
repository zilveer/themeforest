<?php
/*
Menu Walker Class
*/
class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) 
      {
           global $wp_query,$post;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			
           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

		   /*if ($item->menu_order == 1) {
			 $classes[] = 'firstmenuitem';
	       }
		  
		   if ($item->ID == get_theme_mod('lastmenuitem')) {
			 $classes[] = 'lastmenuitem';
		   }*/

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
						
				
		   if(empty( $item->description ))	
				$class_names = ' class="mainNav no_desc '. esc_attr( $class_names ) . '"';
			else 
				$class_names = ' class="mainNav '. esc_attr( $class_names ) . '"';


			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = ' <h5 class="title-page">';
           $append = ' </h5>';
			
		   //check if current page is selected page and add selected value to select element  
			$selc = '';
			if (strpos($class_names, 'current-menu-item') || strpos($class_names, 'current-menu-parent')
				|| strpos($class_names, 'current-menu-ancestor') ) {
				 $selc = "active ";
			} else {
				 $selc = "";
			}
			
			$description  = ! empty( $item->description ) ? '<h6 class="sub space '.$selc.'"><i>'.esc_attr( $item->description ).'</i></h6>' : '';			

           if($depth != 0)
           {
               $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}
?>
