<?php
/*-----------------------------------------------------------------------------------*/
/* Admin Interface */
/*-----------------------------------------------------------------------------------*/

// Load static framework options pages.
$functions_path = TT_ADMIN . '/';

add_action( 'admin_menu', 'siteoptions_add_admin' );
function siteoptions_add_admin() {

    // Check if we are on siteoptions page, do this only if we are on siteoptions page.
    if ( isset( $_REQUEST['page'] ) && 'siteoptions' == $_REQUEST['page'] ) {
        // Reset option values.
        if ( isset( $_REQUEST['of_save'] ) && 'reset' == $_REQUEST['of_save'] ) {
            $template = get_option( 'of_template' );

            foreach ( $template as $t ) :
                $option_name    = esc_attr( $t['id'] );
                $default_value  = esc_attr( $t['std'] );
                update_option( $option_name, $default_value );
            endforeach;

            // Redirect and exit
            wp_redirect( esc_url(add_query_arg( array( 'page' => 'siteoptions', 'reset' => 'true' ), admin_url( 'admin.php' ) ) ) );
            exit;
        }

        // Save option value to database @since 2.0.3 dev 4.
        if ( isset( $_POST['of_save'] ) && 'submit' == $_POST['of_save'] ) {
            $template = get_option( 'of_template' );

            foreach ( $template as $t ) :
                $option_name    = $t['id'];
                $option_value   = stripslashes( $_POST[ $option_name ] ); // Posted from form.
                $type           = $t['type'];

                // Save checkbox value, update false if posted empty.
                if ( 'checkbox' == $type && '' == $option_value )
                    update_option( $option_name, 'false' );

                // Save checkbox value, update true if checked.
                if ( 'checkbox' == $type && 'true' == $option_value )
                    update_option( $option_name, 'true' );

                // Save multi checkbox value.
                if ( 'multicheck' == $type ) {
                    $option_options = $t['options'];

                    foreach ( $option_options as $options_id => $options_value ) {
                        $multicheck_id  = $t['id'] . "_" . $options_id;
                        $op_value       = stripslashes( $_POST[ $multicheck_id ] );

                        if ( '' == $op_value ) // Not checked.
                            update_option( $multicheck_id, 'false' );
                        else // Checked.
                            update_option( $multicheck_id, 'true' );
                    }
                }

                // Save all other option values.
                if ( 'multicheck' != $type && 'checkbox' != $type )
                    update_option( $option_name, esc_attr( $option_value ) );
            endforeach;

            // Redirect and exit
            wp_redirect( esc_url(add_query_arg( array( 'page' => 'siteoptions', 'save' => 'true' ), admin_url( 'admin.php' ) ) ) );
            exit;
        } // End check for submitting options.
    } // End check whether we are on siteoptions page.

    // Create site options page.
    $of_page = add_theme_page( __( 'Site Options', 'tt_theme_framework' ), __( 'Site Options', 'tt_theme_framework' ), 'edit_theme_options', 'siteoptions', 'siteoptions_options_page' );

    // Add framework functionaily to the head individually.
    add_action( 'admin_print_scripts-' . $of_page, 'of_load_only' );
    add_action( 'admin_print_styles-' . $of_page, 'of_style_only' );

}

/*-----------------------------------------------------------------------------------*/
/* Build the Options Page */
/*-----------------------------------------------------------------------------------*/

function siteoptions_options_page() {

    $options    = get_option( 'of_template' );
    $themename  = get_option( 'of_themename' );

    // Rev up the Options Machine
    $return = siteoptions_machine($options);
    ?>

    <div class="wrap" id="truethemes_container">
	<form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="POST" enctype="multipart/form-data" id="ofform">   
<div id="main">
   
	<div id="tt-options-content-wrap">
    	<h2 class="truethemes-admin-logo">
			<?php _e('Site Options','tt_theme_framework'); ?> <a class="add-new-h2" href="https://support.truethemes.net" target="_blank">Theme Support &rarr;</a></h2>
            
		<?php
        if($_GET['save']=='true'){
        echo '<div class="updated below-h2" id="message"><p><strong>The Settings have been saved.</strong></p></div>';
        }
        if($_GET['reset']=='true'){
        echo '<div class="updated below-h2" id="message"><p><strong>The Settings have been reset.</strong></p></div>';
        }  
        ?>             
              
		<div id="content"> 
      		<?php echo $return[0]; /* Settings */ ?>
            	<!-- <div class="clear"></div> -->
		</div><!-- END #content -->     
      
             
      <?php 
		//check for IE8
		//only display bottom save bae if not IE8
		$IE8 = (ereg('MSIE 8',$_SERVER['HTTP_USER_AGENT'])) ? true : false;
		
		
		if (($IE8 == 1)) {
			//time to update your browser
			} else { ?>

            <div id="tt-options-footer-save-bar">
            <input type="submit" value="Save All Changes" class="button-primary" />
            <input type="hidden" name="of_save" value="submit" />
            </form>
            
            <form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:inline" id="ofform-reset">
    			<input name="reset" type="submit" value="Reset Options" class="button submit-button reset-button" onclick="return confirm('CAUTION: Any and all settings will be lost! Click OK to reset.');" />
    			<input type="hidden" name="of_save" value="reset" />
             </form>
             </div> <!-- END #tt-options-footer-save-bar -->
            
             <?php } //END ie8 check ?>
                 
         </div><!-- END #tt-options-content-wrap -->
    
    
    
    <div id="tt-options-sidebar">
		<ul id="tt-options-nav">
          <?php echo $return[1] ?>
        </ul><!-- END #tt-options-nav -->
        
        <div id="tt-options-sidebar-controls">
        <input type="submit" value="Save All Changes" class="button-primary" />
        <input type="hidden" name="of_save" value="submit" />
        </form>
        </div><!-- END #tt-options-sidebar-controls -->
    </div><!-- END #tt-options-sidebar -->
    
</div><!-- END #main -->


  
<?php  if (!empty($update_message)) echo $update_message; ?>
<div style="clear:both;"></div>
</div><!-- END .wrap -->
<?php
}

/*-----------------------------------------------------------------------------------*/
/* Load required styles for Options Page - of_style_only */
/*-----------------------------------------------------------------------------------*/
function of_style_only() {
	wp_enqueue_style('admin-style', TT_FRAMEWORK.'/admin/admin-style.css');
	wp_enqueue_style('color-picker', TT_FRAMEWORK.'/admin/colorpicker.css');
	wp_enqueue_style('sterling-thickbox', TT_FRAMEWORK.'/admin/thickbox.css'); //@since 2.5
}

/*-----------------------------------------------------------------------------------*/
/* Load required javascripts for Options Page - of_load_only */
/*-----------------------------------------------------------------------------------*/

function of_load_only() {

    add_action( 'admin_head', 'of_admin_head', 100 );

    wp_enqueue_script( 'jquery-ui-core' );
    wp_register_script( 'jquery-input-mask', TT_FRAMEWORK . '/admin/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ) );
    wp_enqueue_script( 'jquery-input-mask' );
    wp_enqueue_script( 'color-picker', TT_FRAMEWORK . '/admin/js/colorpicker.js', array( 'jquery' ) );
    wp_enqueue_script( 'ajaxupload', TT_FRAMEWORK . '/admin/js/ajaxupload.js', array( 'jquery' ) );
    wp_enqueue_script('thickbox'); //@since 2.5 - added for "wheres my purchase code link"
    
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
					$option_id = $option['id'];
					$temp_color = get_option($option_id);
					$option_id = $option['id'] . '_color';
					$color = $temp_color['color'];
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
		
		<?php
		//AJAX Upload
		?>
<script type="text/javascript">
			jQuery(document).ready(function(){
				
				var i = 0;
				jQuery('#of-nav li a').attr('id', function() {
				   i++;
				   return 'item'+i;
				});

			
			var flip = 0;
				
			jQuery('#expand_options').click(function(){
				if(flip == 0){
					flip = 1;
					jQuery('#truethemes_container #of-nav').hide();
					jQuery('#truethemes_container #content').width(755);
					jQuery('#truethemes_container .group').add('#truethemes_container .group h2').show();
	
					jQuery(this).text('[-]');
					
				} else {
					flip = 0;
					jQuery('#truethemes_container #of-nav').show();
					jQuery('#truethemes_container #content').width(579);
					jQuery('#truethemes_container .group').add('#truethemes_container .group h2').hide();
					jQuery('#truethemes_container .group:first').show();
					jQuery('#truethemes_container #of-nav li').removeClass('current');
					jQuery('#truethemes_container #of-nav li:first').addClass('current');
					
					jQuery(this).text('[+]');
				
				}
			
			});
			
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
				
			//@since 2.0.3 removed popup reset
					
			
			//@since 2.0.3 removed Update Message popup
			
			
		
			//AJAX Upload
			jQuery('.image_upload_button').each(function(){
			
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');	
			new AjaxUpload(clickedID, {
				  action: ajaxurl,
				  name: clickedID, // File upload name
				  data: { // Additional data to send
						action: 'of_ajax_post_action',
						type: 'upload',
						data: clickedID },
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
				
					var data = {
						action: 'of_ajax_post_action',
						type: 'image_reset',
						data: theID
					};
					
					jQuery.post(ajaxurl, data, function(response) {
						var image_to_remove = jQuery('#image_' + theID);
						var button_to_hide = jQuery('#reset_' + theID);
						image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
						button_to_hide.fadeOut();
						clickedObject.parent().prev('input').val('');
						
						
						
					});
					
					return false; 
					
				});
//removed top save button				   	 	
//@since version 2.0.3, Deleted javascript ajax save other options 	 	
				
			});


jQuery(document).ready(function(){
	jQuery('#tt-options-sidebar').fixTo('#main');
	truethemes_admin_scrolltop();
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
	
	
/*! fixto - v0.1.7 - 2013-02-02
* http://github.com/bbarakaci/fixto/*/
var fixto=function(a,b,c){function h(b,c,d){this.child=b,this._$child=a(b),this.parent=c,this._replacer=new e.MimicNode(b),this._ghostNode=this._replacer.replacer,this.options=a.extend({className:"fixto-fixed"},d),this.options.mind&&(this._$mind=a(this.options.mind)),this.options.zIndex&&(this.child.style.zIndex=this.options.zIndex),this._saveStyles(),this._saveViewportHeight(),this._proxied_onscroll=this._bind(this._onscroll,this),this._proxied_onresize=this._bind(this._onresize,this),this.start()}var d=function(){var a={getAll:function(a){return c.defaultView.getComputedStyle(a)},get:function(a,b){return this.getAll(a)[b]},toFloat:function(a){return parseFloat(a,10)||0},getFloat:function(a,b){return this.toFloat(this.get(a,b))},_getAllCurrentStyle:function(a){return a.currentStyle}};return c.documentElement.currentStyle&&(a.getAll=a._getAllCurrentStyle),a}(),e=function(){function b(a){this.element=a,this.replacer=c.createElement("div"),this.replacer.style.visibility="hidden",this.hide(),a.parentNode.insertBefore(this.replacer,a)}b.prototype={replace:function(){var a=this.replacer.style,b=d.getAll(this.element);a.width=this._width(),a.height=this._height(),a.marginTop=b.marginTop,a.marginBottom=b.marginBottom,a.marginLeft=b.marginLeft,a.marginRight=b.marginRight,a.cssFloat=b.cssFloat,a.styleFloat=b.styleFloat,a.position=b.position,a.top=b.top,a.right=b.right,a.bottom=b.bottom,a.left=b.left,a.display=b.display},hide:function(){this.replacer.style.display="none"},_width:function(){return this.element.getBoundingClientRect().width+"px"},_widthOffset:function(){return this.element.offsetWidth+"px"},_height:function(){return this.element.getBoundingClientRect().height+"px"},_heightOffset:function(){return this.element.offsetHeight+"px"},destroy:function(){a(this.replacer).remove();for(var b in this)this.hasOwnProperty(b)&&(this[b]=null)}};var e=c.documentElement.getBoundingClientRect();return e.width||(b.prototype._width=b.prototype._widthOffset,b.prototype._height=b.prototype._heightOffset),{MimicNode:b,computedStyle:d}}(),f=navigator.appName==="Microsoft Internet Explorer",g;f&&(g=parseFloat(navigator.appVersion.split("MSIE")[1])),h.prototype={_bind:function(a,b){return function(){return a.call(b)}},_toresize:g===8?c.documentElement:b,_mindtop:function(){var b=0;return this._$mind&&a(this._$mind).each(function(){b+=a(this).outerHeight(!0)}),b},_onscroll:function(){this._scrollTop=c.documentElement.scrollTop||c.body.scrollTop,this._parentBottom=this.parent.offsetHeight+this._fullOffset("offsetTop",this.parent)-d.getFloat(this.parent,"paddingBottom");if(!this.fixed)this._scrollTop<this._parentBottom&&this._scrollTop>this._fullOffset("offsetTop",this.child)-d.getFloat(this.child,"marginTop")-this._mindtop()&&this._viewportHeight>this.child.offsetHeight+d.getFloat(this.child,"marginTop")+d.getFloat(this.child,"marginBottom")&&(this._fix(),this._adjust());else{if(this._scrollTop>this._parentBottom||this._scrollTop<this._fullOffset("offsetTop",this._ghostNode)-d.getFloat(this._ghostNode,"marginTop")-this._mindtop()){this._unfix();return}this._adjust()}},_adjust:function(){var a=this._parentBottom-this._scrollTop-(this.child.offsetHeight+d.getFloat(this.child,"marginTop")+d.getFloat(this.child,"marginBottom")+this._mindtop()),b=this._mindtop();a<0?this.child.style.top=a+b+"px":this.child.style.top=0+b+"px"},_fullOffset:function(a,b){var c=b[a];while(b.offsetParent!==null)b=b.offsetParent,c=c+b[a];return c},_fix:function(){var a=this.child,b=a.style;this._saveStyles();if(c.documentElement.currentStyle){var e=d.getAll(a);b.left=this._fullOffset("offsetLeft",a)-d.getFloat(a,"marginLeft")+"px",b.width=a.offsetWidth-(d.toFloat(e.paddingLeft)+d.toFloat(e.paddingRight)+d.toFloat(e.borderLeftWidth)+d.toFloat(e.borderRightWidth))+"px"}else b.width=d.get(a,"width"),b.left=a.getBoundingClientRect().left-d.getFloat(a,"marginLeft")+"px";this._replacer.replace(),b.position="fixed",b.top=this._mindtop()+"px",this._$child.addClass(this.options.className),this.fixed=!0},_unfix:function(){var a=this.child.style;this._replacer.hide(),a.position=this._childOriginalPosition,a.top=this._childOriginalTop,a.width=this._childOriginalWidth,a.left=this._childOriginalLeft,this._$child.removeClass(this.options.className),this.fixed=!1},_saveStyles:function(){var a=this.child.style;this._childOriginalPosition=a.position,this._childOriginalTop=a.top,this._childOriginalWidth=a.width,this._childOriginalLeft=a.left},_onresize:function(){this._saveViewportHeight(),this._unfix(),this._onscroll()},_saveViewportHeight:function(){this._viewportHeight=b.innerHeight||c.documentElement.clientHeight},stop:function(){this._unfix(),a(b).unbind("scroll",this._proxied_onscroll),a(this._toresize).unbind("resize",this._proxied_onresize),this._running=!1},start:function(){this._running||(this._onscroll(),a(b).bind("scroll",this._proxied_onscroll),a(this._toresize).bind("resize",this._proxied_onresize),this._running=!0)},destroy:function(){this.stop(),this._$child.removeData("fixto-instance"),this._replacer.destroy();for(var a in this)this.hasOwnProperty(a)&&(this[a]=null)}};var i=function(a,b,c){return new h(a,b,c)},j="ontouchstart"in b;if(j||g<8)i=function(){return"not supported"};return a.fn.fixTo=function(b,c){var d=a(b),e=0;return this.each(function(){var f=a(this).data("fixto-instance");if(!f)a(this).data("fixto-instance",i(this,d[e],c));else{var g=b;f[g].call(f)}e++})},{FixToContainer:h,fixTo:i,computedStyle:d,mimicNode:e}}(window.jQuery,window,document);

</script>
        <?php

}


}

/*-----------------------------------------------------------------------------------*/
/* Ajax Save Action - of_ajax_callback */
/*-----------------------------------------------------------------------------------*/

add_action( 'wp_ajax_of_ajax_post_action', 'of_ajax_callback' );
function of_ajax_callback() {

    global $wpdb; // this is how you get access to the database

    $save_type = stripslashes( $_POST['type'] );
    //Uploads
    if ( 'upload' == $save_type ) {
        $clickedID              = $_POST['data']; // Acts as the name
        $filename               = $_FILES[$clickedID];
        $filename['name']       = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']);
        $override['test_form']  = false;
        $override['action']     = 'wp_handle_upload';
        $uploaded_file          = wp_handle_upload( $filename, $override );
        $upload_tracking[]      = $clickedID;

        update_option( $clickedID , esc_url( $uploaded_file['url'] ) );

        if ( ! empty( $uploaded_file['error'] ) )
            echo __( 'Upload Error: ', 'tt_theme_framework' ) . $uploaded_file['error'];
        else
            echo $uploaded_file['url'];
    }
    elseif ( 'image_reset' == $save_type ) {
        $id     = $_POST['data']; // Acts as the name
        
     //mod by denzel
    //@since version 2.2, check WordPress version to determine which prepared statement to use.
    $check_wp_version = get_bloginfo('version');
    if($check_wp_version < 3.5){ 
			$query  = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($wpdb->prepare($query));
		}else{
			$query  = $wpdb->prepare("DELETE FROM $wpdb->options WHERE option_name LIKE %d",$id) ;
			$wpdb->query($query);		
		}
        

    }
    elseif ( $save_type == 'options' OR $save_type == 'tt_theme_framework' ) {
        $data = $_POST['data'];

        parse_str( $data, $output );
        $options = get_option( 'of_template' );

        foreach ( $options as $option_array ) {
            $id         = $option_array['id'];
            $old_value  = get_option($id);
            $new_value  = '';

            if ( isset( $output[$id] ) ) {
                $new_value = $output[$option_array['id']];
            }

            if ( isset( $option_array['id'] ) ) { // Non - Headings...
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



/*-----------------------------------------------------------------------------------*/
/* Generates The Options Within the Panel */
/*-----------------------------------------------------------------------------------*/

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
            $val = $value['std'];
            $std = stripslashes(get_option($value['id']));
            if ( $std != "") { $val = $std; }
            $output .= '<input class="of-input" name="'. esc_attr( $value['id'] ) .'" id="'. esc_attr( $value['id'] ) .'" type="'. esc_attr( $value['type'] ) .'" value="'. esc_attr( $val ) .'" />';
        break;

        case 'select':

            $output .= '<select class="of-input" name="'. esc_attr( $value['id'] ) .'" id="'. esc_attr( $value['id'] ) .'">';

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
                 $output .= esc_attr( $option );
                 $output .= '</option>';

             }
             $output .= '</select>';


        break;

        case 'fontsize':

        /* Font Size */
            $val = $default['size'];
            if ( $typography_stored['size'] != "") { $val = $typography_stored['size']; }
            $output .= '<select class="of-typography of-typography-size" name="'. esc_attr( $value['id'] ).'_size" id="'. esc_attr( $value['id'] ).'_size">';
                for ($i = 9; $i < 71; $i++){
                    if($val == $i){ $active = 'selected="selected"'; } else { $active = ''; }
                    $output .= '<option value="'. $i .'" ' . $active . '>'. absint( $i ) .'px</option>'; }
            $output .= '</select>';


        break;

        case "multicheck":

            $std =  $value['std'];

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
            $output .= '<input type="checkbox" class="checkbox of-input" name="'. esc_attr( $of_key ) .'" id="'. esc_attr( $of_key ) .'" value="true" '. $checked .' /><label for="'. esc_attr( $of_key ) .'">'. esc_attr( $option ) .'</label><br />';

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
                $std = stripslashes(get_option($value['id']));
                if( $std != "") { $ta_value = stripslashes( $std ); }
                $output .= '<textarea class="of-input" name="'. esc_attr( $value['id'] ) .'" id="'. esc_attr( $value['id'] ) .'" cols="'. esc_attr( $cols ) .'" rows="8">'.$ta_value.'</textarea>';


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
                $output .= '<input class="of-input of-radio" type="radio" name="'. esc_attr( $value['id'] ) .'" value="'. esc_attr( $key ) .'" '. $checked .' />' . esc_attr( $option ) .'<br />';

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
            $output .= '<input type="checkbox" class="checkbox of-input" name="'. esc_attr( $value['id'] ) .'" id="'. esc_attr( $value['id'] ) .'" value="true" '. $checked .' />';

        break;


        case "upload":

            $output .= siteoptions_uploader_function($value['id'],$value['std'],null);

        break;

        case "upload_min":

            $output .= siteoptions_uploader_function($value['id'],$value['std'],'min');

        break;
        case "color":
            $val = $value['std'];
            $stored  = get_option( $value['id'] );
            if ( $stored != "") { $val = $stored; }
            $output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';
            $output .= '<input class="of-color" name="'. esc_attr( $value['id'] ) .'" id="'. esc_attr( $value['id'] ) .'" type="text" value="'. esc_attr( $val ) .'" />';
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
                $output .= '<input type="radio" id="of-radio-img-' . esc_attr( $value['id'] ) . $i . '" class="checkbox of-radio-img-radio" value="'.esc_attr( $key ).'" name="'. esc_attr( $value['id'] ).'" '.$checked.' />';
                $output .= '<div class="of-radio-img-label">'. $key .'</div>';
                $output .= '<img src="'.esc_url( $option ).'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
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

                    $id = $array['id'];
                    $std = $array['std'];
                    $saved_std = get_option($id);
                    if($saved_std != $std){$std = $saved_std;}
                    $meta = $array['meta'];

                    if($array['type'] == 'text') { // Only text at this point

                         $output .= '<input class="input-text-small of-input" name="'. esc_attr( $id ) .'" id="'. esc_attr( $id ) .'" type="text" value="'. esc_attr( $std ) .'" />';
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



/*-----------------------------------------------------------------------------------*/
/* File Uploader */
/*-----------------------------------------------------------------------------------*/

function siteoptions_uploader_function($id,$std,$mod){

    //$uploader .= '<input type="file" id="attachement_'.$id.'" name="attachement_'.$id.'" class="upload_input"></input>';
    //$uploader .= '<span class="submit"><input name="save" type="submit" value="Upload" class="button upload_save" /></span>';

    $uploader = '';
    $upload = get_option($id);

    if($mod != 'min') {
            $val = $std;
            if ( get_option( $id ) != "") { $val = get_option($id); }
            $uploader .= '<input class="of-input" name="'. esc_attr( $id ) .'" id="'. esc_attr( $id ) .'_upload" type="text" value="'. esc_attr( $val ) .'" />';
    }

    $uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.esc_attr( $id ).'">Upload Image</span>';

    if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}

    $uploader .= '<span class="button image_reset_button '. sanitize_html_class( $hide ).'" id="reset_'. esc_attr( $id ) .'" title="' . esc_attr( $id ) . '">' . __( 'Remove', 'tt_theme_framework' ) . '</span>';
    $uploader .='</div>' . "\n";
    $uploader .= '<div class="clear"></div>' . "\n";
    if(!empty($upload)){
        $uploader .= '<a class="of-uploaded-image" href="'. esc_url( $upload ) . '">';
        $uploader .= '<img class="of-option-image" id="image_'.esc_attr( $id ).'" src="'.esc_url( $upload ).'" alt="" />';
        $uploader .= '</a>';
        }
    $uploader .= '<div class="clear"></div>' . "\n";

    return $uploader;
}