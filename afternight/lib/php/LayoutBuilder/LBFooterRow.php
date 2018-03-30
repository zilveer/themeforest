<?php
    class LBFooterRow extends LBRow{
        function __construct( $data ){
            $this -> id = '__row__';
            $this -> _elements = array();
            $this -> elements = array();
            $this -> row_width = 'full_width_no';
            $this -> row_content_width = 'full_width_content_no';
            $this -> row_bottom_margin_removed = 'no';
            $this -> deactivate_row = 'no';
            $this -> row_bg_color = '';
            $this -> is_additional = false;
            foreach( $data as $identifier => $value ){
                $this ->{ $identifier } = $value;
            }
            foreach( $this -> _elements as $data ){
                $element = new LBFooterElement( $data );
                $element -> row =& $this;
                $this -> elements[ $element -> id ] = $element;
            }
        }

        function get_prefix(){
            return $this -> template -> get_prefix() . "[_footer_rows][$this->id]";
        }

        function render_backend(){
            include get_template_directory() . '/lib/templates/layoutrow.php';
        }
    }
?>