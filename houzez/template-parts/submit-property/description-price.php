<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 18/01/16
 * Time: 5:31 PM
 */
global $houzez_local, $hide_add_prop_fields, $required_fields;
?>

<div class="account-block">
    <div class="add-title-tab">
        <h3><?php echo $houzez_local['prop_des_price']; ?></h3>
        <div class="add-expand"></div>
    </div>
    <div class="add-tab-content">
        <div class="add-tab-row push-padding-bottom">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="prop_title"><?php echo $houzez_local['prop_title'].houzez_required_field( $required_fields['title'] ); ?> </label>
                        <input type="text" id="prop_title" class="form-control" name="prop_title" placeholder="<?php echo $houzez_local['prop_title_placeholder']; ?>"/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label><?php echo $houzez_local['prop_des']; ?></label>
                        <!-- <textarea id="prop_des" class="form-control" tabindex="3" name="prop_des" rows="6"></textarea> -->
                        <?php 
                        // default settings - Kv_front_editor.php
                        $content = '';
                        $editor_id = 'prop_des';
                        $settings =   array(
                            'wpautop' => true, // use wpautop?
                            'media_buttons' => true, // show insert/upload button(s)
                            'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
                            'textarea_rows' => get_option('default_post_edit_rows', 18 ), // rows="..."
                            'tabindex' => '',
                            'editor_css' => '', //  extra styles for both visual and HTML editors buttons, 
                            'editor_class' => '', // add extra class(es) to the editor textarea
                            'teeny' => false, // output the minimal editor config used in Press This
                            'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                            'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                            'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                        );
                        wp_editor( $content, $editor_id, $settings ); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="add-tab-row push-padding-bottom">
            <div class="row">
                <?php if( $hide_add_prop_fields['prop_type'] != 1 ) { ?>
                <div class="col-sm-4">
                    <div class="form-group">

                        <label for="prop_type"><?php echo $houzez_local['prop_type'].houzez_required_field( $required_fields['prop_type'] ); ?></label>
                        <select name="prop_type" id="prop_type" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                            <option selected="selected" value=""><?php esc_html_e('None', 'houzez'); ?></option>
                            <?php
                            /* Property Type */
                            $property_types_terms = get_terms (
                                array(
                                    "property_type"
                                ),
                                array(
                                    'orderby' => 'name',
                                    'order' => 'ASC',
                                    'hide_empty' => false,
                                    'parent' => 0
                                )
                            );

                            houzez_id_based_hirarchical_options( 'property_type', $property_types_terms, -1);

                            ?>
                        </select>

                    </div>
                </div>
                <?php } ?>

                <?php if( $hide_add_prop_fields['prop_status'] != 1 ) { ?>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="prop_status"><?php echo $houzez_local['prop_status'].houzez_required_field( $required_fields['prop_status'] ); ?></label>
                        <select name="prop_status" id="prop_status" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                            <option selected="selected" value=""><?php esc_html_e('None', 'houzez'); ?></option>
                            <?php
                            /* Property Status */
                            $property_status = get_terms (
                                array(
                                    "property_status"
                                ),
                                array(
                                    'orderby' => 'name',
                                    'order' => 'ASC',
                                    'hide_empty' => false,
                                    'parent' => 0
                                )
                            );

                            houzez_id_based_hirarchical_options( 'property_status', $property_status, -1);

                            ?>
                        </select>
                    </div>
                </div>
                <?php } ?>

                <?php if( $hide_add_prop_fields['prop_label'] != 1 ) { ?>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="prop_labels"><?php echo $houzez_local['prop_label'].houzez_required_field( $required_fields['prop_labels'] ); ?></label>
                            <select name="prop_labels" id="prop_labels" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                                <option selected="selected" value=""><?php esc_html_e('None', 'houzez'); ?></option>
                                <?php
                                /* Property Label */
                                $property_label = get_terms (
                                    array(
                                        "property_label"
                                    ),
                                    array(
                                        'orderby' => 'name',
                                        'order' => 'ASC',
                                        'hide_empty' => false,
                                        'parent' => 0
                                    )
                                );

                                houzez_id_based_hirarchical_options( 'property_label', $property_label, -1);

                                ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
        <div class="add-tab-row push-padding-bottom">
            <div class="row">

                <?php if( $hide_add_prop_fields['sale_rent_price'] != 1 ) { ?>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="prop_price"> <?php echo $houzez_local['prop_sale_rent_price'].houzez_required_field( $required_fields['sale_rent_price'] );
                            print esc_html(get_option('houzez_currency_symbol', '')) . ' ';?>  </label>
                        <input type="text" id="prop_price" class="form-control" name="prop_price" value="" placeholder="<?php echo $houzez_local['prop_sale_rent_price_placeholder']; ?>">
                    </div>
                </div>
                <?php } ?>

                <?php if( $hide_add_prop_fields['second_price'] != 1 ) { ?>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="prop_sec_price"><?php echo $houzez_local['prop_second_price']; ?></label>
                        <input type="text" id="prop_sec_price" class="form-control" name="prop_sec_price" placeholder="<?php echo $houzez_local['prop_second_price_placeholder']; ?>">
                    </div>
                </div>
                <?php } ?>

                <?php if( $hide_add_prop_fields['price_postfix'] != 1 ) { ?>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="prop_label"><?php echo $houzez_local['prop_price_label'].houzez_required_field( $required_fields['price_label'] ); ?></label>
                        <input type="text" id="prop_label" class="form-control" name="prop_label" placeholder="<?php echo $houzez_local['prop_price_label_placeholder']; ?>" >
                    </div>
                </div>
                <?php } ?>

                <?php if( $hide_add_prop_fields['price_prefix'] != 1 ) { ?>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="prop_price_prefix"><?php echo $houzez_local['prop_price_prefix']; ?></label>
                            <input type="text" id="prop_price_prefix" class="form-control" name="prop_price_prefix" placeholder="<?php echo $houzez_local['prop_price_prefix_placeholder']; ?>" >
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
