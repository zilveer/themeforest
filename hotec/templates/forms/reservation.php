<form id="reservation_form" class="reservation_form reservation_form_page" action="" method="post">
    <div class="row">
        <div class="six columns b0">
            <div class="form-row field_text">
                <label><?php _e('Your Name:','smooththemes'); ?></label><br>
                <input id="reservation_name" class="input_text required" type="text" value="" name ="reservation_name">
            </div>
            <div class="form-row field_text">
                <label><?php echo _e('Your email address:','smooththemes'); ?></label><br>
                <input id="reservation_email" class="input_text required" type="text" value="" name ="reservation_email">
            </div>
            <div class="form-row field_select">
                <label><?php _e('Choose room type:','smooththemes'); ?></label><br>
                <div class="select-box">
                    <span><?php _e('Select a room','smooththemes'); ?></span>
                    <select class="" name="reservation_type" id="reservation_type">
                        <?php 
                        // added in ver 1.3
                        $args = array();
                        $args['posts_per_page'] ='-1';
                        $args['orderby'] = 'post_title';
                        $args['order'] = 'ASC';
                        $args['post_type']='room';
                        if(st_is_wpml()){
                              $args['sippress_filters'] = true;
                              $args['language'] = get_bloginfo('language');
                         }
                          
                         //  echo var_dump($wp_query);
                         $new_query = new WP_Query($args);
                         $myposts = $new_query->posts;
                          foreach($myposts as $p){
                               ?>
                                <option value="<?php echo esc_attr(apply_filters('the_title',$p->post_title)) ?>"><?php echo apply_filters('the_title',$p->post_title) ; ?></option>
                               <?php
                          }
                         
                         /*
                        ?>
    
                        <option value="Single_Room"><?php _e('Single Room','smooththemes'); ?></option>
                        <option value="Double_Room"><?php _e('Double Room','smooththemes'); ?></option>
                        <option value="Deluxe_Room"><?php _e('Deluxe Room','smooththemes'); ?></option>
                        <option value="Family_Suite"><?php _e('Family Suite','smooththemes'); ?></option>
                        <?php 
                        */ 
                        
                        wp_reset_query(); ?>
                    </select>
                </div>
            </div>
            <div class="form-row field_select">
                <label><?php _e('No. of adults:','smooththemes'); ?></label><br>
                <div class="select-box">
                    <span>1</span>
                    <select class="" name="reservation_adults" id="reservation_adults">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        <option value="3">5</option>
                    </select>
                </div>
            </div>
            <div class="clear"></div>
            <div class="form-row">
                <label><?php _e('Arrival Date:','smooththemes'); ?></label><br>
                <input id="reservation_arrival" type="hidden" name="reservation_arrival" value="" placeholder="" class="input_text">
                <div id="arrival_date"></div>
            </div>

        </div>
        <div class="six columns b0">
            <div class="form-row field_text">
                <label><?php _e('Your Address:','smooththemes'); ?></label><br>
                <input id="reservation_address" class="input_text" type="text" value="" name ="reservation_address">
            </div>
            <div class="form-row field_text">
                <label><?php _e('Your phone number:','smooththemes'); ?></label><br>
                <input id="reservation_phone" class="input_text required" type="text" value="" name ="reservation_phone">
            </div>
            <div class="form-row field_select">
                <label><?php _e('No. of rooms:','smooththemes' ); ?></label><br>
                <div class="select-box">
                    <span>1</span>
                    <select class="" name="reservation_room_number" id="reservation_room_number">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                    </select>
                </div>
            </div>
            <div class="form-row field_select">
                <label><?php _e('No. of children:','smooththemes'); ?></label><br>
                <div class="select-box">
                    <span>0</span>
                    <select class="" name="reservation_children" id="reservation_children">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                    </select>
                </div>
            </div>
            <div class="clear"></div>
            <div class="form-row">
                <label><?php _e('Departure Date:','smooththemes'); ?></label><br>
                <input id="reservation_departure" type="hidden" name="reservation_departure" value="" placeholder="" class="input_text">
                <div id="departure_date"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="form-row field_textarea">
        <label><?php _e('Special Requirements:','smooththemes'); ?> </label>
        <textarea id="requirements" class="" name="reservation_requirements"></textarea>
    </div>
    <div class="form-row field_submit mt20">
        <input type="submit" value="<?php _e('Submit Now','smooththemes'); ?>" id="reservation_submit" class="btn">
        <span class="loading hide"><img src="<?php echo st_img('loader.gif'); ?>"></span>
    </div>
    <div class="form-row notice_bar">
        <p class="notice notice_ok hide"><?php _e('Thank you for contacting us. We will get back to you as soon as possible.','smooththemes'); ?></p>
        <p class="notice notice_error hide"><?php _e('Due to an unknown error, your form was not submitted. Please resubmit it or try later.','smooththemes'); ?></p>
    </div>
     <input type="hidden" name="to_email" value="<?php echo esc_attr($data['to_email']); ?>" />
</form> <!-- END Reservation Form -->