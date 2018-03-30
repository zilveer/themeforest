<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	if(isset($_GET['author']))
		$author = true;
	else
		$author = false;
?>
<div class="wrap about-wrap">
	<h1><?php echo __("Ultimate Addon Settings",'dfd'); ?></h1>
    <div class="about-text">Enable or disable the features as per your preference..</div>
    <div class="ult-badge" style="background:url(<?php echo get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/img/brainstorm-logo.png'; ?>) no-repeat top center; background-size: 150px;"></div>
    <div id="msg"></div>
    <div id="bsf-message"></div>
    <?php /* ?>
	<h2 class="nav-tab-wrapper"> 
        <a href="#css-settings" data-tab="css-settings" class="nav-tab"> Scripts and Styles </a>
    </h2>
    <?php */ ?>
    <?php
	$ultimate_modules = get_option('ultimate_modules');
	//$ultimate_row = get_option('ultimate_row');
	$ultimate_animation = get_option('ultimate_animation');
	$ultimate_smooth_scroll = get_option('ultimate_smooth_scroll');
	
	$ultimate_css = get_option('ultimate_css');
	$ultimate_js = get_option('ultimate_js');
	
	$checked = '';
	
	if($ultimate_animation == "enable"){
		$ultimate_animation = 'checked="checked"';
	} else {
		$ultimate_animation = '';
	}
	
	if($ultimate_smooth_scroll == "enable"){
		$ultimate_smooth_scroll = 'checked="checked"';
	} else {
		$ultimate_smooth_scroll = '';
	}
	
	if($ultimate_css == "enable"){
		$ultimate_css = 'checked="checked"';
	} else {
		$ultimate_css = '';
	}
	
	if($ultimate_js == "enable"){
		$ultimate_js = 'checked="checked"';
	} else {
		$ultimate_js = '';
	}
	?>
	<?php /* ?>
    <div id="css-settings" class="ult-tabs active-tab">
		<form method="post" id="css_settings">
            <input type="hidden" name="action" value="update_css_options" />
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><?php echo __("Optimized CSS",'dfd'); ?></th>
                        <td> <div class="onoffswitch">
                        <input type="checkbox" <?php echo $ultimate_css; ?> id="ultimate_css" value="enable" class="onoffswitch-checkbox" name="ultimate_css" />
                             <label class="onoffswitch-label" for="ultimate_css">
                                <div class="onoffswitch-inner">
                                    <div class="onoffswitch-active">
                                        <div class="onoffswitch-switch">ON</div>
                                    </div>
                                    <div class="onoffswitch-inactive">
                                        <div class="onoffswitch-switch">OFF</div>
                                    </div>
                                </div>
                            </label>
                            </div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php echo __("Optimized JS",'dfd'); ?></th>
                        <td> <div class="onoffswitch">
                        <input type="checkbox" <?php echo $ultimate_js; ?> id="ultimate_js" value="enable" class="onoffswitch-checkbox" name="ultimate_js" />
                             <label class="onoffswitch-label" for="ultimate_js">
                                <div class="onoffswitch-inner">
                                    <div class="onoffswitch-active">
                                        <div class="onoffswitch-switch">ON</div>
                                    </div>
                                    <div class="onoffswitch-inactive">
                                        <div class="onoffswitch-switch">OFF</div>
                                    </div>
                                </div>
                            </label>
                             </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <p class="submit"><input type="submit" name="submit" id="submit-css-settings" class="button button-large button-primary" value="<?php echo __("Save Changes",'dfd');?>"></p>
    </div>
	<?php */ ?>
	<h2 style="margin-top: 30px;"><?php _e('This theme provides Ultimate Addons for Visual Composer plugin as theme part. You don\'t need to install plugin or update it. You will get updates together with theme updates.' ,'dfd') ?></h2>
</div>
<script type="text/javascript">
var submit_btn = jQuery("#submit-modules");
submit_btn.bind('click',function(e){
	e.preventDefault();
	var data = jQuery("#ultimate_modules").serialize();
	jQuery.ajax({
		url: ajaxurl,
		data: data,
		dataType: 'html',
		type: 'post',
		success: function(result){
			console.log(result);
			if(result == "success"){
				jQuery("#msg").html('<div class="updated"><p>Settings updated successfully!</p></div>');
				jQuery('html,body').animate({ scrollTop: 0 }, 300);
			} else {
				jQuery("#msg").html('<div class="error"><p>No settings were updated.</p></div>');
				jQuery('html,body').animate({ scrollTop: 0 }, 300);
			}
		}
	});
});
var submit_btn = jQuery("#submit-settings");
submit_btn.bind('click',function(e){
	e.preventDefault();
	var data = jQuery("#ultimate_settings").serialize();
	jQuery.ajax({
		url: ajaxurl,
		data: data,
		dataType: 'html',
		type: 'post',
		success: function(result){
			console.log(result);
			if(result == "success"){
				jQuery("#msg").html('<div class="updated"><p>Settings updated successfully!</p></div>');
			} else {
				jQuery("#msg").html('<div class="error"><p>No settings were updated.</p></div>');
			}
		}
	});
});
var submit_btn = jQuery("#submit-css-settings");
submit_btn.bind('click',function(e){
	e.preventDefault();
	var data = jQuery("#css_settings").serialize();
	jQuery.ajax({
		url: ajaxurl,
		data: data,
		dataType: 'html',
		type: 'post',
		success: function(result){
			console.log(result);
			if(result == "success"){
				jQuery("#msg").html('<div class="updated"><p>Settings updated successfully!</p></div>');
			} else {
				jQuery("#msg").html('<div class="error"><p>No settings were updated.</p></div>');
			}
		}
	});
});
var submit_btn = jQuery("#submit-debug-settings");
submit_btn.bind('click',function(e){
	e.preventDefault();
	var data = jQuery("#ultimate_debug_settings").serialize();
	jQuery.ajax({
		url: ajaxurl,
		data: data,
		dataType: 'html',
		type: 'post',
		success: function(result){
			console.log(result);
			if(result == "success"){
				jQuery("#msg").html('<div class="updated"><p>Settings updated successfully!</p></div>');
			} else {
				jQuery("#msg").html('<div class="error"><p>No settings were updated.</p></div>');
			}
		}
	});
});
jQuery(document).ready(function(e) {
    var tab_link = jQuery(".nav-tab");
	var tabs = jQuery(".ult-tabs");
	var url = window.location,
		hash = url.hash.match(/^[^\?]*/)[0];
	if(hash != ''){
		tab_link.each(function(index, element) {
            jQuery(this).removeClass('nav-tab-active');
        });
		tabs.each(function(index, element) {
            jQuery(this).removeClass('active-tab');
        });
		jQuery('a[href="'+hash+'"]').addClass('nav-tab-active');
		jQuery(""+hash).addClass('active-tab');
	}
	// Toggle the tabs
	tab_link.click(function(e){
		e.preventDefault();
		window.location = jQuery(this).attr('href');	
		var cur_tab = jQuery(this).data('tab');
		tab_link.each(function(index, element) {
            jQuery(this).removeClass('nav-tab-active');
        });
		tabs.each(function(index, element) {
            jQuery(this).removeClass('active-tab');
        });
		jQuery(this).addClass('nav-tab-active');
		jQuery("#"+cur_tab).addClass('active-tab');
	});
});
</script>
<style type="text/css">
/*On Off Checkbox Switch*/
.onoffswitch {
	position: relative;
	width: 95px;
	display: inline-block;
	float: left;
	margin-right: 15px;
	-webkit-user-select:none;
	-moz-user-select:none;
	-ms-user-select: none;
}
.onoffswitch-checkbox {
	display: none !important;
}
.onoffswitch-label {
	display: block;
	overflow: hidden;
	cursor: pointer;
	border: 0px solid #999999;
	border-radius: 0px;
}
.onoffswitch-inner {
	width: 200%;
	margin-left: -100%;
	-moz-transition: margin 0.3s ease-in 0s;
	-webkit-transition: margin 0.3s ease-in 0s;
	-o-transition: margin 0.3s ease-in 0s;
	transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner > div {
	float: left;
	position: relative;
	width: 50%;
	height: 24px;
	padding: 0;
	line-height: 24px;
	font-size: 12px;
	color: white;
	font-weight: bold;
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
}
.onoffswitch-inner .onoffswitch-active {
	padding-left: 15px;
	background-color: #CCCCCC;
	color: #FFFFFF;
}
.onoffswitch-inner .onoffswitch-inactive {
	padding-right: 15px;
	background-color: #CCCCCC;
	color: #FFFFFF;
	text-align: right;
}
.onoffswitch-switch {
	/*width: 50px;*/
	width:35px;
	margin: 0px;
	text-align: center;
	border: 0px solid #999999;
	border-radius: 0px;
	position: absolute;
	top: 0;
	bottom: 0;
}
.onoffswitch-active .onoffswitch-switch {
	background: #3F9CC7;
	left: 0;
}
.onoffswitch-inactive .onoffswitch-switch {
	background: #7D7D7D;
	right: 0;
}
.onoffswitch-active .onoffswitch-switch:before {
	content: " ";
	position: absolute;
	top: 0;
	/*left: 50px;*/
	left:35px;
	border-style: solid;
	border-color: #3F9CC7 transparent transparent #3F9CC7;
	/*border-width: 12px 8px;*/
	border-width: 15px;
}
.onoffswitch-inactive .onoffswitch-switch:before {
	content: " ";
	position: absolute;
	top: 0;
	/*right: 50px;*/
	right:35px;
	border-style: solid;
	border-color: transparent #7D7D7D #7D7D7D transparent;
	/*border-width: 12px 8px;*/
	border-width: 50px;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
	margin-left: 0;
}
#ultimate-settings, #ultimate-modules, .ult-tabs{ display:none; }
#ultimate-settings.active-tab, #ultimate-modules.active-tab, .ult-tabs.active-tab{ display:block; }
.ult-badge {
	padding-bottom: 10px;
	height: 170px;
	width: 150px;
	position: absolute;
	border-radius: 3px;
	top: 0;
	right: 0;
}
div#msg > .updated, div#msg > .error { display:block !important;}
div#msg {
	position: absolute;
	left: 0;
	top: 100px;
	max-width: 30%;
}
</style>