<?php 
// **********************************************************************// 
// ! Custom navigation
// **********************************************************************// 

add_action( 'wp_ajax_menu_posts', array( new Et_Navigation(), 'getPostsByCategory') );
add_action( 'wp_ajax_nopriv_menu_posts', array( new Et_Navigation(), 'getPostsByCategory') );

class Et_Navigation extends Walker_Nav_Menu {
    public $styles = '';

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);

        if($depth > 0) {
            $output .= "\n$indent<div class=\"nav-sublist\">\n";
        }

        $output .= "\n$indent<ul>\n";
    }

    function end_lvl( &$output, $depth = 1, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";        

        if($depth > 0) {
            $output .= "\n$indent</div>\n";
        }
    }

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $item_id =  $item->ID;

        $class_names = $value = '';

        $anchor = get_post_meta($item_id, '_menu-item-anchor', true);
        
        if(!empty($anchor)) {
            $item->url = $item->url.'#'.$anchor;
            if(($key = array_search('current_page_item', $item->classes)) !== false) {
                unset($item->classes[$key]);
            }
            if(($key = array_search('current-menu-item', $item->classes)) !== false) {
                unset($item->classes[$key]);
            }
        }
        
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'item-level-' . $depth;

        $design = $design2 = $columns = $icon = $label = '';
        $design = get_post_meta($item_id, '_menu-item-design', true);
        $design2 = get_post_meta($item_id, '_menu-item-design2', true);
        $columns = get_post_meta($item_id, '_menu-item-columns', true);
        $icon = get_post_meta($item_id, '_menu-item-icon', true);
        $label = get_post_meta($item_id, '_menu-item-label', true);
        $disable_titles = get_post_meta($item_id, '_menu-item-disable_titles', true);
        $widget_area = get_post_meta($item_id, '_menu-item-widget_area', true);
        $block = get_post_meta($item_id, '_menu-item-block', true);

        $widgets_content = $block_html = '';

        if( $depth == 0) {
            if($design != '') {
                $classes[] = 'menu-'.$design;
            } else {
                $classes[] = 'menu-dropdown';
            }
            if($columns != '') $classes[] = 'columns-'.$columns;
        } else {
            if($design2 != '') $classes[] = 'item-design2-'.$design2;
            if($widget_area != '') {
                $classes[] = 'item-with-widgets';
                ob_start();
                dynamic_sidebar( $widget_area );
                $widgets = ob_get_contents();
                ob_end_clean();
                $widgets_content = '<div class="menu-widgets">' . $widgets . '</div>';
            }
            if(!empty($block)) {
                $classes[] = 'item-with-block';
                ob_start();
                et_show_block($block);
                $block_html = ob_get_contents();
                ob_end_clean();
                $block_html = '<div class="menu-block">' . $block_html . '</div>';
            }
        }

        if( $depth < 2) {
            if($disable_titles == 1) $classes[]= 'menu-disable_titles';
        }

        if($icon != '') $icon = '<i class="fa fa-'.$icon.'"></i>';
        if($label != '') $classes[]= 'badge-'.$label;
        
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';
        
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .=  ' class="item-link"';
        $description = '';
        if($item->description != '') {
        	$description = '<span class="menu-item-descr">'. do_shortcode($item->description) . '</span>';
        }
        $tooltip = '';

        if ( has_post_thumbnail( $item_id ) && $depth > 0 ) { 
            $tooltip = $this->et_get_tooltip_html($item_id);
        }

        $this->et_enque_styles($item_id, $depth);

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $icon;
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= $description;
        $item_output .= $tooltip;
        $item_output .= '</a>';
        $item_output .= $widgets_content;
        $item_output .= $block_html;
        $item_output .= $args->after;

        if( $depth === 0 && ($design == 'posts-subcategories' || in_array('menu-item-has-children', $item->classes) ) ){
            $item_output .="\n<div class=\"nav-sublist-dropdown\"><div class=\"container\">\n";
        }

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    } 

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        
        $design = get_post_meta($item->ID, '_menu-item-design', true);
        $widgets_content = '';

        if( $depth == 0 && $design == 'posts-subcategories') {
            $widgets_content = $this->getPostsSubcategories($item);
        } 


        if( $depth === 0 && ($design == 'posts-subcategories' || in_array('menu-item-has-children', $item->classes) ) ){
            $output .= $widgets_content;
            $output .="\n</div></div><!-- .nav-sublist-dropdown -->\n";
        }

        $output .= "</li>\n";
    }

    function et_enque_styles($item_id, $depth) {
        $post_thumbnail = get_post_thumbnail_id( $item_id, 'thumb' );
        $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail );
        $bg_position = get_post_meta($item_id, '_menu-item-background_position', true);
        $bg_repeat = get_post_meta($item_id, '_menu-item-background_repeat', true );
        $column_width = get_post_meta($item_id, '_menu-item-column_width', true );

        $bg_pos = $bg_rep = $styles = $styles_sublist = '';

        if($bg_position != '') {
            $bg_pos = "background-position: ".$bg_position.";";
        }

        if($bg_repeat != '') {
            $bg_rep = "background-repeat: ".$bg_repeat.";";
        }

        if(!empty($post_thumbnail_url)) {
            $styles_sublist .= $bg_pos.$bg_rep." background-image: url(".$post_thumbnail_url.");";
        }

        if( $depth == 1 && !empty($column_width)) {
            $styles .= 'width:' . $column_width . '%!important';
        }

        if( ! empty($styles) ) {
            echo '<style>.menu-item-'.$item_id.' {'.$styles.'}</style>';
        }

        if( ! empty($styles_sublist) ) {
            echo '<style>.menu-item-'.$item_id.' .nav-sublist-dropdown {'.$styles_sublist.'}</style>';
        }


        //add_action('wp_footer', function() use($styles) { die(); echo '<style>'.$styles.'</style>'; });

    }

    function et_get_tooltip_html($item_id) {
        $output = '';
        $post_thumbnail = get_post_thumbnail_id( $item_id );
        $post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail, 'large' );
        $output .= '<div class="nav-item-image">';
            $output .= '<img src="' . $post_thumbnail_url[0] . '" width="' . $post_thumbnail_url[1] . '" height="' . $post_thumbnail_url[2] . '" />';
        $output .= '</div>';
        return $output;
    }

    function getPostsSubcategories( $item ) {

        if( $item->object != 'category' ) return '';

        $cat_id = $item->object_id;
        $children = get_categories( array('child_of' => $cat_id) );

        $output = '<div class="posts-subcategories">';

            if( ! empty($children) ) {
                $cat_id = $children[0]->term_id;
                $output .= '<div class="subcategories-tabs"><ul>';

                foreach ($children as $child) {
                    $output .= '<li data-cat="' . $child->term_id . '">' . $child->name . '</li>';
                }

                $output .= '</ul></div><!-- .posts-subcategories -->';
            }


            $output .= '<div class="posts-content">';

                $output .= $this->getPostsByCategory( $cat_id );

            $output .= '</div><!-- .posts-content -->';


        $output .= '</div><!-- .posts-subcategories -->';

        return $output;
    }

    function getPostsByCategory( $cat = false ) {

        if( defined( 'DOING_AJAX' ) && DOING_AJAX  && isset( $_GET['cat'] ) ) {
            $cat = (int) $_GET['cat'];
        }

        if( ! $cat ) {
            return '';
        }

        $category = get_category( $cat );

        $posts = get_posts( array(
            'category' => $cat,
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'post_type' => 'post'
        ) );

        $output = '';

        if( ! empty($posts) ) {
            foreach ($posts as $post) {
                $output .= '<div class="post-preview">';

                $output .= '<div class="post-preview-thumbnail" onclick="window.location=\'' . get_the_permalink( $post->ID ) . '\'">';

                    $output .= get_the_post_thumbnail( $post->ID, 'medium' );

                    $output .= '<div class="post-category">' . $category->name . '</div>';

                $output .= '</div>';

                $output .= '<a href="'.get_the_permalink( $post->ID ).'">'. $post->post_title .'</a>';

                $output .= '</div>';
            }
        }

        
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            echo $output;
            die();
        } else {
            return $output;
        }
    }
}



class Et_Navigation_Mobile extends Walker_Nav_Menu
{

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $item_id =  $item->ID;

        $class_names = $value = '';

        $anchor = get_post_meta($item_id, '_menu-item-anchor', true);
        
        if(!empty($anchor)) {
            $item->url = $item->url.'#'.$anchor;
            if(($key = array_search('current_page_item', $item->classes)) !== false) {
                unset($item->classes[$key]);
            }
            if(($key = array_search('current-menu-item', $item->classes)) !== false) {
                unset($item->classes[$key]);
            }
        }
        
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'item-level-' . $depth;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';
        
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $tooltip = '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    } 
}
