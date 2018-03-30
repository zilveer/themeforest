<?php
/**
 * Makes theme quick uploaders for portfolios slideshows etc
 *
 * @package Smartbox
 * @subpackage Admin
 * @since 0.1
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

/**
* Quick Uploader Generator
*/
class OxyQuickUpload {
    private $_uploaders;

    function __construct() {
        if( is_admin() ) {
            // get uploader options
            $this->_uploaders = include OPTIONS_DIR . 'quick-uploaders/quick-uploaders.php';
            // set actions
            add_action( 'admin_menu', array( &$this, 'admin_menu' ), 10 );
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        }
    }

    function admin_enqueue_scripts() {
        // load needed js and css
        if( $this->_uploaders !== null && isset( $_GET['page'] ) ) {
            foreach( $this->_uploaders as $post_type => $options ) {
                if( $_GET['page'] == $post_type . '-quick' ) {
                    wp_enqueue_style( 'oxy-quick-uploader', ADMIN_CSS_URI . 'quick-uploader/quick-uploader.css' );
                }
            }
        }
    }

    function admin_menu() {
        if( $this->_uploaders !== null ) {
            foreach( $this->_uploaders as $post_type => $options ) {
                add_submenu_page( 'edit.php?post_type=' . $post_type, $options['page_title'], $options['menu_title'], 'manage_options', $post_type . '-quick', array( &$this, 'render_uploader' ) );
            }
        }
    }

    function render_uploader() {
        if( isset( $_GET['post_type'] ) ) {
            $post_type = $_GET['post_type'];
            if( isset( $this->_uploaders[$post_type] ) ) {
                $options = $this->_uploaders[$post_type];
                if( isset( $_POST['sub_page'] ) ) {
                    switch( $_POST['sub_page'] ) {
                        case 'create_posts':
                            $this->create_posts( $post_type, $options );
                        break;
                        case 'build':
                            $this->build( $post_type, $options );
                            $this->select_images_page( $post_type, $options );
                        break;
                    }
                }
                else {
                    $this->select_images_page( $post_type, $options );
                }
            }
        }
    }

    function select_images_page( $post_type, $options ) {
        // remove browser upload option
        remove_all_actions( 'post-plupload-upload-ui' );

        if (!current_user_can('upload_files'))
            wp_die(__('You do not have permission to upload files.', THEME_ADMIN_TD));

        wp_enqueue_script('plupload-handlers');
        wp_enqueue_script('image-edit');
        wp_enqueue_script('set-post-thumbnail' );
        wp_enqueue_style('imgareaselect');

        @header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));

        // IDs should be integers
        $ID = isset($ID) ? (int) $ID : 0;
        $post_id = isset($post_id)? (int) $post_id : 0;

        // Require an ID for the edit screen
        if ( isset($action) && $action == 'edit' && !$ID )
            wp_die(__('You are not allowed to be here', THEME_ADMIN_TD));

        $errors = array();

        if( isset($_POST['html-upload']) && !empty($_FILES) ) {
            check_admin_referer('media-form');
            // Upload File button was clicked
            $id = media_handle_upload('async-upload', $_REQUEST['post_id']);
            unset($_FILES);
            if( is_wp_error($id) ) {
                $errors['upload_error'] = $id;
                $id = false;
            }
        }

        if( isset($_GET['upload-page-form']) ) {
            $errors = array_merge($errors, (array) media_upload_form_handler());

            $location = 'upload.php';
            if ( $errors )
                $location .= '?message=3';

            wp_redirect( admin_url($location) );
            exit;
        }

        $title = __('Upload New Media', THEME_ADMIN_TD);
        $parent_file = 'upload.php';

        require_once('./admin-header.php');

        $form_class = 'media-upload-form type-form validate';

        if ( get_user_setting('uploader') )
            $form_class .= ' html-uploader';
        ?>
        <div class="wrap">
        <?php screen_icon(); ?>
        <h2><?php echo esc_html( $title ); ?></h2>

        <form enctype="multipart/form-data" method="post" action="<?php echo admin_url('edit.php?post_type=' . $post_type . '&amp;page=' . $post_type . '-quick'); ?>" class="<?php echo $form_class; ?>" id="file-form">

        <?php media_upload_form(); ?>

        <script type="text/javascript">
        jQuery(function($){
            var preloaded = $(".media-item.preloaded");
            if ( preloaded.length > 0 ) {
                preloaded.each(function(){prepareMediaItem({id:this.id.replace(/[^0-9]/g, '')},'');});
            }
            updateMediaForm();
            post_id = 0;
            shortform = 1;
        });
        </script>
        <input type="hidden" name="post_id" id="post_id" value="0" />
        <input type="hidden" name="sub_page" value="create_posts" />
        <?php wp_nonce_field('media-form'); ?>
        <div id="media-items" class="hide-if-no-js"></div>
        <?php submit_button( __( 'Use these images', THEME_ADMIN_TD ), 'button savebutton', 'save' ); ?>
        </form>
        </div>

        <?php
    }

    function create_posts( $post_type, $options ) {
?>
        <div class="wrap oxy-quick-uploader">
            <div class="icon32">
                <img src="<?php echo ADMIN_ASSETS_URI . 'images/oxygenna.png' ?>" alt="Oxygenna logo">
            </div>
            <h2><?php echo get_admin_page_title(); ?></h2>
            <form action="<?php echo admin_url('edit.php?post_type=' . $post_type . '&amp;page=' . $post_type . '-quick'); ?>" method="POST" accept-charset="utf-8" class="oxy-options">
                <div id="poststuff">
                   <?php
                    $count = 1;
                    foreach( $_POST['attachments'] as $id => $image ) {
                        $this->create_image_post( $id, $options, $count );
                        $count++;
                    }
                    ?>
                    <div id="post-body" class="metabox-holder columns-2">
                        <div id="post-body-content">
                            <input type="hidden" name="sub_page" value="build" />
                            <?php submit_button( __('Save', THEME_ADMIN_TD) . ' ' .$options['item_plural'] ); ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

    function create_image_post( $id, $options, $count ) {
        ?>
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <div id="titlediv">
                    <div id="titlewrap">
                        <input type="text" name="media_title[]" size="30" value="" id="title" autocomplete="off" placeholder="Enter title here">
                    </div>
                </div>
                <input type="hidden" name="media_attachment_id[]" value="<?php echo $id; ?>" />
                <div class="editor">
                    <?php
                        if( isset( $options['show_editor'] ) ) {
                            $args = array( 'textarea_rows' => 5, 'textarea_name' => 'media_text[]', 'media_buttons' => false, 'teeny' => true );
                            wp_editor( '', 'media_text_' . $id, $args );
                        }
                    ?>
                </div>
            </div>

            <div id="postbox-container-1" class="postbox-container">
                <div id="side-sortables" class="meta-box-sortables ui-sortable">
                    <div class="postbox widget">
                        <h3 class="hndle">Image</h3>
                        <div class="image-thumb">
                            <?php echo wp_get_attachment_image( $id, 'medium', array( 'class' => 'quick-upload-image' ) ); ?>
                        </div>
                    </div>
                    <div class="postbox">
                        <h3 class="hndle">Order</h3>
                        <div class="inside">
                            <div class="menu-order">
                                <label>Order</label>
                                <input type="text" name="menu_order[]" value="<?php echo $count; ?>"/>
                            </div>
                        </div>
                    </div>
                    <?php if( isset( $options['taxonomies'] ) ) : ?>
                    <?php foreach( $options['taxonomies'] as $taxonomy ) : ?>
                    <?php $taxonomy_data = get_categories( array( 'hide_empty' => false, 'taxonomy' => $taxonomy ) ); ?>
                    <?php $taxonomy_info = get_taxonomy( $taxonomy ); ?>
                    <div class="postbox">
                        <h3 class="hndle"><?php echo $taxonomy_info->labels->name ?></h3>
                        <div class="inside">
                            <ul class="categorychecklist form-no-clear" >
                                <?php foreach( $taxonomy_data as $data ) : ?>
                                <li>
                                    <label class="selectit">
                                        <input value="<?php echo $data->cat_ID; ?>" type="checkbox" name="<?php echo $data->taxonomy; ?>[<?php echo $id; ?>][]">
                                        <?php echo $data->name; ?>
                                    </label>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }

    function build( $post_type, $options ) {
        // create new posts for each slide
        for( $i = 0 ; $i < count( $_POST['media_attachment_id'] ) ; $i++ ) {
            $current_user = wp_get_current_user();
            $media_id = $_POST['media_attachment_id'][$i];
            $new_post = array(
                'post_status' => 'publish',
                'post_type' => $post_type,
                'post_author' => $current_user->ID,
                'post_title' => $_POST['media_title'][$i],
                'menu_order' => $_POST['menu_order'][$i],
            );

            if( isset( $_POST['media_text'] ) ) {
                $new_post['post_content'] = $_POST['media_text'][$i];
            }

            // create post
            $id = wp_insert_post( $new_post );
            if( $id != 0 ) {
                // add image as featured image
                add_post_meta( $id, '_thumbnail_id', $_POST['media_attachment_id'][$i] );
                // add to taxonomies
                if( isset( $options['taxonomies'] ) ) {
                    foreach( $options['taxonomies'] as $taxonomy ) {
                        if( isset( $_POST[$taxonomy] ) ) {
                            wp_set_post_terms( $id, $_POST[$taxonomy][$media_id], $taxonomy );
                        }
                    }
                }
            }
        }

        echo '<div id="message" class="updated fade"><p><strong>' . sprintf(__('Created %d %s', THEME_ADMIN_TD), count( $_POST['media_attachment_id'] ), $options['item_plural'] ) . '</strong></p></div>';
    }
}

$quick_uploader = new OxyQuickUpload();