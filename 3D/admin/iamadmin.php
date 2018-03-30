<?php if(file_exists('../../../../wp-config.php')){include_once('../../../../wp-config.php');} ?>
<?php
global $wpdb;
$prefix = $wpdb->prefix;
// instaltion
if(@mysql_num_rows(mysql_query("SELECT * FROM ".$prefix."iam WHERE title='TEST'")) > 0){}
else
{
	include_once('install_theme.php');
}

if(isset($_GET['themeInstall']))
{
	$mysqlDelete = mysql_query("DROP TABLE ".$prefix."iam");
	if($mysqlDelete == true)
	{
		include_once('install_theme.php');
	}
}
?>
<?php
include_once('lang.php');
function themeAdminPage()
{
	add_theme_page(get_lang('Page Title'), get_lang('Menu Title'), 'administrator', basename(__FILE__), 'themeAdmin', '../wp-content/themes/3D/admin/img/mini.png');
}

function themeAdmin()
{
	global $wpdb;	$prefix = $wpdb->prefix;
?>
<?php if(is_admin()){if(isset($_GET['page'])){include_once('func.php');}} ?>
<?php if(isset($_GET['page'])){ if(is_admin()){  ?>

	
    
<?php } } ?>


<!-- Container Start -->
<div class="container_16">

	<!-- #Menu -->
    <div class="grid_5 menu">
        
        <!-- #Logo -->
        <div class="logo"><img src="<?php bloginfo('template_url'); ?>/admin/img/logo.png" alt="Im Theme :)" /></div>
        
        <!-- #MAccordion Menu -->
        <ul class="accordion">
			<li id="one" class="files">
				<a href="#one"><img src="<?php bloginfo('template_url'); ?>/admin/image/home.png" class="icon" /> <span>General Options</span></a>
				<ul class="sub-menu">
                	<li><a href="#" title="p_general_logo.php" class="menu_list_click"><em>01</em><span><?php echo lang('Logo'); ?></span></a></li>
                    <li><a href="#" title="p_general_favicon.php" class="menu_list_click"><em>02</em><span><?php echo lang('Favicon'); ?></span></a></li>

                    <li><a href="#" title="p_general_analytics.php" class="menu_list_click"><em>03</em><span><?php echo lang('Google Analytics'); ?></span></a></li>
				</ul>
			</li>
            
            <li id="two" class="files">
				<a href="#one"><img src="<?php bloginfo('template_url'); ?>/admin/image/wand.png" class="icon" /> <span>Theme Style</span></a>
				<ul class="sub-menu">
                    <li><a href="#" title="p_general_style.php" class="menu_list_click"><em>01</em><span><?php echo lang('Theme Color'); ?></span></a></li>
                    <li><a href="#" title="p_general_lang.php" class="menu_list_click"><em>02</em><span><?php echo lang('General Language'); ?></span></a></li>
                    <li><a href="#" title="p_blog_sidebar_lang.php" class="menu_list_click"><em>03</em><span><?php lang('Sidebar Language'); ?></span></a></li>
                    <li><a href="#" title="p_portfolio_lang.php" class="menu_list_click"><em>04</em><span><?php lang('Portfolio Language'); ?></span></a></li>
				</ul>
			</li>
			
			<li id="three" class="mail">
				<a href="#two"><img src="<?php bloginfo('template_url'); ?>/admin/image/stamp.png" class="icon" /> <span>Slider</span></a>
				<ul class="sub-menu">
                	<li><a href="#" title="p_general_slider_options.php" class="menu_list_click"><em>01</em><span><?php lang('Slider Options'); ?></span></a></li>
                    <li><a href="#" title="p_general_slider_upload.php" class="menu_list_click"><em>02</em><span><?php lang('Slider Upload'); ?></span></a></li>
				</ul>
			</li>
            
            <li id="four" class="cloud">
				<a href="#three"><img src="<?php bloginfo('template_url'); ?>/admin/image/book_bookmark.png" class="icon" /> <span>Home Page</span></a>
				<ul class="sub-menu">
                	<li><a href="#" title="p_homepage_tab.php" class="menu_list_click"><em>01</em><span><?php lang('Tab Slider'); ?></span></a></li>
                    <li><a href="#" title="p_homepage_3_column_area.php" class="menu_list_click"><em>02</em><span><?php lang('3 Colomn Area'); ?></span></a></li>
                    <li><a href="#" title="p_homepage_module.php" class="menu_list_click"><em>03</em><span><?php lang('Module Enable / Disaple'); ?></span></a></li>
				</ul>
                
			</li>
			
            
            <li id="five" class="sign">
           		<a href="#four"><img src="<?php bloginfo('template_url'); ?>/admin/image/address_book.png" class="icon" /> <span>Other Page</span></a>
				<ul class="sub-menu">
                	<li><a href="#" title="p_portfolio.php" class="menu_list_click"><em>01</em><span><?php lang('Portfolio Page'); ?></span></a></li>
                    
                     <li><a href="#" title="p_general_contact.php" class="menu_list_click"><em>02</em><span><?php echo lang('Contact Page'); ?></span></a></li>
                     
                     <li><a href="#" title="p_port_logo_page.php" class="menu_list_click"><em>03</em><span><?php lang('Logo Page'); ?></span></a></li>
                     
				</ul>
			</li>
            
            <li id="six" class="sign">
				<a href="#four"><img src="<?php bloginfo('template_url'); ?>/admin/image/calendar.png" class="icon" /> <span>Sidebar</span></a>
				<ul class="sub-menu">
                	<li><a href="#" title="p_blog_sidebar.php" class="menu_list_click"><em>01</em><span><?php lang('Sidebar Options'); ?></span></a></li>
                    <li><a href="#" title="p_blog_sidebar_module.php" class="menu_list_click"><em>02</em><span><?php lang('Sidebar Module'); ?></span></a></li>
                    
				</ul>
			</li>
            
            <li id="seven" class="sign">
				<a href="#five"><img src="<?php bloginfo('template_url'); ?>/admin/image/switch.png" class="icon" /> <span>Footer</span></a>
				<ul class="sub-menu">
               	 	<li><a href="#" title="p_footer_area1.php" class="menu_list_click"><em>01</em><span><?php lang('Copright ©'); ?></span></a></li>
                	<li><a href="#" title="p_footer_social_buttons.php" class="menu_list_click"><em>02</em><span><?php lang('Social Buttons'); ?></span></a></li>
				</ul>
			</li>
            
            <li id="eight" class="sign">
				<a href="#five"><img src="<?php bloginfo('template_url'); ?>/admin/image/bubbles_lines.png" class="icon" /> <span>Support</span></a>
				<ul class="sub-menu">
                	<li><a href="#" title="p_developers.php" class="menu_list_click"><em>01</em><span><?php lang('Developers'); ?></span></a></li>
                    <li><a href="#" title="p_support_chat.php" class="menu_list_click"><em>02</em><span>Online Support</span></a></li>
                    <li><a href="#" title="p_support_video.php" class="menu_list_click"><em>03</em><span>Support Videos</span></a></li>
                    <li><a href="?page=iamadmin.php&themeInstall" onclick="return confirm('<?php echo lang('Are you sure?'); ?>');"><em>04</em><span>Re Instaltion</span></a></li>
                    
				</ul>
			</li>
            
		</ul>
    </div>
    <script>
	$(".menu_list_click").click(function(){
		$(".headerarea").hide();
		$(".headerarea").load("<?php bloginfo('template_url'); ?>/admin/pages/" + $(this).attr("title"));
		$(".headerarea").show();
	});
	
	
	
	</script>
    
    <style>
	.colorpicker{display:none;}
	</style>
    <!-- #Header -->
    <div class="grid_11">
    	<div class="headerarea">            
            <!-- #Bigtitle -->
            <div class="bigtitle">
                <h1 style="margin-bottom:20px;">I'M Theme - Other Themes</h1>
                <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/tr_TR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
			
            <div class="fb-like" data-href="http://www.facebook.com/imthemeoffical" data-send="true" data-width="560" data-show-faces="true" style="margin-bottom:-20px;"></div>
            
            </div> <!-- /.bigtitle -->
    
            <iframe src="http://imtheme.net/data/imadmin/imadmin.php" width="560" height="800" style="max-width:560px;" scrolling="no"></iframe>
            
            <div class="clear"></div> 
        </div> <!-- /.headerarea -->
    </div> <!-- /.grid_11 -->
</div> <!-- /.container_16 -->



         
<?php } ?>
<?php
add_action('admin_menu', 'themeAdminPage');
?>
<?php if(isset($_GET['page'])){include_once('func2.php');} ?>
