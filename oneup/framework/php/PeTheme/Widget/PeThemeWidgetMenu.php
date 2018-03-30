<?php

class PeThemeWidgetMenu extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Menu",'Pixelentity Theme/Plugin');
		$this->description = __("Show a menu",'Pixelentity Theme/Plugin');
		$this->wclass = "widget_menu";

		$menus = get_terms("nav_menu",array("hide_empty" => false));

		if ($menus) {
			foreach ( $menus as $menu ) {
				$options[$menu->name] = $menu->term_id;
			}
			$description = __("Select a menu",'Pixelentity Theme/Plugin');
		} else {
			$options[__("No menus have been created yet",'Pixelentity Theme/Plugin')] = -1;
			$description = sprintf(__('<a href="%s">Create a menu</a>','Pixelentity Theme/Plugin'),admin_url('nav-menus.php'));
		}

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("Widget title",'Pixelentity Theme/Plugin'),
									"default"=>"Menu widget"
									),
							  "id" =>
							  array(
									"label" => __("Menu",'Pixelentity Theme/Plugin'),
									"type" => "Select",
									"description" => $description,
									"options" => $options
									)
							  );

		parent::__construct();
	}


	public function widget($args,$instance) {
		$instance = $this->clean($instance);
		extract($instance);

		if (!@$id) return;		
		echo $args["before_widget"];
		if (isset($title)) echo "<h3>$title</h3>";
		echo '<div class="well">';
		peTheme()->menu->showID($id,"sidebar");
		echo "</div>";
		echo $args["after_widget"];
	}


}
?>
