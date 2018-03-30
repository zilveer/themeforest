<?php
    class LBSidebarResizer{
        function __construct( $template ){
            $this -> template = $template;
            $this -> templateID = '';
            $this -> layout_type = 'one_left_sidebar';
            $this -> elements = array(
                'first' => array(
                    'columns' => 3,
                    'id' => 'first',
                    'name' => __( 'First sidebar', 'cosmotheme' ),
                    'disabled' => false,
                    'sidebar' => 'main'
                ),
                'main' => array(
                    'columns' => 9,
                    'id' => 'main',
                    'name' => __( 'Main content', 'cosmotheme' ),
                    'disabled' => false
                ),
                'second' => array(
                    'columns' => 3,
                    'id' => 'second',
                    'name' => __( 'Left sidebar', 'cosmotheme' ),
                    'disabled' => true,
                    'sidebar' => 'main'
                )
            );
            $data = get_option( $this -> template . '_layout' );

            if( is_array( $data ) && isset( $data[ 'elements' ] ) && is_array( $data[ 'elements' ] ) ){
                $this -> elements = $data[ 'elements' ];
            }
            if( isset( $data[ 'template' ] ) && strlen( $data[ 'template' ] ) ){
                $this -> templateID = $data[ 'template' ];
            }
            if( isset( $data[ 'layout_type' ] ) && strlen( $data[ 'layout_type' ] ) ){
                $this -> layout_type = $data[ 'layout_type' ];
            }

            global $wp_registered_sidebars;
            $this -> sidebars = array();
            foreach( $wp_registered_sidebars as $sidebar ){
                $this -> sidebars[ $sidebar[ 'id' ] ] = $sidebar[ 'name' ];
            }

            $this -> scriptdata = array();
            $this -> scriptdata[ 'columns' ][ 'classes' ] = implode( ' ', LBRenderable::$words );
            $this -> scriptdata[ 'columns' ][ 'arr' ] = LBRenderable::$words;
            $this -> scriptdata[ 'translations' ][ 'cannot_add_columns' ] = __( 'Cannot add more columns', 'cosmotheme' );
        }

        function render_backend(){
            wp_enqueue_style( 'layout-builder-css', get_template_directory_uri() . '/lib/css/layoutbuilder.css' );
            wp_enqueue_script( 'sidebar-resizer-js', get_template_directory_uri() . '/lib/js/sidebar-resizer.js', array( 'jquery-ui-sortable', 'jquery-ui-draggable' ) );
            wp_localize_script( 'sidebar-resizer-js', 'SidebarResizer', $this -> scriptdata );
            include get_template_directory() . '/lib/templates/sidebarresizer.php';
        }

        function render(){
            ob_start();
            $this -> render_backend();
            return ob_get_clean();
        }

        function render_frontend( $callback = false ){

            /*check if we do not have sidebars (both sidebars are disabled)*/
            if(isset($this -> elements['first']['disabled']) && isset($this -> elements['second']['disabled']) &&
                $this -> elements['first']['disabled'] == 'true' && $this -> elements['second']['disabled'] == 'true'){

                $need_row_container = false;
            }else{ /*if we have at least one sidebar, then we need row container*/
                $need_row_container = true;
            }

            if($need_row_container){ 
                echo '<div class="row">';    
            }
            
            $sidebar_class = ' sidebar-left ';


            foreach( $this -> elements as $element ){
                if( 'true' != $element[ 'disabled' ] ){
                    $columns = $element[ 'columns' ];
                    if( 'main' == $element[ 'id' ] ){
                        $sidebar_class = ' sidebar-right '; /*all sidebars listed after main content will have class 'sidebar-right' */
                        $side_class = '';
                    }else{
                        $side_class = $sidebar_class;
                    }
                     
                    if($need_row_container){  
                        echo '<div class="'. $side_class . LBRenderable::$words[ $element[ 'columns' ] ] . ' columns">';
                    }
                        if( 'main' != $element[ 'id' ] ){
                            dynamic_sidebar( $element[ 'sidebar' ] );
                        }else{
                            $builder = $this -> get_builder();
                            $builder -> callback = $callback;
                            $builder -> render_content();
                        }
                    if($need_row_container){     
                        echo '</div>';
                    }
                }
            }
            if($need_row_container){  
                echo '</div>';
            }
        }

        function get_builder(){
            $builder = LBTemplate::get_template( $this -> template );
            $builder -> layout_has_sidebars = ( 'true' != $this -> elements[ 'first' ][ 'disabled' ]  ) || ( 'true' != $this -> elements[ 'second' ][ 'disabled' ] );
            return $builder;
        }

        function get_prefix( $element ){
            return $this -> template . '_layout[elements][' . $element[ 'id' ] . ']';
        }

        function get_simpler_prefix(){
           return $this -> template . '_layout';
        }
    }
?>