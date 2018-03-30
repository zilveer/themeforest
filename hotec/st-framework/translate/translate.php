<?php

if(!defined('ST_TRANSLATE_OPTION')){
    define('ST_TRANSLATE_OPTION','st_translate');
}


if(!function_exists('__st_get_translate')){
 /**
   *  load options 
   * @return array();  
   */   
 function __st_get_translate(){
        if(st_is_wpml()){
                 $st_translate = get_option(ST_TRANSLATE_OPTION.'_'.ICL_LANGUAGE_CODE,array()); 
                 if(empty($st_translate)){
                    $st_translate = get_option(ST_TRANSLATE_OPTION,array());  // default value
                 }

            }else{
                // get default langguage
                $st_default_lang_code = get_bloginfo('language'); // DO NOT REMOVE
                if(strpos($st_default_lang_code,'-')!==false){
                    $st_default_lang_code = explode('-',$st_default_lang_code);
                    $st_default_lang_code = $st_default_lang_code[0];
                }
                 $st_translate = get_option(ST_TRANSLATE_OPTION.'_'.$st_default_lang_code,array());  // default value
                 if(empty($st_translate)){
                         $st_translate = get_option(ST_TRANSLATE_OPTION,array());  // default value
                 }
            }

        // remove slashes
        $st_translate = st_stripslashes($st_translate);
        return $st_translate;
    }
 
}
       
       
if(!function_exists('st_stripslashes')){
    function st_stripslashes($array){
        if(!is_array($array)){
            return stripcslashes($array);
        }
        
        $tpl=  array();
        foreach($array as $k=> $v){
            $tpl[stripslashes($k)] = stripcslashes($v);
        }
        return  $tpl;
    }    
}
 



global  $st_translate; // for Translate
$st_translate = __st_get_translate();


if(!function_exists('st_is_wpml')){
    /**
     *  @true  if WPML installed.
     */ 
    function  st_is_wpml(){
        return function_exists('icl_get_languages');
    }
}

add_action('admin_menu','st_tran_add_admin_menu',99);

function st_tran_add_admin_menu(){
   $icon = ST_ADMIN_URL . '/images/st_icon.png';
   if(defined('ST_PAGE_SLUG') && ST_PAGE_SLUG!=''){
        add_submenu_page( ST_PAGE_SLUG,'stTranslator', 'stTranslator', 'manage_options', 'st-translator', 'st_admin_translator' );
   }else{
        add_menu_page('stTranslator','stTranslator','manage_options','st-translator','st_admin_translator');
   }   
}

function st_admin_translator(){
      $st_tran_page = 'st-translator';
      $dir_name = dirname(__FILE__) ;
      if($_REQUEST['import']==1){
             include($dir_name.'/admin-translator-import.php');
      }elseif($_REQUEST['export']==1){
             include($dir_name.'/admin-translator-export.php');
      }else{
            include($dir_name.'/admin-translator.php');
      }
}


/**
 * ST Translate function 
 * @return  false if not translated else the text translated
*/
function __st_false($text){
     if($text ==''){
        return false;
    }
    global $st_translate;
    if(isset($st_translate[$text])!='' && $st_translate[$text]!=''){
        return $st_translate[$text];
    }else{
        return false;
    }
}


/**
 * ST Translate function
 * @return string translate
*/
function __st($text=''){
    if($text ==''){
        return $text;
    }
    global $st_translate;
    if(isset($st_translate[$text])!='' && $st_translate[$text]!=''){
        return $st_translate[$text];
    }else{
        return $text;
    }
}


/**
 * ST Translate function
 * Display translate text
 * @return none
*/
function _st($text=''){
     echo __st($text);
}

function  st_translate_text($translated='', $text='', $domain=''){
        global $st_translate;
        if(isset($st_translate[$text])!='' && $st_translate[$text]!=''){
            return $st_translate[$text];
        }else{
            return $translated;
        }
}

function  st_translate_context_text($translated='', $text='', $context='', $domain =''){
    return st_translate_text($translated,$text,$domain);
}

function st_translate_n_text( $translation='', $singular='', $plural='', $number='',$domain =''){
    $text = ( 1 == $number) ? __st_false($singular) : __st_false($plural);
    if($text===false){
        return $translation;
    }else{
        return $text;
    }
}

function st_translate_n_context_text($translation='', $single='', $plural='', $number='', $context='', $domain=''){
    return st_translate_n_text( $translation, $single, $plural, $number,$domain);
}


/**
 *  Theme tranlate first
 * Add filter translate() function  
**/

if(!is_admin()){
    add_filter('gettext','st_translate_text',99,3);
    add_filter('gettext_with_context','st_translate_context_text',4);
    add_filter( 'ngettext', 'st_translate_n_text',99, 5);
    add_filter( 'ngettext_with_context', 'st_translate_n_context_text',99, 6);
}
