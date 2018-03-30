<?php
/**
 * Add Custom field in page
 * @package VAN Framework 
 */

$post_meta_boxes =
array(	
    "hide_title" => array(
	"name" => "hide_title",
	"types" => "select",
	'options' =>array('No','Yes'),
	'std'=>'No',
	'desc'=>'',
	"title" => __("Hide headline",'SimpleKey')),

	"page_mainheading" => array(
	"name" => "page_mainheading",
	"types" => "text",
	'std'=>'',
	'desc'=>'',
	"title" => __("Page main heading",'SimpleKey')),
	
    "page_subHeading" => array(
	"name" => "page_subHeading",
	"types" => "text",
	'std'=>'',
	'desc'=>'',
	"title" => __("Page Sub heading",'SimpleKey')),
	
	"page_bgcolor" => array(
	"name" => "page_bgcolor",
	'std'=>'',
	"desc" =>__("Background setting just act on home page.",'SimpleKey'),
	"types" => "select",
	"options" =>array('Light','Dark','Sand Paper','Diamond','Dark Cross','Tactile Noise','Minium Red','Picture1','Picture2','Picture3'),
	"title" => __("Page background theme",'SimpleKey')),
	
	"page_custom" => array(
	"name" => "page_custom",
	"desc" =>__("After you selected 'Yes',the custom options will be displayed below and the previous background setting will be invalid.",'SimpleKey'),
	"types" => "select",
	"options" =>array('No','Yes'),
	"std"=>"No",
	'desc'=>'',
	"title" => __("Custom background",'SimpleKey')),
	
	"page_custom_bgcolor" => array(
	"name" => "page_custom_bgcolor",
	"types" => "colorpicker",
	"std" => "#fff",
	'desc'=>'',
	"title" => __("Custom background color",'SimpleKey')),
	
	"page_custom_fontcolor" => array(
	"name" => "page_custom_fontcolor",
	"types" => "colorpicker",
	"std" => "#000",
	'desc'=>'',
	"title" => __("Custom Font color",'SimpleKey')),
		
	"page_custom_img" => array(
	"name" => "page_custom_img",
	"types" => "text",
	'std'=>'',
	"desc" => __("Fill in picture url,e.g http://xxx.com/bg.jpg",'SimpleKey'),
	"title" => __("Custom background image(Optimal width is 2000px if you want it to be fullscreen.)",'SimpleKey')),
	
	"page_bg_repeat" => array(
	"name" => "page_bg_repeat",
	"types" => "select",
	"std" => "repeat",
	"options" =>array('repeat','no-repeat','repeat-x','repeat-y'),
	"desc" => "",
	"title" => __("Background image repeat",'SimpleKey')),
	
	"page_bg_fixed" => array(
	"name" => "page_bg_fixed",
	"types" => "select",
	"std" => "fixed",
	"options" =>array('fixed','scroll'),
	"desc" => "",
	"title" => __("Background Image Fixed",'SimpleKey')),
		
	"page_full_embed" => array(
	"name" => "page_full_embed",
	"types" => "textarea",
	'std'=>'',
	"desc" => __("You can embed the video or maps here with full screen effect",'SimpleKey'),
	"title" => __("Full screen embed code",'SimpleKey')),
);

function van_post_meta_boxes() {
    global $post, $post_meta_boxes;
    foreach($post_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];
        echo'<div id="'.$meta_box['name'].'" class="metabox">';
		echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
        echo'<h4>'.$meta_box['title'].'</h4>';
		switch($meta_box['types']){
		  case 'textarea':
            echo '<textarea cols="80" rows="3" name="'.$meta_box['name'].'_value" style="width:70%;height:100px;">'.$meta_box_value.'</textarea><br /><span>'.$meta_box['desc'].'</span>';
			break;
		  case 'text':
		    echo '<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:40%" /><span>'.$meta_box['desc'].'</span>';
			break;
		  case 'colorpicker':
		    echo '<input type="text" id="'.$meta_box['name'].'_value" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:10%" /><span>'.$meta_box['desc'].'</span>';
			echo ' <div class="colorpicker" id="colorpicker_'.$meta_box['name'].'_value"></div>';
			?>
            <script type="text/javascript">
			 jQuery(document).ready(function() {
				jQuery('#colorpicker_<?php echo $meta_box['name']; ?>_value').farbtastic("#<?php echo $meta_box['name']; ?>_value");
				jQuery("#<?php echo $meta_box['name']; ?>_value").click(function(){jQuery('#colorpicker_<?php echo $meta_box['name']; ?>_value').slideToggle()});
				
			  });
			 </script>
            <?php
			break;
	      case 'select':
		    echo '<select name="'.$meta_box['name'].'_value">';
			echo '<option value="" '.$select.'>Choose</option>';
			if(!empty($meta_box['options']))
			{
				foreach ($meta_box['options'] as $option)
				{
					 $select = '';
				     if($meta_box_value==$option) {
					  $select = 'selected=selected"';
				     }
					echo '<option value="'.$option.'" '.$select.'>'.$option.'</option>';
				}
			}
			echo'</select><span>'.$meta_box['desc'].'</span>';
			break;
		 case 'checkbox':
		    foreach ($meta_box['options'] as $option){
				$checkyes = '';
				if(strpos($meta_box_value, $option) !== false) {
					$checkyes = 'checked="checked"';
				}
		       echo'<input type="checkbox" name="'.$meta_box['name'].'_value[]" value="'.$option.'" '.$checkyes.' /> '.$option.'&nbsp;&nbsp;';
			}
			echo'<span>'.$meta_box['desc'].'</span>';
			break;
		 case 'radio':
		    foreach ($meta_box['options'] as $option){
		  ?>
		       <input type="radio" name="<?php echo $meta_box['name']?>_value" value="<?php echo $option;?>" <?php if ($option==$meta_box_value) { echo ' checked="checked"'; } ?> /> <?php echo $option; ?> &nbsp;&nbsp;
		  <?php	
            }
			echo'<span>'.$meta_box['desc'].'</span>';
			break;
		}
		echo'</div>';
    }
}

function van_post_create_meta_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'post-meta-boxes', 'Page Setting', 'van_post_meta_boxes', 'page', 'normal', 'high' );
    }
}
function van_post_save_postdata( $post_id ) {
    global $post, $post_meta_boxes;

	foreach($post_meta_boxes as $meta_box) {
	    if ( ! isset( $_POST[$meta_box['name'].'_noncename'] ) ) {
		  return;
	    }
		
        if ( !wp_verify_nonce($_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }
	
	
        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        } 

        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        //$data = $_POST[$meta_box['name'].'_value'];
		if ($meta_box['types'] == 'checkbox' && is_array($_POST[$meta_box['name'].'_value'])) {
			$data = implode(",",$_POST[$meta_box['name'].'_value']);
		}else {
			$data = $_POST[$meta_box['name'].'_value'];
		}

        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
            update_post_meta($post_id, $meta_box['name'].'_value', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    }
}

add_action('admin_menu', 'van_post_create_meta_box');
add_action('save_post', 'van_post_save_postdata');
?>