<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/10/16
 * Time: 9:00 PM
 */
if ( !function_exists( 'houzez_property_state_add_meta_fields' ) ) :
    function houzez_property_state_add_meta_fields() {
        $houzez_meta = houzez_get_property_state_meta();
        $all_countries = houzez_get_all_countries();
        ?>

        <div class="form-field">
            <label><?php _e( 'Which country has this state?', 'houzez' ); ?></label>
            <select name="fave[parent_country]" class="widefat">
                <?php echo $all_countries; ?>
            </select>
            <p class="description"><?php _e( 'Select country which has this state.', 'houzez' ); ?></p>
        </div>



        <?php
    }
endif;

add_action( 'property_state_add_form_fields', 'houzez_property_state_add_meta_fields', 10, 2 );


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   2.0 - Edit meta field
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

if ( !function_exists( 'houzez_property_state_edit_meta_fields' ) ) :
    function houzez_property_state_edit_meta_fields( $term ) {
        $houzez_meta = houzez_get_property_state_meta();

        if(is_object ($term)) {
            $term_id      =  $term->term_id;
            $term_meta    =  get_option( "_houzez_property_state_$term_id" );
            $parent_country  =  $term_meta['parent_country'] ? $term_meta['parent_country'] : '';
            $all_countries   =  houzez_get_all_countries($parent_country);

        } else {
            $all_countries   =  houzez_get_all_countries();
        }
        ?>

        <tr class="form-field">
            <th scope="row" valign="top"><label><?php _e( 'Which country has this state?', 'houzez' ); ?></label></th>
            <td>
                <select name="fave[parent_country]" class="widefat">
                    <?php echo $all_countries; ?>
                </select>
                <p class="description"><?php _e( 'Select country which has this state.', 'houzez' ); ?></p>
            </td>
        </tr>

        <?php
    }
endif;

add_action( 'property_state_edit_form_fields', 'houzez_property_state_edit_meta_fields', 10, 2 );


if ( !function_exists( 'houzez_save_property_state_meta_fields' ) ) :
    function houzez_save_property_state_meta_fields( $term_id ) {

        if ( isset( $_POST['fave'] ) ) {

            $houzez_meta = array();

            $houzez_meta['parent_country'] = isset( $_POST['fave']['parent_country'] ) ? $_POST['fave']['parent_country'] : '';

            update_option( '_houzez_property_state_'.$term_id, $houzez_meta );
        }

    }
endif;

add_action( 'edited_property_state', 'houzez_save_property_state_meta_fields', 10, 2 );
add_action( 'create_property_state', 'houzez_save_property_state_meta_fields', 10, 2 );
?>