<?php

/*
 * Custom Importer
 * by www.unitedthemes.com
  */

defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );

/*
|--------------------------------------------------------------------------
| Demo Importer Menu Item
|--------------------------------------------------------------------------
*/
add_action('admin_menu', 'ut_demo_importer_menu');

if ( !function_exists( 'ut_demo_importer_menu' ) ) {
	
	function ut_demo_importer_menu() {
	
		add_submenu_page( 'unite-welcome-page' , 'Theme Demos' , 'Theme Demos' , 'manage_options' , 'ut_view_updater' , 'ut_view_updater' );
	
	}
	
}


/*
|--------------------------------------------------------------------------
| Demo Importer Styles
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'ut_importer_admin_add_scripts' ) ) {

	function ut_importer_admin_add_scripts() {
			
		wp_enqueue_style('ut-importer', THEME_WEB_ROOT . '/admin/assets/css/ut-importer.css');
		wp_enqueue_script( 'ut-importer', THEME_WEB_ROOT . '/admin/assets/js/ut-importer.js' );
					
	}
	
}

if ( isset($_GET['page']) && $_GET['page'] == 'ut_view_updater' ) {	
	add_action( 'admin_enqueue_scripts', 'ut_importer_admin_add_scripts' );
}


/*
|--------------------------------------------------------------------------
| Check if wp-content is writeable for demo images
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'ut_is_writable' ) ) {
	
	function ut_is_writable( $path ) {
	
		if ( $path{strlen($path)-1}=='/' ) {
			return ut_is_writable($path.uniqid(mt_rand()).'.tmp');
		}
		
		if (file_exists($path)) {
			if (!($f = @fopen($path, 'r+')))
				return false;
			fclose($f);
			return true;
		}
		
		if (!($f = @fopen($path, 'w')))
			return false;
		fclose($f);
		unlink($path);
		return true;
		
	}
	
}


/*
|--------------------------------------------------------------------------
| Demo Importer Interface
|--------------------------------------------------------------------------
*/

if ( !function_exists( 'ut_view_updater' ) ) {
	
	function ut_view_updater() { ?>
		
		<div id="ut-importer" class="wrap">
		
			<div class="icon32" id="icon-options-general"><br></div>
            <h2><?php _e( 'Theme Demo Importer' , 'unitedthemes' ); ?></h2>
            
			<?php 
			
			/*
			|--------------------------------------------------------------------------
			| Notifications
			|--------------------------------------------------------------------------
			*/
			if( file_exists( ABSPATH . 'wp-content/uploads/' ) ) {
				
				/* wp-content upload folder not writeable  */ 
				if( !ut_is_writable( ABSPATH . 'wp-content/uploads/' ) ) :
				
					echo '<div class="error"><p>';
						
						echo '<strong>' .__('Your upload folder is not writeable! The importer won\'t be able to import the placeholder images. Please check the folder permissions for', 'unitedthemes').'</strong><br />';
						echo ABSPATH . 'wp-content/uploads/';
						
					echo '</p></div>';
					
				endif;
				
			
			} else {
			
				/* wp-content folder not writeable  */ 
				if( !ut_is_writable( ABSPATH . 'wp-content/' ) ) :
					
					echo '<div class="error"><p>';
					
						echo '<strong>' .__('Your wp-content folder is not writeable! The importer won\'t be able to import the placeholder images. Please check the folder permissions for', 'unitedthemes').'</strong><br />';
						echo ABSPATH . 'wp-content/';
					
					echo '</p></div>';
					
				endif;
			
			}
			
			/* some plugins need to be installed before the importer can be executed */ 
			if( !ut_is_plugin_active('ut-portfolio/ut-portfolio.php') ) :
				
				echo '<div class="error"><p>'.__('Portfolio Management by UnitedThemes Plugin is not active, please activate it before importing the demo content.', 'unitedthemes').'</p></div>';
				
			endif;
			
			if( !ut_is_plugin_active('ut-pricing/ut-pricing.php') ) :
				
				echo '<div class="error"><p>'.__('Pricing Table Management by UnitedThemes Plugin is not active, please activate it before importing the demo content.', 'unitedthemes').'</p></div>';
				
			endif;
            
            if( !ut_is_plugin_active('js_composer/js_composer.php') ) :
				
				echo '<div class="error"><p>'.__('Visual Composer is not active, please activate it before importing the demo content.', 'unitedthemes').'</p></div>';
				
			endif;
			
			
			/* importer has been used before */
			if( get_option('ut_import_loaded') == 'active' ) :
				
				echo '<div class="error"><p>'.__('You already have imported the demo content before. Running this operation twice will result in double content!', 'unitedthemes').'</p></div>';
			
			endif;
			
			/* import was successful */
			if( isset($_GET['ut-import']) && $_GET['ut-import'] == 'success' ) : 
				
				echo '<div class="updated"><p>'.__('Import was successful, have fun!', 'unitedthemes').'</p></div>';
			
			endif; 
			
			?>
            
            <form id="ut-importer-form" method="POST" action="?page=ut_view_updater" class="form-horizontal">
            
            <div class="xml">
                <input type="radio" id="demo_one" name="ut_demo_file" value="demo_one" checked class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_one">
                    
                    <span class="ut-new-badge">1</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo1.jpg" />
                    
                </label>
                <h3 class="xml-name">
                    Brooklyn Main Demo                
                </h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/basic" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_two" name="ut_demo_file" value="demo_two" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_two">
                    
                    <span class="ut-new-badge">2</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo2.jpg" />
                    
                </label>
                <h3 class="xml-name">
                    Creative Agency #1
                </h3>
               	<div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/extended" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_three" name="ut_demo_file" value="demo_three" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_three">
                    
                    <span class="ut-new-badge">3</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo3.jpg" />
                    
                </label>
                <h3 class="xml-name">Creative Agency #2</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/elegant" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_four" name="ut_demo_file" value="demo_four" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_four">
                   
                   <span class="ut-new-badge">4</span>
                    <div class="ut-selected-overlay"></div>
                   <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo4.jpg" />
                   
                </label>
                 <h3 class="xml-name">Business #1</h3>
                 <div class="xml-actions">
                 	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/business" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                 </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_five" name="ut_demo_file" value="demo_five" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_five">
                    
                    <span class="ut-new-badge">5</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo5.jpg" />
                    
                </label>
                <h3 class="xml-name">Business #2</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo5" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_six" name="ut_demo_file" value="demo_six" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_six">
                    
                    <span class="ut-new-badge">6</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo6.jpg" />
                    
                </label>
                <h3 class="xml-name">Creative Agency #3</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo6" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div> 
            
            <div class="xml">
                <input type="radio" id="demo_seven" name="ut_demo_file" value="demo_seven" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_seven">
                    
                    <span class="ut-new-badge">7</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo7.jpg" />                    
                    
                </label>
                <h3 class="xml-name">Creative Portfolio / Blog</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo7" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_two_b" name="ut_demo_file" value="demo_two_b" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_two_b">
                    
                    <span class="ut-new-badge">8</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo8.jpg" />
                    
                </label>
                <h3 class="xml-name">Creative Agenc #4</h3>
               	<div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/extended/?skin=light" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_nine" name="ut_demo_file" value="demo_nine" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_nine">
                    
                    <span class="ut-new-badge">9</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo9.jpg" />                    
                    
                </label>
                <h3 class="xml-name"> Creative Business</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo9" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
                        
            <div class="xml">
                <input type="radio" id="demo_ten" name="ut_demo_file" value="demo_ten" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_ten">
                    
                    <span class="ut-new-badge">10</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo10.jpg" />
                    
                </label>
                <h3 class="xml-name">Creative Agency #5</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo10" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div> 
            
            <div class="xml">
                <input type="radio" id="demo_eleven" name="ut_demo_file" value="demo_eleven" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_eleven">
                    
                    <span class="ut-new-badge">11</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo11.jpg" />
                    
                </label>
                <h3 class="xml-name">Business #3</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo11" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_twelve" name="ut_demo_file" value="demo_twelve" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_twelve">
                    
                    <span class="ut-new-badge">12</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo12.jpg" />
                    
                </label>
                <h3 class="xml-name">Gaming #1</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo12" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
                        
            <div class="xml">
                <input type="radio" id="demo_thirteen" name="ut_demo_file" value="demo_thirteen" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_thirteen">
                    
                    <span class="ut-new-badge">13</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo13.jpg" />                    
                    
                </label>
                <h3 class="xml-name">Creative Agency #6</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo13" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_fourteen" name="ut_demo_file" value="demo_fourteen" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_fourteen">
                    
                    <span class="ut-new-badge">14</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo14.jpg" />
                    
                </label>
                <h3 class="xml-name">Portfolio</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo14" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_fifteen" name="ut_demo_file" value="demo_fifteen" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_fifteen">
                    
                    <span class="ut-new-badge">15</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo15.jpg" />
                    
                </label>
                <h3 class="xml-name">Restaurant #1</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo15" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_sixteen" name="ut_demo_file" value="demo_sixteen" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_sixteen">
                    
                    <span class="ut-new-badge">16</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo16.jpg" />
                    
                </label>
                <h3 class="xml-name">Wedding Agency</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo16" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_seventeen" name="ut_demo_file" value="demo_seventeen" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_seventeen">
                    
                    <span class="ut-new-badge">17</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo17.jpg" />
                    
                </label>
                <h3 class="xml-name"> Barber Shop</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo17" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_eighteen" name="ut_demo_file" value="demo_eighteen" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_eighteen">
                    
                    <span class="ut-new-badge">18</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo18.jpg" />
                    
                </label>
                <h3 class="xml-name">Dentist & Dental Care</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo18" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_nineteen" name="ut_demo_file" value="demo_nineteen" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_nineteen">
                    
                    <span class="ut-new-badge">19</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo19.jpg" />
                    
                </label>
                <h3 class="xml-name">We are dedicating this page to our friend...</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo19" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_twenty" name="ut_demo_file" value="demo_twenty" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_twenty">
                    
                    <span class="ut-new-badge">20</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo20.jpg" />
                    
                </label>
                <h3 class="xml-name"> Construction</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo20" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>
            
            <div class="xml">
                <input type="radio" id="demo_twentyone" name="ut_demo_file" value="demo_twentyone" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_twentyone">
                    
                    <span class="ut-new-badge">21</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/demo21.jpg" />
                    
                </label>
                <h3 class="xml-name">Demo 21</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/demo21" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
            </div>            
            
            
            
            <div class="xml">
                <input type="radio" id="demo_eight" name="ut_demo_file" value="demo_eight" class="ut-choose-demo-radio">
                <label class="ut-choose-demo-img" for="demo_eight">
                    
                    <span class="ut-new-badge">0</span>
                    <div class="ut-selected-overlay"></div>
                    <img src="<?php echo THEME_WEB_ROOT; ?>/admin/assets/images/importer/extra_demo.jpg" />                    
                </label>
                
                <h3 class="xml-name">Landing Page</h3>
                <div class="xml-actions">
                	<a target="_blank" href="http://themeforest.unitedthemes.com/wpversions/brooklyn/landing" class="button button-primary"><?php _e('Preview' , 'unitedthemes'); ?></a>
                </div>
                
            </div>
                                    
            <div class="clear"></div>
            
            <div class="ut-import-options">
            
            <table class="form-table">
            	<tbody>
                    
                    <tr valign="top">
                    	
                        <th scope="row">
							<?php _e( 'Import Revolution Sliders?' , 'unitedthemes' ); ?>
                        </th>
                      	
                        <td>
                            <input type="checkbox" value="yes" id="ut-import-revslider" name="ut-import-revslider">
                        </td>                       
                    
                    </tr> 
                    
                    <tr valign="top">
                    	
                        <th scope="row">
							<?php _e( 'Import Theme Options?' , 'unitedthemes' ); ?>
                        </th>
                      	
                        <td>
                            <input type="checkbox" value="yes" id="ut-import-options" name="ut-import-options">
                        </td>                       
                    
                    </tr> 
                    
                    <tr valign="top">
                    	
                        <th scope="row">
							<?php _e('Important Notes:' , 'unitedthemes'); ?>
                        </th>
                      	
                        <td>
                            <ol>
                                <li><?php _e('We recommend to run this importer on a clean WordPress installation.' , 'unitedthemes'); ?></li>
                                <li><?php _e('To reset your installation we can recommend this plugin here:' , 'unitedthemes'); ?> <a href="http://wordpress.org/plugins/wordpress-database-reset/">Wordpress Database Reset</a></li>
                                <li><?php _e('The Demo Importer will not import the images we have used in our live demos, due to copyright / license reasons' , 'unitedthemes'); ?></li>
                                <li><?php _e('Do not run the importer multiple times one after another, it will result in double content.' , 'unitedthemes'); ?></li>
                            </ol>
                        </td>                       
                    
                    </tr>  
                                        
            	</tbody>
            </table>
            
            </div>
            
            <div class="clear"></div>
            
            <div class="ut-import-bar">
                
                <input type="hidden" name="ut_import_demo_content" value="true" />
                <input type="submit" value="<?php _e( 'Import' , 'unitedthemes' ); ?>" class="button button-primary" id="submit" name="submit">
                
            </div>
            
            </form>
		
		</div>
		
	<?php }
	
}

/*
|--------------------------------------------------------------------------
| Demo Importer
|--------------------------------------------------------------------------
*/
add_action( 'admin_init', 'ut_demo_importer' );

if ( !function_exists( 'ut_demo_importer' ) ) {

	function ut_demo_importer() {
		
		global $wpdb;
		
		/* add option flag to wordpress */
		add_option('ut_import_loaded');
		
		/* security array for valid filenames */
		$ut_recognized_file_names = apply_filters( 'ut_recognized_file_names', array( 
		  'demo_one', 'demo_two' , 'demo_two_b' , 'demo_three', 'demo_four', 'demo_five', 'demo_six' , 'demo_seven' , 'demo_eight' , 'demo_eight_b' , 'demo_nine', 'demo_ten', 'demo_eleven' , 'demo_twelve' , 'demo_thirteen' , 'demo_fourteen', 'demo_fifteen', 'demo_sixteen', 'demo_seventeen', 'demo_eighteen', 'demo_nineteen', 
          'demo_twenty' , 'demo_twentyone'
		));
        	
		if ( current_user_can( 'manage_options' ) && isset( $_POST['ut_import_demo_content'] ) && !empty( $_POST['ut_demo_file'] ) ) {

			if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
			
			if ( ! class_exists( 'WP_Importer' ) ) {
				$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				if ( file_exists( $class_wp_importer ) ) {
					include $class_wp_importer;
				}
			}

			if ( ! class_exists('UT_WP_Import') ) { 
				$class_wp_import = THEME_DOCUMENT_ROOT . '/admin/includes/plugins/importer/wordpress-importer.php';
				if ( file_exists( $class_wp_import ) ) {
					include $class_wp_import;
				}
			}	
			
			if ( class_exists( 'WP_Importer' ) && class_exists( 'UT_WP_Import' ) ) {
				
				/*
				|--------------------------------------------------------------------------
				| Import choosen XML
				|--------------------------------------------------------------------------
				*/
				
				$importer = new UT_WP_Import();
				
				$demo_file = sanitize_file_name($_POST['ut_demo_file']);
				$theme_xml = THEME_DOCUMENT_ROOT . '/admin/assets/xml/' . $demo_file . '.xml.gz';
								
				if ( file_exists( $class_wp_importer ) && in_array( $demo_file , $ut_recognized_file_names) ) {
										
					$importer->fetch_attachments = true;
					ob_start();
					$importer->import($theme_xml);
					ob_end_clean();					
					
				} else {
					
					wp_redirect( admin_url( 'admin.php??page=ut_view_updater&utimport=failed' ) );
					
				}
				
                
				/*
				|--------------------------------------------------------------------------
				| Set Primary Navigation
				|--------------------------------------------------------------------------
				*/
												
				$locations = get_theme_mod( 'nav_menu_locations' ); 
				$menus = wp_get_nav_menus(); 
				
				if( is_array( $menus ) ) {
					foreach( $menus as $menu ) { // assign menus to theme locations
						
                        $main = ( $demo_file == 'demo_eight' || $demo_file == 'demo_eight_b' ) ? 'Menu 1' : 'Main';
                                                
                        if( $menu->name == $main ) {
							$locations['primary'] = $menu->term_id;
						}
                        
					}
				}
				
				set_theme_mod( 'nav_menu_locations', $locations );
				
				/*
				|--------------------------------------------------------------------------
				| Set Reading Options
				|--------------------------------------------------------------------------
				*/
				
				$homepage 	= get_page_by_title( 'Front Page' );
				$posts_page = get_page_by_title( 'Blog' );
				
                if( $demo_file == 'demo_eight' || $demo_file == 'demo_eight_b' ) {
                    $homepage 	= get_page_by_title( 'Frontpage' );
                }
                
				if( isset( $homepage->ID ) && isset( $posts_page->ID ) ) {
					update_option('show_on_front', 'page');
					update_option('page_on_front',  $homepage->ID); // Front Page
					update_option('page_for_posts', $posts_page->ID); // Blog Page
				}
				
				/*
				|--------------------------------------------------------------------------
				| Update Theme Options
				|--------------------------------------------------------------------------
				*/
                
				if( isset( $_POST['ut-import-options'] ) && $_POST['ut-import-options'] == 'yes' ) :
					
					/* run layout loader */
					ut_load_layout_into_ot( $demo_file . '.txt' );
					
				endif;
				
				/*
				|--------------------------------------------------------------------------
				| Revolution Slider Import
				|--------------------------------------------------------------------------
				*/
				if( isset( $_POST['ut-import-revslider'] ) && $_POST['ut-import-revslider'] == 'yes' ) :
				    
					if( class_exists('RevSlider') ) { 
					    
                        class UT_RevSlider_Import extends RevSlider {
                            
                            public function importSliderFromPost($updateAnim = true, $updateStatic = true, $exactfilepath = false, $is_template = false, $single_slide = false, $updateNavigation = true){
                                
                                try{
                                    
                                    $sliderID = RevSliderFunctions::getPostVariable("sliderid");
                                    $sliderExists = !empty($sliderID);
                                    
                                    if($sliderExists)
                                        $this->initByID($sliderID);
                                    
                                    if($exactfilepath !== false){
                                        $filepath = $exactfilepath;
                                    }else{
                                        switch ($_FILES['import_file']['error']) {
                                            case UPLOAD_ERR_OK:
                                                break;
                                            case UPLOAD_ERR_NO_FILE:
                                                RevSliderFunctions::throwError(__('No file sent.', 'revslider'));
                                            case UPLOAD_ERR_INI_SIZE:
                                            case UPLOAD_ERR_FORM_SIZE:
                                                RevSliderFunctions::throwError(__('Exceeded filesize limit.', 'revslider'));
                                            default:
                                            break;
                                        }
                                        $filepath = $_FILES["import_file"]["tmp_name"];
                                    }
                                    
                                    if(file_exists($filepath) == false)
                                        RevSliderFunctions::throwError(__('Import file not found!!!', 'revslider'));
                                    
                                    $importZip = false;
                                    
                                    WP_Filesystem();
                                    
                                    global $wp_filesystem;
                                    
                                    $upload_dir = wp_upload_dir();
                                    $d_path = $upload_dir['basedir'].'/rstemp/';
                                    $unzipfile = unzip_file( $filepath, $d_path);
                                    
                                    if( is_wp_error($unzipfile) ){
                                        define('FS_METHOD', 'direct'); //lets try direct. 
                                        
                                        WP_Filesystem();  //WP_Filesystem() needs to be called again since now we use direct !
                                        
                                        //@chmod($filepath, 0775);
                                        
                                        $unzipfile = unzip_file( $filepath, $d_path);
                                        if( is_wp_error($unzipfile) ){
                                            $d_path = RS_PLUGIN_PATH.'rstemp/';
                                            $unzipfile = unzip_file( $filepath, $d_path);
                                            
                                            if( is_wp_error($unzipfile) ){
                                                $f = basename($filepath);
                                                $d_path = str_replace($f, '', $filepath);
                                                
                                                $unzipfile = unzip_file( $filepath, $d_path);
                                            }
                                        }
                                    }
                                    
                                    if( !is_wp_error($unzipfile) ){
                                        $importZip = true; //raus damit..
                                        
                                        //read all files needed
                                        $content = ( $wp_filesystem->exists( $d_path.'slider_export.txt' ) ) ? $wp_filesystem->get_contents( $d_path.'slider_export.txt' ) : '';
                                        if($content == ''){
                                            RevSliderFunctions::throwError(__('slider_export.txt does not exist!', 'revslider'));
                                        }
                                        $animations = ( $wp_filesystem->exists( $d_path.'custom_animations.txt' ) ) ? $wp_filesystem->get_contents( $d_path.'custom_animations.txt' ) : '';
                                        $dynamic = ( $wp_filesystem->exists( $d_path.'dynamic-captions.css' ) ) ? $wp_filesystem->get_contents( $d_path.'dynamic-captions.css' ) : '';
                                        $static = ( $wp_filesystem->exists( $d_path.'static-captions.css' ) ) ? $wp_filesystem->get_contents( $d_path.'static-captions.css' ) : '';
                                        $navigations = ( $wp_filesystem->exists( $d_path.'navigation.txt' ) ) ? $wp_filesystem->get_contents( $d_path.'navigation.txt' ) : '';
                                        
                                        $uid_check = ( $wp_filesystem->exists( $d_path.'info.cfg' ) ) ? $wp_filesystem->get_contents( $d_path.'info.cfg' ) : '';
                                        $version_check = ( $wp_filesystem->exists( $d_path.'version.cfg' ) ) ? $wp_filesystem->get_contents( $d_path.'version.cfg' ) : '';
                                        
                                        if($is_template !== false){
                                            if($uid_check != $is_template){
                                                return(array("success"=>false,"error"=>__('Please select the correct zip file, checksum failed!', 'revslider')));
                                            }
                                        }else{ //someone imported a template base Slider, check if it is existing in Base Sliders, if yes, check if it was imported
                                            if($uid_check !== ''){
                                                $tmpl = new RevSliderTemplate();
                                                $tmpl_slider = $tmpl->getThemePunchTemplateSliders();
                                                
                                                foreach($tmpl_slider as $tp_slider){
                                                    if(!isset($tp_slider['installed'])) continue;
                                                    
                                                    if($tp_slider['uid'] == $uid_check){
                                                        $is_template = $uid_check;
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                        
                                        $db = new RevSliderDB();
                                        
                                        //update/insert custom animations
                                        $animations = @unserialize($animations);
                                        if(!empty($animations)){
                                            foreach($animations as $key => $animation){ //$animation['id'], $animation['handle'], $animation['params']
                                                $exist = $db->fetch(RevSliderGlobals::$table_layer_anims, $db->prepare("handle = %s", array($animation['handle'])));
                                                if(!empty($exist)){ //update the animation, get the ID
                                                    if($updateAnim == "true"){ //overwrite animation if exists
                                                        $arrUpdate = array();
                                                        $arrUpdate['params'] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));
                                                        $db->update(RevSliderGlobals::$table_layer_anims, $arrUpdate, array('handle' => $animation['handle']));
                                                        
                                                        $anim_id = $exist['0']['id'];
                                                    }else{ //insert with new handle
                                                        $arrInsert = array();
                                                        $arrInsert["handle"] = 'copy_'.$animation['handle'];
                                                        $arrInsert["params"] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));
                                                        
                                                        $anim_id = $db->insert(RevSliderGlobals::$table_layer_anims, $arrInsert);
                                                    }
                                                }else{ //insert the animation, get the ID
                                                    $arrInsert = array();
                                                    $arrInsert["handle"] = $animation['handle'];
                                                    $arrInsert["params"] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));
                                                    
                                                    $anim_id = $db->insert(RevSliderGlobals::$table_layer_anims, $arrInsert);
                                                }
                                                
                                                //and set the current customin-oldID and customout-oldID in slider params to new ID from $id
                                                $content = str_replace(array('customin-'.$animation['id'].'"', 'customout-'.$animation['id'].'"'), array('customin-'.$anim_id.'"', 'customout-'.$anim_id.'"'), $content);	
                                            }
                                            
                                        }
                                        
                                        //overwrite/append static-captions.css
                                        if(!empty($static)){
                                            if($updateStatic == "true"){ //overwrite file
                                                RevSliderOperations::updateStaticCss($static);
                                            }elseif($updateStatic == 'none'){
                                                //do nothing
                                            }else{//append
                                                $static_cur = RevSliderOperations::getStaticCss();
                                                $static = $static_cur."\n".$static;
                                                RevSliderOperations::updateStaticCss($static);
                                            }
                                        }
                                        
                                        //overwrite/create dynamic-captions.css
                                        //parse css to classes
                                        $dynamicCss = RevSliderCssParser::parseCssToArray($dynamic);
                                        if(is_array($dynamicCss) && $dynamicCss !== false && count($dynamicCss) > 0){
                                            foreach($dynamicCss as $class => $styles){
                                                //check if static style or dynamic style
                                                $class = trim($class);
                                                
                                                if(strpos($class, ',') !== false && strpos($class, '.tp-caption') !== false){ //we have something like .tp-caption.redclass, .redclass
                                                    $class_t = explode(',', $class);
                                                    foreach($class_t as $k => $cl){
                                                        if(strpos($cl, '.tp-caption') !== false) $class = $cl;
                                                    }
                                                }
                                                
                                                if((strpos($class, ':hover') === false && strpos($class, ':') !== false) || //before, after
                                                    strpos($class," ") !== false || // .tp-caption.imageclass img or .tp-caption .imageclass or .tp-caption.imageclass .img
                                                    strpos($class,".tp-caption") === false || // everything that is not tp-caption
                                                    (strpos($class,".") === false || strpos($class,"#") !== false) || // no class -> #ID or img
                                                    strpos($class,">") !== false){ //.tp-caption>.imageclass or .tp-caption.imageclass>img or .tp-caption.imageclass .img
                                                    continue;
                                                }
                                                
                                                //is a dynamic style
                                                if(strpos($class, ':hover') !== false){
                                                    $class = trim(str_replace(':hover', '', $class));
                                                    $arrInsert = array();
                                                    $arrInsert["hover"] = json_encode($styles);
                                                    $arrInsert["settings"] = json_encode(array('hover' => 'true'));
                                                }else{
                                                    $arrInsert = array();
                                                    $arrInsert["params"] = json_encode($styles);
                                                    $arrInsert["settings"] = '';
                                                }
                                                //check if class exists
                                                $result = $db->fetch(RevSliderGlobals::$table_css, $db->prepare("handle = %s", array($class)));
                                                
                                                if(!empty($result)){ //update
                                                    $db->update(RevSliderGlobals::$table_css, $arrInsert, array('handle' => $class));
                                                }else{ //insert
                                                    $arrInsert["handle"] = $class;
                                                    $db->insert(RevSliderGlobals::$table_css, $arrInsert);
                                                }
                                            }
    
                                        }
                                        
                                        //update/insert custom animations
                                        $navigations = @unserialize($navigations);
                                        if(!empty($navigations)){
                                            
                                            foreach($navigations as $key => $navigation){
                                                $exist = $db->fetch(RevSliderGlobals::$table_navigation, $db->prepare("handle = %s", array($navigation['handle'])));
                                                unset($navigation['id']);
                                                
                                                $rh = $navigation["handle"];
                                                if(!empty($exist)){ //create new navigation, get the ID
                                                    if($updateNavigation == "true"){ //overwrite navigation if exists
                                                        unset($navigation['handle']);
                                                        $db->update(RevSliderGlobals::$table_navigation, $navigation, array('handle' => $rh));
                                                        
                                                    }else{
                                                        //insert with new handle
                                                        $navigation["handle"] = $navigation['handle'].'-'.date('is');
                                                        $navigation["name"] = $navigation['name'].'-'.date('is');
                                                        $content = str_replace($rh.'"', $navigation["handle"].'"', $content);
                                                        $navigation["css"] = str_replace('.'.$rh, '.'.$navigation["handle"], $navigation["css"]); //change css class to the correct new class
                                                        $navi_id = $db->insert(RevSliderGlobals::$table_navigation, $navigation);
                                                        
                                                    }
                                                }else{
                                                    $navi_id = $db->insert(RevSliderGlobals::$table_navigation, $navigation);
                                                }
                                            }
    
                                        }
                                    }else{
                                        $message = $unzipfile->get_error_message();
                                        
                                        $wp_filesystem->delete($d_path, true);
                                        
                                        return(array("success"=>false,"error"=>$message));
                                    }
                                    
                                    //$content = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $content); //clear errors in string //deprecated in newest php version
                                    $content = preg_replace_callback('!s:(\d+):"(.*?)";!', array('RevSliderSlider', 'clear_error_in_string') , $content); //clear errors in string
                                    
                                    $arrSlider = @unserialize($content);
                                    if(empty($arrSlider)){
                                        $wp_filesystem->delete($d_path, true);
                                        RevSliderFunctions::throwError(__('Wrong export slider file format! Please make sure that the uploaded file is either a zip file with a correct slider_export.txt in the root of it or an valid slider_export.txt file.', 'revslider'));
                                    }
                                    
                                    //update slider params
                                    $sliderParams = $arrSlider["params"];
                                    
                                    if($sliderExists){
                                        $sliderParams["title"] = $this->arrParams["title"];
                                        $sliderParams["alias"] = $this->arrParams["alias"];
                                        $sliderParams["shortcode"] = $this->arrParams["shortcode"];
                                    }
                                    
                                    if(isset($sliderParams["background_image"]))
                                        $sliderParams["background_image"] = RevSliderFunctionsWP::getImageUrlFromPath($sliderParams["background_image"]);
                                    
                                    
                                    $import_statics = true;
                                    if(isset($sliderParams['enable_static_layers'])){
                                        if($sliderParams['enable_static_layers'] == 'off') $import_statics = false;
                                        unset($sliderParams['enable_static_layers']);
                                    }
                                    
                                    $sliderParams['version'] = $version_check;
                                    
                                    $json_params = json_encode($sliderParams);
                                    
                                    //update slider or create new
                                    if($sliderExists){
                                        $arrUpdate = array("params"=>$json_params);	
                                        $this->db->update(RevSliderGlobals::$table_sliders,$arrUpdate,array("id"=>$sliderID));
                                    }else{	//new slider
                                        $arrInsert = array();
                                        $arrInsert['params'] = $json_params;
                                        //check if Slider with title and/or alias exists, if yes change both to stay unique
                                        
                                        
                                        $arrInsert['title'] = RevSliderFunctions::getVal($sliderParams, 'title', 'Slider1');
                                        $arrInsert['alias'] = RevSliderFunctions::getVal($sliderParams, 'alias', 'slider1');	
                                        if($is_template === false){ //we want to stay at the given alias if we are a template
                                            $talias = $arrInsert['alias'];
                                            $ti = 1;
                                            while($this->isAliasExistsInDB($talias)){ //set a new alias and title if its existing in database
                                                $talias = $arrInsert['alias'] . $ti;
                                                $ti++;
                                            }
                                            
                                            if($talias !== $arrInsert['alias']){
                                                $sliderParams['title'] = $talias;
                                                $sliderParams['alias'] = $talias;
                                                $arrInsert['title'] = $talias;
                        
                                                $arrInsert['alias'] = $talias;
                                                $json_params = json_encode($sliderParams);
                                                $arrInsert['params'] = $json_params;
                                            }
                                        }
                                        
                                        if($is_template !== false){ //add that we are an template
                                            $arrInsert['type'] = 'template';
                                            $sliderParams['uid'] = $is_template;
                                            $json_params = json_encode($sliderParams);
                                            $arrInsert['params'] = $json_params;
                                        }
                                        
                                        
                                        
                                        $sliderID = $this->db->insert(RevSliderGlobals::$table_sliders,$arrInsert);
                                    }
                                    
                                    //-------- Slides Handle -----------
                                    
                                    //delete current slides
                                    if($sliderExists)
                                        $this->deleteAllSlides();
                                    
                                    //create all slides
                                    $arrSlides = $arrSlider["slides"];
                                    
                                    $alreadyImported = array();
                                    
                                    //$content_url = content_url();
                                    $upload_dir = wp_upload_dir();
                                    $content_url = $upload_dir['baseurl'].'/revslider/assets/svg/';
                                    
                                    //wpml compatibility
                                    $slider_map = array();
                                    foreach($arrSlides as $sl_key => $slide){
                                        $params = $slide["params"];
                                        $layers = $slide["layers"];
                                        $settings = (isset($slide["settings"])) ? $slide["settings"] : '';
                                        
                                        //convert params images:
                                        if($importZip === true){ //we have a zip, check if exists
                                            //remove image_id as it is not needed in import
                                            if(isset($params['image_id'])) unset($params['image_id']);
                                            
                                            if(isset($params["image"])){
                                                $params["image"] = RevSliderBase::check_file_in_zip($d_path, $params["image"], $sliderParams["alias"], $alreadyImported);
                                                $params["image"] = RevSliderFunctionsWP::getImageUrlFromPath($params["image"]);
                                            }
                                            
                                            if(isset($params["background_image"])){
                                                $params["background_image"] = RevSliderBase::check_file_in_zip($d_path, $params["background_image"], $sliderParams["alias"], $alreadyImported);
                                                $params["background_image"] = RevSliderFunctionsWP::getImageUrlFromPath($params["background_image"]);
                                            }
                                            
                                            if(isset($params["slide_thumb"])){
                                                $params["slide_thumb"] = RevSliderBase::check_file_in_zip($d_path, $params["slide_thumb"], $sliderParams["alias"], $alreadyImported);
                                                $params["slide_thumb"] = RevSliderFunctionsWP::getImageUrlFromPath($params["slide_thumb"]);
                                            }
                                            
                                            if(isset($params["show_alternate_image"])){
                                                $params["show_alternate_image"] = RevSliderBase::check_file_in_zip($d_path, $params["show_alternate_image"], $sliderParams["alias"], $alreadyImported);
                                                $params["show_alternate_image"] = RevSliderFunctionsWP::getImageUrlFromPath($params["show_alternate_image"]);
                                            }
                                            if(isset($params['background_type']) && $params['background_type'] == 'html5'){
                                                if(isset($params['slide_bg_html_mpeg']) && $params['slide_bg_html_mpeg'] != ''){
                                                    $params['slide_bg_html_mpeg'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $params["slide_bg_html_mpeg"], $sliderParams["alias"], $alreadyImported, true));
                                                }
                                                if(isset($params['slide_bg_html_webm']) && $params['slide_bg_html_webm'] != ''){
                                                    $params['slide_bg_html_webm'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $params["slide_bg_html_webm"], $sliderParams["alias"], $alreadyImported, true));
                                                }
                                                if(isset($params['slide_bg_html_ogv'])  && $params['slide_bg_html_ogv'] != ''){
                                                    $params['slide_bg_html_ogv'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $params["slide_bg_html_ogv"], $sliderParams["alias"], $alreadyImported, true));
                                                }
                                            }
                                        }
                                        
                                        
                                        //convert layers images:
                                        foreach($layers as $key=>$layer){					
                                            //import if exists in zip folder
                                            if($importZip === true){ //we have a zip, check if exists
                                                if(isset($layer["image_url"])){
                                                    $layer["image_url"] = RevSliderBase::check_file_in_zip($d_path, $layer["image_url"], $sliderParams["alias"], $alreadyImported);
                                                    $layer["image_url"] = RevSliderFunctionsWP::getImageUrlFromPath($layer["image_url"]);
                                                }
                                                if(isset($layer['type']) && ($layer['type'] == 'video' || $layer['type'] == 'audio')){
                                                    
                                                    $video_data = (isset($layer['video_data'])) ? (array) $layer['video_data'] : array();
                                                    
                                                    if(!empty($video_data) && isset($video_data['video_type']) && $video_data['video_type'] == 'html5'){
                        
                                                        if(isset($video_data['urlPoster']) && $video_data['urlPoster'] != ''){
                                                            $video_data['urlPoster'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $video_data["urlPoster"], $sliderParams["alias"], $alreadyImported));
                                                        }
                                                        
                                                        if(isset($video_data['urlMp4']) && $video_data['urlMp4'] != ''){
                                                            $video_data['urlMp4'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $video_data["urlMp4"], $sliderParams["alias"], $alreadyImported, true));
                                                        }
                                                        if(isset($video_data['urlWebm']) && $video_data['urlWebm'] != ''){
                                                            $video_data['urlWebm'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $video_data["urlWebm"], $sliderParams["alias"], $alreadyImported, true));
                                                        }
                                                        if(isset($video_data['urlOgv']) && $video_data['urlOgv'] != ''){
                                                            $video_data['urlOgv'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $video_data["urlOgv"], $sliderParams["alias"], $alreadyImported, true));
                                                        }
                                                        
                                                    }elseif(!empty($video_data) && isset($video_data['video_type']) && $video_data['video_type'] != 'html5'){ //video cover image
                                                        if($video_data['video_type'] == 'audio'){
                                                            if(isset($video_data['urlAudio']) && $video_data['urlAudio'] != ''){
                                                                $video_data['urlAudio'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $video_data["urlAudio"], $sliderParams["alias"], $alreadyImported, true));
                                                            }
                                                        }else{
                                                            if(isset($video_data['previewimage']) && $video_data['previewimage'] != ''){
                                                                $video_data['previewimage'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $video_data["previewimage"], $sliderParams["alias"], $alreadyImported));
                                                            }
                                                        }
                                                    }
                                                    
                                                    $layer['video_data'] = $video_data;
                                                    
                                                }
                                                
                                                if(isset($layer['type']) && $layer['type'] == 'svg'){
                                                    if(isset($layer['svg']) && isset($layer['svg']->src)){
                                                        if(strpos($layer['svg']->src, 'revslider-whiteboard-addon') !== false){
                                                            $layer['svg']->src = content_url().$layer['svg']->src;
                                                        }else{
                                                            $layer['svg']->src = str_replace('/plugins/revslider/public/assets/assets/svg/', '', $content_url.$layer['svg']->src);
                                                        }
                                                    }
                                                }
                                                
                                            }
                                            
                                            $layer['text'] = stripslashes($layer['text']);
                                            $layers[$key] = $layer;
                                        }
                                        
                                        $arrSlides[$sl_key]['layers'] = $layers;
                                        
                                        //create new slide
                                        $arrCreate = array();
                                        $arrCreate["slider_id"] = $sliderID;
                                        $arrCreate["slide_order"] = $slide["slide_order"];
                                        
                                        $my_layers = json_encode($layers);
                                        if(empty($my_layers))
                                            $my_layers = stripslashes(json_encode($layers));
                                        $my_params = json_encode($params);
                                        if(empty($my_params))
                                            $my_params = stripslashes(json_encode($params));
                                        $my_settings = json_encode($settings);
                                        if(empty($my_settings))
                                            $my_settings = stripslashes(json_encode($settings));
                                        
                                        
                                            
                                        $arrCreate["layers"] = $my_layers;
                                        $arrCreate["params"] = $my_params;
                                        $arrCreate["settings"] = $my_settings;
                                        
                                        $last_id = $this->db->insert(RevSliderGlobals::$table_slides,$arrCreate);
                                        
                                        if(isset($slide['id'])){
                                            $slider_map[$slide['id']] = $last_id;
                                        }
                                    }
                                    
                                    //change for WPML the parent IDs if necessary
                                    if(!empty($slider_map)){
                                        foreach($arrSlides as $sl_key => $slide){
                                            if(isset($slide['params']['parentid']) && isset($slider_map[$slide['params']['parentid']])){
                                                $update_id = $slider_map[$slide['id']];
                                                $parent_id = $slider_map[$slide['params']['parentid']];
                                                
                                                $arrCreate = array();
                                                
                                                $arrCreate["params"] = $slide['params'];
                                                $arrCreate["params"]['parentid'] = $parent_id;
                                                $my_params = json_encode($arrCreate["params"]);
                                                if(empty($my_params))
                                                    $my_params = stripslashes(json_encode($arrCreate["params"]));
                                                
                                                $arrCreate["params"] = $my_params;
                                                
                                                $this->db->update(RevSliderGlobals::$table_slides,$arrCreate,array("id"=>$update_id));
                                            }
                                            
                                            $did_change = false;
                                            foreach($slide['layers'] as $key => $value){
                                                if(isset($value['layer_action'])){
                                                    if(isset($value['layer_action']->jump_to_slide) && !empty($value['layer_action']->jump_to_slide)){
                                                        $value['layer_action']->jump_to_slide = (array)$value['layer_action']->jump_to_slide;
                                                        foreach($value['layer_action']->jump_to_slide as $jtsk => $jtsval){
                                                            if(isset($slider_map[$jtsval])){
                                                                $slide['layers'][$key]['layer_action']->jump_to_slide[$jtsk] = $slider_map[$jtsval];
                                                                $did_change = true;
                                                            }
                                                        }
                                                    }
                                                }
                                                
                                                $link_slide = RevSliderFunctions::getVal($value, 'link_slide', false);
                                                if($link_slide != false && $link_slide !== 'nothing'){ //link to slide/scrollunder is set, move it to actions
                                                    if(!isset($slide['layers'][$key]['layer_action'])) $slide['layers'][$key]['layer_action'] = new stdClass();
                                                    switch($link_slide){
                                                        case 'link':
                                                            $link = RevSliderFunctions::getVal($value, 'link');
                                                            $link_open_in = RevSliderFunctions::getVal($value, 'link_open_in');
                                                            $slide['layers'][$key]['layer_action']->action = array('a' => 'link');
                                                            $slide['layers'][$key]['layer_action']->link_type = array('a' => 'a');
                                                            $slide['layers'][$key]['layer_action']->image_link = array('a' => $link);
                                                            $slide['layers'][$key]['layer_action']->link_open_in = array('a' => $link_open_in);
                                                            
                                                            unset($slide['layers'][$key]['link']);
                                                            unset($slide['layers'][$key]['link_open_in']);
                                                        case 'next':
                                                            $slide['layers'][$key]['layer_action']->action = array('a' => 'next');
                                                        break;
                                                        case 'prev':
                                                            $slide['layers'][$key]['layer_action']->action = array('a' => 'prev');
                                                        break;
                                                        case 'scroll_under':
                                                            $scrollunder_offset = RevSliderFunctions::getVal($value, 'scrollunder_offset');
                                                            $slide['layers'][$key]['layer_action']->action = array('a' => 'scroll_under');
                                                            $slide['layers'][$key]['layer_action']->scrollunder_offset = array('a' => $scrollunder_offset);
                                                            
                                                            unset($slide['layers'][$key]['scrollunder_offset']);
                                                        break;
                                                        default: //its an ID, so its a slide ID
                                                            $slide['layers'][$key]['layer_action']->action = array('a' => 'jumpto');
                                                            $slide['layers'][$key]['layer_action']->jump_to_slide = array('a' => $slider_map[$link_slide]);
                                                        break;
                                                        
                                                    }
                                                    $slide['layers'][$key]['layer_action']->tooltip_event = array('a' => 'click');
                                                    
                                                    unset($slide['layers'][$key]['link_slide']);
                                                    
                                                    $did_change = true;
                                                }
                                                
                                                
                                                if($did_change === true){
                                                    
                                                    $arrCreate = array();
                                                    $my_layers = json_encode($slide['layers']);
                                                    if(empty($my_layers))
                                                        $my_layers = stripslashes(json_encode($layers));
                                                    
                                                    $arrCreate['layers'] = $my_layers;
                                                    
                                                    $this->db->update(RevSliderGlobals::$table_slides,$arrCreate,array("id"=>$slider_map[$slide['id']]));
                                                }
                                            }
                                        }
                                    }
                                    
                                    //check if static slide exists and import
                                    if(isset($arrSlider['static_slides']) && !empty($arrSlider['static_slides']) && $import_statics){
                                        $static_slide = $arrSlider['static_slides'];
                                        foreach($static_slide as $slide){
                                            
                                            $params = $slide["params"];
                                            $layers = $slide["layers"];
                                            $settings = (isset($slide["settings"])) ? $slide["settings"] : '';
                                            
                                            //remove image_id as it is not needed in import
                                            if(isset($params['image_id'])) unset($params['image_id']);
                                            
                                            //convert params images:
                                            if(isset($params["image"])){
                                                //import if exists in zip folder
                                                if(strpos($params["image"], 'http') !== false){
                                                }else{
                                                    if(trim($params["image"]) !== ''){
                                                        if($importZip === true){ //we have a zip, check if exists
                                                            $image = $wp_filesystem->exists( $d_path.'images/'.$params["image"] );
                                                            if(!$image){
                                                                echo $params["image"].__(' not found!<br>', 'revslider');
                                                            }else{
                                                                if(!isset($alreadyImported['images/'.$params["image"]])){
                                                                    $importImage = RevSliderFunctionsWP::import_media($d_path.'images/'.$params["image"], $sliderParams["alias"].'/');
                        
                                                                    if($importImage !== false){
                                                                        $alreadyImported['images/'.$params["image"]] = $importImage['path'];
                                                                        
                                                                        $params["image"] = $importImage['path'];
                                                                    }
                                                                }else{
                                                                    $params["image"] = $alreadyImported['images/'.$params["image"]];
                                                                }
                        
                        
                                                            }
                                                        }
                                                    }
                                                    $params["image"] = RevSliderFunctionsWP::getImageUrlFromPath($params["image"]);
                                                }
                                            }
                                            
                                            //convert layers images:
                                            foreach($layers as $key=>$layer){
                                                if(isset($layer["image_url"])){
                                                    //import if exists in zip folder
                                                    if(trim($layer["image_url"]) !== ''){
                                                        if(strpos($layer["image_url"], 'http') !== false){
                                                        }else{
                                                            if($importZip === true){ //we have a zip, check if exists
                                                                $image_url = $wp_filesystem->exists( $d_path.'images/'.$layer["image_url"] );
                                                                if(!$image_url){
                                                                    echo $layer["image_url"].__(' not found!<br>');
                                                                }else{
                                                                    if(!isset($alreadyImported['images/'.$layer["image_url"]])){
                                                                        $importImage = RevSliderFunctionsWP::import_media($d_path.'images/'.$layer["image_url"], $sliderParams["alias"].'/');
                                                                        
                                                                        if($importImage !== false){
                                                                            $alreadyImported['images/'.$layer["image_url"]] = $importImage['path'];
                                                                            
                                                                            $layer["image_url"] = $importImage['path'];
                                                                        }
                                                                    }else{
                                                                        $layer["image_url"] = $alreadyImported['images/'.$layer["image_url"]];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    $layer["image_url"] = RevSliderFunctionsWP::getImageUrlFromPath($layer["image_url"]);
                                                }
                                                
                                                $layer['text'] = stripslashes($layer['text']);
                                                    
                                                if(isset($layer['type']) && ($layer['type'] == 'video' || $layer['type'] == 'audio')){
                                                    
                                                    $video_data = (isset($layer['video_data'])) ? (array) $layer['video_data'] : array();
                                                    
                                                    if(!empty($video_data) && isset($video_data['video_type']) && $video_data['video_type'] == 'html5'){
                        
                                                        if(isset($video_data['urlPoster']) && $video_data['urlPoster'] != ''){
                                                            $video_data['urlPoster'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $video_data["urlPoster"], $sliderParams["alias"], $alreadyImported));
                                                        }
                                                        
                                                        if(isset($video_data['urlMp4']) && $video_data['urlMp4'] != ''){
                                                            $video_data['urlMp4'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $video_data["urlMp4"], $sliderParams["alias"], $alreadyImported, true));
                                                        }
                                                        if(isset($video_data['urlWebm']) && $video_data['urlWebm'] != ''){
                                                            $video_data['urlWebm'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $video_data["urlWebm"], $sliderParams["alias"], $alreadyImported, true));
                                                        }
                                                        if(isset($video_data['urlOgv']) && $video_data['urlOgv'] != ''){
                                                            $video_data['urlOgv'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $video_data["urlOgv"], $sliderParams["alias"], $alreadyImported, true));
                                                        }
                                                        
                                                    }elseif(!empty($video_data) && isset($video_data['video_type']) && $video_data['video_type'] != 'html5'){ //video cover image
                                                        if($video_data['video_type'] == 'audio'){
                                                            if(isset($video_data['urlAudio']) && $video_data['urlAudio'] != ''){
                                                                $video_data['urlAudio'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $video_data["urlAudio"], $sliderParams["alias"], $alreadyImported, true));
                                                            }
                                                        }else{
                                                            if(isset($video_data['previewimage']) && $video_data['previewimage'] != ''){
                                                                $video_data['previewimage'] = RevSliderFunctionsWP::getImageUrlFromPath(RevSliderBase::check_file_in_zip($d_path, $video_data["previewimage"], $sliderParams["alias"], $alreadyImported));
                                                            }
                                                        }
                                                    }
                                                    
                                                    $layer['video_data'] = $video_data;
                                                }
                                                
                                                if(isset($layer['type']) && $layer['type'] == 'svg'){
                                                    if(isset($layer['svg']) && isset($layer['svg']->src)){
                                                        $layer['svg']->src = str_replace('/plugins/revslider/public/assets/assets/svg/', '', $content_url.$layer['svg']->src);
                                                    }
                                                }
                                                
                                                if(isset($layer['layer_action'])){
                                                    if(isset($layer['layer_action']->jump_to_slide) && !empty($layer['layer_action']->jump_to_slide)){
                                                        foreach($layer['layer_action']->jump_to_slide as $jtsk => $jtsval){
                                                            if(isset($slider_map[$jtsval])){
                                                                $layer['layer_action']->jump_to_slide[$jtsk] = $slider_map[$jtsval];
                                                            }
                                                        }
                                                    }
                                                }
                                                
                                                $link_slide = RevSliderFunctions::getVal($layer, 'link_slide', false);
                                                if($link_slide != false && $link_slide !== 'nothing'){ //link to slide/scrollunder is set, move it to actions
                                                    if(!isset($layer['layer_action'])) $layer['layer_action'] = new stdClass();
                                                    
                                                    switch($link_slide){
                                                        case 'link':
                                                            $link = RevSliderFunctions::getVal($layer, 'link');
                                                            $link_open_in = RevSliderFunctions::getVal($layer, 'link_open_in');
                                                            $layer['layer_action']->action = array('a' => 'link');
                                                            $layer['layer_action']->link_type = array('a' => 'a');
                                                            $layer['layer_action']->image_link = array('a' => $link);
                                                            $layer['layer_action']->link_open_in = array('a' => $link_open_in);
                                                            
                                                            unset($layer['link']);
                                                            unset($layer['link_open_in']);
                                                        case 'next':
                                                            $layer['layer_action']->action = array('a' => 'next');
                                                        break;
                                                        case 'prev':
                                                            $layer['layer_action']->action = array('a' => 'prev');
                                                        break;
                                                        case 'scroll_under':
                                                            $scrollunder_offset = RevSliderFunctions::getVal($value, 'scrollunder_offset');
                                                            $layer['layer_action']->action = array('a' => 'scroll_under');
                                                            $layer['layer_action']->scrollunder_offset = array('a' => $scrollunder_offset);
                                                            
                                                            unset($layer['scrollunder_offset']);
                                                        break;
                                                        default: //its an ID, so its a slide ID
                                                            $layer['layer_action']->action = array('a' => 'jumpto');
                                                            $layer['layer_action']->jump_to_slide = array('a' => $slider_map[$link_slide]);
                                                        break;
                                                        
                                                    }
                                                    $layer['layer_action']->tooltip_event = array('a' => 'click');
                                                    
                                                    unset($layer['link_slide']);
                                                    
                                                    $did_change = true;
                                                }
                                                
                                                $layers[$key] = $layer;
                                            }
                                            
                                            //create new slide
                                            $arrCreate = array();
                                            $arrCreate["slider_id"] = $sliderID;
                                            
                                            $my_layers = json_encode($layers);
                                            if(empty($my_layers))
                                                $my_layers = stripslashes(json_encode($layers));
                                            $my_params = json_encode($params);
                                            if(empty($my_params))
                                                $my_params = stripslashes(json_encode($params));
                                            $my_settings = json_encode($settings);
                                            if(empty($my_settings))
                                                $my_settings = stripslashes(json_encode($settings));
                                                
                                                
                                            $arrCreate["layers"] = $my_layers;
                                            $arrCreate["params"] = $my_params;
                                            $arrCreate["settings"] = $my_settings;
                                            
                                            if($sliderExists){
                                                unset($arrCreate["slider_id"]);
                                                $this->db->update(RevSliderGlobals::$table_static_slides,$arrCreate,array("slider_id"=>$sliderID));
                                            }else{
                                                $this->db->insert(RevSliderGlobals::$table_static_slides,$arrCreate);
                                            }
                                        }
                                    }
                                    
                                    $c_slider = new RevSliderSlider();
                                    $c_slider->initByID($sliderID);
                                    
                                    //check to convert styles to latest versions
                                    RevSliderPluginUpdate::update_css_styles(); //set to version 5
                                    RevSliderPluginUpdate::add_animation_settings_to_layer($c_slider); //set to version 5
                                    RevSliderPluginUpdate::add_style_settings_to_layer($c_slider); //set to version 5
                                    RevSliderPluginUpdate::change_settings_on_layers($c_slider); //set to version 5
                                    RevSliderPluginUpdate::add_general_settings($c_slider); //set to version 5
                                    RevSliderPluginUpdate::change_general_settings_5_0_7($c_slider); //set to version 5.0.7
                                    RevSliderPluginUpdate::change_layers_svg_5_2_5_4($c_slider); //set to version 5.2.5.4
                                    
                                    $cus_js = $c_slider->getParam('custom_javascript', '');
                                    
                                    if(strpos($cus_js, 'revapi') !== false){
                                        if(preg_match_all('/revapi[0-9]*/', $cus_js, $results)){
                                            
                                            if(isset($results[0]) && !empty($results[0])){
                                                foreach($results[0] as $replace){
                                                    $cus_js = str_replace($replace, 'revapi'.$sliderID, $cus_js);
                                                }
                                            }
                                            
                                            $c_slider->updateParam(array('custom_javascript' => $cus_js));
                                            
                                        }
                                        
                                    }
                                    
                                    if($is_template !== false){ //duplicate the slider now, as we just imported the "template"
                                        if($single_slide !== false){ //add now one Slide to the current Slider
                                            $mslider = new RevSlider();
                                            
                                            //change slide_id to correct, as it currently is just a number beginning from 0 as we did not have a correct slide ID yet.
                                            $i = 0;
                                            $changed = false;
                                            foreach($slider_map as $value){
                                                if($i == $single_slide['slide_id']){
                                                    $single_slide['slide_id'] = $value;
                                                    $changed = true;
                                                    break;
                                                }
                                                $i++;
                                            }
                                            
                                            if($changed){
                                                $return = $mslider->copySlideToSlider($single_slide);
                                            }else{
                                                return(array("success"=>false,"error"=>__('could not find correct Slide to copy, please try again.', 'revslider'),"sliderID"=>$sliderID));
                                            }
                                            
                                        }else{
                                            $mslider = new RevSlider();
                                            $title = RevSliderFunctions::getVal($sliderParams, 'title', 'slider1');	
                                            $talias = $title;
                                            $ti = 1;
                                            while($this->isAliasExistsInDB($talias)){ //set a new alias and title if its existing in database
                                                $talias = $title . $ti;
                                                $ti++;
                                            }
                                            $mslider->duplicateSliderFromData(array('sliderid' => $sliderID, 'title' => $talias));
                                        }
                                    }
                                    
                                    $wp_filesystem->delete($d_path, true);
                                    
                                    
                                }catch(Exception $e){
                                    $errorMessage = $e->getMessage();
                                    
                                    if(isset($d_path)){
                                        $wp_filesystem->delete($d_path, true);
                                    }
                                    return(array("success"=>false,"error"=>$errorMessage,"sliderID"=>$sliderID));
                                }
                                
                                return(array("success"=>true,"sliderID"=>$sliderID));
                            }
                            
                            
                            
                            
                        }
                        	
						$rev_directory = THEME_DOCUMENT_ROOT . '/admin/assets/optionsdata/revslider/'; 
						
                        foreach( glob( $rev_directory . '*.zip' ) as $filename ) {
							
                            $_FILES["import_file"]["tmp_name"] = THEME_DOCUMENT_ROOT . '/admin/assets/optionsdata/revslider/' . basename( $filename );
                               
                            $slider = new UT_RevSlider_Import();
                            $slider->importSliderFromPost();
							
						}
                        
                        
                        /* old slider */                        
                        $rev_files = array();
						
						foreach( glob( $rev_directory . '*.txt' ) as $filename ) {
							$filename = basename($filename);
							$rev_files[] = THEME_WEB_ROOT . '/admin/assets/optionsdata/revslider/' . $filename ;
						}
												
						foreach( $rev_files as $rev_file ) {
							
							$get_file = wp_remote_get( $rev_file );
							$arrSlider = unserialize( $get_file['body'] );
		
							$sliderParams = $arrSlider["params"];
		
							if(isset($sliderParams["background_image"])) {
								$sliderParams["background_image"] = UniteFunctionsWPRev::getImageUrlFromPath($sliderParams["background_image"]);
							}
		
							$json_params = json_encode($sliderParams);
		
							$arrInsert = array();
							$arrInsert["params"] = $json_params;
							$arrInsert["title"] = UniteFunctionsRev::getVal($sliderParams, "title","Slider1");
							$arrInsert["alias"] = UniteFunctionsRev::getVal($sliderParams, "alias","slider1");
		
							$wpdb->insert(GlobalsRevSlider::$table_sliders, $arrInsert);
		                    $sliderID = $wpdb->insert_id;
                           
        					//create all slides
							$arrSlides = $arrSlider["slides"];
							foreach( $arrSlides as $slide ){
								
								$params = $slide["params"];
								$layers = $slide["layers"];
								
								//convert params images:
								if(isset($params["image"])) {
									$params["image"] = UniteFunctionsWPRev::getImageUrlFromPath($params["image"]);
								}
								
								//convert layers images:
								foreach($layers as $key=>$layer){					
									if(isset($layer["image_url"])){
										$layer["image_url"] = UniteFunctionsWPRev::getImageUrlFromPath($layer["image_url"]);
										$layers[$key] = $layer;
									}
								}
								
								//create new slide
								$arrCreate = array();
								$arrCreate["slider_id"] = $sliderID;
								$arrCreate["slide_order"] = $slide["slide_order"];				
								$arrCreate["layers"] = json_encode($layers);
								$arrCreate["params"] = json_encode($params);
		
								$wpdb->insert(GlobalsRevSlider::$table_slides,$arrCreate);				
							}
						}
					}
				
				endif;
				
				/*
				|--------------------------------------------------------------------------
				| Set Default Logo for Navigation
				|--------------------------------------------------------------------------
				*/
				$logo_to_demo = array(
					'demo_one'	    => 'brooklyn-logo-dark.png', 
					'demo_two'      => 'brooklyn-logo-light.png',
                    'demo_two_b'    => 'brooklyn-logo-light.png',  
					'demo_three'    => 'brooklyn-logo-dark.png', 
					'demo_four'	    => 'brooklyn-logo-light.png', 
					'demo_five'	    => 'brooklyn-logo-light.png',
					'demo_six'	    => 'brooklyn-logo-light.png',
					'demo_seven'    => 'brooklyn-logo-dark.png',
					'demo_eight'    => 'brooklyn-logo-dark.png',
                    'demo_eight_b'  => 'brooklyn-logo-dark.png',
                    'demo_nine'     => 'brooklyn-logo-light.png',
                    'demo_ten'      => 'brooklyn-logo-dark.png',
                    'demo_eleven'   => 'brooklyn-logo-light.png',
                    'demo_twelve'   => 'brooklyn-logo-gaming.png',
                    'demo_thirteen' => 'brooklyn-logo-default.png',
                    'demo_fourteen' => 'brooklyn-logo-dark.png',
                    'demo_fifteen'  => 'brooklyn-logo-dark.png',
                    'demo_sixteen'  => 'brooklyn-logo-light.png',
                    'demo_seventeen'=> 'brooklyn-logo-light.png',
                    'demo_eighteen' => 'brooklyn-logo-dark.png',
                    'demo_nineteen' => 'brooklyn-logo-light.png',
                    'demo_twenty'   => 'brooklyn-logo-dark.png',
				);
				
                if( isset( $logo_to_demo[$demo_file] ) ) {
                
                    $default_logo = THEME_WEB_ROOT . '/images/default/' . $logo_to_demo[$demo_file];
                    set_theme_mod( 'ut_site_logo' , $default_logo );
                    
                    if($demo_file == 'demo_eleven') {
                        
                        $logo_alt_to_demo = array(
                            'demo_eleven'   => 'brooklyn-logo-dark.png',
                            'demo_thirteen' => 'brooklyn-logo-alternate.png'
                        );
                        
                        $default_alt_logo = THEME_WEB_ROOT . '/images/default/' . $logo_alt_to_demo[$demo_file];
                        set_theme_mod( 'ut_site_logo_alt' , $default_alt_logo );
                        
                    }
                
                }
				/*
				|--------------------------------------------------------------------------
				| Set Default Theme Color
				|--------------------------------------------------------------------------
				*/
				$color_to_demo = array(
					'demo_one'	    => '#F1C40F', 
					'demo_two'      => '#FF6E00',
                    'demo_two_b'    => '#FF6E00', 
					'demo_three'    => '#77BE32', 
					'demo_four'	    => '#F1C40F', 
					'demo_five'	    => '#3498db',
					'demo_six'	    => '#FDA527',
					'demo_seven'    => '#FDA527',
					'demo_eight'    => '#F2333A',
                    'demo_eight_b'  => '#D94118',
                    'demo_nine'     => '#FDA527',
                    'demo_ten'      => '#FDA527',
                    'demo_eleven'   => '#008ED6',
                    'demo_twelve'   => '#00E1FF',
                    'demo_thirteen' => '#1abc9c',
                    'demo_fourteen' => '#907557',
                    'demo_fifteen'  => '#CF0A2C',
                    'demo_sixteen'  => '#c39f76',
                    'demo_seventeen'=> '#c39f76',
                    'demo_eighteen' => '#991b84',
                    'demo_nineteen' => '#c39f76',
                    'demo_twenty'   => '#f1c40f',
                    'demo_twentyone'=> '#F5AB35 '
				);
				update_option('ut_accentcolor', $color_to_demo[$demo_file]);				
				
                
				/*
				|--------------------------------------------------------------------------
				| set default categories for portfolio showcase
				|--------------------------------------------------------------------------
				*/
				$showcase_to_demo = array(
					'demo_one'	    => array('Grid Gallery'), 
					'demo_two'      => array('Grid Gallery'),
                    'demo_two_b'    => array('Grid Gallery'),  
					'demo_three'    => array('Grid Gallery'), 
					'demo_four'	    => array('Grid Gallery'), 
					'demo_five'	    => array('Grid Gallery' , 'Portfolio Carousel'),
					'demo_six'	    => array('Grid Gallery'),
					'demo_seven'    => array('Grid Gallery'),
					'demo_eight'    => array('Grid Gallery'),
                    'demo_eight_b'  => array('Grid Gallery'),
                    'demo_nine'     => array('Grid Gallery' , 'Our Studio'),
                    'demo_ten'      => array('Grid Gallery'),
                    'demo_eleven'   => array('Grid Gallery'),
                    'demo_twelve'   => array('Grid Gallery'),
                    'demo_thirteen' => array('Filterable Portfolio Gallery'),
                    'demo_fourteen' => array('Filterable Portfolio Gallery'),
                    'demo_twenty'   => array('Our Projects','Grid 2 Column','Grid 3 Columns','Grid 4 Column'),
                    'demo_twentyone'=> array('Portfolio Front Page','Portfolio Page','Portfolio Grid 3 Columns','Portfolio Grid 4 Columns','Portfolio Grid 2 Columns','Filter Gallery 3 Columns','Filter Gallery 2 Columns','Filter Gallery 4 Columns','Filter Gallery Without Gaps','Portfolio Grid With Gaps','Portfolio Carousel 9 Column','Portfolio Carousel 8 Column','Portfolio Carousel 7 Column','Portfolio Carousel 6 Column','Portfolio Carousel 5 Column','Portfolio Carousel 4 Column','Portfolio Carousel 3 Column','Portfolio Carousel 2 Column','Portfolio Carousel 1 Column','Portfolio Popup Lightbox'
                    ),
				);
				
				/* fetch all used taxonomies first */
				$taxonomies = get_terms( 'portfolio-category' , array( 'hide_empty' => true ) );
				$portfolio_taxonomies = array();
				
				/* built array */
				foreach($taxonomies as $taxonomy ) {
					
					$portfolio_taxonomies[$taxonomy->term_id] = 'on';
									
				}
				
				/* update showcase */
				if( isset($showcase_to_demo[$demo_file]) ) {			
					foreach( $showcase_to_demo[$demo_file] as $showcase ) {
												
						$showcase = get_page_by_title( $showcase , 'OBJECT' , 'portfolio-manager' );
						update_post_meta($showcase->ID , 'ut_portfolio_categories' , $portfolio_taxonomies);
						
					}	
				}
				
                /*
				|--------------------------------------------------------------------------
				| Set Portfolio Lightbox Script 
				|--------------------------------------------------------------------------
				*/
                if( $demo_file == 'demo_fourteen' || $demo_file == 'demo_fifteen' || $demo_file == 'demo_sixteen' || $demo_file == 'demo_seventeen' || $demo_file == 'demo_eighteen' || $demo_file == 'demo_nineteen' || $demo_file == 'demo_twenty'|| $demo_file == 'demo_twentyone'  ) {
                    
                    update_option( 'portfolio_lightbox_script', 'lightgallery' );
                    
                }
                				
				/*
				|--------------------------------------------------------------------------
				| Update Import Flag
				|--------------------------------------------------------------------------
				*/
				update_option('ut_import_loaded', 'active');
				
				/*
				|--------------------------------------------------------------------------
				| Redirect User
				|--------------------------------------------------------------------------
				*/
				wp_redirect( admin_url( 'admin.php?page=ut_view_updater&utimport=success' ) );
								
				
			}
		
		}
		
	}

} ?>