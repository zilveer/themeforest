<div class="meta-box-sortables awe-settings">
    <div class="postbox" id="author-info">
        <div title="Click to toggle" class="handlediv"><br></div>
        <h3 class="hndle"><span><?php _e('Information',self::LANG);?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tbody>
                <!-- <tr>
                    <th scope="row"><label for="photo"><?php _e('Photo',self::LANG);?></label></th>
                    <td>
                        <a href="#" class="photo"><img src="<?php echo $this->get_custom_fields('photo',$this->testimonial_option);?>"></a>
                        <input type="hidden" size="70" id="photo" value="<?php echo $this->get_custom_fields('photo',$this->testimonial_option);?>" name="testimonial[photo]">
                    </td>
                </tr> -->
                <tr>
                    <th scope="row"><label for="subtitle"><?php _e('Subtitle below name',self::LANG);?></label></th>
                    <td>
                        <input type="text" size="70" id="subtitle" value="<?php echo $this->get_custom_fields('subtitle',$this->testimonial_option);?>" name="testimonial[subtitle]">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="testimonial"><?php _e('Quote',self::LANG);?></label></th>
                    <td>
                        <textarea cols="70" rows="3" id="testimonial" name="testimonial[quote]"><?php echo $this->get_custom_fields('quote',$this->testimonial_option);?></textarea>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
