<?php
$wizardname = "Quick Setup Wizard";
$themename = "epic_framework";
$shortname = "epic";

function epic_add_wizard() {
 
global $themename, $wizardname, $shortname, $options;

if (isset($_REQUEST["page"]) && $_REQUEST["page"] == basename(__FILE__) ) {
if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "save"){
		
		if (isset($_POST['upload_wizard_logo'])) {
			
		$logo = $_POST['upload_wizard_logo'];
		update_option('epic_logo_url',$logo);
		}

		
		if (isset($_POST['contact_email']) && $_POST['contact_email'] != '') {
			
		$contactmail = $_POST['contact_email'];
		update_option('epic_form_mail',$contactmail);

		}
		
		if (isset($_POST['twitter_user']) && $_POST['twitter_user'] != '') {
			
		$twitteruser = $_POST['twitter_user'];
		update_option('epic_twitter_user',$twitteruser);

		}
		

		// Create sample data
		
		// Sample pages
		if(isset($_POST['sample_pages'])){
			require_once(EPIC_ADMIN.'/sample_data/sample_pages.php');
		}
		
		// Sample posts
		if(isset($_POST['sample_posts'])){
			require_once(EPIC_ADMIN.'/sample_data/sample_posts.php');	
		}
		
		
		// Sample portfolio
		if(isset($_POST['sample_portfolio'])){
			require_once(EPIC_ADMIN.'/sample_data/sample_portfolio.php');	
		}
						
		// Sample slides
		if(isset($_POST['sample_slides'])){
			require_once(EPIC_ADMIN.'/sample_data/sample_slides.php');	
		}
		
		// Sample teasers
		if(isset($_POST['sample_teasers'])){
			require_once(EPIC_ADMIN.'/sample_data/sample_teasers.php');	
		}
		
				  
		header("Location: admin.php?page=wizard.php&saved=true");
				
	die;
	
	
 
} 
else if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "reset"){
 
	header("Location: admin.php?page=wizard.php&reset=true");
	
die;
}
}


}

function epic_wizard_add_init() {

$file_dir=  get_template_directory_uri ('template_directory');
$css_dir=  	get_template_directory_uri ('template_directory').'/library/admin/css';
$js_dir=	get_template_directory_uri ('template_directory').'/library/admin/js';

}

function epic_wizard_add_js(){

	$js_dir=	get_template_directory_uri('template_directory').'/library/admin/js';
	
	$currpage = $_SERVER['REQUEST_URI'];
	$pagename = 'page=wizard.php';

	if (strpos($currpage,$pagename)) {
		echo '<script type="text/javascript" src="'.$js_dir.'/script.js"></script>';
	}


}

function epic_theme_wizard() {
 
global $themename, $wizardname, $shortname, $options;
$i=0;
?>
<div class="wrap">
<div id="icon-tools" class="icon32"></div>

<?php if (isset($_REQUEST['saved'] )) {?>

	
	<h2><?php _e('Success!','epic');?></h2>
	<p><?php _e('The sample content has now been installed','epic');?></p>
	<p><a href="<?php echo get_admin_url().'admin.php?page=epicadmin.php';?>" class="button final">Take me to the theme options page</a></p>


<?php }?>


<?php if (!isset($_REQUEST['saved'] )) {?>

<h2><?php _e('Install sample content','epic'); ?></h2>
<p><?php _e('Installing sample content can greatly help you understand how the theme works.','epic');?></p>

<form method="post">
	
	<h4>Choose what to import</h4>
	
	<p><label><input type="checkbox" name="sample_pages" id="sample_pages" value="epic_sample_pages" /> Install demo pages</label></p>
	<p><label><input type="checkbox" name="sample_posts" id="sample_posts" value="epic_sample_posts" /> Blog posts</label></p>
	<?php if(current_theme_supports('epic_posttype_slide')):?>
	<p class="float"><label><input type="checkbox" name="sample_slides" id="sample_slides" value="epic_sample_slides" /> Slides</label></p>
	<?php endif;?>
	<?php if(current_theme_supports('epic_posttype_portfolio')):?>
	<p class="float"><label><input type="checkbox" name="sample_portfolio" id="sample_portfolio" value="epic_sample_portfolio" /> Portfolio</label></p>
	<?php endif;?>
	<?php if(current_theme_supports('epic_posttype_products')):?>
	<p class="float"><label><input type="checkbox" name="sample_products" id="sample_products" value="epic_sample_products" /> Products</label></p>
	<?php endif;?>
	<?php if(current_theme_supports('epic_posttype_news')):?>
	<p class="float"><label><input type="checkbox" name="sample_news" id="sample_news" value="epic_sample_news" /> News</label></p>
	<?php endif;?>
	<?php if(current_theme_supports('epic_posttype_faq')):?>
	<p class="float"><label><input type="checkbox" name="sample_faq" id="sample_faq" value="epic_sample_faq" /> FAQ</label></p>
	<?php endif;?>
	<?php if(current_theme_supports('epic_posttype_teaser')):?>
	<p class="float"><label><input type="checkbox" name="sample_teasers" id="sample_teasers" value="epic_sample_teasers" /> Teasers</label></p>
	<?php endif;?>
	
	<p class="sumbit"><input type="submit" name="nextpage"  class="button-primary" value="Install sample content" /></p>
	<input type="hidden" name="action" value="save" />


</form>
<?php }?>
 

<?php
}

add_action('admin_head', 'epic_wizard_add_js');
add_action('admin_init', 'epic_wizard_add_init');


add_action('admin_menu', 'epic_add_wizard');
?>