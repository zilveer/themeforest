<div class="row-element <?php if( $this -> is_additional ) echo 'undeletable';?>" data-id="<?php echo $this -> id;?>">
    <input type="hidden" name="<?php echo $this -> get_prefix();?>[id]" value="<?php echo $this -> id;?>">
    <input type="hidden" name="<?php echo $this -> get_prefix();?>[is_additional]" value="<?php echo $this -> is_additional;?>">
    <div class="element-container activation row_settings"> <!-- This block is used for row Activation/deactivation settings -->
        <div class="on-edit">
            <header>
                <span class="fr">
                    <span class="fpb discard button">
                        <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                        <a href="javascript:void(0);" class="fpb_label">
                            <?php echo __( 'Discard', 'cosmotheme' );?>
                        </a>
                    </span>
                    <span class="fpb apply button">
                        <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                        <a href="javascript:void(0);" class="fpb_label">
                            <?php echo __( 'Save', 'cosmotheme' );?>
                        </a>
                    </span>
                </span>
            </header> 
            <div class="panel the-settings generic-field row-options">
                <!--YOU ADD ROW SETTING HERE. DON'T FORGET TO SET A DEFAULT IN LBRow::__construct OR YOURE GONNA GET A NOTICE-->
                
                <div class=" generic-field-header  ">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Hide this row', 'cosmotheme' );?>
                        </label>
                    </div>
                    
                    <div class="generic-field generic-field-image-select row-width_margin_bottom">
                        <label class="<?php if($this -> deactivate_row == 'yes'){echo ' selected ';} ?>">    
                            <?php echo __( 'Yes' , 'cosmotheme' );?>
                            <input type="radio" value="yes" name="<?php echo $this -> get_prefix();?>[deactivate_row]" <?php checked( $this -> deactivate_row, 'yes' );?>>
                        </label>
                        <label class="<?php if($this -> deactivate_row == 'no'){echo ' selected ';} ?>">    
                            <?php echo __( 'No' , 'cosmotheme' );?>
                            <input type="radio" value="no" name="<?php echo $this -> get_prefix();?>[deactivate_row]" <?php checked( $this -> deactivate_row, 'no' );?>>
                        </label>
                    </div>
                    <div class="hint"><?php //echo __( "Activate this option only if you want to remove margins for this row. We recommend to use it if you'll have a menu inside this row", 'cosmotheme' );?></div>
                </div>

            </div>
        </div>
    </div>
    <div class="element-container row_settings"> <!-- This block is used for row settings -->
        <div class="on-edit">
            <header>
                <span class="title fpb add_fpb">
                    <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                    <a href="javascript:void(0);" class="fpb_label">
                        <?php echo __( 'New element', 'cosmotheme' );?>
                    </a>
                </span>
                <span class="fr">
                    <span class="fpb discard button">
                        <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                        <a href="javascript:void(0);" class="fpb_label">
                            <?php echo __( 'Discard', 'cosmotheme' );?>
                        </a>
                    </span>
                    <span class="fpb apply button">
                        <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                        <a href="javascript:void(0);" class="fpb_label">
                            <?php echo __( 'Save', 'cosmotheme' );?>
                        </a>
                    </span>
                </span>
            </header> 
            <div class="panel the-settings generic-field row-options">
                <!--YOU ADD ROW SETTING HERE. DON'T FORGET TO SET A DEFAULT IN LBRow/LBFooterRow and LBHeaderRow::__construct OR YOURE GONNA GET A NOTICE-->
                
                <div class=" generic-field-header  ">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Remove bottom margin distance for this row', 'cosmotheme' );?>
                        </label>
                    </div>
                    
                    <div class="generic-field generic-field-image-select row-width_margin_bottom">
                        <label class="<?php if($this -> row_bottom_margin_removed == 'yes'){echo ' selected ';} ?>">
                            <?php echo __( 'Yes' , 'cosmotheme' );?>
                            <input type="radio" value="yes" name="<?php echo $this -> get_prefix();?>[row_bottom_margin_removed]" <?php checked( $this -> row_bottom_margin_removed, 'yes' );?>>
                        </label>
                        <label class="<?php if($this -> row_bottom_margin_removed == 'no'){echo ' selected ';} ?>">
                            <?php echo __( 'No' , 'cosmotheme' );?>
                            <input type="radio" value="no" name="<?php echo $this -> get_prefix();?>[row_bottom_margin_removed]" <?php checked( $this -> row_bottom_margin_removed, 'no' );?>>
                        </label>
                    </div>
                    <div class="hint"><?php //echo __( "Activate this option only if you want to remove margins for this row. We recommend to use it if you'll have a menu inside this row", 'cosmotheme' );?></div>
                </div>

                <div class=" generic-field-header  ">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Extend the content of this row on full width', 'cosmotheme' );?>
                        </label>
                    </div>
                    
                    <div class="generic-field generic-field-image-select row-conten-width">
                        <label class="<?php if($this -> row_content_width == 'full_width_content_yes'){echo ' selected ';} ?>">
                            <?php echo __( 'Yes' , 'cosmotheme' );?>
                            <input type="radio" value="full_width_content_yes" name="<?php echo $this -> get_prefix();?>[row_content_width]" <?php checked( $this -> row_content_width, 'full_width_content_yes' );?>>
                        </label>
                        <label class="<?php if($this -> row_content_width == 'full_width_content_no'){echo ' selected ';} ?>">
                            <?php echo __( 'No' , 'cosmotheme' );?>
                            <input type="radio" value="full_width_content_no" name="<?php echo $this -> get_prefix();?>[row_content_width]" <?php checked( $this -> row_content_width, 'full_width_content_no' );?>>
                        </label>
                    </div>
                    
                </div>

                <div class=" generic-field-header  ">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Use this row on full width', 'cosmotheme' );?>
                        </label>
                    </div>
                    
                    <div class="generic-field generic-field-image-select row-width">
                        <label class="<?php if($this -> row_width == 'full_width_yes'){echo ' selected ';} ?>">
                            <?php echo __( 'Yes' , 'cosmotheme' );?>
                            <input type="radio" value="full_width_yes" name="<?php echo $this -> get_prefix();?>[row_width]" <?php checked( $this -> row_width, 'full_width_yes' );?>>
                        </label>
                        <label class="<?php if($this -> row_width == 'full_width_no'){echo ' selected ';} ?>">
                            <?php echo __( 'No' , 'cosmotheme' );?>
                            <input type="radio" value="full_width_no" name="<?php echo $this -> get_prefix();?>[row_width]" <?php checked( $this -> row_width, 'full_width_no' );?>>
                        </label>
                    </div>
                    <div class="hint"><?php echo __( 'Please use full width row only if the template is used without left or right sidebar', 'cosmotheme' );?>.</div>
                </div>

                <div class=" generic-field-header  row_bg_color_options">
                    <div class="generic-label">
                        <label><?php _e('Row background color','cosmotheme'); ?></label>
                    </div>

                    <input type="text" name="<?php echo $this->get_prefix();?>[row_bg_color]" value="<?php echo $this->row_bg_color;?>" class="my-color-field" />
                </div>    

            </div>
        </div>
    </div>
    <div class="tools">
        <?php if( $this -> is_additional ){ ?>
        <a class="edit-row-activation edit-element has-popup">
            <div class="popup">
                <?php _e('Hide this row','cosmotheme'); ?>
                <div class="maybe-pointer"></div>
            </div>
        </a>
        <?php } ?>
        <a class="edit-row edit-element has-popup">
            <div class="popup">
                <?php _e('Customize the row','cosmotheme'); ?>
                <div class="maybe-pointer"></div>
            </div>
        </a>
        <a class="sort has-popup">
            <div class="popup">
                <?php echo __( 'Drag up and down to sort', 'cosmotheme' );?>
                <div class="maybe-pointer"></div>
            </div>
        </a>
        <?php if( !$this -> is_additional ){ ?>
            <a class="add-column has-popup">
                <div class="popup">
                    <?php echo __( 'Add column', 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>
            <a class="delete-row has-popup">
                <div class="popup">
                    <?php echo __( 'Delete row', 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>
        <?php } ?>
    </div>
    <div class="row add-grid add-border">
        <?php
            foreach( $this -> elements as $element ){
                $element -> render_backend();
            }
        ?>
    </div>
    <div class="feedback"></div>
</div>