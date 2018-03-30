<?php  
add_action('admin_menu', 'create_duotive_menu');  
function create_duotive_menu() {  
	add_menu_page('Duotive Option Panel', 'Duotive', 'manage_options', 'duotive-panel', 'duotivesettings', get_template_directory_uri().'/includes/duotive-admin/ico.png','64');
}  
function general_settings_update()
{
	update_option('dt_FontFamily',$_POST['dt_FontFamily']);
	update_option('dt_MainTheme',$_POST['dt_MainTheme']);
	update_option('dt_primaryColor',$_POST['dt_primaryColor']);
	update_option('dt_secondayColor',$_POST['dt_secondayColor']);
	update_option('dt_favicon',$_POST['dt_favicon']);
	update_option('dt_CropLocation',$_POST['dt_CropLocation']);
	update_option('dt_FullWidthLoader',$_POST['dt_FullWidthLoader']);
	update_option('dt_ThemeSwitcher',$_POST['dt_ThemeSwitcher']);				
}
function background_settings_update() {
	update_option('dt_generalBackgroundColor',$_POST['dt_generalBackgroundColor']);	
	update_option('dt_predefinedBackground',$_POST['dt_predefinedBackground']);		
	update_option('dt_generalBackground',$_POST['dt_generalBackground']);
	update_option('dt_generalBackgroundPosition',$_POST['dt_generalBackgroundPosition']);
	update_option('dt_generalBackgroundRepeat',$_POST['dt_generalBackgroundRepeat']);		
}
function header_settings_update()
{
	update_option('dt_headerSharing',$_POST['dt_headerSharing']);
	update_option('dt_headerHome',$_POST['dt_headerHome']);	
	update_option('dt_HeaderSharingDeviantart',$_POST['dt_HeaderSharingDeviantart']);
	update_option('dt_HeaderSharingFacebook',$_POST['dt_HeaderSharingFacebook']);
	update_option('dt_HeaderSharingFlickr',$_POST['dt_HeaderSharingFlickr']);
	update_option('dt_HeaderSharingMyspace',$_POST['dt_HeaderSharingMyspace']);
	update_option('dt_HeaderSharingRss',$_POST['dt_HeaderSharingRss']);
	update_option('dt_HeaderSharingTwitter',$_POST['dt_HeaderSharingTwitter']);
	update_option('dt_HeaderSharingVimeo',$_POST['dt_HeaderSharingVimeo']);
	update_option('dt_HeaderSharingYoutube',$_POST['dt_HeaderSharingYoutube']);
	update_option('dt_HeaderSharingReddit',$_POST['dt_HeaderSharingReddit']);
	update_option('dt_HeaderSharingStumbleUpon',$_POST['dt_HeaderSharingStumbleUpon']);
	update_option('dt_HeaderSharingSoundCloud',$_POST['dt_HeaderSharingSoundCloud']);
	update_option('dt_HeaderSharingGooglePlus',$_POST['dt_HeaderSharingGooglePlus']);
	update_option('dt_HeaderSharingLinkedIn',$_POST['dt_HeaderSharingLinkedIn']);
	update_option('dt_HeaderSharingDelicious',$_POST['dt_HeaderSharingDelicious']);
	update_option('dt_HeaderSharingDigg',$_POST['dt_HeaderSharingDigg']);
	update_option('dt_HeaderSharingTechnorati',$_POST['dt_HeaderSharingTechnorati']);
	update_option('dt_HeaderSharingSkype',$_POST['dt_HeaderSharingSkype']);
	update_option('dt_HeaderSharingBlogger',$_POST['dt_HeaderSharingBlogger']);
	update_option('dt_HeaderSharingPicasa',$_POST['dt_HeaderSharingPicasa']);
	update_option('dt_HeaderSharingDribble',$_POST['dt_HeaderSharingDribble']);
	update_option('dt_HeaderSharingModelMayhem',$_POST['dt_HeaderSharingModelMayhem']);
	update_option('dt_headerSearch',$_POST['dt_headerSearch']);
	update_option('dt_headerLogo',$_POST['dt_headerLogo']);
	update_option('dt_headerLogovertical',$_POST['dt_headerLogovertical']);
	update_option('dt_headerLogohorizontal',$_POST['dt_headerLogohorizontal']);	
}
function footer_settings_update()
{
	update_option('dt_FooterSharing',$_POST['dt_FooterSharing']);
	update_option('dt_FooterSharingHeading',$_POST['dt_FooterSharingHeading']);
	update_option('dt_FooterSharingDeviantart',$_POST['dt_FooterSharingDeviantart']);
	update_option('dt_FooterSharingFacebook',$_POST['dt_FooterSharingFacebook']);
	update_option('dt_FooterSharingFlickr',$_POST['dt_FooterSharingFlickr']);
	update_option('dt_FooterSharingMyspace',$_POST['dt_FooterSharingMyspace']);
	update_option('dt_FooterSharingRss',$_POST['dt_FooterSharingRss']);
	update_option('dt_FooterSharingTwitter',$_POST['dt_FooterSharingTwitter']);
	update_option('dt_FooterSharingVimeo',$_POST['dt_FooterSharingVimeo']);
	update_option('dt_FooterSharingYoutube',$_POST['dt_FooterSharingYoutube']);
	update_option('dt_FooterSharingReddit',$_POST['dt_FooterSharingReddit']);
	update_option('dt_FooterSharingStumbleUpon',$_POST['dt_FooterSharingReddit']);
	update_option('dt_FooterSharingSoundCloud',$_POST['dt_FooterSharingSoundCloud']);
	update_option('dt_FooterSharingGooglePlus',$_POST['dt_FooterSharingGooglePlus']);
	update_option('dt_FooterSharingLinkedIn',$_POST['dt_FooterSharingLinkedIn']);
	update_option('dt_FooterSharingDelicious',$_POST['dt_FooterSharingDelicious']);
	update_option('dt_FooterSharingDigg',$_POST['dt_FooterSharingDigg']);
	update_option('dt_FooterSharingTechnorati',$_POST['dt_FooterSharingTechnorati']);
	update_option('dt_FooterSharingSkype',$_POST['dt_FooterSharingSkype']);
	update_option('dt_FooterSharingBlogger',$_POST['dt_FooterSharingBlogger']);
	update_option('dt_FooterSharingPicasa',$_POST['dt_FooterSharingPicasa']);
	update_option('dt_FooterSharingDribble',$_POST['dt_FooterSharingDribble']);
	update_option('dt_FooterSharingModelMayhem',$_POST['dt_FooterSharingModelMayhem']);
	update_option('dt_Footer',$_POST['dt_Footer']);
	update_option('dt_FooterTabs',$_POST['dt_FooterTabs']);		
	update_option('dt_SubFooter',$_POST['dt_SubFooter']);
	update_option('dt_FooterLogo',$_POST['dt_FooterLogo']);	
	update_option('dt_Copyright',stripslashes($_POST['dt_Copyright']));		
}
function advanced_settings_update() {
	update_option('customcss',stripslashes($_POST['customcss']));
	update_option('google_analytics',stripslashes($_POST['google_analytics']));		
}
function single_settings_update() {
	update_option('dt_SinglePostSidebar',$_POST['dt_SinglePostSidebar']);
	update_option('dt_SinglePostImage',$_POST['dt_SinglePostImage']);	
	update_option('dt_SinglePostInfo',$_POST['dt_SinglePostInfo']);	
	update_option('dt_SinglePostRelated',$_POST['dt_SinglePostRelated']);	
	update_option('dt_SinglePostRelatedType',$_POST['dt_SinglePostRelatedType']);
	update_option('dt_SinglePostComments',$_POST['dt_SinglePostComments']);	
	update_option('dt_SinglePostSharing',$_POST['dt_SinglePostSharing']);				
}
function single_project_settings_update() {
	update_option('dt_SingleProjectLayout',$_POST['dt_SingleProjectLayout']);	
	update_option('dt_SingleProjectSidebar',$_POST['dt_SingleProjectSidebar']);	
	update_option('dt_SingleProjectComments',$_POST['dt_SingleProjectComments']);
	update_option('dt_SingleProjectRelated',$_POST['dt_SingleProjectRelated']);	
	update_option('dt_SingleProjectSharing',$_POST['dt_SingleProjectSharing']);				
}
function duotivesettings() {  
?>  
    <div class="wrap">
    	<?php $warnings = dt_AdminWarnings(); ?>
        <?php if ($warnings != '' ): ?>
            <div class="page-error page-error-extra-margin">
            	<?php echo $warnings; ?>
            </div>
        <?php endif; ?>
    	<div id="duotive-logo"><span class="color">Duotive</span> Admin Panel <sup>v2</sup></div>
        <div id="duotive-main-menu">
        	<ul>
            	<li class="active"><a href="admin.php?page=duotive-panel">General Settings</a></li>
            	<li><a href="admin.php?page=duotive-front-page-manager">Frontpage</a></li>
            	<li><a href="admin.php?page=duotive-slider">Slideshow</a></li>
            	<li><a href="admin.php?page=duotive-sidebars">Sidebars</a></li>
				<li><a href="admin.php?page=duotive-portfolios">Portfolios</a></li> 
				<li><a href="admin.php?page=duotive-blogs">Blogs</a></li>
				<li><a href="admin.php?page=duotive-pricing-table">Pricing</a></li> 
                <li><a href="admin.php?page=duotive-contact">Contact page</a></li>
	            <li><a href="admin.php?page=duotive-language">Language</a></li>                                                                                                             
            </ul>
        </div>
        <div id="duotive-admin-panel">
	    	<h3>General settings</h3>        
            <ul class="ui-tabs-nav">
                <li><a href="#general-settings">General</a></li>
				<li><a href="#background-settings">Background</a></li>                
				<li><a href="#header-settings">Header</a></li>
				<li><a href="#footer-settings">Footer</a></li>
				<li><a href="#single-settings">Post settings</a></li>
				<li><a href="#single-project-settings">Project settings</a></li>                                
                <li><a href="#advanced-settings">Advanced</a></li>                                
            </ul>
            <div id="general-settings" class="ui-tabs-panel">
                <?php if ( isset($_POST['general-settings']) && $_POST['general-settings'] == 'true') { general_settings_update(); } ?>
            	<form method="post" action="#general-settings" class="transform">
                    <input type="hidden" name="general-settings" value="true" />                    
                    <div class="table-row clearfix">
                        <label for="dt_MainTheme">Main theme:</label>
                        <select name="dt_MainTheme">
                            <?php $dt_MainTheme = get_option('dt_MainTheme','main-theme-light'); ?><?php echo $dt_MainTheme; ?>
                            <option value="main-theme-light" <?php if ($dt_MainTheme=='main-theme-light') { echo 'selected'; } ?> >Light</option>                            
							<option value="main-theme-dark" <?php if ($dt_MainTheme=='main-theme-dark') { echo 'selected'; } ?> >Dark</option>                                                        
                        </select> 
                    </div>                                         
                    <div class="table-row clearfix">
                    	<label>Predefined colors:</label>
                        <div id="predef_color_wrapper">
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'ADBB42' && get_option('dt_secondayColor') == 'EBF732' ) echo ' predef-color-active'; ?> predef-color-1" data-dtPrimaryColor="ADBB42" data-dtSecondaryColor="EBF732"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '586695' && get_option('dt_secondayColor') == 'B3A9E7' ) echo ' predef-color-active'; ?> predef-color-2" data-dtPrimaryColor="586695" data-dtSecondaryColor="B3A9E7"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'E8A621' && get_option('dt_secondayColor') == 'FFBB00' ) echo ' predef-color-active'; ?> predef-color-3" data-dtPrimaryColor="E8A621" data-dtSecondaryColor="FFBB00"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '7E659E' && get_option('dt_secondayColor') == 'EC83AD' ) echo ' predef-color-active'; ?> predef-color-4" data-dtPrimaryColor="7E659E" data-dtSecondaryColor="EC83AD"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '8AB28D' && get_option('dt_secondayColor') == 'F4E0C8' ) echo ' predef-color-active'; ?> predef-color-5" data-dtPrimaryColor="8AB28D" data-dtSecondaryColor="F4E0C8"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '8AB28E' && get_option('dt_secondayColor') == 'C8C866' ) echo ' predef-color-active'; ?> predef-color-6" data-dtPrimaryColor="8AB28E" data-dtSecondaryColor="C8C866"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '586695' && get_option('dt_secondayColor') == 'A9D1E7' ) echo ' predef-color-active'; ?> predef-color-7" data-dtPrimaryColor="586695" data-dtSecondaryColor="A9D1E7"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '785B4B' && get_option('dt_secondayColor') == 'DA9E83' ) echo ' predef-color-active'; ?> predef-color-8" data-dtPrimaryColor="785B4B" data-dtSecondaryColor="DA9E83"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'BF2E7B' && get_option('dt_secondayColor') == 'EC83AD' ) echo ' predef-color-active'; ?> predef-color-9" data-dtPrimaryColor="BF2E7B" data-dtSecondaryColor="EC83AD"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '707883' && get_option('dt_secondayColor') == 'A5B2C1' ) echo ' predef-color-active'; ?> predef-color-10" data-dtPrimaryColor="707883" data-dtSecondaryColor="A5B2C1"  href="javascript:void(0);"><span>Color 1</span></a>                                                                                                                                                                                                                                                            
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'C91231' && get_option('dt_secondayColor') == 'F53D5E' ) echo ' predef-color-active'; ?> predef-color-11" data-dtPrimaryColor="C91231" data-dtSecondaryColor="F53D5E"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '007BC4' && get_option('dt_secondayColor') == '80BADA' ) echo ' predef-color-active'; ?> predef-color-12" data-dtPrimaryColor="007BC4" data-dtSecondaryColor="80BADA"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '5C4E51' && get_option('dt_secondayColor') == 'B1CC4F' ) echo ' predef-color-active'; ?> predef-color-13" data-dtPrimaryColor="5C4E51" data-dtSecondaryColor="B1CC4F"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '51919D' && get_option('dt_secondayColor') == 'B1DDE3' ) echo ' predef-color-active'; ?> predef-color-14" data-dtPrimaryColor="51919D" data-dtSecondaryColor="B1DDE3"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'BF1F1F' && get_option('dt_secondayColor') == 'EA7474' ) echo ' predef-color-active'; ?> predef-color-15" data-dtPrimaryColor="BF1F1F" data-dtSecondaryColor="EA7474"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'E53322' && get_option('dt_secondayColor') == 'F69179' ) echo ' predef-color-active'; ?> predef-color-16" data-dtPrimaryColor="E53322" data-dtSecondaryColor="F69179"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '6E4176' && get_option('dt_secondayColor') == 'BF7DC8' ) echo ' predef-color-active'; ?> predef-color-17" data-dtPrimaryColor="6E4176" data-dtSecondaryColor="BF7DC8"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'A0815D' && get_option('dt_secondayColor') == 'D7C5A9' ) echo ' predef-color-active'; ?> predef-color-18" data-dtPrimaryColor="A0815D" data-dtSecondaryColor="D7C5A9"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'AEBC7F' && get_option('dt_secondayColor') == 'E0E8C0' ) echo ' predef-color-active'; ?> predef-color-19" data-dtPrimaryColor="AEBC7F" data-dtSecondaryColor="E0E8C0"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '2F2F2F' && get_option('dt_secondayColor') == 'B6B6B6' ) echo ' predef-color-active'; ?> predef-color-20" data-dtPrimaryColor="2F2F2F" data-dtSecondaryColor="B6B6B6"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'DE3E0F' && get_option('dt_secondayColor') == 'F49C4E' ) echo ' predef-color-active'; ?> predef-color-21" data-dtPrimaryColor="DE3E0F" data-dtSecondaryColor="F49C4E"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'FB6B6B' && get_option('dt_secondayColor') == 'FEBABA' ) echo ' predef-color-active'; ?> predef-color-22" data-dtPrimaryColor="FB6B6B" data-dtSecondaryColor="FEBABA"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'E7901A' && get_option('dt_secondayColor') == 'F7D56C' ) echo ' predef-color-active'; ?> predef-color-23" data-dtPrimaryColor="E7901A" data-dtSecondaryColor="F7D56C"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '937039' && get_option('dt_secondayColor') == 'CDB784' ) echo ' predef-color-active'; ?> predef-color-24" data-dtPrimaryColor="937039" data-dtSecondaryColor="CDB784"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '106C72' && get_option('dt_secondayColor') == '54C0C4' ) echo ' predef-color-active'; ?> predef-color-25" data-dtPrimaryColor="106C72" data-dtSecondaryColor="54C0C4"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '223F7A' && get_option('dt_secondayColor') == '7F93B0' ) echo ' predef-color-active'; ?> predef-color-26" data-dtPrimaryColor="223F7A" data-dtSecondaryColor="7F93B0"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'AE2053' && get_option('dt_secondayColor') == 'F162B7' ) echo ' predef-color-active'; ?> predef-color-27" data-dtPrimaryColor="AE2053" data-dtSecondaryColor="F162B7"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '63785E' && get_option('dt_secondayColor') == 'BDCAB9' ) echo ' predef-color-active'; ?> predef-color-28" data-dtPrimaryColor="63785E" data-dtSecondaryColor="BDCAB9"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == 'C91231' && get_option('dt_secondayColor') == 'F9E6AC' ) echo ' predef-color-active'; ?> predef-color-29" data-dtPrimaryColor="C91231" data-dtSecondaryColor="F9E6AC"  href="javascript:void(0);"><span>Color 1</span></a>
                            <a class="predef-color<?php if ( get_option('dt_primaryColor') == '7647A5' && get_option('dt_secondayColor') == 'F9E6AC' ) echo ' predef-color-active'; ?> predef-color-30" data-dtPrimaryColor="7647A5" data-dtSecondaryColor="F9E6AC"  href="javascript:void(0);"><span>Color 1</span></a>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                        </div>
                    </div>                  
                    <div class="table-row clearfix">            
                        <label for="dt_primaryColor">Primary color:</label>
                        <input type="text" size="6" name="dt_primaryColor" id="dt_primaryColor" value="<?php echo get_option('dt_primaryColor'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_secondayColor">Secondary color:</label>
                        <input type="text" size="6" name="dt_secondayColor" id="dt_secondayColor" value="<?php echo get_option('dt_secondayColor'); ?>" />              
                    </div>                                        
                    <div class="table-row clearfix">
					<?php
                        $absolute_path = __FILE__;
                        $path_to_file = explode( 'wp-content', $absolute_path );
                        $path_to_wp = $path_to_file[0];
                        $theme_path = get_template_directory_uri();
                        $website_url = site_url().'/';
                        $theme_path = str_replace($website_url,'', $theme_path);
                        $fonts_path = $path_to_wp.$theme_path.'/fonts/custom/';
						$fonts = array();
						
                        if ( is_dir($fonts_path) )
                        {
                            $k = 0;
                            $fonts_path = $fonts_path.'*.ttf';
							if ( glob($fonts_path) )
							{
								foreach(glob($fonts_path) as $font)
								{
									$font_name = pathinfo($font);
									$font_title = str_replace('-webfont.ttf', '',$font_name['basename']);
									$font_title = ereg_replace("[^A-Za-z0-9]", " ", $font_title);
									$font_title = ucwords($font_title);
									$font_title = trim($font_title);
									$font_name = str_replace('-webfont.ttf', '',$font_name['basename']);
									$fonts[$k]['name'] = $font_name;
									$fonts[$k]['title'] = $font_title;
									$k++;
								}
							}
                        }
                    ?>
                        <label for="dt_FontFamily">Font:</label>
                        <select name="dt_FontFamily">
                            <?php $dt_FontFamily = get_option('dt_FontFamily'); ?>
                            
	                        <option value="Tahoma" <?php if ($dt_FontFamily=='Tahoma') { echo 'selected'; } ?> >Tahoma</option>                                                        
	                        <option value="Georgia" <?php if ($dt_FontFamily=='Georgia') { echo 'selected'; } ?> >Georgia</option>                            
	                        <option value="Times New Roman" <?php if ($dt_FontFamily=='Times New Roman') { echo 'selected'; } ?> >Times New Roman</option>
	                        <option value="Lucida Sans Unicode" <?php if ($dt_FontFamily=='Lucida Sans Unicode') { echo 'selected'; } ?> >Lucida Sans Unicode</option>                                                                                    
	                        <option value="Trebuchet MS" <?php if ($dt_FontFamily=='Trebuchet MS') { echo 'selected'; } ?> >Trebuchet MS</option>             
	                        <option value="Microsoft Sans Serif" <?php if ($dt_FontFamily=='Microsoft Sans Serif') { echo 'selected'; } ?> >Microsoft Sans Serif</option>              
	                        <option value="Verdana" <?php if ($dt_FontFamily=='Verdana') { echo 'selected'; } ?> >Verdana</option>                                                                                                                                             
                            <?php if ( count($fonts) > 0 ): ?>
                            	<?php foreach($fonts as $newfont): ?>
                                	<option value="<?php echo 'custom/'.$newfont['name']; ?>" <?php if ($dt_FontFamily == 'custom/'.$newfont['name']) { echo 'selected'; } ?> ><?php echo $newfont['title']; ?></option>   
                                <?php endforeach; ?>
							<?php endif;?>
                        </select>
                        <img class="hint-icon" title="To use custom fonts you need to download the font's @font-face kit (from www.fontsquirrel.com) and place the 4 files (*.ttf, *.eot, *.woff, *.svg) that you find in the archive to &quot;themes/duotive-three/fonts/custom/&quot;. IMPORTANT: Not all the fonts will go well with the theme in sense of line-height and apperance." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                                                        
                    <div class="table-row clearfix">
                        <label for="dt_favicon">Favicon URL</label>
                        <input type="text" size="50" id="dt_favicon" name="dt_favicon" value="<?php echo get_option('dt_favicon'); ?>" />                                      
                        <span class="upload_or">OR</span>
                        <input id="dt_favicon_button" type="button" value="Upload Favicon" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="dt_CropLocation">Thumbnail crop location:</label>
                        <select name="dt_CropLocation">
                            <?php $dt_CropLocation = get_option('dt_CropLocation','c'); ?>
                            <option value="c" <?php if ($dt_CropLocation=='c') { echo 'selected'; } ?> >center</option> 
                            <option value="t" <?php if ($dt_CropLocation=='t') { echo 'selected'; } ?> >top</option> 
                            <option value="tr" <?php if ($dt_CropLocation=='tr') { echo 'selected'; } ?> >top right</option> 
                            <option value="tl" <?php if ($dt_CropLocation=='tl') { echo 'selected'; } ?> >top left</option> 		
                            <option value="b" <?php if ($dt_CropLocation=='b') { echo 'selected'; } ?> >bottom</option> 
                            <option value="br" <?php if ($dt_CropLocation=='br') { echo 'selected'; } ?> >bottom right</option> 
                            <option value="bl" <?php if ($dt_CropLocation=='bl') { echo 'selected'; } ?> >bottom left</option> 
                            <option value="l" <?php if ($dt_CropLocation=='l') { echo 'selected'; } ?> >left</option> 
                            <option value="r'" <?php if ($dt_CropLocation=='r') { echo 'selected'; } ?> >right</option> 
                        </select>
                        <img class="hint-icon" title="The alignment position where the theme will crop your images, if they don't match the thumbnail width and height ratio." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
					</div>
                    <div class="table-row clearfix">
                        <label for="dt_FullWidthLoader">Enable pre-loader:</label>
                        <select name="dt_FullWidthLoader">
                            <?php $dt_FullWidthLoader = get_option('dt_FullWidthLoader','no'); ?>
                            <option value="yes" <?php if ($dt_FullWidthLoader=='yes') { echo 'selected'; } ?> >Yes</option> 
                            <option value="no" <?php if ($dt_FullWidthLoader=='no') { echo 'selected'; } ?> >No</option>
                        </select>
                        <img class="hint-icon" title="Enabling the preloader hides the loading process of the website, so when a user opens a page he will see a fully loaded page." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
					</div>  
                    <div class="table-row clearfix">
                        <label for="dt_ThemeSwitcher">Enable light/dark switcher:</label>
                        <select name="dt_ThemeSwitcher">
                            <?php $dt_ThemeSwitcher = get_option('dt_ThemeSwitcher','no'); ?>
                            <option value="yes" <?php if ($dt_ThemeSwitcher=='yes') { echo 'selected'; } ?> >Yes</option> 
                            <option value="no" <?php if ($dt_ThemeSwitcher=='no') { echo 'selected'; } ?> >No</option>
                        </select>
                        <img class="hint-icon" title="Enabling the preloader hides the loading process of the website, so when a user opens a page he will see a fully loaded page." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
					</div>                                                                
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Save changes" class="button" />	
						<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                    </div>	                         
                </form>            
			</div>
            <div id="background-settings" class="ui-tabs-panel">
                <?php if ( isset($_POST['background-settings']) && $_POST['background-settings'] == 'true') { background_settings_update(); } ?>
            	<form method="post" action="#background-settings" class="transform">
                    <input type="hidden" name="background-settings" value="true" />
                    <div class="table-row clearfix">            
                        <label for="dt_generalBackgroundColor">General background color:</label>
                        <input type="text" size="6" name="dt_generalBackgroundColor" id="dt_generalBackgroundColor" value="<?php echo get_option('dt_generalBackgroundColor'); ?>" />              
                    </div>                                  
                    <div class="table-row clearfix">
                        <label for="dt_generalBackground">General background URL:</label>
                        <input type="text" size="50" id="dt_generalBackground" name="dt_generalBackground" value="<?php echo get_option('dt_generalBackground'); ?>" />                                      
                        <span class="upload_or">OR</span>
                        <input id="dt_generalBackground_button" type="button" value="Upload Background" />
                        <img class="hint-icon" title="The background image set here will be present on all the pages and posts, unless they have a predefined background image." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="dt_generalBackgroundPosition">General background position:</label>
                        <select name="dt_generalBackgroundPosition">
                            <?php $dt_generalBackgroundPosition = get_option('dt_generalBackgroundPosition','center top'); ?>
                            <option value="left top" <?php if ($dt_generalBackgroundPosition=='left top') { echo 'selected'; } ?> >left top</option>
                            <option value="left center" <?php if ($dt_generalBackgroundPosition=='left center') { echo 'selected'; } ?> >left center</option>
                            <option value="left bottom" <?php if ($dt_generalBackgroundPosition=='left bottom') { echo 'selected'; } ?> >left bottom</option>
                            <option value="right top" <?php if ($dt_generalBackgroundPosition=='right top') { echo 'selected'; } ?> >right top</option>
                            <option value="right center" <?php if ($dt_generalBackgroundPosition=='right center') { echo 'selected'; } ?> >right center</option>
                            <option value="right bottom" <?php if ($dt_generalBackgroundPosition=='right bottom') { echo 'selected'; } ?> >right bottom</option>
                            <option value="center top" <?php if ($dt_generalBackgroundPosition=='center top') { echo 'selected'; } ?> >center top</option>
                            <option value="center center" <?php if ($dt_generalBackgroundPosition=='center center') { echo 'selected'; } ?> >center center</option>
                            <option value="center bottom" <?php if ($dt_generalBackgroundPosition=='center bottom') { echo 'selected'; } ?> >center bottom</option>
                        </select>
						<img class="hint-icon" title="This option dictates how the background image will be aligned according to the browser's window." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                        
                    </div>
                    <div class="table-row clearfix">
                        <label for="dt_generalBackgroundRepeat">General background repeat:</label>
                        <select name="dt_generalBackgroundRepeat">
                            <?php $dt_generalBackgroundRepeat = get_option('dt_generalBackgroundRepeat','no-repeat'); ?>
                            <option value="no-repeat" <?php if ($dt_generalBackgroundRepeat=='no-repeat') { echo 'selected'; } ?> >no-repeat</option>
                            <option value="repeat" <?php if ($dt_generalBackgroundRepeat=='repeat') { echo 'selected'; } ?> >repeat</option>
                            <option value="repeat-x" <?php if ($dt_generalBackgroundRepeat=='repeat-x') { echo 'selected'; } ?> >repeat-x</option>
                            <option value="repeat-y" <?php if ($dt_generalBackgroundRepeat=='repeat-y') { echo 'selected'; } ?> >repeat-y</option>
                        </select> 
                    </div>
                    <div class="table-row clearfix">
					<?php
                        $absolute_path = __FILE__;
                        $path_to_file = explode( 'wp-content', $absolute_path );
                        $path_to_wp = $path_to_file[0];
                        $theme_path = get_template_directory_uri();
                        $website_url = site_url().'/';
                        $theme_path = str_replace($website_url,'', $theme_path);
                        $bgs_path = $path_to_wp.$theme_path.'/images/bgs/';
						$bgs = array();
                        if ( is_dir($bgs_path) )
                        {
							$k = 0;
                            $bgs_path = $bgs_path.'*';
							if ( glob($bgs_path) )
							{
								foreach(glob($bgs_path) as $bg)
								{
									$bg_name = pathinfo($bg);
									if ( isset($bg_name['extension']) )
									{						
										$file_name = str_replace('.'.$bg_name['extension'],'',$bg_name['basename']);
										$file_name = ereg_replace("[^A-Za-z0-9]", " ", $file_name);
										$file_name = ucwords($file_name);
										$file_name = trim($file_name);									
										$bgs[$k]['name'] = $file_name;
										$bgs[$k]['url'] = get_template_directory_uri().'/images/bgs/'.$bg_name['basename'];
									}
									else
									{
										$subfolder_path = $bg_name['dirname'].'/'.$bg_name['basename'].'/*';
										$subfolder_name = $bg_name['basename'];
										$subfolder_processed_name = ereg_replace("[^A-Za-z0-9]", " ", $subfolder_name);
										$subfolder_processed_name = ucwords($subfolder_processed_name);
										$subfolder_processed_name = trim($subfolder_processed_name);	
										foreach(glob($subfolder_path) as $bg):
											$bg_name = pathinfo($bg);
											$file_name = str_replace('.'.$bg_name['extension'],'',$bg_name['basename']);
											$file_name = ereg_replace("[^A-Za-z0-9]", " ", $file_name);
											$file_name = ucwords($file_name);
											$file_name = trim($file_name);									
											$bgs[$k]['name'] = $subfolder_processed_name.' / '.$file_name;
											$bgs[$k]['url'] = get_template_directory_uri().'/images/bgs/'.$subfolder_name.'/'.$bg_name['basename'];
											$k++;
										endforeach;
									}
									$k++;
								}
							}
                        }
                    ?>
                    	<label for="dt_generalBackground">Predefined background:</label>
                        <div id="predef_bg_wrapper" class="clearfix">
						<?php if ( count($bgs) > 0 ): ?>
                        	<?php $active = get_option('dt_predefinedBackground'); ?>
                            <?php foreach($bgs as $newbg): ?>
                            	<div class="bg-preview-toggler clearfix">
                                	<a href="<?php echo $newbg['url'];?>">
	                                	<span class="preview<?php if ( $active == $newbg['url']) echo ' active'; ?>" style="background-image:url(<?php resizeimage($newbg['url'],32,32); ?>);" data-id="<?php echo $newbg['url']; ?>" title="<?php echo $newbg['name']; ?>"></span>
                                   	</a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif;?>                    
                        <input type="hidden" size="6" name="dt_predefinedBackground" id="dt_predefinedBackground" value="<?php echo get_option('dt_predefinedBackground'); ?>" />              
                        </div>
                    </div>                                           
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Save changes" class="button" />	
						<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                    </div>	                    
				</form>
			</div>                                                
            <div id="header-settings" class="ui-tabs-panel">
            	<?php if ( isset($_POST['header-settings']) && $_POST['header-settings'] == 'true') { header_settings_update(); } ?> 
            	<form method="post" action="#header-settings" class="transform">  
                	<input type="hidden" name="header-settings" value="true" />
                    <div class="table-row clearfix">
                        <label for="dt_headerHome">Use home icon menu-item:</label>
                        <select name="dt_headerHome">
                            <?php $dt_headerHome = get_option('dt_headerHome','yes'); ?>
                            <option value="yes" <?php if ($dt_headerHome=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            <option value="no" <?php if ($dt_headerHome=='no') { echo 'selected'; } ?> >No</option>
                        </select>
                        <img class="hint-icon" title="Enable or Disable the home graphic from your menu. Note that it cannot support a dropdown." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" /> 
                    </div>                                                          
                    <div class="table-row clearfix">
                        <label for="dt_headerLogo">Logo URL</label>
                        <input type="text" size="50" id="dt_headerLogo" name="dt_headerLogo" value="<?php echo get_option('dt_headerLogo'); ?>" />                                      
                        <span class="upload_or">OR</span>
                        <input id="dt_headerLogo_button" type="button" value="Upload logo" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="dt_headerLogovertical">Logo vertical alignment</label>
                        <input type="text" size="4" id="dt_headerLogovertical" name="dt_headerLogovertical" value="<?php echo get_option('dt_headerLogovertical'); ?>" />                                      
                        <div id="dt_headerLogoverticalslider"></div>
                        <img class="hint-icon" title="Distance between the logo and the top of the header." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>  
                    <div class="table-row clearfix">
                        <label for="dt_headerLogohorizontal">Logo horizontal alignment</label>
                        <input type="text" size="4" id="dt_headerLogohorizontal" name="dt_headerLogohorizontal" value="<?php echo get_option('dt_headerLogohorizontal'); ?>" />                                      
                        <div id="dt_headerLogohorizontalslider"></div>
                        <img class="hint-icon" title="Distance between the logo and the left side of the header." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                        
                    </div>
                    <div class="table-row clearfix">
                        <label for="dt_headerSearch">Enable header search:</label>
                        <select name="dt_headerSearch">
                            <?php $dt_headerSearch = get_option('dt_headerSearch'); ?>
                            <option value="yes" <?php if ($dt_headerSearch=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            <option value="no" <?php if ($dt_headerSearch=='no') { echo 'selected'; } ?> >No</option>
                        </select> 
                    </div>                    
                    <div class="table-row clearfix">
                        <label for="dt_headerSharing">Enable header sharing:</label>
                        <select name="dt_headerSharing">
                            <?php $dt_headerSharing = get_option('dt_headerSharing','no'); ?>
                            <option value="yes" <?php if ($dt_headerSharing=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            <option value="no" <?php if ($dt_headerSharing=='no') { echo 'selected'; } ?> >No</option>
                        </select>
                        <img class="hint-icon" title="Enable or Disable the header social networks icons." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                                                             
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingDeviantart">Deviantart URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingDeviantart" value="<?php echo get_option('dt_HeaderSharingDeviantart'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingFacebook">Facebook URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingFacebook" value="<?php echo get_option('dt_HeaderSharingFacebook'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingFlickr">Flickr URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingFlickr" value="<?php echo get_option('dt_HeaderSharingFlickr'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingMyspace">Myspace URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingMyspace" value="<?php echo get_option('dt_HeaderSharingMyspace'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingRss">RSS URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingRss" value="<?php echo get_option('dt_HeaderSharingRss'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingTwitter">Twitter URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingTwitter" value="<?php echo get_option('dt_HeaderSharingTwitter'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingVimeo">Vimeo URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingVimeo" value="<?php echo get_option('dt_HeaderSharingVimeo'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingYoutube">Youtube URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingYoutube" value="<?php echo get_option('dt_HeaderSharingYoutube'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingReddit">Reedit URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingReddit" value="<?php echo get_option('dt_HeaderSharingReddit'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingStumbleUpon">Stumble Upon URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingStumbleUpon" value="<?php echo get_option('dt_HeaderSharingStumbleUpon'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingSoundCloud">Sound Cloud URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingSoundCloud" value="<?php echo get_option('dt_HeaderSharingSoundCloud'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingGooglePlus">Google + URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingGooglePlus" value="<?php echo get_option('dt_HeaderSharingGooglePlus'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingLinkedIn">Linked In URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingLinkedIn" value="<?php echo get_option('dt_HeaderSharingLinkedIn'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingDelicious">Delicious URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingDelicious" value="<?php echo get_option('dt_HeaderSharingDelicious'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingDigg">Digg URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingDigg" value="<?php echo get_option('dt_HeaderSharingDigg'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingTechnorati">Technorati URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingTechnorati" value="<?php echo get_option('dt_HeaderSharingTechnorati'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingSkype">Skype URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingSkype" value="<?php echo get_option('dt_HeaderSharingSkype'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingBlogger">Blogger URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingBlogger" value="<?php echo get_option('dt_HeaderSharingBlogger'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingPicasa">Picasa URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingPicasa" value="<?php echo get_option('dt_HeaderSharingPicasa'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingDribble">Dribble URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingDribble" value="<?php echo get_option('dt_HeaderSharingDribble'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_HeaderSharingModelMayhem">Model Mayhem URL:</label>
                        <input type="text" size="50" name="dt_HeaderSharingModelMayhem" value="<?php echo get_option('dt_HeaderSharingModelMayhem'); ?>" />              
                    </div>                                                                                                                                                                                                       
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Save changes" class="button" />
                        <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />		
                    </div>	                         
				</form>                         
			<!-- end of header settings -->
            </div>
            <div id="footer-settings" class="ui-tabs-panel">
            	<?php if ( isset($_POST['footer-settings']) && $_POST['footer-settings'] == 'true') { footer_settings_update(); } ?> 
            	<form method="post" action="#footer-settings" class="transform"> 
					<input type="hidden" name="footer-settings" value="true" />                 
                    <div class="table-row clearfix">
                        <label for="dt_FooterSharing">Enable footer sharing:</label>
                        <select name="dt_FooterSharing">
                            <?php $dt_FooterSharing = get_option('dt_FooterSharing'); ?>
                            <option value="no" <?php if ($dt_FooterSharing=='no') { echo 'selected'; } ?> >No</option>                            
                            <option value="yes" <?php if ($dt_FooterSharing=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                        </select>
                        <img class="hint-icon" title="Enable or Disable the footer social networks module." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">            
                        <label for="youtube">Footer sharing title:</label>
                        <input type="text" size="50" name="dt_FooterSharingHeading" value="<?php echo get_option('dt_FooterSharingHeading'); ?>" />              
                        <img class="hint-icon" title="Set the title which will appear on the left hand side of the social networks module." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingDeviantart">Deviantart URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingDeviantart" value="<?php echo get_option('dt_FooterSharingDeviantart'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingFacebook">Facebook URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingFacebook" value="<?php echo get_option('dt_FooterSharingFacebook'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingFlickr">Flickr URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingFlickr" value="<?php echo get_option('dt_FooterSharingFlickr'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingMyspace">Myspace URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingMyspace" value="<?php echo get_option('dt_FooterSharingMyspace'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingRss">RSS URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingRss" value="<?php echo get_option('dt_FooterSharingRss'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingTwitter">Twitter URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingTwitter" value="<?php echo get_option('dt_FooterSharingTwitter'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingVimeo">Vimeo URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingVimeo" value="<?php echo get_option('dt_FooterSharingVimeo'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingYoutube">Youtube URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingYoutube" value="<?php echo get_option('dt_FooterSharingYoutube'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingReddit">Reedit URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingReddit" value="<?php echo get_option('dt_FooterSharingReddit'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingStumbleUpon">Stumble Upon URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingStumbleUpon" value="<?php echo get_option('dt_FooterSharingStumbleUpon'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingSoundCloud">Sound Cloud URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingSoundCloud" value="<?php echo get_option('dt_FooterSharingSoundCloud'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingGooglePlus">Google + URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingGooglePlus" value="<?php echo get_option('dt_FooterSharingGooglePlus'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingLinkedIn">Linked In URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingLinkedIn" value="<?php echo get_option('dt_FooterSharingLinkedIn'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingDelicious">Delicious URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingDelicious" value="<?php echo get_option('dt_FooterSharingDelicious'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingDigg">Digg URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingDigg" value="<?php echo get_option('dt_FooterSharingDigg'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingTechnorati">Technorati URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingTechnorati" value="<?php echo get_option('dt_FooterSharingTechnorati'); ?>" />              
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingSkype">Skype URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingSkype" value="<?php echo get_option('dt_FooterSharingSkype'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingBlogger">Blogger URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingBlogger" value="<?php echo get_option('dt_FooterSharingBlogger'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingPicasa">Picasa URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingPicasa" value="<?php echo get_option('dt_FooterSharingPicasa'); ?>" />              
                    </div>  
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingDribble">Dribble URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingDribble" value="<?php echo get_option('dt_FooterSharingDribble'); ?>" />              
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_FooterSharingModelMayhem">Model Mayhem URL:</label>
                        <input type="text" size="50" name="dt_FooterSharingModelMayhem" value="<?php echo get_option('dt_FooterSharingModelMayhem'); ?>" />              
                    </div>                                                               
                    <div class="table-row clearfix">
                        <label for="dt_Footer">Use footer:</label>
                        <select name="dt_Footer">
                            <?php $dt_Footer = get_option('dt_Footer'); ?>
                            <option value="no" <?php if ($dt_Footer=='no') { echo 'selected'; } ?> >No</option>
                            <option value="yes" <?php if ($dt_Footer=='yes') { echo 'selected'; } ?> >Yes</option>                                                                                    
                        </select>
                    </div>
                    <div class="table-row clearfix">
                        <label for="dt_FooterTabs">Use footer tabs:</label>
                        <select name="dt_FooterTabs">
                            <?php $dt_FooterTabs = get_option('dt_FooterTabs'); ?>
                            <option value="disabled" <?php if ($dt_FooterTabs=='disabled') { echo 'selected'; } ?> >Disabled</option>
                            <option value="6" <?php if ($dt_FooterTabs=='6') { echo 'selected'; } ?> >Six Columns</option>
                            <option value="5" <?php if ($dt_FooterTabs=='5') { echo 'selected'; } ?> >Five Columns</option>
                            <option value="4" <?php if ($dt_FooterTabs=='4') { echo 'selected'; } ?> >Four Columns</option>
                            <option value="3" <?php if ($dt_FooterTabs=='3') { echo 'selected'; } ?> >Three Columns</option>
                            <option value="2" <?php if ($dt_FooterTabs=='2') { echo 'selected'; } ?> >Two Columns</option>
                            <option value="1" <?php if ($dt_FooterTabs=='1') { echo 'selected'; } ?> >One Column</option>
                            <option value="threesixthsandonehalf" <?php if ($dt_FooterTabs=='threesixthsandonehalf') { echo 'selected'; } ?> >3 x One Sixth + One Half Columns</option>
                            <option value="twooneforthandonehalf" <?php if ($dt_FooterTabs=='twooneforthandonehalf') { echo 'selected'; } ?> >2 x One Forth + One Half Columns</option>
                            <option value="onethirdandtwothirds" <?php if ($dt_FooterTabs=='onethirdandtwothirds') { echo 'selected'; } ?> >One Third + Two Thirds Columns</option>
                        </select>
                        <img class="hint-icon" title="This option allows you to select one of the footer columns templates or disable them completely." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="dt_SubFooter">Use sub footer:</label>
                        <select name="dt_SubFooter">
                            <?php $dt_SubFooter = get_option('dt_SubFooter'); ?>
                            <option value="no" <?php if ($dt_SubFooter=='no') { echo 'selected'; } ?> >No</option>
                            <option value="yes" <?php if ($dt_SubFooter=='yes') { echo 'selected'; } ?> >Yes</option>                                                                                    
                        </select>
                        <img class="hint-icon" title="The sub-footer area contains the footer menu and the copyright text box." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="dt_FooterLogo">Footer Logo URL</label>
                        <input type="text" size="50" id="dt_FooterLogo" name="dt_FooterLogo" value="<?php echo get_option('dt_FooterLogo'); ?>" />                                      
                        <span class="upload_or">OR</span>
                        <input id="dt_FooterLogo_button" type="button" value="Upload logo" />
                    </div>
                    <div class="table-row clearfix">            
                        <label for="dt_Copyright">Copyright text:</label>
                        <textarea cols="50" rows="15" id="dt_Copyright" name="dt_Copyright"><?php echo get_option('dt_Copyright'); ?></textarea>           
                    </div>                                                                                                   
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Save changes" class="button" />
                        <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />		
                    </div>                    
				</form>                                 
            <!-- end of footer settings -->
            </div>
            <div id="single-settings" class="ui-tabs-panel">
            	<?php if ( isset($_POST['single-settings']) && $_POST['single-settings'] == 'true') { single_settings_update(); } ?>  
            	<form method="post" action="#single-settings" class="transform">
	                <input type="hidden" name="single-settings" value="true" /> 
                    <div class="table-row clearfix">
                        <label for="dt_SinglePostSidebar">Disable sidebar:</label>
                        <select name="dt_SinglePostSidebar">
                            <?php $dt_SinglePostSidebar = get_option('dt_SinglePostSidebar'); ?>
                            <option value="no" <?php if ($dt_SinglePostSidebar=='no') { echo 'selected'; } ?> >No</option>                            
                            <option value="yes" <?php if ($dt_SinglePostSidebar=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                        </select>
                        <img class="hint-icon" title="Enable or Disable the sidebar from your posts and acts as the 'theme default'. This option can be overridden for each individual post from the 'Duotive Post Options' panel, when editing or adding a new post." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="dt_SinglePostImage">Disable post top image:</label>
                        <select name="dt_SinglePostImage">
                            <?php $dt_SinglePostImage = get_option('dt_SinglePostImage'); ?>
                            <option value="no" <?php if ($dt_SinglePostImage=='no') { echo 'selected'; } ?> >No</option>                            
                            <option value="yes" <?php if ($dt_SinglePostImage=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                        </select>
                        <img class="hint-icon" title="Enable or Disable the featured image at the top of the post." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                     
                    <div class="table-row clearfix">
                        <label for="dt_SinglePostInfo">Disable post info:</label>
                        <select name="dt_SinglePostInfo">
                            <?php $dt_SinglePostInfo = get_option('dt_SinglePostInfo'); ?>
                            <option value="no" <?php if ($dt_SinglePostInfo=='no') { echo 'selected'; } ?> >No</option>                            
                            <option value="yes" <?php if ($dt_SinglePostInfo=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                        </select>
                        <img class="hint-icon" title="Enable or Disable the collapsable area which contains additional information about the post (e.g. author, publishing date, category, etc.)." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>
                    <div class="table-row clearfix">
                        <label for="dt_SinglePostRelated">Disable related posts:</label>
                        <select name="dt_SinglePostRelated">
                            <?php $dt_SinglePostRelated = get_option('dt_SinglePostRelated'); ?>
                            <option value="no" <?php if ($dt_SinglePostRelated=='no') { echo 'selected'; } ?> >No</option>                            
                            <option value="yes" <?php if ($dt_SinglePostRelated=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                        </select> 
                    </div>                    
                    <div class="table-row clearfix">
                        <label for="dt_SinglePostRelatedType">The related post are related by:</label>
                        <select name="dt_SinglePostRelatedType">
                            <?php $dt_SinglePostRelatedType = get_option('dt_SinglePostRelatedType'); ?>
                            <option value="category" <?php if ($dt_SinglePostRelatedType=='category') { echo 'selected'; } ?> >Category</option>                                                                                    
                            <option value="tags" <?php if ($dt_SinglePostRelatedType=='tags') { echo 'selected'; } ?> >Tags</option>                            
                        </select> 
                    </div>
                    <div class="table-row clearfix">
                        <label for="dt_SinglePostComments">Disable comments:</label>
                        <select name="dt_SinglePostComments">
                            <?php $dt_SinglePostComments = get_option('dt_SinglePostComments','no'); ?>
                            <option value="no" <?php if ($dt_SinglePostComments=='no') { echo 'selected'; } ?> >No</option>                            
                            <option value="yes" <?php if ($dt_SinglePostComments=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                        </select> 
                    </div>  
                    <div class="table-row clearfix">
                        <label for="dt_SinglePostSharing">Disable sharing:</label>
                        <select name="dt_SinglePostSharing">
                            <?php $dt_SinglePostSharing = get_option('dt_SinglePostSharing','no'); ?>
                            <option value="no" <?php if ($dt_SinglePostSharing=='no') { echo 'selected'; } ?> >No</option>                            
                            <option value="yes" <?php if ($dt_SinglePostSharing=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                        </select> 
                    </div>                                                                                                                                                
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Save changes" class="button" />	
						<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                    </div>                
				</form>                    	                
            <!-- end of single settins -->
            </div>
            <div id="single-project-settings" class="ui-tabs-panel">
            	<?php if ( isset($_POST['single-project-settings']) && $_POST['single-project-settings'] == 'true') { single_project_settings_update(); } ?>  
            	<form method="post" action="#single-project-settings" class="transform">
	                <input type="hidden" name="single-project-settings" value="true" />
                    <div class="table-row clearfix">
                        <label for="dt_SingleProjectLayout">Layout:</label>
                        <select name="dt_SingleProjectLayout">
                            <?php $dt_SingleProjectLayout = get_option('dt_SingleProjectLayout','1'); ?>
                            <option value="1" <?php if ($dt_SingleProjectLayout=='1') { echo 'selected'; } ?> >Layout 1</option>                            
                            <option value="2" <?php if ($dt_SingleProjectLayout=='2') { echo 'selected'; } ?> >Layout 2</option>                                                        
                        </select>
                        <img class="hint-icon" title="Choose one of the templates available to customize the project pages for your needs." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                      
                    <div class="table-row clearfix">
                        <label for="dt_SingleProjectSidebar">Disable sidebar:</label>
                        <select name="dt_SingleProjectSidebar">
                            <?php $dt_SingleProjectSidebar = get_option('dt_SingleProjectSidebar'); ?>
                            <option value="no" <?php if ($dt_SingleProjectSidebar=='no') { echo 'selected'; } ?> >No</option>                            
                            <option value="yes" <?php if ($dt_SingleProjectSidebar=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                        </select> 
                    </div>
                    <div class="table-row clearfix">
                        <label for="dt_SingleProjectRelated">Disable related projects:</label>
                        <select name="dt_SingleProjectRelated">
                            <?php $dt_SingleProjectRelated = get_option('dt_SingleProjectRelated'); ?>
                            <option value="no" <?php if ($dt_SingleProjectRelated=='no') { echo 'selected'; } ?> >No</option>                            
                            <option value="yes" <?php if ($dt_SingleProjectRelated=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                        </select> 
                    </div>                       
                    <div class="table-row clearfix">
                        <label for="dt_SingleProjectComments">Disable comments:</label>
                        <select name="dt_SingleProjectComments">
                            <?php $dt_SingleProjectComments = get_option('dt_SingleProjectComments','no'); ?>
                            <option value="no" <?php if ($dt_SingleProjectComments=='no') { echo 'selected'; } ?> >No</option>                            
                            <option value="yes" <?php if ($dt_SingleProjectComments=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                        </select> 
                    </div>  
                    <div class="table-row clearfix">
                        <label for="dt_SingleProjectSharing">Disable sharing:</label>
                        <select name="dt_SingleProjectSharing">
                            <?php $dt_SingleProjectSharing = get_option('dt_SingleProjectSharing','no'); ?>
                            <option value="no" <?php if ($dt_SingleProjectSharing=='no') { echo 'selected'; } ?> >No</option>                            
                            <option value="yes" <?php if ($dt_SingleProjectSharing=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                        </select> 
                    </div>                                        
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Save changes" class="button" />	
						<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                    </div>                
				</form>                    	                
            <!-- end of single settins -->
            </div>                               
            <div id="advanced-settings" class="ui-tabs-panel">
            	<?php if ( isset($_POST['advanced-settings']) && $_POST['advanced-settings'] == 'true') { advanced_settings_update(); } ?>
            	<form method="post" action="#advanced-settings" class="transform"> 
					<input type="hidden" name="advanced-settings" value="true" />                   
                    <div class="table-row clearfix">            
                        <label for="customcss">Custom CSS:</label>
                        <textarea cols="50" rows="15" id="customcss" name="customcss"><?php echo get_option('customcss'); ?></textarea>           
                        <img class="hint-icon" title="Here you can add your custom CSS rules. Using this feature, instead of modifying the theme's files, will make the update procedure easier." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div> 
                    <div class="table-row clearfix">            
                        <label for="google_analytics">Google analytics code:</label>
                        <textarea cols="50" rows="15" name="google_analytics"><?php echo get_option('google_analytics'); ?></textarea>           
                        <img class="hint-icon" title="If it's needed, you can insert your Google analytics code here." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                    </div>                                                             
                    <div class="table-row table-row-last clearfix">
                        <input type="submit" name="search" value="Save changes" class="button" />	
						<input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />	
                    </div>
				</form>                    	                
            <!-- end of advanced settins -->
            </div>                
        </div>        
    </form> 
<!--end of wrap -->    
</div>
<?php } ?>