<!-- General Options -->
<table class="widefat option-table" cellspacing="0">
    <tbody>
        <tr valign="top" class="alternate">
          <th scope="row">Logo<div class="description"><?php _e('The logo need to have a maximum size of 220x100px!', 'stylico'); ?></div></th>
          <td>  
              <label for="general_logo"><?php _e('Upload' , 'stylico'); ?></label><input type="text" id="logo-upload" name="general_logo" value="<?php echo $stylico_general_options['logo']; ?>" class="widefat"  /><br /><br />
              <label for="general_logo_top"><?php _e('Top Offset:', 'stylico'); ?></label> <input type="text" name="general_logo_top" value="<?php echo $stylico_general_options['logo_top']; ?>" size="2"  /> <span>pixels</span>
          </td>
        </tr>
        <tr valign="top" class="grouped">
          <th>Header Socials</th>
          <td><div class="description"><?php _e('Set your social links. If you do not need one, just leave the input field empty.', 'stylico'); ?></div></td>
        </tr>
        <tr valign="top" class="sub-options grouped">
          <th scope="row">Facebook URL</th>
          <td><input type="text" name="general_facebook" value="<?php echo $stylico_general_options['facebook_url']; ?>" class="widefat"/></td>
        </tr>
        <tr valign="top" class="sub-options grouped">
          <th scope="row">Twitter URL</th>
          <td><input type="text" name="general_twitter" value="<?php echo $stylico_general_options['twitter_url']; ?>" class="widefat"/></td>
        </tr>
        <tr valign="top" class="sub-options">
          <th scope="row">Email Address</th>
          <td><input type="text" name="general_mail_address" value="<?php echo $stylico_general_options['mail_address']; ?>" class="widefat"/></td>
        </tr>
        <tr valign="top" class="alternate">
          <th scope="row"><?php _e('Footer Text', 'stylico'); ?><div class="description"><?php _e('You can use HTML tags.', 'stylico'); ?></div></th>
          <td><textarea name="general_footer_text"><?php echo stripslashes( $stylico_general_options['footer_text'] ); ?></textarea></td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php _e('404 Page', 'stylico'); ?><div class="description"><?php _e('Select a page for the 404 page. This will be shown when a user is looking for a site that does not exist!', 'stylico'); ?></div></th>
          <td>
              
              <?php wp_dropdown_pages( array( 'selected' => $stylico_general_options['page_404'], 'name' => 'general_page_404') ); ?>
          </td>
        </tr>   
    </tbody>
</table>