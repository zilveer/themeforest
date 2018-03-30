<?php
require_once CT_THEME_SHORTCODES_DIR.'/ctShortcodeHandler.class.php';

/**
 * Generates every possible shortcode
 * @author alex
 */

class ctShortcodeTester {

	/**
	 * Compile?
	 * @var bool
	 */

	protected $compile = false;

	/**
	 * Which shortcodes we do not test?
	 * @var array
	 */
	protected $banned = array(
		'accordion',
		'google_maps',
		'five_sixth_column',
		'full_column',
		'half_column',
		'one_sixth_column',
		'quarter_column',
		'row',
		'third_column',
		'three_quarters_column',
		'two_thirds_column'
	);

	/**
	 * Attributes we wont parse. Format: shortcodeName=>
	 * @var array
	 */

	protected $bannedAttributes;

	/**
	 * Debug?
	 * @var bool
	 */
	protected $debug = false;

	/**
	 * List of child shortcodes
	 * @var array
	 */
	protected $childShortcodes = array();


	/**
	 * Creates tester
	 * @param array $bannedShortcodes
	 * @param array $bannedAttributes
	 */
	public function __construct($bannedShortcodes = array(), $bannedAttributes = array()) {

		$this->bannedAttributes = $bannedAttributes;
		$this->banned = array_merge($this->banned, $bannedShortcodes);
	}


	/**
	 * Returns shorcodes
	 */
	public function createPages() {

		/** @var $codes ctShortcode[] */
		$codes = ctShortcodeHandler::getInstance()->getShortcodes();
		$childShortcodes = array();

		$parentId = $this->reloadSection();

		foreach ($codes as $group => $cs) {
			foreach ($cs as $code) {

				if ($e = $code->getChildShortcodeInfo()) {
					if ($child = $e['name']) {
						$childShortcodes[$child] = true;
					}
				}
			}
		}

		$this->childShortcodes = $childShortcodes;


		$pageIds = array();

		$htmls = '';

		foreach ($codes as $cs) {
			/** @var $code ctShortcode */
			foreach ($cs as $code) {
				$n = $code->getShortcodeName();
				//we have a child, we parse it when we will parse parent
				if (!isset($childShortcodes[$n]) && !$this->isBanned($n)) {
					$this->log('Parsing: ' . $code->getShortcodeName());
					$result = $this->handleShortcode($code);

					$this->compile = true;
					$htmls .= $this->wrapShortcode($code, $this->handleShortcode($code, '', true), array('full'));
					$this->compile = false;

					$result = $this->wrapShortcode($code, $result);


					$pageIds[] = $this->createPage($parentId, $code, $result);
				}
			}
		}

		$pageIds[] = $this->createPage($parentId, null, $htmls, 'HTML Debug');

		$this->updateSection($parentId, $pageIds);
	}

	/**
	 * Updates section
	 * @param $parentId
	 * @param array $pagesIds
	 */
	protected function updateSection($parentId, $pagesIds) {
		$content = '[title_row header="Smokescreen - Shortcodes"]
		[row]
Below you will find most popular shortcodes in most common configurations:
[list style="2"]';

		foreach ($pagesIds as $pageId) {
			$post = get_post($pageId);
			$content .= '<li><a href="' . get_permalink($post) . '">' . $post->post_title . '</a></li>';
		}

		$content .= '[/list][/row]';

		wp_update_post(array('ID' => $parentId, 'post_content' => $content));
	}

	/**
	 * Do we support it?
	 * @param $name
	 * @return bool
	 */

	protected function isBanned($name) {
		return array_search($name, $this->banned) !== false;
	}

	/**
	 * Removes undeeded attributes
	 * @param ctShortcode $code
	 * @param $attributes
	 * @return array
	 */

	protected function filterAttributes($code, $attributes) {
		if (isset($this->bannedAttributes[$code->getShortcodeName()])) {
			return array_diff_key($attributes, $this->bannedAttributes[$code->getShortcodeName()]);
		}

		return $attributes;
	}

	/**
	 * Creates debug section
	 * @throws Exception
	 */

	protected function reloadSection() {
		$key = 'ct_debug_post';
		if ($id = get_option($key)) {
			foreach (get_posts(array('numberposts' => -1, 'post_type' => 'page', 'post_parent' => $id)) as $child) {
				wp_delete_post($child->ID, true);
			}

			if (get_post($id)) {
				return $id;
			}
		}

		$post = array(
			'post_name' => "Smokescreen",
			'post_title' => 'Smokescreen',
			'post_type' => "page",
			'post_status' => 'publish'
		);

		$id = wp_insert_post($post);

		if ($id === false) {
			throw new Exception("Cannot add debug post");
		}

		//store it
		update_option($key, $id);

		return $id;
	}

	/**
	 * Creates debug pages
	 * @param int $parentId
	 * @param ctShortcode $code
	 * @param string $result
	 * @return int|\WP_Error
	 */

	protected function createPage($parentId, $code, $result, $title = '') {
		$title = "Shortcode '" . ($code ? $code->getShortcodeName() : $title) . "'";
		$post = array(
			'post_content' => $result,
			'post_name' => $title,
			'post_title' => $title,
			'post_type' => "page",
			'post_status' => 'publish',
			'post_parent' => $parentId
		);

		return wp_insert_post($post);
	}

	/**
	 * Logs data
	 * @param string $content
	 */
	protected function log($content) {
		if ($this->debug) {
			echo $content . "\n";
		}
	}

	/**
	 * Parses shortcode - parent or single
	 * @param ctShortcode $code
	 * @param string $result
	 * @return string
	 */
	protected function handleShortcode($code, $result = '', $withHtml = false) {
		$child = $code->getChildShortcodeInfo();
		if (!$child || !$child['name']) {
			$attributes = $code->getAttributesNormalized();

			//remove builtin queryable data
			if ($code instanceof ctShortcodeQueryable) {
				$default = $code->getQueryAllAttributes();
				$attributes = array_diff_key($attributes, $default);
			}

			$combs = $this->parseAttributes($code, $attributes);

			$data = $this->combinations($this->filterAttributes($code, $combs));

			if (!$data) {
				$data[] = array('');
			}

			$content = '';
			//content - let's find it
			if (isset($attributes['content'])) {
				$content = $this->getDefaultFromAttributes($attributes['content'], $this->getTextareaValue());
			}


			foreach ($data as $e) {
				$params = '';
				if ($e) {
					if (is_array($e)) {
						$params = ' ' . implode(' ', $e);
					} else {
						$params = $e ? ' ' . $e : '';
					}
				}

				if (!isset($this->childShortcodes[$code->getShortcodeName()])) {
					$result .= '<pre class="shortcodeTest">&#91;' . $code->getShortcodeName() . $params . '&#93;</pre>';
				}
				$s = '[' . $code->getShortcodeName() . $params . ']';
				if ($content) {
					$s .= $content . '[/' . $code->getShortcodeName() . ']';
				}
				$result .= $s;

				// konfiguracja Tidy
				$config = array(
					'indent' => true,
					'output-xhtml' => true,
					'wrap' => 200,
					'fix-backslash' => false,
					'fix-bad-comments' => false,
					'fix-uri' => false,
					'join-styles' => false,
					'lower-literals' => false,
					'show-body-only' => true

				);

				$sCode = do_shortcode($s);

				if (class_exists('tidy')) {

// przetwarzanie Tidy
					$tidy = new tidy;
					$tidy->parseString($sCode, $config, 'utf8');
					$tidy->cleanRepair();
					$sCode = (string)$tidy;
				}

				if ($withHtml) {
					$result .= '<div class="htmlTest">HTML:<pre class="htmlTest">' . htmlentities($sCode) . '</pre></div>';
					$result .= '<hr class="htmlTest" style="margin-bottom:50px">';
				}


				//$result .= "\n";

			}

			return $result;
		} else {
			$result = '[' . $code->getShortcodeName() . ']' . "\n";
			$c = $code->getChildShortcode();
			for ($x = 0; $x < 3; $x++) {
				$result .= $this->handleShortcode($c);
			}
			$result .= '[/' . $code->getShortcodeName() . ']';
		}

		return $result;
	}

	/**
	 * Patterns cache
	 * @var null
	 */
	protected static $rowPatterns = null;

	/**
	 * Wraps shortcode
	 * @param ctShortcode $code
	 * @param string $html
	 * @param array $allowTemplates
	 * @return string
	 */

	protected function wrapShortcode($code, $html, $allowTemplates = array()) {
		if (!self::$rowPatterns) {
			$row = ctShortcodeHandler::getInstance()->getShortcode('row');
			$combs = $this->parseAttributes($row, $row->getAttributesNormalized());

			$templates = array(
				'full' => '[full_column]%1$s[/full_column]',
				'half' => '[half_column]%1$s[/half_column][half_column]%1$s[/half_column]',
				'third' => '[third_column]%1$s[/third_column][two_thirds_column]%1$s[/two_thirds_column]',
				'no_row' => '%1$s'
			);


			$data = $this->combinations($combs);

			foreach ($data as $key => $profile) {
				$params = implode(' ', is_array($profile) ? $profile : array($profile));
				foreach ($templates as $name => $template) {
					$r = '';
					if ($name != 'no_row') {
						$r .= '[' . $row->getShortcodeName() . ' ' . $params . ']' . "\n";
					}
					$r .= $template . "\n";

					if ($name != 'no_row') {
						$r .= '[/' . $row->getShortcodeName() . ']';
					}

					self::$rowPatterns[$key][$name] = $r;
				}
			}
		}

		$allowTemplates = array_flip($allowTemplates ? $allowTemplates : $this->getShortcodeWrapTemplates($code));
		//use only filtered templates
		$r = '';
		if (isset($allowTemplates['no_row'])) {
			foreach (self::$rowPatterns[0] as $pat) {
				$r = sprintf($pat, "\n" . $html . "\n") . "\n";
			}
		} else {
			$r = '[title_row header="Shortcode: ' . $code->getShortcodeName() . '"][/title_row]' . "\n";

			foreach (self::$rowPatterns as $patterns) {
				foreach ($patterns as $type => $pat) {
					if (array_key_exists($type, $allowTemplates)) {
						$r .= sprintf($pat, "\n" . $html . "\n") . "\n";
					}
				}
			}
		}

		if ($this->mustCompile($code)) {
			$r = do_shortcode($r);
		}

		return $r . "\n\n";
	}

	/**
	 * Should we compile?
	 * @param ctShortcode $code
	 * @return bool
	 */

	protected function mustCompile($code) {
		return $this->compile;
	}

	/**
	 * Is shortcode limited?
	 * @param ctShortcode $code
	 * @return array
	 */

	protected function getShortcodeWrapTemplates($code) {
		return array('full', 'half', 'third');
	}

	/**
	 * Generates combinations
	 * @param $arrays
	 * @param int $i
	 * @return array
	 */
	protected function combinations($arrays, $i = 0) {
		if (!isset($arrays[$i])) {
			return array();
		}
		if ($i == count($arrays) - 1) {
			return $arrays[$i];
		}

		// get combinations from subsequent arrays
		$tmp = $this->combinations($arrays, $i + 1);

		$result = array();

		// concat each array from tmp with each element from $arrays[$i]
		foreach ($arrays[$i] as $v) {
			foreach ($tmp as $t) {
				$result[] = is_array($t) ?
						array_merge(array($v), $t) :
						array($v, $t);
			}
		}

		return $result;
	}

	/**
	 * Returns field options
	 * @param $code
	 * @param $attributes
	 * @throws Exception
	 * @return array
	 */
	protected function parseAttributes($code, $attributes) {
		$data = array();

		$attributes = $this->filterAttributes($code, $attributes);

		foreach ($attributes as $field => $attr) {
			$type = isset($attr['type']) && $attr['type'] ? $attr['type'] : 'input';

			$method = 'generate' . ucfirst($type);
			if (!method_exists($this, $method)) {
				throw new Exception("Cannot handle " . $type . ' Attributes: ' . print_r($attr, true));
			}

			if ($v = $this->$method($field, $attr)) {
				$data[$field] = $v;
			}
		}

		$result = array();
		foreach ($data as $field => $values) {
			$t = array();
			foreach ($values as $value) {
				$t[] = $field . '="' . $value . '"';
			}

			$result[] = $t;
		}

		return $result;
	}

	/**
	 * Posts select
	 * @param string $field
	 * @param array $attr
	 * @return array
	 */
	protected function generatePosts_select($field, $attr) {
		$args = array('numberposts' => 1, 'orderby' => 'rand');
		$posts = get_posts($args);

		if (isset($posts[0])) {
			return array($posts[0]->ID);
		}
		return array();
	}

	/**
	 * Generates select
	 * @param $field
	 * @param $attr
	 * @return array
	 */
	protected function generateSelect($field, $attr) {
		if (!isset($attr['choices'])) {
			return array_keys($attr['options']);
		}
		return array_keys($attr['choices']);
	}

	/**
	 * Toggalbe content type
	 * @param $field
	 * @param $attr
	 * @return array
	 */
	protected function generateToggable($field, $attr) {
		return array();
	}

	/**
	 * Generates checkboxes
	 * @param $field
	 * @param $attr
	 * @return array
	 */
	protected function generateCheckbox($field, $attr) {
		return array(0, 1);
	}

	/**
	 * Generates combinations
	 * @param string $field
	 * @param array $attr
	 * @return array
	 */

	protected function generateInput($field, $attr) {
		$default = $this->getDefaultFromAttributes($attr, 'Example text');
		if (!$default && (strpos($field, 'link') !== false || strpos($field, 'url') !== false)) {
			return array('http://www.google.com');
		}

		if (strpos($field, 'img') !== false) {
			return $this->generateImage($field, $attr);
		}

		return array($default);
	}

	/**
	 * Generates mockup for textarea
	 * @param $field
	 * @param $attr
	 * @return array
	 */
	protected function generateTextarea($field, $attr) {
		//it means its content
		return array();
	}

	/**
	 * Returns textarea value
	 * @return string
	 */

	protected function getTextareaValue() {
		return "Lorem ipsum";
	}

	/**
	 * Generates image combinations
	 * @param $field
	 * @param $attr
	 * @return array
	 */

	protected function generateImage($field, $attr) {
		return array('http://lorempixel.com/g/600/400/city/');
	}

	/**
	 * Returns default attribute
	 * @param array $attr
	 * @param string $default
	 * @return string
	 */
	protected function getDefaultFromAttributes($attr, $default = '') {
		if (isset($attr['example'])) {
			$content = $attr['example'];
			if (is_array($content)) {
				return call_user_func($content); //we support callback for performace reasons
			}
			return $content;
		}
		return isset($attr['default']) && $attr['default'] ? $attr['default'] : $default;
	}

}
