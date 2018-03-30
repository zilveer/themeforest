<div id="tfuse_fields" class="tfuse_shortcode_page">
    <form style="display:none" action="<?php echo TFUSE_EXT_URI . '/shortcodes/views/preview_shortcode.php'; ?>" method="post" target="tf_shortcode_preview_iframe" id="tf_shc_form">
        <input id="tf_shc_form_value" type="hidden" name="preview_shortcode" value="" />
        <input id="tf_shc_form_type" type="hidden" name="preview_shortcode_type" value="" />
        <input id="tf_shc_form_post_id" type="hidden" name="preview_shortcode_post_id" value="<?php echo $_POST['post_id']; ?>" />
    </form>
    <div id="tf_shortcode_controls">
        <div id="tf_shortcode_control_buttons">
            <a id="tf_shortcode_back" href="#" class="tf_ctrl_button"><img border="0" src="<?php echo tf_extimage('SHORTCODES', 'back_button.png'); ?>"/></a>
            <a id="tf_shortcode_insert" href="#" class="tf_ctrl_button"><img border="0" src="<?php echo tf_extimage('SHORTCODES', 'add_shortcode_button.png'); ?>"/></a>
        </div>
        <div id="tf_shortcode_control_filters">
            <div class="tf_shc_category_filter">
                <strong><?php _e('Categories', 'tfuse') ?></strong> <?php echo $this->optigen->_auto($category_option); ?>
            </div>
            <div class="tf_shc_name_filter">
                <strong><?php _e('Filter', 'tfuse') ?></strong> <?php echo $this->optigen->_auto($filter_option); ?>
            </div>
        </div>
    </div>
    <div id="tf_shortcode_list">
        <?php
        foreach ($shortcodes as $sh_type => $shortcode) {
            $atts = &$shortcode['atts'];
            ?>
            <div preview="<?php echo tf_config_extimage($ext_name, 'static/images/' . $sh_type . '.jpg'); ?>" class="tf_shortcode_element"  rel="<?php echo $sh_type; ?>" category="<?php echo $atts['category']; ?>">
                <?php if (count($atts['options']) == 0) { ?>
                    <input type="hidden" class="instant_shc" value="<?php echo htmlentities($shortcode['function'](NULL, NULL)); ?>"/>
                <?php } ?>
                <img title="<?php echo $atts['name'];?>" class="shc_icon" src="<?php echo tf_config_extimage($ext_name, $sh_type . '.jpg'); ?>" />
                <h3><?php echo $atts['name']; ?></h3>
                <div class="description">   
                    <?php echo $atts['desc']; ?>
                </div>
            </div>
            <?php
            unset($atts);
        }
        ?>
        <div style="clear:both"></div>
    </div>
    <div id="tf_shortcode_options">
        <div class="tf_shortcode_preview_container">
            <div class="tf_shortcode_element_header">
                <h2><?php _e('Shortcode Preview', 'tfuse'); ?></h2>
                <span class="description"><?php _e('Live preview of your shortcode', 'tfuse'); ?></span>
            </div>
            <div class="tf_shortcode_preview_div">
                <iframe name="tf_shortcode_preview_iframe" id="tf_shortcode_preview_iframe"></iframe>
            </div>
        </div>
        <div class="tf_shortcode_options_container">
            <div class="tf_shortcode_element_header">
                <h2><?php _e('Shortcode Settings', 'tfuse'); ?></h2>
                <span class="description"><?php _e('Edit settings below before adding the shortcode', 'tfuse'); ?></span>
            </div>
            <?php
            foreach ($shortcodes as $sh_type => $shortcode) {
                ?>
                <div class="tf_shortcode_option" rel="<?php echo $sh_type; ?>">
                    <?php
                    foreach ($shortcode['atts']['options'] as $option) {
                        echo $this->ext->shortcodes->meta_box_row_shortcodes($option);
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>