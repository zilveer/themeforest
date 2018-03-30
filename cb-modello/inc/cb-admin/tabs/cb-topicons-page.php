<?php
/**
 * Created by PhpStorm.
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:53
 */
add_action('wp_ajax_nopriv_save_cb_topicons', 'save_cb_topicons');
add_action('wp_ajax_save_cb_topicons', 'save_cb_topicons');


function save_cb_topicons()
{
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';


    update_option('cb5_headings_icons_size', esc_attr($data['cb5_headings_icons_size']));
    update_option('cb5_iconspos', esc_attr($data['cb5_iconspos']));
    update_option('cb5_icons_bottom_margin', esc_attr($data['cb5_icons_bottom_margin']));
    update_option('cb5_footer_icon', esc_attr($data['cb5_footer_icon']));



    $headins_icons_array = array();
    if( isset( $data['icons_name'] ) && is_array( $data['icons_name'] ) && !empty($data['icons_name'])) {
        $icons_name=$data['icons_name'];
        $icons_link=$data['icons_link'];
        $icons_val=$data['icons_val'];
        for($i=0;$i<sizeof($icons_name);$i++) {
            $headins_icons_array[$i]['icon'] = $icons_val[$i];
            $headins_icons_array[$i]['link'] = $icons_link[$i];
            $headins_icons_array[$i]['name'] = $icons_name[$i];
           // $headins_icons_array[$i]['color'] = $icons_color[$i];
        }


    }

    update_option('cb5_headings_icons', serialize($headins_icons_array));

    //update_option('cb5_footer_icon', '');
    //update_option('cb5_headings_icons', '');
    $response = '3';
    die($response);
}

function show_cb_topicons_page()
{
    ?>
<h3>Global Top Icons</h3>
<div class="tab_desc">Navigation icons that you can see in the header area</div>
    
    <form method="post" class="cb-admin-form">



    <!-- TOP ICON SECTION START ##-->

    <div class="pd5" style="border-top:none;display:none!important;">
        <label for="font-size">Icons size</label><input type="text" id="top-icon-font-size"
                                                    value="<?php if (get_option('cb5_headings_icons_size') == '') echo '20'; else echo get_option('cb5_headings_icons_size') ?>"
                                                    name="cb5_headings_icons_size">
    </div>
    <div class="pd5" style="border-top:none;">
        <ul class="sortable" style="width:100%;" id="sortable_icons">
            <?php
            $headings_icons=unserialize(get_option('cb5_headings_icons'));

            if (isset($headings_icons) && is_array($headings_icons) && !empty($headings_icons)) {
                for ($i = 0; $i < sizeof($headings_icons); $i++) {
                    ?> <?php if (!isset($headings_icons[$i]['color'])) $headings_icons[$i]['color'] = ''; ?>
                    <li class="ui-state-default">
                        <div class="icons-content">
                            <a href="javascript:CBFontAwesome.showEditor('cb-sor-top-icon-<?php echo($i + 1); ?>');CBFontAwesome.setSize(18,true);CBFontAwesome.hideLast();CBFontAwesome.hideAni();">
                                <span id="cb-sor-top-icon-<?php echo($i + 1); ?>">
				<?php echo '<span class="res-icon">'.(($headings_icons[$i]['icon']!='')?htmlspecialchars_decode(stripslashes($headings_icons[$i]['icon'])):'<span
                                    style="color:#999;font-size:10px;font-style:italic;cursor:pointer;">set icon</span>' ).'</span>'; ?>
				</span></a><input
                                type="text" name="icons_name[]"
                                value="<?php echo $headings_icons[$i]['name']; ?>" placeholder="set title"><input
                                type="text" name="icons_link[]"
                                value="<?php  echo $headings_icons[$i]['link']; ?>" placeholder="set url"><textarea
                                style="display: none;" name="icons_val[]" id="cb-sor-top-icon-<?php echo($i + 1); ?>-val"><?php echo stripslashes($headings_icons[$i]['icon']); ?></textarea><input type="hidden"
                                                                                          name="icons_color[]"
                                                                                          id="cb-sor-top-icon-<?php echo($i + 1); ?>-color"
                                                                                          value="<?php if ($headings_icons[$i]['color'] == '') echo ''; else echo $headings_icons[$i]['color']; ?>">
                            <div class="clear"></div>
                        </div>

                    </li>
                <?php
                }
            } else {
                ?>
                <li class="ui-state-default">
                    <div class="icons-content">
                        <a href="javascript:CBFontAwesome.showEditor('cb-sor-top-icon-1');CBFontAwesome.setSize(18,true);CBFontAwesome.hideLast();CBFontAwesome.hideAni();" >
                       <span id="cb-sor-top-icon-1"><span
                                    style="color:#999;font-size:10px;font-style:italic;cursor:pointer;">set icon</span></span></a><input
                            type="text" name="icons_name[]" placeholder="set title"><input type="text" name="icons_link[]" placeholder="set url">
                        <textarea
                            style="display: none;" name="icons_val[]" id="cb-sor-top-icon-1-val"></textarea><input
                            type="hidden" name="icons_color[]" id="cb-sor-top-icon-1-color">
                    <div class="clear"></div></div>
                </li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
        <span class="button" onclick="add_item();">Add item</span>
        <span class="button" onclick="remove_last();">Remove last</span>
        <input type="hidden" id="selected-id-builder">
    </div>





    <div class="pd5" style="display:none!important;">
        <?php generate_select(__('Icons position', 'cb-modello'),get_option('cb5_iconspos'), array(
            array('top', __('top', 'cb-modello')),
            array('bottom', __('bottom', 'cb-modello'))), 'cb5_iconspos');?>
    </div>

    <div class="pd5" style="display:none!important;"><label for="cb5_icons_bottom_margin"><?php _e('Icons bottom margin', 'cb-modello'); ?></label>
        <input name="cb5_icons_bottom_margin" type="text" id="cb5_icons_bottom_margin"
               value="<?php echo get_option('cb5_icons_bottom_margin'); ?>"/></div>



    <!-- ## TOP ICON SECTION END ##-->
<div class="pd5-reset">
        <h3><?php _e('Global Footer Icon','cb-modello'); ?></h3>
        <div class="tab_desc pb0"><?php _e('Icon for the footer','cb-modello'); ?></div>
</div>

    <div class="pd5">
       <?php
        $tdt=esc_attr__( 'Set Icon', 'framework' );
        $tdt_del=esc_attr__( 'Remove Icon', 'framework' );
        ?>

            <a href="javascript:CBFontAwesome.showEditor('cb5_footer_icon');CBFontAwesome.setSize(30,true);CBFontAwesome.hideLast();CBFontAwesome.hideAni();" class="sicon" >
				<span id="cb5_footer_icon">
				<?php if (get_option('cb5_footer_icon')!=''){ echo '<span class="res-icon">'.htmlspecialchars_decode(stripslashes(get_option('cb5_footer_icon'))).'</span>';} ?>
				</span>
                <button type="button" class="button set-icon"><?php echo $tdt;?></button></a>
            <a class="remo">
                <button type="button" class="button rem-icon"><?php echo $tdt_del;?></button></a>
            <textarea id="cb5_footer_icon-val" name="cb5_footer_icon" style="display: none" class="hide-icon"><?php echo stripslashes(get_option('cb5_footer_icon')); ?></textarea>
        <div style="clear:both"></div>
    </div>


                <?php
                require_once(TEMPLATEPATH.'/inc/cb-lib/icons.php');
                ?>




    <input type="hidden" name="tab" class="cb-tab" value="cb-topicons-page"/>
    <input type="hidden" name="action" value="save_cb_topicons"/>
    <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>"/>

    <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello'); ?>" class="cb-save"></div>
    </form>
<?php
}