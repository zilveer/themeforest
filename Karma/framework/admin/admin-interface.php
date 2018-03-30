<?php
/*---------------------------------------------------------------*/
/* Admin Interface */
/*---------------------------------------------------------------*/
// Load static framework options pages 
$functions_path = TRUETHEMES_ADMIN . '/';

function siteoptions_add_admin() {

global $query_string;

$themename =  get_option('of_themename');      
$shortname =  get_option('of_shortname'); 

if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'siteoptions' ) {
  if (isset($_REQUEST['of_save']) && 'reset' == $_REQUEST['of_save']) {
  
	 if (!current_user_can('manage_options') || ! wp_verify_nonce( $_POST['_karma_admin_nonce_field'], 'karma_admin_nonce' ) ) {
     wp_die( 'Nonce expired! Please clear browser history. Login and try saving your Theme Options again.' ); 
     }

	  //@since 2.7.0 mod by denzel, reset defaults
	  //replace of_reset_options() function..			
	  $template = get_option('of_template');

	  foreach($template as $t):
		  $option_name = $t['id'];
		  $default_value = $t['std'];
		  update_option("$option_name","$default_value");
	  endforeach;		
	  //end of mod	

	  header("Location: admin.php?page=siteoptions&reset=true");
	  die;
  }

//@since 4.0.4 dev 5 using isset check to prevent PHP undefined index..
  if (isset($_POST['of_save']) && $_POST['of_save'] == 'submit'){
	  $template = get_option('of_template');
	  
	 if (!current_user_can('manage_options') || ! wp_verify_nonce( $_POST['_karma_admin_nonce_field'], 'karma_admin_nonce' ) ) {
     wp_die( 'Nonce expired! Please clear browser history. Login and try saving your Theme Options again.' ); 
     }

	  foreach($template as $t):	
		  $option_name = $t['id'];
		  $option_value = $_POST["$option_name"];
		  $type = $t['type'];
		  
	  
	  //checkbox
	  if($type == 'checkbox' && $option_value == ''){ // Checkbox Save				
		  update_option("$option_name","false");
	  }
	  
	  if($type == 'checkbox' && $option_value == 'true'){ // Checkbox Save				
		  update_option("$option_name","true");
	  }
	  
	  //multicheck
	  if($type == 'multicheck'){ // Multi Check Save		
				  $option_options = $t['options'];	
				  foreach ($option_options as $options_id => $options_value){
					  $multicheck_id = $t['id'] . "_" . $options_id;
					  $op_value = $_POST["$multicheck_id"];
												  
					  //print_r($op_value);
					  if($op_value == ''){
						update_option($multicheck_id,'false');
					  }
					  else{
						 update_option($multicheck_id,'true'); 
					  }
				  }	
			  }
	  
	  if($type != 'multicheck' && $type != 'checkbox'){
	  update_option("$option_name","$option_value");
	  }
	  endforeach;
	  
  header("Location: admin.php?page=siteoptions&save=true");
  die;
  }    

}
  
$of_page = add_theme_page('Site Options', 'Site Options', 'edit_theme_options', 'siteoptions','siteoptions_options_page');

// Add framework functionality to the head individually
add_action("admin_print_scripts-$of_page", 'of_load_only');
add_action("admin_print_styles-$of_page",'of_style_only');
} 

add_action('admin_menu', 'siteoptions_add_admin');



/*---------------------------------------------------------------*/
/* Build the Site Options Panel */
/*---------------------------------------------------------------*/
function siteoptions_options_page(){
$options   =  get_option('of_template');      
$themename =  get_option('of_themename');

// Rev up the Options Machine
$return = siteoptions_machine($options);
?>

<div class="wrap" id="truethemes_container">
	<form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="POST" enctype="multipart/form-data" id="ofform">   
<div id="main">
   
	<div id="tt-options-content-wrap">
    	<h2 class="truethemes-admin-logo">
			<?php _e('Site Options','truethemes_localize'); ?> <a class="add-new-h2" href="https://help.truethemes.net" target="_blank"><?php _e('Theme Support &rarr;','truethemes_localize'); ?></a></h2>
            
            <!-- <ul class="subsubsub">
            	<li><strong>Theme Support:</strong> <a href="https://support.truethemes.net/training-videos" title="Theme Support Watch Training Videos">Training Videos</a> |</li>
                <li><a href="https://support.truethemes.net/?post_type=faq" title="Read FAQ">FAQ</a> |</li>
                <li><a href="https://support.truethemes.net/?post_type=knowledgebase" title="Read Knowledgebase">KnowledgeBase</a> |</li>
            </ul>
            <div class="clear"></div> -->
            
		<?php
		//@since 4.0.4 dev 5 using isset check to prevent PHP undefined index..
		if(isset($_GET['save']) && $_GET['save']=='true'){        
        echo '<div class="updated below-h2" id="message"><p><strong>The Settings have been saved.</strong></p></div>';
        }
		//@since 4.0.4 dev 5 using isset check to prevent PHP undefined index..        
        if(isset($_GET['reset']) && $_GET['reset']=='true'){
        echo '<div class="updated below-h2" id="message"><p><strong>The Settings have been reset.</strong></p></div>';
        }  
        ?>             
              
		<div id="content"> 
      		<?php echo $return[0]; /* Settings */ ?>
            	<!-- <div class="clear"></div> -->
		</div><!-- END #content -->     
      
             
      <?php 
		//check for IE8 - only display bottom save button if not IE8
		//@since 4.0.4 dev 5 removed deprecated ereg() function, rewrite using strpos()
		//$IE8 = (ereg('MSIE 8',$_SERVER['HTTP_USER_AGENT'])) ? true : false;
				
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$ie8 = 'MSIE 8';
		$IE8 = strpos($user_agent, $ie8);
		if (($IE8 === false)) { ?>

            <input type="submit" value="<?php _e('Save All Changes','truethemes_localize'); ?>" class="main_save_button button-primary" />
            <input type="hidden" name="of_save" value="submit" />
            <?php wp_nonce_field( 'karma_admin_nonce', '_karma_admin_nonce_field' ); ?>
            </form>
            
            <div id="tt-options-footer-save-bar">
            
            <form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:inline" id="ofform-reset">
    			<input name="reset" type="submit" value="<?php _e('Reset Options','truethemes_localize'); ?>" class="button submit-button reset-button" onclick="return confirm('CAUTION: Any and all settings will be lost! Click OK to reset.');" />
    			<input type="hidden" name="of_save" value="reset" />
    			<?php wp_nonce_field( 'karma_admin_nonce', '_karma_admin_nonce_field' ); ?>
             </form>
             </div> <!-- END #tt-options-footer-save-bar -->
            
             <?php } //END ie8 check ?>
                 
         </div><!-- END #tt-options-content-wrap -->
    
    
    
    <div id="tt-options-sidebar">
		<ul id="tt-options-nav">
          <?php echo $return[1] ?>
        </ul><!-- END #tt-options-nav -->
        
        <div id="tt-options-sidebar-controls">
        <input type="submit" value="<?php _e('Save All Changes','truethemes_localize'); ?>" class="button-primary" />
        <input type="hidden" name="of_save" value="submit" />
         <?php wp_nonce_field( 'karma_admin_nonce', '_karma_admin_nonce_field' ); ?>
        </form>
        </div><!-- END #tt-options-sidebar-controls -->
    </div><!-- END #tt-options-sidebar -->
    
</div><!-- END #main -->


  
<?php  if (!empty($update_message)) echo $update_message; ?>
<div style="clear:both;"></div>
</div><!-- END .wrap -->
<?php
}


/*---------------------------------------------------------------*/
/* Load required styles for Options Page - of_style_only */
/*---------------------------------------------------------------*/
function of_style_only() {
	wp_enqueue_style('admin-style', TRUETHEMES_FRAMEWORK.'/admin/admin-style.css');
	wp_enqueue_style('color-picker', TRUETHEMES_FRAMEWORK.'/admin/colorpicker.css');
	wp_enqueue_style('karma-thickbox', TRUETHEMES_FRAMEWORK.'/admin/thickbox.css'); //@since 4.4
}

/*---------------------------------------------------------------*/
/* Load required javascripts for Options Page - of_load_only */
/*---------------------------------------------------------------*/
function of_load_only() {

	add_action('admin_head', 'of_admin_head');
	
	wp_register_script('jquery-input-mask', TRUETHEMES_FRAMEWORK.'/admin/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	//wp_register_script('thickbox', TRUETHEMES_FRAMEWORK.'/admin/js/thickbox-compressed.js', array( 'jquery' ));
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-input-mask');
	wp_enqueue_script('thickbox'); //@since 4.4 - added for "wheres my purchase code link"
	wp_enqueue_script('color-picker',       TRUETHEMES_FRAMEWORK.'/admin/js/colorpicker.js', array('jquery'));
	wp_enqueue_script('ajaxupload',         TRUETHEMES_FRAMEWORK.'/admin/js/ajaxupload.js', array('jquery'));
	
	function of_admin_head() { 
	?>

    
<script type="text/javascript" language="javascript">

jQuery(document).ready(function(){

// Race condition to make sure js files are loaded
if (typeof AjaxUpload != 'function') { 
	return ++counter < 6 && window.setTimeout(init, counter * 500);
}

	//Color Picker
	<?php $options = get_option('of_template');
	
	foreach($options as $option){ 
	if($option['type'] == 'color' OR $option['type'] == 'typography' OR $option['type'] == 'border'){
		if($option['type'] == 'typography' OR $option['type'] == 'border'){
			$option_id  = $option['id'];
			$temp_color = get_option($option_id);
			$option_id  = $option['id'] . '_color';
			$color      = $temp_color['color'];
		}
		else {
			$option_id = $option['id'];
			$color = get_option($option_id);
		}
		?>
		 jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '<?php echo $color; ?>');    
		 jQuery('#<?php echo $option_id; ?>_picker').ColorPicker({
			color: '<?php echo $color; ?>',
			onShow: function (colpkr) {
				jQuery(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				jQuery(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				//jQuery(this).css('border','1px solid red');
				jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '#' + hex);
				jQuery('#<?php echo $option_id; ?>_picker').next('input').attr('value','#' + hex);
				
			}
		  });
	  <?php } } ?>
 
});
</script>

	
<script type="text/javascript">
jQuery(document).ready(function(){
	
	jQuery('.group').hide();
	jQuery('.group:first').fadeIn();
	jQuery('.group .collapsed').each(function(){
		jQuery(this).find('input:checked').parent().parent().parent().nextAll().each( 
			function(){
				if (jQuery(this).hasClass('last')) {
					jQuery(this).removeClass('hidden');
					return false;
				}
				jQuery(this).filter('.hidden').removeClass('hidden');
			});
	});			
	jQuery('.group .collapsed input:checkbox').click(unhideHidden);
	
	
	function unhideHidden(){
		if (jQuery(this).attr('checked')) {
			jQuery(this).parent().parent().parent().nextAll().removeClass('hidden');
		}
		else {
			jQuery(this).parent().parent().parent().nextAll().each( 
				function(){
					if (jQuery(this).filter('.last').length) {
						jQuery(this).addClass('hidden');
						return false;
					}
					jQuery(this).addClass('hidden');
				});
				
		}
	}
	
	jQuery('.of-radio-img-img').click(function(){
		jQuery(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		jQuery(this).addClass('of-radio-img-selected');
		
	});
	jQuery('.of-radio-img-label').hide();
	jQuery('.of-radio-img-img').show();
	jQuery('.of-radio-img-radio').hide();

	
	jQuery('#tt-options-nav li:first').addClass('current');
	jQuery('#tt-options-nav li a').click(function(evt){
	
			jQuery('#tt-options-nav li').removeClass('current');
			jQuery(this).parent().addClass('current');
			
			var clicked_group = jQuery(this).attr('href');
				jQuery('.group').hide();
				jQuery(clicked_group).fadeIn();
			evt.preventDefault();
		});


//if('<?php if(isset($_REQUEST['reset'])) { echo $_REQUEST['reset'];} else { echo 'false';} ?>' == 'true'){ 
//removed reset message fadeout, @since 3.0	
//}			

<?php
//admin ajax nonce.
if(current_user_can('manage_options')){
$admin_ajax_nonce = wp_create_nonce( "karma_admin_ajax_nonce" );
}else{
$admin_ajax_nonce = '';
}
?>
/*--------------------------------------*/
/*
/*	//AJAX Upload
/*
/*--------------------------------------*/
jQuery('.image_upload_button').each(function(){

var clickedObject = jQuery(this);
var clickedID = jQuery(this).attr('id');	
new AjaxUpload(clickedID, {
	  action: '<?php echo admin_url("admin-ajax.php"); ?>',
	  name: clickedID, // File upload name
	  data: { // Additional data to send
			action: 'of_ajax_post_action',
			type: 'upload',
			data: clickedID, 
			security: '<?php echo $admin_ajax_nonce; ?>'
			},
	  autoSubmit: true, // Submit file after selection
	  responseType: false,
	  onChange: function(file, extension){},
	  onSubmit: function(file, extension){
			clickedObject.text('Uploading'); // change button text, when user selects file	
			this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
			interval = window.setInterval(function(){
				var text = clickedObject.text();
				if (text.length < 13){	clickedObject.text(text + '.'); }
				else { clickedObject.text('Uploading'); } 
			}, 200);
	  },
	  onComplete: function(file, response) {
	   
		window.clearInterval(interval);
		clickedObject.text('Upload Image');	
		this.enable(); // enable upload button
		
		// If there was an error
		if(response.search('Upload Error') > -1){
			var buildReturn = '<span class="upload-error">' + response + '</span>';
			jQuery(".upload-error").remove();
			clickedObject.parent().after(buildReturn);
		
		}
		else{
			var buildReturn = '<img class="hide of-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';

			jQuery(".upload-error").remove();
			jQuery("#image_" + clickedID).remove();	
			clickedObject.parent().after(buildReturn);
			jQuery('img#image_'+clickedID).fadeIn();
			clickedObject.next('span').fadeIn();
			clickedObject.parent().prev('input').val(response);
		}
	  }
	});

});

//AJAX Remove (clear option value)
jQuery('.image_reset_button').click(function(){
		var clickedObject = jQuery(this);
		var clickedID = jQuery(this).attr('id');
		var theID = jQuery(this).attr('title');	
		var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
		var data = {
			action: 'of_ajax_post_action',
			type: 'image_reset',
			data: theID,
			security: '<?php echo $admin_ajax_nonce; ?>'
		};
		
		jQuery.post(ajax_url, data, function(response) {
			var image_to_remove = jQuery('#image_' + theID);
			var button_to_hide = jQuery('#reset_' + theID);
			image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
			button_to_hide.fadeOut();
			clickedObject.parent().prev('input').val('');				
		});	
		return false; 	
	});
});


jQuery(document).ready(function(){
	//jQuery('#tt-options-sidebar').fixTo('#main');
	truethemes_admin_scrolltop();
	truethemes_admin_sticky_nav();
});

/*--------------------------------------*/
/*
/*	Option Menu Scroll Top + Sticky
/*
/*--------------------------------------*/
/* scroll top */
function truethemes_admin_scrolltop(){
jQuery('#tt-options-nav a').click(function () {
	if (!jQuery.browser.opera) {
		jQuery('body').animate({
			scrollTop: 0
		}, {
			queue: false,
			duration: 600
		})
	}
	jQuery('html').animate({
		scrollTop: 0
	}, {
		queue: false,
		duration: 600
	});
	return false
});
}
	
	
function truethemes_admin_sticky_nav() {
/*
 Sticky-kit v1.1.2 | WTFPL | Leaf Corcoran 2015 | http://leafo.net
*/
(function(){var b,f;b=this.jQuery||window.jQuery;f=b(window);b.fn.stick_in_parent=function(d){var A,w,J,n,B,K,p,q,k,E,t;null==d&&(d={});t=d.sticky_class;B=d.inner_scrolling;E=d.recalc_every;k=d.parent;q=d.offset_top;p=d.spacer;w=d.bottoming;null==q&&(q=0);null==k&&(k=void 0);null==B&&(B=!0);null==t&&(t="is_stuck");A=b(document);null==w&&(w=!0);J=function(a,d,n,C,F,u,r,G){var v,H,m,D,I,c,g,x,y,z,h,l;if(!a.data("sticky_kit")){a.data("sticky_kit",!0);I=A.height();g=a.parent();null!=k&&(g=g.closest(k));
if(!g.length)throw"failed to find stick parent";v=m=!1;(h=null!=p?p&&a.closest(p):b("<div />"))&&h.css("position",a.css("position"));x=function(){var c,f,e;if(!G&&(I=A.height(),c=parseInt(g.css("border-top-width"),10),f=parseInt(g.css("padding-top"),10),d=parseInt(g.css("padding-bottom"),10),n=g.offset().top+c+f,C=g.height(),m&&(v=m=!1,null==p&&(a.insertAfter(h),h.detach()),a.css({position:"",top:"",width:"",bottom:""}).removeClass(t),e=!0),F=a.offset().top-(parseInt(a.css("margin-top"),10)||0)-q,
u=a.outerHeight(!0),r=a.css("float"),h&&h.css({width:a.outerWidth(!0),height:u,display:a.css("display"),"vertical-align":a.css("vertical-align"),"float":r}),e))return l()};x();if(u!==C)return D=void 0,c=q,z=E,l=function(){var b,l,e,k;if(!G&&(e=!1,null!=z&&(--z,0>=z&&(z=E,x(),e=!0)),e||A.height()===I||x(),e=f.scrollTop(),null!=D&&(l=e-D),D=e,m?(w&&(k=e+u+c>C+n,v&&!k&&(v=!1,a.css({position:"fixed",bottom:"",top:c}).trigger("sticky_kit:unbottom"))),e<F&&(m=!1,c=q,null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),
h.detach()),b={position:"",width:"",top:""},a.css(b).removeClass(t).trigger("sticky_kit:unstick")),B&&(b=f.height(),u+q>b&&!v&&(c-=l,c=Math.max(b-u,c),c=Math.min(q,c),m&&a.css({top:c+"px"})))):e>F&&(m=!0,b={position:"fixed",top:c},b.width="border-box"===a.css("box-sizing")?a.outerWidth()+"px":a.width()+"px",a.css(b).addClass(t),null==p&&(a.after(h),"left"!==r&&"right"!==r||h.append(a)),a.trigger("sticky_kit:stick")),m&&w&&(null==k&&(k=e+u+c>C+n),!v&&k)))return v=!0,"static"===g.css("position")&&g.css({position:"relative"}),
a.css({position:"absolute",bottom:d,top:"auto"}).trigger("sticky_kit:bottom")},y=function(){x();return l()},H=function(){G=!0;f.off("touchmove",l);f.off("scroll",l);f.off("resize",y);b(document.body).off("sticky_kit:recalc",y);a.off("sticky_kit:detach",H);a.removeData("sticky_kit");a.css({position:"",bottom:"",top:"",width:""});g.position("position","");if(m)return null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),h.remove()),a.removeClass(t)},f.on("touchmove",l),f.on("scroll",l),f.on("resize",
y),b(document.body).on("sticky_kit:recalc",y),a.on("sticky_kit:detach",H),setTimeout(l,0)}};n=0;for(K=this.length;n<K;n++)d=this[n],J(b(d));return this}}).call(this);

//make em' stick
jQuery("#tt-options-sidebar").stick_in_parent({ offset_top: 5 }); //sidebar

}

</script>


<?php }
}
/*---------------------------------------------------------------*/
/* Ajax Save Action - of_ajax_callback */
/*---------------------------------------------------------------*/

add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');

function of_ajax_callback() {
if(!current_user_can('manage_options')){
wp_die('Failed Security Check');
}
//nonce check
check_ajax_referer( "karma_admin_ajax_nonce", "security" );

	global $wpdb; // this is how you get access to the database
	
		
	$save_type = $_POST['type'];
	//Uploads
	if($save_type == 'upload'){
		
		$clickedID = esc_attr($_POST['data']); // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
				$upload_tracking[] = $clickedID;
				update_option( $clickedID , $uploaded_file['url'] );
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
	}
	elseif($save_type == 'image_reset'){
			
			$id = esc_attr($_POST['data']); // Acts as the name
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);
	
	}	
	elseif ($save_type == 'options' OR $save_type == 'framework') {
		$data = esc_attr($_POST['data']);
		
		parse_str($data,$output);
		//print_r($output);
		
		//Pull options
        	$options = get_option('of_template');
		
		foreach($options as $option_array){

			$id = $option_array['id'];
			$old_value = get_option($id);
			$new_value = '';
			
			if(isset($output[$id])){
				$new_value = $output[$option_array['id']];
			}
	
			if(isset($option_array['id'])) { // Non - Headings...

			
					$type = $option_array['type'];
					
					if ( is_array($type)){
						foreach($type as $array){
							if($array['type'] == 'text'){
								$id = $array['id'];
								$std = $array['std'];
								$new_value = $output[$id];
								if($new_value == ''){ $new_value = $std; }
								update_option( $id, stripslashes($new_value));
							}
						}                 
					}
					elseif($new_value == '' && $type == 'checkbox'){ // Checkbox Save
						
						update_option($id,'false');
					}
					elseif ($new_value == 'true' && $type == 'checkbox'){ // Checkbox Save
						
						update_option($id,'true');
					}
					elseif($type == 'multicheck'){ // Multi Check Save
						
						$option_options = $option_array['options'];
						
						foreach ($option_options as $options_id => $options_value){
							
							$multicheck_id = $id . "_" . $options_id;
							
							if(!isset($output[$multicheck_id])){
							  update_option($multicheck_id,'false');
							}
							else{
							   update_option($multicheck_id,'true'); 
							}
						}
					} 
					
					elseif($type != 'upload_min'){
					
						update_option($id,stripslashes($new_value));
					}
				}
			}	
	
	}

  die();

}

/*---------------------------------------------------------------*/
/* Generates The Options Within the Panel */
/*---------------------------------------------------------------*/
function siteoptions_machine($options) {
$option_counter = 1; //added version 4.0 dev 21 to generate menu link id instead of using name for styling icons.         
    $counter = 0;
	$menu = '';
	$output = '';
	foreach ($options as $value) {
	   
		$counter++;
		$val = '';
		//Start Heading
		 if ( $value['type'] != "heading" )
		 {
		 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
			//$output .= '<div class="section section-'. $value['type'] .'">'."\n".'<div class="option-inner">'."\n";
			$output .= '<div class="section section-'.$value['type'].' '. $class .'">'."\n";
			$output .= '<h4 class="heading">'. $value['name'] .'</h4>'."\n";
			$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";

		 } 
		 //End Heading
		$select_value = '';                                   
		switch ( $value['type'] ) {
		
		case 'text':
			@$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<input class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" />';
		break;
		
		
		case 'select':

			$output .= '<select class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$select_value = get_option($value['id']);
			 
			foreach ($value['options'] as $option) {
				
				$selected = '';
				
				 if($select_value != '') {
					 if ( $select_value == $option) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
				 }
				  
				 $output .= '<option'. $selected .'>';
				 $output .= $option;
				 $output .= '</option>';
			 
			 } 
			 $output .= '</select>';

			
		break;
		
		//@since 4.0 added by denzel to allow value different from label.
		case 'select-advance':

			$output .= '<select class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$select_value = get_option($value['id']);
			 
			foreach ($value['options'] as $key => $option) {
				
				$selected = '';
				
				 if($select_value != '') {
					 if ( $select_value == $key) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $key) { $selected = ' selected="selected"'; }
				 }
				  
				 $output .= '<option value="'. $key .'" '. $selected .'>';
				 $output .= $option;
				 $output .= '</option>';
			 
			 } 
			 $output .= '</select>';

			
		break;	
		
		
		case 'fontsize':
		
		/* Font Size */
			$val = $default['size'];
			if ( $typography_stored['size'] != "") { $val = $typography_stored['size']; }
			$output .= '<select class="of-typography of-typography-size" name="'. $value['id'].'_size" id="'. $value['id'].'_size">';
				for ($i = 9; $i < 71; $i++){ 
					if($val == $i){ $active = 'selected="selected"'; } else { $active = ''; }
					$output .= '<option value="'. $i .'" ' . $active . '>'. $i .'px</option>'; }
			$output .= '</select>';
		
		
		break;
			
		
		case "multicheck":
		
			@$std =  $value['std'];         
			
			foreach ($value['options'] as $key => $option) {
											 
			$of_key = $value['id'] . '_' . $key;
			$saved_std = get_option($of_key);
					
			if(!empty($saved_std)) 
			{ 
				  if($saved_std == 'true'){
					 $checked = 'checked="checked"';  
				  } 
				  else{
					  $checked = '';     
				  }    
			} 
			elseif( $std == $key) {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';                                                                                    }
			$output .= '<input type="checkbox" class="checkbox of-input" name="'. $of_key .'" id="'. $of_key .'" value="true" '. $checked .' /><label for="'. $of_key .'">'. $option .'</label><br />';
										
			}
		break;
	
		
		case 'textarea':
			
			$cols = '8';
			$ta_value = '';
			
			if(isset($value['std'])) {
				
				$ta_value = $value['std']; 
				
				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}
				
			}
				$std = get_option($value['id']);
				if( $std != "") { $ta_value = stripslashes( $std ); }
				$output .= '<textarea class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';
			
			
		break;
		case "radio":
			
			 $select_value = get_option( $value['id']);
				   
			 foreach ($value['options'] as $key => $option) 
			 { 

				 $checked = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; } 
				   } else {
					if ($value['std'] == $key) { $checked = ' checked'; }
				   }
				$output .= '<input class="of-input of-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'<br />';
			
			}
			 
		break;
		
		case "checkbox": 
		
		   $std = $value['std'];  
		   
		   $saved_std = get_option($value['id']);
		   
		   $checked = '';
			
			if(!empty($saved_std)) {
				if($saved_std == 'true') {
				$checked = 'checked="checked"';
				}
				else{
				   $checked = '';
				}
			}
			elseif( $std == 'true') {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';
			}
			$output .= '<input type="checkbox" class="checkbox of-input" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />';

		break;
		
		
		case "upload":
			
			@$output .= siteoptions_uploader_function($value['id'],$value['std'],null);
			
		break;
		
		
		case "upload_min":
			
			$output .= siteoptions_uploader_function($value['id'],$value['std'],'min');
			
		break;
		case "color":
			@$val = $value['std'];
			$stored  = get_option( $value['id'] );
			if ( $stored != "") { $val = $stored; }
			$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';
			$output .= '<input class="of-color" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $val .'" />';
		break;   
		
		
		case "images":
			$i = 0;
			$select_value = get_option( $value['id']);
				   
			foreach ($value['options'] as $key => $option) 
			 { 
			 $i++;

				 $checked = '';
				 $selected = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; $selected = 'of-radio-img-selected'; } 
				    } else {
						if ($value['std'] == $key) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						elseif ($i == 1  && $value['std'] == '') { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						else { $checked = ''; }
					}	
				
				$output .= '<span>';
				$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="'.$key.'" name="'. $value['id'].'" '.$checked.' />';
				$output .= '<div class="of-radio-img-label">'. $key .'</div>';
				$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" title="'.$key.'"/>';
				$output .= '</span>';
				
			}
		
		break; 
		
		case "info":
			$default = $value['std'];
			$output .= $default;
		break;                       
		
		case "heading":
			
			if($counter >= 2){
			   $output .= '</div>'."\n";
			}
			//$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );
			$jquery_click_hook = strtolower($value['name']); //mod by denzel so that site option menu tab works when using other language	
			$jquery_click_hook = str_replace(" ","",$jquery_click_hook); //mod by denzel..
			$jquery_click_hook = "of-option-" . $jquery_click_hook;
			$menu .= '<li><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'" id="'.  "option-".$option_counter .'">'.  $value['name'] .'</a></li>';
			$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
			$option_counter++;
		break;                             
		} 
		
		// if TYPE is an array, formatted into smaller inputs... ie smaller values
		if ( is_array($value['type'])) {
			foreach($value['type'] as $array){
			
					$id              =  $array['id']; 
					$std             =  $array['std'];
					$saved_std       =  get_option($id);
					if($saved_std   !=  $std){$std = $saved_std;} 
					$meta            =  $array['meta'];
					
					if($array['type'] == 'text') { // Only text at this point
						 
						 $output .= '<input class="input-text-small of-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';  
						 $output .= '<span class="meta-two">'.$meta.'</span>';
					}
				}
		}
		if ( $value['type'] != "heading" ) { 
			if ( $value['type'] != "checkbox" ) 
				{ 
				$output .= '<br/>';
				}
			if(!isset($value['desc'])){ $explain_value = ''; } else{ $explain_value = $value['desc']; } 
			$output .= '</div><div class="explain">'. $explain_value .'</div>'."\n";
			$output .= '<div class="clear"> </div></div></div>'."\n";
			}
	   
	}
    $output .= '</div>';
    return array($output,$menu);

}

/*---------------------------------------------------------------*/
/* File Uploader */
/*---------------------------------------------------------------*/
function siteoptions_uploader_function($id,$std,$mod){

    //$uploader .= '<input type="file" id="attachement_'.$id.'" name="attachement_'.$id.'" class="upload_input"></input>';
    //$uploader .= '<span class="submit"><input name="save" type="submit" value="Upload" class="button upload_save" /></span>';   
	$uploader = '';
    $upload = get_option($id);
	
	if($mod != 'min') { 
			$val = $std;
            if ( get_option( $id ) != "") { $val = get_option($id); }
            $uploader .= '<input class="of-input" name="'. $id .'" id="'. $id .'_upload" type="text" value="'. $val .'" />';
	}
	
	$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">Upload Image</span>';
	
	if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
	
	$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
	$uploader .='</div>' . "\n";
    $uploader .= '<div class="clear"></div>' . "\n";
	if(!empty($upload)){
    	$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
    	$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
    	$uploader .= '</a>';
		}
	$uploader .= '<div class="clear"></div>' . "\n"; 


return $uploader;
}
?>