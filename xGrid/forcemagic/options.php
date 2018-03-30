<?php
$themename = "XGrid";
$shortname = "xgrid";
$themefolder = "xgrid";

define ('theme_name', $themename);
define ('theme_ver' , 1);
define ('xgrid' , $themename);
define ('SHORTNAME', $shortname);

/**
 *  Theme update
 */
function wp_register_theme_activation_hook($code, $function){
    $optionKey="theme_is_activated_" . $code;
    if(!get_option($optionKey)){
        call_user_func($function);
        update_option($optionKey , 1);
    }
}
wp_register_theme_activation_hook($shortname, 'bd_theme_activate');

/**
 * Admin Bar Render
 */
function bd_admin_bar_render(){
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'parent' 	=> 0,
		'id' 		=> 'bdayh',
		'title' 	=> 'XGrid',
		'href' 		=> admin_url( 'admin.php?page=options.php'),
		'meta' 		=> false
	    )
    );
}
add_action( 'wp_before_admin_bar_render', 'bd_admin_bar_render' );

/**
 *  Theme Activate
 */
function bd_theme_activate(){
    if(!is_array($GLOBALS['def_options'])){
        include ( get_template_directory().'/forcemagic/default.php' );
    }
    update_option('bdayh_setting', serialize($GLOBALS['def_options']));
    return(true);
}

/**
 * Admin Scripts
 */
function bd_admin_scripts(){

    global $pagenow;
    wp_register_script( 'bd-custom', get_template_directory_uri().'/forcemagic/js/custom.js', array( 'jquery' ), false, false);
    wp_register_script( 'bd-tmpl', get_template_directory_uri().'/forcemagic/js/jquery.tmpl.js', array( 'jquery' ), false, false);
    //wp_register_script( 'jquery-ui-min', get_template_directory_uri().'/forcemagic/js/jquery-ui.min.js', array( 'jquery' ), false, false);
    wp_register_script( 'bd-colorpicker', get_template_directory_uri().'/forcemagic/js/colorpicker.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-sortable', 'jquery-ui-slider' ) , false , false );
    wp_register_style( 'bd-main', get_template_directory_uri().'/forcemagic/css/main.css', '', null , 'all');

    wp_register_style( 'bd-colorpicker', get_template_directory_uri().'/forcemagic/css/colorpicker.css', '', null , 'all');


    if ( ( isset($_GET['page']) and $_GET['page'] == basename(__FILE__) ) || (  $pagenow == 'post-new.php' ) || (  $pagenow == 'post.php' )|| (  $pagenow == 'edit-tags.php' ) ) {
        wp_enqueue_script( 'bd-colorpicker' );
    }

    if ( isset( $_GET['page'] ) && $_GET['page'] == basename(__FILE__) ) {
        wp_enqueue_script( 'bd-tmpl' );

    }

    wp_enqueue_script( 'bd-custom' );
    wp_enqueue_style( 'bd-main' );
}
add_action('admin_enqueue_scripts', 'bd_admin_scripts');



/**
 * GET categories
 */
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ){
    $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}

/**
 * Setting
 */
include ( get_template_directory().'/forcemagic/setting.php' );
function themename_add_admin(){
    global $themename, $shortname, $bd_options;
    if ( isset($_GET['page']) and $_GET['page'] == basename(__FILE__) ){
        if (isset($_GET['do']) and $_GET['do'] == 'submit' and $_POST)
        {
            if( $_POST['advanced_import'] )
            {
                ## base64_decode
                $import = base64_decode($_POST['advanced_import']);
                update_option('bdayh_setting', $import);
                echo '#message_success';
                die;
            }

			$bdayh_params = array();
			//parse_str($_POST, $bdayh_params);
			$var_post['bd_setting'] = $_POST;
            $var_post['bd_setting']['advanced_import'] = '';
            $var_post['bd_setting']['advanced_export'] = '';
            $option_arr = serialize($var_post);
            update_option('bdayh_setting', $option_arr);
            echo '#message_success';
            die;
        } else if(isset($_GET['do']) and  $_GET['do'] == 'download'){
            ## base64_encode
            $bd_option = base64_encode(get_option('bdayh_setting'));
            header("Content-Type: application/xml");
            header("Content-Transfer-Encoding: binary");
            header("Cache-Control: private",false);
            header("Content-Disposition: attachment; filename=\"xGrid-" . time()  . ".txt\";" );
            echo $bd_option;
            exit();
        } else if(isset($_GET['do']) and $_GET['do'] == 'reset'){
            if( !is_array( $GLOBALS['def_options'] ) ){
                include ( get_template_directory().'/forcemagic/default.php' );
            }
            update_option('bdayh_setting', serialize($GLOBALS['def_options']));
            header("Location: admin.php?page=options.php");
            die;
        }
    }

    $icon = BD_ADMIN_IMG .'/icon.png';
    add_menu_page( $themename.' Settings', $themename,'switch_themes', 'options.php' , 'themename_admin', $icon  );
}

/**
 * GET Setting
 */
function bd_option( $id ){
    global $themename, $shortname, $bd_options,$all_setting;
    if( get_option( $GLOBALS['shortname'].'_'.$id ) ){
        return( get_option( $GLOBALS['shortname'].'_'.$id ) );
    } else {
        return( $all_setting[$GLOBALS['shortname'].'_'.$id] );
    }
}

/**
 * Admin
 */
function themename_admin(){
    global $themename, $shortname, $bd_options,$wp_cats;
    $i=0;
    echo '<div id="message_success" style="display:none;" class="notification fade"><span class="notification_icon"></span>Options Updated</div>';
    echo '<div id="message_wait" style="display:none;" class="notification fade"><span class="notification_icon"></span>Please Wait</div>';
    echo '<div id="message_error" style="display:none;" class="notification bd_alert fade"><span class="notification_icon"></span> Resetting work</div>';
    $bd_option = unserialize(get_option('bdayh_setting'));
    include ( get_template_directory().'/forcemagic/functions.php' );
    ?>
    <script type="text/javascript">
        <?php if( isset( $bd_option['bd_setting']['home'] ) ) { ?>
            var total_boxes = <?php if( is_array( $bd_option['bd_setting']['home'] ) ){ echo max( array_keys( $bd_option['bd_setting']['home'] ) ) + 1; } else { echo 1; } ?>;
        <?php } else { ?>
            var total_boxes = 1;
        <?php } ?>
        jQuery(document).ready(function(){
		jQuery( "#setting_form" ).on( "submit", function( event ) {
		  event.preventDefault();
		  var str = jQuery("#setting_form").serializeArray();
		  //str = str.replace(/&?[^=]+=&|&[^=]+=$/g,'');
    		jQuery.ajax({
                    url: 'admin.php?page=options.php&do=submit',
                    data: str,
                    type: 'POST',
					beforeSend: function( data ) {
                        jQuery('#message_wait').show();
					},
                    success: function(data)
                    {
                        if( data == '#message_success' ){
                        	 jQuery('#message_wait').hide();
                            jQuery('#message_success').stop().fadeIn().fadeOut();
                        }
                    }
                });
		});
        });
    </script>
    <script type='text/javascript' src="<?php echo BD_ADMIN; ?>js/main.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.on-of').checkbox({empty:''});
        jQuery('.st_upload_button').click(function(){
            targetfield = jQuery(this).prev('.upload-url');
            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
            return false;
        });

        jQuery(".st_upload_button").live("click", function(){
            targetfield = jQuery(this).prev('.upload-url');
            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
            return false;
        });

        jQuery(".remove_img").live("click", function(){
            var img_id = jQuery(this).attr('id').replace("_remove", "");
            jQuery('#'+img_id).val('');
            jQuery('#'+img_id+'_img').fadeOut();
            return false;
        });

        window.send_to_editor = function(html){
            imgurl = jQuery('img',html).attr('src');
            jQuery(targetfield).val(imgurl);
            var up_img = jQuery(targetfield).attr('id')+ '_img';
            jQuery('#'+up_img).children('img').attr('src',imgurl);
            jQuery('#'+up_img).show();
            tb_remove();
        }
    });

    function add_tag(input_id,tag){
        var input_id;
        var tag;
        if(tag != ''){
            var input_val = jQuery('#'+input_id).val();
            if(input_val == ''){
                jQuery('#'+input_id).val(tag);
            } else {
                jQuery('#'+input_id).val(input_val+','+tag);
            }
        }
    }
    </script>
    <form name="setting_form" id="setting_form" action="/" method="get">
        <div id="bd-panel">
            <div id="bd-header">
                <div id="bd-logo"></div><!-- #logo -->
                <div id="bd-inputs">
                    <input name="save" class="butn bd-save" type="submit" value="Save All Changes" />
                </div>
                <div class="clear"></div>
            </div><!-- header/-->
            <div class="bd-header-divider"></div><!-- divider -->
            <div id="bd-main" class="bd-main">
                <div class="clear"></div>
                <div id="bd-panel-tabs">
                    <ul>
                        <?php
                        if(is_array($bd_options)){
                            foreach($bd_options as $k => $v){
                                echo '<li class="'. $k .'"><a href="#'. $k .'" >'. ucfirst(str_replace("_"," ",$k)) .'</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </div><!-- tabs/-->
                <div class="bd-panel-tabs-bg"></div><!-- tabs bg -->
                <div id="bd-panel-container">
                <?php
                    if( is_array( $bd_options ) ){
                        $list_sum = array();
                        foreach( $bd_options as $k => $v ){
                            $sub_item = 0; ?>
                            <div class="box_tabs_container" id="<?php echo $k; ?>">
                                <h1 id="bd-top-title"><?php echo ucfirst(str_replace("_"," ",$k)); ?></h1>
                                <div class="tab_content">
                                    <?php
                                        if(is_array($v)){
                                            foreach($v as $key => $input){
                                                if(isset($input['name']) and $input['name'] != ''){
                                                    get_admin_tab($input);
                                                } else { ?>
                                                <div class="bd_item">
                                                    <?php
                                                        foreach($input as $sub) {
                                                            get_admin_tab($sub,false);
                                                        }
                                                    ?>
                                                </div>
                                                <?php
                                                }
                                            }
                                        }
                                    ?>
                                </div>
                                <?php unset($sub_item); ?>
                            </div>
                            <?php
                        }
                    }
                ?>
                </div><!-- container/-->
                <div class="clear"></div>
            </div><!-- main/-->
            <div class="bd-footer-divider"></div>
            <div id="bd-footer" class="bd_footer">
                <input name="save" class="butn bd-save" type="submit" value="Save All Changes" />
                <script type="text/javascript">
                    function is_confirm(){
                        if(confirm('Are you sure ?')){
                            window.location='admin.php?page=options.php&do=reset';
                        } else {
                            return false;
                        }
                    }
                </script>
                <input name="reset" class="butn bd-rest" type="button" onclick="return(is_confirm());" value="Options Reset" />
            </div><!-- footer/-->
        </div><!-- panel/-->
    </form>
    <div class="gotop" title="Go Top"></div><!-- Go top -->
    <?php
}

function themename_add_init(){
    wp_enqueue_script('thickbox');
    wp_enqueue_script('my-upload');
    wp_enqueue_style('thickbox');
    if ( ( isset($_GET['page']) and $_GET['page'] == basename(__FILE__) )) {
        wp_enqueue_media();
    }
}
add_action('admin_init', 'themename_add_init');
add_action('admin_menu', 'themename_add_admin');

?>