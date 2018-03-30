<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="1" name="tmm_meta_saving" />

<table class="form-table">
    <tbody>
        <tr>
            <th style="width:25%">
                <label for="staff_email">
                    <strong><?php _e('Email', 'cardealer'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $staff_email ?>" id="staff_email" name="staff_email">
            </td>
        </tr>

        <tr>
            <th style="width:25%">
                <label for="office_phone">
                    <strong><?php _e('Office phone', 'cardealer'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $office_phone ?>" id="office_phone" name="office_phone">
            </td>
        </tr>

        <tr>
            <th style="width:25%">
                <label for="mobile_phone">
                    <strong><?php _e('Mobile phone', 'cardealer'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $mobile_phone ?>" id="mobile_phone" name="mobile_phone">
            </td>
        </tr>

        <tr>
            <th style="width:25%">
                <label for="fax">
                    <strong><?php _e('Fax', 'cardealer'); ?></strong>
                    <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
                </label>
            </th>
            <td>
                <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $fax ?>" id="fax" name="fax">
            </td>
        </tr>

        <tr>
	        <th style="width:25%">
		        <label for="facebook">
			        <strong><?php _e('Facebook', 'cardealer'); ?></strong>
			        <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
		        </label>
	        </th>
	        <td>
		        <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $facebook ?>" id="facebook" name="facebook">
	        </td>
        </tr>

        <tr>
	        <th style="width:25%">
		        <label for="twitter">
			        <strong><?php _e('Twitter', 'cardealer'); ?></strong>
			        <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
		        </label>
	        </th>
	        <td>
		        <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $twitter ?>" id="twitter" name="twitter">
	        </td>
        </tr>

        <tr>
	        <th style="width:25%">
		        <label for="gplus">
			        <strong><?php _e('Google+', 'cardealer'); ?></strong>
			        <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
		        </label>
	        </th>
	        <td>
		        <input type="text" style="width:75%; margin-right: 20px; float:left;" size="30" value="<?php echo $gplus ?>" id="gplus" name="gplus">
	        </td>
        </tr>

        <tr>
	        <th style="width:25%">
		        <label for="desc">
			        <strong><?php _e('Description', 'cardealer'); ?></strong>
			        <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;"></span>
		        </label>
	        </th>
	        <td>
		        <textarea style="width:75%; margin-right: 20px; float:left;" size="30" id="desc" name="desc"><?php echo $desc ?></textarea>
	        </td>
        </tr>

    </tbody>
	
</table>
