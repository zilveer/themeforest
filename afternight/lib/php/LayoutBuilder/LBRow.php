<?php
    class LBRow{
        function __construct( $data ){
            $this -> id = '__row__';
            $this -> _elements = array();
            $this -> elements = array();
            $this -> is_additional = false;
            $this -> row_width = 'full_width_no';
            $this -> row_content_width = 'full_width_content_no';
            $this -> row_bottom_margin_removed = 'no';
            $this -> deactivate_row = 'no';
            $this -> row_bg_color = '';
            foreach( $data as $identifier => $value ){
                $this ->{ $identifier } = $value;
            }
            foreach( $this -> _elements as $data ){
                $element = new LBElement( $data );
                $element -> row =& $this;
                $this -> elements[ $element -> id ] = $element;
            }
        }

        function get_prefix(){
            return $this -> template -> get_prefix() . "[_rows][$this->id]";
        }

        function render_backend(){
            include get_template_directory() . '/lib/templates/layoutrow.php';
        }

        function render_content(){
            if( count( $this -> elements ) && $this -> deactivate_row != 'yes'){ 
                if( (isset($this -> row_width) && $this -> row_width == 'full_width_yes') || (isset($this -> row_content_width) && $this -> row_content_width == 'full_width_content_yes') ){
                    /*output a container div that will expand to full width*/
                    $row_bg_color = '';
                    if(isset($this -> row_bg_color) && strlen($this -> row_bg_color)){
                        $row_bg_color = ' background-color:'.$this -> row_bg_color.' ';
                    }

                    if(isset($this -> row_content_width) && $this -> row_content_width == 'full_width_content_yes'){
                        /*add a class if user wants the content expanded on full width*/
                        $content_width_class = ' full_width_content_row ';
                    }else{
                        $content_width_class = '  ';
                    }

                    echo '<div class="full_width_row '.$content_width_class.'" style="'.$row_bg_color.'">';
                }
                
                $element_class = 'element'; /*this class adds margin bottom 30px*/ 

                if( $this -> row_bottom_margin_removed == 'yes' ){
                    /* if bottom margin is removed we don't want 'element' class */
                    $element_class = ' ';
                }


                foreach( $this -> elements as $element ){
                    if($element->type == 'delimiter'){
                        $element_class = ' ';
                    }
                }
                
                                if(isset($this -> id)){
                    $row_unique_class = ' row_id_'. $this -> id .' ';
                }else{
                    $row_unique_class = ' ';
                }

                echo '<div class="row '.$element_class. $row_unique_class .'">';
                foreach( $this -> elements as $element ){
                    if ($element->type == 'testimonials') {
                        echo '<div class="testimonials-view">';
                    }
                    $element -> render_frontend();
                    if ($element->type == 'testimonials') {
                        echo '</div>';
                    }
                }
                echo '</div>';                
                if( (isset($this -> row_width) && $this -> row_width == 'full_width_yes') || (isset($this -> row_content_width) && $this -> row_content_width == 'full_width_content_yes') ){
                    /*close container div that will expand to full width*/
                    echo '</div>';
                }   
            }
        }
    }
?>