<?php

if (is_admin() && isset($_GET['activated']) && 'themes.php' == $GLOBALS['pagenow']) {
  wp_redirect(admin_url('themes.php?page=theme_activation_options'));
  exit;
}

function astro_theme_activation_options_init() {
  if (astro_get_theme_activation_options() === false) {
    add_option('astro_theme_activation_options', astro_get_default_theme_activation_options());
  }

  register_setting(
    'astro_activation_options',
    'astro_theme_activation_options',
    'astro_theme_activation_options_validate'
  );
}
add_action('admin_init', 'astro_theme_activation_options_init');

function astro_activation_options_page_capability($capability) {
  return 'edit_theme_options';
}

add_filter('option_page_capability_astro_activation_options', 'astro_activation_options_page_capability');

function astro_theme_activation_options_add_page() {
  $astro_activation_options = astro_get_theme_activation_options();
  if (!$astro_activation_options['first_run']) {
    $theme_page = add_theme_page(
      __('One-click install', 'astro'),
      __('One-click install', 'astro'),
      'edit_theme_options',
      'theme_activation_options',
      'astro_theme_activation_options_render_page'
    );
  } else {
    if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'theme_activation_options') {
      wp_redirect(admin_url('themes.php'));
      exit;
    }
  }
}
add_action('admin_menu', 'astro_theme_activation_options_add_page', 50);

function astro_get_default_theme_activation_options() {
  $default_theme_activation_options = array(
    'first_run'                       => false,
    'create_front_page'               => false,
    'change_permalink_structure'      => false,
    'change_uploads_folder'           => false,
    'create_navigation_menus'         => false,
    'add_pages_to_primary_navigation' => false,
  );

  return apply_filters('astro_default_theme_activation_options', $default_theme_activation_options);
}

function astro_get_theme_activation_options() {
  return get_option('astro_theme_activation_options', astro_get_default_theme_activation_options());
}

function astro_theme_activation_options_render_page() { ?>

  <div class="wrap">
    <?php screen_icon(); ?>
    <h2><?php printf(__('%s Theme Activation Options', 'astro'), 'Astro'); ?></h2>
    <?php //settings_errors(); ?>

    <form method="post" action="options.php">

      <?php
        settings_fields('astro_activation_options');
        $astro_activation_options = astro_get_theme_activation_options();
        $astro_default_activation_options = astro_get_default_theme_activation_options();
      ?>

      <input type="hidden" value="1" name="astro_theme_activation_options[first_run]" />

      <table class="form-table">

        <tr valign="top">
          <th scope="row" class="act_row">
        <h2><?php _e('One-click install sample content?', 'astro'); ?></h2><br />
        <?php
        if (PRK_ASTRO_FRAMEWORK=="false") {
          ?>
          <em>This option is only available after installing and activating the bundled plugins indicated above. You can access the One-Click install feature after by clicking on Appearance>One-click install.</em>
          </th>
        </tr>
          </table>
        </form>
          <?php
        }
        else {
        ?>
        <em>This will create some sample entry types and pages to help you in the information insertion process and it's recommended for most users.</em>
        </th>
          <td>
            <fieldset class="rgt_btn"><legend class="screen-reader-text"><span><?php _e('One-click install sample content?', 'astro'); ?></span></legend>
              <select name="astro_theme_activation_options[create_front_page]" id="create_front_page">
                <option selected="selected" value="yes"><?php echo _e('Yes', 'astro'); ?></option>
                <option value="no"><?php echo _e('No', 'astro'); ?></option>
              </select>
            </fieldset>
          </td>
          
        </tr>

      </table>

      <?php submit_button(); ?><br /><br /><br />
      <a href="<?php echo admin_url('themes.php?page=theme_options'); ?>">Decide later</a>
    </form>
    <?php
  }
  ?>
  </div>
  

<?php }

function astro_theme_activation_options_validate($input) {
  $output = $defaults = astro_get_default_theme_activation_options();

  if (isset($input['first_run'])) {
    if ($input['first_run'] === '1') {
      $input['first_run'] = true;
    }
    $output['first_run'] = $input['first_run'];
  }

  if (isset($input['create_front_page'])) {
    if ($input['create_front_page'] === 'yes') {
      $input['create_front_page'] = true;
    }
    if ($input['create_front_page'] === 'no') {
      $input['create_front_page'] = false;
    }
    $output['create_front_page'] = $input['create_front_page'];
  }

  $input['create_navigation_menus'] = false;
    $output['create_navigation_menus'] = $input['create_navigation_menus'];

  return apply_filters('astro_theme_activation_options_validate', $output, $input, $defaults);
}

function astro_theme_activation_action() {
    $astro_theme_activation_options = astro_get_theme_activation_options();
  if ($astro_theme_activation_options['create_front_page']) 
  {
    $astro_theme_activation_options['create_front_page'] = false;
    
    //CREATE MENU IF NEEDED
    if ( is_nav_menu( PRK_THEME_NAME.' Main Menu'  ) )
    {
      //DO NOTHING. THE MENU ALREADY EXISTS 
    }
    else
    {
      //ADD THE DEFAULT FOOTER MENU
      $name = PRK_THEME_NAME.' Main Menu';
      $menu_id = wp_create_nav_menu($name);
      $menu = get_term_by( 'name', $name, 'nav_menu' );
      //ASSIGN THE MENU TO THE DEFAULT LOCATION
      $locations = get_theme_mod('nav_menu_locations');
      $locations['prk_main_navigation'] = $menu->term_id;
      set_theme_mod( 'nav_menu_locations', $locations );
      //ADD THE HOMEPAGE BUTTON
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => site_url(),
          'menu-item-title' => 'Home',
          'menu-item-attr-title' => 'description',
          'menu-item-status' => 'publish'
        );
      wp_update_nav_menu_item( $menu_id, 0, $menu );
    }
    //ADD THE SAMPLE CONTENT
    $menu_id = get_term_by( 'name', PRK_THEME_NAME.' Main Menu', 'nav_menu' );
    
     //ADD IMAGES TO THE LIBRARY
    global $wpdb;   
    include_once(ABSPATH . 'wp-admin/includes/file.php');
    include_once(ABSPATH . 'wp-admin/includes/media.php');
    $filename_a = get_template_directory_uri().'/images/sample/holder_a.jpg';
    $description_a = 'Image A Description';
    media_sideload_image($filename_a, 0, $description_a);
    $attachment_a = $wpdb->get_row($query = "SELECT * FROM {$wpdb->prefix}posts ORDER BY ID DESC LIMIT 1", ARRAY_A);
    $attachment_a_id = $attachment_a['ID'];
    
    $filename_b = get_template_directory_uri().'/images/sample/holder_b.jpg';
    $description_b = 'Image B Description';
    media_sideload_image($filename_b, 0, $description_b);
    $attachment_b = $wpdb->get_row($query = "SELECT * FROM {$wpdb->prefix}posts ORDER BY ID DESC LIMIT 2", ARRAY_A);
    $attachment_b_id = $attachment_b['ID'];

    $filename_c = get_template_directory_uri().'/images/sample/user.jpg';
    $description_c = 'Member Description';
    media_sideload_image($filename_c, 0, $description_c);
    $attachment_c = $wpdb->get_row($query = "SELECT * FROM {$wpdb->prefix}posts ORDER BY ID DESC LIMIT 3", ARRAY_A);
    $attachment_c_id = $attachment_c['ID'];
    
    //CREATE CONTENT
    //ADD A DEFAULT SKILL - PORTFOLIO CLASSIC
    wp_insert_term(
      'Astro Classic Skill', //TERM
      'pirenko_skills', //TAXONOMY
      array(
        'description'=> 'Another sample skill',
        'slug' => 'astro-classic-skill'
      )
    );
    //ADD A DEFAULT SKILL - PORTFOLIO FULLSCREEN
    wp_insert_term(
      'Astro Fullscreen Skill', //TERM
      'pirenko_skills', //TAXONOMY
      array(
        'description'=> 'A sample skill',
        'slug' => 'astro-fullscreen-skill'
      )
    );
    $new_skill=get_term_by('slug', 'astro-fullscreen-skill', 'pirenko_skills');
    
    //HOMEPAGE
    $new_page_title = 'Portfolio Carousel';
    $new_page_content = '';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
    //CHECK IF PAGE EXISTS
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "template_portfolio_carousel.php");
      update_option('show_on_front', 'page');
      update_option('page_on_front', $new_page_id);
      add_post_meta($new_page_id, 'show_skills', '1');
      add_post_meta($new_page_id, 'columns_number', '3');
      add_post_meta($new_page_id, 'portfolio_filter', array('0' => $new_skill));
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => site_url(),
          'menu-item-title' => 'Home',
          'menu-item-attr-title' => 'description',
          'menu-item-status' => 'publish'
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }
    
    
    //ADD THE PAGES PARENT BUTTON TO THE MENU
    $menu = 
      array( 
        'menu-item-type' => 'custom', 
        'menu-item-url' => '#',
        'menu-item-title' => 'Pages',
        'menu-item-attr-title' => 'description',
        'menu-item-status' => 'publish'
      );
    $parent_page=wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );

    //PORTFOLIO ITEM - IMAGE
    $new_page_title = 'Fullscreen with Image';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]The aborigine, apparently uninjured, climbed quickly into the skiff, and seizing the spear with me helped to hold off the infuriated creature. Blood from the wounded reptile was now crimsoning the waters about us and soon from the weakening struggles it became evident that I had inflicted a death wound upon it. Presently its efforts to reach us ceased entirely, and with a few convulsive movements it turned upon its back quite dead.
And then there came to me a sudden realization of the predicament in which I had placed myself. I was entirely within the power of the savage man whose skiff I had stolen. Still clinging to the spear I looked into his face to find him scrutinizing me intently, and there we stood for some several minutes, each clinging tenaciously to the weapon the while we gazed in stupid wonderment at each other.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'pirenko_portfolios');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_portfolios',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-08',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      wp_publish_post($new_page_id);
      add_post_meta($new_page_id, 'featured_color', '#27ae60');
      add_post_meta($new_page_id, 'client_url', 'Company ABC');
      add_post_meta($new_page_id, 'ext_url', 'http://www.google.com');
      wp_set_post_terms( $new_page_id, array($new_skill->term_id), 'pirenko_skills', false );
    }
    //PORTFOLIO ITEM - SLIDER
    $new_page_title = 'Fullscreen with Slider';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]The aborigine, apparently uninjured, climbed quickly into the skiff, and seizing the spear with me helped to hold off the infuriated creature. Blood from the wounded reptile was now crimsoning the waters about us and soon from the weakening struggles it became evident that I had inflicted a death wound upon it. Presently its efforts to reach us ceased entirely, and with a few convulsive movements it turned upon its back quite dead.
And then there came to me a sudden realization of the predicament in which I had placed myself. I was entirely within the power of the savage man whose skiff I had stolen. Still clinging to the spear I looked into his face to find him scrutinizing me intently, and there we stood for some several minutes, each clinging tenaciously to the weapon the while we gazed in stupid wonderment at each other.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'pirenko_portfolios');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_portfolios',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-07',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_b_id);
      wp_publish_post($new_page_id);
      add_post_meta($new_page_id, 'image_2', $attachment_a_id);
      add_post_meta($new_page_id, 'featured_color', '#e67e22');
      add_post_meta($new_page_id, 'client_url', 'Company ABC');
      add_post_meta($new_page_id, 'ext_url', 'http://www.google.com');
      wp_set_post_terms( $new_page_id, array($new_skill->term_id), 'pirenko_skills', false );
    }
    
    
    //PORTFOLIO ITEM - VIDEO
    $new_page_title = 'Fullscreen with Video';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]The aborigine, apparently uninjured, climbed quickly into the skiff, and seizing the spear with me helped to hold off the infuriated creature. Blood from the wounded reptile was now crimsoning the waters about us and soon from the weakening struggles it became evident that I had inflicted a death wound upon it. Presently its efforts to reach us ceased entirely, and with a few convulsive movements it turned upon its back quite dead.
And then there came to me a sudden realization of the predicament in which I had placed myself. I was entirely within the power of the savage man whose skiff I had stolen. Still clinging to the spear I looked into his face to find him scrutinizing me intently, and there we stood for some several minutes, each clinging tenaciously to the weapon the while we gazed in stupid wonderment at each other.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'pirenko_portfolios');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_portfolios',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-06',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      wp_publish_post($new_page_id);
      add_post_meta($new_page_id, 'skip_featured', '1');
      add_post_meta($new_page_id, 'video_2', '<iframe width="1280" height="720" src="http://www.youtube.com/embed/Q9Phn1yQT8U?html5=1&vq=hd720" frameborder="0" allowfullscreen></iframe>');
      add_post_meta($new_page_id, 'featured_color', '#8e44ad');
      add_post_meta($new_page_id, 'client_url', 'Company ABC');
      add_post_meta($new_page_id, 'ext_url', 'http://www.google.com');
      wp_set_post_terms( $new_page_id, array($new_skill->term_id), 'pirenko_skills', false );
    }
    $new_skill=get_term_by('slug', 'astro-classic-skill', 'pirenko_skills');
    //PORTFOLIO PAGE
    $new_page_title = 'Grid Portfolio';
    $new_page_content = '';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
    //CHECK IF PAGE EXISTS
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "template_portfolio_var-grid.php");
      add_post_meta($new_page_id, 'show_skills', '1');
      add_post_meta($new_page_id, 'thumbs_margin', '0');
      add_post_meta($new_page_id, 'use_lightbox', '0');
      add_post_meta($new_page_id, 'thumbs_rollover', '#000000');
      add_post_meta($new_page_id, 'portfolio_filter', array('0' => $new_skill));
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => get_permalink($new_page_id),
          'menu-item-title' => $new_page_title,
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $parent_page,
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }

    //PORTFOLIO ITEM - IMAGE
    $new_page_title = 'Classic with Image';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]The aborigine, apparently uninjured, climbed quickly into the skiff, and seizing the spear with me helped to hold off the infuriated creature. Blood from the wounded reptile was now crimsoning the waters about us and soon from the weakening struggles it became evident that I had inflicted a death wound upon it. Presently its efforts to reach us ceased entirely, and with a few convulsive movements it turned upon its back quite dead.
And then there came to me a sudden realization of the predicament in which I had placed myself. I was entirely within the power of the savage man whose skiff I had stolen. Still clinging to the spear I looked into his face to find him scrutinizing me intently, and there we stood for some several minutes, each clinging tenaciously to the weapon the while we gazed in stupid wonderment at each other.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'pirenko_portfolios');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_portfolios',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-04',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      wp_publish_post($new_page_id);
      add_post_meta($new_page_id, 'inner_layout', 'classic');
      add_post_meta($new_page_id, 'featured_color', '#27ae60');
      add_post_meta($new_page_id, 'client_url', 'Company ABC');
      add_post_meta($new_page_id, 'ext_url', 'http://www.google.com');
      wp_set_post_terms( $new_page_id, array($new_skill->term_id), 'pirenko_skills', false );
    }
    //PORTFOLIO ITEM - SLIDER
    $new_page_title = 'Classic with Slider';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]The aborigine, apparently uninjured, climbed quickly into the skiff, and seizing the spear with me helped to hold off the infuriated creature. Blood from the wounded reptile was now crimsoning the waters about us and soon from the weakening struggles it became evident that I had inflicted a death wound upon it. Presently its efforts to reach us ceased entirely, and with a few convulsive movements it turned upon its back quite dead.
And then there came to me a sudden realization of the predicament in which I had placed myself. I was entirely within the power of the savage man whose skiff I had stolen. Still clinging to the spear I looked into his face to find him scrutinizing me intently, and there we stood for some several minutes, each clinging tenaciously to the weapon the while we gazed in stupid wonderment at each other.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'pirenko_portfolios');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_portfolios',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-03',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_b_id);
      wp_publish_post($new_page_id);
      add_post_meta($new_page_id, 'inner_layout', 'classic');
      add_post_meta($new_page_id, 'image_2', $attachment_a_id);
      add_post_meta($new_page_id, 'featured_color', '#e67e22');
      add_post_meta($new_page_id, 'client_url', 'Company ABC');
      add_post_meta($new_page_id, 'ext_url', 'http://www.google.com');
      wp_set_post_terms( $new_page_id, array($new_skill->term_id), 'pirenko_skills', false );
    }
    
    
    //PORTFOLIO ITEM - VIDEO
    $new_page_title = 'Classic with Video';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]The aborigine, apparently uninjured, climbed quickly into the skiff, and seizing the spear with me helped to hold off the infuriated creature. Blood from the wounded reptile was now crimsoning the waters about us and soon from the weakening struggles it became evident that I had inflicted a death wound upon it. Presently its efforts to reach us ceased entirely, and with a few convulsive movements it turned upon its back quite dead.
And then there came to me a sudden realization of the predicament in which I had placed myself. I was entirely within the power of the savage man whose skiff I had stolen. Still clinging to the spear I looked into his face to find him scrutinizing me intently, and there we stood for some several minutes, each clinging tenaciously to the weapon the while we gazed in stupid wonderment at each other.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'pirenko_portfolios');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_portfolios',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-02',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      wp_publish_post($new_page_id);
      add_post_meta($new_page_id, 'inner_layout', 'classic');
      add_post_meta($new_page_id, 'skip_featured', '1');
      add_post_meta($new_page_id, 'video_2', '<iframe width="1280" height="720" src="http://www.youtube.com/embed/Q9Phn1yQT8U?html5=1&vq=hd720" frameborder="0" allowfullscreen></iframe>');
      add_post_meta($new_page_id, 'featured_color', '#8e44ad');
      add_post_meta($new_page_id, 'client_url', 'Company ABC');
      add_post_meta($new_page_id, 'ext_url', 'http://www.google.com');
      wp_set_post_terms( $new_page_id, array($new_skill->term_id), 'pirenko_skills', false );
    }
    //FULLSCREEN SLIDER
    $new_page_title = 'Fullscreen Slider';
    $new_page_content = '';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
    //CHECK IF PAGE EXISTS
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "template_full_slider.php");
      add_post_meta($new_page_id, 'fullscreen_slider_autoplay', '1');
      add_post_meta($new_page_id, 'fullscreen_slider_hover', '0');
      add_post_meta($new_page_id, 'fullscreen_slider_delay', '6500');

      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => get_permalink($new_page_id),
          'menu-item-title' => $new_page_title,
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $parent_page,
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }
    
    //BLOG PAGE - CLASSIC
    $new_page_title = 'Classic Blog';
    $new_page_content = '';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
    //CHECK IF PAGE EXISTS
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "template_blog.php");
      add_post_meta($new_page_id, 'hide_title', '1');
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => get_permalink($new_page_id),
          'menu-item-title' => $new_page_title,
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $parent_page,
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }

    //BLOG PAGE - MASONRY
    $new_page_title = 'Masonry Blog';
    $new_page_content = '';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
    //CHECK IF PAGE EXISTS
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "template_blog_masonry.php");
      add_post_meta($new_page_id, 'hide_title', '1');
      add_post_meta($new_page_id, 'thumbs_margin', '20');
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => get_permalink($new_page_id),
          'menu-item-title' => $new_page_title,
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $parent_page,
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }
    
    //CONTACT PAGE
    $new_page_title = 'Contact Page';
    $new_page_content = '';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
    //CHECK IF PAGE EXISTS
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "page-contact.php");
      add_post_meta($new_page_id, 'contact_layout', 'fullscreen');
      add_post_meta($new_page_id, 'content_type', 'map');
      add_post_meta($new_page_id, 'map_latitude', '40.6700');
      add_post_meta($new_page_id, 'map_longitude', '-73.9400');
      add_post_meta($new_page_id, 'zoom_level', '13');
      add_post_meta($new_page_id, 'contact-address', 'Astro Photography, Inc.<br>Third Main Street, 27th<br>Brooklyn, NY City<br>1000-204 NY');
      add_post_meta($new_page_id, 'map_style', 'subtle_grayscale');
      add_post_meta($new_page_id, 'show_contact_form', '1');
      add_post_meta($new_page_id, 'prk_email_address', 'something@mail.com');
      add_post_meta($new_page_id, 'show_contact_information', '1');
      add_post_meta($new_page_id, 'contact-info_title', 'Contact Information');
      add_post_meta($new_page_id, 'contact-info_tel', '+1 234 555 999');
      add_post_meta($new_page_id, 'contact-info_fax', '+1 234 555 990');
      add_post_meta($new_page_id, 'contact-info_email', 'hello@astro.com');
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => get_permalink($new_page_id),
          'menu-item-title' => $new_page_title,
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $parent_page,
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }
    
    
    //ADD A DEFAULT CATEGORY - BLOG
    wp_create_category('Astro Category');
    $new_category=get_category_by_slug('astro-category');
    
    
    //BLOG ITEM - IMAGE
    $new_page_title = 'Post with Image';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]The aborigine, apparently uninjured, climbed quickly into the skiff, and seizing the spear with me helped to hold off the infuriated creature. Blood from the wounded reptile was now crimsoning the waters about us and soon from the weakening struggles it became evident that I had inflicted a death wound upon it. Presently its efforts to reach us ceased entirely, and with a few convulsive movements it turned upon its back quite dead.
And then there came to me a sudden realization of the predicament in which I had placed myself. I was entirely within the power of the savage man whose skiff I had stolen. Still clinging to the spear I looked into his face to find him scrutinizing me intently, and there we stood for some several minutes, each clinging tenaciously to the weapon the while we gazed in stupid wonderment at each other.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'post',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-08',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_b_id);
      add_post_meta($new_page_id, 'bl_icon', 'navicon-pen');
      wp_set_post_terms( $new_page_id, array($new_category->term_id), 'category', false );
    }

    //BLOG ITEM - SLIDER
    $new_page_title = 'Post with Slider';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]The aborigine, apparently uninjured, climbed quickly into the skiff, and seizing the spear with me helped to hold off the infuriated creature. Blood from the wounded reptile was now crimsoning the waters about us and soon from the weakening struggles it became evident that I had inflicted a death wound upon it. Presently its efforts to reach us ceased entirely, and with a few convulsive movements it turned upon its back quite dead.
And then there came to me a sudden realization of the predicament in which I had placed myself. I was entirely within the power of the savage man whose skiff I had stolen. Still clinging to the spear I looked into his face to find him scrutinizing me intently, and there we stood for some several minutes, each clinging tenaciously to the weapon the while we gazed in stupid wonderment at each other.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'post',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-07',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      add_post_meta($new_page_id, 'bl_icon', 'navicon-camera-2');
      add_post_meta($new_page_id, 'image_2', $attachment_b_id);
      wp_set_post_terms( $new_page_id, array($new_category->term_id), 'category', false );
    }
    
    
    //BLOG ITEM - VIDEO
    $new_page_title = 'Post with Video';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]The aborigine, apparently uninjured, climbed quickly into the skiff, and seizing the spear with me helped to hold off the infuriated creature. Blood from the wounded reptile was now crimsoning the waters about us and soon from the weakening struggles it became evident that I had inflicted a death wound upon it. Presently its efforts to reach us ceased entirely, and with a few convulsive movements it turned upon its back quite dead.
And then there came to me a sudden realization of the predicament in which I had placed myself. I was entirely within the power of the savage man whose skiff I had stolen. Still clinging to the spear I looked into his face to find him scrutinizing me intently, and there we stood for some several minutes, each clinging tenaciously to the weapon the while we gazed in stupid wonderment at each other.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'post',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-06',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      add_post_meta($new_page_id, 'skip_featured', '1');
      add_post_meta($new_page_id, 'bl_icon', 'navicon-camera');
      add_post_meta($new_page_id, 'video_2', '<iframe width="1280" height="720" src="http://www.youtube.com/embed/Q9Phn1yQT8U?html5=1&vq=hd720" frameborder="0" allowfullscreen></iframe>');
      wp_set_post_terms( $new_page_id, array($new_category->term_id), 'category', false );
    }
    
    
    //BLOG ITEM - AUDIO
    $new_page_title = 'Post with Audio';
    $new_page_content = '[vc_row][vc_column width="1/1"][vc_column_text]The aborigine, apparently uninjured, climbed quickly into the skiff, and seizing the spear with me helped to hold off the infuriated creature. Blood from the wounded reptile was now crimsoning the waters about us and soon from the weakening struggles it became evident that I had inflicted a death wound upon it. Presently its efforts to reach us ceased entirely, and with a few convulsive movements it turned upon its back quite dead.
And then there came to me a sudden realization of the predicament in which I had placed myself. I was entirely within the power of the savage man whose skiff I had stolen. Still clinging to the spear I looked into his face to find him scrutinizing me intently, and there we stood for some several minutes, each clinging tenaciously to the weapon the while we gazed in stupid wonderment at each other.[/vc_column_text][/vc_column][/vc_row]';
    $page_check = get_page_by_title($new_page_title, '', 'post');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'post',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-05',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      add_post_meta($new_page_id, 'skip_featured', '1');
      add_post_meta($new_page_id, 'bl_icon', 'navicon-music');
      add_post_meta($new_page_id, 'video_2', '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F58223409"></iframe>');
      wp_set_post_terms( $new_page_id, array($new_category->term_id), 'category', false );
    } 
    
     //ADD A DEFAULT TEAM - TEAM MEMBERS
    wp_insert_term(
      'Astro Team', //TERM
      'pirenko_member_group', //TAXONOMY
      array(
        'description'=> 'A sample team',
        'slug' => 'astro-team'
      )
    );
    $new_group=get_term_by('slug', 'astro-team', 'pirenko_member_group');
    
    
    //MEMBERS - MEMBER A
    $new_page_title = 'John Doe';
    $new_page_content = 'In both cases, the stranded whales to which these two skeletons belonged, were originally claimed by their proprietors upon similar grounds. King Tranquo seizing his because he wanted it; and Sir Clifford, because he was lord of the seignories of those parts. Sir Cliffords whale has been articulated throughout; so that, like a great chest of drawers, you can open and shut him, in all his bony cavities out his ribs like a gigantic swing all day upon his lower jaw. Locks are to be put upon some of his trap-doors and shutters; and a footman will show round future visitors with a bunch of keys at his side. Sir Clifford thinks of charging twopence for a peep at the whispering gallery in the spinal column; threepence to hear the echo in the hollow of his cerebellum; and sixpence for the unrivalled view from his forehead.';
    $page_check = get_page_by_title($new_page_title, '', 'pirenko_team_member');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_team_member',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-08',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      add_post_meta($new_page_id, 'featured_color', '#2c3e50');
      add_post_meta($new_page_id, 'member_job', 'Creative Director');
      add_post_meta($new_page_id, 'member_email', 'john@astro.com');
      add_post_meta($new_page_id, 'show_member_link', '1');
      add_post_meta($new_page_id, 'show_member_image', '1');
      add_post_meta($new_page_id, 'image_2', $attachment_c_id);
      set_post_thumbnail($new_page_id, $attachment_c_id);
      wp_set_post_terms( $new_page_id, array($new_group->term_id), 'pirenko_member_group', false );
    }
    //MEMBERS - MEMBER B
    $new_page_title = 'Jane Doe';
    $new_page_content = 'In both cases, the stranded whales to which these two skeletons belonged, were originally claimed by their proprietors upon similar grounds. King Tranquo seizing his because he wanted it; and Sir Clifford, because he was lord of the seignories of those parts. Sir Cliffords whale has been articulated throughout; so that, like a great chest of drawers, you can open and shut him, in all his bony cavities out his ribs like a gigantic swing all day upon his lower jaw. Locks are to be put upon some of his trap-doors and shutters; and a footman will show round future visitors with a bunch of keys at his side. Sir Clifford thinks of charging twopence for a peep at the whispering gallery in the spinal column; threepence to hear the echo in the hollow of his cerebellum; and sixpence for the unrivalled view from his forehead.';
    $page_check = get_page_by_title($new_page_title, '', 'pirenko_team_member');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_team_member',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-10',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      add_post_meta($new_page_id, 'featured_color', '#2c3e50');
      add_post_meta($new_page_id, 'member_job', 'Creative Director');
      add_post_meta($new_page_id, 'member_email', 'jane@astro.com');
      add_post_meta($new_page_id, 'show_member_link', '1');
      add_post_meta($new_page_id, 'show_member_image', '1');
      add_post_meta($new_page_id, 'image_2', $attachment_c_id);
      set_post_thumbnail($new_page_id, $attachment_c_id);
      wp_set_post_terms( $new_page_id, array($new_group->term_id), 'pirenko_member_group', false );
    }
    //MEMBERS - MEMBER C
    $new_page_title = 'Jackie Doe';
    $new_page_content = 'In both cases, the stranded whales to which these two skeletons belonged, were originally claimed by their proprietors upon similar grounds. King Tranquo seizing his because he wanted it; and Sir Clifford, because he was lord of the seignories of those parts. Sir Cliffords whale has been articulated throughout; so that, like a great chest of drawers, you can open and shut him, in all his bony cavities out his ribs like a gigantic swing all day upon his lower jaw. Locks are to be put upon some of his trap-doors and shutters; and a footman will show round future visitors with a bunch of keys at his side. Sir Clifford thinks of charging twopence for a peep at the whispering gallery in the spinal column; threepence to hear the echo in the hollow of his cerebellum; and sixpence for the unrivalled view from his forehead.';
    $page_check = get_page_by_title($new_page_title, '', 'pirenko_team_member');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_team_member',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_date' => '2013-09-09',
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      add_post_meta($new_page_id, 'featured_color', '#2c3e50');
      add_post_meta($new_page_id, 'member_job', 'Creative Director');
      add_post_meta($new_page_id, 'member_email', 'jackie@astro.com');
      add_post_meta($new_page_id, 'show_member_link', '1');
      add_post_meta($new_page_id, 'show_member_image', '1');
      add_post_meta($new_page_id, 'image_2', $attachment_c_id);
      set_post_thumbnail($new_page_id, $attachment_c_id);
      wp_set_post_terms( $new_page_id, array($new_group->term_id), 'pirenko_member_group', false );
    }

    //ADD A DEFAULT GROUP - SLIDES
    wp_insert_term(
      'Astro Group', //TERM
      'pirenko_slide_set', //TAXONOMY
      array(
        'description'=> 'A sample group',
        'slug' => 'astro-group'
      )
    );
    $new_group=get_term_by('slug', 'astro-group', 'pirenko_slide_set');
    
    //SLIDES ITEM - IMAGE A
    $new_page_title = 'Slide A with Image';
    $new_page_content = 'This is the image A description.';
    $page_check = get_page_by_title($new_page_title, '', 'pirenko_slides');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_slides',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_a_id);
      add_post_meta($new_page_id, 'pirenko_sh_slide_header_bk_color', '#000000');
      add_post_meta($new_page_id, 'title_background_color_opacity', '80');
      add_post_meta($new_page_id, 'pirenko_sh_slide_body_color', '#ffffff');
      add_post_meta($new_page_id, 'pirenko_sh_slide_body_bk_color', '#000000');
      add_post_meta($new_page_id, 'body_background_color_opacity', '80');
      wp_set_post_terms( $new_page_id, array($new_group->term_id), 'pirenko_slide_set', false );
    }
    
    
    //SLIDES ITEM - IMAGE B
    $new_page_title = 'Slide B with Image';
    $new_page_content = 'This is the image A description.';
    $page_check = get_page_by_title($new_page_title, '', 'pirenko_slides');
    if(!isset($page_check->ID)){
      $new_page = array(
        'post_type' => 'pirenko_slides',
        'post_title' => $new_page_title,
        'post_content' => $new_page_content,
        'post_status' => 'publish'
      );
      $new_page_id = wp_insert_post($new_page);
      set_post_thumbnail($new_page_id, $attachment_b_id);
      add_post_meta($new_page_id, 'pirenko_sh_slide_header_bk_color', '#000000');
      add_post_meta($new_page_id, 'title_background_color_opacity', '80');
      add_post_meta($new_page_id, 'pirenko_sh_slide_body_color', '#ffffff');
      add_post_meta($new_page_id, 'pirenko_sh_slide_body_bk_color', '#000000');
      add_post_meta($new_page_id, 'body_background_color_opacity', '80');
      wp_set_post_terms( $new_page_id, array($new_group->term_id), 'pirenko_slide_set', false );
    }

    //SAMPLE PAGE
    $new_page_title = 'About Us';
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_content = '[vc_row][vc_column width="1/1"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][prk_members columns="3"][/vc_column][/vc_row][vc_row bk_type="full_width" bk_color="#dff7f7" parallax="normal" align="Left"][vc_column width="1/1"][prkwp_styled_title prk_in="Our Services" align="Center" title_size="Large" use_italic="No" astro_show_line="No"][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/4"][prkwp_service name="Photography" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder." image="icon-camera"][/vc_column_inner][vc_column_inner width="1/4"][prkwp_service name="Assistance" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder." image="icon-megaphone"][/vc_column_inner][vc_column_inner width="1/4"][prkwp_service name="E-Commerce" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder." image="icon-globe"][/vc_column_inner][vc_column_inner width="1/4"][prkwp_service name="Print" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder." image="icon-print"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/4"][prkwp_service name="Online Support" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder." image="icon-cog"][/vc_column_inner][vc_column_inner width="1/4"][prkwp_service name="Web Design" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder." image="icon-monitor"][/vc_column_inner][vc_column_inner width="1/4"][prkwp_service name="Teaching" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder." image="icon-thumbs-up"][/vc_column_inner][vc_column_inner width="1/4"][prkwp_service name="Video Reels" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder." image="icon-video"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column width="1/1"][/vc_column][/vc_row][vc_row][vc_column width="2/3"][prkwp_styled_title prk_in="We Are Astros" align="Left" title_size="Medium" use_italic="No" astro_show_line="No" unmargined="unmargined"][vc_column_text]As with the Hawaiian savage, so with the white sailor-savage. With the same marvellous patience, and with the same single shark tooth, of his one poor jack-knife, he will carve you a bit of bone sculpture, not quite as workmanlike, but as close packed in its maziness of design, as the and full of barbaric spirit and suggestiveness, as the prints of that fine old Dutch savage, Albert Durer.
Wooden whales, or whales cut in profile out of the small dark slabs of the noble South Sea war-wood, are frequently met with in the forecastles of American. Some of them are done with much accuracy.
Nor when expandingly lifted by your subject, can you fail to trace out great whales in the starry heavens.[/vc_column_text][/vc_column][vc_column width="1/3"][prkwp_styled_title prk_in="Clients Buzz" align="Left" title_size="Medium" use_italic="No" astro_show_line="No"][bquote author="Peter Crow" after_author=" - Professional Photographer" prk_in="Finally the queen was under much longer than ever before, and when she rose she came alone and swam sleepily toward her bowlder. Abominable are the tumblers into which he pours his poison." type="colored_background"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][/vc_column][/vc_row]';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "page-sections.php");
      add_post_meta($new_page_id, 'hide_title', '0');
      add_post_meta($new_page_id, 'hide_line', '1');
      add_post_meta($new_page_id, 'below_headings_text', 'The faces behind all creations.');
      add_post_meta($new_page_id, 'header_align', 'left');
      add_post_meta($new_page_id, 'featured_slider', 'no');
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => get_permalink($new_page_id),
          'menu-item-title' => $new_page_title,
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $parent_page,
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }

    //ANOTHER SAMPLE PAGE
    $new_page_title = 'About Me';
    $page_id = get_page_by_title($new_page_title);
    if(!isset($page_id->ID)) {
      $new_page_content = '[vc_row bk_type="full_width" bk_image="'.$attachment_b_id.'" parallax="normal" align="Left"][vc_column width="1/3"][prkwp_styled_title prk_in="Anne Ferrara" align="Left" text_color="#ffffff" title_size="Large" use_italic="No" astro_show_line="No"][vc_separator][vc_column_text el_class="zero_color"]
<h4><span style="color: #000000;"><span style="color: #ffffff;">Interface Designer</span><a href="http://www.kylepenndesign.com/projects/"><span style="color: #000000;">
</span></a></span></h4>
[/vc_column_text][prkwp_spacer size="12"][vc_column_text]<span style="color: #ffffff;">For a moment I stood a little puzzled by this curious request, not knowing exactly how to take it, whether humorously or in earnest. But concentrating all his crow feet into one scowl, Captain Peleg started me on the errand.</span>[/vc_column_text][/vc_column][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][/vc_column][/vc_row][vc_row bk_type="boxed_look" parallax="normal" align="Left"][vc_column width="2/3"][prkwp_styled_title prk_in="What I am Good At" align="Left" title_size="Medium" use_italic="No" samba_show_line="Yes" astro_show_line="No"][vc_row_inner][vc_column_inner width="1/1"][prk_progress_bar title="Photoshop" pctg="70" active_color="#95a5a6" show_pctg="yes"][prk_progress_bar title="Dreamweaver" pctg="80" active_color="#95a5a6" show_pctg="yes"][prk_progress_bar title="After Effects" pctg="95" active_color="#95a5a6" show_pctg="yes"][prk_progress_bar title="Bridge" pctg="85" active_color="#95a5a6" show_pctg="yes"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3"][prkwp_styled_title prk_in="My Life Story" align="Left" title_size="Medium" use_italic="No" samba_show_line="Yes" astro_show_line="No"][vc_column_text]Evidently his mission was to protect me only, I thought, but when we reached the edge of the city he suddenly sprang before me, uttering strange sounds and baring his ugly and ferocious tusks. Thinking to have some amusement at his expense, I rushed toward him, and when almost upon him sprang into the air, alighting far beyond him and away from the city.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/1"][/vc_column][/vc_row][vc_row bk_type="full_width" bk_color="#ffecea" parallax="normal" align="Left"][vc_column width="1/1"][prkwp_styled_title prk_in="We Should Work Together" align="Center" title_size="Large" use_italic="No" astro_show_line="No"][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/3"][prkwp_service name="Photography" image="icon-camera" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder."][/vc_column_inner][vc_column_inner width="1/3"][prkwp_service name="Portraits" image="icon-network" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder."][/vc_column_inner][vc_column_inner width="1/3"][prkwp_service name="Business" image="icon-music" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder."][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/3"][prkwp_service name="Zero Paperwork" image="icon-print" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder."][/vc_column_inner][vc_column_inner width="1/3"][prkwp_service name="Branding" image="icon-home" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder."][/vc_column_inner][vc_column_inner width="1/3"][prkwp_service name="Movie Edition" image="icon-globe" align="center" prk_in="Seat thyself among the moons of Saturn, and take high abstracted man alone; and he seems a wonder."][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column width="1/1"][/vc_column][/vc_row][vc_row bk_type="boxed_look" margin_type="unmargined" parallax="normal" align="Left"][vc_column width="1/1"][prkwp_styled_title prk_in="Clients Talk" align="Center" title_size="Medium" use_italic="No" astro_show_line="No"][/vc_column][/vc_row][vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text el_class="zero_color"]
<h5 style="text-align: center;">"The thing, which more nearly resembled our earthly men than it did the Martians I had seen, held me pinioned to the ground with one huge foot, while it jabbered and gesticulated at some answering creature behind me. This other, which was evidently its mate, soon came toward us, bearing a mighty stone cudgel."</h5>
[/vc_column_text][prkwp_spacer size="6"][vc_column_text el_class="zero_color"]
<h5 style="text-align: center;"><strong><em style="font-size: 13px;">Peter Cussack</em></strong></h5>
[/vc_column_text][prkwp_spacer size="1"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][/vc_column][/vc_row][vc_row bk_type="full_width" margin_type="unmargined" bk_color="#ededed" parallax="normal" align="Left"][vc_column width="1/1"][vc_cta_button call_text="Lets Do Business" call_desc="I quickly saw that I would have difficulty in escaping the fangs of the beast on a straightaway course, and so I met his charge by doubling in my tracks and leaping over him as he was almost upon me. This maneuver gave me a considerable advantage, and I was able to reach the city quite a bit ahead of him, and as he came tearing after me I jumped for a window about thirty feet from the ground in the face of one of the buildings overlooking the valley." text_align="text_left" title="Buy Theme →" target="_blank" color="theme_button" icon="none" size="btn-large" position="cta_align_right" button_align="button_center" href="#"][/vc_column][/vc_row]';
    $new_page = array(
      'post_type' => 'page',
      'post_title' => $new_page_title,
      'post_content' => $new_page_content,
      'post_status' => 'publish'
    );
      $new_page_id = wp_insert_post($new_page);
      update_post_meta($new_page_id, "_wp_page_template", "page-sections.php");
      add_post_meta($new_page_id, 'hide_title', '1');
      add_post_meta($new_page_id, 'hide_line', '1');
      add_post_meta($new_page_id, 'below_headings_text', '');
      add_post_meta($new_page_id, 'header_align', 'left');
      add_post_meta($new_page_id, 'featured_slider', 'no');
      //ADD THE PAGE TO THE MENU
      $menu = 
        array( 
          'menu-item-type' => 'custom', 
          'menu-item-url' => get_permalink($new_page_id),
          'menu-item-title' => $new_page_title,
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $parent_page,
        );
      wp_update_nav_menu_item( $menu_id->term_id, 0, $menu );
    }


  }//ONE CLICK CONTENT


    if ($astro_theme_activation_options['create_navigation_menus']) 
    {
    $astro_theme_activation_options['create_navigation_menus'] = false;
    //ADD THE DEFAULT MENUS IF NECESSARY
    if ( is_nav_menu( 'Top Left Menu'  ) )
    {
      //DO NOTHING. THE MENU ALREADY EXISTS 
    }
    else
    {
      $name = 'Top Left Menu';
      $menu_id = wp_create_nav_menu($name);
      $menu = get_term_by( 'name', $name, 'nav_menu' );
      //ASSIGN THE MENU TO THE DEFAULT LOCATION
      $locations = get_theme_mod('nav_menu_locations');
      $locations['top_left_navigation'] = $menu->term_id;
      set_theme_mod( 'nav_menu_locations', $locations );
    }
    }
    update_option('astro_theme_activation_options', $astro_theme_activation_options);
}

add_action('admin_init','astro_theme_activation_action');

function astro_deactivation_action() {
  update_option('astro_theme_activation_options', astro_get_default_theme_activation_options());
}

add_action('switch_theme', 'astro_deactivation_action');