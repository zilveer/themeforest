<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="1" name="tmm_meta_saving" />

<table class="form-table testim-postbox">
    <tbody>
        <tr>
            <th>
                <label for="position">
                    <strong><?php esc_html_e('Position', 'diplomat'); ?></strong>
                    <span></span>
                </label>
            </th>
            <td>
                <input type="text" size="30" value="<?php echo esc_attr($position); ?>" id="position" name="position">
            </td>
        </tr>
    </tbody>
</table>
