<?php

// Function to validate and fix any HTML tag issue
if( ! function_exists('uxbarn_get_html_validated_content')) {
	function uxbarn_get_html_validated_content($content) {
		// Below is to fix any strange invalid HTML issues (missing opening or closing tags) 
		// which caused by shortcode + wpautop or from user error 
		$dom = new MyDOMDocument(); 
		$dom->validateOnParse = false;
		$dom->preserveWhiteSpace = false;
		
		// Suppress the warning messages of invalid HTML since they are properly fixed, no need to display
		libxml_use_internal_errors(true);
		
		// UTF-8 Fix
		$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8"); 
		$dom->loadHTML('<div id="dummy-wrapper">' . $content . '</div>');
		
		// Reset suppressing back to normal state 
		libxml_clear_errors();
		
		//echo var_dump($dom->getElementById('dummy-wrapper')) . '<br><br>';
		
		return uxbarn_DOMinnerHTML($dom->getElementById('dummy-wrapper'));
	}
}

if( ! function_exists('uxbarn_DOMinnerHTML')) {
	function uxbarn_DOMinnerHTML($node) {
		$doc = new DOMDocument();
		if(isset($node->childNodes)) {
			foreach ($node->childNodes as $child) {
				$doc->appendChild($doc->importNode($child, true));
			}
			return $doc->saveHTML();
		} 
		return 'N/A';
	} 
}

// This extending class is for solving a problem when "getElementById()" returns NULL
class MyDOMDocument extends DOMDocument {

    function getElementById($id) {

        //thanks to: http://www.php.net/manual/en/domdocument.getelementbyid.php#96500
        $xpath = new DOMXPath($this);
        return $xpath->query("//*[@id='$id']")->item(0);
    }

    function output() {

        // thanks to: http://www.php.net/manual/en/domdocument.savehtml.php#85165
        $output = preg_replace('/^<!DOCTYPE.+?>/', '',
                str_replace( array('<html>', '</html>', '<body>', '</body>'),
                        array('', '', '', ''), $this->saveHTML()));

        return trim($output);

    }

}