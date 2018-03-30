<?php
function admin_interface(){ 

	global $options;

	if (isset($_GET['page']) && $_GET['page']=='admin_interface') {
		
		$pix_theme = wp_get_theme();
		?>

<script type="text/javascript">
	//<![CDATA[
		<?php if (isset($_GET['demo']) && $_GET['demo']=='true') { ?>
			var geode_demo_mode = true;
		<?php } ?>
	    <?php if ( isset($_REQUEST['action']) && $_REQUEST['action']=='data_save' ) { ?>
			var geode_data_saved = true;
		<?php } ?>
            /*if ( typeof google == 'undefined' ) {
            	location.reload();
            }*/
            var pix_google_enabled = "<?php echo get_option('pix_style_enable_google_fonts'); ?>";
            google.load("webfont", "1");
	//]]>
</script>

	<?php

	/******************************
	*
	*	Import admin panel options
	*
	******************************/
		$upload_dir = wp_upload_dir();
		$upload_dir = $upload_dir['basedir'];
		foreach($_FILES as $key => $file) {
			if ( $key == 'file' ) {
				move_uploaded_file($_FILES[$key]["tmp_name"],
				$upload_dir .'/'. $_FILES[$key]["name"]);
				pix_import_export($upload_dir .'/'. $_FILES[$key]["name"], $_POST['geode_set_import']);
			}
		}

	/******************************
	*
	*	Save option (for the AJAX method look pix_functions.php -> geode_save_ajax() )
	*
	******************************/
		foreach ($_REQUEST as $key => $value) {
			$value = geode_remove_protocol($value);
			if ( preg_match("/pix_geode_array/", $key) ) {
				delete_option($key);
				add_option($key, $value);
			} elseif ( preg_match("/pix_sidebar_generator/", $key ) && $_REQUEST['sidebar_action']=='add_a_sidebar' ) {
				$sidebar_generator_pix = new sidebar_generator_pix(); 
			    $sidebars = $sidebar_generator_pix->get_sidebars();
				$sidebar_name = str_replace(array("\n","\r","\t"),'',$value);
				$sidebar_id = $sidebar_generator_pix->name_to_class($sidebar_name);
				if($sidebar_id == '' ){
					$options_sidebar = $sidebars;
				} else {
					if(isset($sidebars[$sidebar_id])){

					}
					if ( is_array($sidebars) ) {
						$new_sidebar_gen[$sidebar_id] = $sidebar_id;
						$options_sidebar = array_merge($sidebars, (array) $new_sidebar_gen);	
					} else{
						$options_sidebar[$sidebar_id] = $sidebar_id;
					}		
				}
				update_option( 'pix_sidebar_generator', $options_sidebar);
			} elseif ( preg_match("/sidebar_removed/", $key) ) {
				$sidebar_generator_pix = new sidebar_generator_pix(); 
				$sidebars_widgets = get_option('sidebars_widgets'); //all the widgets in the sidebars
				$sidebars = $sidebar_generator_pix->get_sidebars(); //all the sidebar containes you created
				$count = count($sidebars); //count of the sidebars you created
				$widgets_arr = array(); //a new array for the sidebars you created that contain widgets
				$i = $value; //$i is the same of $value, $value is the number the loop starts from
				while ($i <= $count) {
					if(isset($sidebars_widgets['pix_sidebar-'.($i+1)])) {
						array_push($widgets_arr,$sidebars_widgets['pix_sidebar-'.($i+1)]);
					} else {
						array_push($widgets_arr,'');
					}
					$i++;
				}
				$i = $value; //$i is the same of $value, $value is the number the loop starts from
				$i2 = 0; //$i2 is 0 so I associate any old widget position to the new one, after removing a sidebar
				while ($i <= $count) {
					if($widgets_arr[$i2]!=''){
						$sidebars_widgets['pix_sidebar-'.$i] = $widgets_arr[$i2];
					}
					$i++;
					$i2++;
				}
				if($count==1){
					$count = 0;
				}
				unset($sidebars_widgets['pix_sidebar-'.($count+1)]); //I remove the last sidebar
				update_option('sidebars_widgets',$sidebars_widgets);
			} elseif ( preg_match("/pix_sidebar_generator/", $key) && $_REQUEST['sidebar_action']=='remove_a_sidebar' ) {
				if($value != '') {
					$options_sidebar[ $value ] = $value;
					update_option( 'pix_sidebar_generator', $options_sidebar);
				}
			} elseif ( $key=='register_license_details' && $value=="register_license_details" ) {
				$context = $_REQUEST;
                geode_check_license($context);
			} else {
				if(isset($_REQUEST[$key]) ) {
					update_option($key, $value);
					if ( $key=='pix_style_select_fonts')
						do_action('geode_update_font_variants');
				}
			}
			if (get_option('pix_content_allow_ajax')!='true') {
				geode_compile_css();
			}
		}
	?>

<div id="pix_ap_wrap">
	<header id="pix_ap_header" class="cf">
		<section class="alignleft">
			<h2>Geode admin panel</h2>
		</section><!-- .alignleft -->
		<section class="alignright">
			<h5><?php _e('Version','geode'); ?> <?php echo $pix_theme->get( 'Version' ); ?><?php do_action('pix_check_update'); ?></h5>
			<a href="http://www.pixedelic.com/geode_current_version_changelog.php" class="pix_button pix-iframe" id="pix-changelog"><?php _e('See the changelog','geode'); ?></a>
		</section><!-- .alignright -->
	</header><!-- #pix_ap_header -->

	<section id="pix_ap_body" class="cf">
		<div id="pix_ap_main_nav_fake">
		</div><!-- #pix_ap_main_nav_fake -->
		<nav id="pix_ap_main_nav">
			<ul>
				<li class="cf" data-store="general">
					<a href="#">
						<i class="scicon-awesome-cog"></i>
					</a>
					<ul>
                    	<li data-store="very-general">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=admin_panel"><?php _e('Very general','geode'); ?></a>
                        </li>
						<li data-store="import-export">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=import_export"><?php _e('Import/export','geode'); ?></a>
						</li>
						<li data-store="layout">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=layout_panel"><?php _e('Layout','geode'); ?></a>
						</li>
						<li data-store="top-bar">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=top_bar"><?php _e('Top bar','geode'); ?></a>
						</li>
						<li data-store="header">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=header_panel"><?php _e('Header','geode'); ?></a>
						</li>
						<li data-store="navigation-menu">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=nav_panel"><?php _e('Navigation menu','geode'); ?></a>
						</li>
						<li data-store="footer">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=footer_panel"><?php _e('Top sliding bar and footer','geode'); ?></a>
						</li>
						<li data-store="sidebar-section">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=sidebar_panel"><?php _e('Sidebar section','geode'); ?></a>
						</li>
						<li data-store="append-scripts">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=append_scripts"><?php _e('Append scripts','geode'); ?></a>
						</li>
					</ul>
				</li>
				<li class="cf" data-store="typography">
					<a href="#">
						<i class="scicon-awesome-font"></i>
					</a>
					<ul>
                    	<li data-store="google-fonts">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=google_fonts"><?php _e('Google fonts','geode'); ?></a>
                        </li>
                    	<li data-store="main-typography">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=main_typography"><?php _e('Main typography','geode'); ?></a>
                        </li>
                    </ul>
				</li>
				<li class="cf" data-store="colors">
					<a href="#">
						<i class="scicon-entypo-palette"></i>
					</a>
					<ul>
						<li data-store="layout-colors">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=layout_colors_panel"><?php _e('Body and page wrap','geode'); ?></a>
						</li>
						<li data-store="top-bar-colors">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=top_bar_colors"><?php _e('Top bar colors','geode'); ?></a>
						</li>
						<li data-store="navigation-menu-color">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=nav_panel"><?php _e('Navigation menu','geode'); ?></a>
						</li>
						<li data-store="title-section">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=title_section_panel"><?php _e('Title section','geode'); ?></a>
						</li>
						<li data-store="main-colors">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=main_elements_colors"><?php _e('Main elements','geode'); ?></a>
						</li>
						<li data-store="footer-colors">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=footer_colors"><?php _e('Footer colors','geode'); ?></a>
						</li>
						<li data-store="top-sliding-colors">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=top_sliding_colors"><?php _e('Top sliding bar colors','geode'); ?></a>
						</li>
						<li data-store="colorbox">
							<a href="<?php echo get_admin_url(); ?>admin.php?page=colorbox_panel"><?php _e('Plugins','geode'); ?></a>
						</li>
					</ul>
				</li>
				<li class="cf" data-store="sidebars">
					<a href="#">
						<i class="scicon-awesome-columns"></i>
					</a>
					<ul>
                    	<li data-store="sidebar-generator">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=sidebar_generator"><?php _e('Dynamic sidebars','geode'); ?></a>
                        </li>
                    </ul>
				</li>
				<li class="cf" data-store="blog">
					<a href="#">
						<i class="scicon-brandico-wordpress"></i>
					</a>
					<ul>
                    	<li data-store="latest-posts-page">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=latest_posts_page_panel"><?php _e('Latest posts page','geode'); ?></a>
                        </li>
                    	<li data-store="blog-pages">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=blog_pages_panel"><?php _e('Other blog pages','geode'); ?></a>
                        </li>
                    	<li data-store="categories">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=categories_panel"><?php _e('Categories and archives','geode'); ?></a>
                        </li>
                    	<li data-store="single_posts">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=posts_panel"><?php _e('Single posts','geode'); ?></a>
                        </li>
                    </ul>
				</li>
				<li class="cf" data-store="portfolio">
					<a href="#">
						<i class="scicon-awesome-briefcase"></i>
					</a>
					<ul>
                    	<li data-store="portfolio-panel">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=portfolio_panel"><?php _e('Portfolio archives','geode'); ?></a>
                        </li>
                    	<li data-store="portfolio-items">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=portfolio_items"><?php _e('Single portfolio pages','geode'); ?></a>
                        </li>
                    </ul>
				</li>
				<li class="cf" data-store="styles">
					<a href="#">
						<i class="scicon-awesome-code"></i>
					</a>
					<ul>
                    	<li data-store="custom-css">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=custom_css_admin"><?php _e('Custom CSS','geode'); ?></a>
                        </li>
                    </ul>
				</li>
				<li class="cf" data-store="register">
					<a href="#">
						<i class="scicon-awesome-lock-open-alt"></i>
					</a>
					<ul>
                    	<li data-store="register-theme">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=register_theme"><?php _e('Register theme','geode'); ?></a>
                        </li>
                    </ul>
				</li>
				<?php if ( pix_is_woocommerce_active() ) { ?>
				<li class="cf" data-store="woo">
					<a href="#">
						<i class="scicon-woocommerce-icon"></i>
					</a>
					<ul>
                    	<li data-store="shop-panel">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=shop_panel"><?php _e('Main shop page','geode'); ?></a>
                        </li>
                    	<li data-store="woo-panel">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=woo_panel"><?php _e('Product archives','geode'); ?></a>
                        </li>
                    	<li data-store="product-panel">
                        	<a href="<?php echo get_admin_url(); ?>admin.php?page=products_panel"><?php _e('Single product pages','geode'); ?></a>
                        </li>
                    </ul>
				</li>
				<?php } ?>
			</ul>
		</nav>
		<section id="pix_content_loaded" class="cf">
			<!-- loaded content here -->
		</section><!-- #pix_content_loaded.cf -->
	</section><!-- #pix_ap_body -->

	<div id="spinner_wrap">
    	<div id="spinner">
		    <span id="ball_1" class="spinner_ball"></span>
		    <span id="ball_2" class="spinner_ball"></span>
		    <span id="ball_3" class="spinner_ball"></span>
		    <span id="ball_4" class="spinner_ball"></span>
		    <span id="ball_5" class="spinner_ball"></span>
		</div>
    	<div id="spinner2">
		    <span id="ball_1_2" class="spinner_ball_2"></span>
		    <span id="ball_2_2" class="spinner_ball_2"></span>
		    <span id="ball_3_2" class="spinner_ball_2"></span>
		    <span id="ball_4_2" class="spinner_ball_2"></span>
		    <span id="ball_5_2" class="spinner_ball_2"></span>
		</div>
	</div>
</div><!-- #pix_ap_wrap -->

<?php

/*********** FONT SELECTOR ***********/

require_once(get_template_directory().'/functions/lib/admin/fonticon_generator.php' );
	
	}
}