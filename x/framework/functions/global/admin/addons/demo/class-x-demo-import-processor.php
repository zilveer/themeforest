<?php

class X_Demo_Import_Processor {

  public $batchCount = 0;
  public $maxBatchSize = 2;
  public $registry;

  public function setup( $session ) {

    $this->maxBatchSize = apply_filters( 'x_demo_batch_size', $this->maxBatchSize );

    $this->session = $session;
    $this->namespace = $this->session->get( 'namespace' );
    $this->registry = new X_Demo_Import_Registry;
    $this->registry->setNameSpace( $this->namespace );

    $this->jobs = $this->session->get('jobs');
    $this->jobs_total = $this->session->get('jobs_total');


    if ( is_null( $this->jobs ) ) {

      $this->jobs = $this->session->get('demo');

      $sliders = $this->session->get('sliders');

      foreach ($sliders as $name => $url) {
        array_unshift( $this->jobs, array(
          'task' => 'Slider',
          'data' => array(
            'name' => $name,
            'url' => $url
        ) ) );
      }

      array_unshift( $this->jobs, array( 'task' => 'Cleanup', 'data' => array() ) );
      $this->jobs_total = count( $this->jobs );

    }

  }

  /**
   * Process the next job in the queue
   * @return none
   */
  public function nextJob() {

    $this->debugMessage = '';

    if ( 0 == count( $this->jobs ) )
      return true;

    // Get the next job
    $job = array_shift( $this->jobs );

    // Ensure an import method exists for the requested task
    $methodName = 'import' . $job['task'];

    if ( !method_exists( $this, $methodName ) )
      return new WP_Error( '__x__', 'Task does not have an import method: ' . $job['task'] );

    // Run the job
    $run = call_user_func_array( array( $this, $methodName ), array( $job['data'] ) );
    if ( is_wp_error( $run ) )
      return $run;


    $this->session->set( 'registry', $this->registry->all() );
    $this->save();
    $this->registry->save();

    if ( false === $run ) {
      $this->batchCount++;
      return $this->nextJob();
    }

    if ( $run != 'next' && $this->batchCount <= $this->maxBatchSize ) {
      $this->batchCount++;
      return $this->nextJob();
    } else {
      $this->batchCount = 0;
      return $run;
    }

  }


  public function message() {
    return $this->message;
  }

  public function debugMessage() {
    return $this->debugMessage;
  }

  /**
   * Get a percentage of completion
   * @return int 0-1 value
   */
  public function completion() {

    if ( empty( $this->jobs ) )
      return true;

    return array(
      'total' => $this->jobs_total,
      'remaining' => count($this->jobs),
      'ratio' => ( $this->jobs_total - count($this->jobs) ) / $this->jobs_total
    );

  }

  /**
   * Save our progress in the session.
   * Only persists when the session itself is saved
   * @return none;
   */
  public function save() {
    $this->session->set( 'jobs_total', $this->jobs_total );
    $this->session->set( 'jobs', $this->jobs );
  }

  /**
   * Job handler for cleanup.
   * This deletes any unmodified pages imported from other demos
   * @param  array $data unused
   * @return none
   */
  public function importCleanup( $data ) {

    global $wpdb;
    $cleanup = $wpdb->get_results( "SELECT p.ID,m.meta_value FROM {$wpdb->posts} AS p INNER JOIN {$wpdb->postmeta} AS m ON m.post_id = p.ID AND m.meta_key = 'x_demo_content'" );

    foreach ($cleanup as $item) {

      $split = explode( '|', $item->meta_value );

      if ( count( $split) != 2 || $this->namespace == $split[0] )
        continue;

      X_Demo_Import_Registry::deleteAll( 'post', $split[1] );
      wp_delete_post( $item->ID, 'x_demo_content' );

    }

    $this->message = __( 'Initializing...', '__x__');
    return 'next';
  }


  public function importSlider( $data ) {


    if (!class_exists('RevSliderSlider'))
      return false;



    if ( RevSliderSlider::isAliasExists( $data['name'] ) )
      return false;

    ob_start();

    try {
      $slider = new RevSliderSlider;
      $file = $this->tempDownload( $data['url'] );
      $slider->importSliderFromPost( true, true, $file );
    } catch (Exception $e) {
      return new WP_Error( '__x__', $e->getMessage() );
    }


    if ( file_exists( $file ) )
      unlink( $file );

    $this->debugMessage = ob_get_clean();

    $this->message = __('Revolution Slider downloaded...', '__x__');
    return 'text';
  }

  public function tempDownload( $url ) {

    $dir = wp_upload_dir();
    $temp = trailingslashit( $dir['basedir'] )  . basename( $url );
    file_put_contents( $temp, file_get_contents($url) );
    return $temp;

  }

  public function importImage( $data ) {

    if ( $this->registry->exists( 'image', $data['id'] ) ) {
      return false;
    }

    $download = download_url( $data['url'], 30 );

    if ( is_wp_error( $download ) )
      return $download;
    $file = array( 'name' => basename($data['url']), 'tmp_name' => $download );
    $results = wp_handle_sideload( $file, array( 'test_form' => false ) );

    if ( !empty( $results['error'] ) )
      return new WP_Error('__x__', 'Failed to sideload image: ' + $data['url'] );


    $name  = explode( '.', basename( $results['file'] ) );

    $newPost = wp_insert_attachment( array(
      'post_title' => sanitize_file_name( $name[0]),
      'post_content' => '',
      'post_type' => 'attachment',
      'post_mime_type' => $results['type'],
      'guid' => $results[ 'url' ]
    ), $results['file'] );

    if ( is_wp_error( $newPost ) )
      return $newPost;

    wp_update_attachment_metadata( $newPost, wp_generate_attachment_metadata( $newPost, $results['file'] ) );

    $results['post_id'] = (int) $newPost;

    $this->registry->set( 'image', $data['id'], $results );

    $this->message = sprintf( __('Downloading images...', '__x__'), basename( $results['url'] ) );
    return true;
  }

  public function updateTermMeta( $term_id, $meta ) {

    $option = 'taxonomy_' . $term_id;

    $term_meta = get_option( $option, array() );

    if ( is_array( $meta ) ) {
      foreach ($meta as $key => $value) {
        $term_meta[$key] = $value;
      }
    }

    update_option( $option, $term_meta );

  }

  public function importTerm( $term ) {


    if ( $term['taxonomy'] == 'nav_menu' )
      return new WP_Error( '__x__', 'Term importer should not be used to process menus.' );

    if ( $this->registry->exists( 'term', $term['term_id'] )  ) {
      return false;
    }

    $parent = $term['parent'];

    if ( $parent != 0 ) {
      $parent = $this->registry->get( 'term', $term['parent'] );
      if ( is_null( $parent ) )
        return new WP_Error( '__x__', 'Export file has hierarchical terms out of order. ');
    }

    $this->message = sprintf( __( 'Preparing taxonomies...', '__x__' ), $term['name'] );

    $existing_term = get_term_by( 'name', $term['name'], $term['taxonomy'] );

    if ( $existing_term != false ) {

      $term_id = (int) $existing_term->term_id;

      wp_update_term( $term_id, $term['taxonomy'], array(
        'description' => $term['description'],
        'slug' => $term['slug'],
        'parent' => $parent
      ));

      $this->updateTermMeta( $term_id, $term['meta'] );
      $this->registry->set( 'term', $term['term_id'], $term_id );

      return true;
    }

    $newTerm = wp_insert_term( $term['name'], $term['taxonomy'], array(
      'description' => $term['description'],
      'slug' => $term['slug'],
      'parent' => $parent
    ));

    if ( is_wp_error( $newTerm ) )
      return $newTerm;

    $this->updateTermMeta( $newTerm['term_id'], $term['meta'] );

    $this->registry->set( 'term', $term['term_id'], $newTerm['term_id'] );

    return true;
  }

  public function createAttachment( $post, $data ) {

      if ( !isset( $post['attachment_url'] ) ) {
        $this->debugMessage = "Attachment missing attachment_url: " . $post['ID'];
        return false;
      }

      $imageData = $this->registry->get( 'image', $this->findFirstImageID( $post['attachment_url'] ) );

      if ( is_null($imageData)) {
        $this->debugMessage = "Attachment not found in registry: " . $post['ID']. " | $id";
        return false;
      }

      $this->registry->set( 'post', $post['ID'], (int) $imageData['post_id'] );

      $this->message = sprintf( __( 'Attaching thumbnails...', '__x__' ), $post['post_title'] );
      return true;
  }

  public function importPost( $post ) {

    if ( $post['post_type'] == 'nav_menu_item' )
      return new WP_Error( '__x__', 'Post importer should not be used to process menu items.' );

    if ( $this->registry->get( 'post', $post['ID'] ) ) {

      if ( ! is_null( get_post( $post['ID'] ) ) ) {
        $this->skipPostMeta( $post['ID'] );
        return false;
      }

      $this->registry->delete( 'post', $post['ID'] );

    }

    $newPost = array();

    // Set pass-through keys. Strip anything set later.
    foreach ($post as $key => $value) {
      if (!in_array($key, array( 'ID', 'post_parent', 'post_content', 'terms', 'post_meta' ) ) )
        $newPost[$key] = $value;
    }


    if ( $post['post_type'] == 'attachment' )
      return $this->createAttachment( $post, $newPost );

    // Set content
    $newPost['post_content'] = ( isset( $post['post_content'] ) ) ? $this->normalizeContentURLs( $post['post_content'] ) : '';

    // Set Parent
    $parent = ( isset( $post['post_parent'] ) ) ? $post['post_parent'] : 0;

    if ( $parent != 0 ) {
      $parent = $this->registry->get( 'post', $post['post_parent'] );
      if ( is_null( $parent ) )
        return new WP_Error( '__x__', 'Export file has hierarchical posts out of order. ');
    }

    $newPost['post_parent'] = $parent;

    // Create it!
    $newPost = wp_insert_post( $newPost, true );

    if ( is_wp_error( $newPost ) )
      return $newPost;

    // Add terms to this post
    foreach ( $post['terms'] as $taxonomy => $termIDs ) {

      $newTermIDs = array();

      foreach ($termIDs as $termID) {
        $newTermIDs[] = (int) $this->registry->get( 'term', $termID );
      }


      $taxTermIDs = wp_set_object_terms( $newPost, $newTermIDs, $taxonomy );

      if ( is_wp_error( $taxTermIDs ) )
        return $taxTermIDs;
    }

    $this->registry->set( 'post', $post['ID'], (int) $newPost );

    $this->message = sprintf( __( 'Creating posts...', '__x__' ), $post['post_title'] );
    return true;

  }

  public function skipPostMeta( $id ) {
    $skipped = $this->session->get( 'skipped_post_meta' );
    if ( !is_array( $skipped ) )
      $skipped = array();
    $skipped[] = $id;
    $this->session->set( 'skipped_post_meta', $skipped );
  }

  public function isPostMetaSkipped( $id ) {
    $skipped = $this->session->get( 'skipped_post_meta' );
    return ( is_array( $skipped ) && in_array( $id, $skipped ) );
  }

  public function importPostMeta( $data ) {

    if ( $this->isPostMetaSkipped( $data['id'] ) )
      return false;

    $postID = $this->registry->get( 'post', $data['id'] );

    $post = get_post( $postID );

    if ( is_null( $post ) )
      return new WP_Error('__x__', "Could not locate post: $postID | " . $data['id'] );

    if ( is_wp_error( $post ) )
      return $post;

    foreach ($data['meta'] as $key => $value) {


      // Specific cases
      if ( '_thumbnail_id' == $key ) {
        if ( false === set_post_thumbnail( $post->ID, $this->registry->get( 'post', $value ) ) )
          $this->debugMessage = "Could not set thumbnail ($key) to post: {$post->ID} | attachment: $value";
        continue;
      }

      // General purpose
      $newValue = maybe_unserialize( $this->normalizeContentURLs( $value ) );

      // Skip existing values
      if ( get_post_meta( $post->ID, $key, $value ) == $newValue )
        continue;

      if ( false === update_post_meta( $post->ID, $key, $newValue ) )
        $this->debugMessage = "Could not add meta key ($key) to post: {$post->ID}";
    }

    // Flag this as disposable demo content.
    update_post_meta( $post->ID, 'x_demo_content', $this->namespace . '|' . $data['id'] );

    $this->message = sprintf( __( 'Adding post data...', '__x__' ), $post->post_title );
    return true;

  }

  public function importMenu( $menu ) {

    wp_delete_nav_menu( $menu['menu-name'] );

    $newMenu = wp_update_nav_menu_object( 0, $menu );

    if ( is_wp_error( $newTerm ) )
      return $newTerm;

    $this->registry->set( 'term', $menu['id'], (int) $newMenu );

    foreach ( $menu['items'] as $menuItem ) {

      $existing = $this->registry->get( 'post', $menuItem['id'] );

      if ( is_nav_menu_item( $existing ) ) {
        wp_delete_post( $existing, true );
      }

      if ( 'taxonomy' == $menuItem['menu-item-type'] ) {
        $menuItem['menu-item-object-id'] = $this->registry->get( 'term', $menuItem['menu-item-object-id'] );
      } elseif ( 'post_type' == $menuItem['menu-item-type'] ) {
        $menuItem['menu-item-object-id'] = $this->registry->get( 'post', $menuItem['menu-item-object-id'] );
      }


      if ( 0 != (int) $menuItem['menu-item-parent-id'] ) {
        $menuItem['menu-item-parent-id'] = $this->registry->get( 'post', $menuItem['menu-item-parent-id'] );
        if ( is_null( $menuItem['menu-item-parent-id'] ) )
          continue;
      }

      $newMenuItem = wp_update_nav_menu_item( $newMenu, 0, $menuItem );

      if ( is_wp_error( $newMenuItem ) )
        return $newMenuItem;

      $this->registry->set( 'post', $menuItem['id'], (int) $newMenuItem );

    }

    $this->message = sprintf( __( 'Creating menus...', '__x__' ), $menu['menu-name'] );
    return true;
  }

  public function importSidebar( $data ) {

    $sidebars_widgets = get_option('sidebars_widgets');

    foreach ($data as $sidebar => $widgets) {

      // Move existing widgets to inactive
      if( isset( $sidebars_widgets[$sidebar] ) && !empty($sidebars_widgets[$sidebar] ) ) {

        if ( !isset( $sidebars_widgets['wp_inactive_widgets'] ) )
          $sidebars_widgets['wp_inactive_widgets'] = array();

        foreach ( $sidebars_widgets[$sidebar] as $widget_id ) {
          $sidebars_widgets['wp_inactive_widgets'][] = $widget_id;
        }

        $sidebars_widgets[$sidebar] = array();

      }

      // Derived from https://github.com/stevengliebe/widget-importer-exporter
      foreach ($widgets as $widget) {

        if ( $widget['type'] == 'nav_menu' ) {
          $widget['meta']['nav_menu'] = $this->registry->get( 'term', $widget['meta']['nav_menu'] );
        }

        if ( $widget['type'] == 'text' ) {
          $widget['meta']['text'] = $this->normalizeContentURLs( $widget['meta']['text'] );
        }

        $default = array( '_multiwidget' => 1 );
        $allWidgets = get_option( 'widget_' . $widget['type'], $default ); // all instances for that widget ID base, get fresh every time
        if ( empty( $allWidgets ) )
          $allWidgets = $default;

        $allWidgets[] = $widget['meta'];

        end( $allWidgets );
        $newId = key( $allWidgets );

        if ( '0' === strval( $newId ) ) {
          $newId = 1;
          $allWidgets[$newId] = $allWidgets[0];
          unset( $allWidgets[0] );
        }

        if ( isset( $allWidgets['_multiwidget'] ) ) {
          $multiwidget = $allWidgets['_multiwidget'];
          unset( $allWidgets['_multiwidget'] );
          $allWidgets['_multiwidget'] = $multiwidget;
        }

        update_option( 'widget_' . $widget['type'], $allWidgets );

        $sidebars_widgets[$sidebar][] = $widget['type'] . '-' . $newId;

      }

    }

    update_option( 'sidebars_widgets', $sidebars_widgets );

    $this->message = 'Preparing sidebars...';
    return true;
  }


  public function importOptions( $data ) {

    if ( isset( $data['page_on_front'] ) ) {

      $postID = $key = $this->registry->get( 'post', $data['page_on_front'] );

      if ( !is_null( $postID ) )
        update_option('page_on_front', $postID );

      unset($data['page_on_front']);
    }

    if ( isset( $data['page_for_posts'] ) ) {

      $postID = $this->registry->get( 'post', $data['page_for_posts'] );

      if ( !is_null( $postID ) )
        update_option('page_for_posts', $postID );

      unset($data['page_for_posts']);
    }

    foreach ($data as $key => $value) {
      if ( false === update_option(  $key, maybe_unserialize( $this->normalizeContentURLs( $value ) ) ) )
        $this->debugMessage = "Could not set meta key ($key) to post: {$value}";
    }

    $this->message = __( 'Setting Customizer values...', '__x__' );

    x_bust_google_fonts_cache();

    return true;
  }

  public function importThemeMods( $mods ) {


    if (isset($mods['nav_menu_locations'])) {
      remove_theme_mod('nav_menu_locations');
      $normalizedLocations = array();
      foreach ( $mods['nav_menu_locations'] as $location => $id ) {
        $normalizedLocations[$location] = $this->registry->get( 'term', $id );
      }
      $mods['nav_menu_locations'] = $normalizedLocations;
    }

    foreach ($mods as $key => $value) {
      set_theme_mod( $key, $value);
    }

    $this->message = __( 'Assigning menus...', '__x__' );
    return true;
  }

  public function normalizeContentURLs( $content ) {
    return $this->normalizeImageURLs( $this->normalizeSiteURLs( $content ) );
  }

  public function normalizeSiteURLs( $content ) {

    if ( !is_string( $content ) ) {
      return $content;
    }

    return $this->strReplace( '{{xde:site:url}}', trailingslashit( home_url() ) , $content );

  }

  public function findImageIDs( $content ) {

    if ( !is_string( $content ) ) {
      return $content;
    }

    preg_match_all('#(?<={{img:).*?(?=:img}})#', $content, $matches);

    $ids = array();

    foreach ($matches[0] as $id) {
      $ids[] = $id;
    }

    return $ids;
  }

  public function findFirstImageID( $content ) {
    $ids = $this->findImageIDs( $content );
    return $ids[0];
  }

  public function normalizeImageURLs( $content ) {

    if ( !is_string( $content ) ) {
      return $content;
    }

    $ids = $this->findImageIDs( $content );

    foreach ($ids as $id) {
      $imageData = $this->registry->get( 'image', $id );
      if ( !is_null( $imageData) && isset( $imageData['url'] ) )
        $content = $this->strReplace( '{{img:' . $id . ':img}}', $imageData['url'] , $content );
    }

    return $content;
  }

  public function strReplace( $search, $replace, $subject ) {
    return ( is_serialized( $subject ) ) ? $this->deepStrReplace( $search, $replace, $subject ) : str_replace( $search, $replace, $subject );
  }

  public function deepStrReplace( $search, $replace, $subject ) {

    $replacer = new X_Demo_Import_SearchReplacer( $search, $replace, true );
    return $replacer->run( $subject );

  }


}


/**
 * Borrowed from WP CLI
 * https://github.com/wp-cli/wp-cli/blob/master/php/WP_CLI/SearchReplacer.php
 */

class X_Demo_Import_SearchReplacer {

  private $from, $to;
  private $recurse_objects;
  private $max_recursion;

  /**
   * @param string  $from            String we're looking to replace.
   * @param string  $to              What we want it to be replaced with.
   * @param bool    $recurse_objects Should objects be recursively replaced?
   */
  function __construct( $from, $to, $recurse_objects = false, $regex = false ) {
    $this->from = $from;
    $this->to = $to;
    $this->recurse_objects = $recurse_objects;
    $this->regex = $regex;
    $this->max_recursion = 0;
  }

  /**
   * Take a serialised array and unserialise it replacing elements as needed and
   * unserialising any subordinate arrays and performing the replace on those too.
   * Ignores any serialized objects unless $recurse_objects is set to true.
   *
   * @param array|string $data            The data to operate on.
   * @param bool         $serialised      Does the value of $data need to be unserialized?
   *
   * @return array       The original array with all elements replaced as needed.
   */
  function run( $data, $serialised = false ) {
    return $this->_run( $data, $serialised );
  }

  /**
   * @param int          $recursion_level Current recursion depth within the original data.
   * @param array        $visited_data    Data that has been seen in previous recursion iterations.
   */
  private function _run( $data, $serialised, $recursion_level = 0, &$visited_data = array() ) {

    // some unseriliased data cannot be re-serialised eg. SimpleXMLElements
    try {

      if ( $this->recurse_objects ) {

        // If we've reached the maximum recursion level, short circuit
        if ( $this->max_recursion != 0 && $recursion_level >= $this->max_recursion ) {
          return $data;
        }

        if ( is_array( $data ) || is_object( $data ) ) {
          // If we've seen this exact object or array before, short circuit
          if ( in_array( $data, $visited_data, true ) ) {
            return $data; // Avoid infinite loops when there's a cycle
          }
          // Add this data to the list of
          $visited_data[] = $data;
        }
      }

      if ( is_string( $data ) && ( $unserialized = @unserialize( $data ) ) !== false ) {
        $data = $this->_run( $unserialized, true, $recursion_level + 1 );
      }

      elseif ( is_array( $data ) ) {
        $keys = array_keys( $data );
        foreach ( $keys as $key ) {
          $data[ $key ]= $this->_run( $data[$key], false, $recursion_level + 1, $visited_data );
        }
      }

      elseif ( $this->recurse_objects && is_object( $data ) ) {
        foreach ( $data as $key => $value ) {
          $data->$key = $this->_run( $value, false, $recursion_level + 1, $visited_data );
        }
      }

      else if ( is_string( $data ) ) {
        if ( $this->regex ) {
          $data = preg_replace( "/$this->from/", $this->to, $data );
        } else {
          $data = str_replace( $this->from, $this->to, $data );
        }
      }

      if ( $serialised )
        return serialize( $data );

    } catch( Exception $error ) {

    }

    return $data;
  }
}