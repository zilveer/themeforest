<?php
/*
  Plugin Name: Sidebar Generator
  Plugin URI: http://www.getson.info
  Description: This plugin generates as many sidebars as you need. Then allows you to place them on any page you wish. Version 1.1 now supports themes with multiple sidebars.
  Version: 1.1.0
  Author: Kyle Getson
  Author URI: http://www.kylegetson.com
  Copyright (C) 2009 Kyle Robert Getson
 */

/*
  Copyright (C) 2009 Kyle Robert Getson, kylegetson.com and getson.info

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class sidebar_generator {

	function sidebar_generator() {
		add_action('init', array('sidebar_generator', 'init'));
		add_action('admin_menu', array('sidebar_generator', 'admin_menu'));
		add_action('admin_enqueue_scripts', array('sidebar_generator', 'print_admin_scripts'));
		add_action('wp_ajax_add_sidebar', array('sidebar_generator', 'add_sidebar'));
		add_action('wp_ajax_remove_sidebar', array('sidebar_generator', 'remove_sidebar'));

		//edit posts/pages
		add_action('edit_form_advanced', array('sidebar_generator', 'edit_form'));
		add_action('edit_page_form', array('sidebar_generator', 'edit_form'));

		//save posts/pages
		add_action('edit_post', array('sidebar_generator', 'save_form'));
		add_action('publish_post', array('sidebar_generator', 'save_form'));
		add_action('save_post', array('sidebar_generator', 'save_form'));
		add_action('edit_page_form', array('sidebar_generator', 'save_form'));
	}

	static function init() {

		// Go through each sidebar and register it
		$sidebars = sidebar_generator::get_sidebars();


		if (is_array($sidebars)) {
			foreach ($sidebars as $sidebar) {
				$sidebar_class = sidebar_generator::name_to_class($sidebar['name']);

				// Sidebar type = 'normal'
				if ($sidebar['type'] == 'normal' || $sidebar['type'] == 'normal_gray' || $sidebar['type'] == 'normal_blue') {
					register_sidebar(array(
						'name' => $sidebar['name'],
						'id' => $sidebar_class,
						'class' => $sidebar_class,
						'description' => ucwords($sidebar['type']),
						'before_widget' => '<div class="widget">',
						'after_widget' => '<div class="clearfix"></div></div>',
						'before_title' => '<h4>',
						'after_title' => '</h4>',
					));

					// ..else Sidebar type = 'tabbed'
				} elseif ($sidebar['type'] == 'tabbed') {
					register_sidebar(array(
						'name' => $sidebar['name'],
						'class' => $sidebar_class,
						'description' => ucwords($sidebar['type']),
						'before_widget' => '<div id="tab-%1$s" class="%2$s tab-content widget" style="display: none;">',
						'after_widget' => '</div>',
						'before_title' => '<h4 style="display: none;">',
						'after_title' => '</h4>',
					));
				}
			}
		}
	}

	static function print_admin_scripts() {
		wp_print_scripts(array('sack'));
		?>
		<script type="text/javascript">
			function add_sidebar( sidebar_name, sidebar_type ) {
				if (sidebar_name != null && sidebar_name != '' && sidebar_type != null && sidebar_type != '') {
					jQuery.ajax({
						type: "POST",
						url: "<?php echo site_url(); ?>/wp-admin/admin-ajax.php",
						data: { action: "add_sidebar", sidebar_name: sidebar_name, sidebar_type: sidebar_type }
					}).done(function( msg ) {
						location.reload();
					});
					
					return true;
				} else {
					alert('Please enter Sidebar Name');

					return false;
				}
			}

			function remove_sidebar( sidebar_name, num, sidebar_type ) {
				jQuery.ajax({
						type: "POST",
						url: "<?php echo site_url(); ?>/wp-admin/admin-ajax.php",
						data: { action: "remove_sidebar", sidebar_name: sidebar_name, row_number: num }
					}).done(function( msg ) {
						location.reload();
					});

				return true;
			}
		</script>
		<?php
	}

	function add_sidebar() {
		$sidebars = sidebar_generator::get_sidebars();
		$name = str_replace(array("\n", "\r", "\t"), '', $_POST['sidebar_name']);
		$type = str_replace(array("\n", "\r", "\t"), '', $_POST['sidebar_type']);
		$id = sidebar_generator::name_to_class($name);
		if (isset($sidebars[$id])) {
			die("alert('Sidebar already exists, please use a different name.')");
		}

		$sidebars[$id]['name'] = $name;
		$sidebars[$id]['type'] = $type;
		sidebar_generator::update_sidebars($sidebars);

		$js = "
			var tbl = document.getElementById('sbg_table');
			var lastRow = tbl.rows.length;
			// if there's no header row in the table, then iteration = lastRow + 1
			var iteration = lastRow;
			var row = tbl.insertRow(lastRow);

			// left cell
			var cellLeft = row.insertCell(0);
			var textNode = document.createTextNode('$name');
			cellLeft.appendChild(textNode);

			//middle cell
			var cellLeft = row.insertCell(1);
			var textNode = document.createTextNode('$type');
			cellLeft.appendChild(textNode);

			//middle cell
			var cellLeft = row.insertCell(2);
			var textNode = document.createTextNode('$id');
			cellLeft.appendChild(textNode);

			//var cellLeft = row.insertCell(3);
			//var textNode = document.createTextNode('[<a href=\'javascript:void(0);\' onclick=\'return remove_sidebar_link($name);\'>Remove</a>]');
			//cellLeft.appendChild(textNode)

			var cellLeft = row.insertCell(3);
			removeLink = document.createElement('a');
      		linkText = document.createTextNode('remove');
			removeLink.setAttribute('onclick', 'remove_sidebar_link(\'$name\')');
			removeLink.setAttribute('href', 'javacript:void(0)');

      		removeLink.appendChild(linkText);
      		cellLeft.appendChild(removeLink);


		";


		die("$js");
	}

	function remove_sidebar() {
		$sidebars = sidebar_generator::get_sidebars();
		$name = str_replace(array("\n", "\r", "\t"), '', $_POST['sidebar_name']);
		$id = sidebar_generator::name_to_class($name);
		if (!isset($sidebars[$id])) {
			die("alert('Sidebar does not exist.')");
		}
		$row_number = $_POST['row_number'];
		unset($sidebars[$id]);
		sidebar_generator::update_sidebars($sidebars);
		$js = "
			var tbl = document.getElementById('sbg_table');
			tbl.deleteRow($row_number)

		";
		die($js);
	}

	static function admin_menu() {
		add_theme_page('Manage Sidebars', 'Manage Sidebars', 'manage_options', 'multiple_sidebars', array('sidebar_generator', 'admin_page'));
	}

	static function admin_page() {
		?>
		<script>
			function remove_sidebar_link(name,num){
				answer = confirm("Are you sure you want to remove " + name + "?\nThis will remove any widgets you have assigned to this sidebar.");
				if(answer){
					remove_sidebar(name,num);
				}else{
					return false;
				}
			}
			function add_sidebar_link() {
				jQuery('#sbg_table tr:last').after('<tr><td><b>Sidebar Name:</b><br /><input type="text" name="sidebar_name" id="sidebar_name" /></td><td><b>Sidebar Type:</b><br /><select name="sidebar_type" id="sidebar_type"><option value="normal">Normal</option></select></td><td></td><td style="vertical-align: middle;"><a href="javascript:void(0);" onclick="add_sidebar(jQuery(\'#sidebar_name\').val(), jQuery(\'#sidebar_type\').val());" title="Remove this sidebar">save</a></td></tr>');
			}
		</script>
		<div class="wrap">
			<h2>Manage Sidebars</h2>
			<br />
			<table class="widefat page" id="sbg_table" style="width:600px;">
				<tr>
					<th>Sidebar Name</th>
					<th>Sidebar Type</th>
					<th>CSS class</th>
					<th>Remove</th>
				</tr>
				<?php
				$sidebars = sidebar_generator::get_sidebars();
				if (is_array($sidebars) && !empty($sidebars)) {
					$cnt = 0;
					foreach ($sidebars as $sidebar) {
						$alt = ($cnt % 2 == 0 ? 'alternate' : '');
						?>
						<tr class="<?php echo $alt ?>">
							<td><?php echo $sidebar['name']; ?></td>
							<td><?php echo $sidebar['type']; ?></td>
							<td><?php echo sidebar_generator::name_to_class($sidebar['name']); ?></td>
							<td><a href="javascript:void(0);" onclick="return remove_sidebar_link('<?php echo $sidebar['name']; ?>',<?php echo $cnt + 1; ?>);" title="Remove this sidebar">remove</a></td>
						</tr>
						<?php
						$cnt++;
					}
				} else {
					?>
					<tr>
						<td colspan="4">No Sidebars defined</td>
					</tr>
					<?php
				}
				?>
			</table><br /><br />
			<div class="add_sidebar">
				<a href="javascript:void(0);" onclick="return add_sidebar_link()" title="Add a sidebar" class="button-primary">+ Add New Sidebar</a>
			</div>
		</div>
		<?php
	}

	/**
	 * for saving the pages/post
	 */
	static function save_form($post_id) {
		if ( isset($_POST['sbg_edit']) )
			$is_saving = $_POST['sbg_edit'];

		if (!empty($is_saving)) {
			delete_post_meta($post_id, 'sbg_selected_sidebar');
			delete_post_meta($post_id, 'sbg_selected_sidebar_replacement');
			add_post_meta($post_id, 'sbg_selected_sidebar', $_POST['sidebar_generator']);
			add_post_meta($post_id, 'sbg_selected_sidebar_replacement', $_POST['sidebar_generator_replacement']);
		}
	}

	static function edit_form() {
		global $post;
		$post_id = $post;
		if (is_object($post_id)) {
			$post_id = $post_id->ID;
		}
		$selected_sidebar = get_post_meta($post_id, 'sbg_selected_sidebar', true);
		if (!is_array($selected_sidebar)) {
			$tmp = $selected_sidebar;
			$selected_sidebar = array();
			$selected_sidebar[0] = $tmp;
		}
		$selected_sidebar_replacement = get_post_meta($post_id, 'sbg_selected_sidebar_replacement', true);
		if (!is_array($selected_sidebar_replacement)) {
			$tmp = $selected_sidebar_replacement;
			$selected_sidebar_replacement = array();
			$selected_sidebar_replacement[0] = $tmp;
		}
		?>

		<div id='sbg-sortables' class='meta-box-sortables'>
			<div id="sbg_box" class="postbox " >
				<div class="handlediv" title="Click to toggle"><br /></div><h3 class='hndle'><span>Sidebars</span></h3>
				<div class="inside">
					<div class="sbg_container">
						<input name="sbg_edit" type="hidden" value="sbg_edit" />

						<p>Please select the sidebar you would like to display on this page. <strong>Note:</strong> You must first create the sidebar under Appearance > Manage Sidebars.
						</p>
						<ul>
							<?php
							global $wp_registered_sidebars;
							for ($i = 0; $i < 5; $i++) {
								?>
								<li>
									<select name="sidebar_generator[<?php echo $i ?>]" style="display: none;">
										<option value="0"<?php
					if ($selected_sidebar[$i] == '') {
						echo " selected";
					}
								?>>WP Default Sidebar</option>
												<?php
												$sidebars = $wp_registered_sidebars; // sidebar_generator::get_sidebars();
												if (is_array($sidebars) && !empty($sidebars)) {
													foreach ($sidebars as $sidebar) {
														if ($selected_sidebar[$i] == $sidebar['name']) {
															echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
														} else {
															echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
														}
													}
												}
												?>
									</select>
									<select name="sidebar_generator_replacement[<?php echo $i ?>]">
										<option value="0"<?php
									if ( isset($selected_sidebar_replacement[$i]) && $selected_sidebar_replacement[$i] == '') {
										echo " selected";
									}
												?>>None</option>
												<?php
												$sidebar_replacements = $wp_registered_sidebars; //sidebar_generator::get_sidebars();
												if (is_array($sidebar_replacements) && !empty($sidebar_replacements)) {
													foreach ($sidebar_replacements as $sidebar) {
														if ($selected_sidebar_replacement[$i] == $sidebar['name']) {
															echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
														} else {
															echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
														}
													}
												}
												?>
									</select>

								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<?php
	}

	/**
	 * called by the action get_sidebar. this is what places this into the theme
	 */
	static function get_sidebar($name = "0") {
		global $wp_registered_sidebars, $wp_registered_widgets;

		if (!is_singular()) {
			if ($name != "0") {
				dynamic_sidebar($name);
			} else {
				dynamic_sidebar();
			}
			return; //dont do anything
		}
		global $wp_query;
		$post = $wp_query->get_queried_object();
		$selected_sidebar = get_post_meta($post->ID, 'sbg_selected_sidebar');
		$selected_sidebar_replacement = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement');
		$did_sidebar = false;

		//this page uses a generated sidebar
		if ($selected_sidebar != '' && $selected_sidebar != "0") {
			echo "\n\n<!-- begin generated sidebar -->\n";
			if (is_array($selected_sidebar) && !empty($selected_sidebar)) {

				for ($i = 0; $i < sizeof($selected_sidebar_replacement[0]); $i++) {

					if ($selected_sidebar_replacement[0][$i] == '0')
						continue;

					$index = $selected_sidebar_replacement[0][$i];
					if (is_int($index)) {
						$index = "sidebar-$index";
					} else {
						$index = sanitize_title($index);
						$description = '';
						foreach ((array) $wp_registered_sidebars as $key => $value) {
							if (sanitize_title($value['name']) == $index) {
								$index = $key;
								$description = strtolower($value['description']);
								break;
							}
						}
					}

					$sidebars_widgets = wp_get_sidebars_widgets();

					if (!empty($sidebars_widgets[$index]))
						echo '
						<div class="tabs ' . $description . '">';

					if (!empty($sidebars_widgets[$index]) && $description == 'tabbed') {
						echo '
							<ul class="tabs-ul">';
						foreach ((array) $sidebars_widgets[$index] as $id) {

							// Tab Title
							$option_val = get_option($wp_registered_widgets[$id]['callback'][0]->option_name);
							if (!empty($option_val[$wp_registered_widgets[$id]['params'][0]['number']]['title'])) {
								echo '<li><a href="#tab-' . $wp_registered_widgets[$id]['id'] . '">' . $option_val[$wp_registered_widgets[$id]['params'][0]['number']]['title'] . '</a></li>';
							} else if (!empty($wp_registered_widgets[$id]['name'])) {
								echo '<li><a href="#tab-' . $wp_registered_widgets[$id]['id'] . '">' . $wp_registered_widgets[$id]['name'] . '</a></li>';
							}
						}
						echo '
							</ul>';
					}

					if (!empty($sidebars_widgets[$index])) {
						echo '
							<div class="row-fluid">';
						dynamic_sidebar($selected_sidebar_replacement[0][$i]); //default behavior
						echo '</div>
						</div><!--end of tabs-->
						<script type="text/javascript">
							/*jQuery(".tabs-ul").idTabs();*/
						</script>';
						$did_sidebar = true;
					}
				}
			}
			if ($did_sidebar == true) {
				echo "\n<!-- end generated sidebar -->\n\n";
				return;
			}
			echo "\n<!-- end generated sidebar -->\n\n";
			return;
		}
	}

	/**
	 * replaces array of sidebar names
	 */
	function update_sidebars($sidebar_array) {
		$sidebars = update_option('sbg_sidebars', $sidebar_array);
	}

	/**
	 * gets the generated sidebars
	 */
	static function get_sidebars() {
		$sidebars = get_option('sbg_sidebars');
		return $sidebars;
	}

	static function name_to_class($name) {
		$class = str_replace(array(' ', ',', '.', '"', "'", '/', "\\", '+', '=', ')', '(', '*', '&', '^', '%', '$', '#', '@', '!', '~', '`', '<', '>', '?', '[', ']', '{', '}', '|', ':',), '', $name);
		return $class;
	}

}

$sbg = new sidebar_generator;

function generated_dynamic_sidebar($name = '0') {
	sidebar_generator::get_sidebar($name);
	return true;
}

// Register our footer sidebars and widgetized areas.
function ch_widgets_init() {

	register_sidebar(array(
		'name' => __('Slider Revolution Position', 'vh'),
		'id' => 'slider-position',
		'description' => __('', 'vh'),
		'before_widget' => '<div id="%1$s slider" class="rev-slider-wrapper %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => __('Footer Area One', 'ch'),
		'id' => 'sidebar-1',
		'description' => __('', 'ch'),
		'before_widget' => '<div id="%1$s" class="widget %2$s row-fluid">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => __('Footer Area Two', 'ch'),
		'id' => 'sidebar-2',
		'description' => __('', 'ch'),
		'before_widget' => '<div id="%1$s" class="widget %2$s row-fluid">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => __('Footer Area Three', 'ch'),
		'id' => 'sidebar-3',
		'description' => __('', 'ch'),
		'before_widget' => '<div id="%1$s" class="widget %2$s row-fluid">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => __('Footer Area Four', 'ch'),
		'id' => 'sidebar-4',
		'description' => __('', 'ch'),
		'before_widget' => '<div id="%1$s" class="widget %2$s row-fluid">',
		'after_widget' => '<div class="clearfix"></div></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
}
add_action('widgets_init', 'ch_widgets_init');

function change_title ($params) {
	global $ch_is_footer;

	if ($params[0]['before_title'] == "<h4>" && !$ch_is_footer) {
		$params[0]['before_title'] = '<div class="item-title-bg"><h4>';
		$params[0]['after_title'] = '</h4></div>';
	}

	return $params;
}
add_filter('dynamic_sidebar_params', 'change_title');