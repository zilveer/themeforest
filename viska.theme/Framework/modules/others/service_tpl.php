<div class="meta-box-sortables awe-settings">
    <div class="postbox ">
        <div title="Click to toggle" class="handlediv"><br></div>
        <h3 class="hndle"><span><?php _e('Logo Service',self::LANG);?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tbody>
                <?php $logo = $this->get_custom_fields('logo',$this->service_option);?>
                    <tr>
                        <th scope="row"><?php _e('Choose Logo',self::LANG);?></th>
                        <td>
                            <label for="icon"><input type="radio" id="icon" <?php checked($logo['type'],'icon');?> value="icon" name="service[logo][type]"> Font icon</label>
                            <br>
                            <label for="image"><input type="radio" id="image" <?php checked($logo['type'],'image');?> value="image" name="service[logo][type]"> Image</label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Your Logo</th>
                        <td>

                            <div class="icon-logo" <?php if($logo['type']!='icon'):?>style="display: none" <?php endif;?>>
                                <a href="#" class="md-popup-choose-icon logo-icon"><i class="<?php echo $logo['icon']?>"></i> </a>
                                <input type="hidden" name="service[logo][icon]" value="<?php echo $logo['icon']?>">
                            </div>
                            <div class="image-logo" <?php if($logo['type']!='image'):?>style="display: none" <?php endif;?>>
                                <a href="#"><img src="<?php echo $logo['image']?>"></a>
                                <input type="hidden" name="service[logo][image]" value="<?php echo $logo['image']?>">
                            </div>
                            <p><?php _e("Click on logo to change",self::LANG);?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="meta-box-sortables awe-settings">
    <div class="postbox " >
        <div title="Click to toggle" class="handlediv"><br></div>
        <h3 class="hndle"><span><?php _e('Summary',self::LANG);?></span></h3>
        <div class="inside">
            <?php
            $valueeee2=  $this->get_custom_fields('summary',$this->service_option) ;
            wp_editor( htmlspecialchars_decode($valueeee2), self::NAME.'summary', $settings = array('textarea_name'=>'service[summary]','textarea_rows'=>'3','media_buttons'=>false,'tinymce'=>true) );
            ?>

<!--            <label for="excerpt" class="screen-reader-text">--><?php //_e('Summary',self::LANG);?><!--</label><textarea id="excerpt" name="service[summary]" cols="40" rows="1">--><?php //echo $this->get_custom_fields('summary',$this->service_option)?><!--</textarea>-->
        </div>
    </div>
</div>




