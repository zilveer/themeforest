<?php
/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 14.02.14
 * Time: 23:17
 */
?>
<div id="cb-button-container" style="display: none;">
    <a class="close" href="javascript:CbButton.hideEditor();" title="close"><i class="fa fa-times"></i></a>
    <div class="wrap" style="padding: 1em">
        <div class="aq_desc inp_larger first">
            <label for="tip">Button text</label><input id="button_text" type="text"
                                                       value=""  style="" placeholder="Add text here">
        </div>
        <div class="aq_desc inp_larger">
            <label for="tip">Button link</label><input id="button_link" type="text"
                                                       value=""  style="" placeholder="Add url here">
        </div>
        <?php
        $target = array('_blank','_self','_parent','_top');
        $align = array('left','center','right');
        $button_bg=array(''=>'none','white'=>'white','blue'=>'blue','black'=>'black','green'=>'green','red'=>'red','red'=>'red');
        $button_ani_o=array(''=>'none','border_outer'=>'border outer','border_outer2'=>'border outer 2','background_inner'=>'background inner',
            'background_outer'=>'background outer','flip_left'=>'flip left','flip_top'=>'flip top','rotate'=>'rotate');

        ?>
        <div class="aq_desc first">
            <label for="button_target">Button target</label>
            <select name="button_target" id="button_target">
                <?php foreach($target as $key){
                    echo '<option value="'.$key.'">'.$key.'</option>';
                } ?>
            </select>

            <div class="clear"></div>
        </div>
        <div class="aq_desc first">
            <label for="button_bg">Button background</label>
            <select name="button_bg" id="button_bg">
                <?php foreach($button_bg as $key => $value){
                    echo '<option value="'.$key.'">'.$value.'</option>';
                } ?>
            </select>

            <div class="clear"></div>
        </div>
        <div class="aq_desc first">
            <label for="button_ani_select">Button animation </label>
            <select name="button_ani_select" id="button_ani_select">
                <?php foreach($button_ani_o as $button_ani_o_single => $button_ani_o_single_v){
                    echo '<option value="'.$button_ani_o_single.'">'.$button_ani_o_single_v.'</option>';
                } ?>
            </select>

            <div class="clear"></div>
        </div>
        <div class="aq_desc first">
            <label for="button_align">Button align</label>
            <select name="button_align" id="button_align">
                <?php foreach($align as $key){
                    echo '<option value="'.$key.'">'.$key.'</option>';
                } ?>
            </select>

            <div class="clear"></div>
        </div>
        <a class="save" onclick="CbButton.save();return false;"  title="insert"> <button type="button" class="button button-primary cb_button_save ">Insert button</button></a>
    </div>
</div>
<div id="cb-button-backdrop" style="display: none;"></div>
