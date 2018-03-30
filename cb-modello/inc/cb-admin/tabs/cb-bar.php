<?php
/**
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:51
 */
add_action('wp_ajax_nopriv_save_cb_bar', 'save_cb_bar');
add_action('wp_ajax_save_cb_bar', 'save_cb_bar');


function save_cb_bar()
{
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';

    update_option('cb5_show_bar', esc_attr($data['cb5_show_bar']));
    update_option('cb5_bar_background', esc_attr($data['cb5_bar_background']));

    update_option('cb5_bar_facebook', esc_attr($data['cb5_bar_facebook']));
    update_option('cb5_bar_twitter', esc_attr($data['cb5_bar_twitter']));
    update_option('cb5_bar_youtube', esc_attr($data['cb5_bar_youtube']));
    update_option('cb5_bar_gplus', esc_attr($data['cb5_bar_gplus']));
    update_option('cb5_bar_istagram', esc_attr($data['cb5_bar_istagram']));
    update_option('cb5_bar_dribble', esc_attr($data['cb5_bar_dribble']));
    update_option('cb5_bar_linkedin', esc_attr($data['cb5_bar_linkedin']));

    update_option('cb5_bar_messages', $data['bar_messages']);
    update_option('cb5_bar_left', esc_attr($data['cb5_bar_left']));
    update_option('cb5_bar_center', esc_attr($data['cb5_bar_center']));
    update_option('cb5_bar_center2', esc_attr($data['cb5_bar_center2']));
    update_option('cb5_bar_right', esc_attr($data['cb5_bar_right']));
    update_option('cb5_bar_wigets', esc_attr($data['cb5_bar_wigets']));
    update_option('cb5_bar_wigets2', esc_attr($data['cb5_bar_wigets2']));



    die($response);

}

function show_cb_bar_page()
{
    ?>
    <h3>Notification Bar</h3>
    <div class="tab_desc">Enable and customise Notification Bar</div>

    <!-- API SECTION START -->
    <form method="post" class="cb-admin-form">


        <div class="pd5">
            <?php generate_check(__('Show Notification Bar?', 'cb-modello'), get_option('cb5_show_bar'), 'cb5_show_bar'); ?>

        </div>
        <?php
        $bg_color=array('black'=>'black','white'=>'white','blue'=>'blue','green'=>'green','red'=>'red','red'=>'red');
        ?>

        <div class="pd5" style="display:none;">
            <label for="cb5_bar_background"><?php _e('Bsckground color','cb-modello'); ?></label>
            <select name="cb5_bar_background" id="cb5_bar_background">
                <?php foreach($bg_color as $icon_ani_color_after_single => $icon_ani_color_after_single_v){
                    echo '<option value="'.$icon_ani_color_after_single.'">'.$icon_ani_color_after_single_v.'</option>';
                } ?>
            </select>
        </div>

        <div class="pd5-reset">
            <h3><?php _e('Social icons','cb-modello'); ?></h3>
            <div class="tab_desc pb0"><?php _e('Set links to social sites.','cb-modello'); ?></div>
        </div>
        <div class="pd5">
            <label for="cb5_bar_facebook" title="Facebook"><i class="bar-icon fa fa-facebook"></i>
            </label>
            <input type="text" name="cb5_bar_facebook" id="cb5_bar_facebook" value="<?php echo get_option('cb5_bar_facebook'); ?>" placeholder="set url"/>
        </div>
        <div class="pd5">
            <label for="cb5_bar_twitter" title="Twitter"><i class="bar-icon fa fa-twitter"></i>
            </label>
            <input type="text" name="cb5_bar_twitter" id="cb5_bar_twitter" value="<?php echo get_option('cb5_bar_twitter'); ?>" placeholder="set url"/>
        </div>
        <div class="pd5">
            <label for="cb5_bar_youtube" title="YouTube"><i class="bar-icon fa fa-youtube"></i>
            </label>
            <input type="text" name="cb5_bar_youtube" id="cb5_bar_youtube" value="<?php echo get_option('cb5_bar_youtube'); ?>" placeholder="set url"/>
        </div>
        <div class="pd5">
            <label for="cb5_bar_dribble" title="Dribble"><i class="bar-icon fa fa-dribbble"></i>
            </label>
            <input type="text" name="cb5_bar_dribble" id="cb5_bar_dribble" value="<?php echo get_option('cb5_bar_dribble'); ?>" placeholder="set url"/>
        </div>
        <div class="pd5">
            <label for="cb5_bar_linkedin" title="Linkedin"><i class="bar-icon fa fa-linkedin"></i>
            </label>
            <input type="text" name="cb5_bar_linkedin" id="cb5_bar_linkedin" value="<?php echo get_option('cb5_bar_linkedin'); ?>" placeholder="set url"/>
        </div>
        <div class="pd5">
            <label for="cb5_bar_gplus" title="Google+">
               <i class="bar-icon fa fa-google-plus"></i>
            </label>
            <input type="text" name="cb5_bar_gplus" id="cb5_bar_gplus" value="<?php echo get_option('cb5_bar_gplus'); ?>" placeholder="set url"/>
        </div>
        <div class="pd5">
            <label for="cb5_bar_istagram" title="Istagram">
                <i class="bar-icon fa fa-instagram"></i>
            </label>
            <input type="text" name="cb5_bar_istagram" id="cb5_bar_istagram" value="<?php echo get_option('cb5_bar_istagram'); ?>" placeholder="set url"/>
        </div>


        <div class="pd5-reset">
            <h3><?php _e('Messages','cb-modello'); ?></h3>
            <div class="tab_desc pb0"><?php _e('Add messages to show in bar.','cb-modello'); ?></div>
        </div>
        <div class="pd5">
            <ul class="sortable" style="width:100%;" id="sortable_bar">
                <?php
                $bar_messages=get_option('cb5_bar_messages');

                if (isset($bar_messages) && is_array($bar_messages) && !empty($bar_messages)) {
                    for ($i = 0; $i < sizeof($bar_messages); $i++) {
                        ?>
                        <li class="ui-state-default">
                       <input
                                    type="text" name="bar_messages[]"
                                    value="<?php echo stripslashes(htmlspecialchars($bar_messages[$i])); ?>" placeholder="write here the message...">
                            <div class="clear"></div>
                        </li>
                    <?php
                    }
                } else {
                    ?>
                    <li class="ui-state-default">
                    <li class="ui-state-default">
                        <input
                            type="text" name="bar_messages[]"
                            value="" placeholder="write here the message...">
                        <div class="clear"></div>
                    </li>
                        <div class="clear"></div>
                    </li>
                <?php } ?>
            </ul>
            <div class="clear"></div>
            <span class="button" onclick="add_item2();">Add item</span>
            <span class="button" onclick="remove_last2();">Remove last</span>
        </div>
        <div class="pd5-reset">
            <h3><?php _e('Positions','cb-modello'); ?></h3>
            <div class="tab_desc pb0"><?php _e('Select what you want to show in blocks.','cb-modello'); ?></div>
        </div>
        <div class="pd5">
            <?php
            generate_select(__('Left side', 'cb-modello'),get_option('cb5_bar_left'), array(
                array('', __('None', 'cb-modello')),
                array('social', __('Social icons', 'cb-modello')),
                array('messages', __('Messages', 'cb-modello')),
                array('widget', __('Widgets Area 1', 'cb-modello')),
                array('widget2', __('Widgets Area 2', 'cb-modello'))), 'cb5_bar_left');?>
        </div>
        <div class="pd5">
            <?php
            generate_select(__('Center Left', 'cb-modello'),get_option('cb5_bar_center'), array(
                array('', __('None', 'cb-modello')),
                array('social', __('Social icons', 'cb-modello')),
                array('messages', __('Messages', 'cb-modello')),
                array('widget', __('Widgets Area 1', 'cb-modello')),
                array('widget2', __('Widgets Area 2', 'cb-modello'))), 'cb5_bar_center');?>
        </div>
        <div class="pd5">
            <?php
            generate_select(__('Center Right', 'cb-modello'),get_option('cb5_bar_center2'), array(
                array('', __('None', 'cb-modello')),
                array('social', __('Social icons', 'cb-modello')),
                array('messages', __('Messages', 'cb-modello')),
                array('widget', __('Widgets Area 1', 'cb-modello')),
                array('widget2', __('Widgets Area 2', 'cb-modello'))), 'cb5_bar_center2');?>
        </div>
        <div class="pd5">
            <?php
            echo generate_hint('If you want to show tweets select Widgets and add Twitter widget to this widget area.');
            generate_select(__('Right side', 'cb-modello'),get_option('cb5_bar_right'), array(
                array('', __('None', 'cb-modello')),
                array('social', __('Social icons', 'cb-modello')),
                array('messages', __('Messages', 'cb-modello')),
                array('widget', __('Widgets Area 1', 'cb-modello')),
                array('widget2', __('Widgets Area 2', 'cb-modello'))), 'cb5_bar_right');?>
        </div>
        <div class="pd5">
            <?php
            echo generate_hint('Select widget area if you want show in position.');
            global $wp_registered_sidebars;
            $sidebars = $wp_registered_sidebars;
               $bar_sidebars[] =array('',__('None', 'cb-modello'));
            if(is_array($sidebars) && !empty($sidebars)){
                foreach($sidebars as $sidebar){
                    $bar_sidebars[]=array($sidebar['id'],$sidebar['name']);
                }
            }
            generate_select(__('Select Widget Area 1', 'cb-modello'),get_option('cb5_bar_wigets'),$bar_sidebars, 'cb5_bar_wigets');
            ?>
        </div>
        <div class="pd5">
            <?php
            echo generate_hint('Select widget area if you want show in position.');
            global $wp_registered_sidebars;
            $sidebars = $wp_registered_sidebars;
               $bar_sidebars[] =array('',__('None', 'cb-modello'));
            if(is_array($sidebars) && !empty($sidebars)){
                foreach($sidebars as $sidebar){
                    $bar_sidebars[]=array($sidebar['id'],$sidebar['name']);
                }
            }
            generate_select(__('Select Widget Area 2', 'cb-modello'),get_option('cb5_bar_wigets2'),$bar_sidebars, 'cb5_bar_wigets2');
            ?>
        </div>

        <input type="hidden" name="tab" class="cb-tab" value="cb-bar"/>
        <input type="hidden" name="action" value="save_cb_bar"/>
        <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>"/>

        <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello'); ?>"
                                             class="cb-save"></div>
    </form>
<?php


}
