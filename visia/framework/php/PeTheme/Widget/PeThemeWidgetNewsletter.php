<?php

class PeThemeWidgetNewsletter extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Newsletter",'Pixelentity Theme/Plugin');
		$this->description = __("Newsletter subscribe form",'Pixelentity Theme/Plugin');
		$this->wclass = "widget_newsletter";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("Widget title",'Pixelentity Theme/Plugin'),
									"default"=>"Newsletter"
									),
							  "subscribe" => 
							  array(
									"label"=>__("Subscribe Address",'Pixelentity Theme/Plugin'),
									"type"=>"Text",
									"description" => __("The email address to which subscribers details are sent.",'Pixelentity Theme/Plugin'),
									"default"=>"newsletter@yourdomain.com"
									),
							  "top" => 
							  array(
									"label"=>__("Intro Text",'Pixelentity Theme/Plugin'),
									"type"=>"TextArea",
									"description" => __("Text content located before the subscribe field",'Pixelentity Theme/Plugin'),
									"default"=>"Lorem ipsum dolor sit amet, consec tetue adipiscing elit. Donec odio. Quis que vol utpat mattis eros. Nullam mal."
									),
							  "bottom" => 
							  array(
									"label"=>__("Outro Text",'Pixelentity Theme/Plugin'),
									"type"=>"TextArea",
									"description" => __("Text content located after the subscribe field",'Pixelentity Theme/Plugin'),
									"default"=>"Don't worry, your details are safe with us. For more info. read our <a href=\"#\">privacy policy</a>"
									)
							  
							  );

		parent::__construct();
	}

	public function widget($args,$instance) {
		$wid = $args["widget_id"];
		$instance = $this->clean($instance);
		extract($instance);

		$html = "";
		if (isset($title)) $html .= "<h3>$title</h3>";
		if (isset($top)) $html .= "<p>$top</p>";

		$html .= <<<EOL
<form class="form-inline newsletter" id="newsletterform" method="get" data-subscribed="Thank You" data-instance="$wid">
    <div class="control-group">
        <div class="input-append">
            <input type="text" name="email" class="input-medium span2"  placeholder="Newsletter.."/>
            <button class="btn" type="submit">Signup</button>
        </div>
    </div>
</form>
EOL;

		if (isset($bottom)) $html .= "<p class=\"outro\">$bottom</p>";
		
		echo $args["before_widget"];
		echo $html;
		echo $args["after_widget"];
	}


}
?>
