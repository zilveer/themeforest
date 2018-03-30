<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="1" name="tmm_meta_saving" />

<table class="form-table">
    <tbody>
        <tr>
            <th style="width:25%">
                <label for="position">
                    <strong><?php _e('Position', 'cardealer'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $position ?>" id="position" name="position">
            </td>
        </tr>
    </tbody>
</table>
