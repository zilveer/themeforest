<?php
//STRINGS
	load_theme_textdomain('duotive', get_template_directory() . '/languages');
	$dt_TranslationDestination = get_option('dt_TranslationDestination', 'default');
	if ( $dt_TranslationDestination == 'default' ) 
	{ 
		//GENEARAL
		define('dt_ReadMore',get_option('dt_ReadMore', 'Read More'));
		define('dt_ViewImage',get_option('dt_ViewImage', 'View image'));
		define('dt_PlayVideo',get_option('dt_PlayVideo', 'Play video'));				
		define('dt_Permalink',get_option('dt_Permalink', 'Permalink to '));	
		define('dt_GoToBlog',get_option('dt_GoToBlog', 'Go to blog'));		
		//POST RELATED
		define('dt_PostedBy',get_option('dt_PostedBy', 'Posted by '));	
		define('dt_Categories',get_option('dt_Categories', 'Filed in: ','duotive'));	
		define('dt_Tags',get_option('dt_Tags', 'Tags: '));		
		define('dt_RelatedTitle',get_option('dt_RelatedTitle', 'Related posts'));
		define('dt_RelatedProjectsTitle',get_option('dt_RelatedProjectsTitle', 'Related projects'));
		define('dt_ProjectsViewAll',get_option('dt_ProjectsViewAll', 'View all'));						
		//SEARCH
		define('dt_NotFoundTitle',get_option('dt_NotFoundTitle', 'Not Found'));	
		define('dt_NotFoundContent',get_option('dt_NotFoundContent', 'Apologies, but the page you requested could not be found. Perhaps searching will help.'));		
		define('dt_SearchInputBox',get_option('dt_SearchInputBox', 'Search...'));
		define('dt_SearchResults',get_option('dt_SearchResults', 'Search results for '));	
		//ARCHIVES
		define('dt_DailyArchives',get_option('dt_DailyArchives', 'Daily Archives: '));
		define('dt_MonthlyArchives',get_option('dt_MonthlyArchives', 'Monthly Archives: '));
		define('dt_YearlyArchives',get_option('dt_YearlyArchives', 'Yearly Archives: '));
		define('dt_BlogArchives',get_option('dt_BlogArchives', 'Blog Archives'));
		define('dt_ProjectArchives',get_option('dt_ProjectArchives', 'Project Archives'));		
		define('dt_AuthorArchives',get_option('dt_AuthorArchives', 'Author Archives: '));
		define('dt_CategoryArchives',get_option('dt_CategoryArchives', 'Category Archives: '));
		define('dt_TagArchives',get_option('dt_TagArchives', 'Tag Archives: '));	
		//AUTHOR
		define('dt_AuthorAbout',get_option('dt_AuthorAbout', 'About '));	
		define('dt_AuthorViewAll',get_option('dt_AuthorViewAll', 'View all posts'));
		//COMMENTS
		define('dt_Comments',get_option('dt_Comments', 'Comments'));
		define('dt_CommentsSays',get_option('dt_CommentsSays', 'says '));
		define('dt_CommentsFormName',get_option('dt_CommentsFormName','Name:'));			
		define('dt_CommentsFormEmail',get_option('dt_CommentsFormEmail','E-Mail:'));			
		define('dt_CommentsFormWebsite',get_option('dt_CommentsFormWebsite','Website (optional):'));
		define('dt_CommentsFormComment',get_option('dt_CommentsFormComment','Comment:'));	
		define('dt_CommentsPassword',get_option('dt_CommentsPassword', 'This post is password protected. Enter the password to view any comments.'));		
		define('dt_CommentsOlder',get_option('dt_CommentsOlder', 'Older Comments'));
		define('dt_CommentsNewer',get_option('dt_CommentsNewer', 'Newer Comments'));
		define('dt_CommentsLeaveReply',get_option('dt_CommentsLeaveReply', 'Leave a reply:'));		
		define('dt_CommentsLeaveReplyTo',get_option('dt_CommentsLeaveReplyTo', 'Leave a reply to:'));
		define('dt_CommentsCancelReply',get_option('dt_CommentsCancelReply', 'Cancel reply'));
		define('dt_CommentsPostComment',get_option('dt_CommentsPostComment', 'Post Comment'));	
		define('dt_CommentsRequired',get_option('dt_CommentsRequired', 'Required fields are marked '));	
		define('dt_CommentsPublish',get_option('dt_CommentsPublish', 'Your email address will not be published. '));						
		//CONTACT
		define('dt_ContactCaptchaEmpty',get_option('dt_ContactCaptchaEmpty', 'You forgot to fill in the security code.'));
		define('dt_ContactCaptchaError',get_option('dt_ContactCaptchaError', 'The value you entered in the security field didn\'t match.'));	
		define('dt_ContactMailSuccess',get_option('dt_ContactMailSuccess', 'The e-mail was sent successfully.'));
		define('dt_ContactMailError',get_option('dt_ContactMailError', 'The e-mail could not be sent. Please try again.'));	
		define('dt_ContactFormName',get_option('dt_ContactFormName', 'Full name: '));
		define('dt_ContactFormCompany',get_option('dt_ContactFormCompany', 'Company: '));		
		define('dt_ContactFormEmail',get_option('dt_ContactFormEmail', 'E-mail: '));
		define('dt_ContactFormPhone',get_option('dt_ContactFormPhone', 'Phone number: '));
		define('dt_ContactFormMessage',get_option('dt_ContactFormMessage', 'Your message: '));
		define('dt_ContactFormSendMessage',get_option('dt_ContactFormSendMessage', 'Send Message'));
		define('dt_RecaptchaHuman',get_option('dt_RecaptchaHuman', 'Are you human ?'));			
		define('dt_RecaptchaWords',get_option('dt_RecaptchaWords', 'Enter the words:'));	
		define('dt_RecaptchaAudio',get_option('dt_RecaptchaAudio', 'Enter the numbers you hear:'));			
	}
	else
	{
		//GENEARAL
		define('dt_ReadMore',__('Read more','duotive'));
		define('dt_ViewImage',__('View image','duotive'));
		define('dt_PlayVideo',__('Play video','duotive'));				
		define('dt_Permalink',__('Permalink to' ,'duotive'));
		define('dt_GoToBlog',__('Go to blog' ,'duotive'));			
		//POST RELATED
		define('dt_PostedBy',__('Posted by ','duotive'));	
		define('dt_Categories',__('Filed in: ','duotive'));	
		define('dt_Tags',__('Tags: ','duotive'));
		define('dt_RelatedTitle',__('Related posts ','duotive'));
		define('dt_RelatedProjectsTitle',__('Related projects ','duotive'));
		define('dt_ProjectsViewAll',__('View all','duotive'));						
		//SEARCH
		define('dt_NotFoundTitle',__('Not Found','duotive'));	
		define('dt_NotFoundContent',__('Apologies, but the page you requested could not be found. Perhaps searching will help.','duotive'));		
		define('dt_SearchInputBox',__('Search...','duotive'));
		define('dt_SearchResults',__('Search results for ','duotive'));	
		//ARCHIVES
		define('dt_DailyArchives',__('Daily Archives: ','duotive'));
		define('dt_MonthlyArchives',__('Monthly Archives: ','duotive'));
		define('dt_YearlyArchives',__('Yearly Archives: ','duotive'));
		define('dt_BlogArchives',__('Blog Archives','duotive'));
		define('dt_ProjectArchives',__('Project Archives','duotive'));		
		define('dt_AuthorArchives',__('Author Archives: ','duotive'));
		define('dt_CategoryArchives',__('Category Archives: ','duotive'));
		define('dt_TagArchives',__('Tag Archives: ','duotive'));	
		//AUTHOR
		define('dt_AuthorAbout',__('About ','duotive'));	
		define('dt_AuthorViewAll',__('View all posts','duotive'));
		//COMMENTS
		define('dt_Comments',__('Comments','duotive'));		
		define('dt_CommentsSays',__('says ','duotive'));	
		define('dt_CommentsFormName',__('Name:','duotive'));			
		define('dt_CommentsFormEmail',__('E-Mail:','duotive'));			
		define('dt_CommentsFormWebsite',__('Website (optional):','duotive'));
		define('dt_CommentsFormComment',__('Comment:','duotive'));										
		define('dt_CommentsPassword',__('This post is password protected. Enter the password to view any comments.','duotive'));		
		define('dt_CommentsOlder',__('Older Comments','duotive'));
		define('dt_CommentsNewer',__('Newer Comments','duotive'));		
		define('dt_CommentsLeaveReply',__('Leave a reply:'));		
		define('dt_CommentsLeaveReplyTo',__('Leave a reply to:'));
		define('dt_CommentsCancelReply',__('Cancel reply'));
		define('dt_CommentsPostComment',__('Post Comment'));	
		define('dt_CommentsRequired',__('Required fields are marked '));	
		define('dt_CommentsPublish',__('Your email address will not be published. '));			
		//CONTACT
		define('dt_ContactCaptchaEmpty',__('You forgot to fill in the security code.','duotive'));
		define('dt_ContactCaptchaError',__('The value you entered in the security field didn\'t match.','duotive'));	
		define('dt_ContactMailSuccess',__('The e-mail was sent successfully.','duotive'));
		define('dt_ContactMailError',__('The e-mail could not be sent. Please try again.','duotive'));	
		define('dt_ContactFormName',__('Full name: ','duotive'));
		define('dt_ContactFormCompany',__('Company: ','duotive'));		
		define('dt_ContactFormEmail',__('E-mail: ','duotive'));
		define('dt_ContactFormPhone',__('Phone number: ','duotive'));
		define('dt_ContactFormMessage',__('Your message: ','duotive'));
		define('dt_ContactFormSendMessage',__('Send Message','duotive'));
		define('dt_RecaptchaHuman',__('Are you human ?','duotive'));			
		define('dt_RecaptchaWords',__('Enter the words:','duotive'));
		define('dt_RecaptchaAudio',__('Enter the numbers you hear:','duotive'));			
	}
	function language_admin_menu() 
	{
		add_submenu_page( 'duotive-panel', 'Duotive Language', 'Language', 'manage_options', 'duotive-language', 'language_page');
	}

	function language_page() 
	{
		if ( isset($_POST['language_update']) && $_POST['language_update'] == 'true' ) { language_update(); }	
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
                <li><a href="admin.php?page=duotive-contact">Contact page</a></li>
	            <li class="active"><a href="admin.php?page=duotive-language">Language</a></li>                                                                                                
            </ul>
        </div>
        <div id="duotive-admin-panel">
            <h3>Translate the theme's strings</h3>
            <ul class="ui-tabs-nav">
                <li><a href="#strings-settings">General settings</a></li>
                <li><a href="#general-strings">Custom Strings</a></li>                                               
            </ul>
			<form method="POST" action="" class="transform">
            <input type="hidden" name="language_update" value="true" />            
			<div id="strings-settings" class="ui-tabs-panel">
                <div class="table-row clearfix">
                    <label for="dt_TranslationDestination">Translation:</label>
					<?php $dt_TranslationDestination = get_option('dt_TranslationDestination'); ?>                    
                    <select name="dt_TranslationDestination">
                        <option value="default" <?php if ($dt_TranslationDestination=='default') { echo 'selected'; } ?> >Use strings defined by user</option>                                                        
                        <option value="localisation" <?php if ($dt_TranslationDestination=='localisation') { echo 'selected'; } ?> >Use *.mo/*.po files or other plugin</option>
                    </select>
                    <img class="hint-icon" title="Choose whether you want to use '.mo' & '.po' files or use the Duotive 'Custom strings' language feature." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" /> 
                </div>
                <div class="table-row table-row-last clearfix">
                    <input type="submit" name="search" value="Save changes" class="button" />
                </div>                                                
                <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />                        	                    
            </div>
            <div id="general-strings" class="ui-tabs-panel">
                <div class="table-row clearfix">             
                    <label for="dt_ReadMore">Read more:</label>
                    <input type="text" size="80" name="dt_ReadMore" id="dt_ReadMore" value="<?php echo get_option('dt_ReadMore', 'Read more'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_ViewImage">View image:</label>
                    <input type="text" size="80" name="dt_ViewImage" id="dt_ViewImage" value="<?php echo get_option('dt_ViewImage', 'View image'); ?>" />              
                </div>  
                <div class="table-row clearfix">             
                    <label for="dt_PlayVideo">Play video:</label>
                    <input type="text" size="80" name="dt_PlayVideo" id="dt_PlayVideo" value="<?php echo get_option('dt_PlayVideo', 'Play video'); ?>" />              
                </div>                                
                <div class="table-row clearfix">             
                    <label for="dt_Permalink">Permalink:</label>
                    <input type="text" size="80" name="dt_Permalink" id="dt_Permalink" value="<?php echo get_option('dt_Permalink', 'Permalink to '); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_GoToBlog">Go to blog:</label>
                    <input type="text" size="80" name="dt_GoToBlog" id="dt_GoToBlog" value="<?php echo get_option('dt_GoToBlog', 'Go to blog'); ?>" />              
                </div>                
                <div class="table-row clearfix">             
                    <label for="dt_PostedBy">Posted by:</label>
                    <input type="text" size="80" name="dt_PostedBy" id="dt_PostedBy" value="<?php echo get_option('dt_PostedBy', 'Posted by '); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_Categories">Categories:</label>
                    <input type="text" size="80" name="dt_Categories" id="dt_Categories" value="<?php echo get_option('dt_Categories', 'Filed in: '); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_Tags">Tags:</label>
                    <input type="text" size="80" name="dt_Tags" id="dt_Tags" value="<?php echo get_option('dt_Tags', 'Tags: '); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_RelatedTitle">Related title:</label>
                    <input type="text" size="80" name="dt_RelatedTitle" id="dt_RelatedTitle" value="<?php echo get_option('dt_RelatedTitle', 'Related posts'); ?>" />              
                </div> 
                <div class="table-row clearfix">             
                    <label for="dt_RelatedProjectsTitle">Related projects title:</label>
                    <input type="text" size="80" name="dt_RelatedProjectsTitle" id="dt_RelatedProjectsTitle" value="<?php echo get_option('dt_RelatedProjectsTitle', 'Related projects'); ?>" />              
                </div> 
                <div class="table-row clearfix">             
                    <label for="dt_ProjectsViewAll">View all projects filter:</label>
                    <input type="text" size="80" name="dt_ProjectsViewAll" id="dt_ProjectsViewAll" value="<?php echo get_option('dt_ProjectsViewAll', 'View all'); ?>" />              
                </div>                                                
                <div class="table-row clearfix">             
                    <label for="dt_NotFoundTitle">Not Found Title:</label>
                    <input type="text" size="80" name="dt_NotFoundTitle" id="dt_NotFoundTitle" value="<?php echo get_option('dt_NotFoundTitle', 'Not Found'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_NotFoundContent">Not Found Content:</label>
                    <input type="text" size="80" name="dt_NotFoundContent" id="dt_NotFoundContent" value="<?php echo get_option('dt_NotFoundContent', 'Apologies, but the page you requested could not be found. Perhaps searching will help.'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_SearchInputBox">Search input:</label>
                    <input type="text" size="80" name="dt_SearchInputBox" id="dt_SearchInputBox" value="<?php echo get_option('dt_SearchInputBox', 'Search...'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_SearchResults">Search results:</label>
                    <input type="text" size="80" name="dt_SearchResults" id="dt_SearchResults" value="<?php echo get_option('dt_SearchResults', 'Search results for '); ?>" />              
                </div> 
                <div class="table-row clearfix">             
                    <label for="dt_DailyArchives">Daily Archives:</label>
                    <input type="text" size="80" name="dt_DailyArchives" id="dt_DailyArchives" value="<?php echo get_option('dt_DailyArchives', 'Daily Archives: '); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_MonthlyArchives">Monthly Archives:</label>
                    <input type="text" size="80" name="dt_MonthlyArchives" id="dt_MonthlyArchives" value="<?php echo get_option('dt_MonthlyArchives', 'Monthly Archives: '); ?>" />              
                </div>                          
                <div class="table-row clearfix">             
                    <label for="dt_YearlyArchives">Yearly Archives:</label>
                    <input type="text" size="80" name="dt_YearlyArchives" id="dt_YearlyArchives" value="<?php echo get_option('dt_YearlyArchives', 'Yearly Archives: '); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_BlogArchives">Blog Archives:</label>
                    <input type="text" size="80" name="dt_BlogArchives" id="dt_BlogArchives" value="<?php echo get_option('dt_BlogArchives', 'Blog Archives'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_ProjectArchives">Project Archives:</label>
                    <input type="text" size="80" name="dt_ProjectArchives" id="dt_ProjectArchives" value="<?php echo get_option('dt_ProjectArchives', 'Project Archives'); ?>" />              
                </div>                 
                <div class="table-row clearfix">             
                    <label for="dt_AuthorArchives">Author Archives:</label>
                    <input type="text" size="80" name="dt_AuthorArchives" id="dt_AuthorArchives" value="<?php echo get_option('dt_AuthorArchives', 'Author Archives: '); ?>" />              
                </div>                                                                                                                                                                                                                            
                <div class="table-row clearfix">             
                    <label for="dt_CategoryArchives">Category Archives:</label>
                    <input type="text" size="80" name="dt_CategoryArchives" id="dt_CategoryArchives" value="<?php echo get_option('dt_CategoryArchives', 'Category Archives: '); ?>" />              
                </div>                                                                                                                                                                                                                            
                <div class="table-row clearfix">             
                    <label for="dt_TagArchives">Tag Archives:</label>
                    <input type="text" size="80" name="dt_TagArchives" id="dt_TagArchives" value="<?php echo get_option('dt_TagArchives', 'Tag Archives: '); ?>" />              
                </div> 
                <div class="table-row clearfix">             
                    <label for="dt_AuthorAbout">Author About:</label>
                    <input type="text" size="80" name="dt_AuthorAbout" id="dt_AuthorAbout" value="<?php echo get_option('dt_AuthorAbout', 'About '); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_AuthorViewAll">Author View All:</label>
                    <input type="text" size="80" name="dt_AuthorViewAll" id="dt_AuthorViewAll" value="<?php echo get_option('dt_AuthorViewAll', 'View all posts'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_Comments">Comments:</label>
                    <input type="text" size="80" name="dt_Comments" id="dt_Comments" value="<?php echo get_option('dt_Comments', 'Comments'); ?>" />              
                </div>                   
                <div class="table-row clearfix">             
                    <label for="dt_CommentsSays">Comment author says:</label>
                    <input type="text" size="80" name="dt_CommentsSays" id="dt_CommentsSays" value="<?php echo get_option('dt_CommentsSays', 'says '); ?>" />              
                </div>   
                <div class="table-row clearfix">             
                    <label for="dt_CommentsFormName">Comment form name:</label>
                    <input type="text" size="80" name="dt_CommentsFormName" id="dt_CommentsFormName" value="<?php echo get_option('dt_CommentsFormName', 'Name:'); ?>" />              
                </div>  
                <div class="table-row clearfix">             
                    <label for="dt_CommentsFormEmail">Comment form e-mail:</label>
                    <input type="text" size="80" name="dt_CommentsFormEmail" id="dt_CommentsFormEmail" value="<?php echo get_option('dt_CommentsFormEmail', 'E-Mail:'); ?>" />              
                </div>                                    
                <div class="table-row clearfix">             
                    <label for="dt_CommentsFormWebsite">Comment form website:</label>
                    <input type="text" size="80" name="dt_CommentsFormWebsite" id="dt_CommentsFormWebsite" value="<?php echo get_option('dt_CommentsFormWebsite', 'Website (optional):'); ?>" />              
                </div> 
                <div class="table-row clearfix">             
                    <label for="dt_CommentsFormComment">Comment form comment:</label>
                    <input type="text" size="80" name="dt_CommentsFormComment" id="dt_CommentsFormComment" value="<?php echo get_option('dt_CommentsFormComment', 'Comment:'); ?>" />              
                </div>                                 
                <div class="table-row clearfix">             
                    <label for="dt_CommentsPassword">Password Comments:</label>
                    <input type="text" size="80" name="dt_CommentsPassword" id="dt_CommentsPassword" value="<?php echo get_option('dt_CommentsPassword', 'This post is password protected. Enter the password to view any comments.'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_CommentsOlder">Older Comments:</label>
                    <input type="text" size="80" name="dt_CommentsOlder" id="dt_CommentsOlder" value="<?php echo get_option('dt_CommentsOlder', 'Older Comments'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_CommentsNewer">Newer Comments:</label>
                    <input type="text" size="80" name="dt_CommentsNewer" id="dt_CommentsNewer" value="<?php echo get_option('dt_CommentsNewer', 'Newer Comments'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_CommentsLeaveReply">Leave a reply:</label>
                    <input type="text" size="80" name="dt_CommentsLeaveReply" id="dt_CommentsLeaveReply" value="<?php echo get_option('dt_CommentsLeaveReply', 'Leave a reply:'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_CommentsLeaveReplyTo">Leave a reply to:</label>
                    <input type="text" size="80" name="dt_CommentsLeaveReplyTo" id="dt_CommentsLeaveReplyTo" value="<?php echo get_option('dt_CommentsLeaveReplyTo', 'Leave a reply to:'); ?>" />              
                </div>                                
                <div class="table-row clearfix">             
                    <label for="dt_CommentsCancelReply">Cancel reply:</label>
                    <input type="text" size="80" name="dt_CommentsCancelReply" id="dt_CommentsCancelReply" value="<?php echo get_option('dt_CommentsCancelReply', 'Cancel reply'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_CommentsPostComment">Post comment:</label>
                    <input type="text" size="80" name="dt_CommentsPostComment" id="dt_CommentsPostComment" value="<?php echo get_option('dt_CommentsPostComment', 'Post Comment'); ?>" />              
                </div>                
                <div class="table-row clearfix">             
                    <label for="dt_CommentsRequired">Required field:</label>
                    <input type="text" size="80" name="dt_CommentsRequired" id="dt_CommentsRequired" value="<?php echo get_option('dt_CommentsRequired', 'Required fields are marked '); ?>" />              
                </div>                
                <div class="table-row clearfix">             
                    <label for="dt_CommentsPublish">Publish details:</label>
                    <input type="text" size="80" name="dt_CommentsPublish" id="dt_CommentsPublish" value="<?php echo get_option('dt_CommentsPublish', 'Your email address will not be published.  '); ?>" />              
                </div>                
                <div class="table-row clearfix">             
                    <label for="dt_ContactCaptchaEmpty">Contact Empty Captcha:</label>
                    <input type="text" size="80" name="dt_ContactCaptchaEmpty" id="dt_ContactCaptchaEmpty" value="<?php echo get_option('dt_ContactCaptchaEmpty', 'You forgot to fill in the security code.'); ?>" />              
                </div> 
                <div class="table-row clearfix">             
                    <label for="dt_ContactCaptchaError">Contact Captcha Error:</label>
                    <input type="text" size="80" name="dt_ContactCaptchaError" id="dt_ContactCaptchaError" value="<?php echo get_option('dt_ContactCaptchaError', 'The value you entered in the security field didn\'t match.'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_ContactMailSuccess">Contact Mail Success:</label>
                    <input type="text" size="80" name="dt_ContactMailSuccess" id="dt_ContactMailSuccess" value="<?php echo get_option('dt_ContactMailSuccess', 'The e-mail was sent successfully.'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_ContactMailError">Contact Mail Error:</label>
                    <input type="text" size="80" name="dt_ContactMailError" id="dt_ContactMailError" value="<?php echo get_option('dt_ContactMailError', 'The e-mail could not be sent. Please try again.'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_ContactFormName">Contact Form Name:</label>
                    <input type="text" size="80" name="dt_ContactFormName" id="dt_ContactFormName" value="<?php echo get_option('dt_ContactFormName', 'Full name: '); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_ContactFormCompany">Contact Form Company:</label>
                    <input type="text" size="80" name="dt_ContactFormCompany" id="dt_ContactFormCompany" value="<?php echo get_option('dt_ContactFormCompany', 'Company: '); ?>" />              
                </div>                                                                                                                                                       
                <div class="table-row clearfix">             
                    <label for="dt_ContactFormEmail">Contact Form E-mail:</label>
                    <input type="text" size="80" name="dt_ContactFormEmail" id="dt_ContactFormEmail" value="<?php echo get_option('dt_ContactFormEmail', 'E-mail: '); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_ContactFormPhone">Contact Form Phone:</label>
                    <input type="text" size="80" name="dt_ContactFormPhone" id="dt_ContactFormPhone" value="<?php echo get_option('dt_ContactFormPhone', 'Phone number: '); ?>" />              
                </div> 
                <div class="table-row clearfix">             
                    <label for="dt_ContactFormMessage">Contact Form Message:</label>
                    <input type="text" size="80" name="dt_ContactFormMessage" id="dt_ContactFormMessage" value="<?php echo get_option('dt_ContactFormMessage', 'Your message: '); ?>" />              
                </div> 
                <div class="table-row clearfix">             
                    <label for="dt_ContactFormSendMessage">Contact Form Button:</label>
                    <input type="text" size="80" name="dt_ContactFormSendMessage" id="dt_ContactFormSendMessage" value="<?php echo get_option('dt_ContactFormSendMessage', 'Send Message'); ?>" />              
                </div>
                <div class="table-row clearfix">             
                    <label for="dt_RecaptchaHuman">Contact Form Recaptcha Human:</label>
                    <input type="text" size="80" name="dt_RecaptchaHuman" id="dt_RecaptchaHuman" value="<?php echo get_option('dt_RecaptchaHuman', 'Are you human ?'); ?>" />              
                </div>                    
                <div class="table-row clearfix">             
                    <label for="dt_RecaptchaWords">Contact Form Recaptcha Words:</label>
                    <input type="text" size="80" name="dt_RecaptchaWords" id="dt_RecaptchaWords" value="<?php echo get_option('dt_RecaptchaWords', 'Enter the words:'); ?>" />              
                </div>  
                <div class="table-row clearfix">             
                    <label for="dt_RecaptchaAudio">Contact Form Recaptcha Audio:</label>
                    <input type="text" size="80" name="dt_RecaptchaAudio" id="dt_RecaptchaAudio" value="<?php echo get_option('dt_RecaptchaAudio', 'Enter the numbers you hear:'); ?>" />              
                </div>                                                                                                                                                                                                                                                                                 
                <div class="table-row table-row-last clearfix">
                    <input type="submit" name="search" value="Save changes" class="button" />
                </div>                                                
                <input id="setting-up-save" type="submit" name="search" value="Save changes" class="button" />             
            </div>
		</form>
	</div>	        
<?php
	}
	function language_update()
	{
		update_option('dt_TranslationDestination',stripslashes($_POST['dt_TranslationDestination']));
		update_option('dt_ReadMore',stripslashes($_POST['dt_ReadMore']));
		update_option('dt_ViewImage',stripslashes($_POST['dt_ViewImage']));
		update_option('dt_PlayVideo',stripslashes($_POST['dt_PlayVideo']));				
		update_option('dt_Permalink',stripslashes($_POST['dt_Permalink']));
		update_option('dt_GoToBlog',stripslashes($_POST['dt_GoToBlog']));		
		update_option('dt_PostedBy',stripslashes($_POST['dt_PostedBy']));
		update_option('dt_Categories',stripslashes($_POST['dt_Categories']));
		update_option('dt_Tags',stripslashes($_POST['dt_Tags']));
		update_option('dt_RelatedTitle',stripslashes($_POST['dt_RelatedTitle']));
		update_option('dt_RelatedProjectsTitle',stripslashes($_POST['dt_RelatedProjectsTitle']));
		update_option('dt_ProjectsViewAll',stripslashes($_POST['dt_ProjectsViewAll']));						
		update_option('dt_NotFoundTitle',stripslashes($_POST['dt_NotFoundTitle']));
		update_option('dt_NotFoundContent',stripslashes($_POST['dt_NotFoundContent']));
		update_option('dt_SearchInputBox',stripslashes($_POST['dt_SearchInputBox']));
		update_option('dt_SearchResults',stripslashes($_POST['dt_SearchResults']));
		update_option('dt_DailyArchives',stripslashes($_POST['dt_DailyArchives']));
		update_option('dt_MonthlyArchives',stripslashes($_POST['dt_MonthlyArchives']));
		update_option('dt_YearlyArchives',stripslashes($_POST['dt_YearlyArchives']));
		update_option('dt_BlogArchives',stripslashes($_POST['dt_BlogArchives']));
		update_option('dt_ProjectArchives',stripslashes($_POST['dt_ProjectArchives']));	
		update_option('dt_AuthorArchives',stripslashes($_POST['dt_AuthorArchives']));
		update_option('dt_CategoryArchives',stripslashes($_POST['dt_CategoryArchives']));
		update_option('dt_TagArchives',stripslashes($_POST['dt_TagArchives']));
		update_option('dt_AuthorAbout',stripslashes($_POST['dt_AuthorAbout']));
		update_option('dt_AuthorViewAll',stripslashes($_POST['dt_AuthorViewAll']));
		update_option('dt_Comments',stripslashes($_POST['dt_Comments']));		
		update_option('dt_CommentsSays',stripslashes($_POST['dt_CommentsSays']));	
		update_option('dt_CommentsFormName',stripslashes($_POST['dt_CommentsFormName']));			
		update_option('dt_CommentsFormEmail',stripslashes($_POST['dt_CommentsFormEmail']));			
		update_option('dt_CommentsFormWebsite',stripslashes($_POST['dt_CommentsFormWebsite']));			
		update_option('dt_CommentsFormComment',stripslashes($_POST['dt_CommentsFormComment']));									
		update_option('dt_CommentsPassword',stripslashes($_POST['dt_CommentsPassword']));
		update_option('dt_CommentsOlder',stripslashes($_POST['dt_CommentsOlder']));	
		update_option('dt_CommentsNewer',stripslashes($_POST['dt_CommentsNewer']));	
		update_option('dt_CommentsLeaveReply',stripslashes($_POST['dt_CommentsLeaveReply']));			
		update_option('dt_CommentsLeaveReplyTo',stripslashes($_POST['dt_CommentsLeaveReplyTo']));					
		update_option('dt_CommentsCancelReply',stripslashes($_POST['dt_CommentsCancelReply']));							
		update_option('dt_CommentsPostComment',stripslashes($_POST['dt_CommentsPostComment']));									
		update_option('dt_CommentsRequired',stripslashes($_POST['dt_CommentsRequired']));											
		update_option('dt_CommentsPublish',stripslashes($_POST['dt_CommentsPublish']));													
		update_option('dt_ContactCaptchaEmpty',stripslashes($_POST['dt_ContactCaptchaEmpty']));	
		update_option('dt_ContactCaptchaError',stripslashes($_POST['dt_ContactCaptchaError']));	
		update_option('dt_ContactMailSuccess',stripslashes($_POST['dt_ContactMailSuccess']));	
		update_option('dt_ContactMailError',stripslashes($_POST['dt_ContactMailError']));	
		update_option('dt_ContactFormName',stripslashes($_POST['dt_ContactFormName']));	
		update_option('dt_ContactFormEmail',stripslashes($_POST['dt_ContactFormEmail']));
		update_option('dt_ContactFormCompany',stripslashes($_POST['dt_ContactFormCompany']));
		update_option('dt_ContactFormPhone',stripslashes($_POST['dt_ContactFormPhone']));					
		update_option('dt_ContactFormSubject',stripslashes($_POST['dt_ContactFormSubject']));
		update_option('dt_ContactFormMessage',stripslashes($_POST['dt_ContactFormMessage']));
		update_option('dt_ContactFormSendMessage',stripslashes($_POST['dt_ContactFormSendMessage']));
		update_option('dt_RecaptchaHuman',stripslashes($_POST['dt_RecaptchaHuman']));
		update_option('dt_RecaptchaWords',stripslashes($_POST['dt_RecaptchaWords']));
		update_option('dt_RecaptchaAudio',stripslashes($_POST['dt_RecaptchaAudio']));																																																																							
	}	
	add_action('admin_menu', 'language_admin_menu');

?>
