<?php

class dashboardPages {
	var $options;
	var $pageoptions;
	
	function dashboardPages($options, $pageoptions) {
		$this->options = $options;
		$this->pageoptions = $pageoptions;
		
		global $level;
		
		if ($level) { $level++; } else { $level = 1; }
		
		add_action('admin_menu', array(&$this, 'add_admin_menu'), $level);
	}
	
	function add_admin_menu() {		
		$optionFile = $this->pageoptions['file'];
		
		if (isset($_GET['page']))  {
			
			if ( $_GET['page'] ==  $optionFile) {
			 
				if ( 'save' == $_REQUEST['action'] ) {
			 
					foreach ($this->options as $value) {
						update_option( $value['id'], $_REQUEST[ $value['id'] ] );
					}
			 
					header("Location: admin.php?page=" . $optionFile . "&saved=true");
					die;
			 
				}
			}
		
		}
		
		$tb_menu_icon = get_option('tb_menu_icon');
		if (!$tb_menu_icon) {$tb_menu_icon = DEFAULT_MENU_ICON;}

		if ($this->pageoptions['child']) {
			add_submenu_page(THEME_OPTIONS_PAGE, $this->pageoptions['name'], $this->pageoptions['name'], 'administrator', $optionFile, array(&$this, 'tb_admin_page'));
		} else {
			add_menu_page($this->pageoptions['name'], $this->pageoptions['name'], 'administrator', $optionFile, array(&$this, 'tb_admin_page'), $tb_menu_icon);
			define('THEME_OPTIONS_PAGE', $optionFile);
		}
	}
	
	function tb_admin_page() {
		
		if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>Settings saved.</strong></p></div>';
		
		$this->displayOptionsPage();
		
	}
	
	function displayOptionsPage() {
		display($this->options);
	}
}

?>