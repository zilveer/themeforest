<?php

class PeThemeWidgetTwitter extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Twitter",'Pixelentity Theme/Plugin');
		$this->description = __("Displays the latest tweets",'Pixelentity Theme/Plugin');
		$this->wclass = "widget_twitter";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("Widget title",'Pixelentity Theme/Plugin'),
									"default"=>"Twitter"
									),
							  "username" => 
							  array(
									"label"=>__("Username",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("Twitter username from which to load tweets",'Pixelentity Theme/Plugin'),
									"default"=>"envato"
									),
							  "count" => 
							  array(
									"label"=>__("Number Of Tweets",'Pixelentity Theme/Plugin'),
									"type"=>"RadioUI",
									"description" => __("Select the number of tweets to be displayed",'Pixelentity Theme/Plugin'),
									"single" => true,
									"options" => range(1,10),
									"default"=>2
									),
							  
							  );

		parent::__construct();
	}

	public function getContent(&$instance) {
		extract($instance);
		$html = <<<EOL
<h3>$title <a class="followBtn" href="https://twitter.com/#!/$username"><span class="label">follow</span></a></h3>
<div class="twitter" data-topdate="false" data-count="$count" data-username="$username"></div>
EOL;


		return $html;
	}


}
?>
