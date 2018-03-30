<?php
/**
* Panel init.
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

/**
*   Load Panel Files
******************************************/

require_once VAN_PANEL . "/fields.class.php";
require_once VAN_PANEL . "/theme-options.php";

/**
* Default options
*/
$default_options = array(
	"breadcrumb"=>true,
	"post_layout"=>"one_col_sid",
	"display_content"=>"excerpt",
	"format_icon"=>true,
	"meta_author"=>true,
	"meta_date"=>true,
	"meta_comments"=>true,
	"meta_views"=>true,
	"meta_likes"=>true,
	"pagination"=>"ajax",
	"single_format_icn"=>true,
	"post_nav"=>true,
	"author_box"=>true,
	"single_comments"=>true,
	"single_author"=>true, 
	"single_date"=>true, 
	"single_views"=>true, 
	"single_likes"=>true, 
	"single_tag"=>true, 
	"share_post"=>true,
	"fb_button"=>true,
	"tweet_button"=>true,
	"google_button"=>true,
	"linkedin_button"=>true,
	"stumbleupon_button"=>true,
	"related_posts"=>true,
	"related_number"=>"5",
	"related_by"=>"category",
	"home_carousel"=> true,
	"logo-setting"=>"logo",
	"sitedesc"=> true,
	"header_social"=> true,
	"nav_search"=> true,
	"back-to-Top"=>true,
	"footer_menu"=>true,
	"footer-copyright"=>"Copyright &copy; 2013 Carino, All Rights Reserved.",
	"archives_rss"=> true,
	"sidebar"=> "right",
	"skin"=> "default"
	);
/**
* Run Option Panel Class's
************************************************/

$van_panel    = new VanOptionsPanel();
$fields_class = new optionsFields();
$van_panel->default_options = $default_options;
/**
* Option Page
************************************************/
function van_option_panel(){
	global $options,$van_panel,$fields_class;
    	?>
	<div id="vanPanelContainer">

		<div id="van-saved"></div>

		<form method="post" enctype="multipart/form-data" id="vanform">

			<input type="hidden" name="vannoncename" value="<?php echo wp_create_nonce('test-theme-data'); ?>">
			<input type="hidden" name="action" value="save_theme_data">

			<div id="vanPanelHeader" class="clearfix">

				<div class="themeLogo">
					
					<img src="<?php echo ADMIN_IMG; ?>/theme-logo.png">

				</div>

				<div class="theme-helpers">
					
					<div class="docs">
						<a target="_blank" href="http://demo.vanthemes.com/docs/<?php echo THEME_FOLDER; ?>">Documentation</a>
					</div>
					<div class="support">
						<a target="_blank" href="http://themeforest.net/user/VanThemes#from">Support</a>
					</div>
						
				</div>

				<div class="header-save">
					
					<?php $van_panel->van_save_button(); ?>

				</div>
				
			</div><!-- #vanPanelHeader -->

			<div id="panelNavigation">
				<ul>
					<?php 
						foreach ($options as $option) {
							$fields_class->van_fields($option,"menu");
						}
					?>
				</ul>
			</div>

			<div id="panelContent">
				
				<?php 
					foreach ($options as $option) {
						$fields_class->van_fields($option);
					}
				?>

			</div>

			<div class="clear"></div>

			<div class="footer-save">

				<?php $van_panel->van_save_button(); ?>

			</div>

		</form>

		<div class="footer-reset">

			<?php $van_panel->van_reset_button(); ?>

		</div>

	</div><!-- #vanPanelContainer -->
    <?php
	
}