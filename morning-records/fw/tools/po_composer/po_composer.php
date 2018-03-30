<?php
/**
 * Edit .po-file and generate correspond .mo-file.
 * Merge two .po-files (for example, from previous and current theme update or two independent .po-files).
 */
 
// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('morning_records_po_composer_theme_setup')) {
	add_action( 'morning_records_action_after_init_theme', 'morning_records_po_composer_theme_setup' );		// Fire this action after load theme options
	function morning_records_po_composer_theme_setup() {
		if (is_admin() && current_user_can('manage_options') && morning_records_get_theme_option('admin_po_composer')=='yes') {
			new morning_records_po_composer();
		}
	}
}


class morning_records_po_composer {

	var $tpl_dir  = '';
	var $css_dir  = '';
	var $is_child = false;
	var $po_src   = '';
	var $po_src2  = '';
	var $po_text  = '';
	var $po_text2 = '';
	var $po_link  = '';
	var $mo_text  = '';
	var $mo_link  = '';
	var $error    = '';
	var $error_update = '';
	var $success  = '';

	//-----------------------------------------------------------------------------------
	// Constuctor
	//-----------------------------------------------------------------------------------
	function __construct() {
		// Setup actions handlers
		add_action('admin_menu', array($this, 'admin_menu_item'));
		add_action("admin_enqueue_scripts", array($this, 'load_scripts'));

		// Init properties
		$this->tpl_dir  = strtr(get_template_directory(), '\\', '/').'/languages';
		$this->css_dir  = strtr(get_stylesheet_directory(), '\\', '/').'/languages';
		$this->is_child = $this->tpl_dir!=$this->css_dir;
		$this->po_src   = isset($_POST['po_src']) ? $_POST['po_src'] : '';
		$this->po_src2  = isset($_POST['po_src2']) ? $_POST['po_src2'] : '';
	}

	//-----------------------------------------------------------------------------------
	// Admin Interface
	//-----------------------------------------------------------------------------------
	function admin_menu_item() {
		if ( current_user_can( 'manage_options' ) ) {
			// 'theme' - add in the 'Appearance'
			// 'management' - add in the 'Tools'
			morning_records_admin_add_menu_item('theme', array(
				'page_title' => esc_html__('PO Composer', 'morning-records'),
				'menu_title' => esc_html__('PO Composer', 'morning-records'),
				'capability' => 'manage_options',
				'menu_slug'  => 'po_composer',
				'callback'   => array($this, 'build_page'),
				'icon'		 => ''
				)
			);
		}
	}
	
	
	//-----------------------------------------------------------------------------------
	// Load required styles and scripts
	//-----------------------------------------------------------------------------------
	function load_scripts() {
		if (isset($_REQUEST['page']) && $_REQUEST['page']=='po_composer') {
			morning_records_enqueue_style('po-composer-style', morning_records_get_file_url('tools/po_composer/po_composer.css', array(), null));
			wp_deregister_style('jquery_ui');
			wp_deregister_style('date-picker-css');
		}
		if (isset($_REQUEST['page']) && $_REQUEST['page']=='po_composer') {
			morning_records_enqueue_script('jquery-ui-core', false, array('jquery'), null, true);
			morning_records_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
			morning_records_enqueue_script('po-composer-script', morning_records_get_file_url('tools/po_composer/po_composer.js', array('jquery'), null, true));
		}
	}
	
	
	//-----------------------------------------------------------------------------------
	// Build the Main Page
	//-----------------------------------------------------------------------------------
	function build_page() {
		
		$this->actions_handler();
		
		$parent_list = $this->get_list_files($this->tpl_dir, 'po');
		$child_list = $this->get_list_files($this->tpl_dir, 'po');

		$options  =  "\n".'<option value="upload_">'.esc_html__('Upload .po-file', 'morning-records').'</option>'
					."\n".'<option value="edit_"'.(in_array($this->po_src, array('upload_', 'edit_')) ? ' selected="selected"' : '').'>'.esc_html__('Edit .po-text', 'morning-records').'</option>'
					."\n".'<optgroup label="'.($this->is_child ? esc_attr__('Parent languages', 'morning-records') : esc_attr__('Languages', 'morning-records')).'">'.trim($this->get_list_options($parent_list,  'parent_', $this->po_src))."\n".'</optgroup>'
					.($this->is_child ? "\n".'<optgroup label="'.esc_attr__('Child languages', 'morning-records').'">'.trim($this->get_list_options($child_list, 'child_', $this->po_src))."\n".'</optgroup>' : '');
		$options2 = "\n".'<option value="">'.esc_html__('- Select merge source -', 'morning-records').'</option>'
					."\n".'<option value="upload_"'.($this->error && $this->po_src2=='upload_' ? ' selected="selected"' : '').'>'.esc_html__('Upload .po-file', 'morning-records').'</option>'
					."\n".'<option value="edit_"'.($this->error && $this->po_src2=='edit_' ? ' selected="selected"' : '').'>'.esc_html__('Edit .po-text', 'morning-records').'</option>'
					."\n".'<optgroup label="'.($this->is_child ? esc_attr__('Parent languages', 'morning-records') : esc_attr__('Languages', 'morning-records')).'">'.trim($this->get_list_options($parent_list,  'parent_', $this->error ? $this->po_src2 : ''))."\n".'</optgroup>'
					.($this->is_child ? "\n".'<optgroup label="'.esc_attr__('Child languages', 'morning-records').'">'.trim($this->get_list_options($child_list, 'child_', $this->error ? $this->po_src2 : ''))."\n".'</optgroup>' : '');

		?>
		<div class="po_composer">
			<h2 class="po_composer_title"><?php esc_html_e('ThemeREX .PO-files Composer', 'morning-records'); ?></h2>
			<div class="po_composer_result">
				<?php if (!empty($this->error)) { ?>
				<div class="error">
					<p><?php echo trim($this->error); ?></p>
				</div>
				<?php } ?>
				<?php if (!empty($this->error_update)) { ?>
					<div class="error">
						<p><?php echo trim($this->error_update); ?></p>
					</div>
				<?php } ?>
				<?php if (!empty($this->success)) { ?>
				<div class="updated">
					<p><?php echo trim($this->success); ?></p>
				</div>
				<?php } ?>
			</div>
	
			<form id="po_composer_form" action="#" method="post" enctype="multipart/form-data">

				<input type="hidden" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" name="nonce" />

				<div class="po_composer_block">
					<fieldset class="po_composer_block_inner">
						<legend><?php esc_html_e('Edit .po-file:', 'morning-records'); ?></legend>
						<div class="po_composer_fields">
							<div class="po_composer_field">
								<label for="po_src"><?php esc_html_e('Select .po-file:', 'morning-records'); ?></label>
								<select name="po_src" id="po_src"><?php echo trim($options); ?></select>
								<input type="file" name="po_file" id="po_file" />
							</div>
							<div class="po_composer_field po_composer_editor">
								<span class="left_side">
								<input type="checkbox" value="1" name="po_translated_down" id="po_translated_down"<?php echo isset($_POST['po_translated_down']) ? ' checked="checked"' : ''; ?> /><label for="po_translated_down"><?php esc_html_e('Move translated strings down', 'morning-records'); ?></label>
								</span>
								<ul class="right_side">
									<li id="po_composer_link_text" class="po_composer_link_text"><a href="#po_composer_editor_text"><?php esc_html_e('Plain text', 'morning-records'); ?></a></li><li id="po_composer_link_list" class="po_composer_link_list"><a href="#po_composer_editor_list"><?php esc_html_e('Strings editor', 'morning-records'); ?></a></li>
								</ul>
								<div id="po_composer_editor_text" class="po_composer_editor_content">
									<textarea name="po_text" id="po_text"><?php echo esc_html($this->po_text); ?></textarea>
								</div>
								<div id="po_composer_editor_list" class="po_composer_editor_content">
									<select id="po_list" size="20"></select><br />
									<input type="text" value="" id="po_string" /><br />
									<span id="po_msgid"></span>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
	
				<div class="po_composer_block">
					<fieldset class="po_composer_block_inner">
						<legend><?php esc_html_e('Merge with .po-file:', 'morning-records'); ?></legend>
						<div class="po_composer_fields">
							<div class="po_composer_field">
								<label for="po_src2"><?php esc_html_e('Select .po-file:', 'morning-records'); ?></label>
								<select name="po_src2" id="po_src2"><?php echo trim($options2); ?></select>
								<input type="file" name="po_file2" id="po_file2" />
							</div>
							<div class="po_composer_field">
								<textarea name="po_text2" id="po_text2"></textarea>
							</div>
						</div>
					</fieldset>
				</div>
	
				<div class="po_composer_buttons">
					<a href="#" id="po_save"><?php echo empty($this->po_src) ? esc_html__('Upload', 'morning-records') : esc_html__('Update', 'morning-records'); ?></a>
					<?php if (!empty($this->po_link) || !empty($this->mo_link)) { ?>
					<div class="po_composer_links">
						<?php if (!empty($this->po_link)) { ?>
							<a href="<?php echo esc_url($this->po_link); ?>" class="po_composer_download_link"><?php esc_html_e('Download .PO-file', 'morning-records'); ?></a>
						<?php } ?>
						<?php if (!empty($this->mo_link)) { ?>
							<a href="<?php echo esc_url($this->mo_link); ?>" class="po_composer_download_link"><?php esc_html_e('Download .MO-file', 'morning-records'); ?></a>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
	
			</form>
		</div>
		<?php
	}

	// Do actions with .po-file(s)
	function actions_handler() {
		if (!empty($this->po_src)) {
			if ( !wp_verify_nonce( morning_records_get_value_gp('nonce'), admin_url() ) ) {
				$this->error = esc_html__('Incorrect WP-nonce data! Operation canceled!', 'morning-records');
			} else {
				do {
					// Get data from new .po_file
					$rez = $this->load_po();
					if (!empty($rez['error'])) {
						$this->error = $rez['error'];
						break;
					}
					$po_text = $rez['data'];
					// Parse data
					if (($po_data = $this->parse_po($po_text))===false) {
						$this->error = esc_html__('Error parsing new .po-file!', 'morning-records');
						break;
					}
					if ($this->po_src2 != '') {
						// Get data from old .po_file
						$rez = $this->load_po('2');
						if (!empty($rez['error'])) {
							$this->error = $rez['error'];
							break;
						}
						$po_text2 = $rez['data'];
						if (($po_data2 = $this->parse_po($po_text2))===false) {
							$this->error = esc_html__('Error parsing merging .po-file!', 'morning-records');
							break;
						}
					}
					if ($this->po_src2 != '' || !empty($_POST['po_translated_down'])) {
						// Compare data
						$header = array();
						$translated = array();
						$non_translated = array();
						if (is_array($po_data) && count($po_data) > 0) {
							foreach ($po_data as $k=>$v) {
								// First element - internal data - just copy it
								if ($k==0) {
									$header[] = $v;
									continue;
								}
								// If string already exists in old po-file
								if ($this->po_src2 != '' && ($idx2 = $this->find_po($v, $po_data2))!==false) {
									$v['msgstr'] = $po_data2[$idx2]['msgstr'];
								}
								// If string not translated
								if (empty($_POST['po_translated_down']) || (count($v['msgstr'])==1 && $v['msgstr'][0]=='msgstr ""'))
									$non_translated[] = $v;
								else
									$translated[] = $v;
							}
						}
						$po_data = array_merge($header, $non_translated, $translated);
						$this->po_text = $this->generate_po($po_data);
					} else if ($this->po_src != '') {
						$this->po_text = $this->generate_po($po_data);
					} else {
						$this->po_text = stripslashes($_POST['po_text']);
					}
				} while (false);
			}
			// Save result
			if (empty($this->error)) {
				// Update temp files (always)
				$po_temp = get_template_directory() . '/core/tools/po_composer/data/temp.po';
				if (is_writeable($po_temp)) {
					morning_records_fpc($po_temp, $this->po_text);
					$this->po_link = get_template_directory_uri() . '/core/tools/po_composer/data/temp.po';
				}
				$this->mo_text = $this->generate_mo($po_data);
				$mo_temp = get_template_directory() . '/core/tools/po_composer/data/temp.mo';
				if (is_writeable($mo_temp)) {
					morning_records_fpc($mo_temp, $this->mo_text);
					$this->mo_link = get_template_directory_uri() . '/core/tools/po_composer/data/temp.mo';
				}
				// Update lang files on server
				$this->error_update = '';
				if (empty($this->po_src2) && !empty($_POST['po_text']) && substr($this->po_src, 0, 7)=='parent_' || substr($this->po_src, 0, 6)=='child_') {
					$dir  = substr($this->po_src, 0, 7)=='parent_' ? $this->tpl_dir : $this->css_dir;
					$name = substr($this->po_src, strpos($this->po_src, '_')+1);
					$po_file = trim($dir).'/'.trim($name).'.po';
					if (is_writeable($po_file)) {
						morning_records_fpc($po_file, $this->po_text);
						$this->success = wp_kses_data( sprintf(__('Language file "<b>%s.po</b>" was updated!', 'morning-records'), $name) );
						$mo_file = trim($dir).'/'.trim($name).'.mo';
						if (is_writeable($mo_file)) {
							morning_records_fpc($mo_file, $this->mo_text);
							$this->success .= '<br>' . wp_kses_data( sprintf(__('Language file "<b>%s.mo</b>" was generated!', 'morning-records'), $name) );
						}
					} else {
						$tjis->error_update = wp_kses_data( sprintf(__('Error writing in language file "<b>%s.po</b>"!<br>Please, copy text from textarea below and paste it in the .po-file manually<br>or use links to upload .po and .mo files below the text area!', 'morning-records'), $name) );
					}
				}
			} else {
				$this->po_text = stripslashes($_POST['po_text']);
				$this->po_text2 = stripslashes($_POST['po_text2']);
			}
		}
	}
	
	
	
	//==========================================================================================
	// PO manipulation
	//==========================================================================================

	// Load content of .po-file
	function load_po($suffix='') {
		$rez = array('data'=>'', 'error'=>'');
		do {
			// Upload file
			if ($_POST['po_src'.trim($suffix)] == 'upload_') {
				$rez['data'] = isset($_FILES['po_file'.($suffix)]['tmp_name']) && file_exists($_FILES['po_file'.($suffix)]['tmp_name']) ? morning_records_fga($_FILES['po_file'.($suffix)]['tmp_name']) : '';
				if (empty($rez['data'])) {
					$rez['error'] = sprintf(esc_html__('Error uploading or Empty .po-file: %s', 'morning-records'), $_FILES['po_file'.($suffix)]['tmp_name']);
					break;
				}
			// or get content from textarea
			} else if (!empty($_POST['po_text'.($suffix)])) {
				if (!empty($_POST['po_text'.($suffix)]))
					$rez['data'] = explode("\n", stripslashes($_POST['po_text'.($suffix)]));
				else {
					$rez['error'] = esc_html__('Empty textarea with .po-file content!', 'morning-records');
					break;
				}
			// or load file from 'languages' folder
			} else if (substr($_POST['po_src'.($suffix)], 0, 7)=='parent_' || substr($_POST['po_src'.($suffix)], 0, 6)=='child_') {
				$dir  = substr($_POST['po_src'.($suffix)], 0, 7)=='parent_' ? $this->tpl_dir : $this->css_dir;
				$name = morning_records_esc(substr($_POST['po_src'.($suffix)], strpos($_POST['po_src'.($suffix)], '_')+1));
				$rez['data'] = file_exists(($dir).'/'.($name).'.po') ? morning_records_fga(($dir).'/'.($name).'.po') : '';
				if (empty($rez['data'])) {
					$rez['error'] = sprintf(esc_html__('Error loading or Empty .po-file: %s', 'morning-records'), ($dir).'/'.($name).'.po');
					break;
				}
			// 'Edit' selected, but textarea is empty
			} else
				$rez['error'] = esc_html__('Empty textarea with .po-file content!', 'morning-records');
		} while (false);
		return $rez;
	}

	// Parse data from .po-file
	function parse_po($data) {
		if (!is_array($data)) return false;
		$po = array(
			array(
				'comments' => array(),
				'msgid' => array(),
				'msgstr' => array()
			)
		);
		$last = '';
		$idx = 0;
		$section = '';
		if (is_array($data) && count($data) > 0) {
			foreach ($data as $s) {
				$s = trim(chop($s));
				if (!empty($s)) {
					if ($s[0]=='#') {
						if (empty($last)) {
							$idx++;
							$po[$idx] = array(
								'comments' => array(),
								'msgid' => array(),
								'msgstr' => array()
							);
						}
						$po[$idx]['comments'][] = $s;
					} else if (substr($s, 0, 5)=='msgid') {
						$po[$idx]['msgid'][] = $s;
						$section = 'msgid';
					} else if (substr($s, 0, 6)=='msgstr') {
						$po[$idx]['msgstr'][] = $s;
						$section = 'msgstr';
					} else if ($s[0]=='"') {
						$po[$idx][$section][] = $s;
					}
				}
				$last = $s;
			}
		}
		return $po;
	}
	
	// Find data in .po-file
	function find_po($data, $po) {
		if (!is_array($data) || !is_array($po)) return false;
		$rez = false;
		if (is_array($po) && count($po) > 0) {
			foreach ($po as $idx=>$old) {
				if (count($old['msgid']) == count($data['msgid'])) {
					$find = true;
					foreach ($old['msgid'] as $i=>$v) {
						if ($data['msgid'][$i]!=$v) {
							$find = false;
							break;
						}
					}
					if ($find) {
						$rez = $idx;
						break;
					}
				}
			}
		}
		return $rez;
	}
	
	// Generate .po-file from data
	function generate_po($data) {
		$rez = '';
		if (is_array($data) && count($data) > 0) {
			foreach ($data as $po) {
				if (is_array($po['comments']) && count($po['comments']) > 0) {
					foreach ($po['comments'] as $s)
						$rez .= $s . "\n";
				}
				if (is_array($po['msgid']) && count($po['msgid']) > 0) {
					foreach ($po['msgid'] as $s)
						$rez .= $s . "\n";
				}
				if (is_array($po['msgstr']) && count($po['msgstr']) > 0) {
					foreach ($po['msgstr'] as $s)
						$rez .= $s . "\n";
				}
				$rez .= "\n";
			}
		}
		return $rez;
	}
	
	// Generate .mo-file from data
	function generate_mo($data) {
		$mo_data = $this->collect_translated_strings($data);
		uasort($mo_data['data'], array($this, "compare_mo"));
		$cnt = count($mo_data['data']);
		// Prepare header
		$rez =    pack('L', 0x950412de)						// (4 bytes) Magic Number
				. pack('L', 0)								// (4 bytes) Major and minor revision
				. pack('L', $cnt)							// (4 bytes) Number of translated strings
				. pack('L', 28)								// (4 bytes) Offset of table with original strings
				. pack('L', 28+$cnt*8)						// (4 bytes) Offset of table with translation strings
				. pack('L', $cnt)							// (4 bytes) Size of hashing table
				. pack('L', 28+$cnt*8+$cnt*8)				// (4 bytes) Offset of hashing table
				;
		// Prepare data
		$offset_orig  = 28+$cnt*8+$cnt*8+$cnt*4;
		$offset_trans = $offset_orig + $mo_data['orig_size'];
		$tbl_hash = $tbl_orig = $tbl_trans = $list_orig = $list_trans = '';
		$i = 0;
		if (is_array($mo_data['data']) && count($mo_data['data']) > 0) {
			foreach ($mo_data['data'] as $mo) {
				$tbl_hash   .= pack('L', $i++);												// (4 bytes) Hash index in strings array
				$tbl_orig   .= pack('L', $mo['msgid_size']) . pack('L', $offset_orig);		// (8 bytes) Length & offset current original string
				$tbl_trans  .= pack('L', $mo['msgstr_size']) . pack('L', $offset_trans);	// (8 bytes) Length & offset current translation string
				$list_orig  .= $mo['msgid'] . pack('C', 0);									// NUL terminated original string
				$list_trans .= $mo['msgstr'] . pack('C', 0);								// NUL terminated original string
				$offset_orig  += $mo['msgid_size']+1;
				$offset_trans += $mo['msgstr_size']+1;
			}
		}
		return $rez . $tbl_orig . $tbl_trans . $tbl_hash . $list_orig . $list_trans;
	}
	
	// Compare two .mo-data for sortings
	function compare_mo($data1, $data2) {
		return strcmp($data1['msgid'], $data2['msgid']);
	}

	// Collect from .po-data only translated strings (and convert it in standard string format)
	function collect_translated_strings($data) {
		$rez = array();
		$orig_size = $trans_size = 0;
		if (is_array($data) && count($data) > 0) {
			foreach ($data as $k=>$v) {
				if ((count($v['msgstr'])>1 || $v['msgstr'][0]!='msgstr ""')) {// && (count($v['msgid'])>1 || $v['msgid'][0]!='msgid ""')) {
					$v['msgid'] = $this->get_string($v['msgid']);
					$msgid_size = strlen($v['msgid']);
					$v['msgstr'] = $this->get_string($v['msgstr']);
					$msgstr_size = strlen($v['msgstr']);
					$rez[] = array_merge($v, array(
						"msgid_size" => $msgid_size,
						"msgstr_size" => $msgstr_size
					));
					$orig_size += $msgid_size+1;
					$trans_size += $msgstr_size+1;
				}
			}
		}
		return array("data"=>$rez, "orig_size"=>$orig_size, "trans_size"=>$trans_size);
	}
	
	// Generate .mo-file from data
	function get_string($data) {
		$rez = '';
		for ($i=0; $i<count($data); $i++) {
			$start = mb_strpos($data[$i], '"');
			$end = mb_strrpos($data[$i], '"');
			if ($start!==false && $end!==false && $start<$end) {
				$rez .= str_replace(array('\\n', '\\t', '\\"', '\\\\'), array("\n", "\t", '"', '\\'), mb_substr($data[$i], $start+1, $end-$start-1));
			}
		}
		return $rez;
	}
	
	
	//==========================================================================================
	// Utilities
	//==========================================================================================

	// Return list files in folder
	function get_list_files($dir, $ext) {
		$list = array();
		if ( is_dir($dir) ) {
			$hdir = @opendir( $dir );
			if ( $hdir ) {
				while (($file = readdir( $hdir ) ) !== false ) {
					$pi = pathinfo( trim($dir) . '/' . trim($file) );
					if ( substr($file, 0, 1) == '.' || is_dir( trim($dir) . '/' . trim($file) ) || (!empty($ext) && $pi['extension'] != $ext) )
						continue;
					$key = substr($file, 0, strrpos($file, '.'));
					$list[] = $key;
				}
				@closedir( $hdir );
			}
		}
		return $list;
	}

	// Return options from list files
	function get_list_options($list, $prefix, $selected) {
		$opt = '';
		if (is_array($list) && count($list) > 0) {
			foreach ($list as $key) {
				$opt .= "\n" . '<option value="'.esc_attr($prefix.$key).'"'.($prefix.$key==$selected ? ' selected="selected"' : '').'>'.esc_attr(($this->is_child ? $prefix : '').$key).'</option>';
			}
		}
		return $opt;
	}
}
?>