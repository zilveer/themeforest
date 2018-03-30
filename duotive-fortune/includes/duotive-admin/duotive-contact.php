<?php

	function contact_admin_menu() 
	{
		add_submenu_page( 'duotive-panel', 'Duotive Contact Page Manager Generator', 'Contact Page', 'manage_options', 'duotive-contact', 'contact_page');
	}

	function contact_page() 
	{
		if ( isset($_POST['contact_update']) && $_POST['contact_update'] == 'true' ) { contact_update(); }	
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
                <li><a href="admin.php?page=duotive-panel">General settings</a></li>
                <li><a href="admin.php?page=duotive-front-page-manager">Frontpage</a></li>
                <li><a href="admin.php?page=duotive-slider">Slideshow</a></li>
                <li><a href="admin.php?page=duotive-sidebars">Sidebars</a></li>
                <li><a href="admin.php?page=duotive-portfolios">Portfolios</a></li>
                <li><a href="admin.php?page=duotive-blogs">Blogs</a></li>
                <li><a href="admin.php?page=duotive-pricing-table">Pricing</a></li> 
                <li class="active"><a href="admin.php?page=duotive-contact">Contact page</a></li>
	            <li><a href="admin.php?page=duotive-language">Language</a></li>                                                                                                
            </ul>
        </div>
        <div id="duotive-admin-panel">
            <h3>Contact page manager</h3>
            <ul class="ui-tabs-nav">
                <li><a href="#general-settings">General settings</a></li>            
            </ul> 
            <div id="settings">          
                <form method="POST" action="" class="transform">
                    <input type="hidden" name="contact_update" value="true" />
                    <div id="general-settings">
                        <div class="table-row clearfix">
                            <label for="dt_ContactMap">Use google map:</label>
                            <select name="dt_ContactMap">
                                <?php $dt_ContactMap = get_option('dt_ContactMap'); ?>
                                <option value="no" <?php if ($dt_ContactMap=='no') { echo 'selected'; } ?> >No</option>                                
                                <option value="yes" <?php if ($dt_ContactMap=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            </select>
                            <img class="hint-icon" title="Enable or Disable the map at the top of the page" src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                        </div>
                        <div class="table-row clearfix">
                            <label for="dt_ContactMapUrl">Google Map URL:</label>
							<input name="dt_ContactMapUrl" type="text" value="<?php echo get_option('dt_ContactMapUrl'); ?>" size="50" />                                                        
                            <img class="hint-icon" title="To find out the URL, go to Google Maps, click the 'Link' button in the top right area of the page and copy the URL from the box. Make sure you copy the one that has 'http://...' in front of it." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                        </div>                                                                 
                        <div class="table-row clearfix">
                            <label for="dt_ContactDestination">Destination e-mail:</label>
                            <input name="dt_ContactDestination" type="text" value="<?php echo get_option('dt_ContactDestination'); ?>" size="50" />
                            <img class="hint-icon" title="Type in the e-mail address where the e-mail from the contact form will be sent. Multiple e-mail addresses can be used, separated by commas." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                        </div>
                        <div class="table-row clearfix">
                            <label for="dt_ContactField1">Is "<?php echo dt_ContactFormName; ?>" required?</label>
                            <select name="dt_ContactField1">
                                <?php $dt_ContactField1 = get_option('dt_ContactField1', 'yes');?>
                                <option value="yes" <?php if ($dt_ContactField1=='yes') { echo 'selected'; } ?> >Yes</option>
                                <option value="no" <?php if ($dt_ContactField1=='no') { echo 'selected'; } ?>>No</option>
                            </select>
                        </div> 
                        <div class="table-row clearfix">
                            <label for="dt_ContactField2">Is "<?php echo dt_ContactFormCompany; ?>" required?</label>
                            <select name="dt_ContactField2">
                                <?php $dt_ContactField2 = get_option('dt_ContactField2', 'yes');?>
                                <option value="yes" <?php if ($dt_ContactField2=='yes') { echo 'selected'; } ?> >Yes</option>
                                <option value="no" <?php if ($dt_ContactField2=='no') { echo 'selected'; } ?>>No</option>
                            </select>
                        </div>
                        <div class="table-row clearfix">
                            <label for="dt_ContactField3">Is "<?php echo dt_ContactFormEmail; ?>" required?</label>
                            <select name="dt_ContactField3">
                                <?php $dt_ContactField3 = get_option('dt_ContactField3', 'yes');?>
                                <option value="yes" <?php if ($dt_ContactField3=='yes') { echo 'selected'; } ?> >Yes</option>
                                <option value="no" <?php if ($dt_ContactField3=='no') { echo 'selected'; } ?>>No</option>
                            </select>
                        </div>
                        <div class="table-row clearfix">
                            <label for="dt_ContactField4">Is "<?php echo dt_ContactFormPhone; ?>" required?</label>
                            <select name="dt_ContactField4">
                                <?php $dt_ContactField4 = get_option('dt_ContactField4', 'yes');?>
                                <option value="yes" <?php if ($dt_ContactField4=='yes') { echo 'selected'; } ?> >Yes</option>
                                <option value="no" <?php if ($dt_ContactField4=='no') { echo 'selected'; } ?>>No</option>
                            </select>
                        </div> 
                        <div class="table-row clearfix">
                            <label for="dt_ContactField5">Is "<?php echo dt_ContactFormMessage; ?>" required?</label>
                            <select name="dt_ContactField5">
                                <?php $dt_ContactField5 = get_option('dt_ContactField5', 'yes');?>
                                <option value="yes" <?php if ($dt_ContactField5=='yes') { echo 'selected'; } ?> >Yes</option>
                                <option value="no" <?php if ($dt_ContactField5=='no') { echo 'selected'; } ?>>No</option>
                            </select>
                        </div>                                                                                                                                                                                                                               
                        <div class="table-row clearfix">
                            <label for="dt_ContactRecaptcha">Use reCAPTCHA:</label>
                            <select name="dt_ContactRecaptcha">
                                <?php $dt_ContactRecaptcha = get_option('dt_ContactRecaptcha'); ?>
                                <option value="no" <?php if ($dt_ContactRecaptcha=='no') { echo 'selected'; } ?> >No</option>                                
                                <option value="yes" <?php if ($dt_ContactRecaptcha=='yes') { echo 'selected'; } ?> >Yes</option>                                                        
                            </select>
                            <img class="hint-icon" title="To use reCaptcha you will need to go to http://www.google.com/recaptcha and click on &quot;Use reCAPTCHA ON YOUR SITE&quot; button, and then on &quot;Sign up Now!&quot;. Type in your domain name as shown in the example then copy/paste the generated codes in the appropriate fields." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" /> 
                        </div> 
                        <div class="table-row clearfix">
                            <label for="dt_recaptchapublickey">reCAPTCHA public key:</label>
							<input name="dt_recaptchapublickey" type="text" value="<?php echo get_option('dt_recaptchapublickey'); ?>" size="50" />                                                        
                        </div>
                        <div class="table-row clearfix">
                            <label for="dt_recaptchaprivatekey">reCAPTCHA private key:</label>
							<input name="dt_recaptchaprivatekey" type="text" value="<?php echo get_option('dt_recaptchaprivatekey'); ?>" size="50" />                                                        
                        </div>                                                                        
                        <div class="table-row table-row-last clearfix">
                            <input type="submit" name="search" value="Save changes" class="button" />
                        </div>                                      
                    </div>      	
			        <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />                        	                    
                </form>                            
            </div>
        </div>    
    </div>        
<?php
	}
	function contact_update()
	{
		update_option('dt_ContactMap',$_POST['dt_ContactMap']);
		update_option('dt_ContactDestination',$_POST['dt_ContactDestination']);
		update_option('dt_ContactMapUrl',$_POST['dt_ContactMapUrl']);		
		update_option('dt_ContactField1',$_POST['dt_ContactField1']);
		update_option('dt_ContactField2',$_POST['dt_ContactField2']);
		update_option('dt_ContactField3',$_POST['dt_ContactField3']);
		update_option('dt_ContactField4',$_POST['dt_ContactField4']);
		update_option('dt_ContactField5',$_POST['dt_ContactField5']);
		update_option('dt_ContactRecaptcha',$_POST['dt_ContactRecaptcha']);
		update_option('dt_recaptchapublickey',$_POST['dt_recaptchapublickey']);		
		update_option('dt_recaptchaprivatekey',$_POST['dt_recaptchaprivatekey']);				
	}	
	add_action('admin_menu', 'contact_admin_menu');

?>
