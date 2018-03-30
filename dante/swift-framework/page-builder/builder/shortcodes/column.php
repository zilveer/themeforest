<?php

	/*
	*
	*	Swift Page Builder - Column Shortcode Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*/

	class SwiftPageBuilderShortcode_spb_column extends SwiftPageBuilderShortcode {

	    public function content( $atts, $content = null ) {

	        $col_el_class = $width = $el_position = '';

	        extract(shortcode_atts(array(
	            'col_el_class' => '',
	            'el_position' => '',
	            'width' => '1/2'
	        ), $atts));

	        $output = '';

	        $col_el_class = $this->getExtraClass($col_el_class);
	        $orig_width = $width;
	        $width = spb_translateColumnWidthToSpan($width);

	        if ( $this->shortcode == 'spb_column' ) {
	            $col_el_class .= ' column_container';
	        }
	        else if ( $this->shortcode == 'spb_text_block' ) {
	            $col_el_class .= ' spb_text_column';
	        }

			global $column_width;

			if ($orig_width != "") {
				$column_width = $orig_width;
			}

	        $output .= "\n\t".'<div class="spb_content_element '.$width.$col_el_class.'">';
	        $output .= "\n\t\t".'<div class="spb_wrapper">';
	        $output .= "\n\t\t\t". spb_format_content($content);
	        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
	        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

	        $column_width = "";

	        $output = $this->startRow($el_position, $orig_width) . $output . $this->endRow($el_position, 'column');
	        return $output;
	    }

	    public function contentAdmin($atts, $content = null) {
	        $col_el_class = $width = '';
	        extract(shortcode_atts(array(
	            'width' => 'column_12',
	            'col_el_class' => ''
	        ), $atts));

	        $output = '';

	        $column_controls = $this->getColumnControls('column');

	        if ( $width == 'column_14' || $width == '1/4' ) {
	            $width = array('span3');
	        }
	        else if ( $width == 'column_14-14-14-14' ) {
	            $width = array('span3', 'span3', 'span3', 'span3');
	        }
	        else if ( $width == 'column_14-12-14' ) {
	            $width = array('span3', 'span6', 'span3');
	        }
	        else if ( $width == 'column_12-14-14' ) {
	            $width = array('span6', 'span3', 'span3');
	        }
	        else if ( $width == 'column_14-14-12' ) {
	            $width = array('span3', 'span3', 'span6');
	        }
	        else if ( $width == 'column_13' || $width == '1/3' ) {
	            $width = array('span4');
	        }
	        else if ( $width == 'column_13-23' ) {
	            $width = array('span4', 'span8');
	        }
	        else if ( $width == 'column_23-13' ) {
	            $width = array('span8', 'span4');
	        }
	        else if ( $width == 'column_13-13-13' ) {
	            $width = array('span4', 'span4', 'span4');
	        }

	        else if ( $width == 'column_12' || $width == '1/2' ) {
	            $width = array('span6');
	        }
	        else if ( $width == 'column_12-12' ) {
	            $width = array('span6', 'span6');
	        }

	        else if ( $width == 'column_23' || $width == '2/3' ) {
	            $width = array('span8');
	        }
	        else if ( $width == 'column_34' || $width == '3/4' ) {
	            $width = array('span9');
	        }
	        else if ( $width == 'column_16' || $width == '1/6' ) {
	            $width = array('span2');
	        }
	        else {
	            $width = array('span12');
	        }


	        for ( $i=0; $i < count($width); $i++ ) {
	            $output .= '<div data-element_type="spb_column" class="spb_column spb_sortable spb_droppable '.$width[$i].' not-column-inherit">';
	            $output .= '<input type="hidden" class="spb_sc_base" name="" value="spb_column" />';
	            
	            $output .= str_replace("%column_size%", spb_translateColumnWidthToFractional($width[$i]), $column_controls);
	            $output .= '<div class="spb_element_wrapper">';
	            $output .= '<div class="row-fluid spb_column_container spb_sortable_container not-column-inherit">';
	            $output .= do_shortcode( shortcode_unautop($content) );
	            $output .= SwiftPageBuilder::getInstance()->getLayout()->getContainerHelper();
	            $output .= '</div>';
	            $output .= '<input type="hidden" class="spb_param_value col_el_class textfield " name="col_el_class" value="' . $col_el_class . '">';
	            $output .= '</div>';  
	            $output .= '</div>';
	        }
	       


	        return $output;
	    }
	}

	SPBMap::map( 'spb_column', array(
	    "name"		=> __("Column", "swift-framework-admin"),
	    "base"		=> "spb_column",
	    "controls"	=> "full",
	    "content_element" => false,
	    "params"	=> array(
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "swift-framework-admin"),
	            "param_name" => "col_el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin")
	        )
	    )
	) );

?>
