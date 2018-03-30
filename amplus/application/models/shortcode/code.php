<?php


/* supported code languages (the 'lang' attribute):
 * 
actionscript3 as3
bash shell
cpp c
c# c-sharp csharp
css
java
js jscript javascript
perl pl
php
text plain
py python
ruby rails ror rb
sql
vb vbnet
xml xhtml html
 */
 
class BFIShortcodeCodeModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'code'; 
    
    public $lang = 'html';
	public $theme = 'Default';
    
    public function render($content = NULL, $unusedAttributeString = '') {
		// load the color theme
		bfi_wp_enqueue_style('syntaxhighlighter', "//cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/styles/shCore{$this->theme}.css");
            
        // load script
        bfi_wp_enqueue_script('shcore', '//cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/scripts/shCore.js', array('bfi'), NULL, true);
        
        // brushes
		$this->lang = strtolower($this->lang);
		$brushes = array(
			'as3' => 'AS3',
			'bash' => 'Bash',
			'cpp' => 'Cpp',
			'c' => 'Cpp',
			'c#' => 'CSharp',
			'css' => 'Css',
			'java' => 'Java',
			'js' => 'JScript',
			'javascript' => 'JScript',
			'perl' => 'Perl',
			'php' => 'Php',
			'text' => 'Plain',
			'plain' => 'Plain',
			'python' => 'Python',
			'ruby' => 'Ruby',
			'sql' => 'Sql',
			'vb' => 'Vb',
			'xml' => 'Xml',
			'xhtml' => 'Xml',
			'html' => 'Xml'
		);
				
        // load the correct brush
		bfi_wp_enqueue_script("shcore-brush-{$brushes[$this->lang]}", "//cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/scripts/shBrush".$brushes[$this->lang].".js", array('bfi'), NULL, true);

        return "<pre class='bfi_syntaxhighlighter brush: $this->lang' $unusedAttributeString>".strip_tags($content)."</pre>";
    }
}
