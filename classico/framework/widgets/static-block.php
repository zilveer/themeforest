<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Static block Widget
// **********************************************************************// 
class Etheme_StatickBlock_Widget extends WP_Widget {

    function Etheme_StatickBlock_Widget() {
        $widget_ops = array('classname' => 'etheme_widget_satick_block', 'description' => __( "Insert static block, that you created", ET_DOMAIN) );
        parent::__construct('etheme-static-block', '8theme - '.__('Statick Block', ET_DOMAIN), $widget_ops);
        $this->alt_option_name = 'etheme_widget_satick_block';
    }

    function widget($args, $instance) {
        extract($args);

        $block_id = $instance['block_id'];
        
        et_show_block($block_id);

        //Check if Ultimate Addons for VC using here.
        if ( etheme_get_option('ult_style') && ( stripos( et_get_block($block_id), 'ult-adjust') || stripos( et_get_block($block_id), 'ult-animation') || stripos( et_get_block($block_id), 'ult_tabs') || stripos( et_get_block($block_id), 'ult-just') || stripos( et_get_block($block_id), 'Info-box-wrap') ) ) {
            etheme_enqueue_ultimate_scripts();
        }
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['block_id'] = $new_instance['block_id'];

        return $instance;
    }

    function form( $instance ) {
        $block_id = 0;
        if(!empty($instance['block_id']))
            $block_id = esc_attr($instance['block_id']);

?>
        <p><label for="<?php echo $this->get_field_id('block_id'); ?>"><?php _e('Block name:', ET_DOMAIN); ?></label>
            <?php $sb = et_get_static_blocks(); ?>
            <select name="<?php echo $this->get_field_name('block_id'); ?>" id="<?php echo $this->get_field_id('block_id'); ?>">
                <option>--Select--</option>
                <?php if (count($sb > 0)): ?>
                    <?php foreach ($sb as $key): ?>
                        <option value="<?php echo $key['value']; ?>" <?php selected( $block_id, $key['value'] ); ?>><?php echo $key['label'] ?></option>
                    <?php endforeach ?>
                <?php endif ?>
            </select>
        </p>
<?php
    }
}


