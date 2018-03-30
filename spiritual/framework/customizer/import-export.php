<?php 

ob_start();

// Import

function swm_customizer_import_page() {
?>
  <div class="wrap">    
    <h2>Import Customizer Settings</h2>
    <?php
    if ( isset( $_FILES['import'] ) && check_admin_referer( 'swm-customizer-import' ) ) {
      if ( $_FILES['import']['error'] > 0 ) {
        wp_die( 'An error occured.' );
      } else {
        $file_name = $_FILES['import']['name'];
        $file_ext  = strtolower( end( explode( '.', $file_name ) ) );
        $file_size = $_FILES['import']['size'];
        if ( ( $file_ext == 'json' ) && ( $file_size < 500000 ) ) {
          $encode_options = file_get_contents( $_FILES['import']['tmp_name'] );
          $options        = json_decode( $encode_options, true );
          foreach ( $options as $key => $value ) {
            set_theme_mod( $key, $value );
          }
          echo '<div class="updated"><p>'.__('All options were restored successfully!','swmtranslate').'</p></div>';
        } else {
          echo '<div class="error"><p>'.__('Invalid file or file size too big.','swmtranslate').'</p></div>';
        }
      }
    }
    ?>
    <form method="post" enctype="multipart/form-data">
      <?php wp_nonce_field( 'swm-customizer-import' ); 
      echo '<p>'.__('Click "Choose File" button and choose a JSON file from your computer that you backup before.','swmtranslate').'</p>';            
      ?>
      <input type="file" id="customizer-upload" name="import"></p>
      
      <p class="submit">
        <input type="submit" name="submit" id="customizer-submit" class="button" value="Upload file and import" disabled>
      </p>
    </form>
  </div>
<?php
}

// Export

function swm_customizer_export_page() {
  if ( ! isset( $_POST['export'] ) ) {
  ?>
    <div class="wrap">
      <div id="icon-tools" class="icon32"><br></div>
      <h2>Customizer Export</h2>
      <form method="post">
        <?php wp_nonce_field( 'swm-customizer-export' );

        echo '<p>'.__('When you click the button below WordPress will create an JSON file for you to save to your computer.','swmtranslate').'</p>';
        echo '<p>'.__('This format, which we call WordPress Customizer Settings, will contain your customizer settings for this theme.','swmtranslate').'</p>';

        echo '<p>'.__('Once you have saved the download file, you can use the Customizer Import function to import previously exported settings.','swmtranslate').'</p>';       
        ?>
        <p class="submit"><input type="submit" name="export" class="button button-primary" value="Export Customizer Settings"></p>
      </form>
    </div>
  <?php
  } elseif ( check_admin_referer( 'swm-customizer-export' ) ) {

    $blogname  = strtolower( str_replace(' ', '', get_option( 'blogname' ) ) );
    $date      = date( 'm-d-Y' );
    $json_name = $blogname . '-customizer-' . $date;
    $options   = get_theme_mods();

    unset( $options['nav_menu_locations'] );

    foreach ( $options as $key => $value ) {
      $value              = maybe_unserialize( $value );
      $need_options[$key] = $value;
    }

    $json_file = json_encode( $need_options );

    ob_clean();

    echo $json_file;

    header( 'Content-Type: text/json; charset=' . get_option( 'blog_charset' ) );
    header( 'Content-Disposition: attachment; filename=' . $json_name . '.json' );

    exit();

  }
}