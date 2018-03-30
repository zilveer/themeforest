<?php

add_action( 'add_meta_boxes', 'pix_meta_box_add' );
function pix_meta_box_add()
{
    $post_types = array('page','post','portfolio','product','team');
    foreach ( $post_types as $post_type ) {
        
        if( $post_type != 'page' && $post_type != 'team' )
            add_meta_box( 'pix_page_template', 'Page template', 'pix_page_template', $post_type, 'side', 'high' );

        if( $post_type != 'team' )
            add_meta_box( 'pix_sidebar_content_box', 'Sidebar content', 'pix_sidebar_content_options', 'portfolio', 'normal', 'high' );
    
        add_meta_box( 'pix_page_options', 'Page options', 'pix_meta_page_options', $post_type, 'normal', 'high' );
    
        if( $post_type != 'team' )
            add_meta_box( 'pix_sidebar_select', 'Sidebars', 'pix_sidebar_meta', $post_type, 'side', 'high' );
    
        if( $post_type == 'portfolio' || $post_type == 'post'  )
            add_meta_box( 'pix_hide_featured_image', 'Featured image options', 'pix_hide_featured_image', $post_type, 'side', 'low' );
    
    }

}

function pix_hide_featured_image( $post )
{

    $values = get_post_custom( $post->ID );
    $post_type = get_post_type();
    $pix_hide_featured_image = isset( $values['pix_hide_featured_image'] ) ? esc_attr( $values['pix_hide_featured_image'][0] ) : '';
    wp_nonce_field( 'pix_hide_featured_image_nonce', 'pix_hide_featured_image_nonce' );
    ?>

    <div class="pix_meta_boxes">
        <p>
            <label for="pix_hide_featured_image"><?php _e('Hide the featured image on single post page','geode'); ?>:</label>
        </p>
        <p>
            <select name="pix_hide_featured_image" id="pix_hide_featured_image">
                <option value="" <?php selected( $pix_hide_featured_image, '' ); ?>><?php  _e('show','geode'); ?></option>
                <option value="on" <?php selected( $pix_hide_featured_image, 'on' ); ?>><?php  _e('hide','geode'); ?></option>
            </select>
        </p>

        <div class="clear"></div>
 
    </div><!-- .pix_meta_boxes -->
    <?php 
}

function pix_sidebar_content_options( $post )
{
    $values = get_post_custom( $post->ID );
    $post_type = get_post_type();
    $pix_sidebar_content = isset( $values['pix_sidebar_content'] ) ? esc_attr( $values['pix_sidebar_content'][0] ) : '';
    wp_nonce_field( 'pix_sidebar_content_nonce', 'pix_sidebar_content_nonce' );
    ?>
    <div class="pix_meta_boxes">
        <p>
            <label for="pix_sidebar_content"><?php _e('Replace sidebar with the post content','geode'); ?>:</label>
        </p>
        <p>
            <select name="pix_sidebar_content" id="pix_sidebar_content">
                <option value="" <?php selected( $pix_sidebar_content, '' ); ?>><?php _e('do not replace','geode'); ?></option>
                <option value="on" <?php selected( $pix_sidebar_content, 'on' ); ?>><?php _e('replace','geode'); ?></option>
            </select>
        </p>

        <div class="clear"></div>
      
    </div><!-- .pix_meta_boxes -->
    <?php   
}


function pix_meta_page_options( $post )
{
    $values = get_post_custom( $post->ID );
    $post_type = get_post_type();
    $pix_hidden_field = isset( $values['pix_hidden_field'] ) ? esc_attr( $values['pix_hidden_field'][0] ) : '';
    $pix_transparent_header = isset( $values['pix_transparent_header'] ) ? esc_attr( $values['pix_transparent_header'][0] ) : '';
    $pix_color_header = isset( $values['pix_color_header'] ) ? esc_attr( $values['pix_color_header'][0] ) : '';
    $pix_alt_logo_id = isset( $values['pix_alt_logo_id'] ) ? esc_attr( $values['pix_alt_logo_id'][0] ) : '';
    $pix_alt_logo_size = isset( $values['pix_alt_logo_size'] ) ? esc_attr( $values['pix_alt_logo_size'][0] ) : '';
    $pix_hide_title = isset( $values['pix_hide_title'] ) ? esc_attr( $values['pix_hide_title'][0] ) : '';
    $pix_color_title = isset( $values['pix_color_title'] ) ? esc_attr( $values['pix_color_title'][0] ) : '';
    $pix_page_bg = isset( $values['pix_page_bg'] ) ? esc_attr( $values['pix_page_bg'][0] ) : '';
    $pix_page_bg_id = isset( $values['pix_page_bg_id'] ) ? esc_attr( $values['pix_page_bg_id'][0] ) : '';
    $pix_page_bg_size = isset( $values['pix_page_bg_size'] ) ? esc_attr( $values['pix_page_bg_size'][0] ) : '';
    $pix_page_bg_mp4 = isset( $values['pix_page_bg_mp4'] ) ? esc_attr( $values['pix_page_bg_mp4'][0] ) : '';
    $pix_page_bg_ogg = isset( $values['pix_page_bg_ogg'] ) ? esc_attr( $values['pix_page_bg_ogg'][0] ) : '';
    $pix_page_bg_webm = isset( $values['pix_page_bg_webm'] ) ? esc_attr( $values['pix_page_bg_webm'][0] ) : '';
    $pix_page_bg_gmap = isset( $values['pix_page_bg_gmap'] ) ? esc_attr( $values['pix_page_bg_gmap'][0] ) : '';
    $pix_title_bg = isset( $values['pix_title_bg'] ) ? esc_attr( $values['pix_title_bg'][0] ) : '';
    $pix_title_bg_id = isset( $values['pix_title_bg_id'] ) ? esc_attr( $values['pix_title_bg_id'][0] ) : '';
    $pix_title_bg_size = isset( $values['pix_title_bg_size'] ) ? esc_attr( $values['pix_title_bg_size'][0] ) : '';
    $pix_title_bg_mp4 = isset( $values['pix_title_bg_mp4'] ) ? esc_attr( $values['pix_title_bg_mp4'][0] ) : '';
    $pix_title_bg_ogg = isset( $values['pix_title_bg_ogg'] ) ? esc_attr( $values['pix_title_bg_ogg'][0] ) : '';
    $pix_title_bg_webm = isset( $values['pix_title_bg_webm'] ) ? esc_attr( $values['pix_title_bg_webm'][0] ) : '';
    $pix_title_bg_gmap = isset( $values['pix_title_bg_gmap'] ) ? esc_attr( $values['pix_title_bg_gmap'][0] ) : '';
    $pix_enable_scroll_down = isset( $values['pix_enable_scroll_down'] ) ? esc_attr( $values['pix_enable_scroll_down'][0] ) : '';
    wp_nonce_field( 'pix_page_options_nonce', 'pix_page_options_nonce' );
    ?>
    <div class="pix_meta_boxes">
        <input type="hidden" name="pix_hidden_field" value="<?php echo $pix_hidden_field; ?>">
        
    <div id="geode_page_options_tabs" class="pix-ui-tabs">
      <ul>
        <li><a href="#geode_page_options_bg_sec_tab"><?php _e('Background','geode'); ?></a></li>
        <li><a href="#geode_page_options_header_sec_tab"><?php _e('Header','geode'); ?></a></li>
        <li><a href="#geode_page_options_title_sec_tab"><?php _e('Title section','geode'); ?></a></li>
        <li><a href="#geode_page_options_scrolldown_sec_tab"><?php _e('Scroll down','geode'); ?></a></li>
      </ul>
<?php
/****************************
*
* BACKGROUND SECTION
*
****************************/
?>    
      <div id="geode_page_options_bg_sec_tab">

<?php
/**************
* CUSTOM BG
**************/
?>    
        <p>
            <label for="pix_page_bg"><?php _e('Background','geode'); ?>:</label>
        </p>
        <p>
            <select name="pix_page_bg" id="pix_page_bg">
                <option value="" <?php selected( $pix_page_bg, '' ); ?>><?php _e('default','geode'); ?></option>
                <option value="none" <?php selected( $pix_page_bg, 'none' ); ?>><?php _e('none','geode'); ?></option>
                <option value="image" <?php selected( $pix_page_bg, 'image' ); ?>><?php _e('fixed image','geode'); ?></option>
                <option value="video" <?php selected( $pix_page_bg, 'video' ); ?>><?php _e('silent video loop','geode'); ?></option>
            </select>
        </p>

        <hr>

<?php
/**************
* IMG BG
**************/
?>
        <p>
            <label for="pix_page_bg_id"><?php _e('Background image','geode'); ?>:</label>
        </p>
        <p class="pix_upload upload_image">
            <input type="hidden" data-type="id" name="pix_page_bg_id" value="<?php echo $pix_page_bg_id; ?>">
            <input type="hidden" data-type="size" name="pix_page_bg_size" value="<?php echo $pix_page_bg_size; ?>">
            <span class="img_preview"></span>
            <span class="pix_set_img_links">
                <a class="pix_button" href="#"><?php _e('Set an image','geode'); ?></a><br>
                <a class="pix_remove_img" href="#"><?php _e('Remove the image','geode'); ?></a>
            </span>
        </p>

        <hr>

<?php
/**************
* VIDEO BG
**************/
?>
        <p>
            <label for="pix_page_bg_mp4"><?php _e('Background video (MP4)','geode'); ?>:</label>
        </p>
        <div class="pix_upload upload_video">
            <input type="text" name="pix_page_bg_mp4" value="<?php echo $pix_page_bg_mp4; ?>">
            <a class="pix_button" href="#"><?php _e('Insert a video','geode'); ?></a>
        </div>
        <p>
            <label for="pix_page_bg_ogg"><?php _e('Background video (OGG)','geode'); ?>:</label>
        </p>
        <div class="pix_upload upload_video">
            <input type="text" name="pix_page_bg_ogg" value="<?php echo $pix_page_bg_ogg; ?>">
            <a class="pix_button" href="#"><?php _e('Insert a video','geode'); ?></a>
        </div>
        <p>
            <label for="pix_page_bg_webm"><?php _e('Background video (WEBM)','geode'); ?>:</label>
        </p>
        <div class="pix_upload upload_video">
            <input type="text" name="pix_page_bg_webm" value="<?php echo $pix_page_bg_webm; ?>">
            <a class="pix_button" href="#"><?php _e('Insert a video','geode'); ?></a>
        </div>

        <br><hr>

      </div>
<?php
/****************************
*
* HEADER SECTION
*
****************************/
?>    
      <div id="geode_page_options_header_sec_tab">

<?php
/**************
* TRANSPARENT HEADER
**************/
?>    
        <p>
            <label for="pix_transparent_header"><?php _e('Transparent header','geode'); ?>:</label>
        </p>
        <p>
            <select name="pix_transparent_header" id="pix_transparent_header">
                <option value="" <?php selected( $pix_transparent_header, '' ); ?>><?php _e('regular header','geode'); ?></option>
                <option value="on" <?php selected( $pix_transparent_header, 'on' ); ?>><?php _e('transparent header','geode'); ?></option>
            </select>
               <br>
                <small style="max-width:600px; display:block"><?php _e('The transparent header has got some limitations, for instance in Webkit: if the element under the header is a slideshow with CSS3 transitions or a video, you won\'t be able to set border radius for your layout. The workarounds available have bad results on Retina displays','geode'); ?></small>
         </p>

        <hr>

<?php
/**************
* HEADER COLOR
**************/
?>    
        <p>
            <label for="pix_color_header"><?php _e('Transparent header general text color','geode'); ?>:
                <div class="pix_color_picker">
                    <input type="text" name="pix_color_header" value="<?php echo $pix_color_header; ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-iconic-cancel"></i>
                </div>
        </p>

        <hr>

<?php
/**************
* ALTERNATIVE LOGO
**************/
?>
        <p>
            <label for="pix_alt_logo_id"><?php _e('Transparent header logo','geode'); ?>:</label>
        </p>
        <p class="pix_upload upload_image">
            <input type="hidden" data-type="id" name="pix_alt_logo_id" value="<?php echo $pix_alt_logo_id; ?>">
            <input type="hidden" data-type="size" name="pix_alt_logo_size" value="<?php echo $pix_alt_logo_size; ?>">
            <span class="img_preview"></span>
            <span class="pix_set_img_links">
                <a class="pix_button" href="#"><?php _e('Set an image','geode'); ?></a><br>
                <a class="pix_remove_img" href="#"><?php _e('Remove the image','geode'); ?></a>
            </span>
        </p>

      </div>

<?php
/****************************
*
* TITLE SECTION
*
****************************/
?>    
      <div id="geode_page_options_title_sec_tab">

<?php
/**************
* HIDE TITLE
**************/
?>    
        <p>
            <label for="pix_hide_title"><?php _e('Hide title and breadcrumbs','geode'); ?>:</label>
        </p>
        <p>
            <select name="pix_hide_title" id="pix_hide_title">
                <option value="" <?php selected( $pix_hide_title, '' ); ?>><?php _e('show','geode'); ?></option>
                <option value="on" <?php selected( $pix_hide_title, 'on' ); ?>><?php _e('hide','geode'); ?></option>
            </select>
         </p>

        <hr>

<?php
/**************
* TEXT COLOR
**************/
?>    
        <p>
            <label for="pix_color_title"><?php _e('Text color','geode'); ?>:
                <div class="pix_color_picker">
                    <input type="text" name="pix_color_title" value="<?php echo $pix_color_title; ?>">
                    <a class="pix_button" href="#"></a>
                    <div class="colorpicker"></div>
                    <i class="scicon-iconic-cancel"></i>
                </div>
        </p>

        <hr>

<?php
/**************
* CUSTOM BG
**************/
?>    
        <p>
            <label for="pix_title_bg"><?php _e('Background','geode'); ?>:</label>
        </p>
        <p>
            <select name="pix_title_bg" id="pix_title_bg">
                <option value="" <?php selected( $pix_title_bg, '' ); ?>><?php _e('default','geode'); ?></option>
                <option value="none" <?php selected( $pix_title_bg, 'none' ); ?>><?php _e('none','geode'); ?></option>
                <option value="image" <?php selected( $pix_title_bg, 'image' ); ?>><?php _e('fixed image','geode'); ?></option>
                <option value="video" <?php selected( $pix_title_bg, 'video' ); ?>><?php _e('silent video loop','geode'); ?></option>
                <option value="googlemap" <?php selected( $pix_title_bg, 'googlemap' ); ?>><?php _e('Google map','geode'); ?></option>
            </select>
        </p>

        <hr>

<?php
/**************
* IMG BG
**************/
?>
        <p>
            <label for="pix_title_bg_id"><?php _e('Background image','geode'); ?>:</label>
        </p>
        <p class="pix_upload upload_image">
            <input type="hidden" data-type="id" name="pix_title_bg_id" value="<?php echo $pix_title_bg_id; ?>">
            <input type="hidden" data-type="size" name="pix_title_bg_size" value="<?php echo $pix_title_bg_size; ?>">
            <span class="img_preview"></span>
            <span class="pix_set_img_links">
                <a class="pix_button" href="#"><?php _e('Set an image','geode'); ?></a><br>
                <a class="pix_remove_img" href="#"><?php _e('Remove the image','geode'); ?></a>
            </span>
        </p>

        <hr>

<?php
/**************
* VIDEO BG
**************/
?>
        <p>
            <label for="pix_title_bg_mp4"><?php _e('Background video (MP4)','geode'); ?>:</label>
        </p>
        <div class="pix_upload upload_video">
            <input type="text" name="pix_title_bg_mp4" value="<?php echo $pix_title_bg_mp4; ?>">
            <a class="pix_button" href="#"><?php _e('Insert a video','geode'); ?></a>
        </div>
        <p>
            <label for="pix_title_bg_ogg"><?php _e('Background video (OGG)','geode'); ?>:</label>
        </p>
        <div class="pix_upload upload_video">
            <input type="text" name="pix_title_bg_ogg" value="<?php echo $pix_title_bg_ogg; ?>">
            <a class="pix_button" href="#"><?php _e('Insert a video','geode'); ?></a>
        </div>
        <p>
            <label for="pix_title_bg_webm"><?php _e('Background video (WEBM)','geode'); ?>:</label>
        </p>
        <div class="pix_upload upload_video">
            <input type="text" name="pix_title_bg_webm" value="<?php echo $pix_title_bg_webm; ?>">
            <a class="pix_button" href="#"><?php _e('Insert a video','geode'); ?></a>
        </div>

        <br><hr>

<?php
/**************
* Google map
**************/
?>
        <p>
            <label for="pix_title_bg_gmap"><?php _e('Google map bg','geode'); ?>:</label>
        </p>
        <div class="pix_upload upload_gmap">
            <input type="text" name="pix_title_bg_gmap" value="<?php echo $pix_title_bg_gmap; ?>">
            <a class="pix_button pix_googlemap_bg" href="#"><?php _e('Insert a Google map','geode'); ?></a>
        </div>

      </div>
<?php
/****************************
*
* SCROLL DOWN
*
****************************/
?>    
      <div id="geode_page_options_scrolldown_sec_tab">
        <p>
            <label for="pix_enable_scroll_down"><?php _e('Enable the scrolldown button','geode'); ?>:</label>
        </p>
        <p>
            <select name="pix_enable_scroll_down" id="pix_enable_scroll_down">
                <option value="" <?php selected( $pix_enable_scroll_down, '' ); ?>><?php _e('disable','geode'); ?></option>
                <option value="on" <?php selected( $pix_enable_scroll_down, 'on' ); ?>><?php _e('enable','geode'); ?></option>
            </select>
         </p>
      </div>

    </div>
        
        <div class="clear"></div>
 
    </div><!-- .pix_meta_boxes -->
    <?php   
}


add_action( 'save_post', 'pix_meta_page_options_save' );
add_action( 'publish_post', 'pix_meta_page_options_save' );
function pix_meta_page_options_save( $post_id )
{
    if( isset( $_POST['pix_sidebar_content'] ) ) {
        update_post_meta( $post_id, 'pix_sidebar_content', esc_attr( $_POST['pix_sidebar_content'] ) );
    }
    if( isset( $_POST['pix_hide_featured_image'] ) ) {
        update_post_meta( $post_id, 'pix_hide_featured_image', esc_attr( $_POST['pix_hide_featured_image'] ) );
    }
    if( isset( $_POST['pix_transparent_header'] ) ) {
        update_post_meta( $post_id, 'pix_transparent_header', esc_attr( $_POST['pix_transparent_header'] ) );
    }
    if( isset( $_POST['pix_color_header'] ) ) {
        update_post_meta( $post_id, 'pix_color_header', esc_attr( $_POST['pix_color_header'] ) );
    }
    if( isset( $_POST['pix_alt_logo_id'] ) ) {
        update_post_meta( $post_id, 'pix_alt_logo_id', esc_attr( $_POST['pix_alt_logo_id'] ) );
    }
    if( isset( $_POST['pix_alt_logo_size'] ) ) {
        update_post_meta( $post_id, 'pix_alt_logo_size', esc_attr( $_POST['pix_alt_logo_size'] ) );
    }
    if( isset( $_POST['pix_hide_title'] ) ) {
        update_post_meta( $post_id, 'pix_hide_title', esc_attr( $_POST['pix_hide_title'] ) );
    }
    if( isset( $_POST['pix_enable_scroll_down'] ) ) {
        update_post_meta( $post_id, 'pix_enable_scroll_down', esc_attr( $_POST['pix_enable_scroll_down'] ) );
    }
    if( isset( $_POST['pix_color_title'] ) ) {
        update_post_meta( $post_id, 'pix_color_title', esc_attr( $_POST['pix_color_title'] ) );
    }
    if( isset( $_POST['pix_page_bg'] ) ) {
        update_post_meta( $post_id, 'pix_page_bg', esc_attr( $_POST['pix_page_bg'] ) );
    }
    if( isset( $_POST['pix_page_bg_id'] ) ) {
        update_post_meta( $post_id, 'pix_page_bg_id', esc_attr( $_POST['pix_page_bg_id'] ) );
    }
    if( isset( $_POST['pix_page_bg_size'] ) ) {
        update_post_meta( $post_id, 'pix_page_bg_size', esc_attr( $_POST['pix_page_bg_size'] ) );
    }
    if( isset( $_POST['pix_page_bg_mp4'] ) ) {
        update_post_meta( $post_id, 'pix_page_bg_mp4', esc_attr( $_POST['pix_page_bg_mp4'] ) );
    }
    if( isset( $_POST['pix_page_bg_ogg'] ) ) {
        update_post_meta( $post_id, 'pix_page_bg_ogg', esc_attr( $_POST['pix_page_bg_ogg'] ) );
    } 
    if( isset( $_POST['pix_page_bg_webm'] ) ) {
        update_post_meta( $post_id, 'pix_page_bg_webm', esc_attr( $_POST['pix_page_bg_webm'] ) );
    }    
    if( isset( $_POST['pix_page_bg_gmap'] ) ) {
        update_post_meta( $post_id, 'pix_page_bg_gmap', esc_attr( $_POST['pix_page_bg_gmap'] ) );
    }
    if( isset( $_POST['pix_title_bg'] ) ) {
        update_post_meta( $post_id, 'pix_title_bg', esc_attr( $_POST['pix_title_bg'] ) );
    }
    if( isset( $_POST['pix_title_bg_id'] ) ) {
        update_post_meta( $post_id, 'pix_title_bg_id', esc_attr( $_POST['pix_title_bg_id'] ) );
    }
    if( isset( $_POST['pix_title_bg_size'] ) ) {
        update_post_meta( $post_id, 'pix_title_bg_size', esc_attr( $_POST['pix_title_bg_size'] ) );
    }
    if( isset( $_POST['pix_title_bg_mp4'] ) ) {
        update_post_meta( $post_id, 'pix_title_bg_mp4', esc_attr( $_POST['pix_title_bg_mp4'] ) );
    }
    if( isset( $_POST['pix_title_bg_ogg'] ) ) {
        update_post_meta( $post_id, 'pix_title_bg_ogg', esc_attr( $_POST['pix_title_bg_ogg'] ) );
    }   
    if( isset( $_POST['pix_title_bg_webm'] ) ) {
        update_post_meta( $post_id, 'pix_title_bg_webm', esc_attr( $_POST['pix_title_bg_webm'] ) );
    }     
    if( isset( $_POST['pix_title_bg_gmap'] ) ) {
        update_post_meta( $post_id, 'pix_title_bg_gmap', esc_attr( $_POST['pix_title_bg_gmap'] ) );
    }

}

function pix_page_template( $post )
{
    global $typenow;
    if ( empty( $typenow ) && !empty( $_GET['post'] ) ) {
        $post = get_post( $_GET['post'] );
        $typenow = $post->post_type;
    } elseif ( empty( $typenow ) && !empty( $_GET['post_type'] ) ) {
        $typenow = $_GET['post_type'];
    }
    
    $values = get_post_custom( $post->ID );
    $selected = isset( $values['pix_page_template_select'] ) ? esc_attr( $values['pix_page_template_select'][0] ) : '';

    wp_nonce_field( 'pix_page_template_nonce', 'pix_page_template_nonce' );
    ?>  
    <div class="pix_meta_boxes">
        <label for="pix_page_template_select"><?php _e('Template','geode'); ?></label>
        <p>
            <select name="pix_page_template_select" id="pix_page_template_select">
                <option value='' <?php echo selected( $selected, '' ); ?>><?php _e('Inherit','geode'); ?></option>
                <option value='default' <?php echo selected( $selected, 'default' ); ?>><?php _e('Default Template','geode'); ?></option>
                <option value='templates/wide-page.php' <?php echo selected( $selected, 'templates/wide-page.php' ); ?>><?php _e('Wide Page Template','geode'); ?></option>
                <option value='templates/double-side-page.php' <?php echo selected( $selected, 'templates/double-side-page.php' ); ?>><?php _e('Double sidebar Page Template','geode'); ?></option>
            </select>
        </p>
    </div><!-- .pix_meta_boxes -->
    <?php   
}


add_action( 'save_post', 'pix_page_template_save' );
function pix_page_template_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['pix_page_template_nonce'] ) || !wp_verify_nonce( $_POST['pix_page_template_nonce'], 'pix_page_template_nonce' ) ) return;
    
    // if our current user can't edit this post, bail
    if( current_user_can( 'edit_post', $post_id ) ) {   
        if( isset( $_POST['pix_page_template_select'] ) )
            update_post_meta( $post_id, 'pix_page_template_select', esc_attr( $_POST['pix_page_template_select'] ) );
    }
}

function pix_sidebar_meta( $post )
{
    $values = get_post_custom( $post->ID );
    $selected = isset( $values['pix_sidebar_select'] ) ? esc_attr( $values['pix_sidebar_select'][0] ) : '';
    $selected_2 = isset( $values['pix_sidebar_select_2'] ) ? esc_attr( $values['pix_sidebar_select_2'][0] ) : '';
    wp_nonce_field( 'pix_sidebar_select_nonce', 'pix_sidebar_select_nonce' );
    ?>  
    <div class="pix_meta_boxes">
        <label for="pix_sidebar_select"><?php _e('Select a sidebar', 'geode'); ?></label>
        <p>
            <select name="pix_sidebar_select" id="pix_sidebar_select">
                <option value="" <?php selected( $selected, '' ); ?>><?php _e('Inherit', 'geode'); ?></option>
                <option value="none" <?php selected( $selected, 'none' ); ?>><?php _e('None', 'geode'); ?></option>
                <?php
                $get_sidebar_options = $GLOBALS['wp_registered_sidebars'];

                foreach ($get_sidebar_options as $sidebar) {
                    echo '<option value="'.ucwords( $sidebar['id'] ).'" '.selected( $selected, ucwords( $sidebar['id'] ), false ).'>'.ucwords( $sidebar['name'] ).'</option>';
                }
                ?>
            </select>
        </p>

        <label for="pix_sidebar_select_2">Select a secondary sidebar</label>
        <p>
            <select name="pix_sidebar_select_2" id="pix_sidebar_select_2">
                <option value="" <?php selected( $selected_2, '' ); ?>><?php _e('Inherit', 'geode'); ?></option>
                <option value="none" <?php selected( $selected_2, 'none' ); ?>><?php _e('None', 'geode'); ?></option>
                <?php
                foreach ($get_sidebar_options as $sidebar) {
                    echo '<option value="'.ucwords( $sidebar['id'] ).'" '.selected( $selected_2, ucwords( $sidebar['id'] ), false ).'>'.ucwords( $sidebar['name'] ).'</option>';
                }
                ?>
            </select>
        </p>
    </div><!-- .pix_meta_boxes -->
    <?php   
}


add_action( 'save_post', 'pix_sidebar_meta_save' );
function pix_sidebar_meta_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['pix_sidebar_select_nonce'] ) || !wp_verify_nonce( $_POST['pix_sidebar_select_nonce'], 'pix_sidebar_select_nonce' ) ) return;
    
    // if our current user can't edit this post, bail
    if( current_user_can( 'edit_post', $post_id ) ) {
        if( isset( $_POST['pix_sidebar_select'] ) )
            update_post_meta( $post_id, 'pix_sidebar_select', esc_attr( $_POST['pix_sidebar_select'] ) );
        if( isset( $_POST['pix_sidebar_select_2'] ) )
            update_post_meta( $post_id, 'pix_sidebar_select_2', esc_attr( $_POST['pix_sidebar_select_2'] ) );
    }
}

/*=========================================================================================*/

