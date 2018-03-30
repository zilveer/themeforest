<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php $uniqid = uniqid(); ?>
<a class="delete_item_from_data_group remove-button close-drag-holder" href="#"></a>
<div class="option">
    <h4>
        <?php _e("Name", 'cardealer') ?>: 
    </h4>

    <div class="controls">
        <input type="text" placeholder="Type item name here" value="<?php echo(isset($itemdata['name']) ? $itemdata['name'] : "") ?>" name="data_groups[<?php echo $data_group_index ?>][data][<?php echo $uniqid ?>][name]" />
    </div>
    <div class="explain"><?php _e('Enter Item Name', 'cardealer') ?></div>
</div>

<div class="option">
    <h4><?php _e("Item Type", 'cardealer') ?>:&nbsp;</h4>

    <div class="controls">
        <label class="sel">
            <select name="data_groups[<?php echo $data_group_index ?>][data][<?php echo $uniqid ?>][type]" class="data_group_item_select">
<!--                     <option --><?php //echo(isset($itemdata['type']) ? ($itemdata['type'] == 'textinput' ? "selected" : "") : "") ?><!-- value="textinput">--><?php //_e("Textinput", 'cardealer') ?><!--</option> -->
                <option <?php echo(isset($itemdata['type']) ? ($itemdata['type'] == 'checkbox' ? "selected" : "") : "") ?> value="checkbox"><?php _e("Checkbox", 'cardealer') ?></option>
                <option <?php echo(isset($itemdata['type']) ? ($itemdata['type'] == 'select' ? "selected" : "") : "") ?> value="select"><?php _e("Select", 'cardealer') ?></option>
            </select>
        </label>
    </div>
     <div class="explain"><?php _e('Choose Item Type', 'cardealer') ?></div>

</div>

<div class="data_group_item_html">

    <div class="data_group_item_template_textinput data_group_input_type" style="display: <?php echo(isset($itemdata['type']) ? ($itemdata['type'] == 'textinput' ? "block" : "none") : "none") ?>">
        <input type="text" value="<?php echo(isset($itemdata['textinput']) ? $itemdata['textinput'] : "") ?>" name="data_groups[<?php echo $data_group_index ?>][data][<?php echo $uniqid ?>][textinput]" />
    </div>
    <div class="data_group_item_template_checkbox data_group_input_type" style="display: <?php echo(isset($itemdata) ? ($itemdata['type'] == 'checkbox' ? "block" : "none") : "none") ?>;">
        <input type="hidden" value="<?php echo(isset($itemdata['checkbox']) ? $itemdata['checkbox'] : 0) ?>" name="data_groups[<?php echo $data_group_index ?>][data][<?php echo $uniqid ?>][checkbox]" />
        <input style="display: none" type="checkbox" <?php echo(isset($itemdata['checkbox']) ? ($itemdata['checkbox'] ? "checked" : "") : "") ?> class="option_checkbox" />
    </div>
    <div class="data_group_item_template_select data_group_input_type" style="display: <?php echo(isset($itemdata) ? ($itemdata['type'] == 'select' ? "block" : "none") : "none") ?>;">
        <a href="#" class="add_option_to_data_item_select" data-group-index="<?php echo $data_group_index ?>" data-group-item-index="<?php echo $uniqid ?>"><?php _e("Add select option", 'cardealer') ?></a>
        <ul class="data_item_select_options option">
            <?php if (isset($itemdata)): ?>
                <?php if (!empty($itemdata['select'])): ?>
                    <?php foreach ($itemdata['select'] as $value) : ?>
                        <li><input type="text" name="data_groups[<?php echo $data_group_index ?>][data][<?php echo $uniqid ?>][select][]" value="<?php echo $value ?>">&nbsp;<a class="delete_option_from_data_item_select remove-button" href="#"></a><br></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
        </ul>
    </div>

    <h4><?php _e("Item Description", 'cardealer') ?>:</h4>

    <textarea name="data_groups[<?php echo $data_group_index ?>][data][<?php echo $uniqid ?>][description]"><?php echo(isset($itemdata['description']) ? $itemdata['description'] : "") ?></textarea>

</div>

