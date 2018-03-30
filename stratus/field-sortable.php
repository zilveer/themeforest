<?php
/**
 * This class defines new "phone" field type for Meta Box class
 *
 * @author Tran Ngoc Tuan Anh <rilwis@gmail.com>
 * @package Meta Box
 * @see http://metabox.io/?post_type=docs&p=390
 */
if (class_exists('RWMB_Field') ){
    class RWMB_Sortable_Field extends RWMB_Field
    {
        /**
         * Get field HTML
         *
         * @param mixed $meta
         * @param array $field
         *
         * @return string
         */
        static public function html( $meta, $field )
        {
            extract( $field );


            /* build checkbox */
            if (isset($choices) && is_array($choices) && !empty($choices)) {
                $output = '<ul class="format-setting-inner" id="themo_sortable">';

                foreach ($choices as $key => $choice ) {
                    if (isset($choice['value']) && isset($choice['name'])) {

                        $meta_box_name = '';
                        if (isset( $choice['meta_name'] )){
                            $meta_box_name = $choice['meta_name'];
                        }

                        $output .= '<li class="ui-state-default">';
                        $output .= '<input type="hidden" data-meta-box-name="'.$meta_box_name.'"  name="' . esc_attr( $field_name ) . '[' . esc_attr( $key ) . ']" id="' . esc_attr( $field_name ) . '-' . esc_attr( $key ) . '" value="' . ( isset( $field_value[$key] ) ?  $field_value[$key] : esc_attr( $choice['value'] ) ) . '" />';
                        $output .= '<label for="' . esc_attr( $field_name ) . '-' . esc_attr( $key ) . '">' . esc_attr( $choice['name'] ) ;
                        $output .=  '</label>';
                    }
                }

                $output .= '</ul>';
            }else {
                $output =  esc_html__('Add some meta boxes using the Meta Box Builder', 'stratus');
            }

            return $output;

        }

    }
}