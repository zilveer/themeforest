<div class="layout-tools">
    <a class="has-popup" href="javascript:void(0);" id="full_width">
        <label>
            <input type="radio" class="hidden" name="<?php echo $this->get_simpler_prefix();?>[layout_type]" value="full_width" <?php checked($this->layout_type, 'full_width');?>>
        </label>
        <div class="popup">
            <?php echo __( 'Full width', 'cosmotheme' );?>
        </div>
    </a>
    <a class="has-popup" href="javascript:void(0);" id="one_left_sidebar">
        <label>
            <input type="radio" class="hidden" name="<?php echo $this->get_simpler_prefix();?>[layout_type]" value="one_left_sidebar" <?php checked($this->layout_type, 'one_left_sidebar');?>>
        </label>
        <div class="popup">
            <?php echo __( 'One left sidebar', 'cosmotheme' );?>
        </div>
    </a>
    <a class="has-popup" href="javascript:void(0);" id="two_left_sidebars">
        <label>
            <input type="radio" class="hidden" name="<?php echo $this->get_simpler_prefix();?>[layout_type]<?php echo $this->get_simpler_prefix();?>" value="two_left_sidebars" <?php checked($this->layout_type, 'two_left_sidebars');?>>
        </label>
        <div class="popup">
            <?php echo __( 'Two left sidebars', 'cosmotheme' );?>
        </div>
    </a>
    <a class="has-popup" href="javascript:void(0);" id="one_left_one_right_sidebar">
        <label>
            <input type="radio" class="hidden" name="<?php echo $this->get_simpler_prefix();?>[layout_type]" value="one_left_one_right_sidebar" <?php checked($this->layout_type, 'one_left_one_right_sidebar');?>>
        </label>
        <div class="popup">
            <?php echo __( 'One left sidebar, one right sidebars', 'cosmotheme' );?>
        </div>
    </a>
    <a class="has-popup" href="javascript:void(0);" id="one_right_sidebar">
        <label>
            <input type="radio" class="hidden" name="<?php echo $this->get_simpler_prefix();?>[layout_type]" value="one_right_sidebar" <?php checked($this->layout_type, 'one_right_sidebar');?>>
        </label>
        <div class="popup">
            <?php echo __( 'One right sidebar', 'cosmotheme' );?>
        </div>
    </a>
    <a class="has-popup" href="javascript:void(0);" id="two_right_sidebars">
        <label>
            <input type="radio" class="hidden" name="<?php echo $this->get_simpler_prefix();?>[layout_type]" value="two_right_sidebars" <?php checked($this->layout_type, 'two_right_sidebars');?>>
        </label>
        <div class="popup">
            <?php echo __( 'Two right sidebars', 'cosmotheme' );?>
        </div>
    </a>
</div>
<div class="row-element">
    <div class="row add-grid add-border">
        <?php
            foreach( $this -> elements as $which => $element ){
        ?>
            <div class="<?php if( 'true' == $element[ 'disabled' ] ) echo 'disabled';?> columns resizable <?php echo LBRenderable::$words[ $element[ 'columns' ] ];?> <?php echo $element[ 'id' ];?>">
                <input type="hidden" name="<?php echo $this -> get_prefix( $element );?>[id]" value="<?php echo $element[ 'id' ];?>">
                <input type="hidden" name="<?php echo $this -> get_prefix( $element );?>[columns]" value="<?php echo $element[ 'columns' ];?>" class="element-columns">
                <input type="hidden" name="<?php echo $this -> get_prefix( $element );?>[disabled]" value="<?php echo $element[ 'disabled' ];?>" class="is-disabled">

                <div class="fl">
                    <div class="tools">

                        <a class="delete-column has-popup" href="javascript:void(0);" style="display:none;">
                            <div class="popup">
                                <?php echo __( 'Delete', 'cosmotheme' );?>
                                <div class="maybe-pointer"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="relative-wrapper">
                    <a class="handle has-popup ui-draggable" style="left: auto; ">
                        <div class="popup">
                            <?php echo __( 'Drag left and right to resize the neighbours', 'cosmotheme' );?>
                            <div class="maybe-pointer"></div>
                        </div>
                    </a>
                </div>
                <?php
                    if( 'main' != $which ){
                ?>
                    <div class="sidebar-dropdown">
                        <select name="<?php echo $this -> get_prefix( $element );?>[sidebar]">
                            <option value=""><?php echo __( 'Select a sidebar', 'cosmotheme' );?></option>
                            <?php
                                foreach( $this -> sidebars as $id => $name ){
                                    if( isset( $element[ 'sidebar' ] ) ){
                                        ?>
                                            <option value="<?php echo $id;?>" <?php selected( $element[ 'sidebar' ], $id );?>><?php echo $name;?></option>
                                        <?php
                                    }
                                }
                            ?>
                            <optgroup label="----------------"></optgroup>
                            <option value="">+ <?php echo __( 'new sidebar', 'cosmotheme' );?></option>
                        </select>
                    </div>
                <?php
                    }else{
                        $builder = new LBTemplateBuilder();
                        $builder -> load_all();
                        $templates = array( 'none' => __( 'Select a template', 'cosmotheme' ) );
                        foreach( $builder -> templates as $template ){
                            if( '__template__' != $template -> id ){
                                $templates[ $template -> id ] = $template -> name;
                            }
                        }
                        $prefix = $this -> template;
                        if( strlen( $prefix ) && (!is_numeric( $prefix ) || $prefix == 404) ){
                            $prefix .= '_';
                        }else{
                            $prefix = '';
                        }
                        $defaultTemplate = options::get_value( $prefix . 'layout', 'template' );
                ?>
                    <div class="sidebar-dropdown template-dropdown">
                        <select name="<?php echo $prefix . 'layout';?>[template]">
                            <?php
                            foreach( $templates as $id => $name ){
                                ?>
                                    <option value="<?php echo $id;?>" <?php selected( $this->templateID, $id );?>><?php echo $name;?></option>
                                <?php
                            }
                            ?>
                            <optgroup label="----------------"></optgroup>
                            <option value="">+ <?php echo __( 'new template', 'cosmotheme' );?></option>
                        </select>
                    </div>
                <?php
                    }
                ?>
            </div>
        <?php } ?>
    </div>
    <div class="feedback"></div>
</div>