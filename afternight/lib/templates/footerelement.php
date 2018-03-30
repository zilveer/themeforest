<div class="<?php echo LBRenderable::$words[ $this -> element_columns ];?> columns resizable" data-id="<?php echo $this -> id;?>">
    <input type="hidden" name="<?php echo $this -> get_prefix();?>[id]" value="<?php echo $this -> id;?>" class="element-id">
    <input type="hidden" name="<?php echo $this -> get_prefix();?>[element_columns]" value="<?php echo $this -> element_columns;?>" class="element-columns">
    <div class="fl">
        <div class="tools">
            <a class="edit-element has-popup" data-element-id="<?php echo $this -> id;?>" href="javascript:void(0);">
                <div class="popup">
                    <?php echo __( 'Edit content', 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>
            </a>
            <?php if( !$this -> row -> is_additional ){ ?>
                
                <a class="delete-column has-popup" href="javascript:void(0);">
                    <div class="popup">
                        <?php echo __( 'Delete these columns', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </a>
                <a class="add-element has-popup" href="javascript:void(0);">
                    <div class="popup">
                        <?php echo __( 'Add content', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <?php if( $this -> row -> is_additional ){ ?>
            <div class="default-row-hint">
                <h4><?php echo __( 'Default', 'cosmotheme' );?></h4>
                <?php echo __( <<<endhtml
This row loads the default WordPress content for each page. You cannot delete it or split it into several columns.<br />
If assigned for such pages as Author archives or Category it will represent the author's posts or posts belonging to a given category. Feel free to edit it and choose content layout.<br />
If assigned for Pages or Posts - it will represent the page content. Editing it will have no effect.
endhtml
                );?>
            </div>
        <?php } ?>
    </div>
    <div class="relative-wrapper">
        <a class="handle has-popup">
            <div class="popup">
                <?php echo __( 'Drag left and right to resize the neighbours', 'cosmotheme' );?>
                <div class="maybe-pointer"></div>
            </div>
        </a>
    </div>

    <div class="display_hint" id="<?php echo $this -> id;?>"><?php echo __( 'Click the <b>edit elements</b> icon to add content', 'cosmotheme' );?></div>
    
    <div class="element-container">
        <?php
            $this -> print_taxonomy_inputs( 'boxes', $this -> boxes );
            $this -> print_taxonomy_inputs( 'banners', $this -> banners );
            $this -> print_taxonomy_inputs( 'testimonials', $this -> testimonials );
        ?>
        <div class="select-box sidebars hidden">
            <input type="radio" name="<?php echo $this -> get_prefix();?>[sidebar]" value="<?php echo $this -> sidebar;?>" checked="checked">
        </div>
        <div class="on-overview">
            <div class="element-description"></div>
        </div>
        <div class="on-edit">
            <header>
                <span class="title fpb add_fpb">
                    <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                    <a href="javascript:void(0);" class="fpb_label">
                        <?php echo $this -> name; ?>
                    </a>
                </span>
                <span class="fr">
                    <span class="fpb discard button">
                        <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                        <a href="javascript:void(0);" class="fpb_label">
                            <?php echo __( 'Discard' , 'cosmotheme' );?>
                        </a>
                    </span>
                    <span class="fpb apply button">
                        <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                        <a href="javascript:void(0);" class="fpb_label">
                            <?php echo __( 'Save' , 'cosmotheme' );?>
                        </a>
                    </span>
                </span>
            </header>
            <div class="panel the-settings">
                
                <div class="standard-generic-field generic-field-header">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Choose element type', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field generic-field-image-select element-type">
                        <label>
                            <?php echo __( 'Copyright' , 'cosmotheme' );?>
                            <input type="radio" value="copyright" name="<?php echo $this -> get_prefix();?>[type]" class="copyright-type" <?php checked( $this -> type, 'copyright' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Secondary navigation' , 'cosmotheme' );?>
                            <input type="radio" value="menu" name="<?php echo $this -> get_prefix();?>[type]" class="menu-type" <?php checked( $this -> type, 'menu' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Widgets' , 'cosmotheme' );?>
                            <input type="radio" value="widget_zone" name="<?php echo $this -> get_prefix();?>[type]" class="widget-type" <?php checked( $this -> type, 'widget_zone' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Banners', 'cosmotheme' );?>
                            <input type="radio" value="banners" name="<?php echo $this -> get_prefix();?>[type]" class="banner-type" <?php checked( $this -> type, 'banners' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Testimonials', 'cosmotheme' );?>
                            <input type="radio" value="testimonials" name="<?php echo $this -> get_prefix();?>[type]" class="testimonial-type" <?php checked( $this -> type, 'testimonials' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Box sets' , 'cosmotheme' );?>
                            <input type="radio" value="boxes" name="<?php echo $this -> get_prefix();?>[type]" class="box-set" <?php checked( $this -> type, 'boxes' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Social icons' , 'cosmotheme' );?>
                            <input type="radio" value="socialicons" name="<?php echo $this -> get_prefix();?>[type]" class="socialicons-type" <?php checked( $this -> type, 'socialicons' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Text / Shortcodes' , 'cosmotheme' );?>
                            <input type="radio" value="textelement" name="<?php echo $this -> get_prefix();?>[type]" class="textelement-type" <?php checked( $this -> type, 'textelement' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Delimiter' , 'cosmotheme' );?>
                            <input type="radio" value="delimiter" name="<?php echo $this -> get_prefix();?>[type]" class="delimiter-type" <?php checked( $this -> type, 'delimiter' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Empty' , 'cosmotheme' );?>
                            <input type="radio" value="empty" name="<?php echo $this -> get_prefix();?>[type]" class="empty-type" <?php checked( $this -> type, 'empty' );?>>
                        </label>
                    </div>
                </div>
                <div class="standard-generic-field generic-field-header element_type_list"></div>
                <div class="standard-generic-field generic-field-header option-delimiter_hint">
                    <div class="generic-label">
                        <label>
                            <?php 
                                echo  sprintf(__( 'We recommend to use this element only between rows' , 'cosmotheme' )) ;
                            ?>
                        </label>
                    </div>
                    <div class="generic-field generic-field-image-select delimiter-type">
                        <label class="columns-2">
                            <?php echo __( 'White space' , 'cosmotheme' );?>
                            <input type="radio" value="white_space" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'white_space' );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( 'Pointed delimiter' , 'cosmotheme' );?>
                            <input type="radio" value="pointed" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'pointed' );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( 'Doublepointed delimiter' , 'cosmotheme' );?>
                            <input type="radio" value="doublepointed" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'doublepointed' );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( 'Line delimiter' , 'cosmotheme' );?>
                            <input type="radio" value="line" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'line' );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( 'Doubleline delimiter' , 'cosmotheme' );?>
                            <input type="radio" value="doubleline" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'doubleline' );?>>
                        </label>
                    </div>
                    <div class="generic-label">
                        <label>
                            <?php 
                                echo  sprintf(__( 'Select margin distance for this delimiter' , 'cosmotheme' ))  ;
                            ?>
                        </label>
                    </div>                      
                    <div class="generic-field generic-field-image-select">
                        <label class="columns-2">
                            <?php echo __( '15px' , 'cosmotheme' );?>
                            <input type="radio" value="margin_15px" name="<?php echo $this -> get_prefix();?>[delimiter_margin]" <?php checked( $this -> delimiter_margin, 'margin_15px' );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( '30px' , 'cosmotheme' );?>
                            <input type="radio" value="margin_30px" name="<?php echo $this -> get_prefix();?>[delimiter_margin]" <?php checked( $this -> delimiter_margin, 'margin_30px' );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( '60px' , 'cosmotheme' );?>
                            <input type="radio" value="margin_60px" name="<?php echo $this -> get_prefix();?>[delimiter_margin]" <?php checked( $this -> delimiter_margin, 'margin_60px' );?>>
                        </label>
                    </div>
                    <div class="clear"></div>

                    <div class="delimiter_color">
                        <div class="generic-label">
                            <label>
                                <?php 
                                    echo  sprintf(__( 'Select color for this delimiter' , 'cosmotheme' ))  ;
                                ?>
                            </label>
                        </div>                      
                        <div class="generic-field delimiter_color_picker">
                            <input type="text" name="<?php echo $this->get_prefix();?>[delimiter_text_color]" value="<?php echo $this->delimiter_text_color;?>" class="my-color-field" />
                        </div>    
                    </div>                
                </div>
                <div class="standard-generic-field generic-field-header option-empty_hint">
                    <div class="generic-label">
                        <label>
                            <?php 
                                echo  sprintf(__( 'Use this element if you need to have empty columns' , 'cosmotheme' )) ;
                            ?>
                        </label>
                    </div>
                </div>            
                <div class="standard-generic-field generic-field-header option-numberposts">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Number of visible menus items', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field">
                        <input name="<?php echo $this -> get_prefix();?>[numberposts]" value="<?php echo $this -> numberposts;?>">
                    </div>
                    <div class="hint"><?php echo __( 'Set the number of visible menu items. Remaining menu items will be shown in the drop down menu item "More"', 'cosmotheme' );?>.</div>
                </div>
                <div class="standard-generic-field generic-field-header option-text">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Enter text you wish to display.', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field">
                        <textarea name="<?php echo $this -> get_prefix();?>[text]"><?php echo $this->text;?></textarea>
                    </div>
                </div>
                <!-- BOF text align OPTIONS -->
                <div class="standard-generic-field generic-field-header  text_align_options">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Text align', 'cosmotheme' );?>
                        </label>
                    </div>
                    
                    <div class="generic-field generic-field-image-select">
                        <label>
                            <?php echo __( 'Left' , 'cosmotheme' );?>
                            <input class="align_left" type="radio" value="left" name="<?php echo $this -> get_prefix();?>[text_align]" <?php checked( $this -> text_align, 'left' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Center' , 'cosmotheme' );?>
                            <input class="align_center" type="radio" value="center" name="<?php echo $this -> get_prefix();?>[text_align]" <?php checked( $this -> text_align, 'center' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Right' , 'cosmotheme' );?>
                            <input class="align_right" type="radio" value="right" name="<?php echo $this -> get_prefix();?>[text_align]" <?php checked( $this -> text_align, 'right' );?>>
                        </label>
                    </div>
                </div>
                <!-- EOF text align OPTIONS --> 
                
            </div>
        </div>
    </div>
</div>