<?php

    # get theme options
    $martanian_options = get_option( 'martanian_theme_options' );
    
    # get time type and admin email options
    $timepicker_type = '12h';
    $admin_email = get_option( 'admin_email' );
    $appointment_contact = $admin_email;
    $contact_form_contact = $admin_email;
    $map_address = 'none';
    $map_coordinates = 'var martanian_maps_pos1 = "none"; var martanian_maps_pos2 = "none";';
    
    if( isset( $martanian_options['sections'] ) && is_array( $martanian_options['sections'] ) && isset( $martanian_options['sections']['data'] ) && is_array( $martanian_options['sections']['data'] ) && count( $martanian_options['sections']['data'] ) > 0 ) {
    
        foreach( $martanian_options['sections']['data'] as $section_id => $section_data ) {
 
            if( $section_data['type'] == 'small-appointment' ) {
            
                $timepicker_type = $section_data['time_type'];
                $appointment_contact = $section_data['email'];
            }
            
            else if( $section_data['type'] == 'contact-form' ) {

                $contact_form_contact = $section_data['email'];
                $map_address = martanian_get_map_position( $section_data['google-map-address'] );

                if( $map_address != false ) {
                
                    $map_coordinates = 'var martanian_maps_pos1 = '. $map_address['lat'] .'; var martanian_maps_pos2 = '. $map_address['lng'] .';';
                }
            }
        }
    }

?>
            <footer><?php echo isset( $martanian_options['footer_content'] ) ? $martanian_options['footer_content'] : date( 'Y' ) .' &copy; Your Hair Salon'; ?></footer>

        </div>
    
    </div>
    
    <div id="go-top"><i class="icon-angle-up"></i></div>
    
    <script>
    
        var path_to_template = "<?php echo get_template_directory_uri(); ?>";
        var timepickerType = "<?php echo $timepicker_type; ?>";
        var appointment_contact = "<?php echo $appointment_contact; ?>";
        var contact_form_contact = "<?php echo $contact_form_contact; ?>";
        <?php echo $map_coordinates; ?>
        
    
    </script>
    
    <?php
        
        # datepicker translation
        $url = '/_assets/_libs/jquery-ui/development-bundle/ui/i18n/jquery.ui.datepicker-'. substr( get_bloginfo( 'language' ), 0, 2 ) .'.js';
        if( file_exists( get_template_directory() . $url ) ) {
        
            echo '<script src="'. get_template_directory_uri() . $url .'"></script>';
        }
   
    ?>
    
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    
    <?php wp_footer(); ?>
    
</body>
</html>