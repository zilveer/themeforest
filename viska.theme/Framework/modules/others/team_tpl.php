<div class="meta-box-sortables awe-settings">
    <div class="postbox " id="author-info">
        <div title="Click to toggle" class="handlediv"><br></div>
        <h3 class="hndle"><span><?php _e('Information',self::LANG);?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row"><label for="position"><?php _e('Photo',self::LANG);?></label></th>
                    <td>
                        <a href="#" class="photo"><img src="<?php echo $this->get_custom_fields('photo',$this->team_option);?>"></a>
                        <input type="hidden" size="70" class="input-photo" id="position" value="<?php echo $this->get_custom_fields('photo',$this->team_option);?>" name="team[photo]">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="position"><?php _e('Title/Position',self::LANG);?></label></th>
                    <td>
                        <input type="text" size="70" id="position" value="<?php echo $this->get_custom_fields('position',$this->team_option);?>" name="team[position]">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="smallintro"><?php _e('A Small Introduction',self::LANG);?></label></th>
                    <td>
                        <?php
                        $value=  $this->get_custom_fields('smallintro',$this->team_option) ;
                        wp_editor( htmlspecialchars_decode($value), self::NAME.'smallintro', $settings = array('textarea_name'=>'team[smallintro]','textarea_rows'=>'3','media_buttons'=>false,'tinymce'=>true) );
                        ?>
                        </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
