<?php
/*********************/
/* Post Type         */
/*********************/

add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

/* Create Metabox for Video Post Type */
$mukam_post_metabox = array(
    'youtube_link_url' => array(
        'title' => __('Video Link', 'mukam'),
        'applicableto' => 'post',
        'location' => 'normal',
        'display_condition' => 'post-format-video',
        'priority' => 'low',
        'fields' => array(
            'l_url' => array(
                'title' => __('YouTube Url:', 'mukam'),
                'type' => 'text',
                'description' => 'Paste your url, not embed code',
                'size' => 80
            ),

            'v_url' => array(
                'title' => __('Vimeo Url:', 'mukam'),
                'type' => 'text',
                'description' => 'Paste your url, not embed code',
                'size' => 80
            )
        )
    ),

    'audio_link_url' => array(
        'title' => __('Audio Link', 'mukam'),
        'applicableto' => 'post',
        'location' => 'normal',
        'display_condition' => 'post-format-audio',
        'priority' => 'low',
        'fields' => array(
            'a_url' => array(
                'title' => __('Soundcloud Widget Code:', 'mukam'),
                'type' => 'text',
                'description' => 'Paste your soundcloud widget code, not url',
                'size' => 100
            )
        )

    ),
);

add_action( 'admin_init', 'mukam_add_post_format_metabox' );
 
function mukam_add_post_format_metabox() {
    global $mukam_post_metabox;
 
    if ( !empty( $mukam_post_metabox ) ) {
        foreach ( $mukam_post_metabox as $id => $metabox ) {
            add_meta_box( $id, $metabox['title'], 'mukam_show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id );
        }
    }
}

/* Show Metabox */

function mukam_show_metaboxes( $post, $args ) {
    global $mukam_post_metabox;
 
    $custom = get_post_custom( $post->ID );
    $fields = $tabs = $mukam_post_metabox[$args['id']]['fields'];

    /** Nonce **/
    $output = '<input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';
 
    if ( sizeof( $fields ) ) {
        foreach ( $fields as $id => $field ) {
            switch ( $field['type'] ) {
                default:
                case "text":
                    if (empty($custom[$id][0])) { $custom[$id][0] = "";}
                    $output .= '<label for="' . $id . '">' . $field['title'] . '</label><br><input id="' . $id . '" type="text" name="' . $id . '" value="' . $custom[$id][0] . '" size="' . $field['size'] . '" /><br>'. $field['description'] . '<br><br>';
                    
                    break; 
            }
        }
    }
 
    echo $output;
}

/* Save Metabox */
add_action( 'save_post', 'mukam_save_metaboxes' );
 
function mukam_save_metaboxes( $post_id ) {
    global $mukam_post_metabox;
 
    // verify nonce
    if ( isset($_POST['post_format_meta_box_nonce']) && !wp_verify_nonce( $_POST['post_format_meta_box_nonce'], basename( __FILE__ ) ) )
        return $post_id;
 
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;
 
    // check permissions
    if ( 'page' == isset($_POST['post_type'] )) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
 
    $post_type = get_post_type();
 
    // loop through fields and save the data
    foreach ( $mukam_post_metabox as $id => $metabox ) {
        // check if metabox is applicable for current post type
        if ( $metabox['applicableto'] == $post_type ) {
            $fields = $mukam_post_metabox[$id]['fields'];
 
            foreach ( $fields as $id => $field ) {
                $old = get_post_meta( $post_id, $id, true );
                $new = $_POST[$id];
 
                if ( $new && $new != $old ) {
                    update_post_meta( $post_id, $id, $new );
                }
                elseif ( '' == $new && $old || !isset( $_POST[$id] ) ) {
                    delete_post_meta( $post_id, $id, $old );
                }
            }
        }
    }
}

/* Show Metabox to Format */

add_action( 'admin_print_scripts', 'mukam_display_metaboxes', 1000 );
function mukam_display_metaboxes() {
    global $mukam_post_metabox;
    if ( get_post_type() == "post" ) :
        ?>
        <script type="text/javascript">// <![CDATA[
            $ = jQuery;
 
            <?php
            $formats = $ids = array();
            foreach ( $mukam_post_metabox as $id => $metabox ) {
                array_push( $formats, "'" . $metabox['display_condition'] . "': '" . $id . "'" );
                array_push( $ids, "#" . $id );
            }
            ?>
 
            var formats = { <?php echo implode( ',', $formats );?> };
            var ids = "<?php echo implode( ',', $ids ); ?>";
            function displayMetaboxes() {
                // Hide all post format metaboxes
                $(ids).hide();
                // Get current post format
                var selectedElt = $("input[name='post_format']:checked").attr("id");
 
                // If exists, fade in current post format metabox
                if ( formats[selectedElt] )
                    $("#" + formats[selectedElt]).fadeIn();
            }
 
            $(function() {
                // Show/hide metaboxes on page load
                displayMetaboxes();
 
                // Show/hide metaboxes on change event
                $("input[name='post_format']").change(function() {
                    displayMetaboxes();
                });
            });
 
        // ]]></script>
        <?php
    endif;
}
/******************************/
/* mukam Video Post Function */
/******************************/

function mukam_video( $height ) {
    $video_url = get_post_meta( get_the_ID(), 'l_url', true );
    if ( !empty($video_url)) {
        $embed_url = explode("?v=", $video_url);
        $new_url = $embed_url[1];
        if (empty($embed_url[1])) { $embed_url[1]=""; }
        if ($embed_url != "") {?>
        <iframe width="100%" height="<?php echo $height;?>" src="http://www.youtube.com/embed/<?php echo $new_url; ?>?wmode=opaque" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><div class="blog-threeline"></div>
<?php   }}
    else {
        $video_url = get_post_meta( get_the_ID(), 'v_url', true );
        $embed_url = explode("com/", $video_url);
        if (empty($embed_url[1])) { $embed_url[1]=""; }
        $new_url = $embed_url[1];
        if ($new_url != "") {?> 
        <iframe width="100%" height="<?php echo $height;?>" src="http://player.vimeo.com/video/<?php echo $new_url; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><div class="blog-threeline"></div>
<?php   }}
}

/*******************************/
/* mukam Audio Post Function */
/******************************/

function mukam_audio () {
    $audio_url ="";
    $audio_url = get_post_meta ( get_the_ID(), 'a_url', true );
    if(!empty($audio_url)) {
    echo $audio_url;
    }
}

/********************************/
/* mukam Gallery Post Function  */
/*******************************/
function mukam_gallery ($id) {
    if(class_exists('MultiPostThumbnails')) { ?>
    <div class="post-slider">
    <ul class="slides">
        <?php 
        if ( has_post_thumbnail() ) { echo '<li>' . get_the_post_thumbnail($id) . '</li>'; }
        ?>
                <?php 
                   if (class_exists('MultiPostThumbnails')) : $image = MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'secondary-image'); endif; if(!empty($image)) { echo '<li>'.$image.'</li>';}
                   if (class_exists('MultiPostThumbnails')) : $image = MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'third-image'); endif; if(!empty($image)) { echo '<li>'.$image.'</li>';}
                   if (class_exists('MultiPostThumbnails')) : $image = MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'fourth-image'); endif; if(!empty($image)) { echo '<li>'.$image.'</li>';}
                   if (class_exists('MultiPostThumbnails')) : $image = MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'fifth-image'); endif; if(!empty($image)) { echo '<li>'.$image.'</li>';}
                   if (class_exists('MultiPostThumbnails')) : $image = MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'last-image'); endif; if(!empty($image)) { echo '<li>'.$image.'</li>';} 
                ?>
    </ul>
    </div><?php
    }
}