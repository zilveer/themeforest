<?php
	class TooltipElement{
		function __construct( $data ){
            $this -> id = '_id_';
            $this -> place = '_place_';
            $this -> arrow = 'left';
            $this -> x = 100;
            $this -> y = 100;
            $this -> title = __( 'Double click this title', 'cosmotheme' ) . '<br>' . __( 'for quick edit', 'cosmotheme' );
            $this -> description_overview = __( 'Double click this description for quick edit', 'cosmotheme' ) . '<br>' . __( "Drag the tooltip to sort it", 'cosmotheme' ) . '<br>' . __( "Click 'Edit' to place this tooltip", 'cosmotheme' );
            $this -> description =  __( 'Double click this description for quick edit', 'cosmotheme' ) . '<br>' . __( "Drag the tooltip to place it", 'cosmotheme' ) . '<br>' . __( "Or use the input below to position", 'cosmotheme' ) . '<br>' . __( "Click on the arrow to change it", 'cosmotheme' );
            foreach( $data as $key => $val ){
                if( ( is_array( $val ) && count( $val ) ) || strlen( $val ) ){
                    $this -> {$key} = $val;
                }
            }
		}

		function render_backend(){
			include get_template_directory() . '/lib/templates/tooltipelement.php';
		}

		function render_frontend( $index, $count ){
            $place = $this -> place;
            if( $index == $count ){
                tools::tour( array( $this -> y , $this -> x ) , $this -> place, 't', $this -> arrow , $this -> title , $this -> description , $index . '/' . $count , false );
            }else{
                tools::tour( array( $this -> y , $this -> x ) , $this -> place, 't', $this -> arrow , $this -> title , $this -> description , $index . '/' . $count );
            }
		}
	}
?>