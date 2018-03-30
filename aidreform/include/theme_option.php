<?php
function theme_option() {
	global $post, $cs_theme_option;
	//$g_fonts = get_google_fonts();
	//$cs_theme_option = get_option('cs_theme_option');
	
	
	
?>
<link href="<?php echo get_template_directory_uri()?>/css/admin/datePicker.css" rel="stylesheet" type="text/css" />
<form id="frm" method="post" action="javascript:theme_option_save('<?php echo admin_url('admin-ajax.php'); ?>', '<?php echo get_template_directory_uri()?>');">
  <div class="theme-wrap fullwidth">
    <div class="loading_div"></div>
    <div class="form-msg"></div>
    <div class="inner">
      <div class="row"> 
        <!-- Left Column Start -->
        <div class="col1">
          <div class="logo"><a href="#"><img src="<?php echo get_template_directory_uri()?>/images/admin/logo.png" /></a></div>
          <div class="arrowlistmenu" id="paginate-slider2">
            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon g-setting">&nbsp;</span><?php _e('General Settings','AidReform')?></a></h3>
            <ul class="categoryitems">
              <li class="tab-color active"><a href="#tab-color" onClick="toggleDiv(this.hash);return false;"><?php _e('Color and Style','AidReform')?></a></li>
              <li class="tab-logo"><a href="#tab-logo" onClick="toggleDiv(this.hash);return false;"><?php _e('Logo / Fav Icon','AidReform')?></a></li>
              <li class="tab-head-scripts"><a href="#tab-head-scripts" onClick="toggleDiv(this.hash);return false;"><?php _e('Header Settings','AidReform')?></a></li>
              <li class="tab-breadcrumbs-scripts"><a href="#tab-breadcrumbs-scripts" onClick="toggleDiv(this.hash);return false;"><?php _e('Breadcrumbs Settings','AidReform')?></a></li>
              <li class="tab-foot-setting"><a href="#tab-foot-setting" onClick="toggleDiv(this.hash);return false;"><?php _e('Footer Settings','AidReform')?></a></li>
              <li class="tab-under-consturction"><a href="#tab-under-consturction" onClick="toggleDiv(this.hash);return false;"><?php _e('Under Construction','AidReform')?></a></li>
              <li class="tab-other"><a href="#tab-other" onClick="toggleDiv(this.hash);return false;"><?php _e('Other Settings','AidReform')?></a></li>
              <li class="tab-api-key"><a href="#tab-paypalapi-key" onClick="toggleDiv(this.hash);return false;"><?php _e('Paypal API Settings','AidReform')?></a></li>
              <li class="tab-mailchimp-key"><a href="#tab-mailchimp-key" onClick="toggleDiv(this.hash);return false;"><?php _e('MailChimp Settings','AidReform')?></a></li>
              <li class="tab-api-key"><a href="#tab-api-key" onClick="toggleDiv(this.hash);return false;"><?php _e('API Settings','AidReform')?></a></li>
              
            </ul>
            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon h-setting">&nbsp;</span><?php _e('Home Page Settings','AidReform')?></a></h3>
            <ul class="categoryitems">
              <li class="tab-slider"><a href="#tab-slider" onClick="toggleDiv(this.hash);return false;"><?php _e('Home Page Slider','AidReform')?></a></li>
              <li class="tab-Announcement"><a href="#tab-Announcement" onClick="toggleDiv(this.hash);return false;"><?php _e('Home Page Announcement','AidReform')?></a></li>
            </ul>
           <h3 class="menuheader expandable"><a href="#"><span class="nav-icon side-bar">&nbsp;</span><?php _e('Side Bars','AidReform')?></a></h3>
            <ul class="categoryitems">
              <li class="tab-manage-sidebars"><a href="#tab-manage-sidebars" onClick="toggleDiv(this.hash);return false;"><?php _e('Manage Sidebars','AidReform')?></a></li>
            </ul>
            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon slider-setting">&nbsp;</span><?php _e('Slider Setting','AidReform')?></a></h3>
            <ul class="categoryitems">
              <li class="tab-flex-slider"><a href="#tab-flex-slider" onClick="toggleDiv(this.hash);return false;"><?php _e('Flex Slider','AidReform')?></a></li>
            </ul>
            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon s-network">&nbsp;</span><?php _e('Social Settings','AidReform')?></a></h3>
            <ul class="categoryitems">
              <li class="tab-social-network"><a href="#tab-social-network" onClick="toggleDiv(this.hash);return false;"><?php _e('Social Network','AidReform')?></a></li>
              <li class="tab-social-sharing"><a href="#tab-social-sharing" onClick="toggleDiv(this.hash);return false;"><?php _e('Social Sharing','AidReform')?></a></li>
            </ul>
            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon languages">&nbsp;</span><?php _e('Language','AidReform')?></a></h3>
            <ul class="categoryitems">
              <li class="tab-upload-languages"><a href="#tab-upload-languages" onClick="toggleDiv(this.hash);return false;"><?php _e('Upload New Languages','AidReform')?></a></li>
            </ul>
            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon translation">&nbsp;</span><?php _e('Translation','AidReform')?></a></h3>
            <ul class="categoryitems">
              <li class="tab-event-translation"><a href="#tab-event-translation" onClick="toggleDiv(this.hash);return false;"><?php _e('Events','AidReform')?></a></li>
              <li class="tab-cause-translation"><a href="#tab-cause-translation" onClick="toggleDiv(this.hash);return false;"><?php _e('Cause','AidReform')?></a></li>
              <li class="tab-contact-translation"><a href="#tab-contact-translation" onClick="toggleDiv(this.hash);return false;"><?php _e('Contact','AidReform')?></a></li>
              <li class="tab-other-translation"><a href="#tab-other-translation" onClick="toggleDiv(this.hash);return false;"><?php _e('Others','AidReform')?></a></li>
            </ul>
            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon default-pages">&nbsp;</span><?php _e('Default Pages','AidReform')?></a></h3>
            <ul class="categoryitems">
              <li class="tab-default-pages"><a href="#tab-default-pages" onClick="toggleDiv(this.hash);return false;"><?php _e('Default Pages','AidReform')?></a></li>
            </ul>
            <h3 class="menuheader expandable"><a href="#"><span class="nav-icon default-pages">&nbsp;</span><?php _e('Backup Options','AidReform')?></a></h3>
            <ul class="categoryitems">
              <li class="tab-import-export"><a href="#tab-import-export" onClick="toggleDiv(this.hash);return false;"><?php _e('Theme Options Backup and restore settings','AidReform')?></a></li>
            </ul>
          </div>
          <div class="clear"></div>
        </div>
        <!-- Left Column End -->
        <div class="col2">
          <input type="submit" id="submit_btn" name="submit_btn" class="topbtn" value="<?php _e('Save All Settings','AidReform')?>" />
          <!-- Color And Style Start -->
          <div id="tab-color">
            <div class="theme-header">
              <h1><?php _e('General Settings','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Color And Styles','AidReform')?></h4>
              <p><?php _e('Theme color scheme and styling setting','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Custom Color Scheme','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="custom_color_scheme" value="<?php echo $cs_theme_option['custom_color_scheme']?>" class="bg_color" />
                <p><?php _e('Pick a custom color for Scheme of the theme','AidReform')?> e.g. #697e09</p>
              </li>
            </ul>
            <ul class="form-elements">
            	<li class="to-label">
                	<label><?php _e('Banner Color Scheme','AidReform')?></label>
              	</li>
              	<li class="to-field">
                	<input type="hidden" name="banner_color" value="" />
                	<input type="checkbox" class="myClass" name="banner_color" <?php if($cs_theme_option['banner_color']=="on") echo "checked" ?> />
                	<p><?php _e('Switch it on if you want to show custom color','AidReform')?></p>
              	</li>
           		<li class="to-label"><label><?php _e('Select Banner Color','AidReform')?></label></li>
                <li>
                    <input type="text" name="banner_bg_color" value="<?php echo $cs_theme_option['banner_bg_color']?>" class="bg_color" />
                    <p><?php _e('Pick a custom color for banner','AidReform')?> e.g. #333</p>
                </li>
            </ul> 
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Layout Option','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="radio" name="layout_option" value="wrapper_boxed" <?php if($cs_theme_option['layout_option']=="wrapper_boxed")echo "checked"?> class="styled" />
                <label><?php _e('Boxed','AidReform')?></label>
                <input type="radio" name="layout_option" value="wrapper" <?php if($cs_theme_option['layout_option']=="wrapper")echo "checked"?> class="styled" />
                <label><?php _e('Wide','AidReform')?></label>
              </li>
            </ul>
            <div class="opt-head">
              <h4><?php _e('Layout Options','AidReform')?></h4>
              <div class="clear"></div>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Background Image','AidReform')?></label>
              </li>
              <li class="to-field">
                <div class="meta-input pattern">
                  <?php
					for ( $i = 0; $i < 13; $i++ ) {
					?>
                  <div class='radio-image-wrapper'>
                    <input <?php if($cs_theme_option['bg_img']==$i)echo "checked"?> onclick="select_bg()" type="radio" name="bg_img" class="radio" value="<?php echo $i?>" />
                    <label for="radio_<?php echo $i?>"> <span class="ss"><img src="<?php echo get_template_directory_uri()?>/images/background/background<?php echo $i?>.png" /></span> <span <?php if($cs_theme_option['bg_img']==$i)echo "class='check-list'"?> id="check-list">&nbsp;</span> </label>
                  </div>
                  <?php }?>
                </div>
              </li>
              <li class="full">&nbsp;</li>
              <li class="to-label">
                <label><?php _e('Background Image','AidReform')?></label>
              </li>
              <li class="to-field">
                <input id="bg_img_custom" name="bg_img_custom" value="<?php echo $cs_theme_option['bg_img_custom'] ?>" type="text" class="small" />
                <input id="bg_img_custom" name="bg_img_custom" type="button" class="uploadfile left" value="<?php _e('Browse','AidReform')?>"/>
                <?php if ( $cs_theme_option['bg_img_custom'] <> "" ) { ?>
                <div class="thumb-preview" id="bg_img_custom_img_div"> <img src="<?php echo $cs_theme_option['bg_img_custom']?>" /> <a href="javascript:remove_image('bg_img_custom')" class="del">&nbsp;</a> </div>
                <?php } ?>
              </li>
              <li class="full">&nbsp;</li>
              <li class="to-label">
                <label><?php _e('Position','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="radio" name="bg_position" value="left" <?php if($cs_theme_option['bg_position']=="left")echo "checked"?> class="styled" />
                <label><?php _e('Left','AidReform')?></label>
                <input type="radio" name="bg_position" value="center" <?php if($cs_theme_option['bg_position']=="center")echo "checked"?> class="styled" />
                <label><?php _e('Center','AidReform')?></label>
                <input type="radio" name="bg_position" value="right" <?php if($cs_theme_option['bg_position']=="right")echo "checked"?> class="styled" />
                <label><?php _e('Right','AidReform')?></label>
              </li>
              <li class="full">&nbsp;</li>
              <li class="to-label">
                <label><?php _e('Repeat','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="radio" name="bg_repeat" value="no-repeat" <?php if($cs_theme_option['bg_repeat']=="no-repeat")echo "checked"?> class="styled" />
                <label><?php _e('No Repeat','AidReform')?></label>
                <input type="radio" name="bg_repeat" value="repeat" <?php if($cs_theme_option['bg_repeat']=="repeat")echo "checked"?> class="styled" />
                <label><?php _e('Tile','AidReform')?></label>
                <input type="radio" name="bg_repeat" value="repeat-x" <?php if($cs_theme_option['bg_repeat']=="repeat-x")echo "checked"?> class="styled" />
                <label><?php _e('Tile Horizontally','AidReform')?></label>
                <input type="radio" name="bg_repeat" value="repeat-y" <?php if($cs_theme_option['bg_repeat']=="repeat-y")echo "checked"?> class="styled" />
                <label><?php _e('Tile Vertically','AidReform')?></label>
              </li>
              <li class="full">&nbsp;</li>
              <li class="to-label">
                <label><?php _e('Attachment','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="radio" name="bg_attach" value="scroll" <?php if($cs_theme_option['bg_attach']=="scroll")echo "checked"?> class="styled" />
                <label><?php _e('Scroll','AidReform')?></label>
                <input type="radio" name="bg_attach" value="fixed" <?php if($cs_theme_option['bg_attach']=="fixed")echo "checked"?> class="styled" />
                <label><?php _e('Fixed','AidReform')?></label>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Background Pattern','AidReform')?></label>
              </li>
              <li class="to-field">
                <div class="meta-input pattern">
                  <?php
										for ( $i = 0; $i < 15; $i++ ) {
										?>
                  <div class='radio-image-wrapper'>
                    <input <?php if($cs_theme_option['pattern_img']==$i)echo "checked"?> onclick="select_pattern()" type="radio" name="pattern_img" class="radio" value="<?php echo $i?>" />
                    <label for="radio_<?php echo $i?>"> <span class="ss"><img src="<?php echo get_template_directory_uri()?>/images/pattern/pattern<?php echo $i?>.png" /></span> <span <?php if($cs_theme_option['pattern_img']==$i)echo "class='check-list'"?> id="check-list">&nbsp;</span> </label>
                  </div>
                  <?php }?>
                </div>
              </li>
              <li class="full">&nbsp;</li>
              <li class="to-label">
                <label><?php _e('Background Pattern','AidReform')?></label>
              </li>
              <li class="to-field">
                <input id="custome_pattern" name="custome_pattern" value="<?php echo $cs_theme_option['custome_pattern']; ?>" type="text" class="small" />
                <input id="custome_pattern" name="custome_pattern" type="button" class="uploadfile left" value="<?php _e('Browse','AidReform')?>"/>
                <?php if ( $cs_theme_option['custome_pattern'] <> "" ) { ?>
                <div class="thumb-preview" id="custome_pattern_img_div"> <img src="<?php echo $cs_theme_option['custome_pattern'];?>" /> <a href="javascript:remove_image('custome_pattern')" class="del">&nbsp;</a> </div>
                <?php }?>
              </li>
              <li class="full">&nbsp;</li>
              <li class="to-label">
                <label><?php _e('Background Color','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="bg_color" value="<?php echo $cs_theme_option['bg_color']?>" class="bg_color" data-default-color="" />
              </li>
            </ul>
          </div>
          <!-- Color And Style End --> 
          <!-- Logo Tabs -->
          <div id="tab-logo" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Logo / Fav Icon Settings','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Logo / Fav Icon Settings','AidReform')?></h4>
              <p><?php _e('Add your logo and fav icon','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Upload Logo','AidReform')?></label>
              </li>
              <li class="to-field">
                <input id="logo" name="logo" value="<?php echo $cs_theme_option['logo']?>" type="text" class="small {validate:{accept:'jpg|jpeg|gif|png|bmp'}}" />
                <input id="log" name="logo" type="button" class="uploadfile left" value="<?php _e('Browse','AidReform')?>"/>
                <?php if ( $cs_theme_option['logo'] <> "" ) { ?>
                <div class="thumb-preview" id="logo_img_div"> <img width="<?php echo $cs_theme_option['logo_width']?>" height="<?php echo $cs_theme_option['logo_height']?>" src="<?php echo $cs_theme_option['logo']?>" /> <a href="javascript:remove_image('logo')" class="del">&nbsp;</a> </div>
                <?php } ?>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Width','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="logo_width" id="width-value" value="<?php echo $cs_theme_option['logo_width']?>" class="vsmall" />
                <span class="short">px</span>
                <p><?php _e('Please enter the required size','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Height','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="logo_height" id="height-value" value="<?php echo $cs_theme_option['logo_height']?>" class="vsmall" />
                <span class="short">px</span>
                <p><?php _e('Please enter the required size','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Sticky Menu','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="hidden" name="header_sticky_menu" value="" />
                <input type="checkbox" class="myClass" name="header_sticky_menu" <?php if ($cs_theme_option['header_sticky_menu'] == "on") echo "checked" ?> />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('FAV Icon','AidReform')?></label>
              </li>
              <li class="to-field">
                <input id="fav_icon" name="fav_icon" value="<?php echo $cs_theme_option['fav_icon']?>" type="text" class="small {validate:{accept:'ico|png'}}" />
                <input id="fav_icon" name="fav_icon" type="button" class="uploadfile left" value="<?php _e('Browse','AidReform')?>" />
                <p><?php _e('Browse a small fav icon, only .ICO or .PNG format allowed','AidReform')?></p>
              </li>
            </ul>
          </div>
          
          <!-- Logo Tabs End --> 
          
          <!-- Header Styles --> 
          
          <!-- Header Script -->
          <div id="tab-head-scripts" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Header Settings','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Header Settings','AidReform')?></h4>
              <p><?php _e('Modify your header settings','AidReform')?></p>
            </div>
            <div class="header-section" id="header_banner1">
              <ul class="form-elements">
              <li class="full">&nbsp;</li>
              <li class="to-label">
                  <label><?php _e('Logo','AidReform')?></label>
                </li>
                <li class="to-field">
                  <input type="hidden" name="header_logo" value=""  />
                  <input type="checkbox" class="myClass" name="header_logo" <?php if ($cs_theme_option['header_logo'] == "on") echo "checked" ?> />
                </li>
              </ul>
              
              
              <ul class="form-elements">
                <li class="full">&nbsp;</li>
                <li class="to-label">
                  <label><?php _e('Header Top Menu','AidReform')?></label>
                </li>
                <li class="to-field">
                  <input type="hidden" name="header_top_menu" value="" />
                  <input type="checkbox" class="myClass" name="header_top_menu" <?php if ($cs_theme_option['header_top_menu'] == "on") echo "checked" ?> />
                </li>
              </ul>
              <?php 
			   $wpmlsettings=get_option('icl_sitepress_settings');
 
 				if ( function_exists('icl_object_id') ) {
					if(!isset($cs_theme_option['header_languages'])){$cs_theme_option['header_languages'] = 'on';}
   			  ?>
              <ul class="form-elements">
                <li class="full">&nbsp;</li>
                <li class="to-label">
                  <label><?php _e('Header Languages','AidReform')?></label>
                </li>
                <li class="to-field">
                  <input type="hidden" name="header_languages" value="" />
                  <input type="checkbox" class="myClass" name="header_languages" <?php if ($cs_theme_option['header_languages'] == "on") echo "checked" ?> />
                </li>
              </ul>
              <?php } ?>
              <?php if ( function_exists( 'is_woocommerce' ) ){
						if(!isset($cs_theme_option['header_cart'])){$cs_theme_option['header_cart'] = 'on';}
				 ?> 
                <ul class="form-elements">
                    <li class="full">&nbsp;</li>
                    <li class="to-label">
                       <label><?php _e('Cart Count','AidReform')?></label>
                    </li>
                    <li class="to-field">
                      <input type="hidden" name="header_cart" value=""/>
                      <input type="checkbox" class="myClass" name="header_cart" <?php if ($cs_theme_option['header_cart'] == "on") echo "checked" ?>/>
                    </li>
                  </ul>
            <?php } ?>
               
              
            </div>
             <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Header Code','AidReform')?></label>
              </li>
              <li class="to-field">
                <textarea rows="" cols="" name="header_code"><?php echo $cs_theme_option['header_code']?></textarea>
                <p><?php _e('Paste your Html or Css Code here','AidReform')?></p>
              </li>
            </ul>
          </div>
          <!-- Header Script End --> 
          <div id="tab-breadcrumbs-scripts" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('BreadCrumbs Settings','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('BreadCrumbs','AidReform')?></h4>
              <p><?php _e('Edit BreadCrumbs settings','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Choose Bread Crumbs Type','AidReform')?></label>
              </li>
              <li class="to-field">
                <select name="beadcrumbs_type" class="dropdown" onchange="javascript:home_breadcrumb_toggle(this.value)">
                  <option <?php if($cs_theme_option['beadcrumbs_type']=="breadcrumbs"){echo "selected";}?> value="breadcrumbs" ><?php _e('BreadCrumbs','AidReform')?></option>
                  <option <?php if($cs_theme_option['beadcrumbs_type']=="custome_style"){echo "selected";}?> value="custome_style" ><?php _e('Custom Style','AidReform')?></option>
                </select>
              </li>
            </ul>
            <ul class="form-elements" id="cs_breadcrumbs" style=" <?php if($cs_theme_option['beadcrumbs_type']<>"breadcrumbs")echo "display:none"; else "display:inline"; ?>">
             <li class="to-label">
                <label><?php _e('Show BreadCrumbs','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="hidden" name="show_beadcrumbs" value="" />
                <input type="checkbox" class="myClass" name="show_beadcrumbs" <?php if($cs_theme_option['show_beadcrumbs']=="on") echo "checked" ?> />
                <p><?php _e('Switch it on if you want to show BreadCrumbs. If you switch it off it will not show BreadCrumbs','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements" id="cs_custome_style" style=" <?php if($cs_theme_option['beadcrumbs_type'] =="" or $cs_theme_option['beadcrumbs_type'] <> "custome_style")echo "display:none"; else "display:inline"; ?>" >
              <li class="to-label">
                <label><?php _e('Breadcrumb Text','AidReform')?></label>
              </li>
              <li class="to-field">
              	<textarea name="breadcrumb_text" cols="20" rows="8"><?php echo $cs_theme_option['breadcrumb_text'];?></textarea>
                <p><?php _e('If you want to show custom text instead of BreadCrumbs','AidReform')?></p>
              </li>
            </ul>
          </div>
          <!-- Footer Settings -->
          <div id="tab-foot-setting" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Footer Settings','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Footer Settings','AidReform')?></h4>
              <p><?php _e('Add footer setting detail','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Partners Title','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="partners_title" value="<?php echo $cs_theme_option['partners_title']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Select Partner','AidReform')?></label>
              </li>
              <li class="to-field">
                <select name="partners_gallery">
                  <option value="0"><?php _e('--Select Partner--','AidReform')?></option>
                  <?php
                  	query_posts( array('posts_per_page' => "-1", 'post_status' => 'publish', 'post_type' => 'cs_gallery') );
                    while ( have_posts()) : the_post();
                  ?>
                  <option <?php if($cs_theme_option['partners_gallery']==$post->post_name)echo "selected"?> value="<?php echo $post->post_name;?>">
                  <?php the_title()?>
                  </option>
                  <?php endwhile; ?>
                </select>
                <p><?php _e('You have to create partner gallery from gallery post type','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Show Partners','AidReform')?></label>
              </li>
              <li class="to-field">
              	<select name="show_partners">
                  <option value="none"><?php _e('None','AidReform')?></option>
                    <option <?php if($cs_theme_option['show_partners']=="home") echo "selected" ?> value="home"><?php _e('Home Page','AidReform')?> </option>
                    <option <?php if($cs_theme_option['show_partners']=="all") echo "selected" ?> value="all"><?php _e('All Pages','AidReform')?></option>
                 </select>
                 <p><?php _e('Select option to show partner on home page / all pages','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Custom Copyright','AidReform')?></label>
              </li>
              <li class="to-field">
                <textarea rows="2" cols="4" name="copyright"><?php echo $cs_theme_option['copyright']?></textarea>
                <p><?php _e('Write Custom Copyright text','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Powered By Text','AidReform')?></label>
              </li>
              <li class="to-field">
                <textarea rows="2" cols="4" name="powered_by"><?php echo $cs_theme_option['powered_by']?></textarea>
                <p><?php _e('Please enter powered by text','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Analytics Code','AidReform')?></label>
              </li>
              <li class="to-field">
                <textarea rows="" cols="" name="analytics"><?php echo $cs_theme_option['analytics']?></textarea>
                <p><?php _e('Paste your Google Analytics (or other) tracking code here','AidReform')?><br />
                  <?php _e('This will be added into the footer template of your theme','AidReform')?></p>
              </li>
            </ul>
          </div>
          <!-- Footer Settings End --> 
          <!-- Maintenance Page Settings start -->
          <div id="tab-under-consturction" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Maintenance Page Settings','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Maintenance Page Settings','AidReform')?></h4>
              <p><?php _e('Add maintenance page setting detail','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Maintenance Page','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="hidden" name="under-construction" value="" />
                <input type="checkbox" class="myClass" name="under-construction" <?php if($cs_theme_option['under-construction']=="on") echo "checked" ?> />
                <p><?php _e('Set the maintenance page On/Off','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Show Logo','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="hidden" name="showlogo" value="" />
                <input type="checkbox" class="myClass" name="showlogo" <?php if($cs_theme_option['showlogo']=="on") echo "checked" ?> />
                <p><?php _e('Set show logo On/Off','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Maintenance Text','AidReform')?></label>
              </li>
              <li class="to-field">
                <textarea rows="2" cols="4" name="under_construction_text"><?php echo $cs_theme_option['under_construction_text']?></textarea>
                <p><?php _e('Write Maintenance','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Launch Date','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" id="launch_date" name="launch_date" value="<?php if($cs_theme_option['launch_date'] == ''){ echo gmdate("Y-m-d"); }else{ echo $cs_theme_option['launch_date']; } ?>" />
                <p><?php _e('Put event start date','AidReform')?> </p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Social Network','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="hidden" name="socialnetwork" value="" />
                <input type="checkbox" class="myClass" name="socialnetwork" <?php if($cs_theme_option['socialnetwork']=="on") echo "checked" ?> />
                <p><?php _e('Set social network On/Off','AidReform')?></p>
              </li>
            </ul>
          </div>
          <!-- Maintenance Page Settings end --> 
          <!-- Other Settings Start -->
          <div id="tab-other" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Other Setting','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Other Setting','AidReform')?></h4>
              <p><?php _e('Other Setting','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Responsive','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="hidden" name="responsive" value="" />
                <input type="checkbox" class="myClass" name="responsive" <?php if($cs_theme_option['responsive']=="on") echo "checked" ?> />
                <p><?php _e('Set the responsive On/Off','AidReform')?></p>
              </li>
            </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Color Switcher','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="hidden" name="color_switcher" value="" />
                <input type="checkbox" class="myClass" name="color_switcher" <?php if($cs_theme_option['color_switcher']=="on") echo "checked" ?> />
                <p><?php _e('Set the color switcher for user demo','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Translation Switcher','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="hidden" name="trans_switcher" value="" />
                <input type="checkbox" class="myClass" name="trans_switcher" <?php if($cs_theme_option['trans_switcher']=="on") echo "checked" ?> />
                <p><?php _e('Set the translation switcher for user demo','AidReform')?></p>
              </li>
            </ul>
          </div>
          <!-- Other Settings End --> 
          <!-- API Settings Start -->
          <div id="tab-api-key" style="display:none;">
          <div class="theme-header">
            <h1><?php _e('API Setting','AidReform')?></h1>
          </div>
          <div class="theme-help">
            <h4><?php _e('Twitter API Setting','AidReform')?></h4>
            <p><?php _e('Twitter API Setting','AidReform')?></p>
          </div>
          <div class="opt-head">
            <h4><?php _e('Twitter API Setting','AidReform')?></h4>
            <div class="clear"></div>
          </div>
          
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Cache Time Limit','Faith')?></label>
            </li>
            <li class="to-field">
              <input type="hidden" name="cache_limit_time" value="" />
              <input type="text" id="cache_limit_time" name="cache_limit_time" value="<?php  echo $cs_theme_option['cache_limit_time'];  ?>"  class="{validate:{required:true}}"/>
            </li>
          </ul>
          
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Number of tweet','Faith')?></label>
            </li>
            <li class="to-field">
              <input type="hidden" name="tweet_num_post" value="" />
              <input type="text" id="tweet_num_post" name="tweet_num_post" value="<?php  if(isset($cs_theme_option['tweet_num_post'])){echo $cs_theme_option['tweet_num_post'];}  ?>"  class="{validate:{required:true}}"/>
            </li>
          </ul>
          
          <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Date Time Formate','Faith')?></label>
              </li>
              <li class="to-field">
                <select name="twitter_datetime_formate" class="dropdown" id="twitter_datetime_formate" onchange="javascript:home_breadcrumb_toggle(this.value)">
				<option <?php if(isset($cs_theme_option['twitter_datetime_formate'])&&$cs_theme_option['twitter_datetime_formate']=="default"){echo "selected";}?> value="default" ><?php _e('Displays November 06 2012','Faith')?></option>
				<option <?php if(isset($cs_theme_option['twitter_datetime_formate'])&& $cs_theme_option['twitter_datetime_formate']=="eng_suff"){echo "selected";}?> value="eng_suff" ><?php _e('Displays 6th November','Faith')?></option>
                <option <?php if(isset($cs_theme_option['twitter_datetime_formate'])&& $cs_theme_option['twitter_datetime_formate']=="ddmm"){echo "selected";}?> value="ddmm" ><?php _e('Displays 06 Nov','Faith')?></option>
                <option <?php if(isset($cs_theme_option['twitter_datetime_formate'])&& $cs_theme_option['twitter_datetime_formate']=="ddmmyy"){echo "selected";}?> value="ddmmyy" ><?php _e('Displays 06 Nov 2012','Faith')?></option>
                <option <?php if(isset($cs_theme_option['twitter_datetime_formate']) && $cs_theme_option['twitter_datetime_formate']=="full_date"){echo "selected";}?> value="full_date" ><?php _e('Displays Tues 06 Nov 2012','Faith')?></option>
                <option <?php if(isset($cs_theme_option['twitter_datetime_formate']) && $cs_theme_option['twitter_datetime_formate']=="time_since"){echo "selected";}?> value="time_since" ><?php _e('Displays in hours, minutes etc','Faith')?></option>
                </select>
              </li>
            </ul>
           <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Consumer Key','AidReform')?></label>
            </li>
            <li class="to-field">
              <input type="hidden" name="consumer_key" value="" />
              <input type="text" id="consumer_key" name="consumer_key" value="<?php  echo $cs_theme_option['consumer_key'];  ?>"  class="{validate:{required:true}}"/>
            </li>
          </ul>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Consumer Secret','AidReform')?></label>
            </li>
            <li class="to-field">
              <input type="hidden" name="consumer_secret" value="" />
              <input type="text" id="consumer_secret" name="consumer_secret" value="<?php echo $cs_theme_option['consumer_secret']; ?>" class="{validate:{required:true}}"/>
            </li>
          </ul>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Access Token','AidReform')?></label>
            </li>
            <li class="to-field">
              <input type="hidden" name="access_token" value="" />
              <input type="text" id="access_token" name="access_token" value="<?php echo $cs_theme_option['access_token']; ?>" class="{validate:{required:true}}"/>
            </li>
          </ul>
          <ul class="form-elements">
            <li class="to-label">
              <label><?php _e('Access Token Secret','AidReform')?></label>
            </li>
            <li class="to-field">
              <input type="hidden" name="access_token_secret" value="" />
              <input type="text" id="access_token_secret" name="access_token_secret" value="<?php echo $cs_theme_option['access_token_secret']; ?>" class="{validate:{required:true}}"/>
            </li>
          </ul>
           <input type="hidden" id="submit_btn" name="twitter_setting" class="botbtn" value="Generate Bearer Token"  />
        </div>
          <div id="tab-paypalapi-key" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Paypal API Setting','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Paypal API Setting','AidReform')?></h4>
              <p><?php _e('Paypal API Setting','AidReform')?></p>
            </div>
            <div class="opt-head">
              <h4><?php _e('Paypal API Setting','AidReform')?></h4>
              <div class="clear"></div>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Paypal Email','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" id="paypal_email" name="paypal_email" value="<?php  echo $cs_theme_option['paypal_email'];  ?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Paypal Ipn Url','AidReform')?></label>
              </li>
              <li class="to-field">
              	<?php $ipn_url = get_template_directory_uri().'/include/ipn.php' ?>
                <input type="text" id="paypal_ipn_url" name="paypal_ipn_url" value="<?php if(isset($cs_theme_option['paypal_ipn_url']) and $cs_theme_option['paypal_ipn_url'] != '') {echo $cs_theme_option['paypal_ipn_url']; } else { echo $ipn_url; } ?>"/>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Currency','AidReform')?></label>
              </li>
              <li class="to-field">
             <?php $currency_array = array('U.S. Dollar'=>'USD','Australian Dollar'=>'AUD','Brazilian Real'=>'BRL','Canadian Dollar'=>'CAD','Czech Koruna'=>'CZK','Danish Krone'=>'DKK','Euro'=>'EUR','Hong Kong Dollar'=>'HKD','Hungarian Forint'=>'HUF','Israeli New Sheqel'=>'ILS','Japanese Yen'=>'JPY','Malaysian Ringgit'=>'MYR','Mexican Peso'=>'MXN','Norwegian Krone'=>'NOK','New Zealand Dollar'=>'NZD','Philippine Peso'=>'PHP','Polish Zloty'=>'PLN','Pound Sterling'=>'GBP','Singapore Dollar'=>'SGD','Swedish Krona'=>'SEK','Swiss Franc'=>'CHF','Taiwan New Dollar'=>'TWD','Thai Baht'=>'THB','Turkish Lira'=>'TRY');?>
              <select name="paypal_currency">
              <?php foreach($currency_array as $key=>$val){?>
              	   <option value="<?php echo $val;?>" <?php if($cs_theme_option['paypal_currency'] == $val){echo ' selected="selected"';}?>><?php echo $key;?></option>
                <?php }?>
                </select>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Currency Sign','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" id="paypal_currency_sign" name="paypal_currency_sign" value="<?php if($cs_theme_option['paypal_currency_sign']==''){echo '$';} else { echo $cs_theme_option['paypal_currency_sign'];} ?>"/>
                <p><?php _e('Currency Sign','AidReform')?> eg: $, £</p>
              </li>
            </ul>
          </div>
          <div id="tab-mailchimp-key" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('MailChimp Setting','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('MailChimp Setting','AidReform')?></h4>
              <p><?php _e('MailChimp Setting','AidReform')?></p>
            </div>
            <div class="opt-head">
              <h4><?php _e('MailChimp Setting','AidReform')?></h4>
              <div class="clear"></div>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('MailChimp Key','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" id="mailchimp_key" name="mailchimp_key" value="<?php  echo $cs_theme_option['mailchimp_key'];  ?>" />
                <p><?php echo __('Enter a valid MailChimp API key here to get started. Once you\'ve done that, you can use the MailChimp Widget from the Widgets menu. You will need to have at least MailChimp list set up before the using the widget.', 'AidReform'). __(' You can get your mailchimp activation key', 'AidReform') . ' <u><a href="' . get_admin_url() . 'https://login.mailchimp.com/">' . __('here', 'AidReform') . '</a></u>' ?> 				
			</p>
              </li>
            </ul>
          </div>
          <!-- API Settings end -->
          <div id="tab-slider" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Home Page Slider','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Home Page Slider','AidReform')?></h4>
              <p><?php _e('Edit home page slider settings','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Show Slider','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="hidden" name="show_slider" value="" />
                <input type="checkbox" class="myClass" name="show_slider" <?php if($cs_theme_option['show_slider']=="on") echo "checked" ?> />
                <p><?php _e('Switch it on if you want to show slider at home page. If you switch it off it will not show slider at home page','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Choose Slider Type','AidReform')?></label>
              </li>
              <li class="to-field">
                <select name="slider_type" class="dropdown" onchange="javascript:home_slider_toggle(this.value)">
                  <option <?php if($cs_theme_option['slider_type']=="Flex Slider"){echo "selected";}?> ><?php _e('Flex Slider','AidReform')?></option>
                  <option <?php if($cs_theme_option['slider_type']=="Revolution Slider"){echo "selected";}?> ><?php _e('Revolution Slider','AidReform')?></option>
                </select>
              </li>
            </ul>
            <ul class="form-elements" id="other_sliders" style=" <?php if($cs_theme_option['slider_type']=="" or $cs_theme_option['slider_type']=="Revolution Slider")echo "display:none"; else "display:inline"; ?>">
              <li class="to-label">
                <label><?php _e('Select Slider','AidReform')?></label>
              </li>
              <li class="to-field">
                <select name="slider_name" class="dropdown">
                  <option value=""><?php _e('-- Select Slider --','AidReform')?></option>
                  <?php
				  query_posts("posts_per_page=-1&post_type=cs_slider");
				  while ( have_posts()) : the_post();
				  ?>
                      <option <?php if($post->post_name==$cs_theme_option['slider_name'])echo "selected";?> value="<?php echo $post->post_name; ?>">
                      <?php the_title()?>
                      </option>
                  <?php
				  endwhile;
				  ?>
                </select>
                <p><?php _e('Slider images resolution should be (1280 x 574). Create new Slider from ','AidReform')?><a style="color:#06F; text-decoration:underline;" href="<?php echo get_site_url(); ?>/wp-admin/post-new.php?post_type=cs_slider"><?php _e('here','AidReform')?></a></p>
              </li>
            </ul>
            <ul class="form-elements" id="layer_slider" style=" <?php if($cs_theme_option['slider_type'] =="" or $cs_theme_option['slider_type'] <> "Revolution Slider")echo "display:none"; else "display:inline"; ?>" >
              <li class="to-label">
                <label><?php _e('Revolution Slider Short Code','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="slider_id" class="txtfield" value="<?php echo $cs_theme_option['slider_id'];?>" />
               <p><?php _e('Please enter the Revolution Slider Short Code like [rev_slider rocky]','AidReform')?></p>
              </li>
            </ul>
          </div>
          <div id="tab-Announcement" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Home Page Announcement','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Home Page Announcement','AidReform')?></h4>
              <p><?php _e('Edit home page Announcement settings','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Announcement Title','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="announcement_title" size="5" value="<?php echo $cs_theme_option['announcement_title']?>" />
                <p><?php _e('Enter Announcements Title','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Choose Announcements Category','AidReform')?></label>
              </li>
              <li class="to-field">
                <select name="announcement_blog_category" class="dropdown">
					<option value="0"><?php _e('-- Select Category --','AidReform')?></option>
					<?php show_all_cats('', '', $cs_theme_option['announcement_blog_category'], "category");?>
                </select>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Show no of posts','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="announcement_no_posts" size="5" value="<?php echo $cs_theme_option['announcement_no_posts']?>" />
                <p><?php _e('Enter no of announcements to show','AidReform')?></p>
              </li>
            </ul>
          </div>
          <div id="tab-manage-sidebars" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Manage Sidebars','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Manage Sidebars','AidReform')?></h4>
              <p><?php _e('Manage Sidebars','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Sidebar Name','AidReform')?></label>
              </li>
              <li class="to-field">
                <input class="small" type="text" name="sidebar_input" id="sidebar_input" style="width:420px;" />
                <input type="button" value="<?php _e('Add Sidebar','AidReform')?>" onclick="javascript:add_sidebar()" />
                <p><?php _e('Please enter the desired title of sidebar','AidReform')?></p>
              </li>
            </ul>
            <div class="opt-head">
              <h4><?php _e('Already Added Sidebars','AidReform')?></h4>
              <div class="clear"></div>
            </div>
            <div class="boxes">
              <table class="to-table" border="0" cellspacing="0">
                <thead>
                  <tr>
                    <th><?php _e('Sider Bar Name','AidReform')?></th>
                    <th class="centr"><?php _e('Actions','AidReform')?></th>
                  </tr>
                </thead>
                <tbody id="sidebar_area">
                  <?php
					if ( isset($cs_theme_option['sidebar']) and is_array($cs_theme_option['sidebar'])) {
						$cs_counter_sidebar = rand(10000,20000);
						foreach ( $cs_theme_option['sidebar'] as $sidebar ){
							$cs_counter_sidebar++;
							
							echo '<tr id="'.$cs_counter_sidebar.'">';
								echo '<td><input type="hidden" name="sidebar[]" value="'.$sidebar.'" />'.$sidebar.'</td>';
								echo '<td class="centr"> <a onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:cs_div_remove('.$cs_counter_sidebar.')">Del</a> </td>';
							echo '</tr>';
						}
					}
					?>
                </tbody>
              </table>
            </div>
          </div>
          <div id="tab-flex-slider" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Flex Slider','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Flex Slider Options','AidReform')?></h4>
              <p><?php _e('Configure Flex Slider setting','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Effects','AidReform')?></label>
              </li>
              <li class="to-field">
                <select class="dropdown" name="flex_effect">
                  <option <?php if($cs_theme_option['flex_effect']=="fade"){echo "selected";}?> value="fade" ><?php _e('Fade','AidReform')?></option>
                  <option <?php if($cs_theme_option['flex_effect']=="slide"){echo "selected";}?> value="slide" ><?php _e('Slide','AidReform')?></option>
                </select>
                <p><?php _e('Please select Effect for flex Slider','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Auto Play','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="hidden" name="flex_auto_play" value="" />
                <input type="checkbox" name="flex_auto_play" <?php if ( $cs_theme_option['flex_auto_play'] == "on" ){ echo "checked";}?> class="myClass" />
                <p><?php _e('If true, the slideshow will start running on page load','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Animation Speed','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="flex_animation_speed" size="5" class="{validate:{required:true}} bar" value="<?php echo $cs_theme_option['flex_animation_speed']?>" />
                <p><?php _e('How long the slideshow transition takes (in milliseconds)','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Pause Time','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="flex_pause_time" size="5" class="{validate:{required:true}} bar" value="<?php echo $cs_theme_option['flex_pause_time']?>" />
                <p><?php _e('Resume slideshow after user interaction (in milliseconds)','AidReform')?></p>
              </li>
            </ul>
          </div>
          <div id="tab-social-network" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Social Settings','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Social Network','AidReform')?></h4>
              <p><?php _e('Edit Social Network','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Section Title','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="social_net_title" value="<?php echo $cs_theme_option['social_net_title']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Icon Path','AidReform')?></label>
              </li>
              <li class="to-field">
                <input id="social_net_icon_path_input" type="text" class="small" onblur="javascript:update_image('social_net_icon_path_input_img_div')" />
                <input id="social_net_icon_path_input" name="social_net_icon_path_input" type="button" class="uploadfile left" value="<?php _e('Browse','AidReform')?>"/>
              </li>
              <li class="full">&nbsp;</li>
              <li class="to-label">
                <label><?php _e('Awesome Font','AidReform')?></label>
              </li>
              <li class="to-field">
                <input class="small" type="text" id="social_net_awesome_input" style="width:420px;" />
                <p><?php _e('Put Awesome Font Code like "icon-facebook".','AidReform')?></p>
              </li>
              
              <li class="full">&nbsp;</li>
              <li class="to-label">
                <label><?php _e('Url','AidReform')?></label>
              </li>
              <li class="to-field">
                <input class="small" type="text" id="social_net_url_input" style="width:420px;" />
                <p><?php _e('Please Enter Full Url','AidReform')?></p>
              </li>
              <li class="full">&nbsp;</li>
              <li class="to-label">
                <label><?php _e('Title','AidReform')?></label>
              </li>
              <li class="to-field">
                <input class="small" type="text" id="social_net_tooltip_input" style="width:420px;" />
                <p><?php _e('Please enter text for icon tooltip','AidReform')?></p>
              </li>
              <li class="full">&nbsp;</li>
              <li class="to-label"></li>
              <li class="to-field">
                <input type="button" value="<?php _e('Add','AidReform')?>" onclick="javascript:cs_add_social_icon('<?php echo admin_url('admin-ajax.php');?>')" />
              </li>
            </ul>
            <div class="opt-head">
              <h4><?php _e('Already Added Items','AidReform')?></h4>
              <div class="clear"></div>
            </div>
            <div class="boxes">
              <table class="to-table" border="0" cellspacing="0">
                <thead>
                  <tr>
                    <th><?php _e('Icon Path','AidReform')?></th>
                    <th><?php _e('Url','AidReform')?></th>
                    <th class="centr"><?php _e('Actions','AidReform')?></th>
                  </tr>
                </thead>
                <tbody id="social_network_area">
                  <?php
					if ( isset($cs_theme_option['social_net_url']) and is_array($cs_theme_option['social_net_url'])) {
						wp_enqueue_style('font-awesome_css', get_template_directory_uri() . '/css/font-awesome.css');
						// Register stylesheet
						wp_register_style( 'font-awesome-ie7_css', get_template_directory_uri() . '/css/font-awesome-ie7.css' );
						// Apply IE conditionals
						$GLOBALS['wp_styles']->add_data( 'font-awesome-ie7_css', 'conditional', 'lte IE 9' );
						// Enqueue stylesheet
						wp_enqueue_style( 'font-awesome-ie7_css' );
						$cs_counter_social_network = rand(10000,20000);
						$i = 0;
						//print_r($cs_theme_option['social_net_url']);
						foreach ( $cs_theme_option['social_net_url'] as $val ){
							//print_r($cs_theme_option['social_net_color_input'][$i]);
							$cs_counter_social_network++;
							echo '<tr id="del_'.$cs_counter_social_network.'">';
								if(isset($cs_theme_option['social_net_awesome'][$i]) && $cs_theme_option['social_net_awesome'][$i] <> ''){
									echo '<td><i class="fa '.$cs_theme_option['social_net_awesome'][$i].' fa-2x"></td>';
								} else {
									echo '<td><img width="50" src="'.$cs_theme_option['social_net_icon_path'][$i].'"></td>';
								}
								echo '<td>'.$val.'</td>';
								echo '<td class="centr"> 
											<a onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del('.$cs_counter_social_network.')">Del</a>
											| <a href="javascript:cs_toggle('.$cs_counter_social_network.')">Edit</a>
										</td>';
							echo '</tr>';
							?>
                  <tr id="<?php echo $cs_counter_social_network;?>" style="display:none">
                    <td colspan="3"><ul class="form-elements">
                        <li class="to-label">
                          <label><?php _e('Icon Path','AidReform')?></label>
                        </li>
                        <li class="to-field">
                          <input id="social_net_icon_path<?php echo $cs_counter_social_network?>" name="social_net_icon_path[]" value="<?php echo $cs_theme_option['social_net_icon_path'][$i]?>" type="text" class="small" />
                        </li>
                        <li><a onclick="cs_toggle('<?php echo $cs_counter_social_network?>')"><img src="<?php echo get_template_directory_uri()?>/images/admin/close-red.png" /></a></li>
                        <li class="full">&nbsp;</li>
                        <li class="to-label">
                          <label><?php _e('Awesome Font','AidReform')?></label>
                        </li>
                        <li class="to-field">
                          <input class="small" type="text" id="social_net_awesome" name="social_net_awesome[]" value="<?php echo $cs_theme_option['social_net_awesome'][$i]?>" style="width:420px;" />
                          <p><?php _e('Put Awesome Font Code like "icon-flag".','AidReform')?></p>
                        </li>
                        <li class="full">&nbsp;</li>
                        <li class="to-label">
                          <label><?php _e('Url','AidReform')?></label>
                        </li>
                        <li class="to-field">
                          <input class="small" type="text" id="social_net_url" name="social_net_url[]" value="<?php echo $val?>" style="width:420px;" />
                          <p><?php _e('Please Enter Full Url','AidReform')?></p>
                        </li>
                        <li class="full">&nbsp;</li>
                        <li class="to-label">
                          <label><?php _e('Title','AidReform')?></label>
                        </li>
                        <li class="to-field">
                          <input class="small" type="text" id="social_net_tooltip" name="social_net_tooltip[]" value="<?php echo $cs_theme_option['social_net_tooltip'][$i]?>" style="width:420px;" />
                          <p><?php _e('Please enter text for icon tooltip','AidReform')?></p>
                        </li>
                      </ul></td>
                  </tr>
                  <?php
							$i++;
						}
					}
				?>
                </tbody>
              </table>
            </div>
          </div>
          <div id="tab-social-sharing" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Social Settings','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Social Network / Sharing','AidReform')?></h4>
              <p><?php _e('Edit Social Network / Sharing','AidReform')?></p>
            </div>
            <div class="social-head">
              <ul>
                <li><?php _e('Social Sharing','AidReform')?></li>
              </ul>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Facebook','AidReform')?></label>
              </li>
              <li class="to-field social-share">
                <input type="hidden" name="facebook_share" value="" />
                <input type="checkbox" class="myClass" name="facebook_share" <?php if($cs_theme_option['facebook_share']=="on") echo "checked" ?> />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Twitter','AidReform')?></label>
              </li>
              <li class="to-field social-share">
                <input type="hidden" name="twitter_share" value="" />
                <input type="checkbox" class="myClass" name="twitter_share" <?php if($cs_theme_option['twitter_share']=="on") echo "checked" ?> />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Linkedin','AidReform')?></label>
              </li>
              <li class="to-field social-share">
                <input type="hidden" name="linkedin_share" value="" />
                <input type="checkbox" class="myClass" name="linkedin_share" <?php if($cs_theme_option['linkedin_share']=="on") echo "checked" ?> />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Pinterest','AidReform')?></label>
              </li>
              <li class="to-field social-share">
                <input type="hidden" name="pinterest_share" value="" />
                <input type="checkbox" class="myClass" name="pinterest_share" <?php if($cs_theme_option['pinterest_share']=="on") echo "checked" ?> />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Tumblr','AidReform')?></label>
              </li>
              <li class="to-field social-share">
                <input type="hidden" name="tumblr_share" value="" />
                <input type="checkbox" class="myClass" name="tumblr_share" <?php if($cs_theme_option['tumblr_share']=="on") echo "checked" ?> />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Google+','AidReform')?></label>
              </li>
              <li class="to-field social-share">
                <input type="hidden" name="google_plus_share" value="" />
                <input type="checkbox" class="myClass" name="google_plus_share" <?php if($cs_theme_option['google_plus_share']=="on") echo "checked" ?> />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Others','AidReform')?></label>
              </li>
              <li class="to-field social-share">
                <input type="hidden" name="cs_other_share" value="" />
                <input type="checkbox" class="myClass" name="cs_other_share" <?php if($cs_theme_option['cs_other_share']=="on") echo "checked" ?> />
              </li>
            </ul>
          </div>
          <div id="tab-default-pages" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Default Pages','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Default Pages Settings','AidReform')?></h4>
              <p><?php _e('Manage Default Pages (Archive, Search, Categories, Tags and Author Pages)','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Pagination','AidReform')?></label>
              </li>
              <li class="to-field">
                <select name="pagination" class="dropdown" onchange="cs_toggle('record_per_page')">
                  <option <?php if($cs_theme_option['pagination']=="Show Pagination")echo "selected";?> ><?php _e('Show Pagination','AidReform')?></option>
                  <option <?php if($cs_theme_option['pagination']=="Single Page")echo "selected";?> ><?php _e('Single Page','AidReform')?></option>
                </select>
              </li>
            </ul>
            <?php
										global $cs_xmlObject , $cs_theme_option;
										$cs_xmlObject = new stdClass();
										$cs_xmlObject->sidebar_layout = new stdClass();
										$cs_xmlObject->sidebar_layout->cs_layout = $cs_theme_option['cs_layout'];
										//$cs_xmlObject->sidebar_layout->cs_layout = isset($cs_theme_option['cs_layout']) ? $cs_theme_option['cs_layout'] : '';
										
										$cs_xmlObject->sidebar_layout->cs_sidebar_left = $cs_theme_option['cs_sidebar_left'];
										$cs_xmlObject->sidebar_layout->cs_sidebar_right = $cs_theme_option['cs_sidebar_right'];
										if ( $cs_theme_option['cs_layout'] == "none" ) {
											$cs_xmlObject->sidebar_layout->cs_sidebar_left = '';
											$cs_xmlObject->sidebar_layout->cs_sidebar_right = '';
										}
										else if ( $cs_theme_option['cs_layout'] == "left" ) {
											$cs_xmlObject->sidebar_layout->cs_sidebar_right = '';
										}
										else if ( $cs_theme_option['cs_layout'] == "right" ) {
											$cs_xmlObject->sidebar_layout->cs_sidebar_left = '';
										}
										meta_layout();
										?>
          </div>
          <div id="tab-upload-languages" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Upload New Language','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Upload New Language','AidReform')?></h4>
              <p><?php _e('Upload New Language','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Upload Language (MO File)','AidReform')?></label>
              </li>
              <li class="to-field">
                <div class="fileinputs">
                  <input type="file" class="file" size="78" name="mofile" id="mofile" />
                  <div class="fakefile">
                    <input type="text" />
                    <button><?php _e('Browse','AidReform')?></button>
                  </div>
                </div>
                <p><?php _e('Please upload new language file (MO format only). It will be uploaded in your themes languages folder','AidReform')?> </p>
                <p><?php _e('Download MO files from','AidReform')?> <a target="_blank" href="http://translate.wordpress.org/projects/wp/">http://translate.wordpress.org/projects/wp/</a> </p>
                <p>
                  <button type="button" id="upload_btn"><?php _e('Upload Files','AidReform')?></button>
                </p>
              </li>
            </ul>
            <ul id="image-list">
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Already Uploaded Languages','AidReform')?></label>
              </li>
              <li class="to-field"> <strong>
                <?php
					$cs_counter = 0;
					foreach (glob(get_template_directory()."/languages/*.mo") as $filename) {
						$cs_counter++;
						$val = str_replace(get_template_directory()."/languages/","",$filename);
						echo "<p>".$cs_counter . ". " . str_replace(".mo","",$val)."</p>";
					}
				?>
                </strong>
                <p><?php _e('Please copy the language name, open config.php file, find WPLANG constant and set its value by replacing the language name','AidReform')?> </p>
              </li>
            </ul>
          </div>
          <div id="tab-upload-languages" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Manage Languages','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Upload Languages','AidReform')?></h4>
              <p><?php _e('Upload new language','AidReform')?></p>
            </div>
          </div>
          <div id="tab-event-translation" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Events Translation','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Events Translation','AidReform')?></h4>
              <p><?php _e('Events Translation','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Location','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_event_location" value="<?php echo $cs_theme_option['trans_event_location']?>" />
              </li>
            </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Photo','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_event_pics" value="<?php echo $cs_theme_option['trans_event_pics']?>" />
              </li>
            </ul>
            
             <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Days','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_event_days" value="<?php echo $cs_theme_option['trans_event_days']?>" />
              </li>
            </ul>
            
             <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Hours','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_event_hours" value="<?php echo $cs_theme_option['trans_event_hours']?>" />
              </li>
            </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Minutes','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_event_minutes" value="<?php echo $cs_theme_option['trans_event_minutes']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Seconds','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_event_secondes" value="<?php echo $cs_theme_option['trans_event_secondes']?>" />
              </li>
            </ul>
            
            
            
          </div>
          <div id="tab-contact-translation" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Contact Translation','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Contact Translation','AidReform')?></h4>
              <p><?php _e('Contact Translation','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('First Name','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="res_first_name" value="<?php echo $cs_theme_option['res_first_name']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Last Name','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="res_last_name" value="<?php echo $cs_theme_option['res_last_name']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Subject','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_subject" value="<?php echo $cs_theme_option['trans_subject']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Message','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_message" value="<?php echo $cs_theme_option['trans_message']?>" />
              </li>
            </ul>
             <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Submit','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_submit" value="<?php echo isset($cs_theme_option['trans_submit'])?$cs_theme_option['trans_submit']:'';?>" />
              </li>
            </ul>
            
            
          </div>
          <div id="tab-cause-translation" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Cause Translation','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Cause Translation','AidReform')?></h4>
              <p><?php _e('Cause Translation','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Raised','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="cause_raised" value="<?php echo $cs_theme_option['cause_raised']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('End Date','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="cause_end_date" value="<?php echo $cs_theme_option['cause_end_date']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Goal','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="cause_goal" value="<?php echo $cs_theme_option['cause_goal']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Goal Complete Status','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="cause_status" value="<?php echo $cs_theme_option['cause_status']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Donors','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="cause_donors" value="<?php echo $cs_theme_option['cause_donors']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Donation','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="cause_donation" value="<?php echo $cs_theme_option['cause_donation']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Donate Now','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="cause_donate" value="<?php echo $cs_theme_option['cause_donate']?>" />
              </li>
            </ul>
          </div>
          <div id="tab-other-translation" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Other Translation','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Other Translation','AidReform')?></h4>
              <p><?php _e('Other Translation','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('404 Content','AidReform')?></label>
              </li>
              <li class="to-field">
                <textarea name="trans_content_404"><?php echo $cs_theme_option['trans_content_404']?></textarea>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Share Now','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_share_this_post" value="<?php echo $cs_theme_option['trans_share_this_post']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Featured','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_featured" value="<?php echo $cs_theme_option['trans_featured']?>" />
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Read More','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_read_more" value="<?php echo $cs_theme_option['trans_read_more']?>" />
              </li>
            </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Follow Us','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_follow_us" value="<?php echo $cs_theme_option['trans_follow_us']?>" />
              </li>
            </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Buy Now','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="text" name="trans_buy_now" value="<?php echo $cs_theme_option['trans_buy_now']?>" />
              </li>
            </ul>
          </div>
          
          <!-- import export Start -->
          <div id="tab-import-export" style="display:none;">
            <div class="theme-header">
              <h1><?php _e('Theme Options Backup and restore settings','AidReform')?></h1>
            </div>
            <div class="theme-help">
              <h4><?php _e('Theme Options Backup and restore settings','AidReform')?></h4>
              <p><?php _e('Theme Options backup, restore backup, restore default and import / export current settings','AidReform')?></p>
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Restore Default Options','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="button" value="<?php _e('Restore Default','AidReform')?>" onclick="cs_to_restore_default('<?php echo admin_url('admin-ajax.php'); ?>', '<?php echo get_template_directory_uri()?>')" />
                <p><?php _e('You current theme options will be replaced with the default theme activation options','AidReform')?></p>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Last Backup Taken on','AidReform')?></label>
              </li>
              <li class="to-field"> <strong><span id="last_backup_taken">
                <?php 
						if ( get_option('cs_theme_option_backup_time') ) {
							echo get_option('cs_theme_option_backup_time');
						}
						else { echo "Not Taken Yet"; }
					?>
                </span></strong> </li>
              <li class="full">&nbsp;</li>
              <li class="to-label">
                <label><?php _e('Take Backup','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="button" value="<?php _e('Take Backup','AidReform')?>" onclick="cs_to_backup('<?php echo admin_url('admin-ajax.php'); ?>', '<?php echo get_template_directory_uri()?>')" />
                <p><?php _e('Take the Backup of your current theme options, it will replace the old backup if you have already taken','AidReform')?></p>
              </li>
              <li class="full">&nbsp;</li>
              <li class="to-label">
                <label><?php _e('Restore Backup','AidReform')?></label>
              </li>
              <li class="to-field">
                <input type="button" value="<?php _e('Restore Backup','AidReform')?>" onclick="cs_to_backup_restore('<?php echo admin_url('admin-ajax.php'); ?>', '<?php echo get_template_directory_uri()?>')" />
                <p><?php _e('Restore your last backup taken (It will be replaced on your current theme options)','AidReform')?></p>
              </li>
            </ul>
          </div>
          <!-- import / export end --> 
          
        </div>
        <div class="clear"></div>
        <!-- Right Column End --> 
      </div>
      <div class="footer">
        <input type="submit" id="submit_btn" name="submit_btn" class="botbtn" value="<?php _e('Save All Settings','AidReform')?>" />
        <input type="hidden" name="action" value="theme_option_save" />
      </div>
    </div>
  </div>
</form>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/select.js"></script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/functions.js"></script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/jquery.validate.metadata.js"></script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/jquery.validate.js"></script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/ddaccordion.js"></script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/prettyCheckable.js"></script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scripts/admin/jquery.timepicker.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/admin/jquery.ui.datepicker.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/admin/jquery.ui.datepicker.theme.css">
<script type="text/javascript">
        jQuery(document).ready(function($){
            $('.bg_color').wpColorPicker(); 
        });
		 function load_default_settings(id) {
           jQuery("#" + id + " input.button.wp-picker-default").trigger('click');
           jQuery("#" + id + " input[type='checkbox'].myClass").each(function(index) {
             var da = jQuery(this).data('default-header');
             var ch = jQuery(this).next().hasClass("checked")
             if ((da == 'on') && (!ch)) {
               jQuery(this).next().trigger('click');
             }
             if ((da == 'off') && (ch)) {
               jQuery(this).next().trigger('click');
             }
           });
           jQuery("#" + id + " input[type='text'].vsmall").each(function(index) {
             var da = jQuery(this).data('default-header');
             jQuery(this).val(da);

           });
           jQuery("#" + id + " .to-field input.small").each(function(index) {
             var da = jQuery(this).data('default-header');
             jQuery(this).val(da);
             jQuery(this).parent().find(".thumb-preview").find('img').attr("src", da)
           });
           jQuery("#" + id + " textarea").each(function(index) {
             var da = jQuery(this).data('default-header');
             jQuery(this).val(da);

           });
           jQuery("#" + id + " select").each(function(index) {

             var da = jQuery(this).data('default-header');
             jQuery(this).find("option[value='" + da + "']").attr("selected", "selected");

           });

         }
    </script> 
<script type="text/javascript">
		jQuery(function($) {
			$( "#launch_date" ).datepicker({
            	defaultDate: "+1w",
				dateFormat: "yy-mm-dd",
                changeMonth: true,
                numberOfMonths: 1,
                onSelect: function( selectedDate ) {
                	$( "#launch_date" ).datepicker( "option", "minDate", selectedDate );
                }
            });
		});
		  function toggleDiv(id)
  {
   jQuery('.col2').children().hide();
   jQuery(id).show();
            location.hash = id+"-show";
            var link = id.replace('#', '');
            jQuery('.categoryitems li').removeClass('active');
            jQuery(".menuheader.expandable") .removeClass('openheader');
            jQuery(".categoryitems").hide();
            jQuery("."+link).addClass('active');
            jQuery("."+link) .parent("ul").show().prev().addClass("openheader");
      
  }
        jQuery(document).ready(function() {
                jQuery(".categoryitems").hide();
                jQuery(".categoryitems:first").show();
                jQuery(".menuheader:first").addClass("openheader");
                jQuery(".menuheader").live('click', function(event) {
                    if (jQuery(this).hasClass('openheader')){
                        jQuery(".menuheader").removeClass("openheader");
                        jQuery(this).next().slideUp(200);
                        return false;
                    }
                    jQuery(".menuheader").removeClass("openheader");
                    jQuery(this).addClass("openheader");
                    jQuery(".categoryitems").slideUp(200);
                    jQuery(this).next().slideDown(200); 
                    return false;
             });
            var hash = window.location.hash.substring(1);
            var id = hash.split("-show")[0];
            if (id){
                jQuery('.col2').children().hide();
                jQuery("#"+id).show();
                jQuery('.categoryitems li').removeClass('active');
                jQuery(".menuheader.expandable") .removeClass('openheader');
                jQuery(".categoryitems").hide();
                jQuery("."+id).addClass('active');
                jQuery("."+id) .parent("ul").slideDown(300).prev().addClass("openheader");

           } 
        });

        var counter_sidebar = 0;
        function add_sidebar(){
            counter_sidebar++;
            var sidebar_input = jQuery("#sidebar_input").val();
            if ( sidebar_input != "" ) {
                jQuery("#sidebar_area").append('<tr id="'+counter_sidebar+'"> \
                            <td><input type="hidden" name="sidebar[]" value="'+sidebar_input+'" />'+sidebar_input+'</td> \
                            <td class="centr"> <a onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:cs_div_remove('+counter_sidebar+')">Del</a> </td> \
                        </tr>');
                jQuery("#sidebar_input").val("");
            }
        }
		jQuery().ready(function($) {
			var container = $('div.container');
			// validate the form when it is submitted
			var validator = $("#frm").validate({
				errorContainer: container,
				errorLabelContainer: $(container),
				errorElement:'span',
				errorClass:'ele-error',				
				meta: "validate"
			});
		});
        jQuery(document).ready( function($) {
            var consoleTimeout;
            $('.minicolors').each( function() {
                $(this).minicolors({
                    change: function(hex, opacity) {
                        // Generate text to show in console
                        text = hex ? hex : 'transparent';
                        if( opacity ) text += ', ' + opacity;
                        text += ' / ' + $(this).minicolors('rgbaString');
                    }
                });
            });
        });
		(function () {
			var input = document.getElementById("mofile")
			var upload_btn = document.getElementById("upload_btn"), 
			formdata = false;
			if (window.FormData) {
				formdata = new FormData();
			}
			upload_btn.addEventListener("click", function (evt) {
				var i = 0, len = input.files.length, txt, reader, file;
			
				for ( ; i < len; i++ ) {
					file = input.files[i];
						if (formdata) {
							formdata.append("mofile[]", file);
						}
				}
				if (formdata) {
					jQuery.ajax({
						url: '<?php echo get_template_directory_uri()?>/include/lang_upload.php',
						type: "POST",
						data: formdata,
						processData: false,
						contentType: false,
						success: function (res) {
							jQuery("#mofile").val("");
		                    jQuery(".form-msg").show();
							jQuery(".form-msg").html(res);
						}
					});
				}
			}, false);
		}());
    </script>
<?php }?>
