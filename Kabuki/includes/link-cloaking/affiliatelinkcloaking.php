<?php
/*
Plugin Name: Affiliate Link Cloaking
Plugin URI:  http://www.clionpid.com/
Description: Cloaking your affiliate links and tracking the hits and unique visitors of each link. 
Version: 1.3.2
Author: Clionpid
Author URI:  http://www.clionpid.com/
*/

/*
GNU General Public License, Free Software Foundation <http://creativecommons.org/licenses/GPL/2.0/>
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


function menu_main()
{
    require_once('ui_main.php');
}
function submenu_addnewlink()
{
    require_once('ui_addnewlink.php');
}
function submenu_linktrack()
{
    require_once('ui_track.php');
}
function submenu_options()
{
    require_once('ui_options.php');
}

function add_mysetting()
{
    add_menu_page('Affiliate Link Cloaking','Link Cloaking','manage_options', 'affiliate-link-cloaking/affiliatelinkcloaking.php','menu_main', get_template_directory_uri().'/includes/link-cloaking/img/AffIcon_16.png' );
    add_submenu_page('affiliate-link-cloaking/affiliatelinkcloaking.php','Add New Link','Add New Link','manage_options','affiliate-link-cloaking/ui_addnewlink.php','submenu_addnewlink');
    add_submenu_page('affiliate-link-cloaking/affiliatelinkcloaking.php','Link Status','Link Status','manage_options','affiliate-link-cloaking/ui_track.php','submenu_linktrack');
    add_submenu_page('affiliate-link-cloaking/affiliatelinkcloaking.php','Options','Options','manage_options','affiliate-link-cloaking/ui_options.php','submenu_options');
}

add_action('admin_menu', 'add_mysetting');

/////////////////////////////////////////////////////////////////////////////////////////////////

require_once('dbtable.php');

global $afflctable;
$afflctable=new afflinkcloaking_dbtable();

///////////////////////////////////////////////////////////////////////////////////////////////
$afflc_options = $afflctable->afflinkcloaking_option_get();
if ( $afflc_options['metabox'] == "yes" )
{
    add_action( 'add_meta_boxes', 'afflc_add_custom_box' );
    add_action( 'save_post', 'afflc_save_postdata' );
}

function afflc_add_custom_box() {
    add_meta_box( 
        'afflc_boxid',
        'Affiliate Link Cloaking',
        'afflc_inner_custom_box',
        'post' 
    );
    add_meta_box(
        'afflc_boxid',
        'Affiliate Link Cloaking', 
        'afflc_inner_custom_box',
        'page'
    );
}
function afflc_inner_custom_box( $post )
{
    wp_nonce_field( plugin_basename( __FILE__ ), 'affiliatelinkcloaking_noncename' );
    require_once('ui_metabox.php');
}
function afflc_save_postdata( $post_id )
{
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if ( !isset($_POST['affiliatelinkcloaking_noncename']) ) return;
    if ( !wp_verify_nonce( $_POST['affiliatelinkcloaking_noncename'], plugin_basename( __FILE__ ) ) ) return;

    if ( 'page' == $_POST['post_type'] ) 
    {
        if ( !current_user_can( 'edit_page', $post_id ) ) return;
    }
    else
    {
        if ( !current_user_can( 'edit_post', $post_id ) ) return;
    }

    $linknums = $_POST['afflcaddlinknums'];

    for($i=0;$i<$linknums;$i++)
    {
        $addcloak = $_POST['cloaklinkinput'.$i];
        $addaff = $_POST['afflinkinput'.$i];
        $addtitle = $_POST['titleinput'.$i];
        $addautoshortlink = 0;
        if ( $_POST['autoshortlink'.$i] == 'yes' ) $addautoshortlink = 1;
        if ( $addtitle == '' ) $addtitle=$addcloak;
      
        if ( strlen($addcloak)>0 && strlen($addaff)>0 )
        {
            global $afflctable;
            if ( $afflctable->GetLinkByCloakLink($addcloak) == NULL ) 
                $results=$afflctable->AddLink($addcloak, $addaff, $addautoshortlink, $addtitle);
        }
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////
add_action('init', 'afflinkcloaking_redirectandtrack');

function afflinkcloaking_redirectandtrack()
{   

    global $afflctable;
    
    $tmp_clink=$_SERVER["REQUEST_URI"];
    $blogurlarray=parse_url(home_url());
    if ( !isset($blogurlarray['path']) ) $blogurlarray['path']='';
    $blogsubdir=$blogurlarray['path'];
    if ( strlen($blogsubdir) > 0 )
    {
        $tmp_clink=substr($tmp_clink,strlen($blogsubdir) );
    }
    $tmp_clink=substr($tmp_clink,1);

    $curlink=$afflctable->GetLinkByCloakLink($tmp_clink);   
    if ( isset($curlink) )
    {
        $tmp_visitorcookie = $tmp_clink.$_SERVER["REMOTE_ADDR"].time();
        if ( !isset( $_COOKIE[$tmp_clink] ) )
        {
            $cookiedomain = home_url();
            $cookiedomain = str_ireplace('http://','',$cookiedomain);
            $cookiedomain = str_ireplace('www','',$cookiedomain);
            if ( substr( $cookiedomain,strlen($cookiedomain)-1,1 ) == '/' ) $cookiedomain = substr( $cookiedomain, 0, strlen($cookiedomain)-1 );
            setcookie($tmp_clink, $tmp_visitorcookie, time()+3600*24*30 , '/' , $cookiedomain );        
        }
        else
        {
            $tmp_visitorcookie=$_COOKIE[$tmp_clink];
        }        
           
        $afflctable->AddTrack($_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"], $tmp_visitorcookie, $curlink->id);
        $afflctable->AnalyseStatisticsDaily( time(), $curlink->id );

        wp_redirect( $curlink->afflink, 302);
        exit;
    }
     
}

//////////////////////////////////////////////////////////////////////////////////////
add_filter('the_content', 'afflc_autoshortlink');
add_filter( 'widget_display_callback', 'afflc_autoshortlink_for_widget', 100, 3 );

function afflc_autoshortlink($content)
{
    global $afflctable;
    $alllinks = $afflctable->GetAllLinks();
    
    foreach( $alllinks as $onelink )
    {
        if ( 1 == $onelink->autoshortlink )
        {
           //for '&' problem
           $afflink = array();
           $afflink[0] = str_ireplace( '&', '&#038;', $onelink->afflink);  //link has '&'
           $afflink[1] = str_ireplace( '&', '&amp;', $onelink->afflink);  //link has '&amp;' as '&'

           $shortlink=home_url().'/'.$onelink->cloaklink;
           $content = str_ireplace( $afflink[0], $shortlink , $content ); 
           $content = str_ireplace( $afflink[1], $shortlink , $content ); 
        }  
    }

    return $content;
}

	
function afflc_autoshortlink_for_widget( $instance, $widget_class, $args ) 
{	     
    ob_start();
    $widget_class->widget( $args, $instance );
    $result = ob_get_clean();
    
    $result = afflc_autoshortlink($result);
 
    echo $result;
	     
    return false;
}
/////////////////////////////////////////////////////////////////////////////////////////////
add_filter('cron_schedules', 'afflinkcloaking_cron_add_maintaintime' );
register_activation_hook(__FILE__, 'afflinkcloaking_ActiveTableMaintain' ); 
add_action('afflinkcloaking_action_tablemaintain', 'afflinkcloaking_TableMaintain' );
register_deactivation_hook(__FILE__, 'afflinkcloaking_DeactiveTableMaintain' );
 
function afflinkcloaking_cron_add_maintaintime()
{
    $schedules['maintain'] = array(
    'interval' => 86400,
    'display' => __('maintain')
    );
    return $schedules;
}
function afflinkcloaking_ActiveTableMaintain()
{
    if ( !wp_get_schedule('afflinkcloaking_action_tablemaintain') )
        wp_schedule_event(time(), 'maintain', 'afflinkcloaking_action_tablemaintain');

    global $afflctable;
    $afflctable->ActivePlugin();
}  
function afflinkcloaking_TableMaintain() 
{
    global $afflctable;
    $afflctable->MaintainDate();
}
function afflinkcloaking_DeactiveTableMaintain()
{
    wp_clear_scheduled_hook('afflinkcloaking_action_tablemaintain');
   
    global $afflctable;
    $afflctable->DeactivePlugin();
}

?>