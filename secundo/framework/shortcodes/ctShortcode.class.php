<?php

/**
 * Main shortcode class
 * @author alex
 */
abstract class ctShortcode {

	/**
	 * Name for hook inline attribute filter
	 */

	const FILTER_INLINE_ATTRIBUTE = 'inline_attribute';

	/**
	 * Normalize attributes - allows to extend default shortcode attributes
	 */

	const FILTER_NORMALIZED_ATTRIBUTES = 'normalize_attributes';

	/**
	 * Shortcode without content inside
	 */

	const TYPE_SHORTCODE_SELF_CLOSING = 'self-closing';
	/**
	 * Shortcode which wraps selection
	 */
	const TYPE_SHORTCODE_ENCLOSING = 'enclosing';

	/**
	 * Shortocode self_closing and enclosing
	 */
	const TYPE_SHORTCODE_BOTH = 'both';

	/**
	 * Shortcode has config popup
	 */

	const GENERATOR_ACTION_POPUP = 'popup';

	/**
	 * Add shortcode now
	 */

	const GENERATOR_ACTION_INSERT = 'insert';

	/**
	 * @var string
	 */
	protected static $data;

	/**
	 * Callback which is overwritten by current shortcode
	 * @var null
	 */
	protected $overwrittenCallback = null;

	/**
	 * Dynamic javascript files
	 * @var array
	 */

	protected $dynamicJs = array();

	/**
	 * Creates and registers shortcode
	 */
	public function __construct()
	{
		//register shortcode
		global $shortcode_tags;
		if (isset($shortcode_tags[$this->getShortcodeName()])) {
			$this->overwrittenCallback = $shortcode_tags[$this->getShortcodeName()];
		}

		$this->register($this->getShortcodeName(), array($this, 'handleShortcode'));
		//allow to add scripts for increased compatibility
		if (!is_admin()) {
			add_action('init', array($this, 'enqueueHeadScripts'));
		}
		ctShortcodeHandler::register($this);
	}

	/**
	 * @param $name
	 * @param $callback
	 * @return mixed
     */
	protected function register($name, $callback)
	{
		$prefix = "add_";
		//allow to dynamically reassign registration functions
		$call = $prefix.apply_filters('ct_register_shortcode_function','shortcode');
		return $call($name, $callback);
	}


	/**
	 * Builds main container attributes
	 *
	 * @param array $params
	 * @param array $atts
	 * @param string $context
	 *
	 * @return string
	 */
	public function buildContainerAttributes( $params = array(), $atts = array(), $context = 'container' ) {
		if ( ! isset( $params['class'] ) ) {
			$params['class'] = array();
		}

		$atts['shortcode'] = $this;

		$data = $this->callFilter( self::FILTER_INLINE_ATTRIBUTE, $params, $atts );

		if ( $data ) {
			return $this->buildAttributes( $data );
		}

		return '';
	}

	/**
	 * Builds attributes from array
	 *
	 * @param array $params
	 * @param string $delimiter
	 *
	 * @return string
	 */
	protected function buildAttributes( $params = array(), $delimiter = ' ' ) {

		$r = '';
		foreach ( $params as $key => $val ) {
			if ( is_array( $val ) ) {
				foreach ( $val as $k => $v ) {
					if ( $v === '' ) {
						unset( $val[ $k ] );
					}
				}
				$val = implode( ' ', $val );
			}
			if ( $val !== '' ) {
				$r .= ( $key . '="' . esc_attr( $val ) . '" ' );
			}
		}

		return $delimiter . trim( $r );
	}


	/**
	 * Handle shortcode
	 *
	 * @param array $atts
	 * @param null $content
	 *
	 * @return mixed|void
	 */

	public function handleShortcode( $atts, $content = null ) {
		$atts = $this->preHandleShortcode( $atts, $content );

		$content = $this->handle( $atts, $content );

		return $this->postHandleShortcode( $atts, $content );
	}

	/**
	 * Allows to filter attributes
	 *
	 * @param $atts
	 * @param null $content
	 *
	 * @return mixed|void
	 */

	protected function preHandleShortcode( $atts, $content = null ) {
		$name = $this->getShortcodeName();

		//add all scripts in footer
		add_action( 'wp_footer', array( $this, 'enqueueScripts' ) );

		//print inline scripts
		add_action( 'wp_print_footer_scripts', array( $this, 'printInlineScripts' ) );

		$atts = apply_filters( 'ct_shortcode_pre_handle', $atts, $content, $this );

		return apply_filters( $this->getShortcodeName() . '_pre_handle', $atts, $this );
	}

	/**
	 * Prints inline scripts
	 */

	public function printInlineScripts() {
		if ( $this->dynamicJs ) {
			$this->dynamicJs = array_filter( $this->dynamicJs );
			echo '<script type="text/javascript">' . "\n";
			echo implode( "\n", $this->dynamicJs );
			echo '</script>' . "\n";
		}
	}

	/**
	 * Handle shortcode after its rendered
	 *
	 * @param $atts
	 * @param null $content
	 *
	 * @return mixed|void
	 */

	protected function postHandleShortcode( $atts, $content = null ) {
		$content = apply_filters( 'ct_shortcode_post_handle', $content, $atts, $this );

		return apply_filters( $this->getShortcodeName() . '_post_handle', $content, $atts, $this );
	}

	/**
	 * Returns overwritten callback if available
	 * @author alex
	 * @return mixed
	 */

	protected function getOverwrittenCallback() {
		return $this->overwrittenCallback;
	}

	/**
	 * Adds data
	 *
	 * @param mixed $key
	 * @param $value
	 */

	protected function setData( $key, $value ) {
		self::$data[ $this->getShortcodeName() ][ $key ] = $value;
	}

	/**
	 * Returns data
	 *
	 * @param mixed $id
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	protected function getData( $id, $default = null ) {
		return isset( self::$data[ $this->getShortcodeName() ] ) && array_key_exists( $id, self::$data[ $this->getShortcodeName() ] ) ? self::$data[ $this->getShortcodeName() ][ $id ] : $default;
	}

	/**
	 * Returns all data
	 *
	 * @param array $default
	 *
	 * @return array
	 */

	protected function getAllData( $default = array() ) {
		if(!is_array(self::$data)){ return $default;}
		return array_key_exists( $this->getShortcodeName(), self::$data ) ? self::$data[ $this->getShortcodeName() ] : $default;
	}

	/**
	 * Unsets shortcode data
	 *
	 * @param string $shortcodeName
	 */

	protected function cleanData( $shortcodeName = null ) {
		$shortcodeName = $shortcodeName ? $shortcodeName : $this->getShortcodeName();

		if ( isset( self::$data[ $shortcodeName ] ) ) {
			unset( self::$data[ $shortcodeName ] );
		}
	}

	/**
	 * Returns group name
	 * @return mixed
	 */

	public function getGroupName() {
		$class_info = new ReflectionClass( $this );
		return ucfirst( basename( dirname( $class_info->getFileName() ) ) );
	}

	/**
	 * Returns shortcode label
	 * @return mixed
	 */

	public abstract function getName();

	/**
	 * Returns shortcode name
	 * @return string
	 */

	public abstract function getShortcodeName();

	/**
	 * Handles shortcode
	 *
	 * @param $atts
	 * @param null $content
	 *
	 * @return mixed
	 */

	public abstract function handle( $atts, $content = null );

	/**
	 * Returns config attributes
	 * @return array
	 */

	public abstract function getAttributes();

	/**
	 * Retruns attributes with additional atrtibutes if required
	 */

	public function getAttributesNormalized() {
		$attr = $this->getAttributes();

		//expand default options
		$attr = apply_filters( self::getFilterName( $this->getShortcodeName(), self::FILTER_NORMALIZED_ATTRIBUTES ), $attr, $this );

		//some generic call
		return apply_filters( self::getFilterName( '', self::FILTER_NORMALIZED_ATTRIBUTES ), $attr );
	}

	/**
	 * Extracts attributes
	 *
	 * @param array $atts
	 *
	 * @return array
	 */
	protected function extractShortcodeAttributes( $atts ) {
		$values = array_map( create_function( '$s', 'return isset($s["default"])?$s["default"]:"";' ), $this->getAttributesNormalized() );
		if ( isset( $values['content'] ) && $values['content'] == '' ) {
			unset( $values['content'] );
		}

		return $values;
	}

	/**
	 * Returns
	 * @return array
	 */
	public function getShortcodeMenuItem() {
		$normalized = $this->getAttributesNormalized();
		$action     = $normalized || $this->getChildShortcodeInfo() ? $this->getGeneratorAction() : self::GENERATOR_ACTION_INSERT;
		$d          = array( 'name' => $this->getName(), 'action' => $action, 'id' => $this->getShortcodeName() );


		if ( $action == self::GENERATOR_ACTION_INSERT ) {
			//check whether there are some params - if true, discard action
			$has = false;
			foreach ( $normalized as $name => $val ) {
				if ( isset( $val['type'] ) && $val['type'] !== false ) {
					$has = true;
					break;
				}
			}

			if ( ! $has ) {
				$code = '[' . $this->getShortcodeName() . ']';
				if ( $this->getShortcodeType() !== self::TYPE_SHORTCODE_SELF_CLOSING ) {
					$code .= '(*)[/' . $this->getShortcodeName() . ']';
				}

				$d['code'] = $code;
			} else {
				$d['action'] = self::GENERATOR_ACTION_POPUP;
			}
		}

		return $d;
	}

	/**
	 * Returns child shortcode if exists
	 * @return ctShortcode
	 * @throws Exception
	 */
	public function getChildShortcode() {
		//maybe child?
		$childInfo = $this->getChildShortcodeInfo();
		if ( isset( $childInfo['name'] ) && ( $childInfo['name'] ) ) {
			//find shortcode
			if ( ! $childShortcode = ctShortcodeHandler::getInstance()->getShortcode( $childInfo['name'] ) ) {
				throw new Exception( "Cannot find shortcode " . $childInfo['name'] );
			}

			return $childShortcode;
		}

		return null;
	}

	/**
	 * Returns shortcode type
	 * @return mixed
	 */

	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_BOTH;
	}

	/**
	 * Returns type
	 * @return mixed
	 */

	public function getGeneratorAction() {
		return self::GENERATOR_ACTION_POPUP;
	}

	/**
	 * Handler for enqueue scripts (in footer)
	 */

	public function enqueueScripts() {
		//do nothing here
	}

	/**
	 * Handler for head enquee scripts
	 */

	public function enqueueHeadScripts() {
		//do nothing here
	}

	/**
	 * Returns child shortcode name
	 * @return string
	 */
	public function getChildShortcodeInfo() {
		//returns definition of child shortcode (name -> shortcode name, min - min qty, max - max qty)
		return array( 'name' => '', 'min' => 0, 'max' => 0, 'default_qty' => 5 );
	}

	/**
	 * Calls preHook
	 *
	 * @param $content
	 * @param array $options
	 *
	 * @return mixed
	 */

	protected function callPreFilter( $content, $options = array() ) {
		return apply_filters( self::getFilterName( $this->getShortcodeName(), 'pre' ), $content, $options );
	}

	/**
	 * Calls hook
	 *
	 * @param string $event
	 * @param string $content
	 * @param array $options
	 *
	 * @return mixed|void
	 */

	protected function callFilter( $event, $content, $options = array() ) {
		return apply_filters( self::getFilterName( $this->getShortcodeName(), $event ), $content, $options );
	}

	/**
	 * Calls post hook
	 *
	 * @param string $content
	 * @param array $options
	 *
	 * @return mixed
	 */

	protected function callPostFilter( $content, $options = array() ) {
		return apply_filters( self::getFilterName( $this->getShortcodeName(), 'post' ), $content, $options );
	}

	/**
	 * Connects pre filter
	 *
	 * @param $parentShorcodeName
	 * @param $callback
	 */
	protected function connectPreFilter( $parentShorcodeName, $callback ) {
		add_filter( self::getFilterName( $parentShorcodeName, 'pre' ), $callback, 10, 2 );
	}

	/**
	 * Connect to inline attributes filter
	 *
	 * @param string $shortcodeName
	 * @param array $callback
	 */

	public static function connectInlineAttributeFilter( $shortcodeName, $callback ) {
		add_filter( self::getFilterName( $shortcodeName, self::FILTER_INLINE_ATTRIBUTE ), $callback, 10, 2 );
	}

	/**
	 * Connect to shortcodes attributes normalization
	 *
	 * @param string $shortcodeName
	 * @param array $callback
	 */

	public static function connectNormalizedAttributesFilter( $shortcodeName, $callback ) {
		add_filter( self::getFilterName( $shortcodeName, self::FILTER_NORMALIZED_ATTRIBUTES ), $callback, 10, 2 );
	}

	/**
	 * Get filter name
	 *
	 * @param $shortcodeName
	 * @param $event
	 *
	 * @return string
	 */

	public static function getFilterName( $shortcodeName, $event ) {
		return ( $shortcodeName ? $shortcodeName : 'ct_shortcodes' ) . '_' . $event;
	}

	/**
	 * Connects post filter
	 *
	 * @param $parentShortcodeName
	 * @param $callback
	 */

	protected function connectPostFilter( $parentShortcodeName, $callback ) {
		add_filter( self::getFilterName( $parentShortcodeName, 'post' ), $callback );
	}

	/**
	 * Connects post filter
	 *
	 * @param $event
	 * @param $parentShortcodeName
	 * @param $callback
	 */

	protected function connectFilter( $event, $parentShortcodeName, $callback ) {
		add_filter( self::getFilterName( $parentShortcodeName, $event ), $callback );
	}

	/**
	 * Allows to embed shortcode inside shortcode
	 *
	 * @param string $name
	 * @param array $params
	 * @param null $content
	 *
	 * @return string
	 */

	protected function embedShortcode( $name, $params, $content = null ) {
		$html = '[' . $name;
		foreach ( $params as $pname => $value ) {
			$html .= ' ' . $pname . '="' . esc_attr( $value ) . '"';
		}

		$html .= ']';
		//we force close tag to avoid issues
		$html .= $content;
		$html .= '[/' . $name . ']';

		return $html;
	}

	/**
	 * Returns custom form view
	 *
	 * @param array $params
	 *
	 * @return string
	 */

	public function getCustomFormView( $params = array() ) {
		return '';
	}

	/**
	 * Parent shortcode name
	 * @return null
	 */

	public function getParentShortcodeName() {
		return null;
	}

	/**
	 * Add inline javascripts
	 *
	 * @param string $script
	 * @param bool $onetime
	 */

	protected function addInlineJS( $script, $onetime = false ) {
		if ( $onetime ) {
			$this->dynamicJs[ $this->getShortcodeName() ] = $script;
		} else {
			$this->dynamicJs[] = $script;
		}
	}

	/**
	 * Merges shortcode attributes with additional params
	 *
	 * @param array $currentAttributes
	 * @param string $shortcodeName
	 * @param string $namespace
	 * @param string $group
	 *
	 * @return array
	 */

	protected function mergeShortcodeAttributes( $currentAttributes, $shortcodeName, $namespace, $group = '' ) {
		$shortcode = ctShortcodeHandler::getInstance()->getShortcode( $shortcodeName );

		if ( ! $shortcode ) {
			die( "Shortcode " . $shortcodeName . ' not found!' );
		}

		$newNormalized = $shortcode->getAttributesNormalized();

		$result = $currentAttributes;
		foreach ( $newNormalized as $key => $settings ) {

			if ( $group ) {

				if ( isset( $settings['group'] ) ) {
					$settings['group'] = $group;
				} else {
					$settings['group'] = $group;
				}
			}

			$k = $this->getParamNameFromNamespace( $key, $namespace );
			//overwrite our settings - main shortcode already defined something
			if ( isset( $currentAttributes[ $k ] ) ) {
				$settings = array_merge( $settings, $currentAttributes[ $k ] );
			}

			//#28047 dependent button shortcode fix
			if($shortcode->getShortcodeName()== 'button'){

				if(isset($settings['dependency'])){
					$settings['dependency']['element'] = $this->getParamNameFromNamespace($settings['dependency']['element'],$namespace);
				}
			}



			$result[ $k ] = $settings;
		}
		if($shortcode->getShortcodeName()== 'button'){
		//	var_dump($result);exit;
		}

		return $result;
	}

	/**
	 * Render shortocode
	 *
	 * @param $shortcodeName
	 * @param $atts
	 * @param $namespace
	 *
	 * @param string $content
	 *
	 * @return string
	 */

	protected function buildRelatedShortcode( $shortcodeName, $atts, $namespace, $content = '' ) {

		$atts = shortcode_atts( $this->extractShortcodeAttributes( $atts ), $atts );
		$e    = array();
		foreach ( $atts as $key => $params ) {
			if ( strpos( $key, $namespace ) == 0 ) {
				$k = str_replace( $namespace . '_', '', $key );
				if ( $k == 'content' ) {
					$content = $atts[ $key ];
				}
				$e[ $k ] = $params;
			}
		}
		return $this->embedShortcode( $shortcodeName, $e, $content );
	}

	/**
	 * Build related shortcode if condition is true
	 *
	 * @param $atts
	 * @param $paramName
	 * @param $namespace
	 * @param string $compare
	 * @param string $compareWith
	 *
	 * @return string|void
	 */

	protected function buildRelatedShortcodeIf( $shortcodeName, $atts, $paramName, $namespace, $content = '', $compare = '!=', $compareWith = '' ) {
		$paramName = $this->getParamNameFromNamespace( $paramName, $namespace );
		if ( ! isset( $atts[ $paramName ] ) ) {
			return '';
		}
		switch ( $compare ) {
			case '!=':
				if ( $atts[ $paramName ] == $compareWith ) {
					return '';
				}
				break;
		}

		return $this->buildRelatedShortcode( $shortcodeName, $atts, $namespace, $content );
	}

	/**
	 * Returns param name from namespace
	 *
	 * @param string $param
	 * @param string $namespace
	 *
	 * @return string
	 */

	protected function getParamNameFromNamespace( $param, $namespace ) {
		return $namespace . '_' . $param;
	}

	/**
	 * Do shortcode with autop
	 *
	 * @param $content
	pink t	 *
	 *
	 * @return string
	 */

	protected function doShortcode( $content ) {
		return do_shortcode( shortcode_unautop( $content ) );
	}
}