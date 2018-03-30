<?php
/**
* class WPSupersized_Metabox
*
* Takes care of the metabox for WP Supersized options in the page/post admin.
 * 
*/

if ( !class_exists('WPSupersized_Metabox') ):
class WPSupersized_Metabox
{
    private $displaySupersizedDir;
   /*
   * custom_meta_box
   *
   * Creates a custom meta box in the page/post admin to allow the user to select which source of images he/she wants to use
   * 
   */
   function custom_meta_box() {
       $postType = array ('post', 'page');
       foreach ($postType as $type) {
        add_meta_box(  
            'wpsupersized_custom_meta_box', // $id  
            'Background Slider/Source of Images', // $title  
            array('WPSupersized_Metabox','generate_metabox_content'), // $callback  
            $type, // $page  
            'normal', // $context  
            'high'); // $priority   
       }
   }
   
    /*
    *
    * generate_metabox_content()
    * 
    * Generates the WP Supersized metabox content
    *  
    */
   
   function generate_metabox_content() {
    wp_enqueue_style('supersized_admin_jquery_ui'); // enqueues the theme for the jQuery UI tabs
     
    $testDir = new WPSupersized_Metabox; // $testDir is initialized as a class-limited global variable
    global $post;
    wp_nonce_field(basename(__FILE__), 'custom_meta_box_nonce');
    
    $generalOptions = get_option('wp-supersized_options');
    $supersizedDir = get_post_meta($post->ID, 'SupersizedDir', true);
    $testDir->displaySupersizedDir = $supersizedDir;
    if (strtolower($supersizedDir) == 'wp-gallery' || strtolower($supersizedDir) == 'wpgallery' || strtolower($supersizedDir) == 'wp_gallery') $supersizedDir = 'wp-gallery';
    if (strtolower($supersizedDir) == 'ngg-gallery' || strtolower($supersizedDir) == 'ngggallery' || strtolower($supersizedDir) == 'ngg_gallery') $supersizedDir = 'ngg-gallery';
    $supersizedNextGenGallery = get_post_meta($post->ID, 'SupersizedNextGenGallery', true);
    $flickrOptionsString = get_post_meta($post->ID, 'SupersizedFlickrOptions', true);
    if(!empty($flickrOptionsString)) 
        $flickrOptions = explode('#SZ#', $flickrOptionsString);
        else 
            $flickrOptions = array( // if there are no custom options defined for this page/post, use general options from plugin options panel
            $generalOptions['flickr_source'],
            $generalOptions['flickr_set'],
            $generalOptions['flickr_user'],
            $generalOptions['flickr_group'],
            $generalOptions['flickr_tags'],
            $generalOptions['flickr_total_slides'],
            $generalOptions['flickr_size'],
            $generalOptions['flickr_sort_by'],
            $generalOptions['flickr_sort_direction'],
            $generalOptions['flickr_api_key']
        );
    $picasaOptionsString = get_post_meta($post->ID, 'SupersizedPicasaOptions', true);
    if(!empty($picasaOptionsString)) $picasaOptions = explode('#SZ#', $picasaOptionsString);
        else 
            $picasaOptions = array( // if there are no custom options defined for this page/post, use general options from plugin options panel
            $generalOptions['picasa_source'],
            $generalOptions['picasa_album'],
            $generalOptions['picasa_user'],
            $generalOptions['picasa_tags'],
            $generalOptions['picasa_total_slides'],
            $generalOptions['picasa_image_size'],
            $generalOptions['picasa_sort_by'],
            $generalOptions['picasa_sort_direction'],
            $generalOptions['picasa_auth_key']
        );
    $smugmugOptionsString = get_post_meta($post->ID, 'SupersizedSmugmugOptions', true);
    if(!empty($smugmugOptionsString)) $smugmugOptions = explode('#SZ#', $smugmugOptionsString);
        else 
            $smugmugOptions = array( // if there are no custom options defined for this page/post, use general options from plugin options panel
            $generalOptions['smugmug_source'],
            $generalOptions['smugmug_keyword'],
            $generalOptions['smugmug_user'],
            $generalOptions['smugmug_gallery'],
            $generalOptions['smugmug_category'],
            $generalOptions['smugmug_total_slides'],
            $generalOptions['smugmug_image_size'],
            $generalOptions['smugmug_sort_by'],
            $generalOptions['smugmug_sort_direction']
        );
    
    echo '<div id="SZMetaboxTabs"><ul>';
    echo '<li><input style="position: absolute;left: -9999px" type="radio" name="SZSource" id="SZSource-0" value="0" ',$supersizedDir == '' ? ' checked="checked"' : '',' /><a href="#SZTab_none">None</a></li>';
    echo '<li><input style="position: absolute;left: -9999px" type="radio" name="SZSource" id="SZSource-1" value="1" ',$supersizedDir == 'wp-gallery' ? ' checked="checked"' : '',' /><a href="#SZTab_wpgallery">WP Media Gallery</a></li>';
    echo '<li><input style="position: absolute;left: -9999px" type="radio" name="SZSource" id="SZSource-2" value="2" ',$supersizedDir == 'ngg-gallery' ? ' checked="checked"' : '',' /><a href="#SZTab_nggallery">NextGen Gallery</a></li>';
    echo '<li><input style="position: absolute;left: -9999px" type="radio" name="SZSource" id="SZSource-3" value="3" ',$supersizedDir == 'flickr' ? ' checked="checked"' : '',' /><a href="#SZTab_flickr">Flickr</a></li>';
    echo '<li><input style="position: absolute;left: -9999px" type="radio" name="SZSource" id="SZSource-4" value="4" ',$supersizedDir == 'picasa' ? ' checked="checked"' : '',' /><a href="#SZTab_picasa">Picasa</a></li>';
    echo '<li><input style="position: absolute;left: -9999px" type="radio" name="SZSource" id="SZSource-5" value="5" ',$supersizedDir == 'smugmug' ? ' checked="checked"' : '',' /><a href="#SZTab_smugmug">Smugmug</a></li>';
    echo '<li><input style="position: absolute;left: -9999px" type="radio" name="SZSource" id="SZSource-6" value="6" ',$supersizedDir != 'wp-gallery' && $supersizedDir != 'ngg-gallery' && $supersizedDir != 'flickr'&& $supersizedDir != 'picasa'&& $supersizedDir != 'smugmug' && $supersizedDir !='' && !WPSupersized::is_xml_file($supersizedDir) ? ' checked="checked"' : '',' /><a href="#SZTab_custom_dir">Custom dir</a></li>';
    echo '<li><input style="position: absolute;left: -9999px" type="radio" name="SZSource" id="SZSource-7" value="7" ', WPSupersized::is_xml_file($supersizedDir) == true ? ' checked="checked"' : '',' /><a href="#SZTab_xml_file">XML file</a></li>';
    echo '</ul>';
    
    echo '<div id="SZTab_none">';
    self::no_selection();
    echo '</div>';
    echo '<div id="SZTab_wpgallery">';
    self::wpgallery_details();
    echo '</div>';
    echo '<div id="SZTab_nggallery">';
    self::nggallery_details($supersizedDir, $supersizedNextGenGallery);
    echo '</div>';
    echo '<div id="SZTab_flickr">';
    self::flickr_details($flickrOptions);
    echo '</div>';
    echo '<div id="SZTab_picasa">';
    self::picasa_details($picasaOptions);
    echo '</div>';
    echo '<div id="SZTab_smugmug">';
    self::smugmug_details($smugmugOptions);
    echo '</div>';
    echo '<div id="SZTab_custom_dir">';
    self::custom_dir_details($supersizedDir);
    echo '</div>';
    echo '<div id="SZTab_xml_file">';
    self::xml_file_details($supersizedDir);
    echo '</div>';
    echo '</div>'; // closes SZMetaboxTabs div

    self::output_tabs_script();
   }

    /*
    *
    * save_custom_meta($post_id)
    * 
    * Saves the data in the custom field
    *  
    */
   
   function save_custom_meta($post_id, $post) {

       if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
        return $post_id;  
    // check autosave  
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // check permissions  
    $post_type = get_post_type_object($post->post_type);
    if ('page' == $post_type || 'post' == $post_type) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
  
    // save the data   
        $newSZSource = $_POST['SZSource'];
        $oldSupersizedDir = get_post_meta($post_id, 'SupersizedDir', true);
        $oldSupersizedNextGenGallery = get_post_meta($post_id, 'SupersizedNextGenGallery', true);
        $oldFlickrOptionsString = get_post_meta($post_id, 'SupersizedFlickrOptions', true);
        $oldPicasaOptionsString = get_post_meta($post_id, 'SupersizedPicasaOptions', true);
        $oldSmugmugOptionsString = get_post_meta($post_id, 'SupersizedSmugmugOptions', true);

        switch ($newSZSource) {
            case '0' :       $newSupersizedDir ='';
                                break;
            case '1' : $newSupersizedDir = 'wp-gallery';
                                break;
            case '2' : $newSupersizedDir = 'ngg-gallery';
                                 $newSupersizedNextGenGallery = $_POST['SupersizedNextGenGallery'];
                                 break;
            case '3' : $newSupersizedDir = 'flickr';
                            $newOptionsFlickr[0] = strip_tags(stripslashes($_POST["flickr_source"]));
                            $newOptionsFlickr[1] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["flickr_set"]))));
                            $newOptionsFlickr[2] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["flickr_user"]))));
                            $newOptionsFlickr[3] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["flickr_group"]))));
                            $newOptionsFlickr[4] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["flickr_tags"]))));
                            $newOptionsFlickr[5] = strip_tags(stripslashes($_POST["flickr_total_slides"]));
                            $newOptionsFlickr[6] = strip_tags(stripslashes($_POST["flickr_size"]));
                            $newOptionsFlickr[7] = strip_tags(stripslashes($_POST["flickr_sort_by"]));
                            $newOptionsFlickr[8] = strip_tags(stripslashes($_POST["flickr_sort_direction"]));
                            $newOptionsFlickr[9] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["flickr_api_key"]))));
                            $newFlickrOptionsString = implode('#SZ#', $newOptionsFlickr);
                            break;
            case '4' : $newSupersizedDir = 'picasa';
                            $newOptionsPicasa[0] = strip_tags(stripslashes($_POST["picasa_source"]));
                            $newOptionsPicasa[1] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["picasa_album"]))));
                            $newOptionsPicasa[2] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["picasa_user"]))));
                            $newOptionsPicasa[3] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["picasa_tags"]))));
                            $newOptionsPicasa[4] = strip_tags(stripslashes($_POST["picasa_total_slides"]));
                            $newOptionsPicasa[5] = strip_tags(stripslashes($_POST["picasa_image_size"]));
                            $newOptionsPicasa[6] = strip_tags(stripslashes($_POST["picasa_sort_by"]));
                            $newOptionsPicasa[7] = strip_tags(stripslashes($_POST["picasa_sort_direction"]));
                            $newOptionsPicasa[8] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["picasa_auth_key"]))));
                            $newPicasaOptionsString = implode('#SZ#', $newOptionsPicasa);
                            break;
            case '5' : $newSupersizedDir = 'smugmug';
                            $newOptionsSmugmug[0] = strip_tags(stripslashes($_POST["smugmug_source"]));
                            $newOptionsSmugmug[1] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["smugmug_keyword"]))));
                            $newOptionsSmugmug[2] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["smugmug_user"]))));
                            $newOptionsSmugmug[3] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["smugmug_gallery"]))));
                            $newOptionsSmugmug[4] = trim(str_replace(' ', '', strip_tags(stripslashes($_POST["smugmug_category"]))));
                            $newOptionsSmugmug[5] = strip_tags(stripslashes($_POST["smugmug_total_slides"]));
                            $newOptionsSmugmug[6] = strip_tags(stripslashes($_POST["smugmug_image_size"]));
                            $newOptionsSmugmug[7] = strip_tags(stripslashes($_POST["smugmug_sort_by"]));
                            $newOptionsSmugmug[8] = strip_tags(stripslashes($_POST["smugmug_sort_direction"]));
                            $newSmugmugOptionsString = implode('#SZ#', $newOptionsSmugmug);
                            break;
            case '6' :  $newSupersizedDir = trim($_POST['SupersizedCustomDir'],' /');
                                break;
            case '7' : $newSupersizedDir = trim($_POST['SupersizedXmlFile'],' /');
        }

        if ($newSupersizedDir != $oldSupersizedDir) {  
            update_post_meta($post_id, 'SupersizedDir', $newSupersizedDir);  
        }

        if ($newSupersizedNextGenGallery && $newSupersizedNextGenGallery != $oldSupersizedNextGenGallery) {  
            update_post_meta($post_id, 'SupersizedNextGenGallery', $newSupersizedNextGenGallery);  
        }
 
        if ($newFlickrOptionsString && $newFlickrOptionsString != $oldFlickrOptionsString) {  
            update_post_meta($post_id, 'SupersizedFlickrOptions', $newFlickrOptionsString);  
        }
        
        if ($newPicasaOptionsString && $newPicasaOptionsString != $oldPicasaOptionsString) {  
            update_post_meta($post_id, 'SupersizedPicasaOptions', $newPicasaOptionsString);  
        }
        
        if ($newSmugmugOptionsString && $newSmugmugOptionsString != $oldSmugmugOptionsString) {  
            update_post_meta($post_id, 'SupersizedSmugmugOptions', $newSmugmugOptionsString);  
        }
   }
   
    /*
    * 
    * display_array($listFolders, $customFolder)
    * recursive display of directories contained in the array $listFolders
    * 
    */
   
   function display_array($listFolders, $customFolder) {
       foreach($listFolders as $key => $value) {
           if(is_array($value[0]) && !empty($value[0])) {
               echo '<li class="wpsztoggle"><div class="wpszbutton" style="display:inline;">'.$key.'</div>';
               echo ' <input type="radio" name="SupersizedCustomDir" value="'.$value[1].'"';
               	if($customFolder == $value[1] ){ echo ' checked="checked" '; }
               echo '></input>';
               echo '</li><ul>';
               self::display_array($value[0], $customFolder);
               echo '</ul>';
           }
           else {
               echo '<li>'.$key.' <input type="radio" name="SupersizedCustomDir" value="'.$value[1].'"';
               	if($customFolder == $value[1] ){ echo ' checked="checked" '; }
               echo '></input> ';
           }
           echo '</li>';
       }
   }
   
    /*
    * directory_list($directory_base_path, $filter_dir = false, $filter_files = false, $exclude = ".|..|.DS_Store|.svn", $recursive = true)
    * returns an array containing optionally all files, only directiories or only files at a file system path
    * @author     cgray The Metamedia Corporation www.metamedia.us
    *
    * @param    $base_path         string    either absolute or relative path
    * @param    $filter_dir        boolean    Filter directories from result (ignored except in last directory if $recursive is true)
    * @param    $filter_files    boolean    Filter files from result
    * @param    $exclude        string    Pipe delimited string of files to always ignore
    * @param    $recursive        boolean    Descend directory to the bottom?
    * @return    $result_list    array    Nested array or false
    * @access public
    * @license    GPL v3
    */
    function directory_list($directory_base_path, $filter_dir = false, $filter_files = false, $exclude = ".|..|.DS_Store|.svn", $recursive = true){
    $directory_base_path = rtrim($directory_base_path, "/") . "/";

    if (!is_dir($directory_base_path)){
        error_log(__FUNCTION__ . "File at: $directory_base_path is not a directory.");
        return false;
    }

    $result_list = array();
    $exclude_array = explode("|", $exclude);

    if (!$folder_handle = opendir($directory_base_path)) {
//        error_log(__FUNCTION__ . "Could not open directory at: $directory_base_path");
        return false;
    }else{
        while(false !== ($filename = readdir($folder_handle))) {
            if(!in_array($filename, $exclude_array)) {
                if(is_dir($directory_base_path . $filename)) { // removed the trailing slash to avoid base dir bug in older php versions
                    if($recursive && strcmp($filename, ".")!=0 && strcmp($filename, "..")!=0 ){ // prevent infinite recursion
//                        error_log($directory_base_path . $filename . "/");
                        $result_list[$filename] = array(self::directory_list("$directory_base_path$filename/", $filter_dir, $filter_files, $exclude, $recursive), ltrim(str_replace(WP_CONTENT_DIR, '',$directory_base_path.$filename),'/'));
                    }elseif(!$filter_dir){
                        $result_list[] = array($filename, $directory_base_path.$filename);
                    }
                }elseif(!$filter_files){
                    $result_list[] = array($filename, $directory_base_path.$filename);
                }
            }
        }
        closedir($folder_handle);
        return $result_list;
    }    
}

    /*
     * output_tabs_scripts()
     * 
     * Uses the jQuery UI Tabs to select the source
     * Acts on the SZMetaboxTabs div
     * Reads and modifies the SZSource radio buttons
     * 
     */
    function output_tabs_script() {
        echo '<script type="text/javascript">
            jQuery(function() {
            var selectedTab = jQuery(\'input:radio[name="SZSource"]:checked\').val();
            var tabOptions = {
                active: selectedTab
                };
            jQuery("#SZMetaboxTabs").tabs(tabOptions);
            jQuery("#SZMetaboxTabs").tabs({activate: function(event, ui) {
                jQuery(\'[id="SZSource-\' + ui.oldTab.index() + \'"]\').removeAttr("checked"); // removes the "checked" attribute from the previous source button
                jQuery(\'[id="SZSource-\' + ui.newTab.index() + \'"]\').attr(\'checked\',true); // sets the new source to "checked"
                }
                });
            });
        </script>';
    }
    /*
    * Displays the folder list with interactive folder opening and content display
    * Acts on the div with id wp-supersized-folder-list
    * (adapted from http://www.lateralcode.com/directory-trees-with-php-and-jquery/)
    */
    function output_folder_list_script() {
    echo '<script type="text/javascript">
jQuery(function () {
  jQuery("li.wpsztoggle").next().hide();
  jQuery("li.wpsztoggle").hover(function () {
    jQuery(this).stop().animate({
      fontSize: "17px",
      paddingLeft: "10px",
      color: "black"
    }, 100);
  }, function () {
    jQuery(this).stop().animate({
      fontSize: "14px",
      paddingLeft: "0",
      color: "#808080"
    }, 100);
  });
  jQuery("li.wpsztoggle").css("cursor", "pointer");
  jQuery("li.wpsztoggle > div.wpszbutton").prepend("+ ");
  jQuery("div.wpszbutton").click(function () {
    jQuery(this).parent().next().toggle(300);
    var v = jQuery(this).html().substring(0, 1);
    if (v == "+") jQuery(this).html("-" + jQuery(this).html().substring(1));
    else if (v == "-") jQuery(this).html("+" + jQuery(this).html().substring(1));
  });
});</script>';
    // end of script
 }

    function no_selection() {
        echo '<tr><td><span class="description">Leaves the general options intact. This page/post will have a background slider only if defined in the  <a href="'.get_admin_url().'themes.php?page=wp-supersized">Background Slider Options</a>.</span>';
        echo '</td></tr>';
    }

    function wpgallery_details() {
        echo '<tr><td><span class="description">Images from the WP Media Gallery attached to this post/page will be used.</span>';
        echo '</td></tr>';
    }

    function xml_file_details($supersizedDir) {
// XML file path
echo '';
    }

    function nggallery_details($supersizedDir, $supersizedNextGenGallery) {
// NextGEN Gallery ID
echo '<tr><th><label for="SupersizedNextGenGallery">NextGEN gallery to use</label></th><td>';
if (is_plugin_active('nextgen-gallery/nggallery.php') && method_exists('nggdb','find_all_galleries')) {
    echo '<select name="SupersizedNextGenGallery" id="SupersizedNextGenGallery">';
    global $nggdb;
    $nggGalleries = $nggdb->find_all_galleries();
    if($supersizedDir != 'ngg-gallery') $testDir->displayNggSelection = 'none';
    else $testDir->displayNggSelection = $supersizedNextGenGallery;
    if ($supersizedDir != 'ngg-gallery') echo '<option selected="selected" value="">none</option>';
    foreach ($nggGalleries as $gallery )
    {
        echo '<option', $testDir->displayNggSelection == $gallery->gid ? ' selected="selected"' : '', ' value="'.$gallery->gid.'">'.$gallery->name.'</option>';
    }
    echo '</select><br /><span class="description">Select here the NextGEN gallery that you want to use.</span>';
}
else echo '<span class="description">NextGEN Gallery does not seem to be installed.</span>';
echo '</td></tr>';
    }

    function custom_dir_details($supersizedDir) {
// Custom directory
echo '<tr><th><label for ="ListFolders">Select your custom directory. Click on folder name to show contained folders.</label></th><td>';
$wpContentFolder = WP_CONTENT_DIR;
if($supersizedDir != 'wp-gallery' && $supersizedDir != 'ngg-gallery' && $supersizedDir != 'flickr'&& $supersizedDir != 'picasa'&& $supersizedDir != 'smugmug' && $supersizedDir !='' && !WPSupersized::is_xml_file($supersizedDir))
    echo '<span class="description">Your currently selected custom directory is: '.content_url().'/'.$supersizedDir.'</span>';
$listFolders = self::directory_list($wpContentFolder,false,true,'.|..|.svn|cache|plugins|upgrade|themes|languages',true);
echo '<ul>';
self::display_array($listFolders, $supersizedDir);
echo '</ul>';
echo '</td></tr>';
self::output_folder_list_script();
    }

    function flickr_details($flickrOptions) {
// Flickr options
echo '<tr><th><label for ="FlickrOptions">Choose your Flickr options.</label></th><td>';
echo '<table class="form-table">';

// flickr_source
echo '<tr valign="top"><th scope="row">';
_e('Flickr Source','satori');
echo '</th><td><select id="flickr_source" name="flickr_source" value="0"';
$selected = ($flickrOptions[0] == '1') ? 'selected="selected"' : '';
echo "><option value='1' $selected>";
_e('Set','satori');
echo '</option>';
$selected = ($flickrOptions[0] == '2') ? 'selected="selected"' : '';
echo "<option value='2' $selected>";
_e('User','satori');
echo '</option>';
$selected = ($flickrOptions[0] == '3') ? 'selected="selected"' : '';
echo "<option value='3' $selected>";
_e('Group','satori');
echo '</option>';
$selected = ($flickrOptions[0] == '4') ? 'selected="selected"' : '';
echo "<option value='4' $selected>";
_e('Tags','satori');
echo '</option></select></tr>';

// flickr_set
echo '<tr valign="top"><th scope="row">';
_e('Flickr set ID','satori');
echo '</th><td><input type="text" name="flickr_set" value="'.$flickrOptions[1].'" size="30"></input> (';
_e('found in URL','satori');
echo ')</td></tr>';

// flickr_user
echo '<tr valign="top"><th scope="row">';
_e('Flickr user ID','satori');
echo '</th><td><input type="text" name="flickr_user" value="'.$flickrOptions[2].'" size="30"></input> (<a href="http://idgettr.com/">http://idgettr.com/</a>)</td></tr>';

// flickr_group
echo '<tr valign="top"><th scope="row">';
_e('Flickr group ID','satori');
echo '</th><td><input type="text" name="flickr_group" value="'.$flickrOptions[3].'" size="30"></input> (<a href="http://idgettr.com/">http://idgettr.com/</a>)</td></tr>';

// flickr_tags
echo '<tr valign="top"><th scope="row">';
_e('Flickr tags ID','satori');
echo '</th><td><input type="text" name="flickr_tags" value="'.$flickrOptions[4].'" size="80"></input> (separate them by a comma)</td></tr>';

// flickr_total_slides
echo '<tr valign="top"><th scope="row">';
_e('How many pictures to pull','satori');
echo '</th><td><input type="text" name="flickr_total_slides" value="'.$flickrOptions[5].'" size="5"></input> ';
_e('Between 1-500 (default is 100)','satori');
echo '</td></tr>';

// flickr_size
echo '<tr valign="top"><th scope="row">';
_e('Flickr Size','satori');
echo '</th><td><select id="flickr_size" name="flickr_size" value="0"';
$selected = ($flickrOptions[6] == 't') ? 'selected="selected"' : '';
echo "><option value='t' $selected>t</option>";
$selected = ($flickrOptions[6] == 's') ? 'selected="selected"' : '';
echo "<option value='s' $selected>s</option>";
$selected = ($flickrOptions[6] == 'm') ? 'selected="selected"' : '';
echo "<option value='m' $selected>m</option>";
$selected = ($flickrOptions[6] == 'z') ? 'selected="selected"' : '';
echo "<option value='z' $selected>z</option>";
$selected = ($flickrOptions[6] == 'b') ? 'selected="selected"' : '';
echo "<option value='b' $selected>b</option>";
echo '</select><br />';
_e('Details:','satori');
echo '<a href="http://www.flickr.com/services/api/misc.urls.html">http://www.flickr.com/services/api/misc.urls.html</a>';
echo '</td></tr>';

// flickr_sort_by
echo '<tr valign="top"><th scope="row">';
_e('Sort images by','satori');
echo '</th><td><select id="flickr_sort_by" name="flickr_sort_by" value="0"';
$selected = ($flickrOptions[7] == '1') ? 'selected="selected"' : '';
echo "><option value='1' $selected>";
_e('Date posted','satori');
echo '</option>';
$selected = ($flickrOptions[7] == '2') ? 'selected="selected"' : '';
echo "<option value='2' $selected>";
_e('Date taken','satori');
echo '</option>';
$selected = ($flickrOptions[7] == '3') ? 'selected="selected"' : '';
echo "<option value='3' $selected>";
_e('Interestingness','satori');
echo '</option></select> (';
_e('Default is Date posted','satori');
echo ')</tr>';

// flickr_sort_direction
echo '<tr valign="top"><th scope="row">';
_e('Sort direction','satori');
echo '</th><td><select id="flickr_sort_direction" name="flickr_sort_direction" value="0"';
$selected = ($flickrOptions[8] == '0') ? 'selected="selected"' : '';
echo "><option value='0' $selected>";
_e('Descending','satori');
echo '</option>';
$selected = ($flickrOptions[8] == '1') ? 'selected="selected"' : '';
echo "<option value='1' $selected>";
_e('Ascending','satori');
echo '</option></select> (';
_e('Default is Descending','satori');
echo ')</tr>';

// flickr_api_key
echo '<tr valign="top"><th scope="row">';
_e('Flickr API key','satori');
echo '</th><td><input type="text" name="flickr_api_key" value="'.$flickrOptions[9].'" size="40"></input><br />';
_e('You need to get your own','satori');
echo ' -- <a href="http://www.flickr.com/services/apps/create/">http://www.flickr.com/services/apps/create/</a></td></tr>';
echo '</table>';
    }

    function picasa_details($picasaOptions) {
// Picasa options
echo '<tr><th><label for ="PicasaOptions">Choose your Picasa options.</label></th><td>';
echo '<table class="form-table">';

// picasa_source
echo '<tr valign="top"><th scope="row">';
_e('Picasa Source','satori');
echo '</th><td><select id="picasa_source" name="picasa_source" value="0"';
$selected = ($picasaOptions[0] == '1') ? 'selected="selected"' : '';
echo "><option value='1' $selected>";
_e('Album','satori');
echo '</option>';
$selected = ($picasaOptions[0] == '2') ? 'selected="selected"' : '';
echo "<option value='2' $selected>";
_e('User','satori');
echo '</option>';
$selected = ($picasaOptions[0] == '3') ? 'selected="selected"' : '';
echo "<option value='3' $selected>";
_e('Tags','satori');
echo '</option></select></tr>';

// picasa_album
echo '<tr valign="top"><th scope="row">';
_e('Picasa Album name','satori');
echo '</th><td><input type="text" name="picasa_album" value="'.$picasaOptions[1].'" size="80"></input><br />';
echo '(';
_e('found in the URL of the link to this album','satori');
echo ')</td></tr>';

// picasa_user
echo '<tr valign="top"><th scope="row">';
_e('Picasa user name','satori');
echo '</th><td><input type="text" name="picasa_user" value="'.$picasaOptions[2].'" size="30"></input><br />';
echo '(';
_e('either you Picasa user name or the long number in the URL to your profile','satori');
echo ')</td></tr>';

// picasa_tags
echo '<tr valign="top"><th scope="row">';
_e('Picasa tags','satori');
echo '</th><td><input type="text" name="picasa_tags" value="'.$picasaOptions[3].'" size="80"></input><br />';
echo '(';
_e('comma- or "+"-separated = AND, "|"-separated = OR','satori');
echo ')</td></tr>';

// picasa_total_slides
echo '<tr valign="top"><th scope="row">';
_e('How many pictures to pull','satori');
echo '</th><td><input type="text" name="picasa_total_slides" value="'.$picasaOptions[4].'" size="5"></input> ';
_e('Between 1-500 (default is 100)','satori');
echo '</td></tr>';

// picasa_image_size
echo '<tr valign="top"><th scope="row">';
_e('Picasa image size','satori');
echo '</th><td><select id="picasa_image_size" name="picasa_image_size" value="0"';
$selected = ($picasaOptions[5] == '512') ? 'selected="selected"' : '';
echo "><option value='512' $selected>512</option>";
$selected = ($picasaOptions[5] == '640') ? 'selected="selected"' : '';
echo "<option value='640' $selected>640</option>";
$selected = ($picasaOptions[5] == '720') ? 'selected="selected"' : '';
echo "<option value='720' $selected>720</option>";
$selected = ($picasaOptions[5] == '800') ? 'selected="selected"' : '';
echo "<option value='800' $selected>800</option>";
$selected = ($picasaOptions[5] == '1024') ? 'selected="selected"' : '';
echo "<option value='1024' $selected>1024</option>";
$selected = ($picasaOptions[5] == '1280') ? 'selected="selected"' : '';
echo "<option value='1280' $selected>1280</option>";
$selected = ($picasaOptions[5] == '1440') ? 'selected="selected"' : '';
echo "<option value='1440' $selected>1440</option>";
$selected = ($picasaOptions[5] == '1600') ? 'selected="selected"' : '';
echo "<option value='1600' $selected>1600</option>";
$selected = ($picasaOptions[5] == 'd') ? 'selected="selected"' : '';
echo "<option value='d' $selected>";
_e('Original size','satori');
echo '</option>"';
echo '</select><br />';
_e('Picasa API will return the largest size available if your selection is larger than the original','satori');
echo '</td></tr>';

// picasa_sort_by
echo '<tr valign="top"><th scope="row">';
_e('Sort images by','satori');
echo '</th><td><select id="picasa_sort_by" name="picasa_sort_by" value="0"';
$selected = ($picasaOptions[6] == '0') ? 'selected="selected"' : '';
echo "><option value='0' $selected>";
_e('None','satori');
echo '</option>';
$selected = ($picasaOptions[6] == '1') ? 'selected="selected"' : '';
echo "<option value='1' $selected>";
_e('Date published','satori');
echo '</option>';
$selected = ($picasaOptions[6] == '2') ? 'selected="selected"' : '';
echo "<option value='2' $selected>";
_e('Date updated','satori');
echo '</option></select> (';
_e('Default is Date published','satori');
echo ')</tr>';

// picasa_sort_direction
echo '<tr valign="top"><th scope="row">';
_e('Sort direction','satori');
echo '</th><td><select id="picasa_sort_direction" name="picasa_sort_direction" value="0"';
$selected = ($picasaOptions[7] == '0') ? 'selected="selected"' : '';
echo "><option value='0' $selected>";
_e('Descending','satori');
echo '</option>';
$selected = ($picasaOptions[7] == '1') ? 'selected="selected"' : '';
echo "<option value='1' $selected>";
_e('Ascending','satori');
echo '</option></select> (';
_e('Default is Descending','satori');
echo ')</tr>';

// picasa_auth_key
echo '<tr valign="top"><th scope="row">';
_e('Picasa Author key','satori');
echo '</th><td><input type="text" name="picasa_auth_key" value="'.$picasaOptions[8].'" size="60"></input><br />';
echo '(';
_e('required for private albums, found in the URL of the link to an album (each album has a different author key)','satori');
echo ')</td></tr>';

echo '</table>';
    }

    function smugmug_details($smugmugOptions) {
    // Smugmug options
    echo '<tr><th><label for ="PicasaOptions">Choose your Smugmug options.</label></th><td>';
    echo '<table class="form-table">';

    // smugmug_source
    echo '<tr valign="top"><th scope="row">';
    _e('Smugmug Source','satori');
    echo '</th><td><select id="smugmug_source" name="smugmug_source" value="0"';
    $selected = ($smugmugOptions[0] == '1') ? 'selected="selected"' : '';
    echo "><option value='1' $selected>";
    _e('Keyword','satori');
    echo '</option>';
    $selected = ($smugmugOptions[0] == '2') ? 'selected="selected"' : '';
    echo "<option value='2' $selected>";
    _e('User (+keyword)','satori');
    echo '</option>';
    $selected = ($smugmugOptions[0] == '3') ? 'selected="selected"' : '';
    echo "<option value='3' $selected>";
    _e('Gallery','satori');
    echo '</option>';
    $selected = ($smugmugOptions[0] == '4') ? 'selected="selected"' : '';
    echo "<option value='4' $selected>";
    _e('Category','satori');
    echo '</option></select></tr>';

    // smugmug_keyword
    echo '<tr valign="top"><th scope="row">';
    _e('Smugmug keyword','satori');
    echo '</th><td><input type="text" name="smugmug_keyword" value="'.$smugmugOptions[1].'" size="80"></input><br />(';
    _e('Comma-separated Smugmug keywords (they are combined)','satori');
    echo ')</td></tr>';

    // smugmug_user
    echo '<tr valign="top"><th scope="row">';
    _e('Smugmug user nickname','satori');
    echo '</th><td><input type="text" name="smugmug_user" value="'.$smugmugOptions[2].'" size="30"></input></td></tr>';

    // smugmug_gallery
    echo '<tr valign="top"><th scope="row">';
    _e('Smugmug gallery ID','satori');
    echo '</th><td><input type="text" name="smugmug_gallery" value="'.$smugmugOptions[3].'" size="50"></input></td></tr>';

    // smugmug_category
    echo '<tr valign="top"><th scope="row">';
    _e('Smugmug category','satori');
    echo '</th><td><input type="text" name="smugmug_category" value="'.$smugmugOptions[4].'" size="50"></input></td></tr>';

    // smugmug_total_slides
    echo '<tr valign="top"><th scope="row">';
    _e('How many pictures to pull','satori');
    echo '</th><td><input type="text" name="smugmug_total_slides" value="'.$smugmugOptions[5].'" size="5"></input><br />';
    _e('Between 1-100. This is currently the maximum allowed by the Google Feed API used by the plugin to get the images','satori');
    echo '</td></tr>';

    // smugmug_image_size
    echo '<tr valign="top"><th scope="row">';
    _e('Smugmug Size','satori');
    echo '</th><td><select id="smugmug_image_size" name="smugmug_image_size" value="0"';
    $selected = ($smugmugOptions[6] == '0') ? 'selected="selected"' : '';
    echo "><option value='0' $selected>Tiny</option>";
    $selected = ($smugmugOptions[6] == '1') ? 'selected="selected"' : '';
    echo "<option value='1' $selected>Thumb</option>";
    $selected = ($smugmugOptions[6] == '2') ? 'selected="selected"' : '';
    echo "<option value='2' $selected>Small</option>";
    $selected = ($smugmugOptions[6] == '3') ? 'selected="selected"' : '';
    echo "<option value='3' $selected>Medium</option>";
    $selected = ($smugmugOptions[6] == '4') ? 'selected="selected"' : '';
    echo "<option value='4' $selected>Large</option>";
    $selected = ($smugmugOptions[6] == '5') ? 'selected="selected"' : '';
    echo "<option value='5' $selected>XLarge</option>";
    $selected = ($smugmugOptions[6] == '6') ? 'selected="selected"' : '';
    echo "<option value='6' $selected>X2Large</option>";
    $selected = ($smugmugOptions[6] == '7') ? 'selected="selected"' : '';
    echo "<option value='7' $selected>X3Large</option>";
    $selected = ($smugmugOptions[6] == '8') ? 'selected="selected"' : '';
    echo "<option value='8' $selected>Original</option>";
    echo '</select><br />';
    _e('Details ','satori');
    echo '<a href="http://help.smugmug.com/customer/portal/articles/93250">';
    _e('here','satori');
    echo'</a>';
    echo '</td></tr>';

    // smugmug_sort_by
    echo '<tr valign="top"><th scope="row">';
    _e('Sort images by','satori');
    echo '</th><td><select id="smugmug_sort_by" name="smugmug_sort_by" value="0"';
    $selected = ($smugmugOptions[7] == '0') ? 'selected="selected"' : '';
    echo "><option value='0' $selected>";
    _e('None (original order)','satori');
    echo '</option>';
    $selected = ($smugmugOptions[7] == '1') ? 'selected="selected"' : '';
    echo "<option value='1' $selected>";
    _e('Date posted','satori');
    echo '</option></select></tr>';

    // smugmug_sort_direction
    echo '<tr valign="top"><th scope="row">';
    _e('Sort direction','satori');
    echo '</th><td><select id="smugmug_sort_direction" name="smugmug_sort_direction" value="0"';
    $selected = ($smugmugOptions[8] == '0') ? 'selected="selected"' : '';
    echo "><option value='0' $selected>";
    _e('Descending','satori');
    echo '</option>';
    $selected = ($smugmugOptions[8] == '1') ? 'selected="selected"' : '';
    echo "<option value='1' $selected>";
    _e('Ascending','satori');
    echo '</option></select></tr>';
        
    echo '</table>';
        }
    
}
endif;
/* EOF */