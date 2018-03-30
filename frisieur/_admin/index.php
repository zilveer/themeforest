<?php

   /**
    *
    * create frisieur admin page
    *
    */  
    
    add_action( 'admin_menu', 'martanian_add_admin_page' );
    function martanian_add_admin_page() {

        add_menu_page(
            __( 'Frisieur Options', 'martanian' ),
            __( 'Frisieur Options', 'martanian' ),
            'manage_options',
            'martanian_admin',
            'martanian_show_admin_page',
            '',
            '61'
        );
    }

    function martanian_show_admin_page() {
    
        require_once( dirname( __FILE__ ) .'/template.php' );
    }
    
   /**
    *
    * register theme options and settings
    * 
    */                
    
    add_action( 'admin_init', 'martanian_register_settings' );
    function martanian_register_settings() {

        register_setting(
            'martanian_theme_options',
            'martanian_theme_options',
            'martanian_validate_options'
        ); 

       /**
        *
        * settings section
        * - header background slider
        * 
        */                                        
        
        add_settings_section(
            'martanian_settings_header',
            '',
            'martanian_settings_header_section',
            'martanian_admin'
        );

        add_settings_field(
            'martanian_settings_new_header_image',
            __( 'New background image:', 'martanian' ),
            'martanian_settings_new_header_image_input',
            'martanian_admin',
            'martanian_settings_header'
        );
        
        add_settings_field(
            'martanian_settings_new_header_image_title',
            __( 'New background image title:', 'martanian' ),
            'martanian_settings_new_header_image_title_input',
            'martanian_admin',
            'martanian_settings_header'
        );
        
       /**
        *       
        * settings section
        * - slogan options
        * 
        */ 
        
        add_settings_section(
            'martanian_settings_slogan',
            '',
            'martanian_settings_slogan_section',
            'martanian_admin'
        );   
        
        add_settings_field(
            'martanian_settings_slogan_main',
            __( 'Slogan:', 'martanian' ),
            'martanian_settings_slogan_main_input',
            'martanian_admin',
            'martanian_settings_slogan'
        );
        
        add_settings_field(
            'martanian_settings_slogan_description',
            __( 'Small description:', 'martanian' ),
            'martanian_settings_slogan_description_input',
            'martanian_admin',
            'martanian_settings_slogan'
        );
        
       /**
        *
        * settings section
        * - footer options
        * 
        */
        
        add_settings_section(
            'martanian_settings_footer',
            '',
            'martanian_settings_footer_section',
            'martanian_admin'
        );  
        
        add_settings_field(
            'martanian_settings_footer_content',
            __( 'Footer content:', 'martanian' ),
            'martanian_settings_footer_content_input',
            'martanian_admin',
            'martanian_settings_footer'
        ); 
        
       /**
        *
        * settings section
        * - logo options
        *
        */
        
        add_settings_section(
            'martanian_settings_logo',
            '',
            'martanian_settings_logo_section',
            'martanian_admin'
        ); 
                                       
        add_settings_field(
            'martanian_settings_logo_preview',
            __( 'Current main logo:', 'martanian' ),
            'martanian_settings_logo_preview_input',
            'martanian_admin',
            'martanian_settings_logo'
        );
        
        add_settings_field(
            'martanian_settings_logo_new',
            __( 'Upload new main logo:', 'martanian' ),
            'martanian_settings_logo_new_input',
            'martanian_admin',
            'martanian_settings_logo'
        ); 
        
        add_settings_field(
            'martanian_settings_logo_preview_scrollable',
            __( 'Current logo for scrollable menu:', 'martanian' ),
            'martanian_settings_logo_preview_scrollable_input',
            'martanian_admin',
            'martanian_settings_logo'
        );
        
        add_settings_field(
            'martanian_settings_logo_new_scrollable',
            __( 'Upload new logo for scrollable menu:', 'martanian' ),
            'martanian_settings_logo_new_scrollable_input',
            'martanian_admin',
            'martanian_settings_logo'
        );
        
       /**
        *
        * settings section
        * - home page
        * 
        */
        
        add_settings_section(
            'martanian_settings_home_page',
            '',
            'martanian_settings_home_page_section',
            'martanian_admin'
        );
        
       /**
        *
        * settings section
        * - colors
        * 
        */
        
        add_settings_section(
            'martanian_settings_colors',
            '',
            'martanian_settings_colors_section',
            'martanian_admin'
        );                                 

       /**
        *
        * end of options.
        * 
        */ 
    }
    
   /**
    *
    * image upload functions
    * 
    */                
    
    require_once( dirname( __FILE__ ) .'/image-upload.php' );

   /**
    *
    * header settings
    * 
    */                                    
    
    function martanian_settings_header_section() {

        echo '<!-- header slider -->
              <div class="martanian-theme-options-section" data-martanian-section-name="header-slider">
              
                  <h3>'. __( 'Header slider', 'martanian' ) .'</h3>';
    }

    function martanian_settings_new_header_image_input() {

        ?>
        <input type="hidden"
               id="new_header_image_url"
               name="martanian_theme_options[new_header_image_url]"
               value="" />
               
    		<input id="upload_header_background_button"
               type="button"
               class="button" 
               value="<?php _e( 'Upload header background image', 'martanian' ); ?>" />
        <?php
    }
    
    function martanian_settings_new_header_image_title_input() {
    
        ?>
        <input type="text"
               name="martanian_theme_options[new_header_image_title]"
               value=""
               style="width: 222px;" />
        <?php
        
        submit_button( __( 'Save new header image!', 'martanian' ) );
    }
    
    function martanian_get_header_section_fields() {
    
        # getting theme options
        $options = get_option( 'martanian_theme_options' );
        
        # create html fields
        echo '<div style="margin-top: 55px;"><h3>'. __( 'Uploaded backgrounds', 'martanian' ) .'</h3><p>'. __( 'Drag and Drop uploaded items to reorder them!', 'martanian' ) .'</div><div class="meta-box-sortables ui-sortable martanian-header-images-sortable">';
        echo '<input type="hidden" name="martanian_theme_options[header_images_order]" id="martanian_header_images_order" value="" />';
        
        # single background image array
        $single = array();
        
        # read all header backgrounds...
        if( isset( $options['header_backgrounds'] ) && is_array( $options['header_backgrounds'] ) ) {
        
            $pos = 0;
            foreach( $options['header_backgrounds'] as $header_background ) {
    
                # ...and create html
                $single[ $pos + 1 ] = '
                    <div class="martanian-postbox postbox" data-martanian-header-image-id="'. ( $pos + 1 ) .'">
                    
                        <div class="martanian-header-background-preview hndle">
                        
                            <div style="background-image: url( '. $header_background['url'] .' );" title="'. $header_background['title'] .'"></div>
                            <input type="submit" class="button button-delete" value="'. __( 'Delete image', 'martanian' ) .'" style="margin-top: 10px;" name="martanian_theme_options[delete_header_background]['. $pos .']" />
                        
                        </div>
                        
                    </div>';
            
                $pos++;
            }
        }

        # if there is no header images order
        if( !isset( $options['header_images_order'] ) || $options['header_images_order'] == '' ) {
        
            for( $i = 0; $i < count( $single ); $i++ ) echo $single[ $i + 1 ];
        }
        
        # or if it is here :)
        else {

            $order = explode( ',', $options['header_images_order'] );
            for( $i = 0; $i < count( $order ); $i++ ) {

                if( isset( $single[trim($order[$i])] ) ) {
                
                    echo $single[trim($order[$i])];
                    unset( $single[trim($order[$i])] );
                }
            }
            
            foreach( $single as $unordered ) echo $unordered;
        }

        # end of html
        echo '</div>'. get_submit_button( __( 'Save changes', 'martanian' ) ) .'</div>';
    }

   /**
    *
    * slogan settings
    *
    */               
    
    function martanian_settings_slogan_section() {

        # few fields for upper section - header slider
        martanian_get_header_section_fields();
        
        # slogan fields
        echo '<!-- slogan -->
              <div class="martanian-theme-options-section" data-martanian-section-name="slogan">
              
                  <h3>'. __( 'Slogan', 'martanian' ) .'</h3>';
    }
    
    function martanian_settings_slogan_main_input() {
    
        $option = get_option( 'martanian_theme_options' );
        $value = isset( $option['slogan_main'] ) ? $option['slogan_main'] : __( 'Get Your Dream Hair', 'martanian' );
        
        ?>
        <input type="text"
               name="martanian_theme_options[slogan_main]"
               value="<?php echo $value; ?>"
               style="width: 400px;" />
        <?php
    }
    
    function martanian_settings_slogan_description_input() {
    
        $option = get_option( 'martanian_theme_options' );
        $value = isset( $option['slogan_description'] ) ? $option['slogan_description'] : __( 'WordPress Theme for Hairdressers, Stylists, Hair Salons and similar - responsive, with blog, great appointment form and beauty design.', 'martanian' );
        
        ?>
        <textarea name="martanian_theme_options[slogan_description]" style="width: 400px; height: 150px;"><?php echo $value; ?></textarea>
        <?php
        
        submit_button( __( 'Save changes', 'martanian' ) );
    }   
    
   /**
    *
    * footer settings
    * 
    */
    
    function martanian_settings_footer_section() {

        echo '</div>
              
              <!-- footer options -->
              <div class="martanian-theme-options-section" data-martanian-section-name="footer-options">
              
                  <h3>'. __( 'Footer options', 'martanian' ) .'</h3>';
    }
    
    function martanian_settings_footer_content_input() {
    
        $option = get_option( 'martanian_theme_options' );
        $value = isset( $option['footer_content'] ) ? $option['footer_content'] : date( 'Y' ) .' &copy; '. __( 'Your Hair Salon', 'martanian' );
        
        ?>
        <input type="text"
               name="martanian_theme_options[footer_content]"
               value="<?php echo $value; ?>"
               style="width: 209px;" />
        <?php
        
        submit_button( __( 'Save changes', 'martanian' ) );
    }   
    
   /**
    *
    * logo settings
    *
    */                
    
    function martanian_settings_logo_section() {

        echo '</div>
              
              <!-- logo options -->
              <div class="martanian-theme-options-section" data-martanian-section-name="logo-options">
              
                  <h3>'. __( 'Logo options', 'martanian' ) .'</h3>';
    }
    
    function martanian_settings_logo_preview_input() {
    
        $option = get_option( 'martanian_theme_options' );
        $logo_url = isset( $option['logo_url'] ) ? $option['logo_url'] : get_template_directory_uri() .'/_assets/_img/logo.png';
        
        echo '<img src="'. $logo_url .'" alt="logo" id="logo_preview" />';
    }
    
    function martanian_settings_logo_new_input() {
    
        ?>
        <input type="hidden"
               id="new_logo_url"
               name="martanian_theme_options[new_logo_url]"
               value="" />
               
    		<input id="upload_logo_button"
               type="button"
               class="button" 
               value="<?php _e( 'Upload your logo', 'martanian' ); ?>" />
        <?php
        
        submit_button( __( 'Save changes', 'martanian' ) );
    }
    
    function martanian_settings_logo_preview_scrollable_input() {
    
        $option = get_option( 'martanian_theme_options' );
        $logo_responsive_url = isset( $option['logo_responsive_url'] ) ? $option['logo_responsive_url'] : get_template_directory_uri() .'/_assets/_img/logo-responsive.png';
        
        echo '<img src="'. $logo_responsive_url .'" alt="logo" id="logo_preview_responsive" />';
    }
    
    function martanian_settings_logo_new_scrollable_input() {
    
        ?>
        <input type="hidden"
               id="new_logo_responsive_url"
               name="martanian_theme_options[new_logo_responsive_url]"
               value="" />
               
    		<input id="upload_responsive_logo_button"
               type="button"
               class="button" 
               value="<?php _e( 'Upload your logo', 'martanian' ); ?>" />
        <?php
        
        submit_button( __( 'Save changes', 'martanian' ) );
    } 
    
   /**
    *
    * displaying home page sections
    *
    */
    
    function martanian_display_home_page_sections() {

        # get options
        $options = get_option( 'martanian_theme_options' );

        # is there any options?
        if( !isset( $options['sections'] ) || !is_array( $options['sections'] ) || !isset( $options['sections']['data'] ) || !is_array( $options['sections']['data'] ) ) return( '' );
        else {

            # only home options
            $sections = $options['sections']['data'];
            
            # define result
            $result = '';

            # create html for all sections
            foreach( $sections as $section_id => $section_data ) {
                                                                                                                                                                                                                  
                # all sections type
                switch( $section_data['type'] ) {
                
                    case 'small-appointment':
                    
                        $result .= '<div class="martanian-home-page-postbox postbox">
                                        
                                        <div class="hndle">
                                        
                                            <h4>'. __( 'Small appointment', 'martanian' ) .'</h4>
                                            <div class="options">
                                            
                                                <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                                <span class="remove" data-element-type="small-appointment">'. __( 'Remove', 'martanian' ) .'</span>
                                            
                                            </div>
                                            
                                            <div class="fields" style="display: none;">
                                            
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][type]" value="small-appointment" />
                                                <table class="form-table">
                                                
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Title', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][title]" value="'. $section_data['title'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Your e-mail address', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][email]" value="'. $section_data['email'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Time type', 'martanian' ) .':</th>
                                                        <td>
                                                        
                                                            <select name="martanian_theme_options[sections][data]['. $section_id .'][time_type]">
                                                            
                                                                <option value="12h"'. ( $section_data['time_type'] == '12h' ? ' selected="selected"' : '' ) .'>12h</option>
                                                                <option value="24h"'. ( $section_data['time_type'] == '24h' ? ' selected="selected"' : '' ) .'>24h</option>
                                                            
                                                            </select>
                                                        
                                                        </td>
                                                    
                                                    </tr>
                                                
                                                </table>
                                            
                                            </div>
                                        
                                        </div>
                                    
                                    </div>';
                        
                    break;
                    
                    case 'twitter-last-blog-post':
                    
                        $result .= '<div class="martanian-home-page-postbox postbox">
                                        
                                        <div class="hndle">
                                            
                                            <h4>'. __( 'Twitter / last blog post', 'martanian' ) .'</h4>
                                            <div class="options">
                                                
                                                <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                                <span class="remove" data-element-type="twitter-last-blog-post">'. __( 'Remove', 'martanian' ) .'</span>
                                            
                                            </div>
                                            
                                            <div class="fields" style="display: none;">
                                            
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][type]" value="twitter-last-blog-post" />
                                                <table class="form-table">
                                                
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Twitter username', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][twitter-username]" value="'. $section_data['twitter-username'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'OAuth Consumer Key', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][oauth-consumer-key]" value="'. $section_data['oauth-consumer-key'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'OAuth Consumer Secret', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][oauth-consumer-secret]" value="'. $section_data['oauth-consumer-secret'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row"></th>
                                                        <td style="font-size: 11px">'. __( 'You can get it in your <a href="https://dev.twitter.com/apps">Twitter dashboard</a>.', 'martanian' ) .'</td>
                                                    
                                                    </tr>
                                                
                                                </table>
                                            
                                            </div>
                                        
                                        </div>
                                    
                                    </div>';
                    
                    break;
                    
                    case 'facebook-last-blog-post':
                    
                        $result .= '<div class="martanian-home-page-postbox postbox">
                                        
                                        <div class="hndle">
                                            
                                            <h4>'. __( 'Facebook / last blog post', 'martanian' ) .'</h4>
                                            <div class="options">
                                                
                                                <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                                <span class="remove" data-element-type="facebook-last-blog-post">'. __( 'Remove', 'martanian' ) .'</span>
                                            
                                            </div>
                                            
                                            <div class="fields" style="display: none;">
                                            
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][type]" value="facebook-last-blog-post" />
                                                <table class="form-table">
                                                
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Facebook Page name', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][facebook-fanpage]" value="'. $section_data['facebook-fanpage'] .'" /></td>
                                                    
                                                    </tr>
                                                
                                                </table>
                                            
                                            </div>
                                        
                                        </div>
                                    
                                    </div>';
                    
                    break;
                    
                    case 'contact-form':
                    
                        $result .= '<div class="martanian-home-page-postbox postbox">
                        
                                        <div class="hndle">
                                        
                                            <h4>'. __( 'Contact form', 'martanian' ) .'</h4>
                                            <div class="options">
                                                
                                                <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                                <span class="remove" data-element-type="contact-form">'. __( 'Remove', 'martanian' ) .'</span>
                                            
                                            </div>
                                            
                                            <div class="fields" style="display: none;">
                                            
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][type]" value="contact-form" />
                                                <table class="form-table">
                                                
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Title', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][title]" value="'. $section_data['title'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Your e-mail address', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][email]" value="'. $section_data['email'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Google Map address', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][google-map-address]" value="'. $section_data['google-map-address'] .'" /></td>
                                                    
                                                    </tr>
                                                
                                                </table>
                                            
                                            </div>
                                        
                                        </div>
                                    
                                    </div>';
                    
                    break;
                    
                    case 'opening-hours':
                    
                        $result .= '<div class="martanian-home-page-postbox postbox">
                                    
                                        <div class="hndle">
                                        
                                            <h4>'. __( 'Opening hours', 'martanian' ) .'</h4>
                                            <div class="options">
                                            
                                                <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                                <span class="remove" data-element-type="opening-hours">'. __( 'Remove', 'martanian' ) .'</span>
                                            
                                            </div>
                                            
                                            <div class="fields" style="display: none;">
                                            
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][type]" value="opening-hours" />
                                                <table class="form-table">
                                                
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Title', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][title]" value="'. $section_data['title'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top" class="section-image">
                                                        
                                                        <th scope="row">'. __( 'Section image', 'martanian' ) .':</th>
                                                        <td>
                                                        
                                                            <span class="image-place"><img src="'. ( isset( $section_data['background_image_url'] ) && $section_data['background_image_url'] != '' ? $section_data['background_image_url'] : get_template_directory_uri() .'/_assets/_img/clock.png' ) .'" alt="Section image" style="max-width: 400px; max-height: 300px;" /></span>
                                                            <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][background_image_url]" value="'. $section_data['background_image_url'] .'" class="section_image_hidden" />
                                                        
                                                        </td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row"></th>
                                                        <td><input class="change_section_image button" type="button" value="'. __( 'Change section background', 'martanian' ) .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Monday', 'martanian' ) .':</th>
                                                        <td>'. __( 'from', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][monday][open]" value="'. $section_data['monday']['open'] .'" style="width: 90px;" /> '. __( 'to', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][monday][close]" value="'. $section_data['monday']['close'] .'" style="width: 90px;" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Tuesday', 'martanian' ) .':</th>
                                                        <td>'. __( 'from', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][tuesday][open]" value="'. $section_data['tuesday']['open'] .'" style="width: 90px;" /> '. __( 'to', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][tuesday][close]" value="'. $section_data['tuesday']['close'] .'" style="width: 90px;" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Wednesday', 'martanian' ) .':</th>
                                                        <td>'. __( 'from', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][wednesday][open]" value="'. $section_data['wednesday']['open'] .'" style="width: 90px;" /> '. __( 'to', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][wednesday][close]" value="'. $section_data['wednesday']['close'] .'" style="width: 90px;" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Thursday', 'martanian' ) .':</th>
                                                        <td>'. __( 'from', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][thursday][open]" value="'. $section_data['thursday']['open'] .'" style="width: 90px;" /> '. __( 'to', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][thursday][close]" value="'. $section_data['thursday']['close'] .'" style="width: 90px;" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Friday', 'martanian' ) .':</th>
                                                        <td>'. __( 'from', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][friday][open]" value="'. $section_data['friday']['open'] .'" style="width: 90px;" /> '. __( 'to', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][friday][close]" value="'. $section_data['friday']['close'] .'" style="width: 90px;" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Saturday', 'martanian' ) .':</th>
                                                        <td>'. __( 'from', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][saturday][open]" value="'. $section_data['saturday']['open'] .'" style="width: 90px;" /> '. __( 'to', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][saturday][close]" value="'. $section_data['saturday']['close'] .'" style="width: 90px;" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                        
                                                        <th scope="row">'. __( 'Sunday', 'martanian' ) .':</th>
                                                        <td>'. __( 'from', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][sunday][open]" value="'. $section_data['sunday']['open'] .'" style="width: 90px;" /> '. __( 'to', 'martanian' ) .' <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][sunday][close]" value="'. $section_data['sunday']['close'] .'" style="width: 90px;" /></td>
                                                    
                                                    </tr>
                                                    
                                                </table>
                                            
                                            </div>
                                        
                                        </div>
                                    
                                    </div>';
                    
                    break;
                    
                    case 'presentation-with-image':
                    
                        $result .= '<div class="martanian-home-page-postbox postbox" data-section-id="'. $section_id .'">
                                    
                                        <div class="hndle">
                                        
                                            <h4>'. __( 'Presentation with image', 'martanian' ) .'</h4>
                                            <div class="options">
                                            
                                                <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                                <span class="remove" data-element-type="presentation-with-image">'. __( 'Remove', 'martanian' ) .'</span>
                                            
                                            </div>
                                            
                                            <div class="fields" style="display: none;">
                                            
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][type]" value="presentation-with-image" />
                                                <table class="form-table">
                                                
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Section prefix', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][prefix]" value="'. $section_data['prefix'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                </table>
                                                
                                                <h4 style="margin: 10px 15px 0 15px;">'. __( 'Slides', 'martanian' ) .':</h4>
                                                <div class="martanian-slides">
                                                
                                                    <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][next_slide_id]" value="'. $section_data['next_slide_id'] .'" />
                                                    '. martanian_display_presentation_section_slides( $section_id, $section_data['slides'] ) .'
                                                
                                                </div>
                                                
                                                <input type="button" class="button" value="'. __( 'Add slide', 'martanian' ) .'" style="margin-left: 10px;" name="add-slide-button" data-section-id="'. $section_id .'" />
                                                
                                                <div style="clear: both">
                                                </div>
                                            
                                            </div>
                                        
                                        </div>
                                    
                                    </div>';
                    
                    break;

                    case 'about-us':
                    
                        $result .= '<div class="martanian-home-page-postbox postbox" data-section-id="'. $section_id .'">
                                        
                                        <div class="hndle">
                                        
                                            <h4>'. __( 'About us', 'martanian' ) .'</h4>
                                            <div class="options">
                                            
                                                <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                                <span class="remove" data-element-type="about-us">'. __( 'Remove', 'martanian' ) .'</span>
                                            
                                            </div>
                                            
                                            <div class="fields" style="display: none;">
                                            
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][type]" value="about-us" />
                                                <table class="form-table">
                                                
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Content', 'martanian' ) .':</th>
                                                        <td><textarea cols="75" rows="10" name="martanian_theme_options[sections][data]['. $section_id .'][content]">'. $section_data['content'] .'</textarea></td>
                                                    
                                                    </tr>
                                                
                                                </table>
                                                
                                                <h4 style="margin: 10px 15px 0 15px;">'. __( 'Team', 'martanian' ) .':</h4>
                                                <div class="martanian-persons">
                                                    
                                                    <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][next_person_id]" value="'. $section_data['next_person_id'] .'" />
                                                    '. martanian_disply_person_for_about_us_section( $section_id, $section_data['persons'] ) .'
                                                
                                                </div>
                                                
                                                <input type="button" class="button" value="'. __( 'Add person', 'martanian' ) .'" style="margin-left: 10px;" name="add-person-button" data-section-id="'. $section_id .'" />
                                                
                                                <div style="clear: both">
                                                </div>
                                            
                                            </div>
                                        
                                        </div>
                                    
                                    </div>';

                    break;

                    case 'gallery':
                    
                        $result .= '<div class="martanian-home-page-postbox postbox" data-section-id="'. $section_id .'">
                                        
                                        <div class="hndle">
                                        
                                            <h4>'. __( 'Gallery', 'martanian' ) .'</h4>
                                            <div class="options">
                                            
                                                <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                                <span class="remove" data-element-type="gallery">'. __( 'Remove', 'martanian' ) .'</span>
                                            
                                            </div>
                                            
                                            <div class="fields" style="display: none;">
                                            
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][type]" value="gallery" />
                                                <table class="form-table">
                                                
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Color title', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][color_title]" value="'. $section_data['color_title'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Title', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][title]" value="'. $section_data['title'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Description', 'martanian' ) .':</th>
                                                        <td><textarea name="martanian_theme_options[sections][data]['. $section_id .'][description]" rows="5" cols="75">'. $section_data['description'] .'</textarea></td>
                                                    
                                                    </tr>
                                                
                                                </table>
                                                
                                                <h4 style="margin: 10px 15px 0 15px;">'. __( 'Gallery images', 'martanian' ) .':</h4>
                                                <div class="martanian-gallery">
                                                
                                                    <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][next_image_id]" value="'. $section_data['next_image_id'] .'" />
                                                    <div class="martanian-gallery-images">
                                                    
                                                        '. martanian_display_gallery_images_for_section( $section_id, $section_data['gallery_images'] ) .'
                                                    
                                                    </div>
                                                
                                                </div>
                                                
                                                <input type="button" class="button" value="'. __( 'Add image', 'martanian' ) .'" style="margin-left: 10px;" name="add-gallery-image-button" data-section-id="'. $section_id .'" />
                                                
                                                <div style="clear: both">
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        
                                    </div>';
                    
                    break;
                    
                    case 'your-html':
                    
                        $result .= '<div class="martanian-home-page-postbox postbox">
                                        
                                        <div class="hndle">
                                        
                                            <h4>'. __( 'Your HTML', 'martanian' ) .'</h4>
                                            <div class="options">
                                            
                                                <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                                <span class="remove" data-element-type="your-html">'. __( 'Remove', 'martanian' ) .'</span>
                                            
                                            </div>
                                            
                                            <div class="fields" style="display: none;">
                                                
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][type]" value="your-html" />
                                                <table class="form-table">
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Prefix', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][prefix]" value="'. $section_data['prefix'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Background color', 'martanian' ) .':</th>
                                                        <td>
                                                        
                                                            <select name="martanian_theme_options[sections][data]['. $section_id .'][background_color]">
                                                            
                                                                <option value="white"'. ( $section_data['background_color'] == 'white' ? ' selected="selected"' : '' ) .'>'. __( 'White', 'martanian' ) .'</option>
                                                                <option value="gray"'. ( $section_data['background_color'] == 'gray' ? ' selected="selected"' : '' ) .'>'. __( 'Gray', 'martanian' ) .'</option>
                                                            
                                                            </select>
                                                        
                                                        </td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'HTML', 'martanian' ) .':</th>
                                                        <td><textarea rows="15" cols="75" name="martanian_theme_options[sections][data]['. $section_id .'][html]">'. $section_data['html'] .'</textarea></td>
                                                    
                                                    </tr>
                                                
                                                </table>
                                            
                                            </div>
                                        
                                        </div>
                                    
                                    </div>';
                        
                    break;
                    
                    case 'address-data':
                    
                        $result .= '<div class="martanian-home-page-postbox postbox">
                                        
                                        <div class="hndle">
                                        
                                            <h4>'. __( 'Address data', 'martanian' ) .'</h4>
                                            <div class="options">
                                            
                                                <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                                <span class="remove" data-element-type="address-data">'. __( 'Remove', 'martanian' ) .'</span>
                                            
                                            </div>
                                            
                                            <div class="fields" style="display: none;">
                                            
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][type]" value="address-data" />
                                                <table class="form-table">
                                                
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Your salon name', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][salon-name]" value="'. $section_data['salon-name'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Your salon address (street)', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][street]" value="'. $section_data['street'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Your salon address (city)', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][city]" value="'. $section_data['city'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Your salon contact phone number', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][phone-number]" value="'. $section_data['phone-number'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Your salon email', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][email]" value="'. $section_data['email'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Your salon website', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][website]" value="'. $section_data['website'] .'" /></td>
                                                    
                                                    </tr>
                                                    
                                                    <tr valign="top">
                                                    
                                                        <th scope="row">'. __( 'Your salon Facebook fanpage URL', 'martanian' ) .':</th>
                                                        <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][fanpage-url]" value="'. $section_data['fanpage-url'] .'" /></td>
                                                    
                                                    </tr>
                                                
                                                </table>
                                            
                                            </div>
                                        
                                        </div>
                                    
                                    </div>';
                    
                    break;
                }
            }
            
            # return result
            return( $result );
        }
    }
    
    function martanian_display_presentation_section_slides( $section_id, $slides ) {
    
        # define result
        $result = '';
        
        # create html for all slides
        foreach( $slides as $slide_id => $slide_data ) {
        
            # html for slide
            $result .= '<div class="martanian-slide">
                        
                            <div class="head">
                            
                                <h4>'. $slide_data['title'] .'</h4>
                                <div class="options">
                                
                                    <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                    <span class="remove" data-element-type="presentation-with-image">'. __( 'Remove', 'martanian' ) .'</span>
                                
                                </div>
                                
                                <div class="fields" style="display: none;">
                                
                                    <table class="form-table">
                                    
                                        <tr valign="top">
                                        
                                            <th scope="row">'. __( 'Section title', 'martanian' ) .':</th>
                                            <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][slides]['. $slide_id .'][title]" value="'. $slide_data['title'] .'" /></td>
                                        
                                        </tr>
                                        
                                        <tr valign="top" class="section-image">
                                        
                                            <th scope="row">'. __( 'Section image', 'martanian' ) .':</th>
                                            <td>
                                            
                                                <span class="image-place"><img src="'. ( isset( $slide_data['slider_image_url'] ) && $slide_data['slider_image_url'] != '' ? $slide_data['slider_image_url'] : get_template_directory_uri() .'/_assets/_img/empty549x549.png' ) .'" alt="Slide image" style="max-width: 400px; max-height: 300px;" /></span>
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][slides]['. $slide_id .'][slider_image_url]" value="'. $slide_data['slider_image_url'] .'" class="section_image_hidden" />
                                            
                                            </td>
                                            
                                        </tr>
                                        
                                        <tr valign="top">
                                        
                                            <th scope="row"></th>
                                            <td><input class="change_section_image button" type="button" value="'. __( 'Change section image', 'martanian' ) .'" /></td>
                                        
                                        </tr>
                                        
                                        <tr valign="top">
                                        
                                            <th scope="row">'. __( 'Content', 'martanian' ) .':</th>
                                            <td><textarea cols="75" rows="10" name="martanian_theme_options[sections][data]['. $section_id .'][slides]['. $slide_id .'][content]">'. $slide_data['content'] .'</textarea></td>
                                        
                                        </tr>
                                    
                                    </table>
                                
                                </div>
                            
                            </div>
                        
                        </div>';
        }
        
        # return result
        return( $result );
    }
    
    function martanian_disply_person_for_about_us_section( $section_id, $persons ) {
    
        # define result
        $result = '';
        
        # create html for all slides
        foreach( $persons as $person_id => $person_data ) {
        
            # get person skills
            $person_skills = isset( $person_data['skills'] ) && is_array( $person_data['skills'] ) ? martanian_get_person_skills_for_about_us_section( $section_id, $person_id, $person_data['skills'] ) : array( 'next_skill_id' => 1, 'skills' => '' );
            
            # html for person
            $result .= '<div class="martanian-person" data-person-id="'. $person_id .'">
                            
                            <div class="head">
                            
                                <h4>'. $person_data['name'] .'</h4>
                                <div class="options">
                                
                                    <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                    <span class="remove">'. __( 'Remove', 'martanian' ) .'</span>
                                
                                </div>
                                
                                <div class="fields" style="display: none;">
                                
                                    <table class="form-table">
                                    
                                        <tr valign="top">
                                        
                                            <th scope="row">'. __( 'Name and surname', 'martanian' ) .':</th>
                                            <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][persons]['. $person_id .'][name]" value="'. $person_data['name'] .'" /></td>
                                        
                                        </tr>
                                        
                                        <tr valign="top">
                                        
                                            <th scope="row">'. __( 'Profession', 'martanian' ) .':</th>
                                            <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][persons]['. $person_id .'][profession]" value="'. $person_data['profession'] .'" /></td>
                                        
                                        </tr>
                                        
                                        <tr valign="top">
                                        
                                            <th scope="row">'. __( 'Facebook profile', 'martanian' ) .':</th>
                                            <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][persons]['. $person_id .'][facebook]" value="'. $person_data['facebook'] .'" /></td>
                                        
                                        </tr>
                                        
                                        <tr valign="top">
                                            
                                            <th scope="row">'. __( 'Google+ profile', 'martanian' ) .':</th>
                                            <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][persons]['. $person_id .'][google-plus]" value="'. $person_data['google-plus'] .'" /></td>
                                        
                                        </tr>
                                        
                                        <tr valign="top">
                                        
                                            <th scope="row">'. __( 'Description', 'martanian' ) .':</th>
                                            <td><textarea cols="75" rows="5" name="martanian_theme_options[sections][data]['. $section_id .'][persons]['. $person_id .'][description]">'. $person_data['description'] .'</textarea></td>
                                        
                                        </tr>
                                        
                                        <tr valign="top" class="person-image">
                                            
                                            <th scope="row">'. __( 'Person image', 'martanian' ) .':</th>
                                            <td>
                                            
                                                <span class="image-place"><img src="'. ( isset( $person_data['person_image_url'] ) && $person_data['person_image_url'] != '' ? $person_data['person_image_url'] : get_template_directory_uri() .'/_assets/_img/person.png' ) .'" alt="Person image" style="width: 100px; height: 100px;" /></span>
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][persons]['. $person_id .'][person_image_url]" value="'. $person_data['person_image_url'] .'" class="person_image_hidden" />
                                            
                                            </td>
                                        
                                        </tr>
                                        
                                        <tr valign="top">
                                        
                                            <th scope="row"></th>
                                            <td><input class="change_person_image button" type="button" value="'. __( 'Change person image', 'martanian' ) .'" /></td>
                                        
                                        </tr>
                                        
                                        <tr valign="top">
                                        
                                            <th scope="row">'. __( 'Skills', 'martanian' ) .'</th>
                                            <td>
                                            
                                                <div class="skills">'. $person_skills['skills'] .'</div>
                                                <input class="add_skill_button button" type="button" value="'. __( 'Add skill', 'martanian' ) .'" data-next-skill-id="'. $person_skills['next_skill_id'] .'" data-person-id="'. $person_id .'" data-section-id="'. $section_id .'" />
                                            
                                            </td>
                                            
                                        </tr>
                                    
                                    </table>
                                
                                </div>
                              
                            </div>
                        
                        </div>';
        }
        
        # return result
        return( $result );
    }
    
    function martanian_get_person_skills_for_about_us_section( $section_id, $person_id, $skills ) {
    
        # define result
        $result = '';
        
        # next skill id
        $next_skill_id = 1;
        
        # create html for all skills
        foreach( $skills as $skill_id => $skill_data ) {
        
            # next skill id
            $next_skill_id = $skill_id > $next_skill_id ? $skill_id : $next_skill_id;
            
            # html for skill
            $result .= '<div class="skill">
                            
                            <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][persons]['. $person_id .'][skills]['. $skill_id .'][name]" value="'. $skill_data['name'] .'" />
                            <select name="martanian_theme_options[sections][data]['. $section_id .'][persons]['. $person_id .'][skills]['. $skill_id .'][value]">
                            
                                <option value="10"'. ( $skill_data['value'] == '10' ? ' selected="selected"' : '' ) .'>10%</option>
                                <option value="20"'. ( $skill_data['value'] == '20' ? ' selected="selected"' : '' ) .'>20%</option>
                                <option value="30"'. ( $skill_data['value'] == '30' ? ' selected="selected"' : '' ) .'>30%</option>
                                <option value="40"'. ( $skill_data['value'] == '40' ? ' selected="selected"' : '' ) .'>40%</option>
                                <option value="50"'. ( $skill_data['value'] == '50' ? ' selected="selected"' : '' ) .'>50%</option>
                                <option value="60"'. ( $skill_data['value'] == '60' ? ' selected="selected"' : '' ) .'>60%</option>
                                <option value="70"'. ( $skill_data['value'] == '70' ? ' selected="selected"' : '' ) .'>70%</option>
                                <option value="80"'. ( $skill_data['value'] == '80' ? ' selected="selected"' : '' ) .'>80%</option>
                                <option value="90"'. ( $skill_data['value'] == '90' ? ' selected="selected"' : '' ) .'>90%</option>
                                <option value="100"'. ( $skill_data['value'] == '100' ? ' selected="selected"' : '' ) .'>100%</option>
                            
                            </select>
                            
                            <span class="remove_skill_button">'. __( 'Remove', 'martanian' ) .'</span>
                        
                        </div>';
        }
        
        # return result
        return( array(
            'next_skill_id' => $next_skill_id + 1,
            'skills' => $result
        ) );
    }
    
    function martanian_display_gallery_images_for_section( $section_id, $images ) {

        # define result
        $result = '';
        
        # create html for all images
        foreach( $images as $image_id => $image_data ) {
            
            # get tags
            $tags = isset( $image_data['tags'] ) && is_array( $image_data['tags'] ) ? martanian_get_gallery_image_tags_for_section( $section_id, $image_id, $image_data['tags'] ) : array( 'next_tag_id' => 1, 'tags' => '' );
            
            # html for image
            $result .= '<div class="martanian-gallery-image" data-gallery-image-id="'. $image_id .'">
                        
                            <div class="head">
                                
                                <h4>'. $image_data['title'] .'</h4>
                                <div class="options">
                                
                                    <span class="more" data-value="more">'. __( 'More', 'martanian' ) .'</span>
                                    <span class="remove">'. __( 'Remove', 'martanian' ) .'</span>
                                
                                </div>
                                
                                <div class="fields" style="display: none;">
                                
                                    <table class="form-table">
                                        
                                        <tr valign="top">
                                        
                                            <th scope="row">'. __( 'Image title', 'martanian' ) .':</th>
                                            <td><input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][gallery_images]['. $image_id .'][title]" value="'. $image_data['title'] .'" /></td>
                                        
                                        </tr>
                                        
                                        <tr valign="top" class="gallery-image">
                                        
                                            <th scope="row">'. __( 'Gallery image', 'martanian' ) .':</th>
                                            <td>
                                            
                                                <span class="image-place"><img src="'. ( isset( $image_data['image_url'] ) && $image_data['image_url'] != '' ? $image_data['image_url'] : get_template_directory_uri() .'/_assets/_img/empty549x549.png' ) .'" alt="Gallery image" style="max-width: 400px; max-height: 300px;" /></span>
                                                <input type="hidden" name="martanian_theme_options[sections][data]['. $section_id .'][gallery_images]['. $image_id .'][image_url]" value="'. $image_data['image_url'] .'" class="gallery_image_hidden" />
                                            
                                            </td>
                                        
                                        </tr>
                                    
                                        <tr valign="top">
                                        
                                            <th scope="row"></th>
                                            <td><input class="change_gallery_image button" type="button" value="'. __( 'Change gallery image', 'martanian' ) .'" /></td>
                                        
                                        </tr>
                                        
                                        <tr valign="top">
                                        
                                            <th scope="row">'. __( 'Tags', 'martanian' ) .'</th>
                                            <td>
                                            
                                                <div class="tags">'. $tags['tags'] .'</div>
                                                <input class="add_tag_button button" type="button" value="'. __( 'Add tag', 'martanian' ) .'" data-next-tag-id="'. $tags['next_tag_id'] .'" data-gallery-image-id="'. $image_id .'" data-section-id="'. $section_id .'" />
                                            
                                            </td>
                                        
                                        </tr>
                                        
                                    </table>
                                
                                </div>
                            
                            </div>
                        
                        </div>';
        }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
        
        # return result
        return( $result );
    }
    
    function martanian_get_gallery_image_tags_for_section( $section_id, $image_id, $tags ) {

        # define result
        $result = '';
        
        # next tag id
        $next_tag_id = 1;
        
        # create html for all tags
        foreach( $tags as $tag_id => $tag_value ) {

            # next tag id
            $next_tag_id = $tag_id > $next_tag_id ? $tag_id : $next_tag_id;
            
            # html for tag
            $result .= '<div class="tag">
                        
                            <input type="text" name="martanian_theme_options[sections][data]['. $section_id .'][gallery_images]['. $image_id .'][tags]['. $tag_id .']" value="'. $tag_value .'" />
                            <span class="remove_tag_button">'. __( 'Remove', 'martanian' ) .'</span>
                        
                        </div>';
        }
        
        # return result
        return( array(
            'next_tag_id' => $next_tag_id + 1,
            'tags' => $result
        ) );
    }
    
   /**
    *
    * create select options for new home page sections
    *
    */                
    
    function martanian_create_options_for_home_page_sections() {
    
        # get options
        $options = get_option( 'martanian_theme_options' );
        
        # create result array
        $result = array(
            'small-appointment' => '<option value="small-appointment">'. __( 'Small appointment', 'martanian' ) .'</option>',
            'presentation-with-image' => '<option value="presentation-with-image">'. __( 'Presentation with image', 'martanian' ) .'</option>',
            'about-us' => '<option value="about-us">'. __( 'About us', 'martanian' ) .'</option>',
            'opening-hours' => '<option value="opening-hours">'. __( 'Opening hours', 'martanian' ) .'</option>',
            'twitter-last-blog-post' => '<option value="twitter-last-blog-post">'. __( 'Twitter / last blog post', 'martanian' ) .'</option>',
            'facebook-last-blog-post' => '<option value="facebook-last-blog-post">'. __( 'Facebook / last blog post', 'martanian' ) .'</option>',
            'gallery' => '<option value="gallery">'. __( 'Gallery', 'martanian' ) .'</option>',
            'contact-form' => '<option value="contact-form">'. __( 'Contact form', 'martanian' ) .'</option>',
            'address-data' => '<option value="address-data">'. __( 'Address and contact data', 'martanian' ) .'</option>',
            'your-html' => '<option value="your-html">'. __( 'Your HTML', 'martanian' ) .'</option>'
        );

        # is there any options?
        if( isset( $options['sections'] ) && is_array( $options['sections'] ) && isset( $options['sections']['data'] ) && is_array( $options['sections']['data'] ) ) {

            # remove some sections from result array
            foreach( $options['sections']['data'] as $section_id => $section_data ) {
            
                # read type
                switch( $section_data['type'] ) {
                
                    case 'small-appointment': unset( $result['small-appointment'] ); break;
                    case 'about-us': unset( $result['about-us'] ); break;
                    case 'opening-hours': unset( $result['opening-hours'] ); break;
                    case 'twitter-last-blog-post': unset( $result['twitter-last-blog-post'] ); break;
                    case 'facebook-last-blog-post': unset( $result['facebook-last-blog-post'] ); break;
                    case 'gallery': unset( $result['gallery'] ); break;
                    case 'contact-form': unset( $result['contact-form'] ); break;
                    case 'address-data': unset( $result['address-data'] ); break;
                }
            }
        }
        
        # create html result
        $html = '';
        foreach( $result as $key => $value ) {
        
            $html .= $value;
        }
        
        # return result
        return( $html );
    }
   
   /**
    *
    * home page settings
    * 
    */
    
    function martanian_settings_home_page_section() {

        $option = get_option( 'martanian_theme_options' );
        echo '</div>
              
              <!-- home page -->
              <div class="martanian-theme-options-section" data-martanian-section-name="home-page">
              
                  <h3>'. __( 'Home page', 'martanian' ) .'</h3>
                  <table class="form-table">
                  
                      <tr valign="top">
                      
                          <th scope="row">'. __( 'New section:', 'martanian' ) .'</th>
                          <td>
                          
                              <select name="sections-select">'. martanian_create_options_for_home_page_sections() .'</select>
                              <input type="button" class="button" value="'. __( 'Add section', 'martanian' ) .'" style="margin-left: 10px;" name="add-section-button" />
                          
                          </td>
                          
                      </tr>
                      
                  </table>

                  <h3 style="margin-top: 60px !important;">'. __( 'Added sections:', 'martanian' ) .'</h3>
                  
                  <input type="hidden" name="martanian_theme_options[sections][next_section_id]" value="'. ( isset( $option['sections'] ) && isset( $option['sections']['next_section_id'] ) ? $option['sections']['next_section_id'] : 1 ) .'" />
                  <div class="meta-box-sortables ui-sortable martanian-home-page-sort">
                  
                      '. martanian_display_home_page_sections() .'
                  
                  </div>';
                  
        submit_button( __( 'Save changes', 'martanian' ) );
    }  

   /**
    *
    * colors settings
    * 
    */
    
    add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
    function mw_enqueue_color_picker( $hook_suffix ) {
        // first check that $hook_suffix is appropriate for your admin page
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'my-script-handle', plugins_url('my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    }
    
    function martanian_settings_colors_section() {

        $option = get_option( 'martanian_theme_options' );
        echo '</div>
              
              <!-- colors section -->
              <div class="martanian-theme-options-section" data-martanian-section-name="colors">
              
                  <h3>'. __( 'Colors', 'martanian' ) .'</h3>
                  <table class="form-table">
                  
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Main color:', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['main'] ) && $option['colors']['main'] != '' ? $option['colors']['main'] : '#cb9254' ) .'" data-default-color="#cb9254" name="martanian_theme_options[colors][main]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Main border color:', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['main-border'] ) && $option['colors']['main-border'] != '' ? $option['colors']['main-border'] : '#b58048' ) .'" data-default-color="#b58048" name="martanian_theme_options[colors][main-border]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Main hover color:', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['main-hover'] ) && $option['colors']['main-hover'] != '' ? $option['colors']['main-hover'] : '#d0a06c' ) .'" data-default-color="#d0a06c" name="martanian_theme_options[colors][main-hover]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Header and gallery images background color:', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['important-background'] ) && $option['colors']['important-background'] != '' ? $option['colors']['important-background'] : '#271c10' ) .'" data-default-color="#271c10" name="martanian_theme_options[colors][important-background]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Input-helper border color:', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['input-helper-border-main'] ) && $option['colors']['input-helper-border-main'] != '' ? $option['colors']['input-helper-border-main'] : '#a97a48' ) .'" data-default-color="#a97a48" name="martanian_theme_options[colors][input-helper-border-main]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Input-helper border-top color', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['input-helper-border-top'] ) && $option['colors']['input-helper-border-top'] != '' ? $option['colors']['input-helper-border-top'] : '#d2a575' ) .'" data-default-color="#d2a575" name="martanian_theme_options[colors][input-helper-border-top]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Header slogan color', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['slogan-header'] ) && $option['colors']['slogan-header'] != '' ? $option['colors']['slogan-header'] : '#fff' ) .'" data-default-color="#fff" name="martanian_theme_options[colors][slogan-header]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Header slogan-description color', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['slogan-content'] ) && $option['colors']['slogan-content'] != '' ? $option['colors']['slogan-content'] : '#888' ) .'" data-default-color="#888" name="martanian_theme_options[colors][slogan-content]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Progress bar background color', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['progress-bar-value'] ) && $option['colors']['progress-bar-value'] != '' ? $option['colors']['progress-bar-value'] : '#d7af84' ) .'" data-default-color="#d7af84" name="martanian_theme_options[colors][progress-bar-value]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Header menu color', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['header-menu'] ) && $option['colors']['header-menu'] != '' ? $option['colors']['header-menu'] : '#bbb' ) .'" data-default-color="#bbb" name="martanian_theme_options[colors][header-menu]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Header menu hover color', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['header-menu-hover'] ) && $option['colors']['header-menu-hover'] != '' ? $option['colors']['header-menu-hover'] : '#fff' ) .'" data-default-color="#fff" name="martanian_theme_options[colors][header-menu-hover]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Scrollable-menu links color', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['scrollable-menu-links'] ) && $option['colors']['scrollable-menu-links'] != '' ? $option['colors']['scrollable-menu-links'] : '#3b3b3b' ) .'" data-default-color="#3b3b3b" name="martanian_theme_options[colors][scrollable-menu-links]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Responsive-menu background color', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['responsive-menu-background'] ) && $option['colors']['responsive-menu-background'] != '' ? $option['colors']['responsive-menu-background'] : '#3b3b3b' ) .'" data-default-color="#3b3b3b" name="martanian_theme_options[colors][responsive-menu-background]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Responsive-menu header color', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['responsive-menu-header'] ) && $option['colors']['responsive-menu-header'] != '' ? $option['colors']['responsive-menu-header'] : '#fff' ) .'" data-default-color="#fff" name="martanian_theme_options[colors][responsive-menu-header]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Responsive-menu single element border', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['responsive-menu-element-border'] ) && $option['colors']['responsive-menu-element-border'] != '' ? $option['colors']['responsive-menu-element-border'] : '#202020' ) .'" data-default-color="#202020" name="martanian_theme_options[colors][responsive-menu-element-border]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Responsive-menu single element background', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['responsive-menu-element-background'] ) && $option['colors']['responsive-menu-element-background'] != '' ? $option['colors']['responsive-menu-element-background'] : '#292929' ) .'" data-default-color="#292929" name="martanian_theme_options[colors][responsive-menu-element-background]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Responsive-menu single element color', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['responsive-menu-element-color'] ) && $option['colors']['responsive-menu-element-color'] != '' ? $option['colors']['responsive-menu-element-color'] : '#888' ) .'" data-default-color="#888" name="martanian_theme_options[colors][responsive-menu-element-color]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Responsive-menu single element link color', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['responsive-menu-link'] ) && $option['colors']['responsive-menu-link'] != '' ? $option['colors']['responsive-menu-link'] : '#ddd' ) .'" data-default-color="#ddd" name="martanian_theme_options[colors][responsive-menu-link]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                      <tr valign="top">
                          
                          <th scope="row">'. __( 'Responsive-menu single element link hover color', 'martanian' ) .'</th>
                          <td><input type="text" value="'. ( isset( $option['colors']['responsive-menu-link-hover'] ) && $option['colors']['responsive-menu-link-hover'] != '' ? $option['colors']['responsive-menu-link-hover'] : '#fff' ) .'" data-default-color="#fff" name="martanian_theme_options[colors][responsive-menu-link-hover]" class="martanian_colorpicker" /></td>
                      
                      </tr>
                      
                  </table>';
                  
        submit_button( __( 'Save changes', 'martanian' ) );
    }               
   
   /**
    *
    * fields validate function
    * 
    */                
    
    function martanian_validate_options( $input ) {

       /**
        *
        * default options
        * 
        */
                        
        $options = get_option( 'martanian_theme_options' );

       /**
        *
        * change general settings
        * 
        */
        
        $options['footer_content'] = isset( $input['footer_content'] ) ? esc_attr( $input['footer_content'] ) : '';                               
       
       /**
        *
        * if new logo was submitted
        * 
        */

        if( isset( $input['new_logo_url'] ) && $input['new_logo_url'] != '' ) {

            # save new logo url
            $options['logo_url'] = $input['new_logo_url'];
        }
        
       /**
        *
        * if new responsive logo was submitted
        * 
        */

        if( isset( $input['new_logo_responsive_url'] ) && $input['new_logo_responsive_url'] != '' ) {

            # save new logo url
            $options['logo_responsive_url'] = $input['new_logo_responsive_url'];
        } 

       /**
        *
        * if new header background was submitted
        * 
        */
                           
        if( isset( $input['new_header_image_url'] ) && isset( $input['new_header_image_title'] ) && $input['new_header_image_url'] != '' ) {
        
            # declare or get header_backgrounds option
            if( !isset( $options['header_backgrounds'] ) ) $options['header_backgrounds'] = array();

            # add new image to backgrounds array
            $options['header_backgrounds'][] = array(
                'url' => esc_attr( $input['new_header_image_url'] ),
                'title' => esc_attr( $input['new_header_image_title'] )
            );
        }
        
       /**
        *
        * update header images order
        *
        */                                

        $options['header_images_order'] = isset( $input['header_images_order'] ) ? esc_attr( $input['header_images_order'] ) : '';
        
       /**
        *
        * delete header background image
        *
        */                                

        if( isset( $input['delete_header_background'] ) ) {

            # get element id
            foreach( $input['delete_header_background'] as $key => $value ) { $delete_id = $key; }

            # get element
            $element = isset( $options['header_backgrounds'][$delete_id] ) ? $options['header_backgrounds'][$delete_id] : false;
            if( $element != false ) {
            
                martanian_delete_image( $element['url'] );
      		      unset( $options['header_backgrounds'][$delete_id] );
                
                sort( $options['header_backgrounds'] );
            }
        }
        
       /**
        *
        * change slogan
        *
        */             
        
        $options['slogan_main'] = isset( $input['slogan_main'] ) ? esc_attr( $input['slogan_main'] ) : '';
        $options['slogan_description'] = isset( $input['slogan_description'] ) ? esc_attr( $input['slogan_description'] ) : '';         

       /**
        *
        * home page options
        * 
        */
        
        $options['sections'] = $input['sections'];
        
       /**
        *
        * colors options
        * 
        */
        
        $options['colors'] = $input['colors'];                                                               
       
       /**
        *
        * return values
        *
        */   
                                             
        return( $options );
    }

   /**
    *
    * end of file.
    * 
    */                             

?>