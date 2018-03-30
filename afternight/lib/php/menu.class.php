<?php
    class menu extends Walker{
        var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
        var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

        var $count = 0;
        var $need_more = false;
        var $item_type = '';

        var $type;
        var $classes;
        var $firstitem; 
        var $menu_id;
        var $subclass;
        var $current;
        var $beforeitem;
        var $afteritem;
        var $beforesubm;
        var $aftersubm;
        var $moreclass;
        var $morelabel;
        var $limit;
        var $exclude = array();
        var $issetcurrent = false;

            /*
                $args = array(
             *      'type'          => 'page',
             *      'class'         => '',
             * *    'menu_id        => '',
             *      'submenu-class' => 'children',
             *      'current-class' => 'current',
             *      'before-item'   => '',
             *      'after-item'    => '',
             *      'before-submenu'=> '',
             *      'after-submenu' => '',
             *      'more-class'    => '',
             *      'number-items'  => '',
             *      'exclude' => array( id ,id ,id ) );
             *  )
            */

        function __construct( $args ) {

            $this -> type       = isset( $args['type'] ) ? $args['type'] : 'page';
            $this -> classes    = isset( $args['class'] ) ? 'class="'.$args['class'].'"' : '';
            $this -> firstitem  = isset( $args['firstitem'] ) ? $args['firstitem'] : 'first';
            $this -> container  = isset( $args['container'] ) ? ''.$args['container'].'' : '';
            $this -> container_class  = isset( $args['container_class'] ) ? ''.$args['container_class'].'' : '';      
            $this -> menu_id    = isset( $args['menu_id'] ) ? 'id="'.$args['menu_id'].'"' : '';
            $this -> menu_item_id = isset( $args['menu_id'] ) ? $args['menu_id'] : '';
            $this -> subclass   = isset( $args['submenu-class'] ) ? $args['submenu-class'] : 'children';
            $this -> current    = isset( $args['current-class'] ) ? $args['current-class'] : 'current';
            $this -> beforeitem = isset( $args['before-item'] ) ? $args['before-item'] : '';
            $this -> afteritem  = isset( $args['after-item'] ) ? $args['after-item'] : '';
            $this -> beforesubm = isset( $args['before-submenu'] ) ? $args['before-submenu'] : '';
            $this -> aftersubm  = isset( $args['after-submenu'] ) ? $args['after-submenu'] : '';
            $this -> moreclass  = isset( $args['more-class'] ) ? $args['more-class'] : 'more-menu-item';
            $this -> morelabel  = isset( $args['more-label'] ) ? $args['more-label'] : 'More';
            $this -> limit      = isset( $args['number-items'] ) ? $args['number-items'] : _LIMIT_;
            $this -> exclude    = isset( $args['exclude']) ? $args['exclude'] : array();
            $this -> menu_style    = isset( $args['menu_style']) ? $args['menu_style'] : 'default';
            $this -> nr_columns    = isset( $args['nr_columns']) ? $args['nr_columns'] : '';
        }

        function start_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent" . $this ->beforesubm . "<ul class=\"".$this -> subclass."\">\n";
        }

        function end_lvl(&$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>" . $this ->aftersubm . "\n";
        }

        function start_el( &$output, $item, $depth = 0, $args = Array(), $current_object_id = 0) {

            if ($depth == 0){
                $this -> count++;
                if($this -> limit == $this -> count){
                    $this -> need_more = true;
                    $output .= '<li class="menu-item ' . $this -> moreclass . ' '.$this->nr_columns.' no_description ">';
                    $output .= '<a href="#">' . $this -> beforeitem . $this -> morelabel . $this -> afteritem ;
                    if($this -> menu_style == 'with_description'){ /*add description for more label if we have menu with description*/
                        $output .= '<span>&nbsp;</span>';
                    }
                    $output .= '</a>';
                    $output .= '<ul class="'.$this -> subclass.' ' . $this -> moreclass . '">';
                }
            }

            global $wp_query;
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID .' '.$this->nr_columns;

            

            

            /* add class first-menu-item to first items */
            if($this -> count == 1){
                $classes[] = $this -> firstitem ;
            }

            /* del class current from sub-items */
            if($this -> count >= $this -> limit){
                if( in_array( $this -> current , $classes ) ){
                    unset($classes[ array_search( $this -> current , $classes ) ]);
                }
            }

            if(empty($item->attr_title) || $this -> menu_style != 'with_description'){
                $classes[] = 'no_description';
            }

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

            if( $item -> menu_item_parent > 0 ){
                $class_names = ' class="menu-item ' . str_replace('menu-item ','', esc_attr( $class_names ) ) . '"';
            }else{
                $class_names = ' class="' . esc_attr( $class_names ) . '"';
            }


            $class_names = str_replace("current-menu-item", ' '.$this -> current.' ' , $class_names );
            $class_names = str_replace("current-menu-ancestor", ' '.$this -> current.' ' , $class_names );
            $class_names = str_replace("current-menu-parent", ' '.$this -> current.' ' , $class_names );

            if( $item -> menu_item_parent > 0  || $this -> count >= $this -> limit ){
                $class_names = str_replace( $this ->current , '' , $class_names );
            }

            if( $this -> issetcurrent ){
                $class_names = str_replace( $this ->current , '' , $class_names );
            }

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

            



            $output .= $indent . '<li' . $id . $value . $class_names . '>';

            $old_class_names = $class_names;
            $new_class_names = str_replace( $this ->current , '',  $class_names );

            if( strlen( $old_class_names ) > strlen( $new_class_names ) ){
                $this -> issetcurrent = true;
            }

            if ( ! empty( $item->post_type ) && $item->post_type == 'nav_menu_item' ) {
                $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
                $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
                $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
                $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            } else {
                $attributes  = ! empty( $item->post_title ) ? ' title="'  . esc_attr( $item->post_title ) .'"' : '';
                $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
                $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
                $attributes .= ' href= "' . esc_attr( get_permalink( $item->ID ) ) . '"';
                $item->title = $item->post_title;
            }

            if( $item -> menu_item_parent == 0  && $this -> count < $this -> limit ){
                $item -> title = $this -> beforeitem . $item -> title . $this -> afteritem;
            }

            $item_output = '';

            $item_output .= '<a'. $attributes .'>';

            $item_output .= apply_filters( 'the_title', $item->title, $item->ID );

            /* attribut settings  AND menu style */
            if( !empty( $item->attr_title ) && $this -> menu_style == 'with_description'){
                $item_output .= '<span>';
                $item_output .= $item->attr_title;
                $item_output .= '</span>';
            }

            $item_output .= '</a>';

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

        function end_el( &$output, $item, $depth = 0, $args = Array()) {
            $output .= "</li>\n";
        }

        function get_terms_menu( $class = '' , $subclass = 'children' , $current = 'current' , $before = '' , $after = '' , $more = 'More' ){
            
            switch( $this ->type ){
                case 'category' :{
                    $args = array(
                        'exclude' => $this -> exclude ,
                        'pad_counts' => '1',
                        'child_of'=> 0 ,
                        'parent' => 0
                    );

                    $terms = get_categories( $args );
                    $item  = 'cat';
                    break;
                }
                default  :{
                    $args = array(
                        'child_of' => 0,
                        'sort_order' => 'ASC',
                        'sort_column' => 'post_title',
                        'hierarchical' => 1,
                        'exclude' => $this -> exclude,
                        'include' => '',
                        'meta_key' => '',
                        'meta_value' => '',
                        'authors' => '',
                        'parent' => 0,
                        'exclude_tree' => '',
                        'number' => '',
                        'offset' => 0 );

                    $terms = get_pages( $args );
                    $item  = 'menu';
                    break;
                }
            }

            $menu = '<'. $this -> container . ' class="'. $this -> container_class . '"><ul  '.$this -> menu_id .' '.$this -> classes .' >';

            if( is_home() || is_front_page() ){
                $home = '<li class="'.$item.'-item '.$this -> current.' ' . $this -> firstitem . ' no_description '.$this->nr_columns.'">';
                $home .= '<a href="'.home_url().'">' . $this-> beforeitem . __('Home','cosmotheme') . $this->afteritem . '</a>' ;
                $home .= '</li>';
            }else{
                $home = '<li class="menu-item ' . $this -> firstitem . ' no_description '.$this->nr_columns.'">';
                $home .= '<a href="'.home_url().'">' . $this-> beforeitem . __('Home','cosmotheme') . $this->afteritem . '</a>' ;
                $home .= '</li>';
            }

            $menu .= $home;
            $count = 1;

            foreach( $terms as $key => $term ){
                $is_term = false;

                if( $count == $this -> limit ){
                    $menu .= '<li class="'.$item.'-item '.$this->nr_columns.'">';
                    $menu .= '<a href="">' . $this -> beforeitem . $this -> morelabel . $this -> afteritem . '</a>';
                    $menu .= $this -> beforesubm;
                    $menu .= '<ul class="'.$this -> subclass.' ' . $this -> moreclass . '">';
                }

                switch( $this -> type){
                    case 'category' : {
                        $id = $term -> term_id;
                        $args_ = array(
                            'exclude' => $this -> exclude ,
                            'pad_counts' => '1',
                            'child_of'=> $id ,
                            'parent' => $id
                        );

                        $title = $term -> name;
                        $link = get_category_link( $id );

                        if( is_category( $term -> name ) ){
                            $is_term = true;
                        }

						wp_reset_postdata();
						if( is_single( ) ){
							global $post;
							$current_cat = get_the_category($post->ID);
							if( is_array( $current_cat ) && !empty( $current_cat ) ){
                                $parrent_cats = get_category_parents($current_cat[0]->term_id);

                                $cats = explode('/', $parrent_cats);


                                $category_array = array();

                                foreach ($cats as $category) {
                                    if(trim($category) != '')
                                    {
                                        $category_array[] = get_cat_ID($category);
                                    }
                                }
                                if(in_array($term -> term_id,$category_array)) { $is_term = true; }

                            }

							wp_reset_postdata();
						}
                        break;
                    }

                    default : {
                        $id = $term -> ID;
                        $args_ = array(
                            'child_of' => 0,
                            'sort_order' => 'ASC',
                            'sort_column' => 'post_title',
                            'hierarchical' => 1,
                            'exclude' => $this -> exclude,
                            'include' => '',
                            'meta_key' => '',
                            'meta_value' => '',
                            'authors' => '',
                            'parent' => $id,
                            'exclude_tree' => '',
                            'number' => '',
                            'offset' => $id );

                        $title =  $term -> post_title;
                        $link  =  get_permalink( $id );

                        if( is_page( $term -> post_title )  ){
                            $is_term = true;
                        }
                        break;
                    }
                }

                $submenu = $this -> get_childs( $args_ ,  $subclass );

                if(isset( $submenu['class'] ) && $submenu['class'] == 'current' && !$this -> issetcurrent ){
                    $class = $this -> current;
                    $this -> issetcurrent = true;
                }else{
                    $class = '';
                }

                if( $count < $this -> limit ){
                    if( $is_term && !$this -> issetcurrent ){
                            $menu .= '<li class="'.$item.'-item '.$this -> current.' no_description '.$this->nr_columns.'" id="'.$item.'-item-' . $id .  $this -> menu_item_id .'">';
                            $this -> issetcurrent = true;
                    }else{
                            $menu .= '<li class="'.$item.'-item '.$class.' no_description '.$this->nr_columns.'" id="'.$item.'-item-' . $id .  $this -> menu_item_id .'">';
                    }
                }else{
                    $menu .= '<li class="'.$item.'-item '.$class.' no_description '.$this->nr_columns.'" id="'.$item.'-item-' . $id .  $this -> menu_item_id .'">';
                }

                if( $count < $this -> limit ){
                    $menu .= '<a href="' . $link . '">' . $this -> beforeitem . $title . $this -> afteritem . '</a>';
                }else{
                    $menu .= '<a href="' . $link . '">' . $title . '</a>';
                }

                $menu .= $submenu['submenu'];

                $menu .= '</li>';

                $count++;
            }

            if( $count >= $this -> limit ){
                $menu .= '</ul>';
                $menu .= '</li>';
            }

            $menu .= '</ul><div class="clear"></div></'. $this -> container .'>';

            return $menu;
        }

        function get_childs( $args , $subclass ){

            $submenu = '';
            $result  = array();
            $childs = get_categories( $args );

            if( count( $childs ) > 0 ) {
                $submenu  .= $this -> beforesubm;
                $submenu  .= '<ul class="'.$subclass.'">';

                foreach( $childs as $key => $child ){
                    switch( $this -> type ){
                        case 'category' : {
                            $id                 = $child -> term_id;
                            $args['parent']     = $child -> term_id;
                            $title              = $child -> name;
                            $link               = get_category_link( $id );
                            $item               = 'cat';

                            if( is_category ( $title ) ){
                                $result['class'] = 'current';
                            }
                            break;
                        }
                        default : {
                            $id                 = $child -> ID;
                            $args['parent']     = $child -> ID;
                            $args['child_of']   = $child -> ID;
                            $title              = $child -> post_title;
                            $link               = get_permalink( $id );
                            $item               = 'menu';

                            if( is_page ( $title ) ){
                                $result['class'] = 'current';
                            }
                            break;
                        }
                    }

                    $submenu .= '<li class="'.$item.'-item" id="'.$item.'-item-' . $id . $this -> menu_item_id . '">';
                    $submenu .= '<a href="' . $link . '">' . $title . '</a>';
                    $subdata  = $this -> get_childs( $args ,  $subclass );
                    $submenu .= $subdata['submenu'];

                    if( isset( $subdata['class'] ) && strlen($subdata['class']) ){
                        $result['class'] = $subdata['class'];
                    }

                    $submenu .= '</li>';
                }

                $submenu .= '</ul>';
                $submenu  .= $this -> aftersubm;
            }

            $result['submenu'] = $submenu;

            return $result;
        }
    }
?>