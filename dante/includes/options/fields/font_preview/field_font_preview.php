<?php
class Redux_Options_font_preview {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    function __construct($field = array(), $value ='', $parent) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
        $class = (isset($this->field['class'])) ? ' ' . $this->field['class'] . '' : '';
        echo '</td></tr></table>';
        echo '<div id="typography-preview">';
        echo '<h3>Typography Preview</h3>';
    	echo '<h6 class="typog-title">Body</h6>';
    	echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In hendrerit neque nec elit euismod, sit amet tincidunt eros tincidunt. Etiam a imperdiet nunc, non aliquet odio. Praesent in arcu et mauris bibendum lobortis. Nam ut lobortis ante, tincidunt tincidunt nunc. Ut dignissim lectus ante, sit amet congue diam cursus ac. Suspendisse ultricies ipsum sapien, nec elementum magna hendrerit et. Nunc fringilla tempor dolor, sit amet commodo ipsum laoreet nec.</p>';
    	echo '<h6 class="typog-title">Headings</h6>';
    	echo '<h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h1>';
    	echo '<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>';
    	echo '<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>';
    	echo '<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>';
    	echo '<h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h5>';
    	echo '<h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h6>';
    	echo '</div>';
    	echo '<table class="form-table no-border"><tbody><tr><th></th><td>';
    }
}
