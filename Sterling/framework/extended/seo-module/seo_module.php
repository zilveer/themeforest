<?php
/*
Plugin Name: All in One SEO Pack
Plugin URI: http://semperfiwebdesign.com
Description: Out-of-the-box SEO for your Wordpress blog. <a href="options-general.php?page=all-in-one-seo-pack/aioseop.class.php">Options configuration panel</a> | <a href="http://wpplugins.com/plugin/50/all-in-one-seo-pack-pro-version">Upgrade to Pro Version</a> | <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=mrtorbert%40gmail%2ecom&item_name=All%20In%20One%20SEO%20Pack&item_number=Support%20Open%20Source&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8">Donate</a> | <a href="http://semperfiwebdesign.com/forum/" >Support</a> |  <a href="https://www.amazon.com/wishlist/1NFQ133FNCOOA/ref=wl_web" target="_blank" title="Amazon Wish List">Amazon Wishlist</a>
Version: 1.6.13.3
Author: Michael Torbert
Author URI: http://michaeltorbert.com
*/

/*
Copyright (C) 2008-2009 Michael Torbert, semperfiwebdesign.com (michael AT semperfiwebdesign DOT com)
Original code by uberdose of uberdose.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


/*
* Modifications done as Truethemes extension.
* @since version 2.6
* List of mods includes the following
*
* 1) suppress all admin notices.
* 2) Changed WP_PLUGIN_DIR to use TRUETHEMES_EXTENDED
* 3) suppress all feed checks and server version check... etc
* 4) Adding of tt prefix to all function and class names
* 5) All suppress with commented by tt, so that we know what mods we done.
* 6) Commented out codes without tt is done by original plugin author.
* 7) Deleted all .pot and .mo files, The translations contain "All in One SEO Pack" and  other references to Original author. Will need to rebuilt if TT wants translations!
* 8) Deleted all Images and image folder.
* 9) Deleted readme.txt
* 10) Renamed file - all_in_one_seo_pack.php to seo_module.php
* 11) Renamed file - aioseop.class.php to seo_module_class.php
* 12) Deleted file - aioseop_options.php, because there is nothing! Blank file? Why?
* 13) Clean up and restyled options page.
*/

/*******************************************************************************************************/
//register_activation_hook(__FILE__,'aioseop_activate_pl');

if ( ! defined( 'WP_CONTENT_URL' ) )
    define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
    define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
    define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

//mod by tt to use TRUETHEMES_EXTENDED instead of  WP_PLUGIN_DIR
//changed file name from file aioseop.class.php to seo_module_class.php
require_once( TT_EXTENDED . '/seo-module/seo_module_class.php');

global $aioseop_options;
$aioseop_options = get_option('aioseop_options');



/*
add_option("aiosp_home_description", null, 'All in One SEO Plugin Home Description', 'yes');
add_option("aiosp_home_title", null, 'All in One SEO Plugin Home Title', 'yes');
add_option("aiosp_donate", 0, 'All in One SEO Pack Donate', 'no');
add_option("aiosp_can", 1, 'All in One SEO Pack Canonical URLs', 'yes');
add_option("aiosp_rewrite_titles", 1, 'All in One SEO Plugin Rewrite Titles', 'yes');
add_option("aiosp_use_categories", 0, 'All in One SEO Plugin Use Categories', 'yes');
add_option("aiosp_category_noindex", 1, 'All in One SEO Plugin Noindex for Categories', 'yes');
add_option("aiosp_archive_noindex", 1, 'All in One SEO Plugin Noindex for Archives', 'yes');
add_option("aiosp_tags_noindex", 0, 'All in One SEO Plugin Noindex for Tag Archives', 'yes');
add_option("aiosp_generate_descriptions", 1, 'All in One SEO Plugin Autogenerate Descriptions', 'yes');
add_option("aiosp_post_title_format", '%post_title% | %blog_title%', 'All in One SEO Plugin Post Title Format', 'yes');
add_option("aiosp_page_title_format", '%page_title% | %blog_title%', 'All in One SEO Plugin Page Title Format', 'yes');
add_option("aiosp_dynamic_postspage_keywords", 1, 'All in One SEO Plugin Dynamic Posts Page Keywords', 'yes');
add_option("aiosp_category_title_format", '%category_title% | %blog_title%', 'All in One SEO Plugin Category Title Format', 'yes');
add_option("aiosp_archive_title_format", '%date% | %blog_title%', 'All in One SEO Plugin Archive Title Format', 'yes');
add_option("aiosp_tag_title_format", '%tag% | %blog_title%', 'All in One SEO Plugin Tag Title Format', 'yes');
add_option("aiosp_search_title_format", '%search% | %blog_title%', 'All in One SEO Plugin Search Title Format', 'yes');
add_option("aiosp_description_format", '%description%', 'All in One SEO Plugin Description Format', 'yes');
add_option("aiosp_paged_format", ' - Part %page%', 'All in One SEO Plugin Paged Format', 'yes');
add_option("aiosp_404_title_format", 'Nothing found for %request_words%', 'All in One SEO Plugin 404 Title Format', 'yes');
add_option("aiosp_post_meta_tags", '', 'All in One SEO Plugin Additional Post Meta Tags', 'yes');
add_option("aiosp_page_meta_tags", '', 'All in One SEO Plugin Additional Post Meta Tags', 'yes');
add_option("aiosp_home_meta_tags", '', 'All in One SEO Plugin Additional Home Meta Tags', 'yes');
add_option("aiosp_do_log", null, 'All in One SEO Plugin write log file', 'yes');
*/

//$role = get_role('administrator');
//$role->add_cap('Edit AIOSEOP Options');
//$role->add_cap('Edit AIOSEOP on Posts/Pages');

////checking to see if things need to be updated

//if_post('turn-on'){
	
	/*   automattic?
if(!get_option('aioseop_options')){
	aioseop_mrt_fix_meta(); //move this to the if also 
	aioseop_mrt_mkarry();
	}
*/

if(isset($_POST['aioseop_migrate'])) tt_aioseop_mrt_fix_meta();
if(isset($_POST['aioseop_migrate_options'])) tt_aioseop_mrt_mkarry();
if(!get_option('aiosp_post_title_format') && !get_option('aioseop_options')) tt_aioseop_mrt_mkarry();

//}end _post('turn_on')


////end checking to see if things need to be updated


function tt_aioseop_mrt_fix_meta(){
global $wpdb;
$wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_aioseop_keywords' WHERE meta_key = 'keywords'");
$wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_aioseop_title' WHERE meta_key = 'title'");	
$wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_aioseop_description' WHERE meta_key = 'description'");
$wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_aioseop_meta' WHERE meta_key = 'aiosp_meta'");
$wpdb->query("UPDATE $wpdb->postmeta SET meta_key = '_aioseop_disable' WHERE meta_key = 'aiosp_disable'");
//echo "<div class='updated fade' style='background-color:green;border-color:green;'><p><strong>Updating SEO post meta in database.</strong></p></div";
}


/* suppress by tt
$aioseopcc = 0;
*/

function tt_aioseop_mrt_mkarry() {
$naioseop_options = array(
"aiosp_can"=>1,
"aiosp_donate"=>0,
"aiosp_home_title"=>null,
"aiosp_home_description"=>'',
"aiosp_home_keywords"=>null,
"aiosp_max_words_excerpt"=>'something',
"aiosp_rewrite_titles"=>1,
"aiosp_post_title_format"=>'%post_title% | %blog_title%',
"aiosp_page_title_format"=>'%page_title% | %blog_title%',
"aiosp_category_title_format"=>'%category_title% | %blog_title%',
"aiosp_archive_title_format"=>'%date% | %blog_title%',
"aiosp_tag_title_format"=>'%tag% | %blog_title%',
"aiosp_search_title_format"=>'%search% | %blog_title%',
"aiosp_description_format"=>'%description%',
"aiosp_404_title_format"=>'Nothing found for %request_words%',
"aiosp_paged_format"=>' - Part %page%',
"aiosp_use_categories"=>0,
"aiosp_dynamic_postspage_keywords"=>1,
"aiosp_category_noindex"=>1,
"aiosp_archive_noindex"=>1,
"aiosp_tags_noindex"=>0,
"aiosp_cap_cats"=>1,
"aiosp_generate_descriptions"=>0,
"aiosp_debug_info"=>null,
"aiosp_post_meta_tags"=>'',
"aiosp_page_meta_tags"=>'',
"aiosp_home_meta_tags"=>'',
"aiosp_enabled" =>0,
"aiosp_enablecpost" => 0,
"aiosp_use_tags_as_keywords" =>1,
"aiosp_seopostcol" =>1,
"aiosp_seocustptcol" => 0,
"aiosp_posttypecolumns" => array('post','page'),
"aiosp_do_log"=>null);

if(get_option('aiosp_post_title_format')){
foreach( $naioseop_options as $aioseop_opt_name => $value ) {
		if( $aioseop_oldval = get_option($aioseop_opt_name) ) {
			$naioseop_options[$aioseop_opt_name] = $aioseop_oldval;
			
		}
		if( $aioseop_oldval == ''){
                          $naioseop_options[$aioseop_opt_name] = '';
                      }
        
		delete_option($aioseop_opt_name);
	}
}

add_option('aioseop_options',$naioseop_options);
//suppress by tt
//echo "<div class='updated fade' style='background-color:green;border-color:green;'><p><strong>Updating SEO configuration options in database</strong></p></div";

}
//if( function_exists( 'is_site_admin' ) ) {

function tt_aioseop_activation_notice(){
	global $aioseop_options;
				if(function_exists('admin_url')){
				//suppress by tt.
	//			echo '<div class="error fade" style="background-color:red;"><p><strong>All in One SEO Pack must be configured. Go to <a href="' . admin_url( 'options-general.php?page=all-in-one-seo-pack/aioseop.class.php' ) . '">the admin page</a> to enable and configure the plugin.</strong><br />All in One SEO Pack now supports <em>Custom Post Types</em>.</p></div>';
}else{
//		echo '<div class="error fade" style="background-color:red;"><p><strong>All in One SEO Pack must be configured. Go to <a href="' . get_option('siteurl') . 'options-general.php?page=all-in-one-seo-pack/aioseop.class.php' . '">the admin page</a> to enable and configure the plugin.</strong></p></div>';
}
}
/** suppress by tt
if($aioseopcc){
	if(tt_aioseop_get_version() != trim(wp_remote_fopen('http://aioseoppro.semperfiwebdesign.com/version.html'))){
		add_action('after_plugin_row_all-in-one-seo-pack-pro/all_in_one_seo_pack.php', 'tt_add_plugin_row', 10, 2);
	}
}
**/
function tt_aioseop_activate_pl(){
	if(get_option('aioseop_options')){
		$aioseop_options = get_option('aioseop_options');
		$aioseop_options['aiosp_enabled'] = "0";
		
		if(!$aioseop_options['aiosp_posttypecolumns']){
			$aioseop_options['aiosp_posttypecolumns'] = array('post','page');
		}
		
		update_option('aioseop_options',$aioseop_options);
	}
}

if($aioseop_options['aiosp_can'] == '1' || $aioseop_options['aiosp_can'] == 'on'){
        remove_action( 'wp_head', 'rel_canonical' );
}

function tt_aioseop_get_version(){
	//mod by tt
	//return '1.6.13.3';
	return'';
}

function tt_add_plugin_row($links, $file) {
//suppress by tt
//echo '<td colspan="5" style="background-color:yellow;">';
//echo  wp_remote_fopen('http://aioseoppro.semperfiwebdesign.com/');
//echo '</td>';

}

//mod by tt
//change from Class All_in_One_SEO_Pack to TT_SEO_MODULE
$aiosp = new TT_SEO_MODULE();	

////////new stuff

//add_action('quick_edit_custom_box','tt_mys',10,2);

function tt_mys($col, $type){
	 
	?>
	
	
	<fieldset class="inline-edit-col-right"><div class="inline-edit-col">
	    <div class="inline-edit-group">
	        <label class="alignleft">
	            <input type="checkbox" value="1" name="aioseops" id="aioseos_check">
	            <span class="checkbox-title">stuff</span>
	        </label>
	    </div>
	</fieldset>
	<?php
}


add_action('load-edit.php','tt_addmycolumns',1);

function tt_addmycolumns(){
	$aioseop_options = get_option('aioseop_options');
	$aiosp_posttypecolumns = $aioseop_options['aiosp_posttypecolumns'];
//print_r($aiosp_posttypecolumns);

	if ( !isset($_GET['post_type']) ) $post_type = 'post';
		else    $post_type = $_GET['post_type'];


		if(is_array($aiosp_posttypecolumns) && in_array($post_type,$aiosp_posttypecolumns)) {
			if($post_type == 'page'){
				add_action('manage_pages_custom_column', 'tt_aioseop_mrt_pccolumn', 10, 2);
				add_filter('manage_pages_columns', 'tt_aioseop_mrt_pcolumns');

			}else{
				add_action('manage_posts_custom_column', 'tt_aioseop_mrt_pccolumn', 10, 2);
				add_filter('manage_posts_columns', 'tt_aioseop_mrt_pcolumns');
				}
			}

		}


function tt_aioseop_mrt_pcolumns($aioseopc) {
    $aioseopc['seotitle'] = __('SEO Title','tt_theme_framework');
    $aioseopc['seokeywords'] = __('SEO Keywords','tt_theme_framework');
    $aioseopc['seodesc'] = __('SEO Description','tt_theme_framework');
    return $aioseopc;
}

function tt_aioseop_mrt_pccolumn($aioseopcn, $aioseoppi) {
    if( $aioseopcn == 'seotitle' ) {
        echo get_post_meta($aioseoppi,'_aioseop_title',TRUE);
    }
    if( $aioseopcn == 'seokeywords' ) {
        echo get_post_meta($aioseoppi,'_aioseop_keywords',TRUE);
    }
    if( $aioseopcn == 'seodesc' ) {
        echo get_post_meta($aioseoppi,'_aioseop_description',TRUE);
    }

}


///////end new stuff
add_filter('wp_list_pages', 'tt_aioseop_list_pages');
add_action('edit_post', array($aiosp, 'post_meta_tags'));
add_action('publish_post', array($aiosp, 'post_meta_tags'));
add_action('save_post', array($aiosp, 'post_meta_tags'));
add_action('edit_page_form', array($aiosp, 'post_meta_tags'));
add_action('init', array($aiosp, 'init'));
add_action('wp_head', array($aiosp, 'wp_head'));
add_action('template_redirect', array($aiosp, 'template_redirect'));
add_action('admin_menu', array($aiosp, 'admin_menu'));
//add_action('admin_head',array($aiosp, 'seo_mrt_admin_head');
add_action('admin_menu', 'tt_aioseop_meta_box_add');
//add_action('admin_menu', 'tt_aioseop_mrt_nap');

function tt_aioseop_mrt_nap(){
//	add_object_page('All in One SEO Pack','All in One SEO Pack','administrator','aioseop','sometop2');
//	add_object_page('All in One SEO Pack', 'SEO', 8, "__FILE__", 'tt_aioseop_mrt_nap_menu2a','http://65.190.51.165/aioseo/wp-content/plugins/all-in-one-seo-pack/images/globe.png');
	
	
//suppress by tt, not in use 
//	add_submenu_page("__FILE__", 'Settings', 'Settings', 'manage_options', '__FILE__', 'aioseop_mrt_nap_menu2a');

//suppress by tt, not is use
//	add_submenu_page("__FILE__", 'Tools', 'Tools', 'manage_options', 'subpageb', 'aioseop_mrt_nap_menu2b');
}

function tt_aioseop_mrt_nap_menu(){
//	echo "hi"; //not in use
	
}

function tt_aioseop_mrt_nap_menu2a(){
//	echo "here1"; //not in use
}

function tt_aioseop_mrt_nap_menu2b(){
//	echo "here2"; //not in use
}

if(isset($_POST['aiosp_enabled'])):
if( ($_POST['aiosp_enabled'] == null && $aioseop_options['aiosp_enabled']!='1') || $_POST['aiosp_enabled']=='0'){
	//suppress by tt
	//add_action( 'admin_notices', 'tt_aioseop_activation_notice');
	}
endif;

// The following two functions are GPLed from Sarah G's Page Menu Editor, http://wordpress.org/extend/plugins/page-menu-editor/.
function tt_aioseop_list_pages($content){
	$matches = array();
	if (preg_match_all('/<li class="page_item page-item-(\d+)/i', $content, $matches)) {
		update_postmeta_cache(array_values($matches[1]));
		unset($matches);
		$pattern = '/<li class="page_item page-item-(\d+)([^\"]*)"><a href=\"([^\"]+)" title="([^\"]+)">([^<]+)<\/a>/i';
		return preg_replace_callback($pattern, "tt_aioseop_filter_callback", $content);
	}
	return $content;
	}

function tt_aioseop_filter_callback($matches) {
	global $wpdb;
	if ($matches[1] && !empty($matches[1])) $postID = $matches[1];
	if (empty($postID)) $postID = get_option("page_on_front");
	$title_attrib = stripslashes(get_post_meta($postID, '_aioseop_titleatr', true));
	$menulabel = stripslashes(get_post_meta($postID, '_aioseop_menulabel', true));
	if (empty($menulabel)) $menulabel = $matches[4];
	if (!empty($title_attrib)) :
		$filtered = '<li class="page_item page-item-'.$postID.$matches[2].'"><a href="'.$matches[3].'" title="'.$title_attrib.'">'.$menulabel.'</a>';
	else :
    	$filtered = '<li class="page_item page-item-'.$postID.$matches[2].'"><a href="'.$matches[3].'" title="'.$matches[4].'">'.$menulabel.'</a>';
	endif;
	return $filtered;
}

if (substr($aiosp->wp_version, 0, 3) < '2.5') {
        add_action('dbx_post_advanced', array($aiosp, 'add_meta_tags_textinput'));
        add_action('dbx_page_advanced', array($aiosp, 'add_meta_tags_textinput'));
}

function tt_aioseop_meta_box_add() {
	if ( function_exists('add_meta_box') ) {
		if( function_exists('get_post_types')){		
			$mrt_aioseop_pts=get_post_types('','names'); 
			$aioseop_options = get_option('aioseop_options');
			$aioseop_mrt_cpt = $aioseop_options['aiosp_enablecpost'];
			foreach ($mrt_aioseop_pts as $mrt_aioseop_pt) {
				if($mrt_aioseop_pt == 'post' || $mrt_aioseop_pt == 'page' || $aioseop_mrt_cpt){
				
					//mod by tt, change meta box title to SEO Module
					add_meta_box('aiosp',__('SEO Settings', 'tt_theme_framework'),'tt_aiosp_meta',$mrt_aioseop_pt);
				}
			}
		}else{
		
		    //mod by tt, change meta box title to SEO Module
			add_meta_box('aiosp',__('SEO Settings', 'tt_theme_framework'),'tt_aiosp_meta','post');
			add_meta_box('aiosp',__('SEO Settings', 'tt_theme_framework'),'tt_aiosp_meta','page');
		}

	} else {
		add_action('dbx_post_advanced', array($aiosp, 'add_meta_tags_textinput'));
		add_action('dbx_page_advanced', array($aiosp, 'add_meta_tags_textinput'));
	}
}

function tt_aiosp_meta() {
	global $post;
	$post_id = $post;
	if (is_object($post_id)) $post_id = $post_id->ID;
 	$keywords = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_keywords', true)));
    	$title = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_title', true)));
	$description = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_description', true)));
   	$aiosp_meta = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aiosp_meta', true)));
    	$aiosp_disable = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_disable', true)));
    	$aiosp_titleatr = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_titleatr', true)));
    	$aiosp_menulabel = htmlspecialchars(stripcslashes(get_post_meta($post_id, '_aioseop_menulabel', true)));	
	?>
		<SCRIPT LANGUAGE="JavaScript">
		<!-- Begin
		function countChars(field,cntfield) {
		cntfield.value = field.value.length;
		}
		//  End -->
		</script>
		<input value="aiosp_edit" type="hidden" name="aiosp_edit" />



<!--Note by TT: The codes below are for constructing html of post meta box!-->

		<table style="margin-bottom:40px">
		<tr>
		<th style="text-align:left;" colspan="2">
		</th>
		</tr>

		<tr>
		<th scope="row" style="text-align:right;"><?php _e('Title:', 'tt_theme_framework') ?></th>
		<td><input value="<?php echo $title ?>" type="text" name="aiosp_title" size="62" onKeyDown="countChars(document.post.aiosp_title,document.post.lengthT)" onKeyUp="countChars(document.post.aiosp_title,document.post.lengthT)"/><br />
			<input readonly type="text" name="lengthT" size="3" maxlength="3" style="text-align:center;" value="<?php echo strlen($title);?>" />
			<?php _e(' characters. Most search engines use a maximum of 60 chars for the title.', 'tt_theme_framework') ?>
			</td>
		</tr>
		
		<tr>
		<th scope="row" style="text-align:right;"><?php _e('Description:', 'tt_theme_framework') ?></th>
		<td><textarea name="aiosp_description" rows="3" cols="60"
		onKeyDown="countChars(document.post.aiosp_description,document.post.length1)"
		onKeyUp="countChars(document.post.aiosp_description,document.post.length1)"><?php echo $description ?></textarea><br />
		<input readonly type="text" name="length1" size="3" maxlength="3" value="<?php echo strlen($description);?>" />
		<?php _e(' characters. Most search engines use a maximum of 160 chars for the description.', 'tt_theme_framework') ?>
		</td>
		</tr>

		<tr>
		<th scope="row" style="text-align:right;"><?php _e('Keywords (comma separated):', 'tt_theme_framework') ?></th>
		<td><input value="<?php echo $keywords ?>" type="text" name="aiosp_keywords" size="62"/></td>
		</tr>
		<input type="hidden" name="nonce-aioseop-edit" value="<?php echo wp_create_nonce('edit-aioseop-nonce') ?>" />
<?php if($post->post_type=='page'){ ?>
		<tr>
		<th scope="row" style="text-align:right;"><?php _e('Title Attribute:', 'tt_theme_framework') ?></th>
		<td><input value="<?php echo $aiosp_titleatr ?>" type="text" name="aiosp_titleatr" size="62"/></td>
		</tr>
		
		<tr>
		<th scope="row" style="text-align:right;"><?php _e('Menu Label:', 'tt_theme_framework') ?></th>
		<td><input value="<?php echo $aiosp_menulabel ?>" type="text" name="aiosp_menulabel" size="62"/></td>
		</tr>
<?php } ?>
		<tr>
		<th scope="row" style="text-align:right; vertical-align:top;">
		<?php _e('Disable on this page/post:', 'tt_theme_framework')?>
		</th>
		<td>
		<input type="checkbox" name="aiosp_disable" <?php if ($aiosp_disable) echo "checked=\"1\""; ?>/>
		</td>
		</tr>
		</table>
	<?php
}
?>