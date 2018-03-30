 <!-- Mainpage Options -->
<table class="widefat option-table" cellspacing="0">
    <tbody>
        <tr valign="top" class="grouped alternate">
          <th>Widget Buttons<div class="description"><?php _e('Set the URLs and the texts for the 3 different button in the widget areas. If you do not need a button, just leave the URL input field empty.', 'stylico'); ?></div></th>
          <td style="vertical-align:bottom;">URL</td>
          <td style="vertical-align:bottom;">Text</td>
        </tr>
        <tr valign="top" class="sub-options grouped alternate">
          <th scope="row"><?php _e('Button in the left widget', 'stylico'); ?></th>
          <td><input type="text" name="mainpage_widget_left_url" value="<?php echo $stylico_mainpage_options['widget_left_url']; ?>" class="widefat"/></td>
          <td><input type="text" name="mainpage_widget_left_button_text" value="<?php echo $stylico_mainpage_options['widget_left_button_text']; ?>" class="widefat"/></td>
        </tr>
        <tr valign="top" class="sub-options grouped alternate">
          <th scope="row"><?php _e('Button in the centered widget', 'stylico'); ?></th>
          <td><input type="text" name="mainpage_widget_center_url" value="<?php echo $stylico_mainpage_options['widget_center_url']; ?>" class="widefat"/></td>
          <td><input type="text" name="mainpage_widget_center_button_text" value="<?php echo $stylico_mainpage_options['widget_center_button_text']; ?>" class="widefat"/></td>
        </tr>
        <tr valign="top" class="sub-options alternate">
          <th scope="row"><?php _e('Button in the right widget', 'stylico'); ?></th>
          <td><input type="text" name="mainpage_widget_right_url" value="<?php echo $stylico_mainpage_options['widget_right_url']; ?>" class="widefat"/></td>
          <td><input type="text" name="mainpage_widget_right_button_text" value="<?php echo $stylico_mainpage_options['widget_right_button_text']; ?>" class="widefat"/></td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php _e('Bottom Page', 'stylico'); ?></th>
          <td colspan="2">
              <div class="description"><?php _e('Select a page you would like to use at the bottom of your home page!', 'stylico'); ?></div>
              <?php wp_dropdown_pages( array( 'selected' => $stylico_mainpage_options['bottom_page'], 'name' => 'mainpage_bottom_page') ); ?>
          </td>
        </tr>   
    </tbody>
</table>