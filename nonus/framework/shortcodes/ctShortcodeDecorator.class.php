<?php
require_once CT_THEME_LIB_DIR.'/form/utils_formbuilder.inc.php';

/**
 * Decorates shortcode dialog
 * @author alex
 */
class ctShortcodeDecorator {

	/**
	 * @var ctShortcode
	 */
	protected $shortcodes;

	/**
	 * @var FormBuilder
	 */

	protected $form;

	/**
	 * @var string
	 */

	protected $schemaFormat = '%name%';

	/**
	 * Default valuess
	 * @var array
	 */
	protected $defaults = array();

	/**
	 * Fields counter
	 * @var int
	 */
	protected $counter = 0;

	/**
	 * Attributes to remove
	 * @var array
	 */

	protected $bannedAttributes = array();

	/**
	 * Sets subsitutes
	 * @var array
	 */

	protected $substitutes = array();

	/**
	 * Loaded js081/*
	 * @var array
	 */

	protected $loadedJs = array();

	/**
	 * Parent shortcode
	 * @var ctShortcode
	 */

	protected $parentShortcode = null;

	/**
	 * Parent default values
	 * @var array
	 */

	protected $parentDefaultValues;

	/**
	 * @var string
	 */
	protected $parentSchemaName = '';

	/**
	 * @param ctShortcode[] $shortcodes
	 * @param bool $withButtons
	 * @param bool $withClone
	 */
	public function __construct( $shortcodes, $withButtons = false, $withClone = false ) {
		$this->shortcodes        = $shortcodes;
		$this->form              = new FormBuilder();
		$this->form->withButtons = $withButtons;
		$this->form->clone       = $withClone;
	}

	/**
	 * Adds parent shortcode
	 *
	 * @param $sh
	 */

	public function setParentShortcode( $sh ) {
		$this->parentShortcode = $sh;
	}

	/**
	 * Allows to setup default parent values
	 *
	 * @param array $d
	 */

	public function setParentDefaultValues( $d ) {
		$this->parentDefaultValues = $d;
	}

	/**
	 * Allows to override default values
	 *
	 * @param array $defaults
	 */
	public function setDefaultValues( $defaults ) {
		$this->defaults = $defaults;
	}

	/**
	 * Sets attributes to remove
	 *
	 * @param $attr
	 */
	public function setBannedAttributes( $attr ) {
		$this->bannedAttributes = $attr;
	}

	/**
	 * Sets params subsitutes
	 *
	 * @param arra y$substitutes
	 */

	public function setInputSubstitutes( $substitutes ) {
		$this->substitutes = $substitutes;
	}

	/**
	 * Sets decorator schema name
	 *
	 * @param string $name
	 *
	 * @throws Exception
	 */

	public function setSchemaFormat( $name ) {
		if ( strpos( $name, '%name%' ) === false ) {
			throw new Exception( "Invalid format. Should contain %s" );
		}
		$this->schemaFormat = $name;
	}


	/**
	 * Renders widget
	 * @return string
	 */

	public function render() {
		if ( $this->parentShortcode && $this->parentShortcode->getAttributesNormalized() ) {
			$this->parentSchemaName = '[parent]';
			$this->appendShortcodeForm( $this->parentShortcode, 'parent', $this->parentDefaultValues );
			$this->parentSchemaName = '';
		}

		foreach ( $this->shortcodes as $shortcode ) {
			//sometimes we may be in trouble
			$this->appendShortcodeForm( $shortcode );
		}

		return (string) $this->form->toString();
	}

	/**
	 * Normalizes attribute
	 *
	 * @param string $name
	 * @param array $attribute
	 * @param $defaults
	 *
	 * @return array
	 */
	protected function normalizeAttribute( $name, $attribute, $defaults ) {

		if ( ! array_key_exists( 'type', $attribute ) ) {
			$attribute['type'] = 'input';
		}

		//maybe we should render it differently?
		if ( isset( $this->substitutes[ $attribute['type'] ] ) ) {
			$attribute['type'] = $this->substitutes[ $attribute['type'] ];
		}

		//setup default values
		if ( array_key_exists( $name, $defaults ) ) {
			$attribute['default'] = $defaults[ $name ];
		}

		//multiple values?
		if ( array_key_exists( $this->counter, $defaults ) && array_key_exists( $name, $defaults[ $this->counter ] ) ) {
			$attribute['default'] = $defaults[ $this->counter ][ $name ];
		}

		return $attribute;
	}

	/**
	 * Handles shortcode form
	 *
	 * @param ctShortcode $shortcode
	 * @param null $containerName
	 * @param null $defaults
	 *
	 * @throws Exception
	 * @return bool|string
	 */
	protected function appendShortcodeForm( $shortcode, $containerName = null, $defaults = null ) {
		$containerName = $containerName ? $containerName : 'container_' . ( ++ $this->counter );
		$this->form->addBreak( $containerName );

		$attributes = array_diff_key( $shortcode->getAttributesNormalized(), $this->bannedAttributes );

		$defaults = $defaults ? $defaults : $this->defaults;

		foreach ( $attributes as $name => $attribute ) {
			$attribute = $this->normalizeAttribute( $name, $attribute, $defaults );

			//may be false
			if ( $attribute['type'] && $attribute['type'] != 'false' ) {
				if ( ! method_exists( $this, $attribute['type'] ) ) {
					throw new Exception( "Cannot handle " . $attribute['type'] . ' type' );
				}
				$this->$attribute['type']( $name, $attribute );
			}
		}

		return false;
	}

	/**
	 * Images collection
	 *
	 * @param $name
	 * @param $data
	 */

	protected function images( $name, $data ) {
		//currently collections not supported
		$this->image( $name, $data );
	}

	/**
	 * Renders info
	 *
	 * @param $name
	 * @param $data
	 *
	 * @throws InvalidArgumentException
	 * @return bool
	 */
	protected function toggable( $name, $data ) {
		$name = isset( $data['desc'] ) ? $data['desc'] : '';

		if ( ! isset( $data['id'] ) ) {
			throw new InvalidArgumentException( "Required ID parameter unique for form for toggable" );
		}

		//if we now this is end section, we add 'marker'
		if ( ! isset( $data['end'] ) ) {
			$this->form->addInlineJavascript( "jQuery('#" . $data['id'] . "').click(function(){
				jQuery(this).parents('tr').nextUntil('#" . $data['id'] . "_end').toggle();
			}).click();" );
		}

		$c = $this->getFormElementPrototype( '', $data );
		$c->setTypeAsCustom( '<a id="' . esc_attr( $data['id'] ) . '" href="#">' . $name . '</a>' );
		if ( isset( $data['end'] ) ) {
			$c->setTypeAsCustom( '<a id="' . esc_attr( $data['id'] ) . '" href="#">' . $name . '</a>' );
		}

		return $this->form->addFormElement( $c );
	}

	/**
	 * Adds icon
	 *
	 * @param $name
	 * @param $data
	 */

	protected function icon( $name, $data ) {
		if ( ! isset( $data['help'] ) && ! isset( $data['link'] ) ) {
			throw new Exception( "Please set link option!" );
		}
		if ( ! isset( $data['help'] ) ) {
			$data['help'] = sprintf( esc_html__( "View %s and enter icon name ex. glass", 'ct_theme' ), '<a target="_blank" id="open_' . $name . '" href="' . $data['link'] . '">' . esc_html__( 'available icons', 'ct_theme' ) . '</a>' );
		}

		$c = $this->getFormElementPrototype( $name, $data );
		$c->addCustomTags( 'data-type="text"' );
		$this->form->addFormElement( $c );
	}

	/**
	 * Adds checkbox
	 *
	 * @param string $name
	 * @param array $data
	 */

	protected function checkbox( $name, $data ) {
		$c = $this->getFormElementPrototype( $name, $data, 'true' );
		$c->setTypeAsCheckbox( true );
		$c->checkbox_label = '';

		if ( isset( $data['default'] ) && $data['default'] == 'true' ) {
			$c->checked = true;
		}

		$c->addCustomTags( 'data-type="checkbox"' );
		$this->form->addFormElement( $c );
	}

	/**
	 * Returns defaut form element
	 *
	 * @param $name
	 * @param $data
	 *
	 * @return FormElement
	 */
	protected function getFormElementPrototype( $name, $data, $value = null ) {
		//fixed form field name
		$schemaName = strtr( $this->schemaFormat, array(
			'%name%'    => $name,
			'%counter%' => $this->counter,
			'%parent%'  => $this->parentSchemaName
		) );

		$default = isset( $data['default'] ) ? $data['default'] : null;
		$value   = $value !== null ? $value : null;
		if ( $value === null ) {
			$value = $default;
		}

		$e = new FormElement( $schemaName, isset( $data['label'] ) ? ucfirst( $data['label'] ) : $this->labelize( $name ) );
		$e->setValue( $value ); //setup default value
		$e->addCustomTags( 'data-default="' . ( $default ) . '"' );
		$e->description = isset( $data['help'] ) ? $data['help'] : '';

		return $e;
	}

	/**
	 * Returns element by it's type
	 *
	 * @param $type
	 * @param $name
	 * @param $data
	 *
	 * @return FormElement
	 * @throws Exception
	 */
	public function getFormElementByType( $type, $name, $data ) {
		$attribute = $this->normalizeAttribute( $name, $data, $this->defaults );

		//may be false
		if ( $attribute['type'] && $attribute['type'] != 'false' ) {
			if ( ! method_exists( $this, $attribute['type'] ) ) {
				//show as input
				$attribute['type'] = 'input';
			}
			$this->$attribute['type']( $name, $attribute );

			return $this->form->getElement( $name );
		}

		return null;
	}

	/**
	 * Draws input
	 *
	 * @param $name
	 * @param $data
	 */
	protected function input( $name, $data ) {
		$c = $this->getFormElementPrototype( $name, $data );
		$c->addCustomTags( 'data-type="text"' );
		$this->form->addFormElement( $c );
	}

	/**
	 * Draws textarea
	 *
	 * @param $name
	 * @param $data
	 */
	protected function textarea( $name, $data ) {
		$c = $this->getFormElementPrototype( $name, $data );
		$c->addCustomTags( 'data-type="textarea"' );
		$c->setTypeAsTextArea();
		$this->form->addFormElement( $c );
	}

	/**
	 * Draws posts select
	 *
	 * @param $name
	 * @param $data
	 */
	protected function posts_select( $name, $data ) {
		$args            = wp_parse_args( $data, array( 'numberposts' => '-1' ) );
		$data['choices'] = $this->fetchPostsAsOption( $args );

		$this->select( $name, $data );
	}

    protected function products_select( $name, $data ) {
        $args            = wp_parse_args( $data, array( 'numberposts' => '-1',
            'post_type'=>'product' ) );
        $data['choices'] = $this->fetchPostsAsOption( $args );

        $this->select( $name, $data );
    }

    protected function pages_select( $name, $data ) {
        $args = wp_parse_args( $data,array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'meta_key' => '',
            'meta_value' => '',
            'authors' => '',
            'child_of' => 0,
            'parent' => -1,
            'exclude_tree' => '',
            'number' => '',
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish'
        ));
        $data['choices'] = $this->fetchPagesAsOption( $args );

        $this->select( $name, $data );
    }

	/**
	 * Multiselect posts
	 *
	 * @param $name
	 * @param $data
	 */

	protected function posts_multiselect( $name, $data ) {
		$args = wp_parse_args( $data, array( 'numberposts' => '-1' ) );

		$data['choices'] = $this->fetchPostsAsOption( $args );

		$this->multiselect( $name, $data );
	}

	/**
	 * Returns post slug
	 *
	 * @param string $id
	 *
	 * @return mixed|string|void
	 */

	function getPostSlug( $id ) {
		$slug = basename( get_permalink( $id ) );
		do_action( 'before_slug', $slug );
		$slug = apply_filters( 'slug_filter', $slug );
		do_action( 'after_slug', $slug );

		return $slug;
	}


	/**
	 * Gets posts as array
	 *
	 * @param $args
	 *
	 * @return array
	 */

	protected function fetchPostsAsOption( $args ) {
		$posts   = get_posts( $args );
		$options = array();
		foreach ( $posts as $post ) {
			$key = $post->ID;

			if ( isset( $args['value_method'] ) ) {
				switch ( $args['value_method'] ) {
					case 'slug':
						$key = $this->getPostSlug( $post->ID );
						break;
				}
			}

			$options[ $key ] = $post->post_title;
		}

		return $options;
	}

    protected function fetchPagesAsOption( $args ) {
        $pages   = get_pages( $args );
        $options = array();
        foreach ( $pages as $page ) {
            $key = $page->ID;
            $options[ $key ] = $page->post_title;
        }

        return $options;
    }

	/**
	 * Select
	 *
	 * @param $name
	 * @param $data
	 */
	protected function select( $name, $data ) {
		//2 options allowed
		$choices = isset( $data['choices'] ) ? $data['choices'] : array();
		if ( ! $choices ) {
			$choices = isset( $data['options'] ) ? $data['options'] : array();
		}

		if ( ! $choices && isset( $data['callback'] ) ) {
			$choices = call_user_func( $data['callback'], $name, $data );
		}

		$c = $this->getFormElementPrototype( $name, $data );
		$c->setTypeAsComboBox( $choices );
		$c->addCustomTags( 'data-type="select"' );
		$this->form->addFormElement( $c );
	}

	/**
	 * Select
	 *
	 * @param $name
	 * @param $data
	 */
	protected function multiselect( $name, $data ) {
		//2 options allowed
		$choices = isset( $data['choices'] ) ? $data['choices'] : array();
		if ( ! $choices ) {
			$choices = isset( $data['options'] ) ? $data['options'] : array();
		}

		$name = strpos( $name, '[]' ) !== false ? $name : $name . '[]';
		$c    = $this->getFormElementPrototype( $name, $data );
		$c->setTypeAsComboBox( $choices );
		$c->addCustomTags( 'data-type="select" multiple="multiple" ' );
		$this->form->addFormElement( $c );
	}

	/**
	 * Adds colorpicker
	 *
	 * @param string $name
	 * @param array $data
	 */

	protected function colorpicker( $name, $data ) {
		$c           = $this->getFormElementPrototype( $name, $data );
		$c->cssclass = 'colorpicker';
		$def         = $data['default'];
		$control     = <<<EOF
<div style="position:relative;">
<input class="pickcolor" data-type="text" type="text" name="$name" value="$def" data-default="$def"/>
<div class="colorpicker" style="z-index:100; position:absolute; display:none;"></div>
</div>
EOF;

		$c->setTypeAsCustom( $control );
		$this->form->addFormElement( $c );

		$dir = CT_THEME_LIB_DIR_URI . '/form/colorpicker';

		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script( 'farbtastic' );
		wp_register_script( 'theme_colorpicker', $dir . '/js/init.js', array( 'jquery' ) );
		wp_enqueue_script( 'theme_colorpicker' );
	}

	/**
	 * media library widget for image
	 *
	 * @param $name
	 * @param $data
	 */
	protected function image( $name, $data ) {
		$c           = $this->getFormElementPrototype( $name, $data );
		$c->cssclass = 'media';
		$control     = <<<EOF
<div class="media">
<input class="image_select" data-type="text" type="text" name="$name" />
<input class="image_button" type="button" name="select image" value="Select" />
</div>
EOF;

		$c->setTypeAsCustom( $control );
		$this->form->addFormElement( $c );

		$js = <<<EOF
jQuery(document).ready(function() {
	var currentTarget = null;

	jQuery('.image_button').click(function() {
	currentTarget = jQuery(this).prev('.image_select');
	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	return false;
	});

	window.send_to_editor = function(html) {
	imgurl = jQuery('<div>'+html+"</div>").find('img').attr('src');
	currentTarget.val(imgurl);
	tb_remove();
	}

});
EOF;

		$this->form->addInlineJavascript( $js );

		wp_enqueue_style( 'thickbox' );

		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_script( 'jquery' );
	}

	/**
	 * Transforms label
	 *
	 * @param string $name
	 *
	 * @return string
	 */
	protected function labelize( $name ) {
		return ucfirst( str_replace( array( '_', '-', '[]' ), ' ', $name ) );
	}


	/**
	 * Renders form
	 * @return string
	 */
	public function __toString() {
		try {
			return (string) $this->render();
		} catch ( Exception $e ) {
			if ( WP_DEBUG ) {
				return (string) $e;
			}

			return '';
		}
	}

}