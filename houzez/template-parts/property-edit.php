<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 07/10/15
 * Time: 3:45 PM
 */
global $hide_add_prop_fields, $required_fields;

if( is_page_template( 'template/submit_property.php' ) ) {

    // Check Author
    global $current_user, $prop_data, $prop_meta_data;
    wp_get_current_user();

    $edit_prop_id = intval( trim( $_GET['edit_property'] ) );
    $prop_data    = get_post( $edit_prop_id );

    if ( ! empty( $prop_data ) && ( $prop_data->post_type == 'property' ) ) {
        $prop_meta_data = get_post_custom( $prop_data->ID );
        ?>

        <form id="new_post" name="new_post" method="post" action="" enctype="multipart/form-data" class="update-frontend-property">

            <?php
            $layout = houzez_option('property_form_sections');
            $layout = $layout['enabled'];

            if ($layout): foreach ($layout as $key=>$value) {

                switch($key) {

                    case 'description-price':
                        get_template_part( 'template-parts/edit-property/description-price' );
                        break;

                    case 'media':
                        get_template_part( 'template-parts/edit-property/media' );
                        break;

                    case 'details':
                        get_template_part( 'template-parts/edit-property/details' );
                        break;

                    case 'features':
                        get_template_part( 'template-parts/edit-property/features' );
                        break;

                    case 'location':
                        get_template_part( 'template-parts/edit-property/location' );
                        break;

                    case 'floorplans':
                        get_template_part('template-parts/edit-property/floorplans');
                        break;

                    case 'multi-units':
                        get_template_part('template-parts/edit-property/multi-units');
                        break;

                    case 'agent_info':
                        get_template_part('template-parts/edit-property/agent-info');
                        break;
                }

            }
            endif;

            ?>

            <div class="account-block text-right">
                <?php wp_nonce_field('submit_property', 'property_nonce'); ?>
                <input type="hidden" name="action" value="update_property"/>
                <input type="hidden" name="prop_id" value="<?php echo intval( $prop_data->ID ); ?>"/>
                <input type="hidden" name="prop_featured" value="<?php if( isset( $prop_meta_data['fave_featured'] ) ) { echo sanitize_text_field( $prop_meta_data['fave_featured'][0] ); } ?>">
                <!--<input type="hidden" name="prop_agent_display_option" value="<?php /*if( isset( $prop_meta_data['fave_agent_display_option'] ) ) { echo sanitize_text_field( $prop_meta_data['fave_agent_display_option'][0] ); } */?>"/>-->
                <input type="hidden" name="prop_payment" value="<?php if( isset( $prop_meta_data['fave_payment_status'] ) ) { echo sanitize_text_field( $prop_meta_data['fave_payment_status'][0] ); } ?>"/>
                <button type="submit" id="update_property" class="btn btn-primary"><?php esc_html_e( 'Update Property', 'houzez' ); ?></button>
            </div>
        </form>

        <?php
    }
}


