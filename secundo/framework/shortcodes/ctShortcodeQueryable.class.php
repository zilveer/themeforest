<?php
require_once CT_THEME_SHORTCODES_DIR . '/ctShortcode.class.php';
require_once CT_THEME_SHORTCODES_DIR . '/ICtShortcodeSingleQueryable.interface.php';

/**
 * Shortcodes which query database
 *
 * To hide certain fileds override
 * - onlySingle - return true to remove limit and other not used fields
 * - getDisabledSections - return array (section_name=>true) to hide certain sections (see const)
 *
 * @author alex
 */
abstract class ctShortcodeQueryable extends ctShortcode {

	/**
	 * Section limit
	 */

	const SECTION_LIMIT = 'limit';

	/**
	 * Section order
	 */

	const SECTION_ORDER = 'order';

	/**
	 * Section post
	 */

	const SECTION_POST = 'post';

	/**
	 * Section category
	 */

	const SECTION_CATEGORY = 'category';

	/**
	 * Section tag
	 */

	const SECTION_TAG = 'tag';

	/**
	 * Section search
	 */

	const SECTION_SEARCH = 'search';

	/**
	 * Author section
	 */

	const SECTION_AUTHOR = 'author';
	/**
	 * Disabled sections
	 * @var array
	 */
	protected $disabledSections;

	/**
	 * Is postish type?
	 * @return mixed
	 */
	protected function isPostType() {
		return true;
	}

	/**
	 * Returns query attributes added to default ones
	 * @param $atts
	 * @return array
	 */
	protected function getAttributesWithQuery($atts) {
		$allAttributes = $this->getQueryAllAttributes();
		$allAttributes = array_merge($allAttributes, $atts);
		return array_merge($atts, array('divider' => array('id' => 'ctAdvancedFilters', 'type' => 'toggable', 'desc' => esc_html__("Advanced filter options", 'ct_theme'))), $allAttributes);
	}

	/**
	 * Returns single item
	 * @param array $atts
	 * @param array $rawParams - merges custom params
	 * @return mixed
	 */

	protected function getSingle($atts, $rawParams = array()) {
		$params = $this->buildQuery($atts, $rawParams);

		//merge custom params
		$params['showposts'] = 1;

		$params = array_merge($params, $rawParams);

		$query = new WP_Query;
		$posts = $query->query($params);
		return isset($posts[0]) ? $posts[0] : null;
	}

	/**
	 * Return colleciton
	 * @param $atts
	 * @param array $rawParams
	 * @return array
	 */

	protected function getCollection($atts, $rawParams = array()) {

		$params = $this->buildQuery($atts, $rawParams);

		//merge custom params
		$params = array_merge($params, $rawParams);
		$query = new WP_Query;
		return $query->query($params);
	}

	/**
	 * Builds shortcode query
	 * @param array $atts
	 * @param array $rawParams
	 * @return array
	 */
	protected function buildQuery($atts, $rawParams) {
		$values = array_intersect_key($this->getQueryAllAttributes(), $atts);

		$normalized = array();
		foreach ($values as $key => $v) {
			$k = isset($v['query_map']) ? $v['query_map'] : $key;
			$value = $atts[$key];
			if ($value != '' && (isset($v['default']) && ($v['default'] != $value || $key == 'limit'))) {
				if ($k == 'post__not_in') {
					$notidsArray = explode(',', $value);
					$notidsArray = array_combine($notidsArray, $notidsArray);
					$normalized[$k] = $notidsArray;
				} else {
					$normalized[$k] = $atts[$key];
				}
			}
		}

		if (!isset($atts['post_type'])) {
			$normalized['post_type'] = $this->isPostType() ? 'post' : 'page';
		}

		//filtrowanie po nazwach kategorii dla custom category
		//$taxNamespace = apply_filters('ct_shortcode_queryable.tax_namespace','category');
        $taxNamespace = 'category';
		if (isset($rawParams['post_type']) && $rawParams['post_type'] != 'post' && $rawParams['post_type'] != 'page') {
			if (isset($normalized['category_name'])) {
				//$normalized[$rawParams['post_type'] . '_' . $taxNamespace] = $normalized['category_name'];
				//Bug fix #30088
				$normalized['tax_query'] = array(array('taxonomy' => $rawParams['post_type'] . '_' . $taxNamespace, 'field' => 'slug', 'terms' => $normalized['category_name'] ) );
				unset($normalized['category_name']);
			}
		}

		return $normalized;
	}


	/**
	 * Return all query attributes
	 * @return array
	 */
	public function getQueryAllAttributes() {
		return array_merge(
				$this->getQueryLimitAttributes(),
				$this->getQueryOrderAttributes(),
				$this->getQueryPostAttributes(),
				$this->getQueryCategoryAttributes(),
				$this->getQueryTagAttributes(),
				$this->getQuerySearchAttributes()
		);
	}

	/**
	 * Returns disabled sections
	 * @return array
	 */
	protected function getDisabledSection() {
		//if only single item, we don't need limit
		if ($this->onlySingle() || $this instanceof ICtShortcodeSingleQueryable) {
			return array(self::SECTION_LIMIT => true);
		}
		return array();
	}

	/**
	 * Shortcode operates only on single item?
	 * @return bool
	 */
	protected function onlySingle() {
		return false;
	}

	/**
	 * Should we show this section?
	 * @param string $name
	 * @return bool
	 */

	protected function showSection($name) {
		if (!$this->disabledSections) {
			$this->disabledSections = $this->getDisabledSection();
		}
		return isset($this->disabledSections[$name]) ? false : true;
	}

	/**
	 * @return array
	 */
	public function getQueryLimitAttributes() {
		if (!$this->showSection(self::SECTION_LIMIT)) {
			return array();
		}
		return array(
				'limit' => array('query_map' => 'showposts', 'label' => esc_html__('limit', 'ct_theme'), 'default' => 1, 'type' => 'input', 'help' => esc_html__("Set Query Limit", 'ct_theme')),
				'skip' => array('query_map' => 'offset', 'label' => esc_html__('skip X elements', 'ct_theme'), 'default' => 0, 'type' => 'input', 'help' => esc_html__("Allows to skip X elements from collection", 'ct_theme'))
		);
	}

	/**
	 * Query attributes for order by
	 * @return array
	 */
	public function getQueryOrderAttributes() {
		if (!$this->showSection(self::SECTION_ORDER)) {
			return array();
		}
		return array(
				'order' => array('default' => 'desc', 'type' => 'select', 'choices' => array('asc' => "Ascending", 'desc' => "Descending"), 'label' => esc_html__("Order", 'ct_theme'), 'help' => esc_html__('Order in which data should be fetched', 'ct_theme')),
				'orderby' => array('default' => 'date', 'type' => 'select', 'choices' => array(
						'date' => esc_html__("Date", 'ct_theme'),
						'ID' => esc_html__("ID", 'ct_theme'),
						'author' => esc_html__('Author', 'ct_theme'),
						'title' => esc_html__('Title', 'ct_theme'),
						'name' => esc_html__('Slug', 'ct_theme'),
						'modified' => esc_html__('Modified', 'ct_theme'),
						'parent' => esc_html__('Order by parent id', 'ct_theme'),
						'rand' => esc_html__('Random order', 'ct_theme'),
						'menu_order' => esc_html__('Order by Page order', 'ct_theme'),
				), 'label' => esc_html__("Order by", 'ct_theme'), 'help' => esc_html__('Order in which data should be fetched', 'ct_theme')),
		);
	}

	/**
	 * Query for post/pages
	 */

	public function getQueryPostAttributes() {
		if (!$this->showSection(self::SECTION_POST)) {
			return array();
		}
		$post = $this->isPostType();
		return array(
				'id' => array('query_map' => $post ? 'p' : 'page_id', 'default' => '', 'type' => 'input', 'label' => $post ? esc_html__("Post id", 'ct_theme') : esc_html__("Page id", 'ct_theme')),
				'notids' => array('query_map' => 'post__not_in', 'default' => '', 'type' => 'input', 'label' => $post ? esc_html__("Exclude post id", 'ct_theme') : esc_html__("Exclude page id", 'ct_theme')),
				'slug' => array('query_map' => $post ? 'name' : 'pagename', 'default' => '', 'type' => 'input', 'label' => $post ? esc_html__("Post slug", 'ct_theme') : esc_html__("Page slug", 'ct_theme'), 'help' => esc_html__("Filter by slug", 'ct_theme')),
				'post_parent' => array('default' => '', 'type' => 'input', 'label' => $post ? esc_html__("Post parent id", 'ct_theme') : esc_html__("Page parent id", 'ct_theme'), 'help' => esc_html__('Filter by Parent ID', "ct_theme")),
		);
	}

	/**
	 * Query for authors
	 */

	public function getQueryAuthorAttributes() {
		if (!$this->showSection(self::SECTION_AUTHOR)) {
			return array();
		}
		return array(
				'author' => array('default' => '', 'type' => 'input', 'label' => esc_html__("Authors Ids", 'ct_theme'), 'help' => esc_html__("Comma separated values: 2,3,5. To exclude certain authors use '-' minus: -2 will exclude author 2", 'ct_theme')),
				'author_name' => array('default' => '', 'type' => 'input', 'label' => esc_html__("Author name", 'ct_theme'), 'query_map' => 'category_name'),
		);
	}

	/**
	 * Returns attributes queryable for category
	 * @return array
	 */
	public function getQueryCategoryAttributes() {
		if (!$this->showSection(self::SECTION_CATEGORY)) {
			return array();
		}
		return array(
				'cat' => array('default' => '', 'type' => 'input', 'label' => esc_html__("Categories Ids", 'ct_theme'), 'help' => esc_html__("Comma separated values: 2,3,5. To exclude catgories use '-' minus: -2 will exclude category 2", 'ct_theme')),
				'cat_name' => array('query_map' => 'category_name', 'default' => '', 'type' => 'input', 'label' => esc_html__("Category name", 'ct_theme'), 'help' => esc_html__("Name of category to filter", 'ct_theme')),
		);
	}

	/**
	 * Returns attributes queryable for category
	 * @return array
	 */
	public function getQueryTagAttributes() {
		if (!$this->showSection(self::SECTION_TAG)) {
			return array();
		}
		return array(
				'tag' => array('default' => '', 'type' => 'input', 'label' => esc_html__("Tag name (slug)", 'ct_theme'), 'help' => esc_html__("Comma separated values: tag1,tag2 To exclude tags use '-' minus: -mytag will exclude tag 'mytag'", 'ct_theme')),
		);
	}

	/**
	 * Returns search attributes
	 * @return array
	 */
	public function getQuerySearchAttributes() {
		if (!$this->showSection(self::SECTION_SEARCH)) {
			return array();
		}
		return array(
				's' => array('default' => '', 'type' => 'input', 'label' => esc_html__("Keyword search", 'ct_theme'), 'help' => esc_html__("Show item with certain keyword", 'ct_theme')),
		);
	}
}
