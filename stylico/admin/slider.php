<!-- Slider Options -->
<table class="widefat option-table" cellspacing="0">
    <tbody>
        <tr valign="top" class="alternate">
          <th scope="row">Slide Animation</th>
          <td>
              <select name="orbit_slider_animation" value="<?php echo $stylico_slider_options['animation']; ?>">
                  <option value="fade" <?php selected( $stylico_slider_options['animation'], 'fade' ); ?>>Fade</option>
                  <option value="horizontal-slide" <?php selected( $stylico_slider_options['animation'], 'horizontal-slide' ); ?>>Horizontal Slide</option>
                  <option value="vertical-slide" <?php selected( $stylico_slider_options['animation'], 'vertical-slide' ); ?>>Vertical Slide</option>
                  <option value="horizontal-push" <?php selected( $stylico_slider_options['animation'], 'horizontal-push' ); ?>>Horizontal Push</option>
              </select>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php _e('Caption Animation', 'stylico'); ?></th>
          <td>
              <select name="orbit_slider_caption_animation" value="<?php echo $stylico_slider_options['caption_animation']; ?>">
                  <option value="fade" <?php selected( $stylico_slider_options['caption_animation'], 'fade' ); ?>>Fade</option>
                  <option value="slideOpen" <?php selected( $stylico_slider_options['caption_animation'], 'slideOpen' ); ?>>Slide Open</option>
                  <option value="none" <?php selected( $stylico_slider_options['caption_animation'], 'none' ); ?>>None</option>
              </select>
          </td>
        </tr>
        <tr valign="top" class="alternate">
          <th scope="row"><?php _e('Slide Animation Speed', 'stylico'); ?></th>
          <td><input type="text" name="orbit_slider_animation_speed" value="<?php echo $stylico_slider_options['animation_speed']; ?>"/> <?php _e('milliseconds', 'stylico'); ?></td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php _e('Caption Animation Speed', 'stylico'); ?></th>
          <td><input type="text" name="orbit_slider_caption_animation_speed" value="<?php echo $stylico_slider_options['caption_animation_speed']; ?>"/> <?php _e('milliseconds', 'stylico'); ?></td>
        </tr>
        <tr valign="top" class="alternate">
          <th scope="row"><?php _e('Time between slides', 'stylico'); ?></th>
          <td><input type="text" name="orbit_slider_advance_speed" value="<?php echo $stylico_slider_options['advance_speed']; ?>"/> <?php _e('milliseconds', 'stylico'); ?><span class="description"><?php _e('Will only be used when timer is enabled!', 'stylico'); ?></span></td>
        </tr>
        <tr valign="top">
          <th scope="row">Timer</th>
          <td><input type="checkbox" name="orbit_slider_timer" value="1" <?php checked( $stylico_slider_options['timer'], 1 ); ?> class="widefat"/></td>
        </tr>
        <tr valign="top" class="alternate">
          <th scope="row"><?php _e('Pause on Hover', 'stylico'); ?></th>
          <td><input type="checkbox" name="orbit_slider_pause_hover" value="1" <?php checked( $stylico_slider_options['pause_hover'], 1 ); ?> class="widefat"/><span class="description"><?php _e('Will only be used when timer is enabled!', 'stylico'); ?></span></td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php _e('Start Clock on Mouseout', 'stylico'); ?></th>
          <td><input type="checkbox" name="orbit_slider_clock_mouseout" value="1" <?php checked( $stylico_slider_options['clock_mouseout'], 1 ); ?> class="widefat"/><span class="description"><?php _e('Will only be used when timer is enabled!', 'stylico'); ?></span></td>
        </tr> 
    </tbody>
</table>