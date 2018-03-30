<style type="text/css">

.clear {
    clear: both;
}

.martanian-theme-options-title {
    margin-top: 20px;
}

.martanian-theme-options-header {
    height: 5px;
    background: #454545;
    -webkit-border-top-left-radius: 3px;
    -moz-border-top-left-radius: 3px;
    border-top-left-radius: 3px;
    -webkit-border-top-right-radius: 3px;
    -moz-border-top-right-radius: 3px;
    border-top-right-radius: 3px;
    margin-top: 25px;
}

.martanian-theme-options-description {
    background: #fafafa;
    border-left: 1px solid #cbcbcb;
    border-bottom: 1px solid #cbcbcb;
    border-right: 1px solid #cbcbcb;
    padding: 10px;
}

.martanian-theme-options-description p {
    padding: 0;
    margin: 0;
    color: #a5a5a5;
}

.martanian-theme-options-container {
    min-height: 500px;
    border-left: 1px solid #cbcbcb;
    border-bottom: 1px solid #cbcbcb;
    border-right: 1px solid #cbcbcb;
    position: relative;
    background: #fff;
}

.martanian-theme-options-menu {
    width: 200px;
    border-right: 1px solid #cbcbcb;
    border-bottom: 1px solid #cbcbcb;
    padding: 0;
    background: #f2f2f2;
    position: absolute;
    height: 100%;
}

.martanian-theme-options-menu ul {
    padding: 15px 20px;
    margin: 0;
}

.martanian-theme-options-menu ul li {
    padding: 5px 0;
    margin: 0;
    cursor: pointer;
}

.martanian-theme-options-menu ul li.active {
    font-weight: bold;
}

.martanian-theme-options-content {
    margin-left: 230px;
    padding: 25px 0;
    margin-right: 25px;
}

.martanian-theme-options-content .martanian-message {
    background-color: #ffffe0;
    border: 1px solid #e6db55;
    padding: 10px;
    margin-bottom: 25px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    font-weight: bold;
    color: #333;
    font-size: 12px;
}

.martanian-theme-options-content h3 {
    margin-top: 0 !important;
    border-bottom: 1px dashed #dcdcdc;
    padding-bottom: 15px;
}

.martanian-theme-options-content .martanian-header-background-preview {
    background: #fff;
    border: 1px solid #ddd;
    padding: 10px;
    margin-right: 15px;
    display: inline-block;
}

.martanian-theme-options-content .martanian-header-background-preview div {
    width: 200px;
    height: 200px;
    background-position: 50% 50%;
    background-size: cover !important;
}

.martanian-theme-options-content .martanian-postbox {
    display: inline-block;
    border: none;
    min-width: 0;
    box-shadow: none;
    vertical-align: top;
}

.martanian-header-images-sortable .sortable-placeholder {
    display: inline-block;
    width: 220px;
    height: 220px;
    margin-right: 15px;
}

.martanian-home-page-sort .martanian-home-page-postbox h4 {
    margin-left: 15px;
}

.martanian-home-page-sort .martanian-home-page-postbox .options {
    float: right;
    margin-top: -30px;
}

.martanian-home-page-sort .martanian-home-page-postbox .options span {
    margin: 0 20px 0 0;
    cursor: pointer !important;
}

.martanian-home-page-sort .martanian-home-page-postbox .options span.remove {
    color: #e73a30;
}

.martanian-home-page-sort .martanian-home-page-postbox .fields {
    border-top: 1px solid #eee;
    background: #fcfcfc;
    cursor: auto;
}

.martanian-home-page-sort .martanian-home-page-postbox .fields .form-table {
    margin-left: 15px;
}

.martanian-home-page-sort .martanian-home-page-postbox .fields .form-table tr th {
    width: 185px;
}

.martanian-slides,
.martanian-persons,
.martanian-gallery-images {
    margin-bottom: 15px;
}

.martanian-slide,
.martanian-person,
.martanian-gallery-image {
    margin: 15px 15px 0 15px;
}

.martanian-slide .head,
.martanian-person .head,
.martanian-gallery-image .head {
    background: #fff;
    border: 1px solid #ddd;
    padding: 15px 0;
}

.martanian-slide .head h4,
.martanian-person .head h4,
.martanian-gallery-image .head h4 {
    margin: 0 15px;
}

.martanian-slide .head .options,
.martanian-person .head .options,
.martanian-gallery-image .head .options {
    margin-top: -13px;
}

.martanian-slide .fields,
.martanian-person .fields,
.martanian-gallery-image .fields {
    margin-top: 15px;
    padding: 15px;
}

input[name=add-slide-button],
input[name=add-person-button],
input[name=add-gallery-image-button] {
    float: right;
    margin: 0 15px 15px 0 !important;
}

.martanian-person .fields select {
    line-height: 27px;
    height: 27px;
    margin-top: -3px;
}

.martanian-person .fields .skill,
.martanian-gallery-image .fields .tags {
    margin-bottom: 5px;
}

.martanian-person .fields .skill .remove_skill_button,
.martanian-gallery-image .fields .tags .remove_tag_button {
    font-size: 13px;
    margin-left: 10px;
    text-decoration: underline;
    cursor: pointer;
}  

.button { outline: none; }
.form-table th { font-size: 13px; }

</style>
<script>
jQuery( document ).ready( function() {

    jQuery( '.martanian-theme-options-menu ul li' ).each( function() {
    
        if( !jQuery( this ).hasClass( 'active' ) ) {
        
            key = jQuery( this ).attr( 'data-martanian-section-name' );
            jQuery( '.martanian-theme-options-section[data-martanian-section-name='+ key +']' ).hide();
        }
    
    });
    
    jQuery( '.martanian-theme-options-menu ul li' ).click( function() {
    
        jQuery( '.martanian-theme-options-menu ul li' ).removeClass( 'active' );
        jQuery( this ).addClass( 'active' );
        
        jQuery( '.martanian-theme-options-section' ).hide();
        
        key = jQuery( this ).attr( 'data-martanian-section-name' );
        jQuery( '.martanian-theme-options-section[data-martanian-section-name='+ key +']' ).show();
        
    });
    
    jQuery( 'input[name=submit]' ).click( function() {
    
        header_images_order = '';
        jQuery( '.martanian-postbox' ).each( function() {
        
            image_id = jQuery( this ).attr( 'data-martanian-header-image-id' );
            header_images_order += ( header_images_order == '' ? image_id : ', '+ image_id );
        
        });
        
        jQuery( '#martanian_header_images_order' ).attr( 'value', header_images_order );
                                             
    }); 
    
   /**
    *
    * home page sections manager
    *
    */                
    
    jQuery.UpSectionID = function( nextSectionID ) {
    
        jQuery( 'input[name="martanian_theme_options[sections][next_section_id]"]' ).attr( 'value', parseInt( nextSectionID ) + 1 );
    }
    
    jQuery( 'input[name=add-section-button]' ).click( function() {
    
        jQuery( '.martanian-home-page-sort .martanian-home-page-postbox .hndle .fields' ).hide();
        jQuery( '.martanian-home-page-sort .martanian-home-page-postbox .hndle .more' ).attr( 'data-value', 'more' ).html( '<?php _e( "More", "martanian" ); ?>' );
        
        nextSectionID = jQuery( 'input[name="martanian_theme_options[sections][next_section_id]"]' ).val();
        sectionName = jQuery( 'select[name=sections-select]' ).val();
        
        switch( sectionName ) {
        
            case 'small-appointment':

                html = '<div class="martanian-home-page-postbox postbox"><div class="hndle"><h4><?php _e( "Small appointment", "martanian" ); ?></h4><div class="options"><span class="more" data-value="less"><?php _e( "Less", "martanian" ); ?></span><span class="remove" data-element-type="small-appointment"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][type]" value="small-appointment" /><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Title", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][title]" value="<?php _e( "Make an [color]appointment[/color]", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Your e-mail address", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][email]" value="<?php _e( "your.email@example.com", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Time type", "martanian" ); ?>:</th><td><select name="martanian_theme_options[sections][data]['+ nextSectionID +'][time_type]"><option value="12h">12h</option><option value="24h">24h</option></select></td></tr></table></div></div></div>';
                
                jQuery( '.martanian-home-page-sort' ).append( html );
                jQuery( 'select[name=sections-select] option[value=small-appointment]' ).remove();
                
                jQuery.UpSectionID( nextSectionID );
            
            break;
            
            case 'twitter-last-blog-post':

                html = '<div class="martanian-home-page-postbox postbox"><div class="hndle"><h4><?php _e( "Twitter / last blog post", "martanian" ); ?></h4><div class="options"><span class="more" data-value="less"><?php _e( "Less", "martanian" ); ?></span><span class="remove" data-element-type="twitter-last-blog-post"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][type]" value="twitter-last-blog-post" /><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Twitter username", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][twitter-username]" value="martaniandesign" /></td></tr><tr valign="top"><th scope="row"><?php _e( "OAuth Consumer Key", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][oauth-consumer-key]" value="" /></td></tr><tr valign="top"><th scope="row"><?php _e( "OAuth Consumer Secret", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][oauth-consumer-secret]" value="" /></td></tr><tr valign="top"><th scope="row"></th><td style="font-size: 11px"><?php _e( "You can get it in your <a href=\"https://dev.twitter.com/apps\">Twitter dashboard</a>.", "martanian" ); ?></td></tr></table></div></div></div>';
                
                jQuery( '.martanian-home-page-sort' ).append( html );
                jQuery( 'select[name=sections-select] option[value=twitter-last-blog-post]' ).remove();
                
                jQuery.UpSectionID( nextSectionID );
            
            break;
            
            case 'facebook-last-blog-post':
            
                html = '<div class="martanian-home-page-postbox postbox"><div class="hndle"><h4><?php _e( "Facebook / last blog post", "martanian" ); ?></h4><div class="options"><span class="more" data-value="less"><?php _e( "Less", "martanian" ); ?></span><span class="remove" data-element-type="facebook-last-blog-post"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][type]" value="facebook-last-blog-post" /><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Facebook Page name", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][facebook-fanpage]" value="ThemeForest" /></td></tr></table></div></div></div>';
                
                jQuery( '.martanian-home-page-sort' ).append( html );
                jQuery( 'select[name=sections-select] option[value=facebook-last-blog-post]' ).remove();
                
                jQuery.UpSectionID( nextSectionID );
            
            break;
            
            case 'contact-form':
            
                html = '<div class="martanian-home-page-postbox postbox"><div class="hndle"><h4><?php _e( "Contact form", "martanian" ); ?></h4><div class="options"><span class="more" data-value="less"><?php _e( "Less", "martanian" ); ?></span><span class="remove" data-element-type="contact-form"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][type]" value="contact-form" /><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Title", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][title]" value="<?php _e( "Drop us [color]a line[/color]", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Your e-mail address", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][email]" value="<?php _e( "your.email@example.com", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Google Map address", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][google-map-address]" value="Singapore, Cross Street 1" /></td></tr></table></div></div></div>';
            
                jQuery( '.martanian-home-page-sort' ).append( html );
                jQuery( 'select[name=sections-select] option[value=contact-form]' ).remove();
                
                jQuery.UpSectionID( nextSectionID );
                
            break;
            
            case 'opening-hours':

                html = '<div class="martanian-home-page-postbox postbox"><div class="hndle"><h4><?php _e( "Opening hours", "martanian" ); ?></h4><div class="options"><span class="more" data-value="less"><?php _e( "Less", "martanian" ); ?></span><span class="remove" data-element-type="opening-hours"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][type]" value="opening-hours" /><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Title", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][title]" value="<?php _e( "See our [color]working hours[/color]", "martanian" ); ?>" /></td></tr><tr valign="top" class="section-image"><th scope="row"><?php _e( "Section image", "martanian" ); ?>:</th><td><span class="image-place"><img src="<?php echo get_template_directory_uri(); ?>/_assets/_img/clock.png" alt="Section image" style="max-width: 400px; max-height: 300px;" /></span><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][background_image_url]" value="" class="section_image_hidden" /></td></tr><tr valign="top"><th scope="row"></th><td><input class="change_section_image button" type="button" value="<?php _e( "Change section background", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Monday", "martanian" ); ?>:</th><td><?php _e( "from", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][monday][open]" value="9.00 am" style="width: 90px;" /> <?php _e( "to", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][monday][close]" value="4.00 pm" style="width: 90px;" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Tuesday", "martanian" ); ?>:</th><td><?php _e( "from", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][tuesday][open]" value="8.00 am" style="width: 90px;" /> <?php _e( "to", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][tuesday][close]" value="5.00 pm" style="width: 90px;" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Wednesday", "martanian" ); ?>:</th><td><?php _e( "from", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][wednesday][open]" value="8.00 am" style="width: 90px;" /> <?php _e( "to", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][wednesday][close]" value="5.00 pm" style="width: 90px;" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Thursday", "martanian" ); ?>:</th><td><?php _e( "from", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][thursday][open]" value="10.00 am" style="width: 90px;" /> <?php _e( "to", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][thursday][close]" value="2.00 pm" style="width: 90px;" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Friday", "martanian" ); ?>:</th><td><?php _e( "from", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][friday][open]" value="9.00 am" style="width: 90px;" /> <?php _e( "to", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][friday][close]" value="4.00 pm" style="width: 90px;" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Saturday", "martanian" ); ?>:</th><td><?php _e( "from", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][saturday][open]" value="10.00 am" style="width: 90px;" /> <?php _e( "to", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][saturday][close]" value="1.00 pm" style="width: 90px;" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Sunday", "martanian" ); ?>:</th><td><?php _e( "from", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][sunday][open]" value="<?php _e( "closed", "martanian" ); ?>" style="width: 90px;" /> <?php _e( "to", "martanian" ); ?> <input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][sunday][close]" value="<?php _e( "closed", "martanian" ); ?>" style="width: 90px;" /></td></tr></table></div></div></div>';
            
                jQuery( '.martanian-home-page-sort' ).append( html );
                jQuery( 'select[name=sections-select] option[value=opening-hours]' ).remove();
                
                jQuery.UpSectionID( nextSectionID );
            
            break;
            
            case 'presentation-with-image':
            
                html = '<div class="martanian-home-page-postbox postbox" data-section-id="'+ nextSectionID +'"><div class="hndle"><h4><?php _e( "Presentation with image", "martanian" ); ?></h4><div class="options"><span class="more" data-value="less"><?php _e( "Less", "martanian" ); ?></span><span class="remove" data-element-type="presentation-with-image"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][type]" value="presentation-with-image" /><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Section prefix", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][prefix]" value="<?php _e( "presentation-with-image", "martanian" ); ?>-'+ nextSectionID +'" /></td></tr></table><h4 style="margin: 10px 15px 0 15px;"><?php _e( "Slides", "martanian" ); ?>:</h4><div class="martanian-slides"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][next_slide_id]" value="1" /></div><input type="button" class="button" value="<?php _e( "Add slide", "martanian" ); ?>" style="margin-left: 10px;" name="add-slide-button" data-section-id="'+ nextSectionID +'" /><div style="clear: both"></div></div></div></div>';
            
                jQuery( '.martanian-home-page-sort' ).append( html );
                jQuery.UpSectionID( nextSectionID );
            
            break;
            
            case 'about-us':
            
                html = '<div class="martanian-home-page-postbox postbox" data-section-id="'+ nextSectionID +'"><div class="hndle"><h4><?php _e( "About us", "martanian" ); ?></h4><div class="options"><span class="more" data-value="less"><?php _e( "Less", "martanian" ); ?></span><span class="remove" data-element-type="about-us"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][type]" value="about-us" /><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Content", "martanian" ); ?>:</th><td><textarea cols="75" rows="10" name="martanian_theme_options[sections][data]['+ nextSectionID +'][content]">[title]<?php _e( "Few words about our [color]Hair Salon[/color]", "martanian" ); ?>[/title][p]Nulla at diam ornare, aliquam urna vel, commodo urna. Nam id risus a est luctus consectetur quis eget libero. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames.[/p][p]Ac turpis egestas. Maecenas mattis sit amet ipsum sit amet condimentum. Nulla ut tellus sit amet tellus rhoncus ullamcorper a et erat. Interdum et malesuada fames ac ante ipsum primis in faucibus.[/p]</textarea></td></tr></table><h4 style="margin: 10px 15px 0 15px;"><?php _e( "Team", "martanian" ); ?>:</h4><div class="martanian-persons"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][next_person_id]" value="1" /></div><input type="button" class="button" value="<?php _e( "Add person", "martanian" ); ?>" style="margin-left: 10px;" name="add-person-button" data-section-id="'+ nextSectionID +'" /><div style="clear: both"></div></div></div></div>';
            
                jQuery( '.martanian-home-page-sort' ).append( html );
                jQuery( 'select[name=sections-select] option[value=about-us]' ).remove();
                
                jQuery.UpSectionID( nextSectionID );
            
            break;
            
            case 'gallery':
            
                html = '<div class="martanian-home-page-postbox postbox" data-section-id="'+ nextSectionID +'"><div class="hndle"><h4><?php _e( "Gallery", "martanian" ); ?></h4><div class="options"><span class="more" data-value="less"><?php _e( "Less", "martanian" ); ?></span><span class="remove" data-element-type="gallery"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][type]" value="gallery" /><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Color title", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][color_title]" value="<?php _e( "OUR HAIR SALON GALLERY", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Title", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][title]" value="<?php _e( "How do we work?", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Description", "martanian" ); ?>:</th><td><textarea name="martanian_theme_options[sections][data]['+ nextSectionID +'][description]" rows="5" cols="75"><?php _e( "Every day, right in our hair salon we are waiting for you, dear customer. Our best stylists are here to give you your dream hairs.", "martanian" ); ?></textarea></td></tr></table><h4 style="margin: 10px 15px 0 15px;"><?php _e( "Gallery images", "martanian" ); ?>:</h4><div class="martanian-gallery"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][next_image_id]" value="1" /><div class="martanian-gallery-images"></div></div><input type="button" class="button" value="<?php _e( "Add image", "martanian" ); ?>" style="margin-left: 10px;" name="add-gallery-image-button" data-section-id="'+ nextSectionID +'" /><div style="clear: both"></div></div></div></div>';
            
                jQuery( '.martanian-home-page-sort' ).append( html );
                jQuery( 'select[name=sections-select] option[value=gallery]' ).remove();
                
                jQuery.UpSectionID( nextSectionID );
            
            break;
            
            case 'your-html':
            
                html = '<div class="martanian-home-page-postbox postbox"><div class="hndle"><h4><?php _e( "Your HTML", "martanian" ); ?></h4><div class="options"><span class="more" data-value="less"><?php _e( "Less", "martanian" ); ?></span><span class="remove" data-element-type="your-html"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][type]" value="your-html" /><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Prefix", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][prefix]" value="<?php _e( "your-html", "martanian" ); ?>-'+ nextSectionID +'" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Background color", "martanian" ); ?>:</th><td><select name="martanian_theme_options[sections][data]['+ nextSectionID +'][background_color]"><option value="white"><?php _e( "White", "martanian" ); ?></option><option value="gray"><?php _e( "Gray", "martanian" ); ?></option></select></td></tr><tr valign="top"><th scope="row"><?php _e( "HTML", "martanian" ); ?>:</th><td><textarea rows="15" cols="75" name="martanian_theme_options[sections][data]['+ nextSectionID +'][html]"></textarea></td></tr></table></div></div></div>';
            
                jQuery( '.martanian-home-page-sort' ).append( html );
                jQuery.UpSectionID( nextSectionID );
            
            break;
            
            case 'address-data':
            
                html = '<div class="martanian-home-page-postbox postbox"><div class="hndle"><h4><?php _e( "Address data", "martanian" ); ?></h4><div class="options"><span class="more" data-value="less"><?php _e( "Less", "martanian" ); ?></span><span class="remove" data-element-type="address-data"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields"><input type="hidden" name="martanian_theme_options[sections][data]['+ nextSectionID +'][type]" value="address-data" /><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Your salon name", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][salon-name]" value="<?php _e( "Your Hair Salon Inc.", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Your salon address (street)", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][street]" value="Cross Street 1" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Your salon address (city)", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][city]" value="Singapore" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Your salon contact phone number", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][phone-number]" value="+98 765 432 1023" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Your salon email", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][email]" value="<?php _e( "your.email@example.com", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Your salon website", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][website]" value="yourexamplehairsalon.com" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Your salon Facebook fanpage URL", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ nextSectionID +'][fanpage-url]" value="https://www.facebook.com/themeforest" /></td></tr></table></div></div></div>';
                
                jQuery( '.martanian-home-page-sort' ).append( html );
                jQuery.UpSectionID( nextSectionID );
            
            break;
        }
   
    });
    
   /**
    *
    * less / more
    * 
    */  
    
    jQuery( '.martanian-home-page-sort' ).on( 'click', '.martanian-home-page-postbox .hndle .more', function() {
    
        element = jQuery( this );
        if( element.attr( 'data-value' ) == 'less' ) {
        
            element.parent().siblings( '.fields' ).hide();
            element.attr( 'data-value', 'more' );
            element.html( '<?php _e( "More", "martanian" ); ?>' );
        }
        
        else {
        
            element.parent().siblings( '.fields' ).show();
            element.attr( 'data-value', 'less' );
            element.html( '<?php _e( "Less", "martanian" ); ?>' );
        }
    
    });       
    
   /**
    *
    * remove sections
    * 
    */
    
    jQuery( '.martanian-home-page-sort' ).on( 'click', '.martanian-home-page-postbox .hndle .remove', function() {
    
        element = jQuery( this );
        element_type = element.attr( 'data-element-type' );
        
        element.parent().parent().parent().remove();
        switch( element_type ) {
        
            case 'small-appointment': jQuery( 'select[name=sections-select]' ).append( '<option value="small-appointment"><?php _e( "Small appointment", "martanian" ); ?></option>' ); break;
            case 'twitter-last-blog-post': jQuery( 'select[name=sections-select]' ).append( '<option value="twitter-last-blog-post"><?php _e( "Twitter / last blog post", "martanian" ); ?></option>' ); break;
            case 'facebook-last-blog-post': jQuery( 'select[name=sections-select]' ).append( '<option value="facebook-last-blog-post"><?php _e( "Facebook / last blog post", "martanian" ); ?></option>' ); break;
            case 'contact-form': jQuery( 'select[name=sections-select]' ).append( '<option value="contact-form"><?php _e( "Contact form", "martanian" ); ?></option>' ); break;
            case 'opening-hours': jQuery( 'select[name=sections-select]' ).append( '<option value="opening-hours"><?php _e( "Opening hours", "martanian" ); ?></option>' ); break;
            case 'about-us': jQuery( 'select[name=sections-select]' ).append( '<option value="about-us"><?php _e( "About us", "martanian" ); ?></option>' ); break;
            case 'gallery': jQuery( 'select[name=sections-select]' ).append( '<option value="gallery"><?php _e( "Gallery", "martanian" ); ?></option>' ); break;
            case 'address-data': jQuery( 'select[name=sections-select]' ).append( '<option value="address-data"><?php _e( "Address and contact data", "martanian" ); ?></option>' ); break;
        }
    
    });
    
   /**
    *
    * add new slide to "presentation with image" section
    * 
    */
    
    jQuery( '.martanian-home-page-sort' ).on( 'click', 'input[name=add-slide-button]', function() {
    
        section_id = jQuery( this ).attr( 'data-section-id' );

        next_slide_id = jQuery( 'input[name="martanian_theme_options[sections][data]['+ section_id +'][next_slide_id]"]' ).val();
        jQuery( 'input[name="martanian_theme_options[sections][data]['+ section_id +'][next_slide_id]"]' ).attr( 'value', parseInt( next_slide_id ) + 1 );

        html = '<div class="martanian-slide"><div class="head"><h4><?php _e( "Single slide", "martanian" ); ?></h4><div class="options"><span class="more" data-value="more"><?php _e( "More", "martanian" ); ?></span><span class="remove" data-element-type="presentation-with-image"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields" style="display: none;"><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Section title", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ section_id +'][slides]['+ next_slide_id +'][title]" value="<?php _e( "Single slide", "martanian" ); ?>" /></td></tr><tr valign="top" class="section-image"><th scope="row"><?php _e( "Section image", "martanian" ); ?>:</th><td><span class="image-place"><img src="<?php echo get_template_directory_uri(); ?>/_assets/_img/empty549x549.png" alt="Section image" style="max-width: 400px; max-height: 300px;" /></span><input type="hidden" name="martanian_theme_options[sections][data]['+ section_id +'][slides]['+ next_slide_id +'][slider_image_url]" value="" class="section_image_hidden" /></td></tr><tr valign="top"><th scope="row"></th><td><input class="change_section_image button" type="button" value="<?php _e( "Change section image", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Content", "martanian" ); ?>:</th><td><textarea cols="75" rows="10" name="martanian_theme_options[sections][data]['+ section_id +'][slides]['+ next_slide_id +'][content]">[title]<?php _e( "Cut & Finish - [color]20% off![/color]", "martanian" ); ?>[/title][p]Nulla at diam ornare, aliquam urna vel, commodo urna. Nam id risus a est luctus consectetur quis eget libero.[/p][p]Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas mattis sit amet ipsum sit amet condimentum.[/p][p][appointment-link]<?php _e( "Make an appointment!", "martanian" ); ?>[/appointment-link][/p]</textarea></td></tr></table></div></div></div>';
        jQuery( '.martanian-home-page-postbox[data-section-id="'+ section_id +'"] .martanian-slides' ).append( html );
    
    }); 
    
   /**
    *
    * add new person to "about us" section
    * 
    */               
   
    jQuery( '.martanian-home-page-sort' ).on( 'click', 'input[name=add-person-button]', function() {

        section_id = jQuery( this ).attr( 'data-section-id' );
        
        next_person_id = jQuery( 'input[name="martanian_theme_options[sections][data]['+ section_id +'][next_person_id]"]' ).val();
        jQuery( 'input[name="martanian_theme_options[sections][data]['+ section_id +'][next_person_id]"]' ).attr( 'value', parseInt( next_person_id ) + 1 );
        
        html = '<div class="martanian-person" data-person-id="'+ next_person_id +'"><div class="head"><h4><?php _e( "Single person", "martanian" ); ?></h4><div class="options"><span class="more" data-value="more"><?php _e( "More", "martanian" ); ?></span><span class="remove"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields" style="display: none;"><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Name and surname", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ section_id +'][persons]['+ next_person_id +'][name]" value="<?php _e( "John Doe", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Profession", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ section_id +'][persons]['+ next_person_id +'][profession]" value="<?php _e( "hairdresser, stylist", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Facebook profile", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ section_id +'][persons]['+ next_person_id +'][facebook]" value="https://www.facebook.com/" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Google+ profile", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ section_id +'][persons]['+ next_person_id +'][google-plus]" value="https://plus.google.com/" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Description", "martanian" ); ?>:</th><td><textarea cols="75" rows="5" name="martanian_theme_options[sections][data]['+ section_id +'][persons]['+ next_person_id +'][description]"><?php _e( "John is one of our best stylist. He has big experience with cutting men\'s hair - contact us and make your appointment with John!", "martanian" ); ?></textarea></td></tr><tr valign="top" class="person-image"><th scope="row"><?php _e( "Person image", "martanian" ); ?>:</th><td><span class="image-place"><img src="<?php echo get_template_directory_uri(); ?>/_assets/_img/person.png" alt="Person image" style="width: 100px; height: 100px;" /></span><input type="hidden" name="martanian_theme_options[sections][data]['+ section_id +'][persons]['+ next_person_id +'][person_image_url]" value="" class="person_image_hidden" /></td></tr><tr valign="top"><th scope="row"></th><td><input class="change_person_image button" type="button" value="<?php _e( "Change person image", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Skills", "martanian" ); ?></th><td><div class="skills"></div><input class="add_skill_button button" type="button" value="<?php _e( "Add skill", "martanian" ); ?>" data-next-skill-id="1" data-person-id="'+ next_person_id +'" data-section-id="'+ section_id +'" /></td></tr></table></div></div></div>';  
        jQuery( '.martanian-home-page-postbox[data-section-id="'+ section_id +'"] .martanian-persons' ).append( html );

    });

   /**
    *
    * add new skill to person / remove skill on "about us"
    * 
    */                       
    
    jQuery( '.martanian-home-page-sort' ).on( 'click', '.add_skill_button', function() {

        section_id = jQuery( this ).attr( 'data-section-id' );
        person_id = jQuery( this ).attr( 'data-person-id' );
        skill_id = jQuery( this ).attr( 'data-next-skill-id' );
        
        jQuery( this ).attr( 'data-next-skill-id', parseInt( skill_id ) + 1 );
        
        html = '<div class="skill"><input type="text" name="martanian_theme_options[sections][data]['+ section_id +'][persons]['+ person_id +'][skills]['+ skill_id +'][name]" value="<?php _e( "Man cuts", "martanian" ); ?>" /><select name="martanian_theme_options[sections][data]['+ section_id +'][persons]['+ person_id +'][skills]['+ skill_id +'][value]"><option value="10">10%</option><option value="20">20%</option><option value="30">30%</option><option value="40">40%</option><option value="50">50%</option><option value="60">60%</option><option value="70">70%</option><option value="80">80%</option><option value="90">90%</option><option value="100">100%</option></select><span class="remove_skill_button"><?php _e( "Remove", "martanian" ); ?></span></div>';
        jQuery( '.martanian-home-page-postbox[data-section-id="'+ section_id +'"] .martanian-person[data-person-id="'+ person_id +'"] .skills' ).append( html );
    
    });   
    
    jQuery( '.martanian-home-page-sort' ).on( 'click', '.remove_skill_button', function() {
    
        jQuery( this ).parent().remove();
    
    });
    
   /**
    *
    * add new gallery image to "gallery" section
    * 
    */               
   
    jQuery( '.martanian-home-page-sort' ).on( 'click', 'input[name=add-gallery-image-button]', function() {

        section_id = jQuery( this ).attr( 'data-section-id' );
        
        next_gallery_image_id = jQuery( 'input[name="martanian_theme_options[sections][data]['+ section_id +'][next_image_id]"]' ).val();
        jQuery( 'input[name="martanian_theme_options[sections][data]['+ section_id +'][next_image_id]"]' ).attr( 'value', parseInt( next_gallery_image_id ) + 1 );
        
        html = '<div class="martanian-gallery-image" data-gallery-image-id="'+ next_gallery_image_id +'"><div class="head"><h4><?php _e( "Gallery image", "martanian" ); ?></h4><div class="options"><span class="more" data-value="more"><?php _e( "More", "martanian" ); ?></span><span class="remove"><?php _e( "Remove", "martanian" ); ?></span></div><div class="fields" style="display: none;"><table class="form-table"><tr valign="top"><th scope="row"><?php _e( "Image title", "martanian" ); ?>:</th><td><input type="text" name="martanian_theme_options[sections][data]['+ section_id +'][gallery_images]['+ next_gallery_image_id +'][title]" value="<?php _e( "Gallery image", "martanian" ); ?>" /></td></tr><tr valign="top" class="gallery-image"><th scope="row"><?php _e( "Gallery image", "martanian" ); ?>:</th><td><span class="image-place"><img src="<?php echo get_template_directory_uri(); ?>/_assets/_img/empty549x549.png" alt="Gallery image" style="max-width: 400px; max-height: 300px;" /></span><input type="hidden" name="martanian_theme_options[sections][data]['+ section_id +'][gallery_images]['+ next_gallery_image_id +'][image_url]" value="" class="gallery_image_hidden" /></td></tr><tr valign="top"><th scope="row"></th><td><input class="change_gallery_image button" type="button" value="<?php _e( "Change gallery image", "martanian" ); ?>" /></td></tr><tr valign="top"><th scope="row"><?php _e( "Tags", "martanian" ); ?></th><td><div class="tags"></div><input class="add_tag_button button" type="button" value="<?php _e( "Add tag", "martanian" ); ?>" data-next-tag-id="1" data-gallery-image-id="'+ next_gallery_image_id +'" data-section-id="'+ section_id +'" /></td></tr></table></div></div></div>';  
        jQuery( '.martanian-home-page-postbox[data-section-id="'+ section_id +'"] .martanian-gallery-images' ).append( html );

    });
   
   /**
    *
    * add new tag to gallery image / remove tag on "gallery"
    * 
    */                       
    
    jQuery( '.martanian-home-page-sort' ).on( 'click', '.add_tag_button', function() {

        section_id = jQuery( this ).attr( 'data-section-id' );
        gallery_image_id = jQuery( this ).attr( 'data-gallery-image-id' );
        next_tag_id = jQuery( this ).attr( 'data-next-tag-id' );

        jQuery( this ).attr( 'data-next-tag-id', parseInt( next_tag_id ) + 1 );
        
        html = '<div class="tag"><input type="text" name="martanian_theme_options[sections][data]['+ section_id +'][gallery_images]['+ gallery_image_id +'][tags]['+ next_tag_id +']" value="<?php _e( "Men\'s hairs", "martanian" ); ?>" /><span class="remove_tag_button"><?php _e( "Remove", "martanian" ); ?></span></div>';
        jQuery( '.martanian-home-page-postbox[data-section-id="'+ section_id +'"] .martanian-gallery-image[data-gallery-image-id="'+ gallery_image_id +'"] .tags' ).append( html );
 
    });   
    
    jQuery( '.martanian-home-page-sort' ).on( 'click', '.remove_tag_button', function() {
    
        jQuery( this ).parent().remove();
    
    });  
    
   /**
    *
    * colors manager
    * 
    */
    
    jQuery( 'input[type="text"].martanian_colorpicker' ).wpColorPicker();

   /**
    *
    * finish
    * 
    */                                             

});
</script>
<div class="wrap">

    <form action="options.php" method="post" enctype="multipart/form-data" name="martanian-options-form">
    
        <div class="martanian-theme-options-title"><div id="icon-themes" class="icon32"></div><h2>Frisieur - <?php _e( "Theme Options", "martanian" ); ?></h2></div>
        <div class="martanian-theme-options-header"></div>
        <div class="martanian-theme-options-description">
        
            <p style="float: left;"><?php _e( 'Welcome in Frisieur Theme Admin Panel!', 'martanian' ); ?></p>
            <p style="float: right;">Frisieur by <a href="http://martanian.com/">Martanian</a></p>
            
            <div class="clear">
            </div>
            
        </div>
        <div class="martanian-theme-options-container">
        
            <div class="martanian-theme-options-menu">
            
                <ul>
                
                    <li class="active" data-martanian-section-name="header-slider"><?php _e( 'Header slider', 'martanian' ); ?></li>
                    <li data-martanian-section-name="slogan"><?php _e( 'Slogan', 'martanian' ); ?></li>
                    <li data-martanian-section-name="footer-options"><?php _e( 'Footer options', 'martanian' ); ?></li>
                    <li data-martanian-section-name="logo-options"><?php _e( 'Logo options', 'martanian' ); ?></li>
                    <li data-martanian-section-name="home-page"><?php _e( 'Home page', 'martanian' ); ?></li>
                    <li data-martanian-section-name="colors"><?php _e( 'Colors', 'martanian' ); ?></li>
                
                </ul>
            
            </div>
            
            <div class="martanian-theme-options-content">

                <?php if( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' ) { echo '<div class="martanian-message">'. __( 'Settings saved!', 'martanian' ) .'</div>'; } ?>
    
                <?php settings_fields( 'martanian_theme_options' ); ?>
                <?php do_settings_sections( 'martanian_admin' ); ?>
                
                </div>

            </div>
        
        </div>
    
    </form> 

</div>