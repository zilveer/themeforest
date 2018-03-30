<?php

if ( ! class_exists( 'PGL_Integrate' ) ) {
    PGL_Loader::find_class( 'Integrate', _PREFIX_, 'redux/extras' );
}

class PGL_Integrate_ACF extends PGL_Integrate
{
    function add_section( ) {
        $acf = array(
            'icon'       => 'home',
            'icon_class' => 'icon-2x',
            'title'      => __( 'ACF Integrate', PGL ),
            'desc'       => __( 'You can change settings for Advanced Custom Fields plugins here ', PGL ),
            'sub_desc'   => __( 'Just a dummy description', PGL ),
            'fields'     => array(
                array(
                    'id'    => 'estate_advanced_searchable_group',
                    'title' => __( 'Searchable Group', PGL ),
                    'type'  => 'posts_select',
                    'args'  => array(
                        'post_type' => 'acf'
                    )
                ),
                array(
                    'id'       => 'estate_advanced_searchable_fields',
                    'title'    => __( 'Searchable fields', PGL ),
                    'callback' => array( $this, 'acf_searchable_callback' ),
                    'sub_desc' => __( 'Note : Only fields that have type of number or text are searchable', PGL )
                )
            )
        );
        parent::add_section( $acf );
    }

    function acf_searchable_callback( $field, $value ) {
        global $pgl_options;
        if (  $group_id = $pgl_options->option('estate_advanced_searchable_group') )  {
            if ( class_exists( 'acf' ) ) {
                $acf    = new acf_field_group();
                $fields = array();
                $fields = $acf->get_fields( $fields, $group_id );
                if ( ! empty( $fields ) ) {
                    if ( ! is_array( $value ) )
                        $value = array();
                    $searchable_type = array( 'text', 'number' ); //specify types that are searchable
                    foreach ( $fields as $f ) {
                        if ( ! in_array( $f['type'], $searchable_type ) )
                            continue;
                        echo "<label><input type='checkbox' name='" . $this->option->THEME_OPTION . "[{$field['id']}][]" . "' value='{$f['key']}' " . ( in_array( $f['key'], $value ) ? 'checked="checked"' : '' ) . " /> {$f['label']}</label>";
                    }
                }
            }
        }
    }
}
?>
