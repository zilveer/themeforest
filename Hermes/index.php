<?php
/**
 * The main template file.
 *
 * @package WordPress
 */

session_start();
$pp_homepage_hide_slider = get_option('pp_homepage_hide_slider');
				
get_header(); ?>		
		
		<div class="border30 top"></div>
		
		<?php
			$pp_advance_enable_switcher = get_option('pp_advance_enable_switcher');
						
			if(!empty($pp_advance_enable_switcher) && isset($_SESSION['pp_slider_effect']))
			{
			    $pp_slider_effect = $_SESSION['pp_slider_effect'];
			}
			else
			{
			    $pp_slider_effect = get_option('pp_slider_effect');
			}
		?>
		
		</div>
		<!-- End header -->
		
			<div id="slider_wrapper" <?php if($pp_slider_effect=='jQuery') { ?>style="background:none;margin-top:-267px"<?php } ?>>
			
				<?php
						switch($pp_slider_effect)
						{
							case 'jQuery':
								include (TEMPLATEPATH . "/templates/template-slider-jQuery.php");
							break;
							case 'accordion':
								include (TEMPLATEPATH . "/templates/template-slider-accordion.php");
							break;
							
							case '3D':
						?>
							
								<div id="flashcontent">
        							<p>You need to <a href="http://www.adobe.com/products/flashplayer/" target="_blank">upgrade your Flash Player</a> to version 10 or newer.</p>
        						</div><!-- end flashcontent -->
								<script type="text/javascript">
        						    var flashvars = {};
        						    flashvars.xmlSource = "<?php echo get_template_directory_uri(); ?>/piecemakerXML.php";
        						    flashvars.cssSource = "<?php echo get_template_directory_uri(); ?>/piecemakerCSS.css";
        						    flashvars.imageSource = "<?php echo get_template_directory_uri(); ?>/timthumb.php";
        						    var attributes = {};
        						    attributes.wmode = "transparent";
        						    swfobject.embedSWF("<?php echo get_template_directory_uri(); ?>/piecemakerNoShadow.swf", "flashcontent", "960", "530", "10", "<?php echo get_template_directory_uri(); ?>/swfobject/expressInstall.swf", flashvars, attributes);
        						</script>
							
				<?php
							break;
							
							default:
								include (TEMPLATEPATH . "/templates/template-slider-nivo.php");
						}
				?>
				
			</div>
			
			<div id="header_pattern"></div>
			<div class="curve"></div>
			
			<!-- Begin content -->
			<div id="content_wrapper">
			
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper">
				
				<?php
					if($pp_slider_effect == 'roundabout')
				    {
				?>
					
					<br class="clear"/><br/>
				
				<?php  
				    }
				?>
			
				<div class="standard_wrapper">
					<?php
					    if(true)
					    {
					    	$pp_homepage_tagline = get_option('pp_homepage_tagline');
					    	$pp_homepage_tagline_button = get_option('pp_homepage_tagline_button');
					    	if(empty($pp_homepage_tagline_button))
					    	{
					    		$pp_homepage_tagline_button = 'Buy Now';
					    	}
					    	
					    	$pp_homepage_tagline_button_url = get_option('pp_homepage_tagline_button_url');
					?>		
					    
					<div class="tagline">
					    <div class="tagline_inner">
					    	<?php echo html_entity_decode(stripcslashes($pp_homepage_tagline)); ?>
					    </div>
					    <a class="tagline_button" href="<?php echo stripcslashes($pp_homepage_tagline_button_url); ?>"><span><?php echo stripcslashes($pp_homepage_tagline_button); ?></span></a>
					    <br class="clear"/>
					</div>
					<hr/><br/>
					
					<?php
					    } //end if hide tagline
					?>
				
					<br class="clear"/>
					
					<?php 
							if(isset($_SESSION['pp_home_style']))
							{
								switch($_SESSION['pp_home_style'])
								{
									case 1:
										$pp_homepage_content = array(1641, 11);
										break;
									case 2:
										$pp_homepage_content = array(11);
										break;
									case 3:
										$pp_homepage_content = array(50);
										break;
									case 4:
										$pp_homepage_content = array(1797);
										break;
									case 5:
										$pp_homepage_content = array(1638, 11);
										break;
									default:
										$pp_homepage_content = array(1641, 11);
										break;
								}
							}
							else
							{
								$pp_homepage_content = unserialize(get_option('pp_homepage_content_sort_data'));
							}
							
							global $wp_query;

							if(is_array($pp_homepage_content) && !empty($pp_homepage_content))
							{
							
								foreach($pp_homepage_content as $key => $pp_homepage)
								{
									$template_name = get_post_meta( $pp_homepage, '_wp_page_template', true );

									if(empty($template_name) OR $template_name == 'default')
									{
									    $obj_home = get_page($pp_homepage);
									    $pp_home_content = $obj_home->post_content;
									    
									    if($key > 0)
									    {
									    	echo '<hr/><br class="clear"/><br/><br/>';
									    }
									    
									    $page_style = get_post_meta($pp_homepage, 'page_style', true);
										$page_sidebar = get_post_meta($pp_homepage, 'page_sidebar', true);
										
										if(empty($page_sidebar))
										{
											$page_sidebar = 'Page Sidebar';
										}
										
										if(empty($page_style))
										{
											$page_style = 'Fullwidth';
										}
										
										$add_sidebar = FALSE;
										$sidebar_class = '';
										
										if($page_style == 'Right Sidebar')
										{
											$add_sidebar = TRUE;
											$page_class = 'sidebar_content';
										}
										elseif($page_style == 'Left Sidebar')
										{
											$add_sidebar = TRUE;
											$page_class = 'sidebar_content';
											$sidebar_class = 'left_sidebar';
										}
										else
										{
											$page_class = 'inner_wrapper';
										}
									    
						?>
						
					<?php
						if($add_sidebar && $page_style == 'Left Sidebar')
						{
					?>
						<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
						
							<div class="sidebar_top <?php echo $sidebar_class; ?>"></div>
						
							<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
							
								<div class="content">
							
									<ul class="sidebar_widget">
									<?php dynamic_sidebar($page_sidebar); ?>
									</ul>
								
								</div>
						
							</div>
							<br class="clear"/>
					
							<div class="sidebar_bottom <?php echo $sidebar_class; ?>"></div>
						</div>
					<?php
						}
					?>
					
					<?php if($add_sidebar) { ?>
						<div class="sidebar_content <?php echo $sidebar_class; ?>">
					<?php } ?>
					
					<?php echo do_shortcode($pp_home_content); ?>
					
					<?php if($add_sidebar) { ?>
						</div>
					<?php } ?>
					
					<?php
						if($add_sidebar && $page_style == 'Right Sidebar')
						{
					?>
					
						<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
						
							<div class="sidebar_top <?php echo $sidebar_class; ?>"></div>
						
							<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
							
								<div class="content">
							
									<ul class="sidebar_widget">
									<?php dynamic_sidebar($page_sidebar); ?>
									</ul>
								
								</div>
						
							</div>
							<br class="clear"/>
					
							<div class="sidebar_bottom <?php echo $sidebar_class; ?>"></div>
						</div>
					<?php
						}
					?>
						
						<?php
									}
									else
									{
									    $hide_header = TRUE;
									    
									    if($key > 0)
									    {
									    	echo '<br class="clear"/><div class="line_shadow full"></div><br class="clear"/><br/>';
									    }
									    
									    if(file_exists(TEMPLATEPATH.'/'.$template_name))
									    {
									    	include(TEMPLATEPATH.'/'.$template_name);
									    }
									}
									
								if(isset($pp_homepage_content[$key+1]))
								{	
						?>
						
								<br class="clear"/><br/>
						
						<?php	}
									
								}
							}
						?>
				</div>
				
			<br class="clear"/><br/>
		
		</div>
		</div>

<?php get_footer(); ?>