<?php
    class LBPageResizer extends LBSidebarResizer{
        function __construct(){
            $this -> args_post_type = func_get_args(); /*arguments passed when object is initialized*/

            $this -> template = '';
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
            $this -> load_all();
            $builder = new LBTemplateBuilder();
            $builder -> load_all();
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

        function __toString(){
            return $this -> render();
        }

        function load_all(){
            global $post;
            $data = meta::get_meta( $post -> ID, 'layout' );

            if( is_array( $data ) && isset( $data[ 'elements' ] ) && is_array( $data[ 'elements' ] ) ){
                $this -> elements = $data[ 'elements' ];
            }else{
                $post_type = 'single';
                if(isset($_GET['post_type']) && strlen($_GET['post_type'])){
                    $post_type = $_GET['post_type'];
                }else if(is_array($this -> args_post_type) && sizeof($this -> args_post_type)){
                    $post_type = $this -> args_post_type[0]; /*assign to post type the type passed when object was initialized */
                }
                $default_layout = new LBSidebarResizer( $post_type );
                $default_template = $default_layout -> get_builder();
                $this -> templateID = $default_template -> id;
                $this -> elements = $default_layout -> elements;
                $this -> layout_type = $default_layout -> layout_type;
            }

            if( isset( $data[ 'template' ] ) ){
                $this -> templateID = $data[ 'template' ];
            } 
            if( isset( $data[ 'layout_type' ] ) && strlen( $data[ 'layout_type' ] ) ){
                $this -> layout_type = $data[ 'layout_type' ];
            }
        }

        function render_frontend( $callback = false ){
            $this -> load_all();
            $builder = $this -> get_builder();
            if($builder -> layout_has_sidebars) { echo '<div class="row">'; }
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

                    if($builder -> layout_has_sidebars){ 
                        echo '<div class="' . $side_class . LBRenderable::$words[ $element[ 'columns' ] ] . ' columns">';
                    }
                    if( 'main' != $element[ 'id' ] ){
                        dynamic_sidebar( $element[ 'sidebar' ] );
                    }else{
                        $builder = $this -> get_builder();
                        $builder -> callback = $callback;
                        $builder -> render_content();
                    }
                    if($builder -> layout_has_sidebars){
                        echo '</div>';
                    }
                }
            }
            if($builder -> layout_has_sidebars) { echo '</div>'; }           
        }

        function get_builder(){
            $builder = LBTemplate::get_template_by_id( $this -> templateID );
            $builder -> layout_has_sidebars = ( 'true' != $this -> elements[ 'first' ][ 'disabled' ]  ) || ( 'true' != $this -> elements[ 'second' ][ 'disabled' ] );
            return $builder;
        }

        function get_prefix( $element ){
            return 'layout[elements][' . $element[ 'id' ] . ']';
        }

        function get_simpler_prefix(){
            return 'layout';
        }
    }
?>