<?php

if (!class_exists('mdst_custom_sidebar')) {

	class mdst_custom_sidebar {
	
		var $sidebars  = array();
		var $stored    = "";

		function __construct() {
			$this->stored = 'mdst_sidebars';
			$this->title = __('Custom Widget Area', 'BERG');

			add_action('load-widgets.php', array(&$this, 'load_assets') , 5);
			$this->register_custom_sidebars();
			add_action('wp_ajax_mdst_ajax_delete_custom_sidebar', array(&$this, 'delete_sidebar_area'), 1000);
		}

		function load_assets() {
			add_action('admin_print_scripts', array(&$this, 'template_add_widget_field'));
			add_action('load-widgets.php', array(&$this, 'add_sidebar_area'), 100);
			
			wp_enqueue_script('mdst_sidebar' , THEME_DIR_URI . '/admin/admin.js');
		}

		function template_add_widget_field() {
			$nonce =  wp_create_nonce('mdst-delete-sidebar');
			$nonce = '<input type="hidden" name="mdst-delete-sidebar" value="' . $nonce . '" />';

			echo "\n<script type='text/html' id='mdst-add-widget'>\n";
			echo "	<form class='mdst-add-widget' method='POST'>\n";
			echo "		<h3>" . $this->title . "</h3>\n";
			echo "		<span class='input_wrap'><input type='text' value='' placeholder = '" . __('Enter Name of the new Widget Area', 'BERG') . "' name='mdst-add-widget' /></span>\n";
			echo "		<input class='button' type='submit' value='" . __('Add Widget Area', 'BERG') . "' />\n";
			echo "		" . $nonce . "\n";
			echo "		</form>\n";
			echo "</script>\n";
		}

		function add_sidebar_area() {
			if (!empty($_POST['mdst-add-widget']) && ($_POST['mdst-add-widget'] != '') && ($_POST['mdst-add-widget'] != ' ')) {
				$this->sidebars = get_option($this->stored);
				$name = $this->get_name($_POST['mdst-add-widget']);

				if (empty($this->sidebars)) {
					$this->sidebars = array($name);
				} else {
					$this->sidebars = array_merge($this->sidebars, array($name));
				}

				update_option($this->stored, $this->sidebars);
				wp_redirect(admin_url('widgets.php'));

				die();
			}
		}

		function delete_sidebar_area() {
			check_ajax_referer('mdst-delete-sidebar');

			if (!empty($_POST['name'])) {
				$name = stripslashes($_POST['name']);
				$this->sidebars = get_option($this->stored);

				if (($key = array_search($name, $this->sidebars)) !== false) {
					unset($this->sidebars[$key]);
					update_option($this->stored, $this->sidebars);
					echo "sidebar-deleted";
				}
			}

			die();
		}

		function get_name($name) {
			if (empty($GLOBALS['wp_registered_sidebars'])) return $name;

			$taken = array();

			foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
				$taken[] = $sidebar['name'];
			}

			if (empty($this->sidebars)) {
				$this->sidebars = array();
			}

			$taken = array_merge($taken, $this->sidebars);

			if (in_array($name, $taken)) {
				$counter  = substr($name, -1);
				$new_name = "";

				if (!is_numeric($counter)) {
					$new_name = $name . " 1";
				} else {
					$new_name = substr($name, 0, -1) . ((int) $counter + 1);
				}

				$name = $this->get_name($new_name);
			}

			return $name;
		}

		function register_custom_sidebars() {

			if (empty($this->sidebars)) {
				$this->sidebars = get_option($this->stored);
			}

			$args = array(
				'before_widget' => '<div class="widget %2$s widget-wrapper">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="custom_sidebar_title">',
				'after_title'   => '</h4>'
			);

			$args = apply_filters('mdst_custom_widget_args', $args);

			if (is_array($this->sidebars)) {
				foreach ($this->sidebars as $sidebar) {
					$args['name']  = $sidebar;
					$args['id']  = $sidebar;
					$args['class'] = 'mdst-custom';
					register_sidebar($args);
				}
			}
		}
	}
}