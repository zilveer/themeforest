<?php
/**
 * Created by PhpStorm.
 * User: cb-theme
 * Date: 06.12.13
 * Time: 16:10
 */

function is_serial($string) {
    return (@unserialize($string) !== false);
}
/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
add_action( 'post_edit_form_tag' , 'post_edit_form_tag' );

function post_edit_form_tag( ) {
    echo ' enctype="multipart/form-data"';
}

function cb_page_new_meta_box_save($post_id)
{

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */


    // Check if our nonce is set.
    if (!isset($_POST['cb_page_new_meta_box_nonce']))
        return $post_id;

    $nonce = $_POST['cb_page_new_meta_box_nonce'];

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($nonce, 'cb_page_new_meta_box'))
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    // Check the user's permissions.
    if ('page' == $_POST['post_type']) {

        if (!current_user_can('edit_page', $post_id))
            return $post_id;

    } else {

        if (!current_user_can('edit_post', $post_id))
            return $post_id;
    }

    /* OK, its safe for us to save the data now. */

    $data = $_POST;
    $screen = get_current_screen();

 
    update_post_meta($post_id, '_cb5_post_options', $data['_cb5_post_options']);
    if ($screen->post_type == 'post'){ 
    update_post_meta($post_id, '_cb5_post_type', esc_attr($data['_cb5_post_type']));
    update_post_meta($post_id, '_cb5_blog', $data['_cb5_blog']);
    update_post_meta($post_id, '_cb5_portfolio', $data['_cb5_portfolio']);
    update_post_meta($post_id, '_cb5_gallery', $data['_cb5_gallery']);
    update_post_meta($post_id, '_cb5_video', $data['_cb5_video']);
    update_post_meta($post_id, '_cb5_audio', $data['_cb5_audio']);
    update_post_meta($post_id, '_cb5_slider', $data['_cb5_slider']);
    }
    

    update_post_meta($post_id, '_cb5_header', $data['_cb5_header']);

    update_post_meta($post_id, '_cb5_sidebar_position', $data['_cb5_sidebar_position']);
    update_post_meta($post_id, '_cb5_sidebar', $data['_cb5_sidebar']);

    if(isset($_POST['att_id'])) {
        foreach($_POST['att_id'] as $img_index => $img_id ) {
            $a = array('ID' => $img_id,'menu_order' => $img_index);
            wp_update_post($a);
        }}
    if(isset($_POST['att_id_del'])) {
        $img_old='';
        foreach($_POST['att_id_del'] as $img_index => $img_id ) {
            if($img_old!=$img_id){
                if(substr($img_id,-6)=='delete') wp_delete_attachment(substr($img_id,0,-6));
            }
            $img_old=$img_id;
        }}

    if(isset($_POST['export_settings'])) {
        error_reporting(E_ERROR | E_PARSE);



        $change = array(" ", ",",".");
        $name = str_replace($change, "_", preg_replace('/[^\00-\255]+/u', '', strtolower(get_the_title($post_id)).'_'.$post_id));
        Header('Content-Disposition: attachment; filename="'.$name.'.cbtheme"');
        //Header('Content-type: text/xml');
        print( serialize(get_post_meta($post_id)));


    }
if (get_option('cb5_enable_export')=='yes'){
    $change = array(" ", ",",".");

    $name = str_replace($change, "_", preg_replace('/[^\00-\255]+/u', '', strtolower(get_the_title($post_id)).'_'.$post_id));
   // $upload = wp_upload_bits($name.'.cbtheme', null, serialize(get_post_meta($post_id)));
    $upload_dir = wp_upload_dir();

    $File = $upload_dir['path'].'/'.$name.'.cbtheme';
    $url = $upload_dir['url'].'/'.$name.'.cbtheme';
    $Handle = fopen($File, 'w');
    $Data = serialize(get_post_meta($post_id));
    fwrite($Handle, $Data);
    fclose($Handle);
    update_post_meta($post_id, '_cb5_export_filename', $url);
}

    if(isset($_POST['import_settings'])) {

    if (isset($_FILES["import_file"]) && $_FILES["import_file"]["error"] == 0){
        if (file_exists($_FILES["import_file"]["tmp_name"])) {

            $file=unserialize(file_get_contents($_FILES["import_file"]["tmp_name"]));

            foreach ($file as $key=>$value){
                if($key=='blocks' && $data['import_blocks']=='no') continue;
                if($data['import_page_settings']=='no' && $key!='blocks')   continue;
                if($key!='_edit_lock' && $key!='_edit_last'){
                    if(is_array($value)){
                        if (is_serial($value[0]))
                        update_post_meta($post_id,$key,unserialize($value[0]));
                        else
                        update_post_meta($post_id,$key,$value[0]);
                    }
                    else update_post_meta($post_id,$key,$value);
                }

                    //print_r( $key.' => '.$value );
            }

        }
    }
    }





}



add_action('save_post', 'cb_page_new_meta_box_save');

/*add css and js to head*/
add_action('admin_head', 'cb_page_config_head');
function cb_page_config_head()
{
    $screen = get_current_screen();
    global $custom_posttypes;
    $screens = array_map('cb_getType', $custom_posttypes);
    $screens[]='post';
    $screens[]='page';
    $screens[]='product';
    if (in_array($screen->post_type,$screens)) {


        wp_enqueue_style('simple-slider',WP_THEME_URL . '/inc/assets/css/simple-slider.css');
        wp_enqueue_style('post-config',WP_THEME_URL . '/inc/assets/css/cb-post-config.css');
        wp_enqueue_script('simple-slider',WP_THEME_URL.'/inc/assets/js/simple-slider.min.js',array('jquery'),'1.0',true);


        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script('post-config',WP_THEME_URL.'/inc/assets/js/cb-post-config.js',array('jquery'),'1.0',true);

    }

}

function cb_page_config_meta_box()
{


    global $custom_posttypes;
    $screens = array_map('cb_getType', $custom_posttypes);
    $screens[]='post';
    $screens[]='page';
    $screens[]='product';
    foreach ($screens as $screen) {

        add_meta_box(
            'cb_page_new_meta_box',
            __('cb-theme General Manager', 'cb-modello'),
            'cb_page_new_meta_box',
            $screen
        );
        add_meta_box(
            'cb_sidebar_new_meta_box',
            __('cb-theme Sidebars', 'cb-modello'),
            'cb_sidebar_new_meta_box',
            $screen,'side','default'
        );
    }
}

add_action('add_meta_boxes', 'cb_page_config_meta_box');


function cb_sidebar_new_meta_box($post)
{
    $meta_box_value = get_post_meta($post->ID,'_cb5_sidebar_position',true);
    $meta_box_value2 = get_post_meta($post->ID,'_cb5_sidebar',true);

    global $wp_registered_sidebars;
    $sidebars = $wp_registered_sidebars;

    if($meta_box_value=='left') $sl='class="sel"'; else $sl='';
    if($meta_box_value=='none') $sn='class="sel"'; else $sn='';
    if($meta_box_value=='right') $sr='class="sel"'; else $sr='';
echo '
    <div class="fl" id="sideb_left" ><img src="'.WP_THEME_URL.'/inc/assets/images/admin_images/lcol.png" alt="left column" title="left column" '.$sl.' data-position="left"/></div>
    <div class="fl" id="sideb_none" ><img src="'.WP_THEME_URL.'/inc/assets/images/admin_images/none.png" alt="full width" title="full width"   '.$sn.' data-position="none"/></div>
    <div class="fl" id="sideb_right" ><img src="'.WP_THEME_URL.'/inc/assets/images/admin_images/rcol.png" alt="right column" title="right column"  '.$sr.' data-position="right"/></div><div class="cl"></div>
    <input type="hidden" name="_cb5_sidebar_position" id="sidebar_v" value="'.$meta_box_value.'"/>';

    echo '<div class="sidebar_name" id="sidebar_name"><div class="framein round">
    <b>'.__('Sidebar','cb-modello').':</b><br/><br/><select name="_cb5_sidebar">';?>
<option value="0"<?php if($meta_box_value2 == ''){ echo " selected";} ?>>default</option><?php
    if(is_array($sidebars) && !empty($sidebars)){
        foreach($sidebars as $sidebar){
            if($meta_box_value2 == $sidebar['name']){ echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
            } else { echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";}
        }
    } ?>
    </select><br/><br/><?php _e('You can add new sidebar in modello settings','cb-modello');?>.</div></div><?php
}

function cb_page_new_meta_box($post)
{
    $screen = get_current_screen();

    wp_nonce_field('cb_page_new_meta_box', 'cb_page_new_meta_box_nonce');
    $cb5_post_options = get_post_meta($post->ID, '_cb5_post_options', true);
    $cb5_post_type = esc_attr(get_post_meta($post->ID, '_cb5_post_type', 'true'));

    /* START options for post */
    if ($screen->post_type == 'post'){
    ?>
    <div class="frame round">
        <div class="framein round heady"><?php _e('Type of content', 'cb-modello'); ?>
            <span class="options-control"><a href="#" class="toggle-options" title="Toggle options"><i
                        class="fa fa-chevron-circle-down"></i></a></span></div>
    </div>
    <div class="innen">
        <input type="hidden" name="_cb5_post_type" value="<?php echo $cb5_post_type; ?>" id="cb5_post_type">

        <div class="frame round">
            <div class="framein round postt">
                <a class="post_type_inline <?php if ($cb5_post_type == '' || $cb5_post_type == 'default') echo 'sel'; ?>"
                   id="default"><?php _e('default', 'cb-modello'); ?></a>
                <?php
                /*if ($screen->post_type == 'page') {
                    ?>
                    <a class="post_type_inline <?php if ($cb5_post_type == 'blog') echo 'sel'; ?>"
                       id="blog"><?php _e('blog', 'cb-modello'); ?></a>
                <?php
                }*/
                ?>
                <a class="post_type_inline <?php if ($cb5_post_type == 'portfolio'||$cb5_post_type == 'portfolio_project') echo 'sel'; ?>"
                   id="<?php if ($screen->post_type == 'post') echo 'portfolio_project'; else echo 'portfolio';?>"><?php _e('portfolio', 'cb-modello'); ?></a>
                <a class="post_type_inline <?php if ($cb5_post_type == 'gallery') echo 'sel'; ?>"
                   id="gallery"><?php _e('gallery', 'cb-modello'); ?></a>
                <a class="post_type_inline <?php if ($cb5_post_type == 'video') echo 'sel'; ?>"
                   id="video"><?php _e('video', 'cb-modello'); ?></a>
                <a class="post_type_inline <?php if ($cb5_post_type == 'audio') echo 'sel'; ?>"
                   id="audio"><?php _e('audio', 'cb-modello'); ?></a>
                <a class="post_type_inline <?php if ($cb5_post_type == 'slider') echo 'sel'; ?>"
                   id="slider"><?php _e('slider', 'cb-modello'); ?></a>
            </div>
        </div>

        <?php /* blog options*/
        $cb5_blog = get_post_meta($post->ID, '_cb5_blog', true);
        ?>
        <div class="post_type_options"
             id="blog_options" <?php if ($cb5_post_type != 'blog') echo 'style="display:none;"'; ?>>
            <?php
            cb_post_field(__('Number of columns:', 'cb-modello'), 'blog_nb', '_cb5_blog[nb]', cb_get_value($cb5_blog, 'nb'), '', 'select', array(
                array('1', __('1', 'cb-modello')),
                array('2', __('2', 'cb-modello')),
                array('3', __('3', 'cb-modello')),
                array('4', __('4', 'cb-modello'))));
            cb_post_field(__('Number of items per page:', 'cb-modello'), 'blog_per_page', '_cb5_blog[per_page]', cb_get_value($cb5_blog, 'per_page'), '', 'slider', array(
                0, 100, 1));
            /*cb_post_field(__('Show categories list in blog:', 'cb-modello'), 'blog_show_cat_list', '_cb5_blog[show_cat_list]', cb_get_value($cb5_blog, 'show_cat_list'), '', 'select', array(
                array('no', __('no', 'cb-modello')),
                array('yes', __('yes', 'cb-modello'))));*/
            ?>
            <div class="frame round">
                <div class="framein round aq_desc"><label><?php _e('Posts category', 'cb-modello'); ?></label>
                    <?php wp_dropdown_categories('show_count=0&hierarchical=1&name=_cb5_blog[category]&hide_empty=0&selected=' . cb_get_value($cb5_blog, 'category'),'Posts category for blog, portfolio, video blog, audio blog');
                    ?>
                </div>
            </div>

        </div>
        <?php /* portfolio options */
        $cb5_portfolio = get_post_meta($post->ID, '_cb5_portfolio', true);
        ?>
        <div class="post_type_options"
             id="portfolio_options" <?php if ($cb5_post_type != 'portfolio'&&$cb5_post_type != 'portfolio_project') echo 'style="display:none;"'; ?>>
            <?php
            if ($screen->post_type == 'post') {
                cb_post_field(__('Project URL', 'cb-modello'), 'port_url', '_cb5_portfolio[url]', cb_get_value($cb5_portfolio, 'url'),'inp_larger first');
                cb_post_field(__('Project client', 'cb-modello'), 'port_client', '_cb5_portfolio[client]', cb_get_value($cb5_portfolio, 'client'));
                cb_post_field(__('Keywords', 'cb-modello'), 'port_keywords', '_cb5_portfolio[keywords]', cb_get_value($cb5_portfolio, 'keywords'), 'wider inp_larger');

            } else {
                cb_post_field(__('Link images', 'cb-modello'), 'port_link', '_cb5_portfolio[link]', cb_get_value($cb5_portfolio, 'link'), '', 'select', array(
                    array('ajax', __('ajax', 'cb-modello')),
                    array('page', __('single page', 'cb-modello')),
                    array('image', __('full image', 'cb-modello'))));
                cb_post_field(__('Thumbnail shape', 'cb-modello'), 'port_shape', '_cb5_portfolio[shape]', cb_get_value($cb5_portfolio, 'shape'), '', 'select', array(
                    array('default', __('default', 'cb-modello')),
                    array('triangle', __('triangle', 'cb-modello')),
                    array('hexagon', __('hexagon', 'cb-modello')),
                    array('circle', __('circle', 'cb-modello'))));
                cb_post_field(__('Captions instead of titles', 'cb-modello'), 'port_cap', '_cb5_portfolio[cap]', cb_get_value($cb5_portfolio, 'cap'), '', 'select', array(
                    array('yes', __('yes', 'cb-modello')),
                    array('no', __('no', 'cb-modello'))));
                cb_post_field(__('Show filter', 'cb-modello'), 'port_filter', '_cb5_portfolio[filter]', cb_get_value($cb5_portfolio, 'filter'), '', 'select', array(
                    array('yes', __('yes', 'cb-modello')),
                    array('no', __('no', 'cb-modello'))));
            }
            echo '<div class="aq_desc info">You can add more images just by using our Visual Builder blocks like, slider, images, etc.</div>';
            /*cb_post_field(__('Number of columns', 'cb-modello'), 'port_nb', '_cb5_portfolio[nb]', cb_get_value($cb5_portfolio, 'nb'), '', 'select', array(
                array('1', __('1', 'cb-modello')),
                array('2', __('2', 'cb-modello')),
                array('3', __('3', 'cb-modello')),
                array('4', __('4', 'cb-modello'))));
            cb_post_field(__('Number of items per page', 'cb-modello'), 'port_per_page', '_cb5_portfolio[per_page]', cb_get_value($cb5_portfolio, 'per_page'), '', 'slider', array(
                0, 100, 1));
            cb_post_field(__('Show categories list in blog', 'cb-modello'), 'port_show_cat_list', '_cb5_portfolio[show_cat_list]', cb_get_value($cb5_portfolio, 'show_cat_list'), '', 'select', array(
                array('no', __('no', 'cb-modello')),
                array('yes', __('yes', 'cb-modello'))));
            <div class="frame round hide">
                <div class="framein round aq_desc"><label><?php _e('Posts category', 'cb-modello'); ?></label>
                    <?php wp_dropdown_categories('show_count=0&hierarchical=1&name=_cb5_portfolio[category]&hide_empty=0&selected=' . cb_get_value($cb5_portfolio, 'category'),'Posts category for blog, portfolio, video blog, audio blog');
                    ?>
                </div>
            </div>*/
            ?>
        </div>

        <?php /* gallery options */
        $cb5_gallery = get_post_meta($post->ID, '_cb5_gallery', true);
        ?>
        <div class="post_type_options"
             id="gallery_options" <?php if ($cb5_post_type != 'gallery') echo 'style="display:none;"'; ?>>
            <?php
            cb_post_field(__('Grid gallery', 'cb-modello'), 'gall_grid', '_cb5_gallery[grid]', cb_get_value($cb5_gallery, 'grid'), 'first', 'select', array(
                array('no', __('no', 'cb-modello')),
                array('yes', __('yes', 'cb-modello'))));
            cb_post_field(__('Show captions', 'cb-modello'), 'gall_captions', '_cb5_gallery[captions]', cb_get_value($cb5_gallery, 'captions'), '', 'select', array(
                array('no', __('no', 'cb-modello')),
                array('yes', __('yes', 'cb-modello'))));
            cb_post_field(__('Fullscreen gallery', 'cb-modello'), 'gall_fullscreen', '_cb5_gallery[fullscreen]', cb_get_value($cb5_gallery, 'fullscreen'), '', 'select', array(
                array('no', __('no', 'cb-modello')),
                array('yes', __('yes', 'cb-modello'))), __('Won\'t work with grid gallery enabled.', 'cb-modello'));
            cb_post_field(__('Black & white effect', 'cb-modello'), 'gall_baweffect', '_cb5_gallery[gall_baweffect]', cb_get_value($cb5_gallery, 'gall_baweffect'), '', 'select', array(
                array('no', __('no', 'cb-modello')),
                array('yes', __('yes', 'cb-modello'))));

            cb_post_field(__('Number of columns:', 'cb-modello'), 'gall_nb', '_cb5_gallery[nb]', cb_get_value($cb5_gallery, 'nb'), '', 'select', array(
                array('1', __('1', 'cb-modello')),
                array('2', __('2', 'cb-modello')),
                array('3', __('3', 'cb-modello')),
                array('4', __('4', 'cb-modello'))));
            echo '<div class="aq_desc info">You attach images to this post gallery by scrolling down to Images section and clicking Upload.</div>';
            

            ?>

        </div>

        <?php /* video options */
        $cb5_video = get_post_meta($post->ID, '_cb5_video', true);
        ?>
        <div class="post_type_options"
             id="video_options" <?php if ($cb5_post_type != 'video') echo 'style="display:none;"'; ?>>
            <?php
            cb_post_field(__('Video URL', 'cb-modello'), 'vid_url', '_cb5_video[url]', cb_get_value($cb5_video, 'url'), 'first', 'url', '', 'Enter an Youtube, Vimeo URL (without https) or upload video. Most formats supported.');
            ?>
        </div>

        <?php /* audio options*/
        $cb5_audio = get_post_meta($post->ID, '_cb5_audio', true);
        ?>
        <div class="post_type_options"
             id="audio_options" <?php if ($cb5_post_type != 'audio') echo 'style="display:none;"'; ?>>
            <?php
            cb_post_field(__('Audio URL', 'cb-modello'), 'aud_url', '_cb5_audio[url]', cb_get_value($cb5_audio, 'url'), 'first', 'url', '', 'Enter an URL or upload audio file. MP3 format. Don\'t use if you want soundcloud.');
            cb_post_field(__('SoundCloud Track ID:', 'cb-modello'), 'aud_soundcloudid', '_cb5_audio[soundcloudid]', cb_get_value($cb5_audio, 'soundcloudid'), '', '', '', 'Just the track ID, not the url. This will overwrite option above.');
            ?>
        </div>

        <?php /* slider options*/
        $cb5_slider = get_post_meta($post->ID, '_cb5_slider', true);
        ?>
        <div class="post_type_options"
             id="slider_options" <?php if ($cb5_post_type != 'slider') echo 'style="display:none;"'; ?>>
            <?php
            if ($screen->post_type == 'page') {
                cb_post_field(__('Number of columns:', 'cb-modello'), 'slider_nb', '_cb5_slider[nb]', cb_get_value($cb5_slider, 'nb'), '', 'select', array(
                    array('1', __('1', 'cb-modello')),
                    array('2', __('2', 'cb-modello')),
                    array('3', __('3', 'cb-modello')),
                    array('4', __('4', 'cb-modello'))));
            }
                cb_post_field(__('Slider Behaviour:', 'cb-modello'), 'slider_beh', '_cb5_slider[beh]', cb_get_value($cb5_slider, 'beh'), 'first', 'select', array(
                    array('images', __('Slider from images attached to this page', 'cb-modello')),
                    array('cat', __('Slider from category selected few fields below', 'cb-modello'))));
            
               echo '<div class="aq_desc info">You attach images to this slider by selecting first option above and scrolling down to Images section and clicking Upload.</div>';
             
            
            cb_post_field(__('Number of items to show', 'cb-modello'), 'slider_per_page', '_cb5_slider[per_page]', cb_get_value($cb5_slider, 'per_page'), '', 'slider', array(
                0, 100, 1));
           /* cb_post_field(__('Show categories list in blog:', 'cb-modello'), 'slider_show_cat_list', '_cb5_slider[show_cat_list]', cb_get_value($cb5_slider, 'show_cat_list'), '', 'select', array(
                array('no', __('no', 'cb-modello')),
                array('yes', __('yes', 'cb-modello'))));*/
            ?>
            <div class="frame round">
                <div class="framein round aq_desc"><label><?php _e('Posts category', 'cb-modello'); ?></label>
                <div class="cb_hint"><i class="fa fa-info"></i> <span class="hint">Use this if you selected second option above. This will take feature images from the posts.</span></div>
                <?php  wp_dropdown_categories('show_count=0&hierarchical=1&name=_cb5_slider[category]&hide_empty=0&selected=' . cb_get_value($cb5_slider, 'category'),'Posts category for blog, portfolio, video blog, audio blog');
                    ?>
                </div>
            </div>
        </div>
<?php }
    /* END options for post */
    ?>
        <?php /* default options*/ ?>
<?php if ($screen->post_type != 'post'){ ?><div class="frame round">
        <div class="framein round heady"><?php _e('General Page Settings', 'cb-modello'); ?>
            <span class="options-control"><a href="#" class="toggle-options" title="Toggle options"><i
                        class="fa fa-chevron-circle-down"></i></a></span></div>
    </div> <div class="innen"><?php } ?>
        <?php
        cb_post_field(__('Display featured image', 'cb-modello'), 'opt_display_featured', '_cb5_post_options[display_featured]',
            cb_get_value($cb5_post_options, 'display_featured'), 'first', 'select', array(
                array('yes', __('yes', 'cb-modello')),
                array('no', __('no', 'cb-modello'))));
        cb_post_field(__('Show breadcrumbs', 'cb-modello'), 'opt_show_bread', '_cb5_post_options[show_bread]',
            cb_get_value($cb5_post_options, 'show_bread'), '', 'select', array(
                array('yes', __('yes', 'cb-modello')),
                array('no', __('no', 'cb-modello'))));
        /*cb_post_field(__('Display Attached Images', 'cb-modello'), 'opt_display_attached', '_cb5_post_options[display_attached]',
            cb_get_value($cb5_post_options, 'display_attached'), '', 'select', array(
                array('yes', __('yes', 'cb-modello')),
                array('no', __('no', 'cb-modello'))), __('Won\'t work if featured image is disabled.', 'cb-modello'));*/

        if ($screen->post_type == 'post') {

cb_post_field(__('Show about author on single post', 'cb-modello'), 'opt_show_about', '_cb5_post_options[show_about]', cb_get_value($cb5_post_options, 'show_about'), '', 'select', array(
array('yes', __('yes', 'cb-modello')),
array('no', __('no', 'cb-modello'))));

cb_post_field(__('Show details in title on single post', 'cb-modello'), 'opt_show_dtitle', '_cb5_post_options[show_dtitle]', cb_get_value($cb5_post_options, 'show_dtitle'), '', 'select', array(
array('yes', __('yes', 'cb-modello')),
array('no', __('no', 'cb-modello'))));

            /*cb_post_field(__('Recent posts block style', 'cb-modello'), 'opt_posts_style', '_cb5_post_options[posts_style]',
                cb_get_value($cb5_post_options, 'posts_style'), '', 'select', array(
                    array('', __('normal', 'cb-modello')),
                    array('only_image', __('only image', 'cb-modello')),
                    array('left_image_text', __('image + right text', 'cb-modello')),
                    array('top_image_text', __('image + bottom text', 'cb-modello')),
                    array('right_image_text', __('image + left text', 'cb-modello')),
                    array('bottom_image_text', __('image + top text', 'cb-modello')),
                    array('only_text', __('only text', 'cb-modello')),
                    array('only_image_wide', __('only image wide', 'cb-modello')),
                    array('only_image_tall', __('only image tall', 'cb-modello'))), __('Styles for posts in Recent Posts builder block. Will work with grid mode enabled. Won\'t work if featured image is disabled.', 'cb-modello'));
            cb_post_field(__('Recent posts block text color', 'cb-modello'), 'opt_grid_text', '_cb5_post_options[grid_text]', cb_get_value($cb5_post_options, 'grid_text'),'','color');
            cb_post_field(__('Recent posts block background color', 'cb-modello'), 'opt_grid_bg', '_cb5_post_options[grid_bg]', cb_get_value($cb5_post_options, 'grid_bg'),'','color');
            */}else{
            cb_post_field(__('Show Page Title', 'cb-modello'), 'opt_show_title', '_cb5_post_options[show_title]', cb_get_value($cb5_post_options, 'show_title'), '', 'select', array(
                array('yes', __('yes', 'cb-modello')),
                array('no', __('no', 'cb-modello'))));
           /* cb_post_field(__('Medium Images for 1 Column Blog:', 'cb-modello'), 'opt_mediumblog', '_cb5_post_options[mediumblog]', cb_get_value($cb5_post_options, 'mediumblog'), '', 'select', array(
                array('no', __('no', 'cb-modello')),
                array('yes', __('yes', 'cb-modello'))));*/

        } ?><?php if ($screen->post_type != 'post'){ ?></div><?php }?>
   <?php if ($screen->post_type== 'post'){ ?> </div><?php }?>
    <?php /*Header Settings*/
    $cb5_header = get_post_meta($post->ID, '_cb5_header', true);
    ?>
    <div class="frame round">
        <div class="framein round heady"><?php _e('Header Settings', 'cb-modello'); ?>
            <span class="options-control"><a href="#" class="toggle-options" title="Toggle options"><i
                        class="fa fa-chevron-circle-down"></i></a></span></div>
    </div>
    <div class="innen">
        <?php
        cb_post_field(__('Header Type', 'cb-modello'), 'h_header_type', '_cb5_header[header_type]',
            cb_get_value($cb5_header, 'header_type'), 'first', 'select', array(
                array('normal_header', __('Normal', 'cb-modello')),
                array('bg_head', __('Background image', 'cb-modello')),
                array('slider_head', __('Slider', 'cb-modello')),
                array('map', __('Map', 'cb-modello'))));
        ?>
        <div class="header_type bg_head" <?php if(cb_get_value($cb5_header, 'header_type')!='bg_head') echo 'style="display: none;"'; ?>>
            <?php
            cb_post_field(__('Background Image:', 'cb-modello'), 'h_bg_image_url', '_cb5_header[bg_image_url]', cb_get_value($cb5_header, 'bg_image_url'), '', 'url', '', 'Enter an URL or upload image.');
            ?>
        </div>
        <?php
        ?>
        <div class="header_type slider_head" <?php if(cb_get_value($cb5_header, 'header_type')!='slider_head') echo 'style="display: none;"'; ?>>
<?php
cb_post_field(__('Slider', 'cb-modello'), 'h_home_slider', '_cb5_header[home_slider]', cb_get_value($cb5_header, 'home_slider'), '', 'select', array(
    array('none', __('None', 'cb-modello')),
    array('revo', __('Revolution slider', 'cb-modello'))),'Slider settings can be set up in Modello Menu in Slider Tab.');
?>
<div class="slider_type revo" <?php if(cb_get_value($cb5_header, 'home_slider')!='revo') echo 'style="display: none;"'; ?>>
    <?php
    if(class_exists("RevSlider")) {
        echo '<div class="frame round"><div class="framein round aq_desc">
        <label for="h_revo_type">'.__('Revolution Slider Name','cb-modello').'</label>';

        echo '<select name="_cb5_header[revo_type]" id="h_revo_type">';
        $revo_type=cb_get_value($cb5_header, 'revo_type');
        $slider = new RevSlider();
        $arrSliders = $slider->getArrSliders();
        foreach($arrSliders as $slider):
            $stitle = $slider->getTitle();
            $salias=$slider->getAlias();
            if($revo_type==$salias) $curest=' selected '; else $curest='';
            echo '<option value='.$salias.' '.$curest.'>'.$stitle.'</option>';
        endforeach;
        echo '</select></div></div>'; }
    ?>
</div>
        </div>
        <?php
        ?>
        <div class="header_type map" <?php if(cb_get_value($cb5_header, 'header_type')!='map') echo 'style="display: none;"' ;?>>
<?php
cb_post_field(__('Map address', 'cb-modello'), 'h_map_a', '_cb5_header[map_a]', cb_get_value($cb5_header, 'map_a'),'inp_larger');
cb_post_field(__('Map zoom', 'cb-modello'), 'h_map_z', '_cb5_header[map_z]', cb_get_value($cb5_header, 'map_z'), '', 'slider',array(0,20,1));
cb_post_field(__('Map type', 'cb-modello'), 'h_map_t', '_cb5_header[map_t]', cb_get_value($cb5_header, 'map_t'), '', 'select', array(
    array('m', __('map', 'cb-modello')),
    array('s', __('satellite', 'cb-modello'))));
?>
        </div>
        <div class="header_default" <?php /* if(cb_get_value($cb5_header, 'header_type')=='slider_head') echo 'style="display: none;"' */;?>>
         <?php
        cb_post_field(__('Header Top Padding Height:', 'cb-modello'), 'h_top_padding', '_cb5_header[top_padding]', cb_get_value($cb5_header, 'top_padding'), '', 'slider',array(0,900,1));
         
       /* cb_post_field(__('Parralax slide header', 'cb-modello'), 'h_slide_header', '_cb5_header[slide_header]',
            cb_get_value($cb5_header, 'slide_header'), '', 'select', array(
                array('no', __('No', 'cb-modello')),
                array('yes', __('Yes', 'cb-modello'))));
*/
        cb_post_field(__('Title color', 'cb-modello'), 'h_header_color', '_cb5_header[header_color]', cb_get_value($cb5_header, 'header_color'),'','color');
        cb_post_field(__('Title shadow color', 'cb-modello'), 'h_header_shadow_color', '_cb5_header[header_shadow_color]', cb_get_value($cb5_header, 'header_shadow_color'),'','color');
        cb_post_field(__('Breadcrumbs color', 'cb-modello'), 'h_bread_color', '_cb5_header[bread_color]', cb_get_value($cb5_header, 'bread_color'),'','color');
        cb_post_field(__('Background color ', 'cb-modello'), 'h_header_bg_color', '_cb5_header[header_bg_color]', cb_get_value($cb5_header, 'header_bg_color'),'','color');
        cb_post_field(__('Header tint', 'cb-modello'), 'h_header_tint', '_cb5_header[header_tint]', cb_get_value($cb5_header, 'header_tint'),'','select', array(
            array('no', __('no', 'cb-modello')),
            array('skin', __('skin', 'cb-modello')),
            array('bdark', __('black dark', 'cb-modello')),
            array('blight', __('black light', 'cb-modello')),
            array('wdark', __('white dark', 'cb-modello')),
            array('wlight', __('white light', 'cb-modello')),
            array('tblack', __('top black shadow', 'cb-modello')),
            array('twhite', __('top white shadow', 'cb-modello'))),'Will tint header background');
        cb_post_field(__('Header slogan', 'cb-modello'), 'h_sloganp', '_cb5_header[sloganp]', cb_get_value($cb5_header, 'sloganp'),'area_large','textarea','','Will show slogan in header. You can use html.');
        cb_post_field(__('Header slogan color', 'cb-modello'), 'h_slogan_color', '_cb5_header[slogan_color]', cb_get_value($cb5_header, 'slogan_color'),'','color');
        cb_post_field(__('Header slogan top margin', 'cb-modello'), 'h_slogan_margin', '_cb5_header[slogan_margin]', cb_get_value($cb5_header, 'slogan_margin'),'','slider', array(0, 500, 1));
        cb_post_field(__('Header menu and logo background', 'cb-modello'), 'h_ht_backgroundp', '_cb5_header[ht_backgroundp]', cb_get_value($cb5_header, 'ht_backgroundp'),'','color');
        cb_post_field(__('Header menu color', 'cb-modello'), 'h_ht_backgroundpm', '_cb5_header[ht_backgroundpm]', cb_get_value($cb5_header, 'ht_backgroundpm'),'','color');
        /*cb_post_field(__('Custom Page Logo:', 'cb-modello'), 'h_ht_bg_image_url', '_cb5_header[ht_bg_image_url]', cb_get_value($cb5_header, 'ht_bg_image_url'), '', 'url', '', 'Enter an URL or upload image.');
        */
        cb_post_field(__('Hide Footer', 'cb-modello'), 'h_hide_f', '_cb5_header[hide_f]',
            cb_get_value($cb5_header, 'hide_f'), '', 'select', array(
                array('no', __('No', 'cb-modello')),
                array('yes', __('Yes', 'cb-modello'))));
        
        cb_post_field(__('Hide header', 'cb-modello'), 'h_hide_h', '_cb5_header[hide_h]',
            cb_get_value($cb5_header, 'hide_h'), '', 'select', array(
                array('no', __('No', 'cb-modello')),
                array('yes', __('Yes', 'cb-modello'))));
        cb_post_field(__('Page Custom CSS', 'cb-modello'), 'h_css', '_cb5_header[css]', cb_get_value($cb5_header, 'css'),'area_large','textarea','','This page only custom css.');
        
                ?>
        </div>

    </div>

   <?php  if ($screen->post_type == 'post'){?> <div class="frame round">
        <div class="framein round heady"><?php _e('Images', 'cb-modello'); ?>
            <span class="options-control"><a href="#" class="toggle-options" title="Toggle options"><i
                        class="fa fa-chevron-circle-down"></i></a></span></div>
    </div>
    <div class="innen">
        <?php
        echo '<div class="frame round"><div class="framein round aq_desc first">';
        echo '<input style="cursor:pointer;" class="upload_button3" type="button" value="Upload Multiple Images" />
        <br /><br/>'.__('Upload images in Media Library and attach to this post or upload them here and click save without inserting any image','cb-modello').'.';
        echo '</div></div>';

        $imgs =&get_children('order=asc&orderby=menu_order&post_type=attachment&post_mime_type=image&post_parent='.$post->ID );
        if($imgs){
            ?>
            <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('.gallery-attachments').sortable();
                jQuery('.gallery-image .del').hide();

                jQuery('.gallery-image').hover(
                function () {
                jQuery(this).find('.del').show();
                },
                function () {
                jQuery(this).find('.del').hide();
                }
                );
                jQuery('.gallery-image .del').click(function() {
                var confirm1 = confirm('Delete this attachment?');
                if (confirm1) {
                var oldval=jQuery(this).parent().find('#att_id_del').val();
                jQuery(this).parent().find('#att_id_del').val(oldval+'delete');
                jQuery(this).parent().hide();
                }
                });
            });
            </script>
            <?php

            echo '<div class="frame aq_desc round"><div class="framein round gallery-attachments"><b>'.__('Images currently attached to this post','cb-modello').':</b><br/><br/>';
            foreach ($imgs as $attachment_id => $attachment ) {
                $fir=wp_get_attachment_image_src($attachment_id,'large');
                echo '<div class="gallery-image"><img src="'.WP_THEME_URL.'/inc/assets/images/admin_images/delete.png" class="del"/><img src="'.bfi_thumb($fir[0], array('width' => 80, 'height'=>40, 'crop' => true)).'"/><input type="hidden" name="att_id[]" id="att_id" value="'.$attachment_id.'"/><input type="hidden" name="att_id_del[]" id="att_id_del" value="'.$attachment_id.'"/></div>';
            }
            echo '<div style="clear:both;"></div><br/>'.__('Drag n Drop images to sort','cb-modello').'.</div></div>';
        }

        ?>


    </div>
<?php }
?>
    <div class="frame round">
        <div class="framein round heady"><?php _e('Import Blocks and Settings', 'cb-modello'); ?>
            <span class="options-control"><a href="#" class="toggle-options" title="Toggle options"><i
                        class="fa fa-chevron-circle-down"></i></a></span></div>
    </div>
    <div class="innen" style="display: none">
<?php
cb_post_field(__('Import blocks', 'cb-modello'), 'import_blocks', 'import_blocks',
   '', 'first', 'select', array(
        array('yes', __('Yes', 'cb-modello')),
        array('no', __('No', 'cb-modello'))));
cb_post_field(__('Import page options', 'cb-modello'), 'import_page_settings', 'import_page_settings',
    '', '', 'select', array(
        array('yes', __('Yes', 'cb-modello')),
        array('no', __('No', 'cb-modello'))));

?>

            <div class="aq_desc first">
                <label for="">&nbsp;</label>
                <input type="file" name="import_file" ><input type="submit" name="import_settings" class="button button-primary " value="Import settings" onclick="jQuery('#post').submit();">
            </div>

    </div>
    <div class="frame round">
        <div class="framein round heady"><?php _e('Export Blocks and Settings', 'cb-modello'); ?>
            <span class="options-control"><a href="#" class="toggle-options" title="Toggle options"><i
                        class="fa fa-chevron-circle-down"></i></a></span></div>
    </div>
    <div class="innen" style="display: none">
        <div class="aq_desc first">
            <label for="">&nbsp;</label>
            <input type="submit" name="export_settings" class="button button-primary " value="Export settings" onclick="jQuery('#post').submit();">
        </div>
    </div>
<?php
}

/**
 * @param $label
 * @param $id
 * @param $name
 * @param $value
 * @param string $class
 * @param string $field_type
 * @param array $field_options
 * @param string $info
 */
function cb_post_field($label, $id, $name, $value, $class = '', $field_type = '', $field_options = array(), $info = '')
{

    ?>
    <div class="aq_desc <?php echo $class; ?>"><?php
        switch ($field_type) {
            case "select":
                generate_select($label, $value, $field_options, $name, $id,$info);
                break;
            case "url":
                echo '<label for="' . $id . '">' . $label . '</label>';
                if ($info!='') echo '<div class="cb_hint"><i class="fa fa-info"></i> <span class="hint">' . $info.'</span></div>';
               echo '<input type="text" name="' . $name . '" id="' . $id . '"
                      value="' . $value . '" class="input-upload"/>&nbsp;<input style="cursor:pointer;" class="upload_button button button-primary" type="button" value="' . __('Upload', 'cb-modello') . '" />';
                break;
            case "slider":
                echo '<label for="' . $id . '">' . $label . '</label>';
                if ($info!='') echo '<div class="cb_hint"><i class="fa fa-info"></i> <span class="hint">' . $info.'</span></div>';
               echo '<input type="text" value="' . $value . '" name="' . $name . '" data-slider="true" data-slider-step="' . $field_options[2] . '" data-slider-range="' . $field_options[0] . ',' . $field_options[1] . '" data-slider-highlight="true"/>
<div class="clear"></div>';
                break;
            case "color":
                echo '<label for="' . $id . '">' . $label . '</label>';
                if ($info!='') echo '<div class="cb_hint"><i class="fa fa-info"></i> <span class="hint">' . $info.'</span></div>';
               echo '<input type="text" name="' . $name . '" id="' . $id . '"
                      value="' . $value . '" class="color"/>';
                break;

            case "textarea":
                echo '<label for="' . $id . '">' . $label . '</label>';
                if ($info!='') echo '<div class="cb_hint"><i class="fa fa-info"></i> <span class="hint">' . $info.'</span></div>';
               echo '<textarea id="' . $id . '" type="text" name="' . $name . '" >' . $value . '</textarea>';
                break;
            default:
                echo '<label for="' . $id . '">' . $label . '</label>';
                if ($info!='') echo '<div class="cb_hint"><i class="fa fa-info"></i> <span class="hint">' . $info.'</span></div>';
               echo '<input type="text" name="' . $name . '" id="' . $id . '"
                      value="' . $value . '"/>';
                break;
        }

        ?>
    </div><?php
}