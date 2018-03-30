<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="1" name="tmm_meta_saving" />

<table class="form-table staff-postbox">
    <tbody>
        <tr>
            <th>
                <label for="email">
                    <strong><?php _e('Email', 'diplomat'); ?></strong>
                    <span></span>
                </label>
            </th>
            <td>
                <input type="text" size="30" value="<?php echo $email ?>" id="email" name="email">
            </td>
        </tr>

		<tr>
            <th>
                <label for="twitter">
                    <strong><?php _e('Twitter', 'diplomat'); ?></strong>
                    <span></span>
                </label>
            </th>
            <td>
                <input type="text" size="30" value="<?php echo $twitter ?>" id="twitter" name="twitter">
            </td>
        </tr>

        <tr>
            <th>
                <label for="facebook">
                    <strong><?php _e('Facebook', 'diplomat'); ?></strong>
                    <span></span>
                </label>
            </th>
            <td>
                <input type="text" size="30" value="<?php echo $facebook ?>" id="facebook" name="facebook">
            </td>
        </tr>
        
        <tr>
            <th>
                <label for="linkedin">
                    <strong><?php _e('Linkedin', 'diplomat'); ?></strong>
                    <span></span>
                </label>
            </th>
            <td>
                <input type="text" size="30" value="<?php echo $linkedin ?>" id="linkedin" name="linkedin">
            </td>
        </tr>
        
        <tr>
            <th>
                <label for="instagram">
                    <strong><?php _e('Instagram', 'diplomat'); ?></strong>
                    <span></span>
                </label>
            </th>
            <td>
                <input type="text" size="30" value="<?php echo $instagram ?>" id="instagram" name="instagram">
            </td>
        </tr>

		<tr>
            <th>
                <label for="dribble">
                    <strong><?php _e('Dribbble', 'diplomat'); ?></strong>
                    <span></span>
                </label>
            </th>
            <td>
                <input type="text" size="30" value="<?php echo $dribble ?>" id="dribble" name="dribble">
            </td>
        </tr>

		<tr>
            <th>
                <label for="skype">
                    <strong><?php _e('Skype', 'diplomat'); ?></strong>
                    <span></span>
                </label>
            </th>
            <td>
                <input type="text" size="30" value="<?php echo $skype ?>" id="skype" name="skype">
            </td>
        </tr>

		<tr>
            <th>
                <label for="cv">
                    <strong><?php _e('CV', 'diplomat'); ?></strong>
                    <span></span>
                </label>
            </th>
            <td>
                <input type="text" size="30" value="<?php echo $cv ?>" id="cv" name="cv">
            </td>
        </tr>


    </tbody>
</table>
