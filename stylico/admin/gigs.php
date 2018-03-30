<!-- Gigs Options -->
<table class="widefat option-table" cellspacing="0">
    <tbody>
        <tr valign="top" class="alternate">
          <th scope="row">Website Link Text</th>
          <td><input type="text" name="gigs_website_link_title" value="<?php echo $stylico_gigs_options['website_link_title']; ?>" class="widefat"/></td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php _e('Image Link Text', 'stylico'); ?></th>
          <td><input type="text" name="gigs_image_link_title" value="<?php echo $stylico_gigs_options['image_link_title']; ?>" class="widefat"/></td>
        </tr>
        <tr valign="top" class="alternate">
          <th scope="row"><?php _e('Show only upcoming Gigs', 'stylico'); ?></th>
          <td><input type="checkbox" name="gigs_only_upcoming" value="1" <?php checked( $stylico_gigs_options['only_upcoming'], 1 ); ?> class="widefat"/></td>
        </tr> 
    </tbody>
</table>