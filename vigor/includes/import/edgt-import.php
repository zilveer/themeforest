<?php
if (!function_exists ('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}
class Edge_Import {

    public $message = "";
    public $attachments = false;
    function Edge_Import() {
        add_action('admin_menu', array(&$this, 'edgt_admin_import'));
        add_action('admin_init', array(&$this, 'edgt_register_theme_settings'));

    }
    function edgt_register_theme_settings() {
        register_setting( 'edgt_options_import_page', 'edgt_options_import');
    }

    function init_edgt_import() {
        if(isset($_REQUEST['import_option'])) {
            $import_option = $_REQUEST['import_option'];
            if($import_option == 'content'){
                $this->import_content('proya_content.xml');
            }elseif($import_option == 'custom_sidebars') {
                $this->import_custom_sidebars('custom_sidebars.txt');
            } elseif($import_option == 'widgets') {
                $this->import_widgets('widgets.txt','custom_sidebars.txt');
            } elseif($import_option == 'options'){
                $this->import_options('options.txt');
            }elseif($import_option == 'menus'){
                $this->import_menus('menus.txt');
            }elseif($import_option == 'settingpages'){
                $this->import_settings_pages('settingpages.txt');
            }elseif($import_option == 'complete_content'){
                $this->import_content('proya_content.xml');
                $this->import_options('options.txt');
                $this->import_widgets('widgets.txt','custom_sidebars.txt');
                $this->import_menus('menus.txt');
                $this->import_settings_pages('settingpages.txt');
                $this->message = __("Content imported successfully", "edgt");
            }
        }
    }

    public function import_content($file){
        if (!class_exists('WP_Importer')) {
            ob_start();
            $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
            require_once($class_wp_importer);
            require_once(get_template_directory() . '/includes/import/class.wordpress-importer.php');
            $edgt_import = new WP_Import();
            set_time_limit(0);
            $path = get_template_directory() . '/includes/import/files/' . $file;

            $edgt_import->fetch_attachments = $this->attachments;
            $returned_value = $edgt_import->import($file);
            if(is_wp_error($returned_value)){
                $this->message = __("An Error Occurred During Import", "edgt");
            }
            else {
                $this->message = __("Content imported successfully", "edgt");
            }
            ob_get_clean();
        } else {
            $this->message = __("Error loading files", "edgt");
        }
    }

    public function import_widgets($file, $file2){
        $this->import_custom_sidebars($file2);
        $options = $this->file_options($file);
        foreach ((array) $options['widgets'] as $edgt_widget_id => $edgt_widget_data) {
            update_option( 'widget_' . $edgt_widget_id, $edgt_widget_data );
        }
        $this->import_sidebars_widgets($file);
        $this->message = __("Widgets imported successfully", "edgt");
    }

    public function import_sidebars_widgets($file){
        $edgt_sidebars = get_option("sidebars_widgets");
        unset($edgt_sidebars['array_version']);
        $data = $this->file_options($file);
        if ( is_array($data['sidebars']) ) {
            $edgt_sidebars = array_merge( (array) $edgt_sidebars, (array) $data['sidebars'] );
            unset($edgt_sidebars['wp_inactive_widgets']);
            $edgt_sidebars = array_merge(array('wp_inactive_widgets' => array()), $edgt_sidebars);
            $edgt_sidebars['array_version'] = 2;
            wp_set_sidebars_widgets($edgt_sidebars);
        }
    }

    public function import_custom_sidebars($file){
        $options = $this->file_options($file);
        update_option( 'edgt_sidebars', $options);
        $this->message = __("Custom sidebars imported successfully", "edgt");
    }

    public function import_options($file){
        $options = $this->file_options($file);
        update_option( 'edgt_options_vigor', $options);
        $this->message = __("Options imported successfully", "edgt");
    }

    public function import_menus($file){
        global $wpdb;
        $edgt_terms_table = $wpdb->prefix . "terms";
        $this->menus_data = $this->file_options($file);
        $menu_array = array();
        foreach ($this->menus_data as $registered_menu => $menu_slug) {
            $term_rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $edgt_terms_table where slug=%s", $menu_slug), ARRAY_A);
            if(isset($term_rows[0]['term_id'])) {
                $term_id_by_slug = $term_rows[0]['term_id'];
            } else {
                $term_id_by_slug = null;
            }
            $menu_array[$registered_menu] = $term_id_by_slug;
        }
        set_theme_mod('nav_menu_locations', array_map('absint', $menu_array ) );

    }
    public function import_settings_pages($file){
        $pages = $this->file_options($file);
        foreach($pages as $edgt_page_option => $edgt_page_id){
            update_option( $edgt_page_option, $edgt_page_id);
        }
    }

    public function file_options($file){
        $file_content = "";
        $file_for_import = get_template_directory() . '/includes/import/files/' . $file;
        $file_content = $this->edgt_file_contents($file);
        if ($file_content) {
            $unserialized_content = unserialize(base64_decode($file_content));
            if ($unserialized_content) {
                return $unserialized_content;
            }
        }
        return false;
    }

    function edgt_file_contents( $path ) {
		$url      = "http://export.edge-themes.com/".$path;
		$response = wp_remote_get($url);
		$body     = wp_remote_retrieve_body($response);
		return $body;
    }

    function edgt_admin_import() {
		$slug = "_tabimport";
		$this->pagehook = add_submenu_page(
			'edgt_theme_menu',
			'Edge Options - Edge Import',                   // The value used to populate the browser's title bar when the menu page is active
			'Import',                   // The text of the menu in the administrator's sidebar
			'administrator',                  // What roles are able to access the menu
			'edgt_theme_menu'.$slug,                // The ID used to bind submenu items to this menu
			array(&$this, 'edgt_generate_import_page')
		);
    }

    function edgt_generate_import_page() {
		edgt_enqueue_admin_styles();
		wp_enqueue_style('edgtf-import');

		edgt_enqueue_admin_scripts();

		global $edgtFramework;
		$tab    = edgt_get_admin_tab();
		?>
		<div class="edgtf-options-page edgtf-page">

			<div class="edgtf-page-header page-header clearfix">

				<div class="edgtf-theme-name pull-left" >
					<img src="<?php echo esc_url(edgt_get_skin_uri().'/assets/img/logo.png'); ?>" alt="edgt_logo" class="edgtf-header-logo pull-left"/>
					<?php $current_theme = wp_get_theme(); ?>
					<h1 class="pull-left">
						<?php echo esc_html($current_theme->get('Name')); ?>
						<small><?php echo esc_html($current_theme->get('Version')); ?></small>
					</h1>
				</div>
				<div class="edgtf-top-section-holder">


				</div>

			</div> <!-- close div.edgtf-page-header -->

			<div class="edgtf-page-content-wrapper">
				<div class="edgtf-page-content">
					<div class="edgtf-page-navigation edgtf-tabs-wrapper vertical left clearfix">

						<div class="edgtf-tabs-navigation-wrapper">

							<ul class="nav nav-tabs clearfix">
								<?php
								foreach ($edgtFramework->edgtOptions->adminPages as $key=>$page ) {
									$slug = "";
									if (!empty($page->slug)) $slug = "_tab".$page->slug;
									?>
									<li<?php if ($page->slug == $tab) echo " class=\"active\""; ?>>
										<a href="<?php echo esc_url(get_admin_url().'admin.php?page=edgt_theme_menu'.$slug); ?>">
											<?php if($page->icon !== '') { ?>
												<i class="<?php echo esc_attr($page->icon); ?> edgtf-tooltip edgtf-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php echo esc_attr($page->title); ?>"></i>
											<?php } ?>
											<span><?php echo esc_html($page->title); ?></span>
										</a>
									</li>
								<?php
								}
								?>
								<li class="active"><a href="<?php echo get_admin_url().'admin.php?page=edgt_theme_menu_tabimport'; ?>"><i class="fa fa-download edgtf-tooltip edgtf-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="Import"></i><span>Import</span></a></li>

							</ul>
						</div> <!-- close div.edgtf-tabs-navigation-wrapper -->

						<div class="edgtf-tabs-content">
							<div class="tab-content">
										<div class="tab-pane fade in active" id="import">
											<div class="edgtf-tab-content">
												<h2 class="edgtf-page-title">Import</h2>
												<form method="post" class="edgt_ajax_form edgtf-import-page-holder">
													<div class="edgtf-page-form">
														<div class="edgtf-page-form-section-holder">
															<h3 class="edgtf-page-section-title">Import Demo Content</h3>
															<div class="edgtf-page-form-section">
																<div class="edgtf-field-desc">
																	<h4>Import</h4>

																	<p>Choose demo content you want to import</p>
																</div>
																<!-- close div.edgtf-field-desc -->

																<div class="edgtf-section-content">
																	<div class="container-fluid">
																		<div class="row">
																			<div class="col-lg-3">
																				<select name="import_example" id="import_example" class="form-control edgtf-form-element dependence">
												                                     <option value="vigor1">1: Boardwalk</option>
												                                     <option value="vigor2">2: Column</option>
												                                     <option value="vigor3">3: Original</option>
												                                     <option value="vigor4">4: Herb</option>
												                                     <option value="vigor5">5: Jigsaw</option>
												                                     <option value="vigor6">6: Artist</option>
												                                     <option value="vigor7">7: Brand</option>
												                                     <option value="vigor8">8: Ocean</option>
												                                     <option value="vigor9">9: Blogger</option>
												                                     <option value="vigor10">10: Canvas</option>
												                                     <option value="vigor11">11: Mosaic</option>
												                                     <option value="vigor12">12: Storyteller</option>
																				</select>
																			</div>
																		</div>
																	</div>
																</div>
																<!-- close div.edgtf-section-content -->

															</div>

															<div class="edgtf-page-form-section">

																<div class="edgtf-field-desc">
																	<h4>Import Type</h4>
																</div>
																<!-- close div.edgtf-field-desc -->

																<div class="edgtf-section-content">
																	<div class="container-fluid">
																		<div class="row">
																			<div class="col-lg-3">
																				<select name="import_option" id="import_option" class="form-control edgtf-form-element">
																					<option value="">Please Select</option>
																					<option value="complete_content">All</option>
																					<option value="content">Content</option>
																					<option value="widgets">Widgets</option>
																					<option value="options">Options</option>
																				</select>
																			</div>
																		</div>
																	</div>
																</div>
																<!-- close div.edgtf-section-content -->

															</div>
															<div class="edgtf-page-form-section">


																<div class="edgtf-field-desc">
																	<h4>Import attachments</h4>

																	<p>Do you want to import media files?</p>
																</div>
																<!-- close div.edgtf-field-desc -->
																<div class="edgtf-section-content">
																	<div class="container-fluid">
																		<div class="row">
																			<div class="col-lg-12">
																				<p class="field switch">
																					<label class="cb-enable dependence"><span>Yes</span></label>
																					<label class="cb-disable selected dependence"><span>No</span></label>
																					<input type="checkbox" id="import_attachments" class="checkbox" name="import_attachments" value="1">
																				</p>
																			</div>
																		</div>
																	</div>
																</div>
																<!-- close div.edgtf-section-content -->
															</div>
															<div class="edgtf-page-form-section">


																<div class="edgtf-field-desc">
																	<input type="submit" class="btn btn-primary btn-sm " value="Import" name="import" id="import_demo_data" />
																</div>
																<!-- close div.edgtf-field-desc -->
																<div class="edgtf-section-content">
																	<div class="container-fluid">
																		<div class="row">
																			<div class="col-lg-12">
																				<div class="import_load"><span><?php _e('The import process may take some time. Please be patient.', 'edgt') ?> </span><br />
																					<div class="edgt-progress-bar-wrapper html5-progress-bar">
																						<div class="progress-bar-wrapper">
																							<progress id="progressbar" value="0" max="100"></progress>
																						</div>
																						<div class="progress-value">0%</div>
																						<div class="progress-bar-message">
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!-- close div.edgtf-section-content -->
															</div>
															<div class="edgtf-page-form-section edgtf-import-button-wrapper">

																<div class="alert alert-warning">
																	<strong><?php _e('Important notes:', 'edgt') ?></strong>
																	<ul>
																		<li><?php _e('Please note that import process will take time needed to download all attachments from demo web site.', 'edgt'); ?></li>
																		<li> <?php _e('If you plan to use shop, please install WooCommerce before you run import.', 'edgt')?></li>
																	</ul>
																</div>
															</div>
														</div>

													</div>
												</form>

											</div><!-- close edgtf-tab-content -->
										</div>
							</div>
						</div> <!-- close div.edgtf-tabs-content -->

					</div> <!-- close div.edgtf-page-navigation -->

				</div> <!-- close div.edgtf-page-content -->

			</div> <!-- close div.edgtf-page-content-wrapper -->

		</div> <!-- close div.edgt-options-page -->

        <script type="text/javascript">
			(function($) {
				$(document).ready(function() {
					$(document).on('click', '#import_demo_data', function(e) {
						e.preventDefault();
						if (confirm('Are you sure, you want to import Demo Data now?')) {
							$('.import_load').css('display','block');
							var progressbar = $('#progressbar');
							var import_opt = $( "#import_option" ).val();
							var import_expl = $( "#import_example" ).val();
							var p = 0;
							if(import_opt == 'content'){
								for(var i=1;i<10;i++){
									var str;
									if (i < 10) str = 'vigor_content_0'+i+'.xml';
									else str = 'vigor_content_'+i+'.xml';
									jQuery.ajax({
										type: 'POST',
										url: ajaxurl,
										data: {
											action: 'edgt_dataImport',
											xml: str,
											example: import_expl,
											import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
										},
										success: function(data, textStatus, XMLHttpRequest){
											p+= 10;
											$('.progress-value').html((p) + '%');
											progressbar.val(p);
											if (p == 90) {
												str = 'vigor_content_10.xml';
												jQuery.ajax({
													type: 'POST',
													url: ajaxurl,
													data: {
														action: 'edgt_dataImport',
														xml: str,
														example: import_expl,
														import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
													},
													success: function(data, textStatus, XMLHttpRequest){
														p+= 10;
														$('.progress-value').html((p) + '%');
														progressbar.val(p);
														$('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
													},
													error: function(MLHttpRequest, textStatus, errorThrown){
													}
												});
											}
										},
										error: function(MLHttpRequest, textStatus, errorThrown){
										}
									});
								}
							} else if(import_opt == 'widgets') {
								jQuery.ajax({
									type: 'POST',
									url: ajaxurl,
									data: {
										action: 'edgt_widgetsImport',
										example: import_expl
									},
									success: function(data, textStatus, XMLHttpRequest){
										$('.progress-value').html((100) + '%');
										progressbar.val(100);
									},
									error: function(MLHttpRequest, textStatus, errorThrown){
									}
								});
								$('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
							} else if(import_opt == 'options'){
								jQuery.ajax({
									type: 'POST',
									url: ajaxurl,
									data: {
										action: 'edgt_optionsImport',
										example: import_expl
									},
									success: function(data, textStatus, XMLHttpRequest){
										$('.progress-value').html((100) + '%');
										progressbar.val(100);
									},
									error: function(MLHttpRequest, textStatus, errorThrown){
									}
								});
								$('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
							}else if(import_opt == 'complete_content'){
								for(var i=1;i<10;i++){
									var str;
									if (i < 10) str = 'vigor_content_0'+i+'.xml';
									else str = 'vigor_content_'+i+'.xml';
									jQuery.ajax({
										type: 'POST',
										url: ajaxurl,
										data: {
											action: 'edgt_dataImport',
											xml: str,
											example: import_expl,
											import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
										},
										success: function(data, textStatus, XMLHttpRequest){
											p+= 10;
											$('.progress-value').html((p) + '%');
											progressbar.val(p);
											if (p == 90) {
												str = 'vigor_content_10.xml';
												jQuery.ajax({
													type: 'POST',
													url: ajaxurl,
													data: {
														action: 'edgt_dataImport',
														xml: str,
														example: import_expl,
														import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
													},
													success: function(data, textStatus, XMLHttpRequest){
														jQuery.ajax({
															type: 'POST',
															url: ajaxurl,
															data: {
																action: 'edgt_otherImport',
																example: import_expl
															},
															success: function(data, textStatus, XMLHttpRequest){
																$('.progress-value').html((100) + '%');
																progressbar.val(100);
																$('.progress-bar-message').html('<div class="alert alert-success">Import is completed.</div>');
															},
															error: function(MLHttpRequest, textStatus, errorThrown){
															}
														});
													},
													error: function(MLHttpRequest, textStatus, errorThrown){
													}
												});
											}
										},
										error: function(MLHttpRequest, textStatus, errorThrown){
										}
									});
								}
							}
						}
						return false;
					});
				});
			})(jQuery);

        </script>

    <?php	}

}
global $my_Edge_Import;
$my_Edge_Import = new Edge_Import();



if(!function_exists('edgt_dataImport')){
    function edgt_dataImport(){
        global $my_Edge_Import;

        if ($_POST['import_attachments'] == 1)
            $my_Edge_Import->attachments = true;
        else
            $my_Edge_Import->attachments = false;

        $folder = "vigor1/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $my_Edge_Import->import_content($folder.$_POST['xml']);

        die();
    }

    add_action('wp_ajax_edgt_dataImport', 'edgt_dataImport');
}

if(!function_exists('edgt_widgetsImport')){
    function edgt_widgetsImport(){
        global $my_Edge_Import;

        $folder = "vigor1/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $my_Edge_Import->import_widgets($folder.'widgets.txt',$folder.'custom_sidebars.txt');

        die();
    }

    add_action('wp_ajax_edgt_widgetsImport', 'edgt_widgetsImport');
}

if(!function_exists('edgt_optionsImport')){
    function edgt_optionsImport(){
        global $my_Edge_Import;

        $folder = "vigor1/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $my_Edge_Import->import_options($folder.'options.txt');

        die();
    }

    add_action('wp_ajax_edgt_optionsImport', 'edgt_optionsImport');
}

if(!function_exists('edgt_otherImport')){
    function edgt_otherImport(){
        global $my_Edge_Import;

        $folder = "vigor1/";
        if (!empty($_POST['example']))
            $folder = $_POST['example']."/";

        $my_Edge_Import->import_options($folder.'options.txt');
        $my_Edge_Import->import_widgets($folder.'widgets.txt',$folder.'custom_sidebars.txt');
        $my_Edge_Import->import_menus($folder.'menus.txt');
        $my_Edge_Import->import_settings_pages($folder.'settingpages.txt');

        die();
    }

    add_action('wp_ajax_edgt_otherImport', 'edgt_otherImport');
}