<?php
require_once("lib/qode.layout.php");
require_once("lib/qode.framework.php");
require_once("lib/qode.functions.php");
require_once("lib/qode.common.php");
require_once("admin/options/qode-options-setup.php");
require_once("admin/meta-boxes/qode-meta-boxes-setup.php");
include_once("lib/google-fonts.php");

/**
 * Register styles and scripts
 */

function qode_admin_scripts_init() {
	wp_register_style('qodef-bootstrap', get_template_directory_uri().'/framework/admin/assets/css/qodef-bootstrap.css');
	wp_register_style('qodef-page-admin', get_template_directory_uri().'/framework/admin/assets/css/qodef-page.css');
	wp_register_style('qodef-options-admin', get_template_directory_uri().'/framework/admin/assets/css/qodef-options.css');
	wp_register_style('qodef-meta-boxes-admin', get_template_directory_uri().'/framework/admin/assets/css/qodef-meta-boxes.css');
	wp_register_style('qodef-ui-admin', get_template_directory_uri().'/framework/admin/assets/css/qodef-ui/qodef-ui.css');
	wp_register_style('qodef-forms-admin', get_template_directory_uri().'/framework/admin/assets/css/qodef-forms.css');
	wp_register_style('font-awesome-admin', get_template_directory_uri().'/framework/admin/assets/css/font-awesome/css/font-awesome.min.css');

	wp_register_script('bootstrap.min', get_template_directory_uri().'/framework/admin/assets/js/bootstrap.min.js');
	wp_register_script('jquery.nouislider.min', get_template_directory_uri().'/framework/admin/assets/js/qodef-ui/jquery.nouislider.min.js');
	wp_register_script('qodef-ui-admin', get_template_directory_uri().'/framework/admin/assets/js/qodef-ui/qodef-ui.js');
	wp_register_script('qodef-twitter-connect', get_template_directory_uri().'/framework/admin/assets/js/qodef-twitter-connect.js');
	wp_register_script('qodef-instagram-disconnect', get_template_directory_uri().'/framework/admin/assets/js/qodef-instagram-disconnect.js');
}
add_action('admin_init', 'qode_admin_scripts_init');

/**
 * Enqueue styles and scripts for admin page
 */

function enqueue_admin_styles() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style('qodef-bootstrap');
	wp_enqueue_style('qodef-page-admin');
	wp_enqueue_style('qodef-options-admin');
	wp_enqueue_style('qodef-ui-admin');
	wp_enqueue_style('jquery.nouislider.min');
	wp_enqueue_style('qodef-forms-admin');
	wp_enqueue_style('font-awesome-admin');
}

function enqueue_admin_scripts() {
	wp_enqueue_script('wp-color-picker'); //colorpicker
	wp_enqueue_script('bootstrap.min');
	wp_enqueue_media();
	wp_enqueue_script('jquery.nouislider.min');
	wp_enqueue_script('qodef-ui-admin');
	wp_enqueue_script('qodef-twitter-connect');
	wp_enqueue_script('qodef-instagram-disconnect');
}

function enqueue_meta_box_styles() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style('qodef-bootstrap');
	wp_enqueue_style('qodef-page-admin');
	wp_enqueue_style('qodef-meta-boxes-admin');
	wp_enqueue_style('qodef-ui-admin');
	wp_enqueue_style('jquery.nouislider.min');
	wp_enqueue_style('qodef-forms-admin');
	wp_enqueue_style('font-awesome-admin');
}

function enqueue_meta_box_scripts() {
	wp_enqueue_script('wp-color-picker'); //colorpicker
	wp_enqueue_script('bootstrap.min');
	wp_enqueue_media();
	wp_enqueue_script('jquery.nouislider.min');
	wp_enqueue_script('qodef-ui-admin');
}

global $qode_options;
$qode_options  = get_option('qode_options_stockholm');

function init_qode_theme_options() {
	global $qode_options;
	global $qodeFramework;
	if(isset($qode_options['reset_to_defaults'])){
		if( $qode_options['reset_to_defaults'] == 'yes' ) delete_option( "qode_options_stockholm");
	}
	if (! get_option("qode_options_stockholm")) {
		add_option( "qode_options_stockholm",
			$qodeFramework->qodeOptions->options
		);
		$qode_options = $qodeFramework->qodeOptions->options;
	}
}

function qode_theme_menu() {
	global $qodeFramework;
	init_qode_theme_options();
	$page_hook_suffix = add_menu_page(
		'Select Options',				   // The value used to populate the browser's title bar when the menu page is active
		'Select Options',				   // The text of the menu in the administrator's sidebar
		'administrator',				  // What roles are able to access the menu
		'qode_theme_menu',				// The ID used to bind submenu items to this menu
		'qode_theme_display'			  // The callback function used to render this menu
	);
	foreach ($qodeFramework->qodeOptions->adminPages as $key=>$value ) {
		$slug = "";
		if (!empty($value->slug)) $slug = "_tab".$value->slug;
		$subpage_hook_suffix = add_submenu_page(
			'qode_theme_menu',
			'Select Options - '.$value->title,				   // The value used to populate the browser's title bar when the menu page is active
			$value->title,				   // The text of the menu in the administrator's sidebar
			'administrator',				  // What roles are able to access the menu
			'qode_theme_menu'.$slug,				// The ID used to bind submenu items to this menu
	  		'qode_theme_display'			  // The callback function used to render this menu
		);
		add_action('admin_print_scripts-'.$subpage_hook_suffix, 'enqueue_admin_scripts');
  		add_action('admin_print_styles-'.$subpage_hook_suffix, 'enqueue_admin_styles');
	};
	add_action('admin_print_scripts-'.$page_hook_suffix, 'enqueue_admin_scripts');
	add_action('admin_print_styles-'.$page_hook_suffix, 'enqueue_admin_styles');
}
add_action( 'admin_menu', 'qode_theme_menu' );

function register_qode_theme_settings() {
	register_setting( 'qode_theme_menu', 'qode_options' );
}
add_action('admin_init', 'register_qode_theme_settings');

function strafter($string, $substring) {
  $pos = strpos($string, $substring);
  if ($pos === false)
   return NULL;
  else 
   return(substr($string, $pos+strlen($substring)));
}
function qode_get_admin_tab(){
	return isset($_GET['page']) ? strafter($_GET['page'],'tab') : NULL;
}

function qodef_save_options() {
	global $qode_options;
	global $qodeFramework;
	$_REQUEST = stripslashes_deep($_REQUEST);
	foreach ($qodeFramework->qodeOptions->options as $key => $value) {
		if (isset($_REQUEST[ $key ])) {
			$qode_options[$key]=$_REQUEST[ $key ];
		}
	}
	update_option( 'qode_options_stockholm', $qode_options );
	do_action('qode_after_theme_option_save');
	echo "Saved";

	die();
}
add_action('wp_ajax_qodef_save_options', 'qodef_save_options');

function qode_theme_display() {
	global $qodeFramework;
	$tab	= qode_get_admin_tab();
	$active_page = $qodeFramework->qodeOptions->getAdminPageFromSlug($tab);
	if ($active_page == null) return;
	?>
	<div class="qodef-options-page qodef-page">

		<div class="qodef-page-header page-header clearfix">
			<img src="<?php echo get_template_directory_uri() . '/framework/admin/assets/img/qode-logo.png' ?>" alt="qode_logo" class="qodef-header-logo pull-left"/>
			<?php $current_theme = wp_get_theme(); ?>
			<h2 class="qodef-page-title pull-left">
				<?php echo esc_html($current_theme->get('Name')); ?>
				<small><?php echo esc_html($current_theme->get('Version')); ?></small>
			</h2>
			<div class="pull-right"> <input type="button" id="qode_top_save_button" class="btn btn-primary btn-sm pull-right" value="<?php _e('Save Changes', 'qode'); ?>"/></div>
		</div> <!-- close div.qodef-page-header -->

		<div class="qodef-page-content-wrapper">
			<div class="qodef-page-content">
				<div class="qodef-page-navigation qodef-tabs-wrapper vertical left clearfix">

					<div class="qodef-tabs-navigation-wrapper">
						<ul class="nav nav-tabs">
							<?php
							foreach ($qodeFramework->qodeOptions->adminPages as $key=>$page ) {
								$slug = "";
								if (!empty($page->slug)) $slug = "_tab".$page->slug;
								$icon = "institution";
								switch ($page->slug) {
									case 1:
										$icon = 'coffee';
										break;
									case 2:
										$icon = 'header';
										break;
									case 3:
										$icon = 'sort-amount-asc';
										break;
									case 4:
										$icon = 'list-alt';
										break;
									case 5:
										$icon = 'font';
										break;
									case 6:
										$icon = 'flag-o';
										break;
									case 7:
										$icon = 'bars';
										break;
									case 8:
										$icon = 'files-o';
										break;
									case 9:
										$icon = 'camera-retro';
										break;
									case 10:
										$icon = 'sliders';
										break;	
									case 11:
										$icon = 'share-alt';
										break;
									case 12:
										$icon = 'times-circle-o';
										break;
									case 13:
										$icon = 'envelope-o';
										break;
									case 14:
										$icon = 'arrows-v';
										break;
									case 15:
										$icon = 'caret-square-o-down';
										break;
									case 16:
										$icon = 'shopping-cart';
										break;
									case 17:
										$icon = 'eraser';
										break;
									case 18:
										$icon = 'pencil-square-o';
										break;	
								}
								?>
								<li<?php if ($page->slug == $tab) echo " class=\"active\""; ?>><a href="<?php echo esc_url(get_admin_url().'admin.php?page=qode_theme_menu'.$slug); ?>"><i class="fa fa-<?php echo esc_attr($icon); ?> qodef-tooltip qodef-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php echo esc_attr($page->title); ?>"></i><span><?php echo esc_attr($page->title); ?></span></a></li>
							<?php
							}
							?>
						</ul>
					</div> <!-- close div.qodef-tabs-navigation-wrapper -->

					<div class="qodef-tabs-content">
						<div class="tab-content">
							<?php
							foreach ($qodeFramework->qodeOptions->adminPages as $key=>$page ) {
								if ($page->slug == $tab) {
									?>
									<div class="tab-pane fade<?php if ($page->slug == $tab) echo " in active"; ?>" id="<?php echo esc_attr($key); ?>">
										<div class="qodef-tab-content">
											<h2 class="qodef-page-title"><?php echo esc_html($page->title); ?></h2>


											<form method="post" class="qode_ajax_form">
												<div class="qodef-page-form">
													<?php $page->render(); ?>

													<div class="form-button-section clearfix">
														<div class="qodef-input-change">You should save your changes</div>
														<div class="qodef-changes-saved">All your changes are successfully saved</div>
														<div class="form-buttom-section-holder" id="anchornav">
															<div class="form-button-section-inner clearfix" >

																<div class="container-fluid">
																	<div class="row">
																		<div class="col-lg-10">
																			<ul class="pull-left">
																				<li>Scroll To:</li>
																				<?php
																				foreach ($page->layout as $key=>$panel ) {
																					?>
																					<li><a href="#qodef_<?php echo esc_attr($panel->name); ?>"><?php echo esc_attr($panel->title); ?></a></li>
																				<?php
																				}
																				?>
																			</ul>
																		</div>
																		<div class="col-lg-2">
																			<input type="submit" class="btn btn-primary btn-sm pull-right" value="<?php _e('Save Changes', 'qode'); ?>"/>
																		</div>
																	</div>
																</div>

															</div>
														</div>
													</div>
												</div>
											</form>

										</div><!-- close qodef-tab-content -->
									</div>
								<?php
								}
							}
							?>
						</div>
					</div> <!-- close div.qodef-tabs-content -->

				</div> <!-- close div.qodef-page-navigation -->

			</div> <!-- close div.qodef-page-content -->

		</div> <!-- close div.qodef-page-content-wrapper -->

	</div> <!-- close div.qode-options-page -->
<?php }

function qode_meta_box_add() {
	global $qodeFramework;

	foreach ($qodeFramework->qodeMetaBoxes->metaBoxes as $key=>$box ) {
		$hidden = false;
		if (!empty($box->hidden_property)){
			foreach ($box->hidden_values as $value) {
				if (qodef_option_get_value($box->hidden_property)==$value)
					$hidden = true;

			}
		}
		add_meta_box(
			'qodef-meta-box-'.$key,
			$box->title,
			'qodef_render_meta_box',
			$box->scope,
			'advanced',
			'high',
			array( 'box' => $box)
		);
		if ($hidden) {
			add_filter( 'postbox_classes_'.$box->scope.'_qodef-meta-box-'.$key, 'qode_meta_box_add_hidden_class' );
		}
	}

	add_action('admin_enqueue_scripts', 'enqueue_meta_box_styles');
	add_action('admin_enqueue_scripts', 'enqueue_meta_box_scripts');
}
add_action('add_meta_boxes', 'qode_meta_box_add');

function qode_meta_box_save( $post_id, $post ) {
	global $qodeFramework;

    $nonces_array = array();
    $meta_boxes = $qodeFramework->qodeMetaBoxes->getMetaBoxesByScope($post->post_type);

    if(is_array($meta_boxes) && count($meta_boxes)) {
        foreach($meta_boxes as $meta_box) {
            $nonces_array[] = 'qode_meta_box_'.$meta_box->name.'_save';
        }
    }

    if(is_array($nonces_array) && count($nonces_array)) {
        foreach($nonces_array as $nonce) {
            if(!isset($_POST[$nonce]) || !wp_verify_nonce($_POST[$nonce], $nonce)) {
                return;
            }
        }
    }

	$postTypes = array( "page", "post", "portfolio_page", "testimonials", "slides", "carousels");
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
	if ( !isset( $_POST[ '_wpnonce' ] ))
		return;
	if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	if ( ! in_array( $post->post_type, $postTypes ) )
		return;
	foreach ($qodeFramework->qodeMetaBoxes->options as $key=>$box ) {

		if ( isset( $_POST[ $key ] ) && trim( $_POST[ $key ] !== '') ) {

			$value = $_POST[ $key ];
			// Auto-paragraphs for any WYSIWYG
			update_post_meta( $post_id, $key, $value );
		} else {
			delete_post_meta( $post_id, $key );
		}
	}

	$portfolios = false;
	if (isset($_POST['optionLabel'])) {
		foreach ($_POST['optionLabel'] as $key => $value) {
			$portfolios_val[$key] = array('optionLabel'=>$value,'optionValue'=>$_POST['optionValue'][$key],'optionUrl'=>$_POST['optionUrl'][$key],'optionlabelordernumber'=>$_POST['optionlabelordernumber'][$key]);
			$portfolios = true;

		}
	}

	if ($portfolios) {
		update_post_meta( $post_id,  'qode_portfolios', $portfolios_val );
	} else {
		delete_post_meta( $post_id, 'qode_portfolios' );
	}

	$portfolio_images = false;
	if (isset($_POST['portfolioimg'])) {
		foreach ($_POST['portfolioimg'] as $key => $value) {
			$portfolio_images_val[$key] = array('portfolioimg'=>$_POST['portfolioimg'][$key],'portfoliotitle'=>$_POST['portfoliotitle'][$key],'portfolioimgordernumber'=>$_POST['portfolioimgordernumber'][$key], 'portfoliovideotype'=>$_POST['portfoliovideotype'][$key], 'portfoliovideoid'=>$_POST['portfoliovideoid'][$key], 'portfoliovideoimage'=>$_POST['portfoliovideoimage'][$key], 'portfoliovideowebm'=>$_POST['portfoliovideowebm'][$key], 'portfoliovideomp4'=>$_POST['portfoliovideomp4'][$key], 'portfoliovideoogv'=>$_POST['portfoliovideoogv'][$key], 'portfolioimgtype'=>$_POST['portfolioimgtype'][$key] );
			$portfolio_images = true;
		}
	}


	if ($portfolio_images) {
		update_post_meta( $post_id,  'qode_portfolio_images', $portfolio_images_val );
	} else {
		delete_post_meta( $post_id,  'qode_portfolio_images' );
	}
}

add_action( 'save_post', 'qode_meta_box_save', 1, 2 );

function qodef_render_meta_box($post, $metabox) {?>
	<div class="qodef-meta-box qodef-page">
		<div class="qodef-meta-box-holder">

			<?php $metabox['args']['box']->render(); ?>
            <?php wp_nonce_field('qode_meta_box_'.$metabox['args']['box']->name.'_save', 'qode_meta_box_'.$metabox['args']['box']->name.'_save'); ?>

		</div>
	</div>
<?php
}

function qode_meta_box_add_hidden_class( $classes=array() ) {
	if( !in_array( 'qodef-meta-box-hidden', $classes ) )
		$classes[] = 'qodef-meta-box-hidden';

	return $classes;
}

/**
 * Remove the default Custom Fields meta box
 */

function removeDefaultCustomFields() {
	foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
		foreach ( array( "page", "post", "portfolio_page", "testimonials", "slides", "carousels" ) as $postType ) {
			remove_meta_box( 'postcustom', $postType, $context );
		}
	}
}
add_action('do_meta_boxes','removeDefaultCustomFields');

if(!function_exists('qode_admin_notice')) {
    /**
     * Prints admin notice. It checks if notice has been disabled and if it hasn't then it displays it
     * @param $id string id of notice. It will be used to store notice dismis
     * @param $message string message to show to the user
     * @param $class string HTML class of notice
     * @param bool $is_dismisable whether notice is dismisable or not
     */
    function qode_admin_notice($id, $message, $class, $is_dismisable = true) {
        $is_dismised = get_user_meta(get_current_user_id(), 'dismis_'.$id);

        //if notice isn't dismissed
        if(!$is_dismised && is_admin()) {
            echo '<div style="display: block;" class="'.esc_attr($class).' is-dismissible notice">';
            echo '<p>';

            echo wp_kses_post($message);

            if($is_dismisable) {
                echo '<strong style="display: block; margin-top: 7px;"><a href="'.esc_url(add_query_arg('qode_dismis_notice', $id)).'">'.__('Dismiss this notice', 'qode').'</a></strong>';
            }

            echo '</p>';

            echo '</div>';
        }

    }
}

if(!function_exists('qode_save_dismisable_notice')) {
    /**
     * Updates user meta with dismisable notice. Hooks to admin_init action
     * in order to check this on every page request in admin
     */
    function qode_save_dismisable_notice() {
        if(is_admin() && !empty($_GET['qode_dismis_notice'])) {
            $notice_id = sanitize_key($_GET['qode_dismis_notice']);
            $current_user_id = get_current_user_id();

            update_user_meta($current_user_id, 'dismis_'.$notice_id, 1);
        }
    }

    add_action('admin_init', 'qode_save_dismisable_notice');
}

if(!function_exists('qode_hook_twitter_request_ajax')) {
	/**
	 * Wrapper function for obtaining twitter request token.
	 * Hooks to wp_ajax_qode_twitter_obtain_request_token ajax action
	 *
	 * @see QodeStockholmTwitterApi::obtainRequestToken()
	 */
	function qode_hook_twitter_request_ajax() {
		QodeStockholmTwitterApi::getInstance()->obtainRequestToken();
	}

	add_action('wp_ajax_qode_twitter_obtain_request_token', 'qode_hook_twitter_request_ajax');
}

if(!function_exists('qode_hook_instagram_disconnect_ajax')) {
	/**
	 * Wrapper function for disconnecting from instagram.
	 * Hooks to wp_ajax_qode_instagram_disconnect ajax action
	 *
	 * @see QodeStockholmInstagramApi::obtainRequestToken()
	 */
	function qode_hook_instagram_disconnect_ajax() {
		QodeStockholmInstagramApi::getInstance()->disconnectUser();
	}

	add_action('wp_ajax_qode_instagram_disconnect', 'qode_hook_instagram_disconnect_ajax');
}
?>