<?php
/*
 *  This file is only to be used with in template-submit-property.php
 */

if( is_page_template( 'template-submit-property.php' ) ){

    ?>
    <form id="submit-property-form" class="submit-form" enctype="multipart/form-data" method="post">
        <div class="row-fluid">

            <div class="span6">

                <div class="form-option">
                    <label for="inspiry_property_title"><?php _e('Property Title','framework'); ?></label>
                    <input id="inspiry_property_title" name="inspiry_property_title" type="text" class="required" title="<?php _e( '* Please provide property title!', 'framework'); ?>" autofocus required/>
                </div>

                <div class="form-option">
                    <label for="description"><?php _e('Property Description','framework'); ?></label>
                    <textarea name="description" id="description" cols="30" rows="5"></textarea>
                </div>

                <div class="form-options-container clearfix">

                    <div class="form-option">
                        <label for="type"><?php _e('Type', 'framework'); ?></label>
                        <span class="selectwrap">
                            <select name="type" id="type" class="search-select">
                                <option selected="selected" value="-1"><?php _e('None', 'framework'); ?></option>
                                <?php
                                /* Property Type */
                                $property_types_terms = get_terms(
                                    array(
                                        "property-type"
                                    ),
                                    array(
                                        'orderby'       => 'name',
                                        'order'         => 'ASC',
                                        'hide_empty'    => false,
                                        'parent' => 0
                                    )
                                );

                                generate_id_based_hirarchical_options("property-type", $property_types_terms, -1 );
                                ?>
                            </select>
                        </span>
                    </div>

                    <div class="form-option">
                        <label for="status"><?php _e('Status', 'framework'); ?></label>
                        <span class="selectwrap">
                            <select name="status" id="status" class="search-select">
                                <option selected="selected" value="-1"><?php _e('None', 'framework'); ?></option>
                                <?php
                                /* Property Status */
                                $property_status_terms = get_terms(
                                    array(
                                        "property-status"
                                    ),
                                    array(
                                        'orderby'       => 'name',
                                        'order'         => 'ASC',
                                        'hide_empty'    => false
                                    )
                                );

                                if(!empty($property_status_terms)){
                                    foreach($property_status_terms as $property_status){
                                        echo '<option value="'.$property_status->term_id.'">'.$property_status->name.'</option>';
                                    }
                                }
                                ?>
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
                        <input id="bedrooms" name="bedrooms" type="text" title="<?php _e( '* Please provide the value in only digits!', 'framework'); ?>" />
                    </div>

                    <div class="form-option">
                        <label for="bathrooms"><?php _e('Bathrooms', 'framework'); ?></label>
                        <input id="bathrooms" name="bathrooms" type="text" title="<?php _e( '* Please provide the value in only digits!', 'framework'); ?>" />
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-option">
                        <label for="garages"><?php _e('Garages', 'framework'); ?></label>
                        <input id="garages" name="garages" type="text" title="<?php _e( '* Please provide the value in only digits!', 'framework'); ?>" />
                    </div>

                    <div class="form-option">
                        <label for="property-id"><?php _e('Property ID','framework'); ?></label>
                        <input id="property-id" name="property-id" type="text" title="<?php _e( 'Property ID', 'framework'); ?>"/>
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-option">
                        <label for="price"><?php _e('Sale OR Rent Price','framework'); ?></label>
                        <input id="price" name="price" type="text" title="<?php _e( '* Please provide the value in only digits!', 'framework'); ?>" />
                    </div>

                    <div class="form-option">
                        <label for="price-postfix"><?php _e('Price Postfix Text','framework'); ?></label>
                        <input id="price-postfix" name="price-postfix" type="text" />
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-option">
                        <label for="size"><?php _e('Area','framework'); ?></label>
                        <input id="size" name="size" type="text" title="<?php _e( '* Please provide the value in only digits!', 'framework'); ?>" />
                    </div>

                    <div class="form-option">
                        <label for="area-postfix"><?php _e('Area Postfix Text','framework'); ?></label>
                        <input id="area-postfix" name="area-postfix" type="text" value="<?php _e('Sq Ft','framework'); ?>" />
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-option">
                        <label for="video-url"><?php _e('Virtual Tour Video URL','framework'); ?></label>
                        <input id="video-url" name="video-url" type="text" title="<?php _e( 'Virtual Tour Video URL', 'framework'); ?>"/>
                    </div>

                </div>

                <div class="form-option">
                    <div id="gallery-thumbs-container" class="clearfix"></div>
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
                    <label for="address"><?php _e('Address', 'framework'); ?></label>
                    <input type="text" class="required" name="address" id="address" value="<?php echo get_option( 'theme_submit_default_address' ); ?>" title="<?php _e( '* Please provide a property address!', 'framework'); ?>" required/>
                    <div class="map-wrapper">
                        <button class="real-btn goto-address-button" type="button" value="address"><?php _e( 'Find Address','framework' ); ?></button>
                        <div class="map-canvas"></div>
                        <input type="hidden" name="coordinates" class="map-coordinate" value="<?php echo get_option( 'theme_submit_default_location' ); ?>" />
                    </div>
                </div>

                <div class="form-option">

                    <div class="inspiry-details-wrapper">

                        <label><?php _e( 'Additional Details', 'framework' ); ?></label>

                        <div class="inspiry-detail labels clearfix">
                            <div class="inspiry-detail-control">&nbsp;</div>
                            <div class="inspiry-detail-title"><label><?php _e( 'Title','framework' ) ?></label></div>
                            <div class="inspiry-detail-value"><label><?php _e( 'Value','framework' ); ?></label></div>
                            <div class="inspiry-detail-control">&nbsp;</div>
                        </div>

                        <!-- additional details container -->
                        <div id="inspiry-additional-details-container">
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
                        </div><!-- end of additional details container -->

                        <div class="inspiry-detail clearfix">
                            <div class="inspiry-detail-control">&nbsp;</div>
                            <div class="inspiry-detail-control">
                                <a class="add-detail" href="#"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                    </div>

                </div>

                <hr/>

                <div class="form-option checkbox-option clearfix">
                    <input id="featured" name="featured" type="checkbox" />
                    <label for="featured"><?php _e('Mark this property as featured property','framework'); ?></label>
                </div>

                <div class="form-option">
                    <label><?php _e('Features', 'framework'); ?></label>
                    <ul class="features-checkboxes clearfix">
                        <?php
                        /* Property Features */
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
                                echo '<input type="checkbox" name="features[]" id="feature-'.$feature_count.'" value="'.$feature->term_id.'" />';
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
                        <input id="agent_option_none" type="radio" name="agent_display_option" value="none" checked />
                        <label for="agent_option_none"><?php _e('None','framework'); ?></label> <small><?php _e('( Agent information box will not be displayed )','framework'); ?></small>
                        <br/>

                        <input id="agent_option_profile" type="radio" name="agent_display_option" value="my_profile_info" />
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



                        <input id="agent_option_agent" type="radio" name="agent_display_option" value="agent_info" />
                        <label for="agent_option_agent"><?php _e('Display an agent\'s information','framework'); ?></label>
                        <select name="agent_id" id="agent-selectbox">
                            <?php generate_posts_list('agent'); ?>
                        </select>
                    </div>
                </div>

                <?php
                $target_email = get_option('theme_submit_notice_email');
                if( !empty($target_email) ){
                    ?>
                    <div class="form-option">
                        <label for="message_to_reviewer"><?php _e('Message to the Reviewer','framework'); ?></label>
                        <textarea name="message_to_reviewer" id="message_to_reviewer" cols="30" rows="3"></textarea>
                    </div>
                <?php
                }
                ?>

                <div class="form-option">
                    <?php wp_nonce_field( 'submit_property', 'property_nonce' ); ?>
                    <input type="hidden" name="action" value="add_property"/>
                    <input type="submit" value="<?php _e('Submit Property','framework');?>" class="real-btn" />
                </div>

            </div>
        </div>

    </form>
    <?php

}