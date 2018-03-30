<?php
    class TooltipPlace{
        function __construct( $data ){
            $this -> id = '_place_';
            $this -> name = '';
            $this -> elements = array();
            $this -> tooltips = array();
            $this -> placeurl = '';
            foreach( $data as $key => $val ){
                if( ( is_array( $val ) && count( $val ) ) || strlen( $val ) ){
                    $this -> {$key} = $val;
                }
            }

            if( !strlen( $this -> placeurl ) ){
                if( 'frontpage' == $this -> id ){
                    $this -> placeurl = get_home_url();
                }else if( is_numeric( $this -> id ) ){
                    $this -> placeurl = get_permalink ( $this -> id );
                }
            }
        }

        function render_backend(){
            $this -> load_tooltips();
            include get_template_directory() . '/lib/templates/tooltipplace.php';
        }

        function render_frontend(){
            if( ( isset( $_COOKIE[ ZIP_NAME . '_tour_closed_' . $this -> id . '_' . 't' ] ) && $_COOKIE[ ZIP_NAME . '_tour_closed_'  . $this -> id . '_' . 't' ] != 'true' ) || !isset( $_COOKIE[ ZIP_NAME . '_tour_closed_'  . $this -> id . '_' . 't' ] ) ){
                $this -> load_tooltips();
                $count = count( $this -> tooltips );
                foreach( $this -> tooltips as $index => $tooltip ){
                    $tooltip -> render_frontend( $index + 1, $count );
                }
            }
        }

        function load_tooltips(){
            foreach( $this -> elements as $element ){
                $element[ 'place' ] = $this -> id;
                array_push( $this -> tooltips, new TooltipElement( $element ) );
            }
        }
    }
?>