<?php
//CREATE DATABASE
	//CREATE FUNCTION
	function create_db_frontpage () {
		global $wpdb;
		$create_query = 'CREATE TABLE `'.$wpdb->prefix.'dt-frontpages` (
							`ID` INT NOT NULL AUTO_INCREMENT ,
							`NAME` TEXT NOT NULL ,
							`DESCRIPTION` TEXT NOT NULL,
							PRIMARY KEY ( `ID` )
						) ENGINE = MYISAM ;
						';
		$create = $wpdb->get_results($create_query);
	}
	//CHECK FUNCTION
	function check_db_existance($table) {
		global $wpdb;
		if($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) return FALSE;
		else return TRUE;
	}
		
	global $wpdb;
	if ( check_db_existance($wpdb->prefix.'dt-frontpages') == '') create_db_frontpage();
	//INSERT FUNCTION
	function check_frontpage_existance($name) {
		global $wpdb;		
		$frontpage_existance_query = 'SELECT * FROM `'.$wpdb->prefix.'dt-frontpages` WHERE NAME="'.$name.'"';	
		$frontpage_existance = $wpdb->get_results($frontpage_existance_query);  
		if ( isset($frontpage_existance[0]->NAME ) ) return 1;
		else return 0;		
	}
	function insert_frontpage_in_db( $name='no-title',$description='no-text') {
			if ( check_frontpage_existance($name) == 0 )
			{
				global $wpdb;
				$name = preg_replace("/[^a-zA-Z0-9\s]/", "", $name);
				$description = preg_replace("/[^a-zA-Z0-9\s]/", "", $description);				
				$insert_query = "INSERT INTO `".$wpdb->prefix."dt-frontpages` (`ID`, `NAME`, `DESCRIPTION`) VALUES ('NULL', '".$name."', '".$description."');";
				$insert = $wpdb->get_results($insert_query);
			}
	}	
	//DELETE frontpage FORM DB
	function deleteOptions($id)
	{
		delete_option('dt_FrontPageIntro_'.$id);
		delete_option('dt_FrontPageIntroOnly_'.$id);
		delete_option('dt_FrontPageIntroHeading_'.$id);
		delete_option('dt_FrontPageIntroMainParagraph_'.$id);
		delete_option('dt_FrontPageIntroSecondaryParagraph_'.$id);
		delete_option('dt_FrontPageWidgets_'.$id);
		delete_option('dt_FrontPageWidgetNumber_'.$id);
		delete_option('dt_FrontPagePosts_'.$id);
		delete_option('dt_FrontPagePostsCount_'.$id);
		delete_option('dt_FrontPagePostsCategory_'.$id);
		delete_option('dt_FrontPageLatestNews_'.$id);
		delete_option('dt_FrontPageLatestNewsWidth_'.$id);
		delete_option('dt_FrontPageLatestHeading_'.$id);
		delete_option('dt_FrontPageLatestPostsCount_'.$id);
		delete_option('dt_FrontPageLatestCategory_'.$id);
		delete_option('dt_FrontPageSlideshow_'.$id);
		delete_option('dt_FrontPageSlideshowWidth_'.$id);
		delete_option('dt_FrontPageSlideshowHeading_'.$id);
		delete_option('dt_FrontPageSlideshowImages_'.$id);
		delete_option('dt_FrontPageSlideshowHeight_'.$id);
		delete_option('dt_FrontPageSlideshowTransition_'.$id);
		delete_option('dt_FrontPageSlideshowPause_'.$id);
		delete_option('dt_FrontPageSlideshowSlices_'.$id);
		delete_option('dt_FrontPageSlideshowBoxCols_'.$id);
		delete_option('dt_FrontPageSlideshowBoxRows_'.$id);
		delete_option('dt_FrontPageSlideshowText_'.$id);
		delete_option('dt_FrontPageSlideshowUrl_'.$id);
		delete_option('dt_FrontPageSlideshowButton_'.$id);
		delete_option('dt_FrontPageTabs_'.$id);
		delete_option('dt_FrontPageTabsHeading_'.$id);
		delete_option('dt_FrontPageTabsWidth_'.$id);
		delete_option('dt_FrontPageTabsElementHeading_01_'.$id);
		delete_option('dt_FrontPageTabsElementContent_01_'.$id);
		delete_option('dt_FrontPageTabsElementHeading_02_'.$id);
		delete_option('dt_FrontPageTabsElementContent_02_'.$id);
		delete_option('dt_FrontPageTabsElementHeading_03_'.$id);
		delete_option('dt_FrontPageTabsElementContent_03_'.$id);
		delete_option('dt_FrontPageTabsElementHeading_04_'.$id);
		delete_option('dt_FrontPageTabsElementContent_04_'.$id);
		delete_option('dt_FrontPageTabsElementHeading_05_'.$id);
		delete_option('dt_FrontPageTabsElementContent_05_'.$id);
		delete_option('dt_FrontPageTabsElementHeading_06_'.$id);
		delete_option('dt_FrontPageTabsElementContent_06_'.$id);
		delete_option('dt_FrontPageTabsElementHeading_07_'.$id);
		delete_option('dt_FrontPageTabsElementContent_07_'.$id);
		delete_option('dt_FrontPageTabsElementHeading_08_'.$id);
		delete_option('dt_FrontPageTabsElementContent_08_'.$id);
		delete_option('dt_FrontPageFromBlog_'.$id);
		delete_option('dt_FrontPageFromBlogWidth_'.$id);
		delete_option('dt_FrontPageFromBlogHeading_'.$id);
		delete_option('dt_FrontPageFromBlogCategory_'.$id);
		delete_option('dt_FrontPageFromBlogCount_'.$id);
		delete_option('dt_FrontPageFromBlogMore_'.$id);		
		delete_option('dt_FrontLatestWork_'.$id);
		delete_option('dt_FrontLatestWorkHeading_'.$id);
		delete_option('dt_FrontLatestWorkPortfolio_'.$id);
		delete_option('dt_FrontLatestWorkPortfolioCount_'.$id);
		delete_option('dt_FrontLatestWorkDesc_'.$id);
		delete_option('dt_FrontLatestWorkDescHeading_'.$id);
		delete_option('dt_FrontLatestWorkDescDescription_'.$id);
		delete_option('dt_FrontLatestWorkDescButtonText_'.$id);
		delete_option('dt_FrontLatestWorkDescButtonUrl_'.$id);
		delete_option('dt_FrontLatestWorkDescPortfolio_'.$id);
		delete_option('dt_FrontLatestWorkDescCount_'.$id);
		delete_option('dt_FrontCallToAction_'.$id);
		delete_option('dt_FrontCallToActionText_'.$id);
		delete_option('dt_FrontCallToActionButtonText_'.$id);
		delete_option('dt_FrontCallToActionButtonUrl_'.$id);
		delete_option('dt_FrontPageContact_'.$id);
		delete_option('dt_FrontPageContactHeading_'.$id);
		delete_option('dt_FrontPageContactRecaptcha_'.$id);
		delete_option('dt_FrontPageContactDestination_'.$id);
		delete_option('dt_FrontPageContactField1_'.$id);
		delete_option('dt_FrontPageContactField2_'.$id);
		delete_option('dt_FrontPageContactField3_'.$id);
		delete_option('dt_FrontPageContactField4_'.$id);
		delete_option('dt_FrontPageContactField5_'.$id);
		delete_option('dt_FrontPageContent_'.$id);
		delete_option('dt_FrontPagePartners_'.$id);
		delete_option('dt_FrontPagePartnersTitle_'.$id);
		delete_option('dt_FrontPagePartnersDetails_'.$id);
	}
	function delete_frontpage($id) {
		global $wpdb;			
		$delete_query = 'DELETE FROM `'.$wpdb->prefix.'dt-frontpages` WHERE ID="'.$id.'" LIMIT 1';	
		$wpdb->get_results($delete_query);	
		deleteOptions($id);
	}	
	//GET PORTFOLIO PAGES FORM DB
	function frontpages_require () {
		global $wpdb;		
		$frontpages_require_query = 'SELECT * FROM `'.$wpdb->prefix.'dt-frontpages` ORDER BY ID ASC';	
		$frontpages_require = $wpdb->get_results($frontpages_require_query);
		return $frontpages_require;
	}	
	
function fpm_admin_menu() 
{
	// ADD THE FPM OPTIONS PAGE TO ADMIN SIDEBAR
	add_submenu_page( 'duotive-panel', 'Duotive Front Page Options', 'Frontpage', 'manage_options', 'duotive-front-page-manager', 'fpm_page');
}

function fpm_page() 
{
	// THE ACTUAL OPTIONS PAGE
?>	
    <?php if(isset($_POST['name']) && $_POST['name'] != '') : ?>
		<?php if(isset($_POST['name']) && $_POST['name'] != '') $name =  $_POST['name'];  ?>
        <?php if(isset($_POST['description'])) $desc = $_POST['description']; else $desc = 'frontpage created by duotive frontpage generator.'; if ( $desc == '' ) $desc = 'frontpage created by duotive frontpage generator.';  ?> 
        <?php if(isset($_POST['name'])) insert_frontpage_in_db($name,$desc); ?>
        <?php if(isset($_GET['delete'])) delete_frontpage($_GET['delete']); // IF CALLED DELETES A frontpage ?>    
    <?php endif; ?>
    <?php if(isset($_GET['delete'])) delete_frontpage($_GET['delete']); // IF CALLED DELETES A frontpage ?>
    <?php if ( isset($_POST['front_page_update']) && $_POST['front_page_update'] != '') { front_page_update($_POST['front_page_update']); } // UPDATE OPTIONS ?>   								            
    <div id="dialog" title="Confirmation Required" style="display:none;">
      You are about to delete a frontpage. Continue?
    </div>   
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
            	<li class="active"><a href="admin.php?page=duotive-front-page-manager">Frontpage</a></li>
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
        	<h3>Frontpage</h3>
            <?php if ( isset($_GET['tab']) ) $currentPageTab = $_GET['tab']; else $currentPageTab = 'frontpages'; ?>
        	<ul class="ui-tabs-nav">
                <li<?php if ( $currentPageTab == 'frontpages') echo ' class="ui-state-active"'; ?>><a href="admin.php?page=duotive-front-page-manager&tab=frontpages">Current frontpages</a></li> 
                <li class="plus<?php if ( $currentPageTab == 'addfrontpage') echo ' ui-state-active'; ?>"><a class="plus" href="admin.php?page=duotive-front-page-manager&tab=addfrontpage"><span class="deco"></span>Add a new frontpage</a></li>    
                <?php $frontpages = frontpages_require();?> 
                <?php if ( count($frontpages) > 0 ): ?>         
            	<?php foreach($frontpages as $frontpage ): ?>
            		<li<?php if ( $currentPageTab == $frontpage->ID) echo ' class="ui-state-active"'; ?>><a href="admin.php?page=duotive-front-page-manager&tab=<?php echo $frontpage->ID; ?>"><?php echo $frontpage->NAME; ?></a></li>
                <?php endforeach; ?>         
                <?php endif; ?>
            </ul>
            <?php if ( isset($_GET['tab']) ) $currentPageTab = $_GET['tab']; else $currentPageTab = 'frontpages'; ?>
            <?php if ( $currentPageTab == 'frontpages' ): ?>
                <div id="frontpages" class="ui-tabs-panel">
                    <?php $frontpages = frontpages_require();?>
                    <?php if ( count($frontpages) > 0 ): ?>
                        <table cellpadding="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th align="center">Delete</th>                                        
                                </tr>
                            </thead>
                            <tbody>  
                                <?php $i = 0; ?>
                                <?php foreach ( $frontpages as $frontpage): ?>
                                    <tr <?php if ( $i%2 == 0 ) echo ' class = "alternate"'; ?>>
                                        <td align="center">
                                            <?php echo $frontpage->NAME; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo $frontpage->DESCRIPTION; ?>
                                        </td>
                                        <td align="center">
                                            <a class="delete confirmLink" title="Delete Frontpage Layout" href="?page=duotive-front-page-manager&delete=<?php echo $frontpage->ID; ?>">DELETE</a> 
                                        </td>
                                    </tr>
                                <?php $i++; ?>  
                                <?php endforeach; ?>                                                                     
                            </tbody>            
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Delete</th>                                        
                                </tr>
                            </tfoot>     
                        </table> 
                    <?php else: ?>
                        <div class="page-error">There aren't any custom frontpages added yet.</div>                            
                    <?php endif; ?>               
                </div>
            <?php endif; ?>
            <?php if ( isset($_GET['tab']) ) $currentPageTab = $_GET['tab']; else $currentPageTab = 'frontpages'; ?>
            <?php if ( $currentPageTab == 'addfrontpage' ): ?>
                <div id="addfrontpage" class="ui-tabs-panel">
                    <form action="" method="post" class="transform">
                        <div class="table-row clearfix">
                            <label for="name">Frontpage name:</label>
                            <input size="50" name="name" type="text"  />
                        </div>
                        <div class="table-row clearfix">
                            <label for="description">Frontpage description:</label>
                            <textarea class="fullwidth" name="description" cols="50" rows="4"></textarea>
                        </div>
                        <div class="table-row table-row-last clearfix">
                            <input type="submit" value="Add frontpage" class="button" />	
                        </div>	          
                    </form>
                </div>      
            <?php endif; ?>  
            <?php if ( isset($_GET['tab']) ) $currentPageTab = $_GET['tab']; else $currentPageTab = 'frontpages'; ?>               
			<?php if ( is_numeric($currentPageTab) ): ?>
            <?php $id = $currentPageTab; ?>
			<script type="text/javascript">
                jQuery(document).ready(function() {	
                    jQuery("#frontpage-<?php echo $id; ?>-rows").sortable({placeholder: "ui-state-highlight frontpage-box", handle: '.front-page-row-handle', axis: 'y', items: 'li:not(.ui-state-disabled)'});
                    jQuery("#frontpage-<?php echo $id; ?>-rows").bind( "sortstop", function(event, ui) {
                        var order = '';														  	
                        jQuery("#frontpage-<?php echo $id; ?>-rows li").each(function(index) {		
                            if ( jQuery(this).attr('id') ) order += jQuery(this).attr('id') + ',' ;												  
                        });
                        order = 'order=' + order + '&id=<?php echo $id; ?>';
                        jQuery.get("<?php echo get_template_directory_uri(); ?>/includes/duotive-admin/duotive-front-page-order.php", order, function(theResponse){
                            jQuery("#frontpage-<?php echo $id; ?> .frontpage-status").html(theResponse);
							jQuery("#frontpage-<?php echo $id; ?> .frontpage-status").css('display','block');
							jQuery("#frontpage-<?php echo $id; ?> .frontpage-status").html(theResponse);
							jQuery("#frontpage-<?php echo $id; ?> .frontpage-status").delay(6000).fadeOut("slow");
                        });			
                    });	  
                });	
            </script>             
            <div id="frontpage-<?php echo $id; ?>" class="front-page-elements ui-tabs-panel">
            	<div class="frontpage-status"></div>
                <form method="POST" action="" class="transform">
                    <input type="hidden" name="front_page_update" value="<?php echo $id; ?>" />
                    <ul id="frontpage-<?php echo $id; ?>-rows" class="frontpage-rows">
                        <?php $frontpage_order = get_option('frontpage-order-'.$id, 'row-intro,row-widgets,row-page-content,row-posts,row-latest-news,row-slideshow,row-tabs,row-from-blog,row-latest-work,row-latest-work-description,row-calltoaction,row-contact,row-partners'); ?>
                        <?php $frontpage_rows = explode(',',$frontpage_order); ?>
                        <?php foreach($frontpage_rows as $frontpage_row): ?>
                            <?php if ( $frontpage_row == 'row-intro' ) : ?> 
                                <li id="row-intro" class="frontpage-box ui-state-disabled">
                                  	<input type="hidden" name="dt_FrontPageIntroWidth_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageIntroWidth_'.$id, 'full-width'); ?>" />                                
                                    <div class="row-header">Intro paragraph<span class="disabled">(not sortable)</span><span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageIntro_<?php echo $id; ?>">Status:</label>
                                            <select name="dt_FrontPageIntro_<?php echo $id; ?>">
                                                <?php $dt_FrontPageIntro = get_option('dt_FrontPageIntro_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontPageIntro=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontPageIntro=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                            <img class="hint-icon" title="Enable or Disable the intro message paragraph on the front page." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageIntroOnly_<?php echo $id; ?>">Enable intro paragraph only?</label>
                                            <select name="dt_FrontPageIntroOnly_<?php echo $id; ?>">
                                                <?php $dt_FrontPageIntroOnly = get_option('dt_FrontPageIntroOnly_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontPageIntroOnly=='yes') { echo 'selected'; } ?> >Yes</option>
                                                <option value="no" <?php if ($dt_FrontPageIntroOnly=='no') { echo 'selected'; } ?>>No</option>
                                            </select>
                                            <img class="hint-icon" title=" If you'd like the 'Intro paragraph' to be the only element on your frontpage, please choose Yes.  Also make sure you don't have anything else enabled." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageIntroHeading_<?php echo $id; ?>">Title:</label>
                                            <input type="text" size="50" name="dt_FrontPageIntroHeading_<?php echo $id; ?>" id="dt_FrontPageIntroHeading_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageIntroHeading_'.$id); ?>" />              
                                        </div>   
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageIntroMainParagraph_<?php echo $id; ?>">Main intro paragraph:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontPageIntroMainParagraph_<?php echo $id; ?>"><?php echo get_option('dt_FrontPageIntroMainParagraph_'.$id); ?></textarea>              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageIntroSecondaryParagraph_<?php echo $id; ?>">Secondary intro paragraph:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontPageIntroSecondaryParagraph_<?php echo $id; ?>"><?php echo get_option('dt_FrontPageIntroSecondaryParagraph_'.$id); ?></textarea>              
                                        </div>
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>                                                                                                                                                                                 
                                    </div>                                             
                                </li>
                            <?php endif; ?>
                            <?php if ( $frontpage_row == 'row-widgets' ) : ?> 
                                <li id="row-widgets" class="frontpage-box">
                                  	<input type="hidden" name="dt_FrontPageIntroWidth_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageIntroWidth_'.$id, 'full-width'); ?>" />                                
                                    <div class="row-header">Widgets<span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageWidgets_<?php echo $id; ?>">Status:</label>
                                            <select name="dt_FrontPageWidgets_<?php echo $id; ?>">
                                                <?php $dt_FrontPageWidgets = get_option('dt_FrontPageWidgets_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontPageWidgets=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontPageWidgets=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                        </div>                                    
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageWidgetNumber_<?php echo $id; ?>">Number of widget areas:</label>
                                            <select name="dt_FrontPageWidgetNumber_<?php echo $id; ?>">
                                                <?php $dt_FrontPageWidgetNumber = get_option('dt_FrontPageWidgetNumber_'.$id, 'no');?>
                                                <option value="1" <?php if ($dt_FrontPageWidgetNumber=='1') { echo 'selected'; } ?> >1</option>                                                
                                                <option value="2" <?php if ($dt_FrontPageWidgetNumber=='2') { echo 'selected'; } ?> >2</option>
                                                <option value="3" <?php if ($dt_FrontPageWidgetNumber=='3') { echo 'selected'; } ?> >3</option>
                                                <option value="4" <?php if ($dt_FrontPageWidgetNumber=='4') { echo 'selected'; } ?> >4</option>                                                                                                
                                            </select>                                            
                                        </div>
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>                                                                                                                                                                                 
                                    </div>                                             
                                </li>
                            <?php endif; ?>
                            <?php if ( $frontpage_row == 'row-posts' ) : ?> 
                                <li id="row-posts" class="frontpage-box">
                                    <div class="row-header">Posts<span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPagePosts_<?php echo $id; ?>">Status:</label>
                                            <select name="dt_FrontPagePosts_<?php echo $id; ?>">
                                                <?php $dt_FrontPagePosts = get_option('dt_FrontPagePosts_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontPagePosts=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontPagePosts=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPagePostsCount_<?php echo $id; ?>">Number of posts:</label>
                                            <input type="text" size="3" name="dt_FrontPagePostsCount_<?php echo $id; ?>" id="dt_FrontPagePostsCount_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPagePostsCount_'.$id); ?>" />              
                                            <img class="hint-icon" title="How many posts you want to be displayed from the selected categories. Type -1 if you want to use all the existing posts from the categories you selected." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPagePostsCategory_<?php echo $id; ?>">Categories:</label>
                                            <?php
                                                $dt_FrontPagePostsCategory = get_option('dt_FrontPagePostsCategory_'.$id);
                                                $haystack = explode(',',$dt_FrontPagePostsCategory);							
                                                $categories = get_categories();
                                                echo '<ul class="categories_listing">';								
                                                    foreach($categories as $category):
                                                        $validate = NULL;
                                                        $checked = '';
                                                        $validate = in_array($category->cat_ID,$haystack);
                                                        if ( $validate != '' ) $checked = ' checked="checked"';
                                                        echo '<li>';
                                                            echo '<input id="scroller-category-'.$category->cat_ID.'" type="checkbox" name="dt_FrontPagePostsCategory_'.$id.'[]" value="'.$category->cat_ID.'"'.$checked.'>';
                                                            echo '<label for="scroller-category-'.$category->cat_ID.'">'.$category->name; 
                                                        echo '</li>';										
                                                    endforeach;
                                                echo '</ul>';								
                                            ?>                      
                                        </div>
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>                                                                                                                                            
                                    </div>                                             
                                </li>
                            <?php endif; ?>                                 
                            <?php if ( $frontpage_row == 'row-latest-news' ) : ?> 
                                <li id="row-latest-news" class="frontpage-box">
                                    <div class="row-header">Latest news<span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageLatestNews_<?php echo $id; ?>">Status:</label>
                                            <select name="dt_FrontPageLatestNews_<?php echo $id; ?>">
                                                <?php $dt_FrontPageLatestNews = get_option('dt_FrontPageLatestNews_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontPageLatestNews=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontPageLatestNews=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                        </div>                                    
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageLatestNewsWidth_<?php echo $id; ?>">Width:</label>
                                            <select name="dt_FrontPageLatestNewsWidth_<?php echo $id; ?>">
                                                <?php $dt_FrontPageLatestNewsWidth = get_option('dt_FrontPageLatestNewsWidth_'.$id, 'half-width');?>
                                                <option value="full-width" <?php if ($dt_FrontPageLatestNewsWidth=='full-width') { echo 'selected'; } ?> >Full width</option>
                                                <option value="half-width" <?php if ($dt_FrontPageLatestNewsWidth=='half-width') { echo 'selected'; } ?>>Half width</option>
                                            </select>
                                            <img class="hint-icon" title="How much space whould you like this module to take in relation to the page's width." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>       
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageLatestHeading_<?php echo $id; ?>">Title:</label>
                                            <input type="text" size="50" name="dt_FrontPageLatestHeading_<?php echo $id; ?>" id="dt_FrontPageLatestHeading_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageLatestHeading_'.$id); ?>" />              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageLatestPostsCount_<?php echo $id; ?>">Number of posts:</label>
                                            <input type="text" size="3" name="dt_FrontPageLatestPostsCount_<?php echo $id; ?>" id="dt_FrontPageLatestPostsCount_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageLatestPostsCount_'.$id); ?>" />              
                                            <img class="hint-icon" title="How many posts you want to be displayed from the selected categories. Type -1 if you want to use all the existing posts from the categories you selected." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageLatestCategory_<?php echo $id; ?>">Categories:</label>
                                            <?php
                                                $dt_FrontPageLatestCategory = get_option('dt_FrontPageLatestCategory_'.$id);
                                                $haystack = explode(',',$dt_FrontPageLatestCategory);							
                                                $categories = get_categories();
                                                echo '<ul class="categories_listing">';								
                                                    foreach($categories as $category):
                                                        $validate = NULL;
                                                        $checked = '';
                                                        $validate = in_array($category->cat_ID,$haystack);
                                                        if ( $validate != '' ) $checked = ' checked="checked"';
                                                        echo '<li>';
                                                            echo '<input id="scroller-category-'.$category->cat_ID.'" type="checkbox" name="dt_FrontPageLatestCategory_'.$id.'[]" value="'.$category->cat_ID.'"'.$checked.'>';
                                                            echo '<label for="scroller-category-'.$category->cat_ID.'">'.$category->name; 
                                                        echo '</li>';										
                                                    endforeach;
                                                echo '</ul>';								
                                            ?>                      
                                        </div>
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>                                                                                                                                    
                                    </div>                                             
                                </li>
                            <?php endif; ?>
                            <?php if ( $frontpage_row == 'row-slideshow' ) : ?>
                                <li id="row-slideshow" class="frontpage-box">
                                    <div class="row-header">Slideshow<span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageSlideshow_<?php echo $id; ?>">Status:</label>
                                            <select name="dt_FrontPageSlideshow_<?php echo $id; ?>">
                                                <?php $dt_FrontPageSlideshow = get_option('dt_FrontPageSlideshow_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontPageSlideshow=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontPageSlideshow=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                        </div>                                       
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageSlideshowWidth_<?php echo $id; ?>">Width:</label>
                                            <select name="dt_FrontPageSlideshowWidth_<?php echo $id; ?>">
                                                <?php $dt_FrontPageSlideshowWidth = get_option('dt_FrontPageSlideshowWidth_'.$id, 'half-width');?>
                                                <option value="full-width" <?php if ($dt_FrontPageSlideshowWidth=='full-width') { echo 'selected'; } ?> >Full width</option>
                                                <option value="half-width" <?php if ($dt_FrontPageSlideshowWidth=='half-width') { echo 'selected'; } ?>>Half width</option>
                                            </select>
                                            <img class="hint-icon" title="How much space whould you like this module to take in relation to the page's width." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageSlideshowHeading_<?php echo $id; ?>">Title:</label>
                                            <input type="text" size="50" name="dt_FrontPageSlideshowHeading_<?php echo $id; ?>" id="dt_FrontPageSlideshowHeading_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageSlideshowHeading_'.$id); ?>" />              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageSlideshowImages_<?php echo $id; ?>">Image URLs:</label>
                                            <textarea rows="8" cols="90" name="dt_FrontPageSlideshowImages_<?php echo $id; ?>"><?php echo get_option('dt_FrontPageSlideshowImages_'.$id); ?></textarea>              
                                            <img class="hint-icon" title="Enter the full path URL to the images. Each URL needs to be on a separate line." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageSlideshowHeight_<?php echo $id; ?>">Slideshow height:</label>
                                            <input type="text" size="6" name="dt_FrontPageSlideshowHeight_<?php echo $id; ?>" id="dt_FrontPageSlideshowHeight_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageSlideshowHeight_'.$id,'246'); ?>" />              
                                        </div>
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageSlideshowTransition_<?php echo $id; ?>">Transition:</label>
                                            <select name="dt_FrontPageSlideshowTransition_<?php echo $id; ?>">
                                                <?php $dt_FrontPageSlideshowTransition = get_option('dt_FrontPageSlideshowTransition_'.$id, 'fade');?>
                                                <option value="fade" <?php if ($dt_FrontPageSlideshowTransition=='fade') { echo 'selected'; } ?> >fade</option>
                                                <option value="sliceDown" <?php if ($dt_FrontPageSlideshowTransition=='sliceDown') { echo 'selected'; } ?> >sliceDown</option>
                                                <option value="sliceDownLeft" <?php if ($dt_FrontPageSlideshowTransition=='sliceDownLeft') { echo 'selected'; } ?> >sliceDownLeft</option>
                                                <option value="sliceUp" <?php if ($dt_FrontPageSlideshowTransition=='sliceUp') { echo 'selected'; } ?> >sliceUp</option>
                                                <option value="sliceUpLeft" <?php if ($dt_FrontPageSlideshowTransition=='sliceUpLeft') { echo 'selected'; } ?> >sliceUpLeft</option>
                                                <option value="sliceUpDown" <?php if ($dt_FrontPageSlideshowTransition=='sliceUpDown') { echo 'selected'; } ?> >sliceUpDown</option>
                                                <option value="sliceUpDownLeft" <?php if ($dt_FrontPageSlideshowTransition=='sliceUpDownLeft') { echo 'selected'; } ?> >sliceUpDownLeft</option>
                                                <option value="fold" <?php if ($dt_FrontPageSlideshowTransition=='fold') { echo 'selected'; } ?> >fold</option>
                                                <option value="random" <?php if ($dt_FrontPageSlideshowTransition=='random') { echo 'selected'; } ?> >random</option>
                                                <option value="slideInRight" <?php if ($dt_FrontPageSlideshowTransition=='slideInRight') { echo 'selected'; } ?> >slideInRight</option>
                                                <option value="slideInLeft" <?php if ($dt_FrontPageSlideshowTransition=='slideInLeft') { echo 'selected'; } ?> >slideInLeft</option>
                                                <option value="boxRandom" <?php if ($dt_FrontPageSlideshowTransition=='boxRandom') { echo 'selected'; } ?> >boxRandom</option>
                                                <option value="boxRain" <?php if ($dt_FrontPageSlideshowTransition=='boxRain') { echo 'selected'; } ?> >boxRain</option>
                                                <option value="boxRainReverse" <?php if ($dt_FrontPageSlideshowTransition=='boxRainReverse') { echo 'selected'; } ?> >boxRainReverse</option>
                                                <option value="boxRainGrow" <?php if ($dt_FrontPageSlideshowTransition=='boxRainGrow') { echo 'selected'; } ?> >boxRainGrow</option>
                                                <option value="boxRainGrowReverse" <?php if ($dt_FrontPageSlideshowTransition=='boxRainGrowReverse') { echo 'selected'; } ?> >boxRainGrowReverse</option>
                                            </select>
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageSlideshowPause_<?php echo $id; ?>">Pause time:</label>
                                            <input type="text" size="6" name="dt_FrontPageSlideshowPause_<?php echo $id; ?>" id="dt_FrontPageSlideshowPause_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageSlideshowPause_'.$id,'3000'); ?>" />              
                                        </div>                                            
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageSlideshowSlices_<?php echo $id; ?>">Number of slices:</label>
                                            <input type="text" size="6" name="dt_FrontPageSlideshowSlices_<?php echo $id; ?>" id="dt_FrontPageSlideshowSlices_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageSlideshowSlices_'.$id,'8'); ?>" />              
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageSlideshowBoxCols_<?php echo $id; ?>">Number of box cols:</label>
                                            <input type="text" size="6" name="dt_FrontPageSlideshowBoxCols_<?php echo $id; ?>" id="dt_FrontPageSlideshowBoxCols_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageSlideshowBoxCols_'.$id,'4'); ?>" />              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageSlideshowBoxRows_<?php echo $id; ?>">Number of box rows:</label>
                                            <input type="text" size="6" name="dt_FrontPageSlideshowBoxRows_<?php echo $id; ?>" id="dt_FrontPageSlideshowBoxRows_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageSlideshowBoxRows_'.$id,'2'); ?>" />              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageSlideshowText_<?php echo $id; ?>">Bottom text:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontPageSlideshowText_<?php echo $id; ?>"><?php echo get_option('dt_FrontPageSlideshowText_'.$id); ?></textarea>              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageSlideshowButton_<?php echo $id; ?>">Bottom button text:</label>
                                            <input type="text" size="50" name="dt_FrontPageSlideshowButton_<?php echo $id; ?>" id="dt_FrontPageSlideshowButton_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageSlideshowButton_'.$id); ?>" />              
                                        </div>                                                                             
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageSlideshowUrl_<?php echo $id; ?>">Bottom button link:</label>
                                            <input type="text" size="50" name="dt_FrontPageSlideshowUrl_<?php echo $id; ?>" id="dt_FrontPageSlideshowUrl_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageSlideshowUrl_'.$id); ?>" />              
                                        </div>
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>                                                                                                                                                                                                                                                                                                                             
                                    </div>
								</li>                                                                
                            <?php endif; ?>
                            <?php if ( $frontpage_row == 'row-tabs' ) : ?>
                                <li id="row-tabs" class="frontpage-box">
                                    <div class="row-header">Tabs<span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageTabs_<?php echo $id; ?>">Status</label>
                                            <select name="dt_FrontPageTabs_<?php echo $id; ?>">
                                                <?php $dt_FrontPageTabs = get_option('dt_FrontPageTabs_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontPageTabs=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontPageTabs=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                        </div>
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageTabsWidth_<?php echo $id; ?>">Width:</label>
                                            <select name="dt_FrontPageTabsWidth_<?php echo $id; ?>">
                                                <?php $dt_FrontPageTabsWidth = get_option('dt_FrontPageTabsWidth_'.$id, 'half-width');?>
                                                <option value="full-width" <?php if ($dt_FrontPageTabsWidth=='full-width') { echo 'selected'; } ?> >Full width</option>
                                                <option value="half-width" <?php if ($dt_FrontPageTabsWidth=='half-width') { echo 'selected'; } ?>>Half width</option>
                                            </select>
                                            <img class="hint-icon" title="How much space whould you like this module to take in relation to the page's width." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsHeading_<?php echo $id; ?>">Title:</label>
                                            <input type="text" size="50" name="dt_FrontPageTabsHeading_<?php echo $id; ?>" id="dt_FrontPageTabsHeading_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageTabsHeading_'.$id); ?>" />              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementHeading_01_<?php echo $id; ?>">Element 1 heading:</label>
                                            <input type="text" size="50" name="dt_FrontPageTabsElementHeading_01_<?php echo $id; ?>" id="dt_FrontPageTabsElementHeading_01_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageTabsElementHeading_01_'.$id); ?>" />              
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementContent_01_<?php echo $id; ?>">Element 1 content:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontPageTabsElementContent_01_<?php echo $id; ?>"><?php echo get_option('dt_FrontPageTabsElementContent_01_'.$id); ?></textarea>              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementHeading_02_<?php echo $id; ?>">Element 2 heading:</label>
                                            <input type="text" size="50" name="dt_FrontPageTabsElementHeading_02_<?php echo $id; ?>" id="dt_FrontPageTabsElementHeading_02_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageTabsElementHeading_02_'.$id); ?>" />              
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementContent_02_<?php echo $id; ?>">Element 2 content:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontPageTabsElementContent_02_<?php echo $id; ?>"><?php echo get_option('dt_FrontPageTabsElementContent_02_'.$id); ?></textarea>              
                                        </div>  
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementHeading_03_<?php echo $id; ?>">Element 3 heading:</label>
                                            <input type="text" size="50" name="dt_FrontPageTabsElementHeading_03_<?php echo $id; ?>" id="dt_FrontPageTabsElementHeading_03_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageTabsElementHeading_03_'.$id); ?>" />              
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementContent_03_<?php echo $id; ?>">Element 3 content:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontPageTabsElementContent_03_<?php echo $id; ?>"><?php echo get_option('dt_FrontPageTabsElementContent_03_'.$id); ?></textarea>              
                                        </div> 
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementHeading_04_<?php echo $id; ?>">Element 4 heading:</label>
                                            <input type="text" size="50" name="dt_FrontPageTabsElementHeading_04_<?php echo $id; ?>" id="dt_FrontPageTabsElementHeading_04_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageTabsElementHeading_04_'.$id); ?>" />              
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementContent_04_<?php echo $id; ?>">Element 4 content:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontPageTabsElementContent_04_<?php echo $id; ?>"><?php echo get_option('dt_FrontPageTabsElementContent_04_'.$id); ?></textarea>              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementHeading_05_<?php echo $id; ?>">Element 5 heading:</label>
                                            <input type="text" size="50" name="dt_FrontPageTabsElementHeading_05_<?php echo $id; ?>" id="dt_FrontPageTabsElementHeading_05_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageTabsElementHeading_05_'.$id); ?>" />              
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementContent_05_<?php echo $id; ?>">Element 5 content:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontPageTabsElementContent_05_<?php echo $id; ?>"><?php echo get_option('dt_FrontPageTabsElementContent_05_'.$id); ?></textarea>              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementHeading_06_<?php echo $id; ?>">Element 6 heading:</label>
                                            <input type="text" size="50" name="dt_FrontPageTabsElementHeading_06_<?php echo $id; ?>" id="dt_FrontPageTabsElementHeading_06_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageTabsElementHeading_06_'.$id); ?>" />              
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementContent_06_<?php echo $id; ?>">Element 6 content:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontPageTabsElementContent_06_<?php echo $id; ?>"><?php echo get_option('dt_FrontPageTabsElementContent_06_'.$id); ?></textarea>              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementHeading_07_<?php echo $id; ?>">Element 7 heading:</label>
                                            <input type="text" size="50" name="dt_FrontPageTabsElementHeading_07_<?php echo $id; ?>" id="dt_FrontPageTabsElementHeading_07_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageTabsElementHeading_07_'.$id); ?>" />              
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementContent_07_<?php echo $id; ?>">Element 7 content:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontPageTabsElementContent_07_<?php echo $id; ?>"><?php echo get_option('dt_FrontPageTabsElementContent_07_'.$id); ?></textarea>              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementHeading_08_<?php echo $id; ?>">Element 8 heading:</label>
                                            <input type="text" size="50" name="dt_FrontPageTabsElementHeading_08_<?php echo $id; ?>" id="dt_FrontPageTabsElementHeading_08_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageTabsElementHeading_08_'.$id); ?>" />              
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageTabsElementContent_08_<?php echo $id; ?>">Element 8 content:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontPageTabsElementContent_08_<?php echo $id; ?>"><?php echo get_option('dt_FrontPageTabsElementContent_08_'.$id); ?></textarea>              
                                        </div>
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                    
									</div>
								</li>                                                                                                    
                            <?php endif; ?> 
                            <?php if ( $frontpage_row == 'row-from-blog' ) : ?>
                                <li id="row-from-blog" class="frontpage-box">
                                    <div class="row-header">From the blog<span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageFromBlog_<?php echo $id; ?>">Status:</label>
                                            <select name="dt_FrontPageFromBlog_<?php echo $id; ?>">
                                                <?php $dt_FrontPageFromBlog = get_option('dt_FrontPageFromBlog_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontPageFromBlog=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontPageFromBlog=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                        </div>
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageFromBlogWidth_<?php echo $id; ?>">Width:</label>
                                            <select name="dt_FrontPageFromBlogWidth_<?php echo $id; ?>">
                                                <?php $dt_FrontPageFromBlogWidth = get_option('dt_FrontPageFromBlogWidth_'.$id, 'half-width');?>
                                                <option value="full-width" <?php if ($dt_FrontPageFromBlogWidth=='full-width') { echo 'selected'; } ?> >Full width</option>
                                                <option value="half-width" <?php if ($dt_FrontPageFromBlogWidth=='half-width') { echo 'selected'; } ?>>Half width</option>
                                            </select>
                                            <img class="hint-icon" title="How much space whould you like this module to take in relation to the page's width." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageFromBlogHeading_<?php echo $id; ?>">Title:</label>
                                            <input type="text" size="50" name="dt_FrontPageFromBlogHeading_<?php echo $id; ?>" id="dt_FrontPageFromBlogHeading_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageFromBlogHeading_'.$id); ?>" />              
                                        </div>
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageFromBlogCategory_<?php echo $id; ?>">Categories:</label>
                                            <?php
                                                $dt_FrontPageFromBlogCategory = get_option('dt_FrontPageFromBlogCategory_'.$id);
                                                $haystack = explode(',',$dt_FrontPageFromBlogCategory);							
                                                $categories = get_categories();
                                                echo '<ul class="categories_listing">';								
                                                    foreach($categories as $category):
                                                        $validate = NULL;
                                                        $checked = '';
                                                        $validate = in_array($category->cat_ID,$haystack);
                                                        if ( $validate != '' ) $checked = ' checked="checked"';
                                                        echo '<li>';
                                                            echo '<input id="scroller-category-'.$category->cat_ID.'" type="checkbox" name="dt_FrontPageFromBlogCategory_'.$id.'[]" value="'.$category->cat_ID.'"'.$checked.'>';
                                                            echo '<label for="scroller-category-'.$category->cat_ID.'">'.$category->name; 
                                                        echo '</li>';										
                                                    endforeach;
                                                echo '</ul>';								
                                            ?>                      
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageFBCount_<?php echo $id; ?>">Number of posts:</label>
                                            <input type="text" size="3" name="dt_FrontPageFBCount_<?php echo $id; ?>" id="dt_FrontPageFBCount_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageFBCount_'.$id); ?>" />              
                                            <img class="hint-icon" title="How many posts you want to be displayed from the selected categories. Type -1 if you want to use all the existing posts from the categories you selected." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageFromBlogMore_<?php echo $id; ?>">'Go to blog' button URL:</label>
                                            <input type="text" size="50" name="dt_FrontPageFromBlogMore_<?php echo $id; ?>" id="dt_FrontPageFromBlogMore_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageFromBlogMore_'.$id); ?>" />              
                                        </div>                                        
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>                                                                                                                                                                                                                                           
                                    </div>
                                </li>                                
                            <?php endif; ?>
                            <?php if ( $frontpage_row == 'row-latest-work' ) : ?>
                                <li id="row-latest-work" class="frontpage-box">
                                    <div class="row-header">Latest work<span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontLatestWork_<?php echo $id; ?>">Status:</label>
                                            <select name="dt_FrontLatestWork_<?php echo $id; ?>">
                                                <?php $dt_FrontLatestWork = get_option('dt_FrontLatestWork_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontLatestWork=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontLatestWork=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontLatestWorkHeading_<?php echo $id; ?>">Title:</label>
                                            <input type="text" size="50" name="dt_FrontLatestWorkHeading_<?php echo $id; ?>" id="dt_FrontLatestWorkHeading_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontLatestWorkHeading_'.$id); ?>" />              
                                        </div>                                        
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontLatestWorkPortfolio_<?php echo $id; ?>">Portfolios:</label>
                                            <?php
                                                $dt_FrontLatestWorkPortfolio = get_option('dt_FrontLatestWorkPortfolio_'.$id);
                                                $haystack = explode(',',$dt_FrontLatestWorkPortfolio);							
                                                $categories = get_categories(array('taxonomy' => 'portfolio'));
                                                echo '<ul class="categories_listing">';								
                                                    foreach($categories as $category):
                                                        $validate = NULL;
                                                        $checked = '';
                                                        $validate = in_array($category->slug,$haystack);
                                                        if ( $validate != '' ) $checked = ' checked="checked"';
                                                        echo '<li>';
                                                            echo '<input id="scroller-category-'.$category->cat_ID.'" type="checkbox" name="dt_FrontLatestWorkPortfolio_'.$id.'[]" value="'.$category->slug.'"'.$checked.'>';
                                                            echo '<label for="scroller-category-'.$category->cat_ID.'">'.$category->name; 
                                                        echo '</li>';										
                                                    endforeach;
                                                echo '</ul>';								
                                            ?>                      
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontLatestWorkPortfolioCount_<?php echo $id; ?>">Number of projects:</label>
                                            <input type="text" size="3" name="dt_FrontLatestWorkPortfolioCount_<?php echo $id; ?>" id="dt_FrontLatestWorkPortfolioCount_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontLatestWorkPortfolioCount_'.$id); ?>" />              
	                                        <img class="hint-icon" title="How many projects should the scroller use. Type -1 if you want to use all the existing projects from the categories you selected." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                            
                                        </div>
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>                                                                                                                         
                                    </div>
                                </li>                            
                            <?php endif; ?>
                            <?php if ( $frontpage_row == 'row-latest-work-description' ) : ?>
                                <li id="row-latest-work-description" class="frontpage-box">
                                    <div class="row-header">Latest work with description<span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontLatestWorkDesc_<?php echo $id; ?>">Status</label>
                                            <select name="dt_FrontLatestWorkDesc_<?php echo $id; ?>">
                                                <?php $dt_FrontLatestWorkDesc = get_option('dt_FrontLatestWorkDesc_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontLatestWorkDesc=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontLatestWorkDesc=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontLatestWorkDescHeading_<?php echo $id; ?>">Title:</label>
                                            <input type="text" size="50" name="dt_FrontLatestWorkDescHeading_<?php echo $id; ?>" id="dt_FrontLatestWorkDescHeading_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontLatestWorkDescHeading_'.$id); ?>" />              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontLatestWorkDescDescription_<?php echo $id; ?>">Description:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontLatestWorkDescDescription_<?php echo $id; ?>"><?php echo get_option('dt_FrontLatestWorkDescDescription_'.$id); ?></textarea>              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontLatestWorkDescButtonText_<?php echo $id; ?>">Button text:</label>
                                            <input type="text" size="50" name="dt_FrontLatestWorkDescButtonText_<?php echo $id; ?>" id="dt_FrontLatestWorkDescButtonText_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontLatestWorkDescButtonText_'.$id); ?>" />              
                                        </div>   
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontLatestWorkDescButtonUrl_<?php echo $id; ?>">Button URL:</label>
                                            <input type="text" size="50" name="dt_FrontLatestWorkDescButtonUrl_<?php echo $id; ?>" id="dt_FrontLatestWorkDescButtonUrl_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontLatestWorkDescButtonUrl_'.$id); ?>" />              
                                        </div>
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontLatestWorkDescPortfolio_<?php echo $id; ?>">Portfolios:</label>
                                            <?php
                                                $dt_FrontLatestWorkDescPortfolio = get_option('dt_FrontLatestWorkDescPortfolio_'.$id);
                                                $haystack = explode(',',$dt_FrontLatestWorkDescPortfolio);							
                                                $categories = get_categories(array('taxonomy' => 'portfolio'));
                                                echo '<ul class="categories_listing">';								
                                                    foreach($categories as $category):
                                                        $validate = NULL;
                                                        $checked = '';
                                                        $validate = in_array($category->slug,$haystack);
                                                        if ( $validate != '' ) $checked = ' checked="checked"';
                                                        echo '<li>';
                                                            echo '<input id="scroller-category-'.$category->cat_ID.'" type="checkbox" name="dt_FrontLatestWorkDescPortfolio_'.$id.'[]" value="'.$category->slug.'"'.$checked.'>';
                                                            echo '<label for="scroller-category-'.$category->cat_ID.'">'.$category->name; 
                                                        echo '</li>';										
                                                    endforeach;
                                                echo '</ul>';								
                                            ?>                      
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontLatestWorkDescCount_<?php echo $id; ?>">Number of projects:</label>
                                            <input type="text" size="3" name="dt_FrontLatestWorkDescCount_<?php echo $id; ?>" id="dt_FrontLatestWorkDescCount_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontLatestWorkDescCount_'.$id); ?>" />              
                                            <img class="hint-icon" title="How many projects should the scroller use. Type -1 if you want to use all the existing projects from the categories you selected." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>                                                                                                                                                                                                                                                                                                                           
                                    </div>
                                </li>                            
                            <?php endif; ?>
                            <?php if ( $frontpage_row == 'row-calltoaction' ) : ?> 
                                <li id="row-calltoaction" class="frontpage-box">
                                    <div class="row-header">Call to action<span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontCallToAction_<?php echo $id; ?>">Status:</label>
                                            <select name="dt_FrontCallToAction_<?php echo $id; ?>">
                                                <?php $dt_FrontCallToAction = get_option('dt_FrontCallToAction_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontCallToAction=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontCallToAction=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontCallToActionText_<?php echo $id; ?>">Intro text:</label>
                                            <textarea rows="3" cols="50" name="dt_FrontCallToActionText_<?php echo $id; ?>"><?php echo get_option('dt_FrontCallToActionText_'.$id); ?></textarea>              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontCallToActionButtonText_<?php echo $id; ?>">Button Text:</label>
                                            <input type="text" size="50" name="dt_FrontCallToActionButtonText_<?php echo $id; ?>" id="dt_FrontCallToActionButtonText_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontCallToActionButtonText_'.$id); ?>" />              
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontCallToActionButtonUrl_<?php echo $id; ?>">Button URL:</label>
                                            <input type="text" size="50" name="dt_FrontCallToActionButtonUrl_<?php echo $id; ?>" id="dt_FrontCallToActionButtonUrl_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontCallToActionButtonUrl_'.$id); ?>" />              
                                        </div>
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>                                                                                                                                                                                                     
                                    </div>
							<?php endif; ?>                                                                                                                                                    
							<?php if ( $frontpage_row == 'row-contact' ) : ?> 
                                <li id="row-contact" class="frontpage-box">
                                    <div class="row-header">Contact form<span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageContact_<?php echo $id; ?>">Status:</label>
                                            <select name="dt_FrontPageContact_<?php echo $id; ?>">
                                                <?php $dt_FrontPageContact = get_option('dt_FrontPageContact_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontPageContact=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontPageContact=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                        </div>
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageContactHeading_<?php echo $id; ?>">Title:</label>
                                            <input type="text" size="50" name="dt_FrontPageContactHeading_<?php echo $id; ?>" id="dt_FrontPageContactHeading_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageContactHeading_'.$id,''); ?>" />              
                                        </div>                                        
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageContactRecaptcha_<?php echo $id; ?>">Enable reCAPTCHA</label>
                                            <select name="dt_FrontPageContactRecaptcha_<?php echo $id; ?>">
                                                <?php $dt_FrontPageContactRecaptcha = get_option('dt_FrontPageContactRecaptcha_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontPageContactRecaptcha=='yes') { echo 'selected'; } ?> >Yes</option>
                                                <option value="no" <?php if ($dt_FrontPageContactRecaptcha=='no') { echo 'selected'; } ?>>No</option>
                                            </select>
                                            <img class="hint-icon" title="Enable or Disable the anti-spam service reCAPTCHA." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>                                    
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPageContactDestination_<?php echo $id; ?>">Destination email(s):</label>
                                            <input type="text" size="50" name="dt_FrontPageContactDestination_<?php echo $id; ?>" id="dt_FrontPageContactDestination_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPageContactDestination_'.$id, get_option('admin_email')); ?>" />              
                                            <img class="hint-icon" title="Type in the e-mail address that will receive the messages. If you want to add multiple e-mail addresses separate them by commas." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageContactField1_<?php echo $id; ?>">Is "<?php echo dt_ContactFormName; ?>" required?</label>
                                            <select name="dt_FrontPageContactField1_<?php echo $id; ?>">
                                                <?php $dt_FrontPageContactField1 = get_option('dt_FrontPageContactField1_'.$id, 'yes');?>
                                                <option value="yes" <?php if ($dt_FrontPageContactField1=='yes') { echo 'selected'; } ?> >Yes</option>
                                                <option value="no" <?php if ($dt_FrontPageContactField1=='no') { echo 'selected'; } ?>>No</option>
                                            </select>
                                        </div> 
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageContactField2_<?php echo $id; ?>">Is "<?php echo dt_ContactFormCompany; ?>" required?</label>
                                            <select name="dt_FrontPageContactField2_<?php echo $id; ?>">
                                                <?php $dt_FrontPageContactField2 = get_option('dt_FrontPageContactField2_'.$id, 'yes');?>
                                                <option value="yes" <?php if ($dt_FrontPageContactField2=='yes') { echo 'selected'; } ?> >Yes</option>
                                                <option value="no" <?php if ($dt_FrontPageContactField2=='no') { echo 'selected'; } ?>>No</option>
                                            </select>
                                        </div>
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageContactField3_<?php echo $id; ?>">Is "<?php echo dt_ContactFormEmail; ?>" required?</label>
                                            <select name="dt_FrontPageContactField3_<?php echo $id; ?>">
                                                <?php $dt_FrontPageContactField3 = get_option('dt_FrontPageContactField3_'.$id, 'yes');?>
                                                <option value="yes" <?php if ($dt_FrontPageContactField3=='yes') { echo 'selected'; } ?> >Yes</option>
                                                <option value="no" <?php if ($dt_FrontPageContactField3=='no') { echo 'selected'; } ?>>No</option>
                                            </select>
                                        </div>
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageContactField4_<?php echo $id; ?>">Is "<?php echo dt_ContactFormPhone; ?>" required?</label>
                                            <select name="dt_FrontPageContactField4_<?php echo $id; ?>">
                                                <?php $dt_FrontPageContactField4 = get_option('dt_FrontPageContactField4_'.$id, 'yes');?>
                                                <option value="yes" <?php if ($dt_FrontPageContactField4=='yes') { echo 'selected'; } ?> >Yes</option>
                                                <option value="no" <?php if ($dt_FrontPageContactField4=='no') { echo 'selected'; } ?>>No</option>
                                            </select>
                                        </div> 
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageContactField5_<?php echo $id; ?>">Is "<?php echo dt_ContactFormMessage; ?>" required?</label>
                                            <select name="dt_FrontPageContactField5_<?php echo $id; ?>">
                                                <?php $dt_FrontPageContactField5 = get_option('dt_FrontPageContactField5_'.$id, 'yes');?>
                                                <option value="yes" <?php if ($dt_FrontPageContactField5=='yes') { echo 'selected'; } ?> >Yes</option>
                                                <option value="no" <?php if ($dt_FrontPageContactField5=='no') { echo 'selected'; } ?>>No</option>
                                            </select>
                                        </div>
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>    				                                                                                                                                                                                                                                                                           
                                    </div>
                                </li>
                            <?php endif; ?>
                            <?php if ( $frontpage_row == 'row-page-content' ) : ?> 
                                <li id="row-page-content" class="frontpage-box">
                                    <div class="row-header">Page content<span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPageContent_<?php echo $id; ?>">Status:</label>
                                            <select name="dt_FrontPageContent_<?php echo $id; ?>">
                                                <?php $dt_FrontPageContent = get_option('dt_FrontPageContent_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontPageContent=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontPageContent=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                            <img class="hint-icon" title="Enable or Disable the content from the page where the frontpage is being deployed to." src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />
                                        </div>                                    
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>                                                                                                                                                                                 
                                    </div>                                             
                                </li>
                            <?php endif; ?>
                            <?php if ( $frontpage_row == 'row-partners' ) : ?> 
                                <li id="row-partners" class="frontpage-box">
                                    <div class="row-header">Partner scroller<span class="front-page-row-handle"></span><span class="front-page-row-icon">Settings</span></div>
                                    <div class="row-content">
                                        <div class="table-row clearfix">
                                            <label for="dt_FrontPagePartners_<?php echo $id; ?>">Status:</label>
                                            <select name="dt_FrontPagePartners_<?php echo $id; ?>">
                                                <?php $dt_FrontPagePartners = get_option('dt_FrontPagePartners_'.$id, 'no');?>
                                                <option value="yes" <?php if ($dt_FrontPagePartners=='yes') { echo 'selected'; } ?> >Enabled</option>
                                                <option value="no" <?php if ($dt_FrontPagePartners=='no') { echo 'selected'; } ?>>Disabled</option>
                                            </select>
                                        </div> 
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPagePartnersTitle_<?php echo $id; ?>">Title:</label>
                                            <input type="text" size="50" name="dt_FrontPagePartnersTitle_<?php echo $id; ?>" id="dt_FrontPagePartnersTitle_<?php echo $id; ?>" value="<?php echo get_option('dt_FrontPagePartnersTitle_'.$id); ?>" />              
                                        </div>                                        
                                        <div class="table-row clearfix">            
                                            <label for="dt_FrontPagePartnersDetails_<?php echo $id; ?>_<?php echo $k; ?>">Partners:</label>
                                            <textarea rows="8" cols="90" name="dt_FrontPagePartnersDetails_<?php echo $id; ?>"><?php echo get_option('dt_FrontPagePartnersDetails_'.$id); ?></textarea>              
											                                        <img class="hint-icon" title="Please enter the logo images and the link like shown in the example: imageURL|partnerURL" src="<?php echo get_template_directory_uri(); ?>/includes/duotive-admin-skin/images/hint-icon.png" />                                                                  
                                        </div> 
                                        <div class="table-row table-row-last clearfix">
                                            <input type="submit" name="search" value="Save changes" class="button" />	
                                        </div>                                                                                                                                                                                 
                                    </div>                                             
                                </li>
                            <?php endif; ?>                                                         
                        <?php endforeach; ?>                                                                                                                                 
                    </ul>                                                                                                         
            </form>                                
        <!-- end of front-page-elements  -->                
        </div>
    	<?php endif; ?>                  
		<!-- end of front page layouts -->            
		</div>            
	</div>        
	<?php
}

function front_page_update($id)
{
	if ( isset($_POST['dt_FrontPageIntro_'.$id]) ) update_option('dt_FrontPageIntro_'.$id,$_POST['dt_FrontPageIntro_'.$id]);	
	if ( isset($_POST['dt_FrontPageIntroOnly_'.$id]) ) update_option('dt_FrontPageIntroOnly_'.$id,$_POST['dt_FrontPageIntroOnly_'.$id]);		
	if ( isset($_POST['dt_FrontPageIntroHeading_'.$id]) ) update_option('dt_FrontPageIntroHeading_'.$id,stripslashes($_POST['dt_FrontPageIntroHeading_'.$id]));	
	if ( isset($_POST['dt_FrontPageIntroMainParagraph_'.$id]) ) update_option('dt_FrontPageIntroMainParagraph_'.$id,stripslashes($_POST['dt_FrontPageIntroMainParagraph_'.$id]));			
	if ( isset($_POST['dt_FrontPageIntroSecondaryParagraph_'.$id]) ) update_option('dt_FrontPageIntroSecondaryParagraph_'.$id,stripslashes($_POST['dt_FrontPageIntroSecondaryParagraph_'.$id]));				
	if ( isset($_POST['dt_FrontPageWidgets_'.$id]) ) update_option('dt_FrontPageWidgets_'.$id,stripslashes($_POST['dt_FrontPageWidgets_'.$id]));				
	if ( isset($_POST['dt_FrontPageWidgetNumber_'.$id]) ) update_option('dt_FrontPageWidgetNumber_'.$id,stripslashes($_POST['dt_FrontPageWidgetNumber_'.$id]));							
	if ( isset($_POST['dt_FrontPagePosts_'.$id]) ) update_option('dt_FrontPagePosts_'.$id,stripslashes($_POST['dt_FrontPagePosts_'.$id]));					
	if ( isset($_POST['dt_FrontPagePostsCount_'.$id]) ) update_option('dt_FrontPagePostsCount_'.$id,stripslashes($_POST['dt_FrontPagePostsCount_'.$id]));						
	if ( isset($_POST['dt_FrontPagePostsCategory_'.$id]) ) $dt_FrontPagePostsCategory = implode(',',$_POST['dt_FrontPagePostsCategory_'.$id]); else $dt_FrontPagePostsCategory = ''; update_option('dt_FrontPagePostsCategory_'.$id,$dt_FrontPagePostsCategory);
	if ( isset($_POST['dt_FrontPageLatestNews_'.$id]) ) update_option('dt_FrontPageLatestNews_'.$id,stripslashes($_POST['dt_FrontPageLatestNews_'.$id]));		
	if ( isset($_POST['dt_FrontPageLatestNewsWidth_'.$id]) ) update_option('dt_FrontPageLatestNewsWidth_'.$id,stripslashes($_POST['dt_FrontPageLatestNewsWidth_'.$id]));	
	if ( isset($_POST['dt_FrontPageLatestHeading_'.$id]) ) update_option('dt_FrontPageLatestHeading_'.$id,stripslashes($_POST['dt_FrontPageLatestHeading_'.$id]));		
	if ( isset($_POST['dt_FrontPageLatestPostsCount_'.$id]) ) update_option('dt_FrontPageLatestPostsCount_'.$id,stripslashes($_POST['dt_FrontPageLatestPostsCount_'.$id]));						
	if ( isset($_POST['dt_FrontPageLatestCategory_'.$id]) ) $dt_FrontPageLatestCategory = implode(',',$_POST['dt_FrontPageLatestCategory_'.$id]); else $dt_FrontPageLatestCategory = ''; update_option('dt_FrontPageLatestCategory_'.$id,$dt_FrontPageLatestCategory);
	if ( isset($_POST['dt_FrontPageSlideshow_'.$id]) ) update_option('dt_FrontPageSlideshow_'.$id,stripslashes($_POST['dt_FrontPageSlideshow_'.$id]));	
	if ( isset($_POST['dt_FrontPageSlideshowWidth_'.$id]) ) update_option('dt_FrontPageSlideshowWidth_'.$id,stripslashes($_POST['dt_FrontPageSlideshowWidth_'.$id]));
	if ( isset($_POST['dt_FrontPageSlideshowHeading_'.$id]) ) update_option('dt_FrontPageSlideshowHeading_'.$id,stripslashes($_POST['dt_FrontPageSlideshowHeading_'.$id]));
	if ( isset($_POST['dt_FrontPageSlideshowImages_'.$id]) ) update_option('dt_FrontPageSlideshowImages_'.$id,stripslashes($_POST['dt_FrontPageSlideshowImages_'.$id]));
	if ( isset($_POST['dt_FrontPageSlideshowHeight_'.$id]) ) update_option('dt_FrontPageSlideshowHeight_'.$id,stripslashes($_POST['dt_FrontPageSlideshowHeight_'.$id]));
	if ( isset($_POST['dt_FrontPageSlideshowTransition_'.$id]) ) update_option('dt_FrontPageSlideshowTransition_'.$id,stripslashes($_POST['dt_FrontPageSlideshowTransition_'.$id]));	
	if ( isset($_POST['dt_FrontPageSlideshowPause_'.$id]) ) update_option('dt_FrontPageSlideshowPause_'.$id,stripslashes($_POST['dt_FrontPageSlideshowPause_'.$id]));
	if ( isset($_POST['dt_FrontPageSlideshowSlices_'.$id]) ) update_option('dt_FrontPageSlideshowSlices_'.$id,stripslashes($_POST['dt_FrontPageSlideshowSlices_'.$id]));
	if ( isset($_POST['dt_FrontPageSlideshowBoxCols_'.$id]) ) update_option('dt_FrontPageSlideshowBoxCols_'.$id,stripslashes($_POST['dt_FrontPageSlideshowBoxCols_'.$id]));	
	if ( isset($_POST['dt_FrontPageSlideshowBoxRows_'.$id]) ) update_option('dt_FrontPageSlideshowBoxRows_'.$id,stripslashes($_POST['dt_FrontPageSlideshowBoxRows_'.$id]));	
	if ( isset($_POST['dt_FrontPageSlideshowText_'.$id]) ) update_option('dt_FrontPageSlideshowText_'.$id,stripslashes($_POST['dt_FrontPageSlideshowText_'.$id]));	
	if ( isset($_POST['dt_FrontPageSlideshowUrl_'.$id]) ) update_option('dt_FrontPageSlideshowUrl_'.$id,stripslashes($_POST['dt_FrontPageSlideshowUrl_'.$id]));		
	if ( isset($_POST['dt_FrontPageSlideshowButton_'.$id]) ) update_option('dt_FrontPageSlideshowButton_'.$id,stripslashes($_POST['dt_FrontPageSlideshowButton_'.$id]));			
	if ( isset($_POST['dt_FrontPageTabs_'.$id]) ) update_option('dt_FrontPageTabs_'.$id,stripslashes($_POST['dt_FrontPageTabs_'.$id]));			
	if ( isset($_POST['dt_FrontPageTabsHeading_'.$id]) ) update_option('dt_FrontPageTabsHeading_'.$id,stripslashes($_POST['dt_FrontPageTabsHeading_'.$id]));				
	if ( isset($_POST['dt_FrontPageTabsWidth_'.$id]) ) update_option('dt_FrontPageTabsWidth_'.$id,stripslashes($_POST['dt_FrontPageTabsWidth_'.$id]));	
	if ( isset($_POST['dt_FrontPageTabsElementHeading_01_'.$id]) ) update_option('dt_FrontPageTabsElementHeading_01_'.$id,stripslashes($_POST['dt_FrontPageTabsElementHeading_01_'.$id]));		
	if ( isset($_POST['dt_FrontPageTabsElementContent_01_'.$id]) ) update_option('dt_FrontPageTabsElementContent_01_'.$id,stripslashes($_POST['dt_FrontPageTabsElementContent_01_'.$id]));			
	if ( isset($_POST['dt_FrontPageTabsElementHeading_02_'.$id]) ) update_option('dt_FrontPageTabsElementHeading_02_'.$id,stripslashes($_POST['dt_FrontPageTabsElementHeading_02_'.$id]));		
	if ( isset($_POST['dt_FrontPageTabsElementContent_02_'.$id]) ) update_option('dt_FrontPageTabsElementContent_02_'.$id,stripslashes($_POST['dt_FrontPageTabsElementContent_02_'.$id]));			
	if ( isset($_POST['dt_FrontPageTabsElementHeading_03_'.$id]) ) update_option('dt_FrontPageTabsElementHeading_03_'.$id,stripslashes($_POST['dt_FrontPageTabsElementHeading_03_'.$id]));		
	if ( isset($_POST['dt_FrontPageTabsElementContent_03_'.$id]) ) update_option('dt_FrontPageTabsElementContent_03_'.$id,stripslashes($_POST['dt_FrontPageTabsElementContent_03_'.$id]));
	if ( isset($_POST['dt_FrontPageTabsElementHeading_04_'.$id]) ) update_option('dt_FrontPageTabsElementHeading_04_'.$id,stripslashes($_POST['dt_FrontPageTabsElementHeading_04_'.$id]));		
	if ( isset($_POST['dt_FrontPageTabsElementContent_04_'.$id]) ) update_option('dt_FrontPageTabsElementContent_04_'.$id,stripslashes($_POST['dt_FrontPageTabsElementContent_04_'.$id]));			
	if ( isset($_POST['dt_FrontPageTabsElementHeading_05_'.$id]) ) update_option('dt_FrontPageTabsElementHeading_05_'.$id,stripslashes($_POST['dt_FrontPageTabsElementHeading_05_'.$id]));		
	if ( isset($_POST['dt_FrontPageTabsElementContent_05_'.$id]) ) update_option('dt_FrontPageTabsElementContent_05_'.$id,stripslashes($_POST['dt_FrontPageTabsElementContent_05_'.$id]));			
	if ( isset($_POST['dt_FrontPageTabsElementHeading_06_'.$id]) ) update_option('dt_FrontPageTabsElementHeading_06_'.$id,stripslashes($_POST['dt_FrontPageTabsElementHeading_06_'.$id]));		
	if ( isset($_POST['dt_FrontPageTabsElementContent_06_'.$id]) ) update_option('dt_FrontPageTabsElementContent_06_'.$id,stripslashes($_POST['dt_FrontPageTabsElementContent_06_'.$id]));			
	if ( isset($_POST['dt_FrontPageTabsElementHeading_07_'.$id]) ) update_option('dt_FrontPageTabsElementHeading_07_'.$id,stripslashes($_POST['dt_FrontPageTabsElementHeading_07_'.$id]));		
	if ( isset($_POST['dt_FrontPageTabsElementContent_07_'.$id]) ) update_option('dt_FrontPageTabsElementContent_07_'.$id,stripslashes($_POST['dt_FrontPageTabsElementContent_07_'.$id]));			
	if ( isset($_POST['dt_FrontPageTabsElementHeading_08_'.$id]) ) update_option('dt_FrontPageTabsElementHeading_08_'.$id,stripslashes($_POST['dt_FrontPageTabsElementHeading_08_'.$id]));		
	if ( isset($_POST['dt_FrontPageTabsElementContent_08_'.$id]) ) update_option('dt_FrontPageTabsElementContent_08_'.$id,stripslashes($_POST['dt_FrontPageTabsElementContent_08_'.$id]));			
	if ( isset($_POST['dt_FrontPageFromBlog_'.$id]) ) update_option('dt_FrontPageFromBlog_'.$id,stripslashes($_POST['dt_FrontPageFromBlog_'.$id]));	
	if ( isset($_POST['dt_FrontPageFBCount_'.$id]) ) update_option('dt_FrontPageFBCount_'.$id,stripslashes($_POST['dt_FrontPageFBCount_'.$id]));					
	if ( isset($_POST['dt_FrontPageFromBlogWidth_'.$id]) ) update_option('dt_FrontPageFromBlogWidth_'.$id,stripslashes($_POST['dt_FrontPageFromBlogWidth_'.$id]));					
	if ( isset($_POST['dt_FrontPageFromBlogHeading_'.$id]) ) update_option('dt_FrontPageFromBlogHeading_'.$id,stripslashes($_POST['dt_FrontPageFromBlogHeading_'.$id]));						
	if ( isset($_POST['dt_FrontPageFromBlogCategory_'.$id]) ) $dt_FrontPageFromBlogCategory = implode(',',$_POST['dt_FrontPageFromBlogCategory_'.$id]); else $dt_FrontPageFromBlogCategory = ''; update_option('dt_FrontPageFromBlogCategory_'.$id,$dt_FrontPageFromBlogCategory);
	if ( isset($_POST['dt_FrontPageFromBlogMore_'.$id]) ) update_option('dt_FrontPageFromBlogMore_'.$id,stripslashes($_POST['dt_FrontPageFromBlogMore_'.$id]));		
	if ( isset($_POST['dt_FrontLatestWork_'.$id]) ) update_option('dt_FrontLatestWork_'.$id,stripslashes($_POST['dt_FrontLatestWork_'.$id]));					
	if ( isset($_POST['dt_FrontLatestWorkHeading_'.$id]) ) update_option('dt_FrontLatestWorkHeading_'.$id,stripslashes($_POST['dt_FrontLatestWorkHeading_'.$id]));						
	if ( isset($_POST['dt_FrontLatestWorkPortfolio_'.$id]) ) $dt_FrontLatestWorkPortfolio = implode(',',$_POST['dt_FrontLatestWorkPortfolio_'.$id]); else $dt_FrontLatestWorkPortfolio = ''; update_option('dt_FrontLatestWorkPortfolio_'.$id,$dt_FrontLatestWorkPortfolio);	
	if ( isset($_POST['dt_FrontLatestWorkPortfolioCount_'.$id]) ) update_option('dt_FrontLatestWorkPortfolioCount_'.$id,stripslashes($_POST['dt_FrontLatestWorkPortfolioCount_'.$id]));	
	if ( isset($_POST['dt_FrontLatestWorkDesc_'.$id]) ) update_option('dt_FrontLatestWorkDesc_'.$id,stripslashes($_POST['dt_FrontLatestWorkDesc_'.$id]));						
	if ( isset($_POST['dt_FrontLatestWorkDescHeading_'.$id]) ) update_option('dt_FrontLatestWorkDescHeading_'.$id,stripslashes($_POST['dt_FrontLatestWorkDescHeading_'.$id]));						
	if ( isset($_POST['dt_FrontLatestWorkDescDescription_'.$id]) ) update_option('dt_FrontLatestWorkDescDescription_'.$id,stripslashes($_POST['dt_FrontLatestWorkDescDescription_'.$id]));							
	if ( isset($_POST['dt_FrontLatestWorkDescButtonText_'.$id]) ) update_option('dt_FrontLatestWorkDescButtonText_'.$id,stripslashes($_POST['dt_FrontLatestWorkDescButtonText_'.$id]));
	if ( isset($_POST['dt_FrontLatestWorkDescButtonUrl_'.$id]) ) update_option('dt_FrontLatestWorkDescButtonUrl_'.$id,stripslashes($_POST['dt_FrontLatestWorkDescButtonUrl_'.$id]));	
	if ( isset($_POST['dt_FrontLatestWorkDescPortfolio_'.$id]) ) $dt_FrontLatestWorkDescPortfolio = implode(',',$_POST['dt_FrontLatestWorkDescPortfolio_'.$id]); else $dt_FrontLatestWorkDescPortfolio = ''; update_option('dt_FrontLatestWorkDescPortfolio_'.$id,$dt_FrontLatestWorkDescPortfolio);		
	if ( isset($_POST['dt_FrontLatestWorkDescCount_'.$id]) ) update_option('dt_FrontLatestWorkDescCount_'.$id,stripslashes($_POST['dt_FrontLatestWorkDescCount_'.$id]));	
	if ( isset($_POST['dt_FrontCallToAction_'.$id]) ) update_option('dt_FrontCallToAction_'.$id,stripslashes($_POST['dt_FrontCallToAction_'.$id]));						
	if ( isset($_POST['dt_FrontCallToActionText_'.$id]) ) update_option('dt_FrontCallToActionText_'.$id,stripslashes($_POST['dt_FrontCallToActionText_'.$id]));							
	if ( isset($_POST['dt_FrontCallToActionButtonText_'.$id]) ) update_option('dt_FrontCallToActionButtonText_'.$id,stripslashes($_POST['dt_FrontCallToActionButtonText_'.$id]));								
	if ( isset($_POST['dt_FrontCallToActionButtonUrl_'.$id]) ) update_option('dt_FrontCallToActionButtonUrl_'.$id,stripslashes($_POST['dt_FrontCallToActionButtonUrl_'.$id]));									
	if ( isset($_POST['dt_FrontPageContact_'.$id]) ) update_option('dt_FrontPageContact_'.$id,stripslashes($_POST['dt_FrontPageContact_'.$id]));
	if ( isset($_POST['dt_FrontPageContactHeading_'.$id]) ) update_option('dt_FrontPageContactHeading_'.$id,stripslashes($_POST['dt_FrontPageContactHeading_'.$id]));
	if ( isset($_POST['dt_FrontPageContactRecaptcha_'.$id]) ) update_option('dt_FrontPageContactRecaptcha_'.$id,stripslashes($_POST['dt_FrontPageContactRecaptcha_'.$id]));	
	if ( isset($_POST['dt_FrontPageContactDestination_'.$id]) ) update_option('dt_FrontPageContactDestination_'.$id,stripslashes($_POST['dt_FrontPageContactDestination_'.$id]));		
	if ( isset($_POST['dt_FrontPageContactField1_'.$id]) ) update_option('dt_FrontPageContactField1_'.$id,stripslashes($_POST['dt_FrontPageContactField1_'.$id]));
	if ( isset($_POST['dt_FrontPageContactField2_'.$id]) ) update_option('dt_FrontPageContactField2_'.$id,stripslashes($_POST['dt_FrontPageContactField2_'.$id]));
	if ( isset($_POST['dt_FrontPageContactField3_'.$id]) ) update_option('dt_FrontPageContactField3_'.$id,stripslashes($_POST['dt_FrontPageContactField3_'.$id]));	
	if ( isset($_POST['dt_FrontPageContactField4_'.$id]) ) update_option('dt_FrontPageContactField4_'.$id,stripslashes($_POST['dt_FrontPageContactField4_'.$id]));	
	if ( isset($_POST['dt_FrontPageContactField5_'.$id]) ) update_option('dt_FrontPageContactField5_'.$id,stripslashes($_POST['dt_FrontPageContactField5_'.$id]));	
	if ( isset($_POST['dt_FrontPageContent_'.$id]) ) update_option('dt_FrontPageContent_'.$id,stripslashes($_POST['dt_FrontPageContent_'.$id]));
	if ( isset($_POST['dt_FrontPagePartners_'.$id]) ) update_option('dt_FrontPagePartners_'.$id,stripslashes($_POST['dt_FrontPagePartners_'.$id]));
	if ( isset($_POST['dt_FrontPagePartnersTitle_'.$id]) ) update_option('dt_FrontPagePartnersTitle_'.$id,stripslashes($_POST['dt_FrontPagePartnersTitle_'.$id]));			
	if ( isset($_POST['dt_FrontPagePartnersDetails_'.$id]) ) update_option('dt_FrontPagePartnersDetails_'.$id,stripslashes($_POST['dt_FrontPagePartnersDetails_'.$id]));		
}

add_action('admin_menu', 'fpm_admin_menu');
?>