<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php
      $image    = wp_get_attachment_image(get_post_thumbnail_id(), 'large', null, array("class" => "the_photo"));
      $full     = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
      $imgmeta  = wp_get_attachment_metadata(get_post_thumbnail_id());
      $imgmeta  = $imgmeta['image_meta'];

      $show_exif = get_post_meta($post->post_parent, "show_exif", true);
      if(!isset($show_exif) || empty($show_exif)) {
        // default value
        $show_exif = false;
      }
      $allow_download = get_post_meta($post->post_parent, "allow_download", true);
      if(!isset($allow_download) || empty($allow_download)) {
        // default value
        $allow_download = false;
      }

      $hide_sidebar = get_theme_mod("t2t_hide_photo_sidebar", false);
      if($hide_sidebar === true) {
        $hide_sidebar = "true";
      }
      else {
        $hide_sidebar = "false";
      }
    ?>

    <!-- Start Photo -->
    <section id="photo" class="sidebar_right container" data-hide-sidebar="<?php echo $hide_sidebar; ?>">

      <div class="page_content">

        <div class="photo_frame">

          <?php echo $image; ?>

          <div class="caption">
            <span class="title"><?php echo get_the_title(); ?></span>
            <span class="desc"><?php echo get_the_content(); ?></span>
          </div>
          <div class="info">
            <a class="icon ionicon-arrow-expand" href="javascript:;"></a>
          </div>
        </div>

        </div>

        <?php
        $imgmeta = wp_get_attachment_metadata(get_post_thumbnail_id());

        // all exif data available
        $exif_data = array(
          "Aperture"      => $imgmeta['image_meta']['aperture'],
          "Credit"        => $imgmeta['image_meta']['credit'],
          "Camera"        => $imgmeta['image_meta']['camera'],
          "Caption"       => $imgmeta['image_meta']['caption'],
          "Taken On"      => date("M. jS Y", $imgmeta['image_meta']['created_timestamp']),
          "Copyright"     => $imgmeta['image_meta']['copyright'],
          "Focal Length"  => sprintf("%01.2f", $imgmeta['image_meta']['focal_length']),
          "ISO"           => $imgmeta['image_meta']['iso'],
          "Shutter_Speed" => $imgmeta['image_meta']['shutter_speed'],
          "Title"         => $imgmeta['image_meta']['title']
        );

        foreach($exif_data as $key => $value) {
          // if the value is empty
          if(empty($value) || $value == 0) {
            // delete the element from the array
            unset($exif_data[$key]);
          }
        }
        ?>  
        
        <div class="sidebar">
        
         <?php if(filter_var($show_exif, FILTER_VALIDATE_BOOLEAN)) { ?>
          <div class="widget">
            <div class="plain_list">
              <ul>
                <?php if(isset($exif_data["Taken On"])) { ?>
                <li>
                  <b><?php _e('Shoot Date:', 'framework'); ?></b>
                  <span><?php echo $exif_data["Taken On"]; ?></span>
                </li>
                <?php } ?>
                <?php if(isset($exif_data["Camera"])) { ?>
                  <li>
                    <b><?php _e('Camera:', 'framework'); ?></b>
                    <span><?php echo $exif_data["Camera"]; ?></span>
                  </li>
                <?php } ?>
                <?php if(isset($exif_data["Aperture"])) { ?>
                  <li>
                    <b><?php _e('Aperture:', 'framework'); ?></b>
                    <span><?php echo $exif_data["Aperture"]; ?></span>
                  </li>
                <?php } ?>
                <?php if(isset($exif_data["Focal Length"]) && $exif_data["Focal Length"] != "0.00") { ?>
                  <li>
                    <b><?php _e('Focal Length:', 'framework'); ?></b>
                    <span><?php echo $exif_data["Focal Length"]; ?></span>
                  </li>
                <?php } ?>
                <?php if(isset($exif_data["ISO"])) { ?>
                  <li>
                    <b><?php _e('ISO Speed:', 'framework'); ?></b>
                    <span><?php echo $exif_data["ISO"]; ?></span>
                  </li>
                <?php } ?>
                <li>
                  <b><?php _e('Dimensions:', 'framework'); ?></b>
                  <span><?php echo $full[1]; ?> × <?php echo $full[2]; ?></span>
                </li>
              </ul>
            </div>
          </div>

          <?php } ?>

          <?php if(!get_theme_mod("t2t_disable_social_sharing")) { ?>

          <div class="widget">
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
            <a class="addthis_button_preferred_1"></a>
            <a class="addthis_button_preferred_2"></a>
            <a class="addthis_button_preferred_3"></a>
            <a class="addthis_button_preferred_4"></a>
            <a class="addthis_button_compact"></a>
            <a class="addthis_counter addthis_bubble_style"></a>
            </div>
            <!-- AddThis Button END -->
          </div>

          <?php } ?>

          <?php if(filter_var($allow_download, FILTER_VALIDATE_BOOLEAN)) { ?>

          <div class="widget">
            <?php echo do_shortcode("[button size=\"medium\" url=\"$full[0]\" target=\"_blank\" background_color=\"". get_theme_mod("t2t_customizer_accent_color") ."\"]". __("DOWNLOAD THIS PHOTO", "framework") ."[/button]"); ?>
          </div>

          <?php } ?>

          <div class="attachment_nav">
            <div class="prev">
              <div class="placeholder"><span class="entypo-dot-3"></span></div>
              <?php previous_image_link("thumbnail"); ?>
            </div>
            <div class="graphic">
              <span class="entypo-left-dir"></span>
              <span class="entypo-picture"></span>
              <span class="entypo-right-dir"></span>
            </div>
            <div class="next">
              <div class="placeholder"><span class="entypo-dot-3"></span></div>
              <?php next_image_link("thumbnail"); ?>
            </div>
          </div>
        </div>

        <?php if(filter_var(get_post_meta($post->post_parent, 'allow_comments', true), FILTER_VALIDATE_BOOLEAN)) { ?>

          <!-- Start Comments -->
          <div id="comments">
            <?php comments_template(); ?>
          </div>
          <!-- End Comments -->

        <?php } ?>
      
  
    </section>
    <!--End Photo View -->
    
<?php endwhile; endif; ?>

<?php get_footer(); ?>
