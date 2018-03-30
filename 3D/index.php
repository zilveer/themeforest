<?php
/**
 * @package WordPress
 * @subpackage 3D
 * @since Idea 3D
 * Graphic Desing : Ilkay ALPGIRAY
 * Code : Mustafa TANRIVERDI
 */
?>
<?php global $wpdb;	$prefix = $wpdb->prefix; ?>
<?php get_header(); ?>

<?php if(get_option('im_theme_show_tab_menu', true) == 'true'){ ?>
	<!-- Tab Menu Slide -->
	<div class="tabmenu-back"></div>
    
    <div class="dot-tab"></div>
    <div class="grid_24 tabmenu">
    	<div class="tabmenu-light"></div>
    	<div id="le-tabs" class="example grey le-menu dark full-width">
			
			<!-- Tab Menu Button -->
			<ul id="le-tabs_tab_container">
				<?php
                $query_homepage_slider = mysql_query("SELECT * FROM ".$prefix."iam WHERE title='homepage_tab' ORDER BY id ASC");
                while($list_homepage_slider = mysql_fetch_assoc($query_homepage_slider))
                {
                    $q_homepage_id = $list_homepage_slider['id'];
                    $q_homepage_image_url = $list_homepage_slider['value1'];
                    $q_homepage_title = $list_homepage_slider['value2'];
                    $q_homepage_link = $list_homepage_slider['value3'];
                    $q_homepage_description = $list_homepage_slider['value4'];
                ?>
                    <li> <a> <span class="tabmenu-icon"><img src="<?php echo $q_homepage_image_url; ?>" alt="" width="45" height="45"></span> <?php echo $q_homepage_title; ?></a> </li>
                
                <?php
                }
                ?>
            </ul> <!-- /#tabs_tab_container -->
			
			<!-- Tab Menu Content -->
			<div id="le-tabs_content_container">
				<div id="le-tabs_content_inner">
					
                    
                <?php
                $query_homepage_slider = mysql_query("SELECT * FROM ".$prefix."iam WHERE title='homepage_tab' ORDER BY id ASC");
                while($list_homepage_slider = mysql_fetch_assoc($query_homepage_slider))
                {
                    $q_homepage_id = $list_homepage_slider['id'];
                    $q_homepage_image_url = $list_homepage_slider['value1'];
                    $q_homepage_title = $list_homepage_slider['value2'];
                    $q_homepage_description1 = $list_homepage_slider['value3'];
                    $q_homepage_description2 = $list_homepage_slider['value4'];
					$q_homepage_tab_style = $list_homepage_slider['value5'];
					$q_homepage_tab_category_id = $list_homepage_slider['value6'];
                ?>
                    <!-- #TAB  -->
					<div class="le-tabs_content tabmenu-content">
						<h1 class="tabmenu-bigtitle"><?php echo $q_homepage_description1; ?></h1>
						<h2 class="tabmenu-subtitle"><?php echo  $q_homepage_description2; ?></h2>
						
                        
                        <?php include('inc/homepage_tab.php'); ?>
                        
                        
                        
					</div> <!-- /.tabmenu-content -->
					<!-- /TAB  -->
                
                <?php
                }
                ?>
					
				</div> <!-- /#le-tabs_content_inner -->
			</div> <!-- /#le-tabs_content_container -->
		</div> <!-- /.example grey le-menu dark full-width -->
    </div> <!-- /.grid_24 tabmenu -->
    
    <div class="clear"></div>
<?php } ?>

<?php if(get_option('im_theme_show_3_column', true) == 'true'){ ?>    
    <!-- THREE BOTTOM AREA -->
    <div class="margin bottom-stage">
    <div id="bottom-area"></div>
		<?php include_once('inc/homepage_3_column_area.php'); ?>
    </div>
    
    <div class="clear"></div>
<?php } ?>


<?php get_footer(); ?>