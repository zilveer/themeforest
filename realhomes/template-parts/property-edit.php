<?php
/*
 *  This file is only to be used with in template-submit-property.php
 */

if ( is_page_template( 'template-submit-property.php' ) ) {

    $edit_property_id = intval( trim( $_GET['edit_property'] ) );
    $target_property = get_post( $edit_property_id );

    /* check if passed id is a proper property post */
    if ( ! empty( $target_property ) && ( $target_property->post_type == 'property' ) ) {

        // Check Author
        global $current_user;
        get_currentuserinfo();

        /* check if current logged in user is the author of property */
        if( $target_property->post_author == $current_user->ID ){

            $post_meta_data = get_post_custom( $target_property->ID );
            ?>
            <form id="submit-property-form" class="submit-form" enctype="multipart/form-data" method="post">
                <div class="row-fluid">
                    <div class="span6">

                        <div class="form-option">
                            <label for="inspiry_property_title"><?php _e('Property Title','framework'); ?></label>
                            <input id="inspiry_property_title" name="inspiry_property_title" type="text" class="required" value="<?php echo $target_property->post_title; ?>" title="<?php _e( '* Please provide property title!', 'framework'); ?>" autofocus required/>
                        </div>

                        <div class="form-option">
                            <label for="description"><?php _e('Property Description','framework'); ?></label>
                            <textarea name="description" id="description" cols="30" rows="5"><?php echo $target_property->post_content; ?></textarea>
                        </div>

                        <div class="form-options-container clearfix">

                            <div class="form-option">
                                <label for="type"><?php _e('Type', 'framework'); ?></label>
                                <span class="selectwrap">
                                    <select name="type" id="type" class="search-select">
                                        <?php edit_form_hierarchical_options( $target_property->ID, 'property-type'); ?>
                                    </select>
                                </span>
                            </div>

                            <div class="form-option">
                                <label for="status"><?php _e('Status', 'framework'); ?></label>
                                <span class="selectwrap">
                                    <select name="status" id="status" class="search-select">
                                        <?php edit_form_taxonomy_options( $target_property->ID, 'property-status'); ?>
                                    </select>
                                </span>
                            </div>

                            <div class="clearfix"></div>

                            <?php
                            // number of locations chosen from theme options
                            $location_select_count = inspiry_get_locations_number();

                            // Variable that contains location select boxes names
                            $location_select_names = inspiry_get_location_select_names();;

                            // Default location select boxes titles
                            $location_select_titles = inspiry_get_location_titles();

                            /* Generate required location select boxes */
                            for( $i=0; $i < $location_select_count; $i++ ) {
                                ?>
                                <div class="option-bar form-option">
                                    <label for="<?php echo $location_select_names[$i];  ?>"><?php echo $location_select_titles[$i] ?></label>
                                    <span class="selectwrap">
                                        <select name="<?php echo $location_select_names[$i]; ?>" id="<?php echo $location_select_names[$i];  ?>" class="search-select"></select>
                                    </span>
                                </div>
                                <?php
                            }

                            // important action hook - related JS works based on it
                            do_action( 'after_location_fields' );

                            ?>

                            <div class="clearfix"></div>

                            <div class="form-option">
                                <label for="bedrooms"><?php _e('Bedrooms', 'framework'); ?></label>
                                <input id="bedrooms" name="bedrooms" type="text" value="<?php if( isset($post_meta_data['REAL_HOMES_property_bedrooms']) ){ echo $post_meta_data['REAL_HOMES_property_bedrooms'][0]; } ?>" title="<?php _e( '* Please provide the value in only digits!', 'framework'); ?>" />
                            </div>

                            <div class="form-option">
                                <label for="bathrooms"><?php _e('Bathrooms', 'framework'); ?></label>
                                <input id="bathrooms" name="bathrooms" type="text" value="<?php if( isset($post_meta_data['REAL_HOMES_property_bathrooms']) ){ echo $post_meta_data['REAL_HOMES_property_bathrooms'][0]; } ?>" title="<?php _e( '* Please provide the value in only digits!', 'framework'); ?>" />
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-option">
                                <label for="garages"><?php _e('Garages', 'framework'); ?></label>
                                <input id="garages" name="garages" type="text" value="<?php if( isset($post_meta_data['REAL_HOMES_property_garage']) ){ echo $post_meta_data['REAL_HOMES_property_garage'][0]; } ?>" title="<?php _e( '* Please provide the value in only digits!', 'framework'); ?>" />
                            </div>

                            <div class="form-option">
                                <label for="property-id"><?php _e('Property ID','framework'); ?></label>
                                <input id="property-id" name="property-id" type="text" value="<?php if( isset($post_meta_data['REAL_HOMES_property_id']) ){ echo $post_meta_data['REAL_HOMES_property_id'][0];} ?>" title="<?php _e( 'Property ID', 'framework'); ?>"/>
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-option">
                                <label for="price"><?php _e('Sale OR Rent Price','framework'); ?></label>
                                <input id="price" name="price" type="text" value="<?php if( isset($post_meta_data['REAL_HOMES_property_price']) ){ echo $post_meta_data['REAL_HOMES_property_price'][0]; } ?>" title="<?php _e( '* Please provide the value in only digits!', 'framework'); ?>"  />
                            </div>

                            <div class="form-option">
                                <label for="price-postfix"><?php _e('Price Postfix Text','framework'); ?></label>
                                <input id="price-postfix" name="price-postfix" type="text" value="<?php if( isset($post_meta_data['REAL_HOMES_property_price_postfix']) ){ echo $post_meta_data['REAL_HOMES_property_price_postfix'][0]; } ?>" />
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-option">
                                <label for="size"><?php _e('Area','framework'); ?></label>
                                <input id="size" name="size" type="text" value="<?php if( isset($post_meta_data['REAL_HOMES_property_size']) ){ echo $post_meta_data['REAL_HOMES_property_size'][0]; } ?>" title="<?php _e( '* Please provide the value in only digits!', 'framework'); ?>" />
                            </div>

                            <div class="form-option">
                                <label for="area-postfix"><?php _e('Area Postfix Text','framework'); ?></label>
                                <input id="area-postfix" name="area-postfix" type="text" value="<?php if( isset($post_meta_data['REAL_HOMES_property_size_postfix']) ){ echo $post_meta_data['REAL_HOMES_property_size_postfix'][0]; } ?>" />
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-option">
                                <label for="video-url"><?php _e('Virtual Tour Video URL','framework'); ?></label>
                                <input id="video-url" name="video-url" type="text" value="<?php if( isset($post_meta_data['REAL_HOMES_tour_video_url']) ){ echo $post_meta_data['REAL_HOMES_tour_video_url'][0];} ?>" title="<?php _e( 'Virtual Tour Video URL', 'framework'); ?>"/>
                            </div>

                        </div>

                        <div class="form-option">
                            <div id="gallery-thumbs-container" class="clearfix">
                                <?php
                                $thumbnail_size = 'thumbnail';
                                $properties_images = rwmb_meta( 'REAL_HOMES_property_images', 'type=plupload_image&size='.$thumbnail_size, $target_property->ID );
                                $featured_image_id = get_post_thumbnail_id( $target_property->ID );
                                if( !empty( $properties_images ) ){
                                    foreach( $properties_images as $prop_image_id => $prop_image_meta ){
                                        $is_featured_image =  ( $featured_image_id == $prop_image_id );
                                        $featured_icon = ( $is_featured_image ) ? 'fa-star' : 'fa-star-o';
                                        echo '<div class="gallery-thumb">';
                                        echo '<img src="'.$prop_image_meta['url'].'" alt="'.$prop_image_meta['title'].'" />';
                                        echo '<a class="remove-image" data-property-id="'.$target_property->ID.'" data-attachment-id="' . $prop_image_id . '" href="#remove-image" ><i class="fa fa-trash-o"></i></a>';
                                        echo '<a class="mark-featured" data-property-id="'.$target_property->ID.'" data-attachment-id="' . $prop_image_id . '" href="#mark-featured" ><i class="fa '. $featured_icon . '"></i></a>';
                                        echo '<span class="loader"><i class="fa fa-spinner fa-spin"></i></span>';
                                        echo '<input type="hidden" class="gallery-image-id" name="gallery_image_ids[]" value="' . $prop_image_id . '"/>';
                                        if ( $is_featured_image ) {
                                            echo '<input type="hidden" class="featured-img-id" name="featured_image_id" value="' . $prop_image_id . '"/>';
                                        }
                                        echo '</div>';
                                    }
                                }
                                ?>
                            </div>
                            <div id="drag-and-drop">
                                <div class="drag-drop-msg"><i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;<?php _e('Drag and drop images here','framework'); ?></div>
                                <div class="drag-or"><?php _e('or','framework'); ?></div>
                                <div class="drag-btn">
                                    <button id="select-images"  class="real-btn">
                                        <?php _e('Select Images','framework'); ?>
                                    </button>
                                </div>
                            </div>
                            <div class="field-description">
                                <?php _e( '* An image should have minimum width of 770px and minimum height of 386px.', 'framework' ); ?><br/>
                                <?php _e( '* You can mark an image as featured by clicking the star icon, Otherwise first image will be considered featured image.', 'framework' ); ?><br/>
                            </div>
                            <div id="errors-log"></div>
                        </div>

                    </div>

                    <div class="span6">

                        <div class="form-option">
                            <?php
                            $property_address = "";
                            if ( isset( $post_meta_data['REAL_HOMES_property_address'] ) && ! empty ( $post_meta_data['REAL_HOMES_property_address'][0] ) ) {
                                $property_address = $post_meta_data['REAL_HOMES_property_address'][0];
                            } else {
                                $property_address = get_option( 'theme_submit_default_address' );
                            }

                            $property_location = "";
                            if ( isset( $post_meta_data['REAL_HOMES_property_location'] ) && ! empty ( $post_meta_data['REAL_HOMES_property_location'][0] ) ) {
                                $property_location = $post_meta_data['REAL_HOMES_property_location'][0];
                            } else {
                                $property_location = get_option( 'theme_submit_default_location' );
                            }
                            ?>
                            <label for="address"><?php _e('Address', 'framework'); ?></label>
                            <input type="text" class="required" name="address" id="address" value="<?php echo $property_address; ?>" title="<?php _e( '* Please provide a property address!', 'framework'); ?>" required/>
                            <div class="map-wrapper">
                                <button class="real-btn goto-address-button" type="button" value="address"><?php _e( 'Find Address','framework' ); ?></button>
                                <div class="map-canvas"></div>
                                <input type="hidden" name="coordinates" class="map-coordinate" value="<?php echo $property_location; ?>" />
                            </div>
                        </div>


                        <div class="form-option">

                            <div class="inspiry-details-wrapper">
                                <?php
                                // Migrate old title and values to new key => value array
                                $detail_titles = get_post_meta( $target_property->ID, 'REAL_HOMES_detail_titles', true );
                                if( !empty( $detail_titles ) ) {
                                    $detail_values = get_post_meta($target_property->ID, 'REAL_HOMES_detail_values', true);
                                    if (!empty($detail_values)) {
                                        $additional_details = array_combine( $detail_titles, $detail_values );
                                        if ( update_post_meta( $target_property->ID, 'REAL_HOMES_additional_details', $additional_details ) ){
                                            delete_post_meta( $target_property->ID, 'REAL_HOMES_detail_titles' );
                                            delete_post_meta( $target_property->ID, 'REAL_HOMES_detail_values' );
                                        }
                                    }
                                }
                                ?>
                                <label><?php _e( 'Additional Details', 'framework' ); ?></label>

                                <div class="inspiry-detail labels clearfix">
                                    <div class="inspiry-detail-control">&nbsp;</div>
                                    <div class="inspiry-detail-title"><label><?php _e( 'Title','framework' ) ?></label></div>
                                    <div class="inspiry-detail-value"><label><?php _e( 'Value','framework' ); ?></label></div>
                                    <div class="inspiry-detail-control">&nbsp;</div>
                                </div>

                                <!-- additional details container -->
                                <div id="inspiry-additional-details-container">

                                    <?php
                                    // output existing details
                                    $additional_details = get_post_meta( $target_property->ID, 'REAL_HOMES_additional_details', true );

                                    if( ! empty ( $additional_details ) ) {

                                        foreach( $additional_details as $title => $value ) {
                                            ?>
                                            <div class="inspiry-detail inputs clearfix">
                                                <div class="inspiry-detail-control">
                                                    <i class="sort-detail fa fa-bars"></i>
                                                </div>
                                                <div class="inspiry-detail-title">
                                                    <input type="text" name="detail-titles[]" value="<?php echo $title; ?>" />
                                                </div>
                                                <div class="inspiry-detail-value">
                                                    <input type="text" name="detail-values[]" value="<?php echo $value; ?>" />
                                                </div>
                                                <div class="inspiry-detail-control">
                                                    <a class="remove-detail" href="#"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                            <?php
                                        }

                                    } else {
                                        ?>
                                        <div class="inspiry-detail inputs clearfix">
                                            <div class="inspiry-detail-control">
                                                <i class="sort-detail fa fa-bars"></i>
                                            </div>
                                            <div class="inspiry-detail-title">
                                                <input type="text" name="detail-titles[]" value="" />
                                            </div>
                                            <div class="inspiry-detail-value">
                                                <input type="text" name="detail-values[]" value="" />
                                            </div>
                                            <div class="inspiry-detail-control">
                                                <a class="remove-detail" href="#"><i class="fa fa-times"></i></a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div><!-- end of additional details container -->

                                <div class="inspiry-detail clearfix">
                                    <div class="inspiry-detail-control">&nbsp;</div>
                                    <div class="inspiry-detail-control">
                                        <a class="add-detail" href="#"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="form-option checkbox-option clearfix">
                            <input id="featured" name="featured" type="checkbox" <?php if( isset($post_meta_data['REAL_HOMES_featured']) && $post_meta_data['REAL_HOMES_featured'][0] == 1 ){ echo 'checked';} ?>/>
                            <label for="featured"><?php _e('Mark this Property as Featured','framework'); ?></label>

                        </div>

                        <div class="form-option">
                            <label><?php _e('Features', 'framework'); ?></label>
                            <ul class="features-checkboxes clearfix">
                                <?php
                                /* Property Features */
                                $features_terms = get_the_terms( $target_property->ID,"property-feature" );
                                $property_features_ids = array();
                                if(!empty($features_terms)){
                                    foreach($features_terms as $fet_trms){
                                        $property_features_ids[] = $fet_trms->term_id;
                                    }
                                }

                                /* All Features */
                                $features_terms = get_terms(
                                    array(
                                        "property-feature"
                                    ),
                                    array(
                                        'orderby'       => 'name',
                                        'order'         => 'ASC',
                                        'hide_empty'    => false
                                    )
                                );

                                if(!empty($features_terms)){
                                    $feature_count = 1;
                                    foreach($features_terms as $feature){
                                        echo '<li>';
                                        if( in_array( $feature->term_id, $property_features_ids ) ){
                                            echo '<input type="checkbox" name="features[]" id="feature-'.$feature_count.'" value="'.$feature->term_id.'" checked />';
                                        }else{
                                            echo '<input type="checkbox" name="features[]" id="feature-'.$feature_count.'" value="'.$feature->term_id.'" />';
                                        }
                                        echo '<label for="feature-'.$feature_count.'">'.$feature->name.'</label>';
                                        echo '</li>';
                                        $feature_count++;
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                        <div class="form-option">
                            <label><?php _e('What to display in agent information box ?','framework');?></label>
                            <div class="agent-options">
                                <input id="agent_option_none" type="radio" name="agent_display_option" value="none" <?php if( isset($post_meta_data['REAL_HOMES_agent_display_option']) && ($post_meta_data['REAL_HOMES_agent_display_option'][0] == "none") ){ echo "checked"; } ?> />
                                <label for="agent_option_none"><?php _e('None','framework'); ?></label> <small><?php _e('( Agent information box will not be displayed )','framework'); ?></small>
                                <br/>

                                <input id="agent_option_profile" type="radio" name="agent_display_option" value="my_profile_info" <?php if( isset($post_meta_data['REAL_HOMES_agent_display_option']) && ($post_meta_data['REAL_HOMES_agent_display_option'][0] == "my_profile_info") ){ echo "checked"; } ?> />
                                <label for="agent_option_profile"><?php _e('My profile information','framework');?></label>
                                <?php
                                $profile_url = get_option( 'theme_profile_url' );
                                if ( !empty( $profile_url ) ) {
                                    ?>
                                    <small>
                                        <a href="<?php echo esc_url( $profile_url ); ?>" target="_blank"><?php _e('( Edit Profile Information )', 'framework'); ?></a>
                                    </small>
                                    <?php
                                } else {
                                    ?>
                                    <small>
                                        <a href="<?php echo network_admin_url( 'profile.php' ); ?>" target="_blank"><?php _e('( Edit Profile Information )', 'framework'); ?></a>
                                    </small>
                                    <?php
                                }
                                ?>

                                <br/>

                                <input id="agent_option_agent" type="radio" name="agent_display_option" value="agent_info" <?php if( isset($post_meta_data['REAL_HOMES_agent_display_option']) && ($post_meta_data['REAL_HOMES_agent_display_option'][0] == "agent_info") ){ echo "checked"; } ?> />
                                <label for="agent_option_agent"><?php _e('Display an agent\'s information','framework'); ?></label>
                                <select name="agent_id" id="agent-selectbox">
                                    <?php
                                    if ( isset( $post_meta_data['REAL_HOMES_agents'][0] ) ) {
                                        generate_posts_list( 'agent', $post_meta_data['REAL_HOMES_agents'][0] );
                                    } else {
                                        generate_posts_list('agent' );
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-option">
                            <?php wp_nonce_field( 'submit_property', 'property_nonce' ); ?>
                            <input type="hidden" name="action" value="update_property"/>
                            <input type="hidden" name="property_id" value="<?php echo $target_property->ID; ?>"/>
                            <input type="submit" value="<?php _e('Update Property','framework');?>" class="real-btn" />
                        </div>

                        <div id="validation-errors"></div>

                    </div>
                </div>

            </form>
        <?php

        }else{
            echo '<p class="text-error">';
            _e('Requested property does not belong to logged in user !','framework');
            echo '</p>';
        }

    }else{
        echo '<p class="text-error">';
        _e('Requested post is not a valid property post !','framework');
        echo '</p>';
    }

}   // end of is page template check
?>