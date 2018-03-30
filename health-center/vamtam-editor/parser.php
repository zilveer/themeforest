<?php

/**
 *	Recursive descent parser
 *
 *  used to turn shortcodes into a tree
 *
 *  detects foreign shortcodes and text nodes, not wrapped in [text]
 *
 * @package  wpv
 */

/**
 * class WPV_Editor_Parser
 */
class WPV_Editor_Parser {
	/**
	 * Initialize the parser
	 *
	 * @param string $content    string to parse
	 * @param array  $shortcodes list of supported shortcodes and their options
	 */
	public function __construct($content, $shortcodes = array()) {
		$this->content = $content;
		$this->input_size = strlen($this->content);
		$this->shortcodes = $shortcodes;

		$this->prepare();
		$this->known_shortcodes();
	}

	/**
	 * Creates a tree of the content
	 *
	 * Two special node types:
	 * 1. ROOT - a single root element
	 * 2. text - unrecognized shortcodes and text blocks. Adjascent text nodes are collapsed together
	 *
	 * @return [type] [description]
	 */
	public function parse() {
		$this->ptr = $this->new_block('ROOT');
		$this->root = &$this->ptr;

		$pos = 0;

		while($pos < $this->input_size) {
			// shortcode tag
			if($this->content[$pos] == '[') {
				// detect closing shortcode tag
				if($this->content[$pos+1] === '/') {
					list($type, $pos) = $this->get_type(++$pos);

					if($type != $this->ptr->type) {
						$start = max($pos-30, 0);
						$line = substr_count($this->content, "\n", 0, $pos)+1;
						$char = $pos - strrpos(substr($this->content, 0, $pos), "\n");
						$context = "'".esc_attr(substr($this->content, $start, $pos-$start)) . '<span style="color:green">&#9679;</span>' . esc_attr(substr($this->content, $pos, 30))."'"
									.'<br><br><br><span style="color:green">&#9679;</span> denotes the position of the problem';
						throw new Exception("<!-- wpv editor error --><div class='wpv-editor-error'><span style='color: red'>Improperly closed shortcodes. Expected <strong>[/{$this->ptr->type}]</strong>, but found <strong>[/{$type}]</strong> on position ". ($pos - strlen($type) - 2 ." (character ".$char."; line ".$line.")</span><br><br>Context: $context</div>"));
					}

					$this->ptr = $this->ptr->parent;
				} else {
					$open_pos = $pos;

					list($type, $pos) = $this->get_type($pos);

					$block = $this->new_block($type, $this->ptr);

					list($block->atts, $pos) = $this->get_attributes($pos);

					if($this->is_accepting($type)) {
						$this->ptr->children[] = $block;
						$this->ptr = $block;
					} else {
						// try to find a closing tag
						$closing_pos = strpos($this->content, "[/$type]", $pos);
						if($closing_pos !== false) {
							$block->content = substr($this->content, $pos+1, $closing_pos - $pos - 1);
							$pos = $closing_pos + strlen("[/$type]") - 1;
						}

						// some shortcodes are special
						// that is, we support them, but they don't accept children
						// (for example, text)
						if($this->is_supported($type) || !is_array($this->ptr->children)) {
							$this->ptr->children[] = $block;
						} else {
							$pblock = end($this->ptr->children);

							if($pblock && $pblock->type === 'text') {
								array_pop($this->ptr->children);
							} else {
								$pblock = $this->new_block('text', $this->ptr);
							}

							$pblock->content .= substr($this->content, $open_pos, $pos - $open_pos + 1);
							$this->ptr->children[] = $pblock;
						}
					}
				}
			} else {
				// text node
				$pos = $this->trim_text_nodes($pos);
			}

			// end of block, proceed forward
			$pos++;
		}

		while($this->root->parent != NULL) {
			$this->root = &$this->root->parent;
		}

		return $this->root;
	}

	/**
	 * Initial cleanup of the content
	 * @return string cleaned up content
	 */
	private function prepare() {
		$this->content = preg_replace('#\[/\s*(\w+)\s*\]#', '[/$1]', $this->content);
	}

	/**
	 * Constructs a new node
	 *
	 * @param  string  $type   node type
	 * @param  &object $parent reference to the new node's parent node
	 * @return object          newly constructed node
	 */
	private function new_block($type, &$parent = null) {
		global $wpv_sc;

		return (object)array(
			'type' => $type,
			'parent' => $parent,
			'children' => array(),
			'atts' => '',
			'content' => '',
		);
	}

	/**
	 * Trims unrecognized shortcodes and arbitrary text and puts it in a text node
	 * @param  int $pos parser position
	 * @return int      parser position after trimming the text
	 */
	private function trim_text_nodes($pos) {
		$pblock = end($this->ptr->children);

		if($pblock && $pblock->type === 'text') {
			array_pop($this->ptr->children);
		} else {
			$pblock = $this->new_block('text', $this->ptr);
		}

		while($pos < $this->input_size && $this->content[$pos] !== '[') {
		 	$pblock->content .= $this->content[$pos++];
		}

		if(!ctype_space($pblock->content))
			$this->ptr->children[] = $pblock;

		return $pos-1;
	}

	/**
	 * Get shortcode type
	 *
	 * @param  int   $pos  parser position
	 * @return array       array of two elements - shortcode type and parser position
	 */
	private function get_type($pos) {
		$type = '';
		while($pos+1 < $this->input_size && preg_match('/[-\w]/', $this->content[++$pos])) {
			$type .= $this->content[$pos];
		}

		if(strpos($type, 'column') !== false)
			$type = 'column';

		return array($type, $pos);
	}

	/**
	 * Get atrributes when inside an opening shortcode tag
	 *
	 * @param int $pos  parser position
	 */
	private function get_attributes($pos) {
		$attributes = array();
		$current_name = '';
		$mode = 'name';
		$pos = $this->ignore_whitespace($pos);
		while($pos < $this->input_size && $this->content[$pos] !== ']') {
			$c = $this->content[$pos];

			switch($mode) {
				case 'name':
					if(trim($c) && $c !== '=') {
						$current_name .= $c;
					} elseif($c === '=') {
						$attributes[$current_name] = '';
						$mode = 'open';
					}
				break;

				case 'open':
					if($c === '"')
						$mode = 'inside';
				break;

				case  'inside':
					if($c !== '"') {
						$attributes[$current_name] .= $c;
					} else {
						$mode = 'name';
						$current_name = '';
					}
				break;
			}

			$pos++;
		}

		return array($attributes, $pos);
	}

	/**
	 * Moves the parser position at the end of the whitespace
	 *
	 * @param  int $pos parser position
	 * @return int      parser position
	 */
	private function ignore_whitespace($pos) {
		while ( $pos + 1 < $this->input_size && ctype_space( $this->content[++$pos] ) );

		return $pos-1;
	}

	/**
	 * Whether a shortcode of type $type accepts nested shortcodes
	 *
	 * @param  string  $type shortcode type
	 * @return boolean       true if nested shortcodes are enabled for $type
	 */
	private function is_accepting($type) {
		return in_array($type, $this->accepting);
	}

	/**
	 * Whether a shortcode of type $type is supported by the Vamtam editor
	 *
	 * @param  string  $type shortcode type
	 * @return boolean       true if a shortcode of type $type is supported by the Vamtam editor
	 */
	private function is_supported($type) {
		return in_array($type, $this->supported);
	}

	/**
	 * Maps the list of supported shortcodes to $this->accepting and $this->supported (i.e. splits the original list in two)
	 */
	private function known_shortcodes() {
		$this->accepting = array('column');
		$this->supported = array();

		for($i=1; $i<10; $i++) {
			$this->accepting[] = "column_$i";
		}

		foreach($this->shortcodes as $id=>$sc) {
			if(isset($sc['accepting']) && $sc['accepting']) {
				$this->accepting[] = $id;
			} else {
				$this->supported[] = $id;
			}
		}
	}
};