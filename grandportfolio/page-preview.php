<?php
/**
 * The main template file for preview content builder display page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
if(!is_null($post))
{
	$page_obj = get_page($post->ID);
}

$current_page_id = '';

/**
*	Get current page id
**/

if(!is_null($post) && isset($page_obj->ID))
{
    $current_page_id = $page_obj->ID;
}

get_header(); 

//if dont have password set
if(!post_password_required())
{
	wp_enqueue_script("grandportfolio-custom-onepage", get_template_directory_uri()."/js/custom_onepage.js", false, THEMEVERSION, true);
?>
<style>
.header_style_wrapper, #footer_photostream, .footer_bar
{
	display: none;
}
#wrapper
{
	padding-top: 0 !important;
}
</style>
<div class="ppb_wrapper">
<?php
	$ppb_form_item = $_GET['rel'];

    $ppb_form_item_data = get_post_meta($current_page_id, $ppb_form_item.'_data');
    $ppb_form_item_size = get_post_meta($current_page_id, $ppb_form_item.'_size');
    
    $ppb_form_item_data_obj = json_decode($ppb_form_item_data[0]);
    $ppb_shortcode_content_name = $ppb_form_item_data_obj->shortcode.'_content';
    $ppb_shortcode_code = '';
    
    $ppb_shortcodes = array();
	require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
    
    if(isset($ppb_form_item_data_obj->$ppb_shortcode_content_name))
    {
        $ppb_shortcode_code = '['.$ppb_form_item_data_obj->shortcode.' size="'.$ppb_form_item_size[0].'" ';
        
        //Get shortcode title
        $ppb_shortcode_title_name = $ppb_form_item_data_obj->shortcode.'_title';
        if(isset($ppb_form_item_data_obj->$ppb_shortcode_title_name))
        {
        	$ppb_shortcode_code.= 'title="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_title_name), ENT_QUOTES, "UTF-8").'" ';
        }
        
        //Get shortcode attributes
        if(isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
        {
        	$ppb_shortcode_arr = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode];
        	
        	foreach($ppb_shortcode_arr['attr'] as $attr_name => $attr_item)
        	{
        		$ppb_shortcode_attr_name = $ppb_form_item_data_obj->shortcode.'_'.$attr_name;
        		
        		if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_name))
        		{
        			$ppb_shortcode_code.= $attr_name.'="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_name)).'" ';
        		}
        	}
        }

        $ppb_shortcode_code.= ']'.rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_content_name).'[/'.$ppb_form_item_data_obj->shortcode.']';
    }
    else
    {
        $ppb_shortcode_code = '['.$ppb_form_item_data_obj->shortcode.' size="'.$ppb_form_item_size[0].'" ';
        
        //Get shortcode title
        $ppb_shortcode_title_name = $ppb_form_item_data_obj->shortcode.'_title';
        if(isset($ppb_form_item_data_obj->$ppb_shortcode_title_name))
        {
        	$ppb_shortcode_code.= 'title="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_title_name), ENT_QUOTES, "UTF-8").'" ';
        }
        
        //Get shortcode attributes
        if(isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
        {
        	$ppb_shortcode_arr = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode];
        	
        	foreach($ppb_shortcode_arr['attr'] as $attr_name => $attr_item)
        	{
        		$ppb_shortcode_attr_name = $ppb_form_item_data_obj->shortcode.'_'.$attr_name;
        		
        		if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_name))
        		{
        			$ppb_shortcode_code.= $attr_name.'="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_name)).'" ';
        		}
        	}
        }
        
        $ppb_shortcode_code.= ']';
    }
    //echo $ppb_shortcode_code;
    echo do_shortcode($ppb_shortcode_code);
}
?>
</div>

<?php get_footer(); ?>